<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{


	public function index()
	{
		//$_API_KEY = '3bd84db3e14a8028efd6afb20789f1a9';
		$_API_KEY = 'a47ead69b3d83a8042703f093f3cadb2';
		$_NGROK_URL = 'https://app.payxnowandrestondelivery.com/public';
		$shop = $_GET['shop'];
		//$scopes = 'read_products,write_products';

		$scopes = 'read_products,write_products,read_orders,read_all_orders,write_orders,write_order_edits,read_draft_orders,write_draft_orders,read_customers,write_customers';
		$redirect_uri = $_NGROK_URL . '/token';
		$nonce = bin2hex(random_bytes(12));
		//$access_mode = 'per-user';
		$access_mode = 'offline';

		$oauth_url = 'https://' . $shop . '/admin/oauth/authorize?client_id=' . $_API_KEY . '&scope=' . $scopes . '&redirect_uri=' . urlencode($redirect_uri) . '&state=' . $nonce . '&grant_options[]=' . $access_mode;

		//echo $oauth_url;
		// die();
		//header("Location: " . $oauth_url);

		return redirect()->to($oauth_url);
	}

	public function token()
	{

		$userModel = new UserModel();
		//$api_key = '3bd84db3e14a8028efd6afb20789f1a9';
		$api_key = 'a47ead69b3d83a8042703f093f3cadb2';
		
		//$secret_key = '72c81202c02a79b664d7e6192f7a4f0f';
		$secret_key = 'ad3c6cab211965d40f051f41205225c3';
		$parameters = $_GET;
		$shop_url = $parameters['shop'];
		$hmac = $parameters['hmac'];
		$parameters = array_diff_key($parameters, array('hmac' => ''));
		ksort($parameters);
		// print_r($parameters); die();
		$new_hmac = hash_hmac('sha256', http_build_query($parameters), $secret_key);

		if (hash_equals($hmac, $new_hmac)) {

			$access_token_endpoint = 'https://' . $shop_url . '/admin/oauth/access_token';
			$var = array(
				"client_id" => $api_key,
				"client_secret" => $secret_key,
				"code" => $parameters['code']
			);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $access_token_endpoint);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, count($var));
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($var));
			$response = curl_exec($ch);
			curl_close($ch);

			$response = json_decode($response, true);


			// echo"<pre>"; print_r($response); echo"</pre>"; die();

			if(isset($response['expires_in'])){
				$response['expires_in'] = $response['expires_in'];
			}else {
				$response['expires_in']="";
			}
			if(isset($response['scope'])){
				$response['scope'] = $response['scope'];
			}else {
				$response['scope']="";
			}

			$countrows = $userModel->checktokens($parameters['shop']);
			if ($countrows < 1) {
				$curdate = date('Y-m-d');
				$userId = $userModel->insert_data(array(
					"shop_url" => $parameters['shop'],
					"access_token" => $response['access_token'],
					"scope" => $response['scope'],
					//"expires_in" => $response['expires_in'],
					//"associated_user_scope" => $response['associated_user_scope'],
					//"associated_user_id" => $response['associated_user']['id'],
					//"first_name" => $response['associated_user']['first_name'],
					//"last_name" => $response['associated_user']['last_name'],
					//"email" => $response['associated_user']['email'],
					//"locale" => $response['associated_user']['locale'],
					//"account_owner" => $response['associated_user']['account_owner'],
					//"auth_code" => $parameters['code'],
					"created" => $curdate,
					"store_status" => 1
				));

    


				//install js lib file
			} else {
				if(isset($response['expires_in'])){
					$response['expires_in'] = $response['expires_in'];
				}else {
					$response['expires_in']="";
				}
				if(isset($response['associated_user_scope'])){
					$response['associated_user_scope'] = $response['associated_user_scope'];
				}else {
					$response['associated_user_scope']="";
				}
				$userId = $userModel->update_data($parameters['shop'], array(
					"access_token" => $response['access_token'],
					"scope" => $response['scope'],
					"expires_in" => $response['expires_in'],
					"auth_code" => $parameters['code'],
					"associated_user_scope" => $response['associated_user_scope'],
					"store_status" => 1
				));
			}

			$auth_shop_name = explode(".", $shop_url);
			$auth_store_name = $auth_shop_name[0];



			      


			//order create webhook
			$this->common->rest_api('/admin/api/2022-07/webhooks.json', array("webhook" => array("topic" => "orders/create", "address" => 'https://app.payxnowandrestondelivery.com/syncallorders?whshp='.$_GET['shop'], "format" => "json")), 'POST', $response['access_token'], $_GET['shop']);


			//Product Update webhook
			$this->common->rest_api('/admin/api/2022-07/webhooks.json', array("webhook" => array("topic" => "products/update", "address" => 'https://app.payxnowandrestondelivery.com/paxnow_update_products?pxupprshp='.$_GET['shop'], "format" => "json")), 'POST', $response['access_token'], $_GET['shop']);


			//order paid webhook
			$this->common->rest_api('/admin/api/2022-07/webhooks.json', array("webhook" => array("topic" => "orders/paid", "address" => 'https://app.payxnowandrestondelivery.com/paidordernotify?shpname='.$_GET['shop'], "format" => "json")), 'POST', $response['access_token'], $_GET['shop']);


			// app uninstalled webhook 
			$this->common->rest_api('/admin/api/2022-07/webhooks.json', array("webhook" => array("topic" => "app/uninstalled", "address" => 'https://app.payxnowandrestondelivery.com/cleanup_app?cleanshop='.$_GET['shop'], "format" => "json")), 'POST', $response['access_token'], $_GET['shop']);

			//$register_webhookset = json_decode($register_webhook['body'], true);

			//end code here



			$get_register_webhook = $this->common->rest_api('/admin/api/2022-07/webhooks.json', array(), 'GET', $response['access_token'], $_GET['shop']);
			$get_register_webhookset = json_decode($get_register_webhook['body'], true);
			$track_webhook = array(
				"shop_url" => $_GET['shop'],
				"webhook_id" => $get_register_webhookset['webhooks'][0]['id'],
				"date_time" => date('Y-m-d H:i:s'),
				"response_tbl" => json_encode($_SERVER)

			);

			$userModel->insert_webhooks($track_webhook);
			$plan_details = $userModel->get_store_plan($_GET['shop']);
			if (empty($plan_details)){
				$plane_start_date = date('Y-m-d');
				$plane_start_endate = date('Y-m-d', strtotime('+30 days'));
				$trackarray = array(
					"shop_url" => $_GET['shop'],
					"charged_id" => '',
					"plan_name" => 'basic',
					"plan_price" => 0,
					"sync_orders_count" => 20,
					"updated_sync_orders_count" => 20,
					"total_products_partial" => 200,
					"updated_products_partial" => 200,
					"plan_status" => 'active',
					"activate_date" => date('Y-m-d'),
					"plan_validity" => $plane_start_endate

				);
				$userModel->track_store_subscribe($trackarray);
			}


			//echo "<script>top.window.location='https://admin.shopify.com/store/" . $auth_store_name . "/apps/pay-x-now-rest-on-delivery'</script>";
			$data = array();
			$data['pricurl'] = "https://admin.shopify.com/store/" . $auth_store_name . "/apps/pay-x-now-rest-on-delivery";
            echo view('templates/apbrdgnew', $data);

		} else {
			echo "it is not comming from shopify";
		}
	}
}
// echo "200 ok";
// exit();
