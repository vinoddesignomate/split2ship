<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Libraries\Common; // Import library
class Home extends BaseController
{
    protected $shope_name;
    protected $plane_details;
    function __construct()
    {
        // ob_start();
        // session_start();
        // echo "inconstruxc"; die();
        if (isset($_REQUEST['shop'])) {

            header("Content-Security-Policy: frame-ancestors https://" . $_REQUEST['shop'] . " https://admin.shopify.com;");
            //header('Access-Control-Allow-Origin: *');
            //helper(['form', 'url']);


            $this->plane_details = array(
                "advanced" => array(
                    "price" => 17.95,
                    "validity" => 30,
                    "order_sunc" => 200,
                    "partial_product" => 2000
                ),
                "pro" => array(
                    "price" => 30.95,
                    "validity" => 30,
                    "order_sunc" => 1000000,
                    "partial_product" => 5000
                ),
                "ultimate" => array(
                    "price" => 60.95,
                    "validity" => 30,
                    "order_sunc" => 1000000,
                    "partial_product" => 10000
                )
            );
            $shop_name = explode(".", $_REQUEST['shop']);
            $this->shope_name = $shop_name[0];
            $this->user_model = new UserModel();
        } else {

            ob_start();
            header('HTTP/1.0 401 Unauthorized');
            echo '401 Unauthorized';
            exit;
        }
    }
    // public function index()
    // {
    //     $countrows = $this->user_model->get_data();
    //     print_r($countrows);
    //     return view('welcome_message');
    // }

    public function index()
    {
        $data = array();
        $myCommon = new Common();
        $data['myCommon'] = $myCommon;

        if (isset($_GET['shop'])) {
            $countrows = $this->user_model->checktokens($_GET['shop']);
            if ($countrows < 1) {
                echo "<script>top.window.location='https://app.payxnowandrestondelivery.com/public/install?shop=" . $_GET['shop'] . "'</script>";
                //return redirect()->to('https://app.payxnowandrestondelivery.com/public/install?shop=' . $_GET['shop']);
            }

            $get_details = $this->user_model->get_tokens($_GET['shop']);
            $products =  $products = $this->common->rest_api('/admin/api/2021-01/products.json', array(), 'GET', $get_details->access_token, $_GET['shop']);


            $response = json_decode($products['body'], true);
            if (array_key_exists('errors', $response)) {
                //echo esc("sorry but  i think there is an error. error is" . $response['errors']);
                echo "<script>top.window.location='https://app.payxnowandrestondelivery.com/public/install?shop=" . $_GET['shop'] . "'</script>";
                //return redirect()->to('https://app.payxnowandrestondelivery.com/public/install?shop=' . $_GET['shop']);

                // header("Location: install.php?shop=" . $_GET['shop']);
                exit();
            } else {



                //    $register_webhook = $this->common->rest_api('/admin/api/2022-07/webhooks.json', array(), 'GET', $get_details->access_token, $_GET['shop']);
                // $register_webhookset = json_decode($register_webhook['body'], true);
                // echo"<pre>"; print_r($register_webhookset); echo"</pre>"; 


                $get_updated_plan = $this->user_model->get_store_plane($_GET['shop']);

                if ($this->request->getPost('assign_save')) {
                    // print_r($this->request->getPost());
                    // echo view('templates/footer');
                    // die();
                    if (!empty($this->request->getPost('assign_pro'))) {
                        $total_synproduct = count($this->request->getPost('assign_pro'));
                        if ($get_updated_plan[0]->updated_products_partial > $total_synproduct) {
                            foreach ($this->request->getPost('assign_pro') as $prokey => $product_id) {

                                //  echo "product_id" . $product_id;



                                $get_single_pro = $this->common->rest_api('/admin/api/2022-10/products/' . $product_id . '.json', array(), 'GET', $get_details->access_token, $_GET['shop']);
                                $product_details = json_decode($get_single_pro['body'], true);
                                // echo "<pre>"; print_r($product_details['product']['variants']); echo"</pre>";

                                $product_array = array(
                                    "product_id" => $product_id,
                                    "product_title" => $product_details['product']['title'],
                                    "shop_url" => $_GET['shop'],
                                    "partial_percentage" => 10,
                                    "add_date" => date('Y-m-d')
                                );
                                $this->user_model->add_partial_products($product_array);

                                foreach ($product_details['product']['variants'] as $produc_varaien) {
                                    $product_array = array(
                                        "product_id" => $produc_varaien['product_id'],
                                        "varient_id" => $produc_varaien['id'],
                                        "title" => $produc_varaien['title'],
                                        "price" => $produc_varaien['price'],
                                        "partial_percentage" => 10,
                                        "shop_url" => $_GET['shop']
                                    );
                                    $this->user_model->add_partial_products_varient($product_array);
                                }
                            }
                            $update_latest = array(
                                "latest_count" => $total_synproduct,
                                "shop_url" => $_GET['shop']
                            );
                            $this->user_model->track_lates_records($update_latest);
                            $this->user_model->update_plan_products($total_synproduct, $_GET['shop']);
                        } else {
                            echo "<script>alert('Please upgrade the plan'); top.window.location='https://admin.shopify.com/store/" . $this->shope_name . "/apps/pay-x-now-rest-on-delivery?collectionparms=" . $this->request->getPost('collectionparms') . "'</script>";
                        }
                    }
                    //  echo "<script>top.window.location='https://admin.shopify.com/store/" . $this->shope_name . "/apps/pay-x-now-rest-on-delivery/public/index.php/products-list?collectionparms=" . $this->request->getPost('get_coll') . "'</script>";
                    echo "<script>top.window.location='https://admin.shopify.com/store/" . $this->shope_name . "/apps/pay-x-now-rest-on-delivery/partial-latest-products-list'</script>";
                    // exit();
                }


                // $register_webhook = $this->common->rest_api('/admin/api/2022-07/webhooks.json', array("webhook" => array("topic" => "orders/edited", "address" => 'https://app.payxnowandrestondelivery.com/public/index.php/orderedt?='.$_GET['shop'], "format" => "json")), 'POST', $get_details->access_token, $_GET['shop']);

                //get store collections
                $collections = $this->common->rest_api('/admin/api/2022-04/custom_collections.json', array(), 'GET', $get_details->access_token, $_GET['shop']);
                $collections = json_decode($collections['body'], true);
                $coll_array = array();
                foreach ($collections['custom_collections'] as $collection_list) {
                    $coll_array = array(
                        "collection_id" => $collection_list['id'],
                        "collections_name" => $collection_list['title'],
                        "shop_url" => $_GET['shop']

                    );
                    $this->user_model->track_collections($coll_array, $_GET['shop']);
                }

                $smart_collections = $this->common->rest_api('/admin/api/2022-10/smart_collections.json', array(), 'GET', $get_details->access_token, $_GET['shop']);

                $smart_collectionsget = json_decode($smart_collections['body'], true);
                $smart_coll_array = array();

                //track smart collection
                if (isset($smart_collectionsget['smart_collections']) && !empty($smart_collectionsget['smart_collections'])) {
                    foreach ($smart_collectionsget['smart_collections'] as $collection_list) {
                        $smart_coll_array = array(
                            "collection_id" => $collection_list['id'],
                            "collections_name" => $collection_list['title'],
                            "shop_url" => $_GET['shop']

                        );

                        $this->user_model->track_collections($smart_coll_array, $_GET['shop']);
                    }
                }

                $get_store_collections = $this->user_model->get_collections($_GET['shop']);

                $parma_array = array("limit" => 50);

                if ((isset($_GET['collectionparms']) && $_GET['collectionparms'] != "")) {

                    $colcturl = "/admin/api/2022-04/products.json";
                    $data['checkcol'] = 'yes';
                    // $products = $this->common->rest_api($colcturl, array("collection_id" => $_GET['collectionparms'], 'vendor' => $_GET['vendorname'], "limit" => 10), 'GET', $get_details->access_token, $_GET['shop']);

                    // $products = $this->common->rest_api($colcturl, array("collection_id" => $_GET['collectionparms'], "limit" => 10), 'GET', $get_details->access_token, $_GET['shop']);

                    // $product_list = json_decode($products['body'], true);

                    if ($this->request->getPost('search_text')) {
                        // print_r($this->request->getPost());
                        $params_array = array(
                            "collection_id" => $_GET['collectionparms'],
                            "limit" => 10,
                            "search_parms" => $this->request->getPost('search_text')
                        );
                        $data['searctxt'] = $this->request->getPost('search_text');
                        $grapql_products_list = $this->common->getproductsgrapqlapi($params_array, $_GET['shop'], $get_details->access_token);
                        $grapql_products_list_prodct = json_decode($grapql_products_list['body'], true);
                    } else {
                        $params_array = array(
                            "collection_id" => $_GET['collectionparms'],
                            "limit" => 10,
                            //"search_parms" => "Super Women"
                        );
                        $grapql_products_list = $this->common->getproductsgrapqlapi($params_array, $_GET['shop'], $get_details->access_token);
                        $grapql_products_list_prodct = json_decode($grapql_products_list['body'], true);
                    }
                    if (isset($grapql_products_list_prodct['data']['collection'])) {
                        $product_list = $grapql_products_list_prodct['data']['collection']['products'];
                    } else {
                        $product_list = $grapql_products_list_prodct['data']['products'];
                    }
                } else {
                    $product_list = array();
                    $data['checkcol'] = 'no';
                }

                // echo "<pre>";
                // print_r($product_list);
                // echo "</pre>";
                $data['get_part_list'] = $this->user_model->get_partial_productget($_GET['shop']);

                // echo "<pre>"; print_r($data['get_part_list']); echo "</pre>";

                $data['products'] = $product_list;
                $data['get_store_collections'] = $get_store_collections;
                // if (!empty($product_list)) {
                //     $headers = $products['headers'];
                //     if (isset($headers['link'])) {
                //         $nextPageURL = $this->common->str_btwn($headers['link'], '<', '>');
                //         $nextPageURLparam = parse_url($nextPageURL);
                //         parse_str($nextPageURLparam['query'], $value);
                //         $data['page_info'] = $value['page_info'];
                //     }
                //     $data['headers_list'] = $headers;
                // }
                if (!empty($product_list)) {
                    if (isset($grapql_products_list_prodct['data']['collection'])) {
                        if (isset($grapql_products_list_prodct['data']['collection']['products']['pageInfo']['hasNextPage']) && $grapql_products_list_prodct['data']['collection']['products']['pageInfo']['hasNextPage'] == 1) {
                            $data['pagenewxt'] = $grapql_products_list_prodct['data']['collection']['products']['pageInfo']['endCursor'];
                        }
                    } else {
                        if (isset($grapql_products_list_prodct['data']['products']['pageInfo']['hasNextPage']) && $grapql_products_list_prodct['data']['products']['pageInfo']['hasNextPage'] == 1) {
                            $data['pagenewxt'] = $grapql_products_list_prodct['data']['products']['pageInfo']['endCursor'];
                        }
                    }
                }


                //shipping method config section

                if ($this->request->getPost('ship_method')) {
                    if ($this->request->getPost('ship_method')) {
                        if ($this->request->getPost('delivery_partner') == 'ship_roc') {

                            $get_response = $this->common->call_api_curl('https://apiv2.shiprocket.in/v1/external/auth/login?email=' . trim($_POST['ship_email']) . '&password=' . trim($_POST['ship_pwd']) . '', '', 'POST', '');
                            $new_res = json_decode($get_response);

                            if (isset($new_res->message)) {
                                if (isset($new_res->errors)) {
                                    echo json_encode($new_res->errors);
                                } else {
                                    echo $new_res->message;
                                }

                                // echo view('templates/apbrdgnew');
                            } else {
                                // echo "else";
                                $update_price = array(
                                    "email" => $this->request->getPost('ship_email'),
                                    "password" => $this->request->getPost('ship_pwd'),
                                    "channel_id" => $this->request->getPost('ship_chnl_id'),
                                    "created" => date('Y-m-d'),
                                    "shop_url" => $_REQUEST['shop'],
                                    "shiping_partner_type" => $this->request->getPost('delivery_partner'),
                                    "enable_shipping_type" => $this->request->getPost('delivery_partner'),

                                );
                                //print_r($update_price);
                                $this->user_model->shiprocket_config_db($update_price);
                                echo "Information successfully saved";
                                // echo "<script>top.window.location='https://admin.shopify.com/store/" . $this->shope_name . "/apps/pay-x-now-rest-on-delivery/public/index.php/shiprocket-config'</script>";
                            }
                        } else {
                            $update_price = array(
                                "token" => $this->request->getPost('ship_email'),
                                "shipping_address" => $this->request->getPost('shipping_address'),
                                "created" => date('Y-m-d'),
                                "shop_url" => $_REQUEST['shop'],
                                "shiping_partner_type" => $this->request->getPost('delivery_partner'),
                                "enable_shipping_type" => $this->request->getPost('delivery_partner'),

                            );
                            //print_r($update_price);
                            $this->user_model->shiprocket_config_db($update_price);
                            echo "Information successfully saved";
                        }

                        echo view('templates/apbrdgnew');
                    }
                }
                $data['shiprocket_info'] = $this->user_model->get_shiprocket_config_home($_GET['shop']);

                //order list info section
                if (!empty($data['shiprocket_info'])) {
                    $data['ship_provider'] = $data['shiprocket_info'][0]->shiping_partner_type;
                } else {
                    $data['ship_provider'] = "";
                }


                $get_details = $this->user_model->get_tokens($_GET['shop']);

                $all_orders = $this->common->rest_api('/admin/api/2023-01/orders.json?status=any&order=updated_at%20asc', array(), 'GET', $get_details->access_token, $_GET['shop']);

                if (!empty($all_orders)) {
                    //echo"aaa<pre>"; print_r($all_orders); echo"</pre>"; die();
                    $get_all_oders = json_decode($all_orders['body'], true);
                    $data['get_all_oders'] = $get_all_oders;

                    $orders_data = array();
                    $api_orders_data = array();
                    $orders_products_data = array();
                    $api_orders_products_data = array();
                    //echo"aaa<pre>"; print_r($get_all_oders); echo"</pre>";
                    foreach ($get_all_oders as $order) {
                        foreach ($order as $key => $value) {
                            if ($value['tags'] == 'partial') {
                                $orders_sts = 'pending';
                            } else {
                                $orders_sts = $value['financial_status'];
                            }
                            $orders_data = array(
                                "order_id" => $value['id'],
                                "order_status" => $orders_sts,
                                "order_ccy" => $value['currency'],
                                "order_date" => $value['created_at'],
                                "order_price" => $value['current_subtotal_price'],
                                "email" => $this->common->payxnow_encodedata($value['contact_email']),
                                "total_price" => $value['total_price'],
                                "shop_url" => $_GET['shop']
                            );
                            if (isset($value['shipping_address'])) {
                                $orders_data['shipping_address'] = $this->common->payxnow_encodedata($value['shipping_address']['address1']);
                                $orders_data['city'] = (isset($value['shipping_address']['city']) ? $this->common->payxnow_encodedata($value['shipping_address']['city']) : '');
                                $orders_data['state'] = (isset($value['shipping_address']['province']) ? $this->common->payxnow_encodedata($value['shipping_address']['province']) : '');
                                $orders_data['zip'] = (isset($value['shipping_address']['zip']) ? $this->common->payxnow_encodedata($value['shipping_address']['zip']) : '');
                                $orders_data['phone'] = (isset($value['shipping_address']['phone']) ? $this->common->payxnow_encodedata($value['shipping_address']['phone']) : '');
                                $orders_data['f_name'] = (isset($value['shipping_address']['first_name']) ? $this->common->payxnow_encodedata($value['shipping_address']['first_name']) : '');
                                $orders_data['l_name'] = (isset($value['shipping_address']['last_name']) ? $this->common->payxnow_encodedata($value['shipping_address']['last_name']) : '');
                                //$orders_data['email'] = (isset($value['shipping_address']['email']) ? $value['shipping_address']['email'] :'' );
                                $orders_data['country'] = (isset($value['shipping_address']['country']) ? $this->common->payxnow_encodedata($value['shipping_address']['country']) : '');
                            } else  if (isset($value['billing_address'])) {

                                $orders_data['shipping_address'] = $this->common->payxnow_encodedata($value['billing_address']['address1']);
                                $orders_data['city'] = (isset($value['billing_address']['city']) ? $this->common->payxnow_encodedata($value['billing_address']['city']) : '');
                                $orders_data['state'] = (isset($value['billing_address']['province']) ? $this->common->payxnow_encodedata($value['billing_address']['province']) : '');
                                $orders_data['zip'] = (isset($value['billing_address']['zip']) ? $value['billing_address']['zip'] : '');
                                $orders_data['phone'] = (isset($value['billing_address']['phone']) ? $this->common->payxnow_encodedata($value['billing_address']['phone']) : '');
                                $orders_data['f_name'] = (isset($value['billing_address']['first_name']) ? $this->common->payxnow_encodedata($value['billing_address']['first_name']) : '');
                                $orders_data['l_name'] = (isset($value['billing_address']['last_name']) ? $this->common->payxnow_encodedata($value['billing_address']['last_name']) : '');
                                //$orders_data['email'] = (isset($value['shipping_address']['email']) ? $value['shipping_address']['email'] :'' );
                                $orders_data['country'] = (isset($value['billing_address']['country']) ? $this->common->payxnow_encodedata($value['billing_address']['country']) : '');
                            }
                            // echo"<pre>"; print_r($orders_data); echo"</pre>";

                            $incid = $this->user_model->track_orders($orders_data, $_GET['shop']);
                            // echo $value['id'].'****************'.$incid;

                            // if ($incid == 1) {
                            $reaminming_price = array();
                            foreach ($value['line_items'] as $products) {
                                if ($products['name'] != "partial Pending Payment") {
                                    //echo"products<pre>"; print_r($products); echo"</pre>";
                                    if ($products['sku'] == "") {
                                        if (isset($products['properties'][3]['value'])) {
                                            $reaminming_price[] = $products['properties'][3]['value'];
                                            $prodycprice =  $products['properties'][3]['value'];
                                        } else {
                                            $reaminming_price[] = 0;
                                            $prodycprice =  0;
                                        }

                                        if (isset($products['properties'][4]['value'])) {
                                            $prosku = $products['properties'][4]['value'];
                                        } else {
                                            $prosku = 'PRTTESTSKY';
                                        }
                                    } else {
                                        $prosku = $products['sku'];
                                        $prodycprice =  0;
                                    }
                                    $orders_products_data = array(
                                        "order_id" => $value['id'],
                                        "product_id" => $products['id'],
                                        "product_name" => $products['name'],
                                        "product_price" => $prodycprice,
                                        "product_qty" => $products['quantity'],
                                        "product_sku" => $prosku,
                                        "shop_url" => $_GET['shop']
                                    );
                                    // echo "<pre>";
                                    // print_r($orders_products_data);
                                    // echo "</pre>";
                                    $this->user_model->track_orders_products($orders_products_data);
                                }
                            }

                            //}

                            $subtotal_update = array_sum($reaminming_price);
                            $this->user_model->update_order_subtotal($value['id'], $subtotal_update, $_GET['shop']);
                        }
                    }
                }

                $data['order_paging'] = isset($_REQUEST['order_paging']) && is_numeric($_REQUEST['order_paging']) ? $_REQUEST['order_paging'] : 1;

                $limit = 10;
                $data['orderlimit'] = $limit;
                $initial_page = ($data['order_paging'] - 1) * $limit;

                $order_list_c = $this->user_model->get_all_orders_totals($_GET['shop']);
                $total_orders_count = count($order_list_c);
                $data['total_pages'] = ceil($total_orders_count / $limit); //calculate total pages


                $data['order_list'] = $this->user_model->get_all_orders($_GET['shop'], $initial_page, $limit);
                //$data['shiprocket_info'] = $this->user_model->get_shiprocket_config($_GET['shop']);
                $data['plan_details'] = $this->user_model->get_store_plan($_GET['shop']);
                echo view('templates/header');
                echo view('welcome_message', $data);
                echo view('templates/footer');
                //return view('welcome_message');
            }
        } else {
            ob_start();
            header('HTTP/1.0 401 Unauthorized');
            echo '401 Unauthorized';
            exit;
        }
    }
    public function check_subscribe()
    {

        //$this->get_scan_count(); //call scan count api and update particular store

        $plan_details = $this->user_model->get_store_plan($_GET['shop']);
        if (empty($plan_details)) {
            echo "<script>top.window.location='https://admin.shopify.com/store/" . $this->shope_name . "/apps/pay-x-now-rest-on-delivery/price-plan'</script>";
            die();
        } else {
            if ($plan_details[0]->plan_name == 'basic' && $plan_details[0]->updated_sync_orders_count == 0) {
                echo "<script>top.window.location='https://admin.shopify.com/store/" . $this->shope_name . "/apps/pay-x-now-rest-on-delivery/price-plan'</script>";
                die();
            } else if ($plan_details[0]->plan_validity <= date('Y-m-d')) {
                echo "<script>top.window.location='https://admin.shopify.com/store/" . $this->shope_name . "/apps/pay-x-now-rest-on-delivery/price-plan'</script>";
                die();
            }
        }
    }
    public function assign_products_partial()
    {

        $this->check_subscribe();
        $data = array();
        $get_details = $this->user_model->get_tokens($_GET['shop']);

        // $getvareint_id = $this->common->rest_api('/admin/api/2023-01/products/8324807622954/variants.json', array(), 'GET', $get_details->access_token, $_GET['shop']);
        // $getvarrec = json_decode($getvareint_id['body'], true);

        // echo "getvarrec<pre>"; print_r($getvarrec); echo"</pre>";
        // print_r($this->request->getPost());
        $data['searctxt'] = "";
        if ($this->request->getPost('assign_save')) {
            // print_r($this->request->getPost());
            // echo view('templates/footer');
            // die();
            $get_updated_plan = $this->user_model->get_store_plane($_GET['shop']);
            //     echo "<pre>"; print_r($get_updated_plan); echo"</pre>";
            //    echo count($this->request->getPost('assign_pro')); die();
            if (!empty($this->request->getPost('assign_pro'))) {
                $total_synproduct = count($this->request->getPost('assign_pro'));
                if ($get_updated_plan[0]->updated_products_partial > $total_synproduct) {
                    foreach ($this->request->getPost('assign_pro') as $prokey => $product_id) {

                        //  echo "product_id" . $product_id;
                        $get_stored_percentage = $this->user_model->get_collection_percentage($_GET['shop']);
                        $collid = $_GET['collectionparms'];
                        if (isset($get_stored_percentage[$collid])) {
                            $col_pergs = $get_stored_percentage[$collid]['percentage'];
                        } else {
                            $col_pergs = 10;
                        }

                        $get_single_pro = $this->common->rest_api('/admin/api/2022-10/products/' . $product_id . '.json', array(), 'GET', $get_details->access_token, $_GET['shop']);
                        $product_details = json_decode($get_single_pro['body'], true);
                        // echo "<pre>"; print_r($product_details['product']['variants']); echo"</pre>";

                        $product_array = array(
                            "product_id" => $product_id,
                            "product_title" => $product_details['product']['title'],
                            "shop_url" => $_GET['shop'],
                            "partial_percentage" => $col_pergs,
                            "add_date" => date('Y-m-d'),
                            "collection_id" => $collid
                        );
                        $this->user_model->add_partial_products($product_array);

                        foreach ($product_details['product']['variants'] as $produc_varaien) {
                            $product_array = array(
                                "product_id" => $produc_varaien['product_id'],
                                "varient_id" => $produc_varaien['id'],
                                "title" => $produc_varaien['title'],
                                "price" => $produc_varaien['price'],
                                "partial_percentage" => $col_pergs,
                                "shop_url" => $_GET['shop'],
                                "collection_id" => $collid
                            );
                            $this->user_model->add_partial_products_varient($product_array);
                        }
                    }
                    $update_latest = array(
                        "latest_count" => $total_synproduct,
                        "shop_url" => $_GET['shop']
                    );
                    $this->user_model->track_lates_records($update_latest);

                    $this->user_model->update_plan_products($total_synproduct, $_GET['shop']);
                    echo "<script>top.window.location='https://admin.shopify.com/store/" . $this->shope_name . "/apps/pay-x-now-rest-on-delivery/partial-latest-products-list'</script>";
                } else {
                    echo "<script>alert('Please upgrade the plan'); top.window.location='https://admin.shopify.com/store/" . $this->shope_name . "/apps/pay-x-now-rest-on-delivery/products-list?collectionparms=" . $this->request->getPost('get_coll') . "'</script>";
                }
            } else {
                echo "<script>top.window.location='https://admin.shopify.com/store/" . $this->shope_name . "/apps/pay-x-now-rest-on-delivery/products-list?collectionparms=" . $this->request->getPost('get_coll') . "'</script>";
            }
            //  echo "<script>top.window.location='https://admin.shopify.com/store/" . $this->shope_name . "/apps/pay-x-now-rest-on-delivery/public/index.php/products-list?collectionparms=" . $this->request->getPost('get_coll') . "'</script>";

            // exit();
        }



        //get store collections
        $collections = $this->common->rest_api('/admin/api/2022-04/custom_collections.json', array(), 'GET', $get_details->access_token, $_GET['shop']);
        $collections = json_decode($collections['body'], true);
        $coll_array = array();
        foreach ($collections['custom_collections'] as $collection_list) {
            $coll_array = array(
                "collection_id" => $collection_list['id'],
                "collections_name" => $collection_list['title'],
                "shop_url" => $_GET['shop']

            );
            $this->user_model->track_collections($coll_array, $_GET['shop']);
        }

        $smart_collections = $this->common->rest_api('/admin/api/2022-10/smart_collections.json', array(), 'GET', $get_details->access_token, $_GET['shop']);

        $smart_collectionsget = json_decode($smart_collections['body'], true);
        $smart_coll_array = array();

        //track smart collection
        if (isset($smart_collectionsget['smart_collections']) && !empty($smart_collectionsget['smart_collections'])) {
            foreach ($smart_collectionsget['smart_collections'] as $collection_list) {
                $smart_coll_array = array(
                    "collection_id" => $collection_list['id'],
                    "collections_name" => $collection_list['title'],
                    "shop_url" => $_GET['shop']

                );

                $this->user_model->track_collections($smart_coll_array, $_GET['shop']);
            }
        }

        $get_store_collections = $this->user_model->get_collections($_GET['shop']);

        $parma_array = array("limit" => 50);

        if ((isset($_GET['collectionparms']) && $_GET['collectionparms'] != "")) {

            $colcturl = "/admin/api/2022-04/products.json";
            $data['checkcol'] = 'yes';
            // $products = $this->common->rest_api($colcturl, array("collection_id" => $_GET['collectionparms'], 'vendor' => $_GET['vendorname'], "limit" => 10), 'GET', $get_details->access_token, $_GET['shop']);

            // /"title"=>"Divya Is The Super Women",

            // $products = $this->common->rest_api($colcturl, array("collection_id" => $_GET['collectionparms'], "limit" => 10), 'GET', $get_details->access_token, $_GET['shop']);

            if ($this->request->getPost('search_text')) {
                // print_r($this->request->getPost());
                $params_array = array(
                    "collection_id" => $_GET['collectionparms'],
                    "limit" => 10,
                    "search_parms" => $this->request->getPost('search_text')
                );
                $data['searctxt'] = $this->request->getPost('search_text');
                $grapql_products_list = $this->common->getproductsgrapqlapi($params_array, $_GET['shop'], $get_details->access_token);
                $grapql_products_list_prodct = json_decode($grapql_products_list['body'], true);
            } else {
                $params_array = array(
                    "collection_id" => $_GET['collectionparms'],
                    "limit" => 10,
                    //"search_parms" => "Super Women"
                );
                $grapql_products_list = $this->common->getproductsgrapqlapi($params_array, $_GET['shop'], $get_details->access_token);
                $grapql_products_list_prodct = json_decode($grapql_products_list['body'], true);
            }

            //$product_list = json_decode($products['body'], true);
            if (isset($grapql_products_list_prodct['data']['collection'])) {
                $product_list = $grapql_products_list_prodct['data']['collection']['products'];
            } else {
                $product_list = $grapql_products_list_prodct['data']['products'];
            }
        } else {
            $product_list = array();
            $data['checkcol'] = 'no';
        }



        // echo "<pre>";
        // print_r($grapql_products_list_prodct);
        // echo "</pre>";

        // foreach ($product_list as $edge) {
        //     //foreach ($edge as $key => $value) {
        //     foreach ($edge as $key => $value) {
        //         //foreach ($node['node'] as $value) {
        //         echo "<pre>";
        //         print_r($value['node']);               
        //         echo "</pre>";
        //         echo $node['node']['id'];
        //         //}
        //     }
        //     // }
        // }
        // die();
        $data['get_part_list'] = $this->user_model->get_partial_productget($_GET['shop']);



        $data['products'] = $product_list;
        $data['get_store_collections'] = $get_store_collections;
        // if (!empty($product_list)) {
        //     $headers = $products['headers'];
        //     if (isset($headers['link'])) {
        //         $nextPageURL = $this->common->str_btwn($headers['link'], '<', '>');
        //         $nextPageURLparam = parse_url($nextPageURL);
        //         parse_str($nextPageURLparam['query'], $value);
        //         $data['page_info'] = $value['page_info'];
        //     }
        //     $data['headers_list'] = $headers;
        // }
        if (!empty($product_list)) {
            if (isset($grapql_products_list_prodct['data']['collection'])) {
                if (isset($grapql_products_list_prodct['data']['collection']['products']['pageInfo']['hasNextPage']) && $grapql_products_list_prodct['data']['collection']['products']['pageInfo']['hasNextPage'] == 1) {
                    $data['pagenewxt'] = $grapql_products_list_prodct['data']['collection']['products']['pageInfo']['endCursor'];
                }
            } else {
                if (isset($grapql_products_list_prodct['data']['products']['pageInfo']['hasNextPage']) && $grapql_products_list_prodct['data']['products']['pageInfo']['hasNextPage'] == 1) {
                    $data['pagenewxt'] = $grapql_products_list_prodct['data']['products']['pageInfo']['endCursor'];
                }
            }
        }
        $data['chart_details'] = array();
        if (isset($_GET['vid'])) {
            $data['chart_details'] = $this->user_model->get_store_chart($_GET['shop'], $_GET['vid']);
        }
        echo view('templates/header');
        echo view('partial_assign_products', $data);
        echo view('templates/footer');
    }

    public function show_partial_products()
    {
        $this->check_subscribe();
        $data = array();
        if (!isset($_GET['part_page'])) {
            $page_number = 1;
        } else {
            $page_number = $_GET['part_page'];
        }


        if (!empty($this->request->getPost('assign_remove_pro'))) {
            foreach ($this->request->getPost('assign_remove_pro') as $prokey => $product_id) {
                $this->user_model->update_plan_products_remove_part($_GET['shop']);
                $this->user_model->remove_partial_product($product_id, $_GET['shop']);
                echo "<script>alert('Product remove successfully'); top.window.location='https://admin.shopify.com/store/" . $this->shope_name . "/apps/pay-x-now-rest-on-delivery/partial-products-list'</script>";
            }
        }

        $data['part_page'] = isset($_REQUEST['part_page']) && is_numeric($_REQUEST['part_page']) ? $_REQUEST['part_page'] : 1;

        $limit = 10;
        $initial_page = ($data['part_page'] - 1) * $limit;
        $data['start_from'] = ($data['part_page'] - 1) * $limit + 1;
        $get_totals = $this->user_model->get_partial_product_list($_GET['shop']);
        $get_totals_num = count($get_totals);
        $data['total_pages'] = ceil($get_totals_num / $limit); //calculate total pages
        // $total_pages = ceil ($get_totals / $limit);  
        //echo "total_pages".$data['total_pages'];
        $data['get_list'] = $this->user_model->get_partial_product_list_pagina($_GET['shop'], $initial_page, $limit);

        $get_details = $this->user_model->get_tokens($_GET['shop']);


        //get store collections
        $collections = $this->common->rest_api('/admin/api/2022-04/custom_collections.json', array(), 'GET', $get_details->access_token, $_GET['shop']);
        $collections = json_decode($collections['body'], true);
        $coll_array = array();
        foreach ($collections['custom_collections'] as $collection_list) {
            $coll_array = array(
                "collection_id" => $collection_list['id'],
                "collections_name" => $collection_list['title'],
                "shop_url" => $_GET['shop']

            );
            $this->user_model->track_collections($coll_array, $_GET['shop']);
        }

        $smart_collections = $this->common->rest_api('/admin/api/2022-10/smart_collections.json', array(), 'GET', $get_details->access_token, $_GET['shop']);

        $smart_collectionsget = json_decode($smart_collections['body'], true);
        $smart_coll_array = array();

        //track smart collection
        if (isset($smart_collectionsget['smart_collections']) && !empty($smart_collectionsget['smart_collections'])) {
            foreach ($smart_collectionsget['smart_collections'] as $collection_list) {
                $smart_coll_array = array(
                    "collection_id" => $collection_list['id'],
                    "collections_name" => $collection_list['title'],
                    "shop_url" => $_GET['shop']

                );

                $this->user_model->track_collections($smart_coll_array, $_GET['shop']);
            }
        }

        $data['get_store_collections'] = $this->user_model->get_collections($_GET['shop']);
        $data['get_stored_percentage'] = $this->user_model->get_collection_percentage($_GET['shop']);

        // echo "<pre>";
        // print_r($data['get_stored_percentage']);
        // echo "</pre>";


        echo view('templates/header');
        echo view('partial_products_list', $data);
        echo view('templates/footer');
    }

    public function product_pagination()
    {


        $this->check_subscribe();
        $get_details = $this->user_model->get_tokens($_GET['url']);
        $get_part_list = $this->user_model->get_partial_productget($_GET['shop']);

        $shop_url = $_GET['url'];
        $rel = $_GET['rel'];
        $page_info = $_GET['page_info'];
        //get products 
        $page_array = array(
            'limit' => 5,
            'page_info' => $page_info,
            'rel' => $rel
        );

        if ($rel == "next") {

            if ($this->request->getPost('search_text')) {
                $params_array = array(
                    "collection_id" => $_GET['coll_id'],
                    "limit" => 5,
                    "nextpage_getpage" => $page_info,
                    "search_parms" => $this->request->getPost('search_text')
                );
                $grapql_products_list = $this->common->getproductsgrapqlapi($params_array, $_GET['shop'], $get_details->access_token);
                $grapql_products_list_prodct = json_decode($grapql_products_list['body'], true);
            } else {
                $params_array = array(
                    "collection_id" => $_GET['coll_id'],
                    "limit" => 5,
                    "nextpage_getpage" => $page_info
                );
                $grapql_products_list = $this->common->getproductsgrapqlapi($params_array, $_GET['shop'], $get_details->access_token);
                $grapql_products_list_prodct = json_decode($grapql_products_list['body'], true);
            }
        } else if ($rel == "previous") {
            if ($this->request->getPost('search_text')) {
                $params_array = array(
                    "collection_id" => $_GET['coll_id'],
                    "limit" => 5,
                    "prev_getpage" => $page_info,
                    "search_parms" => $this->request->getPost('search_text')
                );
                $grapql_products_list = $this->common->getproductsgrapqlapi($params_array, $_GET['shop'], $get_details->access_token);
                $grapql_products_list_prodct = json_decode($grapql_products_list['body'], true);
            } else {

                $params_array = array(
                    "collection_id" => $_GET['coll_id'],
                    "limit" => 10,
                    "prev_getpage" => $page_info,
                );
                $grapql_products_list = $this->common->getproductsgrapqlapi($params_array, $_GET['shop'], $get_details->access_token);
                $grapql_products_list_prodct = json_decode($grapql_products_list['body'], true);
            }
        }
        // echo "<pre>";
        // print_r($grapql_products_list_prodct);
        // echo "<pre>";
        // die();
        // $products = $this->common->rest_api('/admin/api/2022-04/products.json', $page_array, 'GET', $get_details->access_token, $shop_url);
        if (isset($grapql_products_list_prodct['data']['collection'])) {
            $product_list = $grapql_products_list_prodct['data']['collection']['products'];
        } else {
            $product_list = $grapql_products_list_prodct['data']['products'];
        }

        //$product_list = $grapql_products_list_prodct['data']['collection']['products'];
        // echo "<pre>";
        // print_r($product_list);
        // echo "<pre>";
        // $headers = $products['headers'];
        // $link_array = array();
        // if (strpos($headers['link'], ',')  !== false) {
        //     $link_array = explode(',', $headers['link']);
        // } else {
        //     $link = $headers['link'];
        // }

        //Create variables for the new page infos

        $prev_link = '';
        $next_link = '';
        //Check if the $link_array variable's size is more than one

        // if (sizeof($link_array) > 1) {
        //     $prev_link = $link_array[0];
        //     $prev_link = $this->common->str_btwn($prev_link, '<', '>');
        //     $param = parse_url($prev_link);
        //     parse_str($param['query'], $prev_link);
        //     $prev_link = $prev_link['page_info'];
        //     $next_link = $link_array[1];
        //     $next_link = $this->common->str_btwn($next_link, '<', '>');
        //     $param = parse_url($next_link);
        //     parse_str($param['query'], $next_link);
        //     $next_link = $next_link['page_info'];
        // } else {
        //     $rel = explode(";", $headers['link']);
        //     $rel = $this->common->str_btwn($rel[1], '"', '"');
        //     if ($rel == "previous") {
        //         $prev_link = $link;
        //         $prev_link = $this->common->str_btwn($prev_link, '<', '>');
        //         $param = parse_url($prev_link);
        //         parse_str($param['query'], $prev_link);
        //         $prev_link = $prev_link['page_info'];
        //         $next_link = "";
        //     } else {
        //         $next_link = $link;
        //         $next_link = $this->common->str_btwn($next_link, '<', '>');
        //         $param = parse_url($next_link);
        //         parse_str($param['query'], $next_link);
        //         $next_link = $next_link['page_info'];
        //         $prev_link = "";
        //     }
        // }
        $html = '';
        // $products = json_decode($products['data'], true);
        foreach ($product_list as $edge) {
            //foreach ($product as $key => $value) {
            // if (!in_array($value['id'], $get_part_list)) {
            foreach ($edge as $value) {
                if (isset($value['node'])) {
                    $prodctid = str_replace("gid://shopify/Product/", "", $value['node']['id']);
                    if (!in_array($prodctid, $get_part_list)) {
                        $partiall_added = "Not Added";
                        $partiall_added2 = "not_added";
                        $cls = "text-red";
                    } else {
                        $partiall_added = "Added";
                        $partiall_added2 = "added";
                        $cls = "text-green";
                    }

                    // $image = count($value['images']) > 0 ? $value['images'][0]['src'] : "";

                    $html .= '<tr>';
                    $html .= '<td><input class="chkSelect" dattatrr="' . esc($partiall_added2) . '" type="checkbox" name="assign_pro[]" value="' . esc($prodctid) . '"></td>';
                    $html .= '<td>' . $prodctid . '</td>';
                    $html .= '<td>' . $value['node']['title'] . '</td>';
                    $html .= '<td class="' . $cls . '">' . $partiall_added . '</td>';
                }
            }
            // }
            //}
        }
        if (!empty($product_list)) {

            if (isset($grapql_products_list_prodct['data']['collection'])) {
                if (isset($grapql_products_list_prodct['data']['collection']['products']['pageInfo']['hasNextPage']) && $grapql_products_list_prodct['data']['collection']['products']['pageInfo']['hasNextPage'] == 1) {
                    $next_link = $grapql_products_list_prodct['data']['collection']['products']['pageInfo']['endCursor'];
                }

                if (isset($grapql_products_list_prodct['data']['collection']['products']['pageInfo']['hasPreviousPage']) && $grapql_products_list_prodct['data']['collection']['products']['pageInfo']['hasPreviousPage'] == 1) {
                    $prev_link = $grapql_products_list_prodct['data']['collection']['products']['pageInfo']['startCursor'];
                }
            } else {
                if (isset($grapql_products_list_prodct['data']['products']['pageInfo']['hasNextPage']) && $grapql_products_list_prodct['data']['products']['pageInfo']['hasNextPage'] == 1) {
                    $next_link = $grapql_products_list_prodct['data']['products']['pageInfo']['endCursor'];
                }

                if (isset($grapql_products_list_prodct['data']['products']['pageInfo']['hasPreviousPage']) && $grapql_products_list_prodct['data']['products']['pageInfo']['hasPreviousPage'] == 1) {
                    $prev_link = $grapql_products_list_prodct['data']['products']['pageInfo']['startCursor'];
                }
            }
        }
        echo json_encode(array('prev' => $prev_link, 'next' => $next_link, 'html' => $html));
        //echo json_encode(array('prev' => $page_info, 'next' => $page_info, 'html' => $html));
    }
    public function product_pagination2()
    {
        $this->check_subscribe();
        $get_details = $this->user_model->get_tokens($_GET['url']);
        $get_part_list = $this->user_model->get_partial_productget($_GET['shop']);

        $shop_url = $_GET['url'];
        $rel = $_GET['rel'];
        $page_info = $_GET['page_info'];
        //get products 
        $page_array = array(
            'limit' => 10,
            'page_info' => $page_info,
            'rel' => $rel
        );

        $products = $this->common->rest_api('/admin/api/2022-04/products.json', $page_array, 'GET', $get_details->access_token, $shop_url);
        $product_list = json_decode($products['body'], true);
        $headers = $products['headers'];
        $link_array = array();
        if (strpos($headers['link'], ',')  !== false) {
            $link_array = explode(',', $headers['link']);
        } else {
            $link = $headers['link'];
        }

        //Create variables for the new page infos

        $prev_link = '';
        $next_link = '';
        //Check if the $link_array variable's size is more than one

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
        } else {
            $rel = explode(";", $headers['link']);
            $rel = $this->common->str_btwn($rel[1], '"', '"');
            if ($rel == "previous") {
                $prev_link = $link;
                $prev_link = $this->common->str_btwn($prev_link, '<', '>');
                $param = parse_url($prev_link);
                parse_str($param['query'], $prev_link);
                $prev_link = $prev_link['page_info'];
                $next_link = "";
            } else {
                $next_link = $link;
                $next_link = $this->common->str_btwn($next_link, '<', '>');
                $param = parse_url($next_link);
                parse_str($param['query'], $next_link);
                $next_link = $next_link['page_info'];
                $prev_link = "";
            }
        }
        $html = '';
        // $products = json_decode($products['data'], true);
        foreach ($product_list as $product) {
            foreach ($product as $key => $value) {
                // if (!in_array($value['id'], $get_part_list)) {

                if (!in_array($value['id'], $get_part_list)) {
                    $partiall_added = "Not Added";
                    $partiall_added2 = "not_added";
                    $cls = "payxnowandrestondelivery-text-red";
                } else {
                    $partiall_added = "Added";
                    $partiall_added2 = "added";
                    $cls = "payxnowandrestondelivery-text-green";
                }

                // $image = count($value['images']) > 0 ? $value['images'][0]['src'] : "";

                $html .= '<tr>';
                $html .= '<td><input class="chkSelect" dattatrr="' . esc($partiall_added2) . '" type="checkbox" name="assign_pro[]" value="' . esc($value['id']) . '"></td>';
                $html .= '<td>' . $value['id'] . '</td>';
                $html .= '<td>' . $value['title'] . '</td>';
                $html .= '<td class="' . $cls . '">' . $partiall_added . '</td>';
            }
            //}
        }
        echo json_encode(array('prev' => $prev_link, 'next' => $next_link, 'html' => $html));
    }
    public function show_latest_partial_products()
    {
        $this->check_subscribe();
        $data = array();

        $get_datalates = $this->user_model->get_lates_records($_GET['shop']);

        $limit = $get_datalates[0]->latest_count;
        $get_totals = $this->user_model->get_partial_product_list($_GET['shop']);
        $get_totals_num = count($get_totals);
        $data['total_pages'] = ceil($get_totals_num / $limit); //calculate total pages
        // $total_pages = ceil ($get_totals / $limit);  
        //echo "total_pages".$data['total_pages'];
        $data['get_list'] = $this->user_model->get_partial_product_list_pagina($_GET['shop'], 0, $limit);

        // echo "<pre>";
        // print_r($get_datalates);
        // echo "</pre>";


        echo view('templates/header');
        echo view('partial_lates_products_list', $data);
        echo view('templates/footer');
    }

    public function track_partial_percentage()
    {
        //$this->check_subscribe();
        $data = array();
        if ($this->request->getPost('update_per')) {
            // print_r($this->request->getPost());
            // die();
            $update_price = array(
                "partial_percentage" => $this->request->getPost('change_partial'),
                "id" => $this->request->getPost('update_id'),
                "shop_url" => $_REQUEST['shop']

            );
            $this->user_model->update_partial_percentage($update_price, $this->request->getPost('proid'));
            echo $this->request->getPost('change_partial');
            // echo "<script>top.window.location='https://admin.shopify.com/store/" . $this->shope_name . "/apps/pay-x-now-rest-on-delivery/public/index.php/partial-products-list'</script>";
            //echo view('templates/apbrdgnew');
        }
        // echo view('templates/apbrdgnew');
    }

    public function collection_track_partial_percentage()
    {
        //$this->check_subscribe();
        $data = array();
        if ($this->request->getPost('update_per')) {
            // print_r($this->request->getPost());
            // die();
            $update_price = array(
                "partial_percentage" => $this->request->getPost('colltion_change_partial'),
                "collection_id" => $this->request->getPost('colltion_change_partial_id'),
                "shop_url" => $_REQUEST['shop'],
                "movements" => date('Y-m-d'),

            );
            $this->user_model->update_collection_partial_percentage($update_price, $this->request->getPost('proid'));
            echo $this->request->getPost('colltion_change_partial_id');
            // echo "<script>top.window.location='https://admin.shopify.com/store/" . $this->shope_name . "/apps/pay-x-now-rest-on-delivery/public/index.php/partial-products-list'</script>";
            //echo view('templates/apbrdgnew');
        }
        // echo view('templates/apbrdgnew');
    }

    public function show_all_orders()
    {
        $this->check_subscribe();
        $data = array();
        $myCommon = new Common();
        $data['myCommon'] = $myCommon;
        $get_details = $this->user_model->get_tokens($_GET['shop']);
        // $this->user_model->testinsert();
        //$get_data = $this->user_model->get_order_detail('5413624381738');
        //echo"<pre>"; print_r($get_data); echo "</pre>";

        $all_orders = $this->common->rest_api('/admin/api/2023-01/orders.json?status=any&order=updated_at%20asc', array(), 'GET', $get_details->access_token, $_GET['shop']);
        // echo"aaa<pre>"; print_r($all_orders); echo"</pre>"; die();
        if (!empty($all_orders)) {
            // echo"aaa<pre>"; print_r($all_orders); echo"</pre>"; die();
            $get_all_oders = json_decode($all_orders['body'], true);
            // $data['get_all_oders'] = $get_all_oders;
            // echo "aaa<pre>";
            // print_r($get_all_oders);
            // echo "</pre>";
            // die();

            $orders_data = array();
            $api_orders_data = array();
            $orders_products_data = array();
            $api_orders_products_data = array();

            foreach ($get_all_oders as $order) {
                foreach ($order as $key => $value) {
                    // if ($value['tags'] != '') {
                    //if ($value['tags'] != '') {




                    // if ($value['tags'] != '') {
                    //     $orders_sts = 'pending';
                    //     $pendingamntnnn = explode("_", $value['tags']);
                    //     $pendingamnt = $pendingamntnnn[1];
                    // } else {
                    //     if ($value['financial_status'] == "pending") {
                    //         $orders_sts = "cod";
                    //         $pendingamnt = $value['total_price'];
                    //     } else {
                    //         $orders_sts = $value['financial_status'];
                    //         $pendingamnt = 0;
                    //     }
                    // }
                    echo "<pre>"; print_r($value); echo"</pre>";
                    if ($value['financial_status'] == "paid") {

                        $orders_sts = $value['financial_status'];
                        $pendingamnt = 0;
                    } else {
                        if ($value['tags'] != '') {
                            $orders_sts = 'pending';
                            $pendingamntnnn = explode("_", $value['tags']);
                            if (isset($pendingamntnnn[1])) {
                                $pendingamnt = $pendingamntnnn[1];
                            } else {
                                $pendingamnt = 0;
                            }
                        } else {
                            $orders_sts = "cod";
                            $pendingamnt = $value['total_price'];
                        }
                    }



                    if (empty($value['fulfillments'])) {
                        $fullmenststs = "Unfulfilled";
                    } else {
                        $fullmenststs = "fulfilled";
                    }
                    $orders_data = array(
                        "order_id" => $value['id'],
                        "order_number" => $value['order_number'],
                        "order_status" => $orders_sts,
                        "order_ccy" => $value['currency'],
                        "order_date" => $value['created_at'],
                        "order_price" => $value['current_subtotal_price'],
                        "email" => $this->common->payxnow_encodedata($value['contact_email']),
                        "total_price" => $value['total_price'],
                        "pending_amount" => $pendingamnt,
                        "shop_url" => $_GET['shop'],
                        "fullfilment_status" => $fullmenststs
                    );
                    if (isset($value['shipping_address'])) {
                        $orders_data['shipping_address'] = $this->common->payxnow_encodedata($value['shipping_address']['address1']);
                        $orders_data['city'] = (isset($value['shipping_address']['city']) ? $this->common->payxnow_encodedata($value['shipping_address']['city']) : '');
                        $orders_data['state'] = (isset($value['shipping_address']['province']) ? $this->common->payxnow_encodedata($value['shipping_address']['province']) : '');
                        $orders_data['zip'] = (isset($value['shipping_address']['zip']) ? $value['shipping_address']['zip'] : '');
                        $orders_data['phone'] = (isset($value['shipping_address']['phone']) ? $this->common->payxnow_encodedata($value['shipping_address']['phone']) : '');
                        $orders_data['f_name'] = (isset($value['shipping_address']['first_name']) ? $this->common->payxnow_encodedata($value['shipping_address']['first_name']) : '');
                        $orders_data['l_name'] = (isset($value['shipping_address']['last_name']) ? $this->common->payxnow_encodedata($value['shipping_address']['last_name']) : '');
                        //$orders_data['email'] = (isset($value['shipping_address']['email']) ? $value['shipping_address']['email'] :'' );
                        $orders_data['country'] = (isset($value['shipping_address']['country']) ? $this->common->payxnow_encodedata($value['shipping_address']['country']) : '');
                    } else  if (isset($value['billing_address'])) {

                        $orders_data['shipping_address'] = $this->common->payxnow_encodedata($value['billing_address']['address1']);
                        $orders_data['city'] = (isset($value['billing_address']['city']) ? $this->common->payxnow_encodedata($value['billing_address']['city']) : '');
                        $orders_data['state'] = (isset($value['billing_address']['province']) ? $this->common->payxnow_encodedata($value['billing_address']['province']) : '');
                        $orders_data['zip'] = (isset($value['billing_address']['zip']) ? $value['billing_address']['zip'] : '');
                        $orders_data['phone'] = (isset($value['billing_address']['phone']) ? $this->common->payxnow_encodedata($value['billing_address']['phone']) : '');
                        $orders_data['f_name'] = (isset($value['billing_address']['first_name']) ? $this->common->payxnow_encodedata($value['billing_address']['first_name']) : '');
                        $orders_data['l_name'] = (isset($value['billing_address']['last_name']) ? $this->common->payxnow_encodedata($value['billing_address']['last_name']) : '');
                        //$orders_data['email'] = (isset($value['shipping_address']['email']) ? $value['shipping_address']['email'] :'' );
                        $orders_data['country'] = (isset($value['billing_address']['country']) ? $this->common->payxnow_encodedata($value['billing_address']['country']) : '');
                    }
                    //echo"orders_data<pre>"; print_r($orders_data); echo"</pre>";

                    $incid = $this->user_model->track_orders($orders_data, $_GET['shop']);
                    //echo $value['id'] . '****************' . $incid;

                    // if ($incid == 1) {
                    $reaminming_price = array();
                    foreach ($value['line_items'] as $products) {
                        if ($products['name'] != "partial Pending Payment") {
                            if ($products['sku'] == "") {
                                if (isset($products['properties'][3]['value'])) {
                                    $reaminming_price[] = $products['properties'][3]['value'];
                                    $prodycprice =  $products['properties'][3]['value'];
                                } else {
                                    $reaminming_price[] = 0;
                                    $prodycprice = 0;
                                }
                                if (isset($products['properties'][4]['value'])) {
                                    $prosku = $products['properties'][4]['value'];
                                } else {
                                    $prosku = 'PRTTESTSKY';
                                }
                            } else {
                                $prosku = $products['sku'];
                                $prodycprice =  $products['price'];
                            }
                            $orders_products_data = array(
                                "order_id" => $value['id'],
                                "product_id" => $products['id'],
                                "product_name" => $products['name'],
                                "product_price" => $prodycprice,
                                "product_qty" => $products['quantity'],
                                "product_sku" => $prosku,
                                "shop_url" => $_GET['shop']
                            );
                            // echo "orders_products_data<pre>";
                            // print_r($orders_products_data);
                            // echo "</pre>";
                            $this->user_model->track_orders_products($orders_products_data);
                        }
                    }

                    //}

                    $subtotal_update = array_sum($reaminming_price);
                    $this->user_model->update_order_subtotal($value['id'], $subtotal_update, $_GET['shop']);
                    //}
                }
            }
        }

        $data['order_paging'] = isset($_REQUEST['order_paging']) && is_numeric($_REQUEST['order_paging']) ? $_REQUEST['order_paging'] : 1;

        $limit = 25;
        $data['orderlimit'] = $limit;
        $initial_page = ($data['order_paging'] - 1) * $limit;

        $order_list_c = $this->user_model->get_all_orders_totals($_GET['shop']);
        $total_orders_count = count($order_list_c);
        $data['total_pages'] = ceil($total_orders_count / $limit); //calculate total pages


        $data['order_list'] = $this->user_model->get_all_orders($_GET['shop'], $initial_page, $limit);
        $data['shiprocket_info'] = $this->user_model->get_shiprocket_config_home($_GET['shop']);
        $data['plan_details'] = $this->user_model->get_store_plan($_GET['shop']);
        echo view('templates/header');
        echo view('all_orders', $data);
        echo view('templates/footer');
    }
    function order_sync()
    {

        $this->check_subscribe();
        //$this->order_sync_delhivery();
        $shiprocket_info = $this->user_model->get_shiprocket_config_home($_GET['shop']);
        //print_r($shiprocket_info);
        $initpage = $_REQUEST['ordpage'] - 1;

        if (isset($shiprocket_info[0]->enable_shipping_type) && $shiprocket_info[0]->enable_shipping_type == 'ship_roc') {
            $get_resulsts = $this->user_model->get_token($_GET['shop']);
            // print_r($get_resulsts);
            if (empty($get_resulsts)) {
                $store_token = $this->update_token($_GET['shop']);
            } else {
                $store_token = $get_resulsts[0]->token;
            }

            $get_all_ordersnew = $this->user_model->get_products_orders($_GET['shop'], $initpage, $_REQUEST['orderlimit']);

            $create_custom = array();
            $syncorderscount = array();

            $return_array = array();
            // echo "change<pre>";
            // print_r($get_all_ordersnew);
            // echo "</pre>";
            foreach ($get_all_ordersnew as $set_orders) {



                //    if ($set_orders[0]['shipping_address'] != "" && $set_orders[0]['shipping_city'] != "" && $set_orders[0]['state'] != "" && $set_orders[0]['zip'] != "" && $set_orders[0]['country'] != "") {

                if ($set_orders[0]['phone'] == "") {
                    $phnum = "9865986598";
                } else {
                    $phnum = str_replace(" ", "", $this->common->payxnow_decodedata($set_orders[0]['phone']));
                    $phnum = str_replace("(", "", $phnum);
                    $phnum = str_replace(")", "", $phnum);
                    $phnum = str_replace("-", "", $phnum);
                }
                if ($set_orders[0]['cust_fname'] == "") {
                    $username = $set_orders[0]['cust_lname'];
                }
                if ($set_orders[0]['cust_lname'] == "") {
                    $username = $set_orders[0]['cust_fname'];
                }

                if ($set_orders[0]['order_status'] == 'paid') {
                    $shipping_pay_method = "Prepaid";
                    $shipping_pay_amount = $set_orders[0]['total_price'];
                } else  if ($set_orders[0]['order_status'] == 'cod') {
                    $shipping_pay_method = "COD";
                    $shipping_pay_amount = $set_orders[0]['total_price'];
                } else {
                    $shipping_pay_method = "Partial";
                    $shipping_pay_amount = $set_orders[0]['order_price'];
                }
                $create_custom = array(
                    "order_id" => $set_orders[0]['order_number'],
                    //"order_id" => "1025",
                    "order_date" => $set_orders[0]['order_date'],
                    "channel_id" => $shiprocket_info[0]->channel_id,
                    "comment" => $shipping_pay_method,
                    "billing_customer_name" => $this->common->payxnow_decodedata($set_orders[0]['cust_fname']),
                    "billing_last_name" => $this->common->payxnow_decodedata($set_orders[0]['cust_lname']),
                    "billing_address" => $this->common->payxnow_decodedata($set_orders[0]['shipping_address']),
                    "billing_city" => $this->common->payxnow_decodedata($set_orders[0]['shipping_city']),
                    "billing_pincode" => $set_orders[0]['zip'],
                    "billing_state" => $this->common->payxnow_decodedata($set_orders[0]['state']),
                    "billing_country" => $this->common->payxnow_decodedata($set_orders[0]['country']),
                    "billing_email" => $this->common->payxnow_decodedata($set_orders[0]['email']),
                    "billing_phone" => $phnum,
                    "shipping_is_billing" => true,
                    "payment_method" => $shipping_pay_method,
                    "sub_total" => $shipping_pay_amount,
                    "length" => 1,
                    "breadth" => 1,
                    "height" => 1,
                    "weight" => 1,
                );


                foreach ($set_orders['items'] as $products) {
                    if ($products['name'] != 'partial Pending Payment') {
                        $create_custom['order_items'][] = array(
                            "name" => $products['name'],
                            "sku" => $products['sku'],
                            "units" => $products['qty'],
                            "selling_price" => $products['price'],
                        );
                    }
                }
                // echo "set_orders<pre>";
                // print_r($set_orders);
                // echo "</pre>";


                // echo "create_custom<pre>";
                // print_r($create_custom);
                // echo "</pre>";
                // die(); 
                //echo json_encode($create_custom);
                //echo "store_token=".$store_token;

                $get_result = $this->common->create_custom_order($create_custom, $store_token);
                $decoded_res = json_decode($get_result);


                // echo "<pre>";
                // print_r($set_orders);
                // echo "</pre>";

                // echo "decoded_res<pre>";
                // print_r($decoded_res);
                // echo "</pre>";

                if (isset($decoded_res->message) && $decoded_res->message != "") {
                    // echo $set_orders[0]['order_id'];
                    // //echo "error";
                    // echo $decoded_res->errors;
                    if (isset($decoded_res->errors)) {
                        $senderror = $decoded_res->errors;
                        $return_array['error'][] = array("error" => $senderror);
                        $shperr =  serialize($decoded_res->errors);
                    } else {
                        $shperr =  $decoded_res->message;
                        $return_array['error'][] = array("error" => $shperr);
                    }

                    //$getaeeros = json_encode($decoded_res->errors);
                    // if (isset($decoded_res->errors->billing_phone[0])) {
                    // $shperr =  $decoded_res->errors->billing_phone[0];

                    //} else {
                    // $shperr = "";
                    // }
                    //echo $shperr;
                    $this->user_model->update_shiprocket_err($set_orders[0]['order_id'], $_GET['shop'], $shperr);
                } else {
                    $syncorderscount[] = $set_orders[0]['order_id'];
                    $this->user_model->track_sync_order($set_orders[0]['order_id'], $_GET['shop']);
                    $return_array['success'][] = array("success" => "order sync successfully for order " . $set_orders[0]['order_id']);
                }

                // } else {
                //     echo "no-data";
                // }
            }
            // echo "<pre>";
            // print_r($syncorderscount);
            // echo "</pre>";
            if (!empty($syncorderscount)) {
                echo count($syncorderscount);
                $this->user_model->update_plan_orders(count($syncorderscount), $_GET['shop']);
            }
            return json_encode($return_array);
        } else  if (isset($shiprocket_info[0]->enable_shipping_type) && $shiprocket_info[0]->enable_shipping_type == 'pickr') {
            $this->order_sync_pickrr($shiprocket_info);
        } else  if (isset($shiprocket_info[0]->enable_shipping_type) && $shiprocket_info[0]->enable_shipping_type == 'delhivery') {
            //echo "delhoivery";
            $this->order_sync_delhivery($shiprocket_info);
        }
    }
    function order_sync_pickrr($shiprocket_info)
    {

        $get_resulsts = $this->user_model->get_token($_GET['shop']);
        $initpage = $_REQUEST['ordpage'] - 1;
        $get_all_orderspickrr = $this->user_model->get_products_orders_pickrr($initpage, $_REQUEST['ordpage'], $_REQUEST['orderlimit']);

        $new_return_array = array();
        $syncorderscount = array();

        //print_r($get_all_orderspickrr); 
        foreach ($get_all_orderspickrr as $set_orders) {

            $create_custom = array();
            $create_customqty = array();
            $item_listarr = array();
            foreach ($set_orders['items'] as $products) {
                $create_custom[] = $products['name'];
                $create_customqty[] = $products['qty'];
                $item_listarr[] = array(
                    "price" => $products['price'],
                    "item_name" => $products['name'],
                    "quantity" => $products['qty'],
                    "sku" => $products['sku'],
                );
            }

            if (!empty($create_custom)) {
                $order_name = implode(",", $create_custom);
                $order_name_count = count($create_customqty);
            }

            if ($set_orders[0]['phone'] == "") {
                $phnum = "9865986598";
            } else {
                $fetch_phone = $this->common->payxnow_decodedata($set_orders[0]['phone']);
                $phnum = str_replace(" ", "", $fetch_phone);
                $phnum = str_replace("(", "", $phnum);
                $phnum = str_replace(")", "", $phnum);
                $phnum = str_replace("-", "", $phnum);
            }
            // print_r($item_listarr);
            // echo "jsondata".json_encode($item_listarr);
            if ($set_orders[0]['order_status'] == 'paid') {
                $shipping_pay_method = "Prepaid";
                $shipping_pay_amount = $set_orders[0]['total_price'];
                $shipping_pay_amount1 = 0;
            } else  if ($set_orders[0]['order_status'] == 'cod') {
                $shipping_pay_method = "COD";
                $shipping_pay_amount = $set_orders[0]['total_price'];
                $shipping_pay_amount1 = $set_orders[0]['total_price'];
            } else {
                $shipping_pay_method = "Partial";
                $shipping_pay_amount = $set_orders[0]['order_price'];
                $shipping_pay_amount1 = $set_orders[0]['order_price'];
            }



            $post_params = array(
                'auth_token' => $shiprocket_info[0]->shp_token,
                'item_name' => $order_name,
                'item_list' => json_encode($item_listarr),
                'from_name' => $shiprocket_info[0]->pickrr_company,
                'from_phone_number' => $shiprocket_info[0]->pickrr_from_phone,
                'from_address' => $shiprocket_info[0]->shipping_address,
                'from_pincode' => $shiprocket_info[0]->pickrr_pincode,
                'to_name' =>  $this->common->payxnow_decodedata($set_orders[0]['cust_fname']) . ' ' . $this->common->payxnow_decodedata($set_orders[0]['cust_lname']),
                'to_phone_number' => $phnum,
                //'to_phone_number' => '9996242898',
                'to_pincode' => $set_orders[0]['zip'],
                //'to_pincode' => '132157',
                'to_address' => $this->common->payxnow_decodedata($set_orders[0]['shipping_address']),
                'quantity' => $order_name_count,
                'invoice_value' => $shipping_pay_amount,
                'cod_amount' => $shipping_pay_amount1,
                'client_order_id' => $set_orders[0]['order_number'],
                'item_breadth' => 1,
                'item_length' => 1,
                'item_height' => 1,
                'item_weight' => 0.5,
                'is_reverse' => false
            );

            try {
                $json_params = json_encode($post_params);
                $url = 'https://www.pickrr.com/api/place-order/';
                //open connection
                $ch = curl_init();
                //set the url, number of POST vars, POST data
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json_params);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                //execute post
                $result = curl_exec($ch);
                $result = json_decode($result, true);

                //close connection
                // print_r($set_orders);
                // print_r($result);

                curl_close($ch);

                if (isset($result['err'])) {
                    // echo "i if";
                    // echo $set_orders[0]['order_id'];
                    $new_return_array[$set_orders[0]['order_id']][] = $result['err'];

                    $this->user_model->update_pickr_err($set_orders[0]['order_id'], $_GET['shop'], substr($result['err'], 0, 48) . ' missing');
                } else {
                    //    echo "else";
                    //    echo $set_orders[0]['order_id'];
                    $syncorderscount[] = $set_orders[0]['order_id'];
                    $this->user_model->update_pickrr_order($set_orders[0]['order_id'], $_GET['shop']);
                    $new_return_array[$set_orders[0]['order_id']][] = 'Sync Done';
                }
            } catch (\Exception $e) {
                $new_return_array[] = $e;
            }
        }
        if (!empty($syncorderscount)) {
            echo count($syncorderscount);
            $this->user_model->update_plan_orders(count($syncorderscount), $_GET['shop']);
        }
        // print_r($new_return_array);
        return json_encode($new_return_array);
    }

    function order_sync_delhivery($shiprocket_info)
    {

        $get_resulsts = $this->user_model->get_token($_REQUEST['shop']);
        $initpage = $_REQUEST['ordpage'] - 1;
        $get_all_ordersdelhivery = $this->user_model->get_products_orders_delhivery($_REQUEST['shop'], $initpage, $_REQUEST['orderlimit']);

        $return_array = array();
        $syncorderscount = array();
        foreach ($get_all_ordersdelhivery as $set_orders) {

            $create_custom = array();
            foreach ($set_orders['items'] as $products) {
                $create_custom[] = $products['name'];
            }

            if (!empty($create_custom)) {
                $order_name = implode(",", $create_custom);
                $order_name_count = count($create_custom);
            }

            // $post_params = array(
            //     'auth_token' => '88596e7da4cb8da8fe5ad2ac6ff3acee854253',
            //     'item_name' => $order_name,
            //     'from_name' => 'Designomate',
            //     'from_phone_number' => '9996242898',
            //     'from_address' => 'A - 130 , 91 SPRINGBOARD , SECTOR 63 , NOIDA , Gautam Buddha Nagar , Uttar Pradesh',
            //     'from_pincode' => '201302',
            //     'to_name' =>  $set_orders[0]['cust_fname'] . ' ' . $set_orders[0]['cust_lname'],
            //     'to_phone_number' => $set_orders[0]['phone'],
            //     //'to_phone_number' => '9996242898',
            //     'to_pincode' => $set_orders[0]['zip'],
            //     //'to_pincode' => '132157',
            //     'to_address' => $set_orders[0]['shipping_address'],
            //     'quantity' => $order_name_count,
            //     'invoice_value' => $set_orders[0]['order_price'],
            //     'cod_amount' => $set_orders[0]['order_price'],
            //     'client_order_id' => $set_orders[0]['order_id'],
            //     'item_breadth' => 1,
            //     'item_length' => 1,
            //     'item_height' => 1,
            //     'item_weight' => 0.5,
            //     'is_reverse' => false
            // );

            if ($set_orders[0]['order_status'] == 'paid') {
                $shipping_pay_method = "Prepaid";
                $shipping_pay_amount = $set_orders[0]['total_price'];
            } else  if ($set_orders[0]['order_status'] == 'cod') {
                $shipping_pay_method = "Postpaid";
                $shipping_pay_amount = $set_orders[0]['total_price'];
            } else {
                $shipping_pay_method = "Postpaid";
                $shipping_pay_amount = $set_orders[0]['order_price'];
            }



            if ($set_orders[0]['phone'] == "") {
                $phnum = "9865986598";
            } else {
                $phnum = str_replace(" ", "", $this->common->payxnow_decodedata($set_orders[0]['phone']));
                $phnum = str_replace("(", "", $phnum);
                $phnum = str_replace(")", "", $phnum);
                $phnum = str_replace("-", "", $phnum);
            }

            $postdata = 'format=json&data={
                "shipments": [
                    {
                        "add": "' . $this->common->payxnow_decodedata($set_orders[0]['shipping_address']) . '",
                        "address_type": "home",
                        "phone": "' . $phnum . '",
                        "payment_mode": "' . $shipping_pay_method . '",
                        "name": "' . $this->common->payxnow_decodedata($set_orders[0]['cust_fname']) . ' ' . $this->common->payxnow_decodedata($set_orders[0]['cust_lname']) . '",
                        "pin": "' . $set_orders[0]['zip'] . '",
                        "order": "' . $set_orders[0]['order_number'] . '",
                        "country": "' . $this->common->payxnow_decodedata($set_orders[0]['country']) . '",
                        "cod_amount": ' . $shipping_pay_amount . ',
                        "waybill": "",
                        "shipping_mode": "Surface"
                    }
                ],
                "pickup_location": {
                    "name": "' . $shiprocket_info[0]->pickup_location . '"
                }
            }';
            //  echo $postdata;
            //  die();
            try {

                $get_result = $this->common->create_custom_order_delhivery($postdata,  $shiprocket_info[0]->shp_token);
                //print_r($get_result);
                if (isset($get_result['success']) && ($get_result['success'] == true || $get_result['success'] == 'true')) {
                    // throw new \Exception(print_r($result, true) . "Problem in connecting with Pickrr");
                    // throw new \Exception($result['err']);
                    $syncorderscount[] = $set_orders[0]['order_id'];
                    $this->user_model->update_delhivery_order($set_orders[0]['order_id'], $_GET['shop']);
                    $return_array[$set_orders[0]['order_id']][] = 'Sync Done';
                } else {
                    if (!empty($get_result['packages'][0]['remarks'][0])) {
                        $return_array[$set_orders[0]['order_id']][] = $get_result['packages'][0]['remarks'][0];
                        $this->user_model->update_delhivery_err($set_orders[0]['order_id'], $_GET['shop'], str_replace("'", "", $get_result['packages'][0]['remarks'][0]));
                    } else {
                        $return_array[$set_orders[0]['order_id']][] = $get_result['detail'];
                        $this->user_model->update_delhivery_err($set_orders[0]['order_id'], $_GET['shop'], $get_result['detail']);
                    }
                }
            } catch (\Exception $e) {
                $return_array[] = $e;
            }
        }
        if (!empty($syncorderscount)) {
            echo count($syncorderscount);
            $this->user_model->update_plan_orders(count($syncorderscount), $_GET['shop']);
        }
        return json_encode($return_array);
    }
    public function update_token($shop_url)
    {
        $shiprocket_info = $this->user_model->get_shiprocket_config($_GET['shop']);
        $ship_email = $shiprocket_info[0]->email;
        $ship_password = $shiprocket_info[0]->password;
        $get_response = $this->common->call_api_curl('https://apiv2.shiprocket.in/v1/external/auth/login?email=' . trim($ship_email) . '&password=' . trim($ship_password) . '', '', 'POST', '');
        $new_res = json_decode($get_response);

        $insert_array = array(
            "token" => $new_res->token,
            "token_generate_date" => date('Y-m-d'),
            "token_expiray_date" => date('Y-m-d', strtotime('+10 day')),
            "shop_url" => $shop_url,
        );
        $this->user_model->track_shiprocket_api_token($insert_array);
        return $new_res->token;
    }
    public function product_remove()
    {
        $this->check_subscribe();
        if (isset($_GET['id']) && $_GET['id'] != "") {
            $this->user_model->update_plan_products_remove_part($_GET['shop']);
            $this->user_model->remove_partial_product($_GET['id'], $_GET['shop']);
            echo "<script>alert('Product remove successfully'); top.window.location='https://admin.shopify.com/store/" . $this->shope_name . "/apps/pay-x-now-rest-on-delivery/partial-products-list'</script>";
        }
    }
    public function price_plan_page()
    {

        $data = array();
        $data['plan_details'] = $this->user_model->get_store_plan($_GET['shop']);
        echo view('templates/header');
        echo view('price_plan', $data);
        echo view('templates/footer');
    }
    public function get_subscribe()
    {

        $get_details = $this->user_model->get_tokens($_GET['shop']);
        // echo "working page"; 
        // echo view('templates/footer');
        // die();

        if (isset($_GET['plan']) && $_GET['plan'] != "" && $_GET['plan'] != "basic") {
            // print_r($_GET);
            // die();
            $plane_name = $_GET['plan'];
            $plane_price = $this->plane_details[$_GET['plan']]['price'];
            $plane_scane_count = $this->plane_details[$_GET['plan']]['scan_count'];

            $plane_start_date = date('Y-m-d');
            $plane_start_endate = date('Y-m-d', strtotime('+' . $this->plane_details[$_GET['plan']]['validity'] . ' days'));
            // echo "working page";

            $plan_details = $this->user_model->get_store_plane($_GET['shop']);
            if (empty($plan_details)) {
                $freetrial = 7;
                $stype = "&typu=f";
            } else {
                $freetrial = 0;
                $stype = "";
            }

            $get_subscribe = $this->common->rest_api('/admin/api/2022-10/recurring_application_charges.json', array("recurring_application_charge" => array("name" => $plane_name, "price" => $plane_price, "return_url" => 'https://admin.shopify.com/store/' . $this->shope_name . '/apps/pay-x-now-rest-on-delivery/return_url?shop=' . $_GET['shop'] . '&planname=' . $_GET['plan'] . $stype . '', "test" => true, "trial_days" => $freetrial)), 'POST', $get_details->access_token, $_GET['shop']);


            //     // $get_subscribe = $this->common->rest_api('/admin/api/2022-04/application_charges.json', array("application_charge" => array("name" => $plane_name, "price" => $plane_price, "return_url" => 'https://' . esc($_GET['shop']) . '/admin/apps/bigthinx-size-app/return_url?shop=' . $_GET['shop'] . '&planname=' . $_GET['plan'] . '', "test" => true)), 'POST', $get_details->access_token, $_GET['shop']);

            $get_reposne = json_decode($get_subscribe['body'], true);
            // print_r($get_reposne);
            // echo view('templates/apbrdgnew');
            // die();
            $plane_charged_id = $get_reposne['recurring_application_charge']['id'];
            $plan_status = $get_reposne['recurring_application_charge']['status'];
            $return_url_res = $get_reposne['recurring_application_charge']['confirmation_url'];
            $trackarray = array(
                "shop_url" => $_GET['shop'],
                "charged_id" => $plane_charged_id,
                //"plan_name" => $plane_name,
                // "plan_price" => $plane_price,
                // "scan_count" => $plane_scane_count,
                // "updated_scan_count" => $plane_scane_count,
                //"plan_status" => $plan_status

            );
            // echo "Redirecting to payment page.Please wait";
            $this->user_model->track_store_subscribe($trackarray);
            echo "<script>top.window.location='" . $return_url_res . "'</script>";
            echo view('templates/apbrdgnew');
        } else {
            $plane_name = 'basic';
            $plane_price = 0;
            $plane_start_date = date('Y-m-d');
            $plane_start_endate = date('Y-m-d', strtotime('+30 days'));
            $plane_charged_id = '';
            $plan_status = 'active';
            $plane_scane_count = 20;
            //$return_url_res = "https://" . $_GET['shop'] . "/admin/apps/bigthinx-size-app";
            $return_url_res = "https://admin.shopify.com/store/" . $this->shope_name . "/apps/pay-x-now-rest-on-delivery";

            $trackarray = array(
                "shop_url" => $_GET['shop'],
                "charged_id" => $plane_charged_id,
                "plan_name" => $plane_name,
                "plan_price" => $plane_price,
                "sync_orders_count" => $plane_scane_count,
                "updated_sync_orders_count" => $plane_scane_count,
                "plan_status" => $plan_status,
                "activate_date" => date('Y-m-d'),
                "plan_validity" => $plane_start_endate

            );
            $this->user_model->track_store_subscribe($trackarray);
            echo "<script>alert('Free plan activated successfully'); top.window.location='" . $return_url_res . "'</script>";
            echo view('templates/apbrdgnew');
        }
    }

    public function get_subscribe_return()
    {


        $get_details = $this->user_model->get_tokens($_GET['shop']);

        $get_subscribe_list = $this->common->rest_api('/admin/api/2022-10/recurring_application_charges/' . $_REQUEST['charge_id'] . '.json', array(), 'GET', $get_details->access_token, $_GET['shop']);


        $get_status = json_decode($get_subscribe_list['body'], true);
        $plane_start_date = date('Y-m-d');
        if (isset($_REQUEST['typu']) && $_REQUEST['typu'] == 'f') {
            $firsttimevalidity = $this->plane_details[$_REQUEST['planname']]['validity'] + 7;
            $plane_start_endate = date('Y-m-d', strtotime('+' . $firsttimevalidity . ' days'));
        } else {
            $plane_start_endate = date('Y-m-d', strtotime('+' . $this->plane_details[$_REQUEST['planname']]['validity'] . ' days'));
        }


        $update_data = array(
            "shop_url" => $_GET['shop'],
            "charged_id" => $_REQUEST['charge_id'],
            "plan_status" => $get_status['recurring_application_charge']['status'],
            "activate_date" => date('Y-m-d'),
            "plan_name" => $_REQUEST['planname'],
            "plan_price" => $this->plane_details[$_REQUEST['planname']]['price'],
            "sync_orders_count" => $this->plane_details[$_REQUEST['planname']]['order_sunc'],
            "updated_sync_orders_count" => $this->plane_details[$_REQUEST['planname']]['order_sunc'],
            "total_products_partial" => $this->plane_details[$_REQUEST['planname']]['partial_product'],
            "updated_products_partial" => $this->plane_details[$_REQUEST['planname']]['partial_product'],
            "plan_validity" => $plane_start_endate
        );
        if (isset($_REQUEST['typu']) && $_REQUEST['typu'] == 'f') {
            $this->user_model->track_store_subscribe($update_data);
            echo "<script>top.window.location='https://admin.shopify.com/store/" . $this->shope_name . "/apps/pay-x-now-rest-on-delivery'</script>";
            echo view('templates/apbrdgnew');
        } else {
            $this->user_model->update_plan_after_payment($update_data);
            echo "<script>alert('" . $_REQUEST['planname'] . " plan activated successfully'); top.window.location='https://admin.shopify.com/store/" . $this->shope_name . "/apps/pay-x-now-rest-on-delivery/price-plan'</script>";
            echo view('templates/apbrdgnew');
        }
    }


    public function app_configuration()
    {
        $data = array();
        //echo phpinfo();
        echo view('templates/header');
        echo view('app_configuration', $data);
        echo view('templates/footer');
    }

    public function shiprocket_config()
    {

        if ($this->request->getPost('save_users')) {

            if ($this->request->getPost('delivery_partner') == 'ship_roc') {

                $get_response = $this->common->call_api_curl('https://apiv2.shiprocket.in/v1/external/auth/login?email=' . trim($_POST['ship_email']) . '&password=' . trim($_POST['ship_pwd']) . '', '', 'POST', '');
                $new_res = json_decode($get_response);

                if (isset($new_res->message)) {
                    if (isset($new_res->errors)) {
                        echo json_encode($new_res->errors);
                    } else {
                        echo $new_res->message;
                    }

                    // echo view('templates/apbrdgnew');
                } else {
                    // echo "else";
                    $update_price = array(
                        "email" => $this->request->getPost('ship_email'),
                        "password" => $this->request->getPost('ship_pwd'),
                        "channel_id" => $this->request->getPost('ship_chnl_id'),
                        "created" => date('Y-m-d'),
                        "shop_url" => $_REQUEST['shop'],
                        "shiping_partner_type" => $this->request->getPost('delivery_partner'),
                        "enable_shipping_type" => $this->request->getPost('delivery_partner'),

                    );
                    //print_r($update_price);
                    $this->user_model->shiprocket_config_db($update_price);
                    echo "Information successfully saved";
                    // echo "<script>top.window.location='https://admin.shopify.com/store/" . $this->shope_name . "/apps/pay-x-now-rest-on-delivery/public/index.php/shiprocket-config'</script>";
                }
            } else if ($this->request->getPost('delivery_partner') == 'delhivery') {
                $update_price = array(
                    "shp_token" => $this->request->getPost('ship_token_del'),
                    "pickup_location" => $this->request->getPost('pick_up_location'),
                    "created" => date('Y-m-d'),
                    "shop_url" => $_REQUEST['shop'],
                    "shiping_partner_type" => $this->request->getPost('delivery_partner'),
                    "enable_shipping_type" => $this->request->getPost('delivery_partner'),

                );
                //print_r($update_price);
                $this->user_model->shiprocket_config_db($update_price);
                echo "Information successfully saved";
            } else {

                $update_price = array(
                    "shp_token" => $this->request->getPost('ship_token'),
                    "shipping_address" => $this->request->getPost('ship_from'),
                    "pickrr_company" => $this->request->getPost('pickrr_company'),
                    "pickrr_from_phone" => $this->request->getPost('pickrr_phone'),
                    "pickrr_pincode" => $this->request->getPost('pickrr_pincode'),
                    "created" => date('Y-m-d'),
                    "shop_url" => $_REQUEST['shop'],
                    "shiping_partner_type" => $this->request->getPost('delivery_partner'),
                    "enable_shipping_type" => $this->request->getPost('delivery_partner'),

                );
                //print_r($update_price);
                $this->user_model->shiprocket_config_db($update_price);
                echo "Information successfully saved";
            }

            // echo view('templates/apbrdgnew');
        } else {
            $data = array();
            $data['shiprocket_info'] = $this->user_model->get_shiprocket_config($_GET['shop']);
            // echo"<pre>"; print_r($data['shop_info']); echo"</pre>";
            echo view('templates/header');
            echo view('shiprocket_config', $data);
            echo view('templates/footer');
        }
    }
    public function get_shipping_partners()
    {

        $data = array();
        $return_data = $this->user_model->get_shiprocket_config($_REQUEST['shop']);
        if ($_REQUEST['delv_parnter'] == 'ship_roc') {
            $return_array = array(
                "email" => $return_data[0]->email,
                "password" => $return_data[0]->password,
                "channel_id" => $return_data[0]->channel_id,
            );
            echo json_encode($return_array);
        } else if ($_REQUEST['delv_parnter'] == 'delhivery') {
            $return_array = array(
                "token" => $return_data[0]->token,
            );
            echo json_encode($return_array);
        } else if ($_REQUEST['delv_parnter'] == 'pickr') {
            $return_array = array(
                "token" => $return_data[0]->token,
                "shipping_address" => $return_data[0]->shipping_address
            );
            echo json_encode($return_array);
        }
    }
    public function track_userinfo()
    {
        if ($this->request->getGet('shop')) {
            $get_details = $this->user_model->get_tokens($this->request->getGet('shop'));
            if ($get_details->email == "") {
                $shop_info = $this->common->rest_api('/admin/api/2022-07/shop.json', array(), 'GET', $get_details->access_token, $_GET['shop']);
                $register_shop_info = json_decode($shop_info['body'], true);

                $this->user_model->update_data($get_details->shop_url, array(
                    "first_name" => $register_shop_info['shop']['shop_owner'],
                    "email" => $register_shop_info['shop']['email'],
                ));
            }
            $visitr_ipaddreess =  $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['REMOTE_ADDR'];
            $track_user_log = array(
                "name" => $get_details->first_name,
                "email" => $get_details->email,
                "shop_url" => $get_details->shop_url,
                "ipaddress" => $visitr_ipaddreess,
            );
            $this->user_model->track_user_log($track_user_log);
        }
    }
}
