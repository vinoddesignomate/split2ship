<?php

namespace App\Controllers;

use App\Models\FrontModel;
use App\Models\UserModel;

class FrontController extends BaseController
{
    protected $base;
    protected $front_model;
    protected $user_model;
    function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        helper(['form', 'url']);
        $session = \Config\Services::session();
        //$this->front_model = new FrontModel();
        $this->user_model = new UserModel();
    }
    public function get_product_details()
    {

        $shopname = str_replace("https://", "", $this->request->getPost('shopname'));
        $shopname = str_replace("http://", "", $shopname);

        $plan_details = $this->user_model->get_store_plan($shopname);

        //     $get_details = $this->user_model->get_tokens($shopname);
        //     $products =  $products = $this->common->rest_api('/admin/api/2021-01/products.json', array(), 'GET', $get_details->access_token, $shopname);

        //    // print_r($get_details);
        //     $response = json_decode($products['body'], true);
        //     if (array_key_exists('errors', $response)) {
        //         //echo "token expiry";
        //     } else {
        //         //echo "woring toekn";
        //     }
        // $api_key = 'a47ead69b3d83a8042703f093f3cadb2';
        // $secret_key = 'ad3c6cab211965d40f051f41205225c3';
        // $access_token_endpoint = 'https://' . $shopname . '/admin/oauth/access_token';
        // $var = array(
        //     "client_id" => $api_key,
        //     "client_secret" => $secret_key,
        //     "code" => $get_details->auth_code
        // );

        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $access_token_endpoint);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_POST, count($var));
        // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($var));
        // $new_response = curl_exec($ch);
        // curl_close($ch);

        // $testrrffresponse = json_decode($new_response, true);
        // print_r($testrrffresponse);
        if (!empty($plan_details)) {
            if ($plan_details[0]->plan_name == 'basic' && $plan_details[0]->updated_sync_orders_count == 0) {
                return 'not_found';
            } else if ($plan_details[0]->plan_validity <= date('Y-m-d')) {
                return 'not_found';
            } else {
                $condtion_array = array(
                    "product_id" => $this->request->getPost('pid'),
                    "varient_id" => $this->request->getPost('vid')
                );
                $get_resulrs = $this->user_model->get_store_product($shopname, $condtion_array);
                $gtbtncolor = $this->user_model->get_checkout_button_color($shopname);

                if (!empty($get_resulrs)) {
                    if(isset($get_resulrs[0]->partial_percentage) && $get_resulrs[0]->partial_percentage!=""){

                        $propartialper = ($get_resulrs[0]->partial_percentage / 100) * $get_resulrs[0]->price;
                        $partperctg = $get_resulrs[0]->partial_percentage;
                    }else{
                        $propartialper = 0; 
                        $partperctg = 0; 
                    }
                    $return_array = array(
                        "full_price" => $get_resulrs[0]->price,
                        "pro_pack" => $partperctg,
                        "partial_price" => $propartialper,
                        "cart_form_class" => isset($gtbtncolor[0]->cart_form_class) ? $gtbtncolor[0]->cart_form_class : 'shopify-product-form',
                        "cart_button_id" => isset($gtbtncolor[0]->addcartbtn_cg) ? $gtbtncolor[0]->addcartbtn_cg : 'product-add-to-cart',
                        "cg_chkout_btn_class" => isset($gtbtncolor[0]->cg_chkout_btn_class) ? $gtbtncolor[0]->cg_chkout_btn_class : 'btn-checkout',
                    );
                    return json_encode($return_array);
                } else {
                    return 'not_found';
                }
            }
        } else {
            return 'not_found';
        }
    }
    public function create_draft_order()
    {


        $body_data = file_get_contents('php://input');
        //echo $body_data;
        $body_data_decode = json_decode($body_data, TRUE);
        //print_r($body_data_decode);

        $shopname = str_replace("https://", "", $body_data_decode['shopname']);
        $shopname = str_replace("http://", "", $shopname);
        $cartarray = $body_data_decode['cart_item'];

        $get_details = $this->user_model->get_tokens($shopname);
        $line_item_arra = array();
        $chekpartial = 0;
        $remaining_price = 0;
        $illp = 0;
        foreach ($cartarray as $item_cart) {

            if (isset($item_cart['paytype']) && $item_cart['paytype'] == 'Available') {

                $chekpartial = 1;
                $final_price = $item_cart['price'] / $item_cart['qty'];
                $line_item  = array(
                    "title" => $item_cart['title'],
                    "price" => $final_price,
                    "quantity" => $item_cart['qty'],
                    "requires_shipping" => true,
                    "gift_card" => true,
                    "properties" => array(
                        array("name" => "Note", "value" => "Initial Partial Payment"),
                        array("name" => "variant_code", "value" => $item_cart['id']),
                        array("name" => "partial_pay", "value" => $item_cart['price']),
                        array("name" => "remaining_amount", "value" => str_replace("-", "", $item_cart['rem_p'])),
                        array("name" => "psku", "value" => $item_cart['psku'])
                    )
                );
                $remaining_price = $remaining_price + $item_cart['rem_p'];
            } else {
                $line_item = array(
                    "variant_id" => $item_cart['id'],
                    "quantity" => $item_cart['qty'],
                    "gift_card" => true,
                    "properties" => array(
                        array("name" => "Note", "value" => "Full Payment"),
                        array("name" => "full_pay", "value" => $item_cart['price'])
                    ),
                    "requires_shipping" => true
                );
            }

            //code for add variants name & value to order
            foreach ($item_cart['cg_variant_options'] as $split_varient_options) {
                if ($split_varient_options['name'] != "Title") {
                    $line_item['properties'][] = array(
                        "name" => $split_varient_options['name'],
                        "value" => $split_varient_options['value']
                    );
                }
            }

            $illp = $illp + 1;
            $line_item_arra[] = $line_item;
        }
        //echo $chekpartial;
        //    print_r($line_item_arra);

        // if ($shopname == 'desinomatetest.myshopify.com') {
        //     echo "line_item_arra<pre>";
        //     print_r($line_item_arra);
        //     echo "</pre>";
        //     die();
        // }
        $final_total_price_rem = str_replace("-", "", $remaining_price);
        $final_array = array("draft_order" => array("line_items" => $line_item_arra, "tags" => "partial_" . $final_total_price_rem));
        return $this->common->draft_order_creat($get_details->access_token, $shopname, $final_array);
        //return $return_array->draft_order->invoice_url;
    }
    function graphql_api_run($query = array(), $shop_url, $acc_token)
    {

        $url = 'https://' . $shop_url . '/admin/api/2023-01/graphql.json';

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 3);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $headers[] = "";
        $headers[] = "Content-Type: application/json";
        if ($acc_token) $headers[] = "X-Shopify-Access-Token: " . $acc_token;

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($query));
        curl_setopt($curl, CURLOPT_POST, true);

        $response = curl_exec($curl);
        $error = curl_errno($curl);
        $error_msg = curl_error($curl);
        curl_close($curl);
        if ($error) {
            return $error_msg;
        } else {
            $response = preg_split("/\r\n\r\n|\n\n|\r\r/", $response, 2);

            $headers = array();
            $headers_content = explode("\n", $response[0]);
            $headers['status'] = $headers_content[0];

            array_shift($headers_content);

            foreach ($headers_content as $conent) {
                $data = explode(":", $conent);
                $headers[trim($data[0])] = trim($data[1]);
            }
            return array("headers" => $headers, "body" => $response[1]);
        }
    }


    public function order_create_cehck()
    {

        $webhook_content = NULL;
        $webhook = fopen('php://input', 'rb');
        while (!feof($webhook)) {
            $webhook_content .= fread($webhook, 4096);
        }

        fclose($webhook);

        $jsndata = json_decode($webhook_content);

        $resposne_array = array("name" => "test webhook_content" . $webhook_content);
        $this->user_model->check_test_response($resposne_array);
    }
    /*
    ** function is used for add collection related products into partial products when store owner set partial percenatge 
    ** to any collection. Cron run every 5 min and get the collection products and add them to partial products.
    */
    public function add_collection_partial_cron()
    {
        // $resposne_array = array("name" => "insertion from AWS");
        // $this->user_model->check_test_response($resposne_array);
        // echo "insert";       

        $get_lates_colection = $this->user_model->get_cron_collection(); //get recently updated collection
        if (!empty($get_lates_colection)) { //check data empty or not  

            $get_updated_plan = $this->user_model->get_store_plane($get_lates_colection->shop_url); //get activated store how many products count have
            if ($get_updated_plan[0]->updated_products_partial > 0) {
                $cron_limit_set = 50;
                $get_details = $this->user_model->get_tokens($get_lates_colection->shop_url); //get shop token
                //below block for get products first time from page 1
                if ($get_lates_colection->cron_page_num == 1) {
                    $data = array();
                    $colcturl = "/admin/api/2022-04/products.json";
                    $products = $this->common->rest_api($colcturl, array("collection_id" => $get_lates_colection->collection_id, "limit" => $cron_limit_set), 'GET', $get_details->access_token, $get_lates_colection->shop_url);

                    $product_list = json_decode($products['body'], true);
                    if (!empty($product_list)) {
                        $headers = $products['headers'];
                        if (isset($headers['link'])) {
                            $nextPageURL = $this->common->str_btwn($headers['link'], '<', '>');
                            $nextPageURLparam = parse_url($nextPageURL);
                            parse_str($nextPageURLparam['query'], $value);
                            $data['page_info'] = $value['page_info'];
                        }
                        $data['headers_list'] = $headers;


                        foreach ($product_list as $product) {
                            foreach ($product as $key => $value) {

                                $payxnowrest_product_add = array(
                                    "product_id" => $value['id'],
                                    "product_title" => $value['title'],
                                    "shop_url" => $get_lates_colection->shop_url,
                                    "partial_percentage" => $get_lates_colection->partial_percentage,
                                    "add_date" => date('Y-m-d'),
                                    "collection_id" => $get_lates_colection->collection_id
                                );
                                //below function is used for add products into partial list & update partial products of store according their plan
                                $this->user_model->add_partial_products_collections($payxnowrest_product_add);
                                foreach ($value['variants'] as $produc_varaien) {
                                    $product_array = array(
                                        "product_id" => $produc_varaien['product_id'],
                                        "varient_id" => $produc_varaien['id'],
                                        "title" => $produc_varaien['title'],
                                        "price" => $produc_varaien['price'],
                                        "partial_percentage" => $get_lates_colection->partial_percentage,
                                        "shop_url" => $get_lates_colection->shop_url,
                                        "collection_id" =>  $get_lates_colection->collection_id
                                    );
                                    $this->user_model->add_partial_products_varient($product_array);
                                }
                                
                            }
                        }
                    }
                    if (isset($data['page_info'])) {
                        $payxnowrest_cron_update = array(
                            "collection_id" => $get_lates_colection->collection_id,
                            "shop_url" => $get_lates_colection->shop_url,
                            "page_info" => $data['page_info'],
                            "cron_page_num" => $get_lates_colection->cron_page_num + 1,
                        );
                        $this->user_model->update_cron_products($payxnowrest_cron_update);
                    } else {
                        $payxnowrest_collect_update = array(
                            "cron_run" => 1,
                            "cron_page_num" => 0,
                            "shop_url" => $get_lates_colection->shop_url,
                            "collection_id" => $get_lates_colection->collection_id,
                        );
                        $this->user_model->update_cron_products($payxnowrest_collect_update);
                    }
                } else if ($get_lates_colection->cron_page_num > 1) {
                    // block for get products paginated
                    $page_array = array(
                        'limit' => $cron_limit_set,
                        'page_info' => $get_lates_colection->page_info,
                        'rel' => "next"
                    );

                    $products = $this->common->rest_api('/admin/api/2022-04/products.json', $page_array, 'GET', $get_details->access_token, $get_lates_colection->shop_url);



                    $product_list = json_decode($products['body'], true);

                    if (!empty($product_list)) {
                        foreach ($product_list as $product) {
                            foreach ($product as $key => $value) {

                                $payxnowrest_product_add = array(
                                    "product_id" => $value['id'],
                                    "product_title" => $value['title'],
                                    "shop_url" => $get_lates_colection->shop_url,
                                    "partial_percentage" => $get_lates_colection->partial_percentage,
                                    "add_date" => date('Y-m-d'),
                                    "collection_id" => $get_lates_colection->collection_id
                                );
                                $this->user_model->add_partial_products_collections($payxnowrest_product_add);
                                foreach ($value['variants'] as $produc_varaien) {
                                    $product_array = array(
                                        "product_id" => $produc_varaien['product_id'],
                                        "varient_id" => $produc_varaien['id'],
                                        "title" => $produc_varaien['title'],
                                        "price" => $produc_varaien['price'],
                                        "partial_percentage" => $get_lates_colection->partial_percentage,
                                        "shop_url" => $get_lates_colection->shop_url,
                                        "collection_id" =>  $get_lates_colection->collection_id
                                    );
                                    $this->user_model->add_partial_products_varient($product_array);
                                }

                               
                            }
                        }
                    }
                    $headers = $products['headers'];
                    $link_array = array();
                    if (strpos($headers['link'], ',')  !== false) {
                        $link_array = explode(',', $headers['link']);
                    } else {
                        $link = $headers['link'];
                    }


                    if (sizeof($link_array) > 1) {
                        $prev_link = $link_array[0];
                        $prev_link = $this->common->str_btwn($prev_link, '<', '>');
                        $param = parse_url($prev_link);
                        parse_str($param['query'], $prev_link);
                        $prev_link = $prev_link['page_info'];
                        $next_link = $link_array[1];
                        $next_link = $this->common->str_btwn($next_link, '<', '>');
                        $param = parse_url($next_link);
                        parse_str($param['query'], $next_link);
                        $next_link = $next_link['page_info'];

                        $payxnowrest_cron_update = array(
                            "collection_id" => $get_lates_colection->collection_id,
                            "shop_url" => $get_lates_colection->shop_url,
                            "page_info" => $next_link,
                            "cron_page_num" => $get_lates_colection->cron_page_num + 1,
                        );
                        $this->user_model->update_cron_products($payxnowrest_cron_update);
                    } else {

                        $payxnowrest_collect_update = array(
                            "cron_run" => 1,
                            "cron_page_num" => 0,
                            "shop_url" => $get_lates_colection->shop_url,
                            "collection_id" => $get_lates_colection->collection_id,
                        );
                        $this->user_model->update_cron_products($payxnowrest_collect_update);
                    }
                }
            } else {
                $payxnowrest_collect_update = array(
                    "cron_run" => 1,
                    "cron_page_num" => 0,
                    "shop_url" => $get_lates_colection->shop_url,
                    "collection_id" => $get_lates_colection->collection_id,
                );
                $this->user_model->update_cron_products($payxnowrest_collect_update);
            }
            echo "done";
        } else {
            echo "not found";
        }
        $updateprorespo = array("name" => "run collectioncrn job=".json_encode($get_lates_colection));
        $this->user_model->check_test_response($updateprorespo);
    }
    /*
    ** get dynamnic checkout button color from database
    */
    public function getfront_color_code()
    {
        $shopname = str_replace("https://", "", $this->request->getPost('shopname'));
        $shopname = str_replace("http://", "", $shopname);

        $gtbtncolor = $this->user_model->get_checkout_button_color($shopname);
        //print_r($gtbtncolor);

        if (!empty($gtbtncolor)) {
            $return_array = array(
                "partial_btn_color" => isset($gtbtncolor[0]->partial_btn_color) ? $gtbtncolor[0]->partial_btn_color : '',
                "full_part_btn_color" => isset($gtbtncolor[0]->full_btn_color) ? $gtbtncolor[0]->full_btn_color : '',
                "chk_btn_color" => isset($gtbtncolor[0]->chk_btn_color) ? $gtbtncolor[0]->chk_btn_color : '',
                "full_chk_btn_color" => isset($gtbtncolor[0]->full_chk_btn_color) ? $gtbtncolor[0]->full_chk_btn_color : '',
                "cart_form_class" => isset($gtbtncolor[0]->cart_form_class) ? $gtbtncolor[0]->cart_form_class : 'shopify-product-form',
                "cart_button_id" => isset($gtbtncolor[0]->addcartbtn_cg) ? $gtbtncolor[0]->addcartbtn_cg : 'product-add-to-cart',
                "cg_chkout_btn_class" => isset($gtbtncolor[0]->cg_chkout_btn_class) ? $gtbtncolor[0]->cg_chkout_btn_class : 'btn-checkout',
                "cg_cart_remove_class" => isset($gtbtncolor[0]->cg_cart_remove_class) ? $gtbtncolor[0]->cg_cart_remove_class : 'remove',

            );
            return json_encode($return_array);
        } else {
            return "no_color";
        }
    }
}
