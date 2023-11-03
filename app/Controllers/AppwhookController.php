<?php

namespace App\Controllers;

use App\Models\UserModel;

class AppwhookController extends BaseController
{



    function __construct()
    {
        $this->user_model = new UserModel();
    }

    public function uninstall_app()
    {

        $userModel = new UserModel();
        /* $shop_header = $_SERVER['HTTP_X_SHOPIFY_SHOP_DOMAIN'];
        $get_webhook_details = $userModel->get_webhook_id($shop_header);
        if (!empty($get_webhook_details)) {
            $webid = $get_webhook_details[0]->webhook_id;
            $insertara = array(
                "reposne" => json_encode($_SERVER),
                "date_time" => date('Y-m-d H:i:s')
            );
            //$userModel->insert_logs($insertara);
            $get_details = $userModel->get_tokens($shop_header);
            $userModel->delete_webhooks($webid);
            //$userModel->delete_shops($shop_header);
        }*/

        $shop_header = $_GET['cleanshop'];
        //$userModel->update_shops_status($shop_header);

        $get_webhook_details =   $userModel->get_webhook_id($shop_header);
        if (!empty($get_webhook_details)) {
            $webid = $get_webhook_details[0]->webhook_id;
            // $insertara = array(
            //     "reposne" => json_encode($_SERVER),
            //     "date_time" => date('Y-m-d H:i:s')
            // );
            // $userModel->insert_logs($insertara);
            $get_details =   $userModel->get_tokens($shop_header);
            $userModel->delete_webhooks($webid);
            $userModel->update_shops_status($shop_header);
        }



        $get_charge_id = $this->user_model->get_charge_id($shop_header);
        //cancel charge when uninstalled app     
        $get_resulsts = $this->user_model->get_tokens($shop_header);
        if (isset($get_charge_id[0]->charged_id) && $get_charge_id[0]->charged_id != "") {
            $cancel_charge_id = $this->common->rest_api('/admin/api/2023-04/recurring_application_charges/' . $get_charge_id[0]->charged_id . '.json', array(), 'DELETE', $get_resulsts->access_token, $shop_header);
            $cancel_charge_id_res = json_decode($cancel_charge_id['body'], true);
        }

        $trackarray = array(
            "shop_url" => $shop_header,
            //"sync_orders_count" => 0,
            //"updated_sync_orders_count" => 0,
            // "total_products_partial" => 0,
            // "updated_products_partial" => 0,
            "plan_status" => 'deactivate',
            // "plan_validity" =>  date('Y-m-d', strtotime('-1 day'))

        );
        $userModel->deactivate_price_plane($trackarray);
        $userModel->remove_update_cart_whook($shop_header); //remove update cart whook evenet from db
        // $resposne_array = array("name" => "uninstall webhook with code" . $shop_header);
        // $userModel->check_test_response($resposne_array);
        echo "200 ok";
        exit();
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

    function auto_ordersync()
    {


        $webstsrti = 1;

        $webhook_content = NULL;

        // Get webhook content from the POST
        $webhook = fopen('php://input', 'rb');
        while (!feof($webhook)) {
            $webhook_content .= fread($webhook, 4096);
        }

        fclose($webhook);

        $jsndata = json_decode($webhook_content);
        $get_resulsts = $this->user_model->get_tokens($_GET['whshp']);


        // $log_filename = "log";
        // // $log_msg = $resp;
        // if (!file_exists($log_filename)) {

        //     mkdir($log_filename, 0777, true);
        // }
        // $log_file_data = $log_filename . '/log_' . date('d-M-Y') . '.log';
        // file_put_contents($log_file_data, print_r($jsndata, true)); 

        $plan_details = $this->user_model->get_store_plan($_GET['whshp']); //get store price plane

        //check store order count accoring to paid plane 
        if ($plan_details[0]->plan_status == 'active' && $plan_details[0]->updated_sync_orders_count > 0) {
            // $resposne_arrayshop = array("name" => "Shop Order Start " . $_GET['whshp']);
            // $this->user_model->check_test_response($resposne_arrayshop);


            // $resposne_array = array("name" => "orderdata" . $webhook_content);
            // $this->user_model->check_test_response($resposne_array);


            // die();
            // $resposne_array = array("name" => "orderdata".$webhook_content);
            // $this->user_model->check_test_response($resposne_array);
            // if ($jsndata->tags != "") {


            // $get_resulsts = $this->user_model->get_token($_REQUEST['whshp']);
            if (isset($_GET['whshp']) && $_GET['whshp'] != "") {

                // if ($jsndata->tags != "") {
                $remaing_proice = 0;
                $get_orders_details = $this->user_model->get_order_detail($jsndata->id);
                if (empty($get_orders_details)) {
                    if ($jsndata->tags != '') {
                        $orders_sts = 'pending';
                        $pendingamntnnn = explode("_", $jsndata->tags);
                        $remaing_proice = (isset($pendingamntnnn[1]) ? $pendingamntnnn[1] : '0');
                        $part_type = $pendingamntnnn[0];
                        $order_pay_sts = "partial";
                    } else {
                        if ($jsndata->financial_status == "pending") {
                            $orders_sts = 'cod';
                            $remaing_proice = $jsndata->total_price;
                            $order_pay_sts = "cod";
                        } else {
                            $orders_sts = $jsndata->financial_status;
                            $remaing_proice = 0;
                            $part_type = 'fullpaid';
                            $order_pay_sts = "paid";
                        }
                    }

                    //$get_parttype = explode("_", $jsndata->tags);
                    // if ($get_parttype[0] == 'partial') {
                    //$remaing_proice = $get_parttype[1];
                    //track orders into database 

                    if (empty($jsndata->fulfillments)) {
                        $fullmenststs = "Unfulfilled";
                    } else {
                        $fullmenststs = "fulfilled";
                    }
                    if ($jsndata->contact_email == null) {
                        $uemailset = "";
                    } else {
                        $uemailset = $this->common->payxnow_encodedata($jsndata->contact_email);
                    }
                    $order_price = floatval($jsndata->current_subtotal_price);
                    $remaining_price = floatval($remaing_proice);
                    $orders_data = array(
                        "order_id" => $jsndata->id,
                        "order_number" => str_replace("#", "", $jsndata->name),
                        "order_status" => $orders_sts,
                        "order_ccy" => $jsndata->currency,
                        "order_date" => $jsndata->created_at,
                        "order_price" => $jsndata->current_subtotal_price,
                        "email" => $uemailset,
                        "total_price" => $order_price + $remaining_price,
                        "pending_amount" => $remaing_proice,
                        "shop_url" => $_GET['whshp'],
                        "fullfilment_status" => $fullmenststs,
                        "order_weight" => $jsndata->total_weight
                    );
                    if (isset($jsndata->shipping_address)) {

                        if (isset($jsndata->shipping_address->phone)) {
                            $store_phnum = str_replace(" ", "", $jsndata->shipping_address->phone);
                            $store_phnum = str_replace("(", "", $store_phnum);
                            $store_phnum = str_replace(")", "", $store_phnum);
                            $store_phnum = str_replace("-", "", $store_phnum);
                        } else {
                            $store_phnum = "";
                        }


                        $orders_data['shipping_address'] = $this->common->payxnow_encodedata($jsndata->shipping_address->address1);

                        $orders_data['shipping_address2'] = (isset($jsndata->shipping_address->address2) ? $this->common->payxnow_encodedata($jsndata->shipping_address->address2) : '');

                        $orders_data['city'] = (isset($jsndata->shipping_address->city) ? $this->common->payxnow_encodedata($jsndata->shipping_address->city) : '');
                        $orders_data['state'] = (isset($jsndata->shipping_address->province) ? $this->common->payxnow_encodedata($jsndata->shipping_address->province) : '');
                        $orders_data['zip'] = (isset($jsndata->shipping_address->zip) ? $jsndata->shipping_address->zip : '');
                        $orders_data['phone'] = $this->common->payxnow_encodedata($store_phnum);
                        $orders_data['f_name'] = (isset($jsndata->shipping_address->first_name) ? $this->common->payxnow_encodedata($jsndata->shipping_address->first_name) : '');
                        $orders_data['l_name'] = (isset($jsndata->shipping_address->last_name) ? $this->common->payxnow_encodedata($jsndata->shipping_address->last_name) : '');
                        //$orders_data['email'] = (isset($jsndata->shipping_address['email']) ? $jsndata->shipping_address['email'] :'' );
                        // $orders_data['country'] = (isset($jsndata->shipping_address->country) ? $jsndata->shipping_address->country : '');
                        $orders_data['country'] = (isset($jsndata->shipping_address->country) ? $this->common->payxnow_encodedata($jsndata->shipping_address->country) : '');
                    } else  if (isset($jsndata->billing_address)) {

                        if (isset($jsndata->billing_address->phone)) {
                            $store_phnum2 = str_replace(" ", "", $jsndata->billing_address->phone);
                            $store_phnum2 = str_replace("(", "", $store_phnum2);
                            $store_phnum2 = str_replace(")", "", $store_phnum2);
                            $store_phnum2 = str_replace("-", "", $store_phnum2);
                        } else {
                            $store_phnum2 = "";
                        }

                        $orders_data['shipping_address'] = $this->common->payxnow_encodedata($jsndata->billing_address->address1);

                        $orders_data['shipping_address2'] = (isset($jsndata->billing_address->address2) ? $this->common->payxnow_encodedata($jsndata->billing_address->address2) : '');

                        $orders_data['city'] = (isset($jsndata->billing_address->city) ? $this->common->payxnow_encodedata($jsndata->billing_address->city) : '');
                        $orders_data['state'] = (isset($jsndata->billing_address->province) ? $this->common->payxnow_encodedata($jsndata->billing_address->province) : '');
                        $orders_data['zip'] = (isset($jsndata->billing_address->zip) ? $jsndata->billing_address->zip : '');
                        $orders_data['phone'] = $this->common->payxnow_encodedata($store_phnum2);
                        $orders_data['f_name'] = (isset($jsndata->billing_address->first_name) ? $this->common->payxnow_encodedata($jsndata->billing_address->first_name) : '');
                        $orders_data['l_name'] = (isset($jsndata->billing_address->last_name) ? $this->common->payxnow_encodedata($jsndata->billing_address->last_name) : '');
                        //$orders_data['email'] = (isset($value['shipping_address']['email']) ? $value['shipping_address']['email'] :'' );
                        $orders_data['country'] = (isset($jsndata->billing_address->country) ? $this->common->payxnow_encodedata($jsndata->billing_address->country) : '');
                    }
                    /// echo"orders_data<pre>"; print_r($orders_data); echo"</pre>";

                    // $resposne_array = array("name" => "new_orderdata" . json_encode($orders_data));
                    // $this->user_model->check_test_response($resposne_array);

                    $incid = $this->user_model->track_orders($orders_data, $_GET['whshp']);

                    $reaminming_price = array();
                    foreach ($jsndata->line_items as $products) {
                        if ($products->name != "Partial Pending Payment") {
                            if ($products->sku == "") {

                                if (isset($products->properties[3]->value)) {
                                    $reaminming_price[] = $products->properties[3]->value;
                                    $prodycprice =  $products->properties[3]->value;
                                } else {
                                    $reaminming_price[] = 0;
                                    $prodycprice =  0;
                                }
                                // if (isset($products->properties[4]->value)) {
                                //     $prosku = $products->properties[4]->value;
                                // } else {
                                //     $prosku = 'PRTTESTSKY';
                                // }
                                $prosku = 'PRTTESTSKY' . time();
                            } else {
                                $prosku = $products->sku;
                                $prodycprice =  $products->price;
                            }
                            $orders_products_data = array(
                                "order_id" => $jsndata->id,
                                "product_id" => $products->id,
                                "product_name" => $products->name,
                                "product_price" => $prodycprice,
                                "product_qty" => $products->quantity,
                                "product_sku" => $prosku,
                                "shop_url" => $_GET['whshp']
                            );

                            //below code for remove data from add to cart table which is used for update/cart webhook for show partial product section on cart page 

                            if (isset($products->properties[1]->value)) {
                                if ($products->properties[1]->name == 'variant_code') {
                                    $cuvarid = $products->properties[1]->value;
                                } else {
                                    $cuvarid = $products->variant_id;
                                }
                            } else {
                                $cuvarid = $products->variant_id;
                            }
                            $removeArray = array(
                                "variant_id" => $cuvarid,
                                "shop_url" => $_REQUEST['whshp']
                            );
                            $this->user_model->remove_add_cart_data($removeArray); //remove add to cart data from database table



                            if ($_REQUEST['whshp'] == 'onlyneon1.myshopify.com') {
                                //below code for remove custom product from partial list only onlyneon store
                                // $this->user_model->update_plan_products_remove_part($_REQUEST['whshp']);
                                $this->user_model->remove_custom_product_partial($removeArray);
                                $resposne_array = array("name" => "remove cart partial product" . json_encode($removeArray));
                                $this->user_model->check_test_response($resposne_array);
                            }

                            // echo "orders_products_data<pre>";
                            // print_r($orders_products_data);
                            // echo "</pre>";

                            // $resposne_array = array("name" => "orders_products_data" . json_encode($orders_products_data));
                            // $this->user_model->check_test_response($resposne_array);

                            $this->user_model->track_orders_products($orders_products_data);
                        }
                    }

                    $subtotal_update = array_sum($reaminming_price);
                    $this->user_model->update_order_subtotal($jsndata->id, $subtotal_update, $_GET['whshp']);

                    $this->user_model->update_plan_orders(1, $_GET['whshp']); //update sync update order count for price plan

                    // $resposne_array = array("name" => "subtotal_update" . json_encode($subtotal_update));
                    // $this->user_model->check_test_response($resposne_array);

                    if (isset($part_type) && $part_type == 'partial') {

                        if ($_GET['whshp'] != 'desinomatetest.myshopify.com') {
                            $order_edit_begain = 'mutation {
                orderEditBegin(id: "gid://shopify/Order/' . $jsndata->id . '") {
                calculatedOrder {
                id
                }
                }
                }';

                            $edit_order_return = $this->graphql_api_run(array("query" => $order_edit_begain), $_GET['whshp'], $get_resulsts->access_token);
                            $get_resposne_editorders = json_decode($edit_order_return['body']);
                            $calculate_order_id = $get_resposne_editorders->data->orderEditBegin->calculatedOrder->id;

                            //add custom item into orders
                            $order_edit_add_custom = 'mutation {
                orderEditAddCustomItem(id: "' . $calculate_order_id . '", price: {amount: ' . $remaing_proice . ', currencyCode: ' . $jsndata->currency . '}, quantity: 1, title: "Partial Pending Payment") {
                  calculatedLineItem {
                    id
                  }
                  calculatedOrder {
                    id
                  }
                  userErrors {
                    field
                    message
                  }
                }
              }';

                            $edit_custom_order = $this->graphql_api_run(array("query" => $order_edit_add_custom), $_GET['whshp'], $get_resulsts->access_token);


                            //commit edit orders process
                            $order_edit_commit = 'mutation {
                orderEditCommit(id: "' . $calculate_order_id . '") {
                  order {
                    id
                  }
                  userErrors {
                    field
                    message
                  }
                }
              }';

                            $commiteditorder = $this->graphql_api_run(array("query" => $order_edit_commit), $_GET['whshp'], $get_resulsts->access_token);
                            $final_result = json_decode($commiteditorder['body']);

                            $resposne_array = array("name" => $webstsrti . "Edit Partial Order " . $commiteditorder['body']);
                            //$this->user_model->check_test_response($resposne_array);

                            $send_invoice_email = 'mutation {
                        orderInvoiceSend(
                          id: "gid://shopify/Order/' . $jsndata->id . '"
                          email: {from: "' . $get_resulsts->email . '", to: "' . $jsndata->email . '"}
                        ) {
                          order {
                            id
                          }
                          userErrors {
                            field
                            message
                          }
                        }
                      }';

                            $invoice_email_snd = $this->graphql_api_run(array("query" => $send_invoice_email), $_GET['whshp'], $get_resulsts->access_token);
                        }
                        // $resposne_array = array("name" => "invoiceemail" . $send_invoice_email . $get_resulsts->email . $invoice_email_snd['body'] . $jsndata->contact_email . 'toemail=' . $jsndata->email);
                        // $this->user_model->check_test_response($resposne_array);

                        if ($_GET['whshp'] == 'desinomatetest.myshopify.com') {

                            //get fulfilment id of order
                            $getprietuleid = $this->common->rest_api('/admin/api/2023-01/orders/' . $jsndata->id . '/fulfillment_orders.json', array(), 'GET', $get_resulsts->access_token, $_GET['whshp']);

                            $getprietuleidrec = json_decode($getprietuleid['body'], true);
                            $fulfilid = $getprietuleidrec['fulfillment_orders'][0]['id'];

                            $fulfilarray = array("fulfillment" => array(
                                "line_items_by_fulfillment_order" => array(
                                    array(
                                        "fulfillment_order_id" => $fulfilid,
                                        // "fulfillment_order_line_items" => array(
                                        //     "id" => 44320869220656,
                                        //     "quantity" => 1
                                        // )
                                    )
                                ),
                                // "tracking_info" => array(
                                //     "number" => "MS1562678",
                                //     "url" => "https://www.my-shipping-company.com?tracking_number=MS1562678",
                                // )
                            ));

                            $getprietuleid = $this->common->create_fulfilmentorders($get_resulsts->access_token, $_GET['whshp'], $fulfilarray);
                            $paid_price = 0;
                            $linitemdisount = 0;
                            $taxamounttotal = 0;
                            $order_tax = 0;
                            $tax_lines = [];
                            foreach ($jsndata->line_items as $products) {
                                if ($products->name != "Partial Pending Payment") {
                                    // if ($products->sku == "") {

                                    //     $prosku = 'PRTTESTSKY' . time();
                                    // } else {
                                    //     $prosku = $products->sku;
                                    //     $prodycprice =  $products->price;
                                    // }

                                    if (isset($products->properties[0]->value) && $products->properties[0]->value == 'Initial Partial Payment') {
                                        $item_price = $products->properties[2]->value;
                                        $tax_price = $products->properties[3]->value;
                                        $productvarient = $products->properties[1]->value;
                                        if (isset($products->properties[4]->value)) {
                                            $item_discount_item = $products->properties[4]->value;
                                        } else {
                                            $item_discount_item = 0;
                                        }
                                        //$paidprice_get = $products->price;
                                        $paidprice_get = $products->properties[2]->value;
                                    } else {
                                        $item_price = $products->price;
                                        if ($products->total_discount != "") {
                                            $item_discount_item = $products->total_discount;
                                        } else {
                                            $item_discount_item = 0;
                                        }
                                        $productvarient = $products->variant_id;
                                        $tax_price = 0;
                                        $paidprice_get = $products->properties[1]->value;
                                    }

                                    $linitemdisount = $linitemdisount + $item_discount_item;
                                    // $line_item[] = array(
                                    //     "variant_id" => $productvarient,
                                    //     "quantity" => $products->quantity,
                                    //     "gift_card" => true,
                                    //     "sku" => $prosku,
                                    //     "grams" => $products->grams,
                                    //     // "applied_discount" => array(
                                    //     //     "description" => 'Partial Payment',
                                    //     //     "title" => 'Partial Payment',
                                    //     //     "value_type" => "fixed_amount",
                                    //     //     "value" => $item_price . ".00",
                                    //     //     "amount" => $item_price . ".00",
                                    //     // ),
                                    //     "properties" => array(
                                    //         array("name" => "Note", "value" => "Actual order"),
                                    //         array("name" => "full_pay", "value" => $item_price)
                                    //     ),
                                    //     "requires_shipping" => true
                                    // );

                                    if (!empty($products->tax_lines)) {
                                        foreach ($products->tax_lines as $tax_items) {
                                            if ($tax_price == 0) {
                                                $taxamount = 0;
                                            } else {
                                                $taxamount = $tax_price * $tax_items->rate;
                                            }
                                            $getitemtx = $tax_price + $taxamount;
                                            $taxamounttotal = $taxamounttotal + $getitemtx;
                                            $order_tax = $order_tax + $taxamount;
                                            $tax_lines[] = [
                                                'title' => $tax_items->title,
                                                'price' => $taxamount,
                                                'rate' => $tax_items->rate,
                                            ];
                                        }
                                    } else {
                                        $taxamounttotal = $taxamounttotal + $tax_price;
                                    }

                                    $line_items[] =
                                        [
                                            "variant_id" => $productvarient,
                                            "quantity" => $products->quantity,
                                            //"tax_lines" => $tax_lines,
                                            // 'tax_lines' => [
                                            //     [
                                            //         'title' => 'IGST',  // Tax title
                                            //         'price' => 40,        // Tax amount
                                            //         'rate' => 0.18,           // Tax rate in percentage
                                            //     ]
                                            // ]
                                        ];

                                    $paid_price = $paid_price + $paidprice_get;
                                }
                            }
                            $discoutnarray = array(
                                "code" => "partialcode",
                                "amount" => $paid_price,
                                "type" => "fixed_amount",
                            );
                            if (isset($jsndata->shipping_address)) {

                                if (isset($jsndata->shipping_address->phone)) {
                                    $store_phnum = str_replace(" ", "", $jsndata->shipping_address->phone);
                                    $store_phnum = str_replace("(", "", $store_phnum);
                                    $store_phnum = str_replace(")", "", $store_phnum);
                                    $store_phnum = str_replace("-", "", $store_phnum);
                                } else {
                                    $store_phnum = "";
                                }

                                $actl_shipping_addrss = array(
                                    "first_name" => $jsndata->shipping_address->first_name,
                                    "first_name" => $jsndata->shipping_address->last_name,
                                    "address1" => $jsndata->shipping_address->address1,
                                    "address2" => (isset($jsndata->shipping_address->address2) ? $jsndata->shipping_address->address2 : ''),
                                    "phone" => $store_phnum,
                                    "city" => $jsndata->shipping_address->city,
                                    "province" => $jsndata->shipping_address->province,
                                    "zip" => $jsndata->shipping_address->zip,
                                    "country" => $jsndata->shipping_address->country,
                                );
                            } else {
                                $actl_shipping_addrss = array();
                            }
                            // $final_array = array("order" => array("line_items" => $line_item, "email" => $jsndata->email, "shipping_address" => $actl_shipping_addrss, "discount_codes" => $discoutnarray));
                            if ($linitemdisount > 0) {
                                $finaldiscount = $linitemdisount + $paid_price;
                                $titla_name = "Partial Payment+Applied Discount";
                            } else {
                                $finaldiscount = $paid_price;
                                $titla_name = "Partial Payment";
                            }

                            $order_data = [
                                "order" => [
                                    "line_items" => $line_items,
                                    "financial_status" => "pending",
                                    "tax_lines" => $tax_lines,
                                    "total_tax" => $order_tax,
                                    "transactions" => [
                                        [
                                            "kind" => "authorization",
                                            "status" => "success",
                                            "amount" => $taxamounttotal,
                                            "gateway" => "Cash on Delivery"
                                        ]
                                    ],
                                    "shipping_address" => [
                                        "first_name" => $jsndata->shipping_address->first_name,
                                        "last_name" => $jsndata->shipping_address->last_name,
                                        "address1" => $jsndata->shipping_address->address1,
                                        "phone" => $store_phnum,
                                        "city" => $jsndata->shipping_address->city,
                                        "province" => $jsndata->shipping_address->province,
                                        "country" => $jsndata->shipping_address->country,
                                        "zip" => $jsndata->shipping_address->zip
                                    ],
                                    "customer" => [
                                        "id" => $jsndata->customer->id
                                    ],
                                    "note_attributes" => [
                                        [
                                            "name" => "Suffix",
                                            "value" => $jsndata->name . '-SplitOrder'  # Add your desired suffix here
                                        ]
                                    ],
                                    "name" => $jsndata->name . '-SplitOrder',
                                    "discount_codes" => [
                                        [
                                            "code" => $titla_name,
                                            "amount" => $finaldiscount,
                                            "type" => "fixed_amount"
                                        ]
                                    ]
                                ]
                            ];


                            $resposne_array = array("name" => "actual order_data" . json_encode($order_data));
                            $this->user_model->check_test_response($resposne_array);

                            $get_actual_orders = $this->common->create_actual_order($get_resulsts->access_token, $_GET['whshp'], $order_data);

                            $decode_get_actual_orders = json_decode($get_actual_orders);

                            $resposne_array = array("name" => "actual order resposne" . $get_actual_orders);
                            $this->user_model->check_test_response($resposne_array);


                            $send_invoice_email = 'mutation {
                                orderInvoiceSend(
                                  id: "gid://shopify/Order/' . $decode_get_actual_orders->order->id . '"
                                  email: {from: "' . $get_resulsts->email . '", to: "' . $jsndata->email . '"}
                                ) {
                                  order {
                                    id
                                  }
                                  userErrors {
                                    field
                                    message
                                  }
                                }
                              }';

                            $invoice_email_snd = $this->graphql_api_run(array("query" => $send_invoice_email), $_GET['whshp'], $get_resulsts->access_token);

                            $resposne_array = array("name" => "actual order invoice_email_snd=" . json_encode($invoice_email_snd));
                            $this->user_model->check_test_response($resposne_array);
                        }
                    }

                    $get_resulststoken = $this->user_model->get_token($_GET['whshp']);

                    if (empty($get_resulststoken)) {
                        $store_token = $this->update_token($_GET['whshp']);
                    } else {
                        $store_token = $get_resulststoken[0]->token;
                    }
                    //$get_all_orders = $this->user_model->get_products_orders($_GET['whshp']);
                    $shiprocket_info = $this->user_model->get_shiprocket_config_home($_GET['whshp']);




                    if (isset($shiprocket_info[0]->enable_shipping_type) && $shiprocket_info[0]->enable_shipping_type == 'ship_roc') {
                        if ($store_token != "in_correct") {
                            $create_custom = array();
                            $return_array = array();


                            if ($jsndata->shipping_address->phone == "") {
                                $phnum = "9865986598";
                            } else {
                                $phnum = str_replace(" ", "", $jsndata->shipping_address->phone);
                                $phnum = str_replace("(", "", $phnum);
                                $phnum = str_replace(")", "", $phnum);
                                $phnum = str_replace("-", "", $phnum);
                            }

                            if ($order_pay_sts == 'partial') {
                                $shipping_pay_method = "Partial";
                                $shipping_pay_amount = $remaing_proice;
                            } else if ($order_pay_sts == 'cod') {
                                $shipping_pay_method = "COD";
                                $shipping_pay_amount = $jsndata->total_price;
                            } else {
                                $shipping_pay_method = "Prepaid";
                                $shipping_pay_amount = $jsndata->total_price;
                            }

                            // if($jsndata->financial_status == "pending"){
                            //     $shipping_pay_method = "COD";
                            //     $shipping_pay_amount = $jsndata->total_price;
                            // }
                            $addres2orders = "";
                            if (isset($jsndata->shipping_address->address2)) {
                                $addres2orders = " " . $jsndata->shipping_address->address2;
                            }

                            $weightkgs = 1;
                            if ($jsndata->total_weight > 0) {
                                $weightkgs = $jsndata->total_weight / 1000;
                                if ($weightkgs > 0) {
                                    $weightkgs = $weightkgs;
                                } else {
                                    $weightkgs = 1;
                                }
                            }

                            $create_custom = array(
                                "order_id" => str_replace("#", "", $jsndata->name),
                                "order_date" => $jsndata->created_at,
                                // "channel_id" => $shiprocket_info[0]->channel_id,
                                "comment" => $shipping_pay_method,
                                "billing_customer_name" => $jsndata->shipping_address->first_name,
                                "billing_last_name" => $jsndata->shipping_address->last_name,
                                "billing_address" => $jsndata->shipping_address->address1 . $addres2orders,
                                "billing_city" => $jsndata->shipping_address->city,
                                "billing_pincode" => $jsndata->shipping_address->zip,
                                "billing_state" => $jsndata->shipping_address->province,
                                "billing_country" => $jsndata->shipping_address->country,
                                "billing_email" => $jsndata->customer->email,
                                "billing_phone" => trim($phnum),
                                "shipping_is_billing" => true,
                                "payment_method" => $shipping_pay_method,
                                //"sub_total" => $jsndata->total_price,
                                "sub_total" => $shipping_pay_amount,
                                "length" => 1,
                                "breadth" => 1,
                                "height" => 1,
                                "weight" => $weightkgs,
                            );

                            foreach ($jsndata->line_items as $productsitm) {
                                if ($productsitm->name != 'Partial Pending Payment') {

                                    $priceamnt = 0;
                                    if (isset($productsitm->properties) && isset($productsitm->properties[3]) && $productsitm->properties[3]->name == 'remaining_amount') {
                                        $priceamnt = $productsitm->properties[3]->value;
                                    } else {
                                        $priceamnt = $productsitm->price;
                                    }
                                    // $skuval = $productsitm->sku;
                                    // if (isset($productsitm->properties) && isset($productsitm->properties[4]) && $productsitm->properties[4]->name == 'psku') {
                                    //     $skuval = $productsitm->properties[4]->value;
                                    // }
                                    // }else {
                                    //     $priceamnt = $productsitm->price;
                                    // }

                                    if ($productsitm->sku == "") {
                                        $getsku = "PART" . time();
                                    } else {
                                        $getsku = $productsitm->sku;
                                    }
                                    $create_custom['order_items'][] = array(
                                        "name" => $productsitm->name,
                                        "sku" => $getsku,
                                        // "sku" => "PARTDGKI",
                                        "units" => $productsitm->quantity,
                                        // "selling_price" => $productsitm->price
                                        "selling_price" => $priceamnt
                                    );
                                }
                            }


                            // print_r($create_custom);

                            // $resposne_array = array("name" => "create_custom=" . json_encode($create_custom));
                            // $this->user_model->check_test_response($resposne_array);


                            //    $resposne_array = array("name" => "create_custom=" . json_encode($create_custom));
                            //     $this->user_model->check_test_response($resposne_array);

                            $get_result = $this->common->create_custom_order($create_custom, $store_token);
                            $decoded_res = json_decode($get_result);

                            $resposne_array = array("name" => "Shiprocket ordersync= " . $get_result);
                            //$this->user_model->check_test_response($resposne_array);




                            if (isset($decoded_res->message) && $decoded_res->message != "") {

                                if (isset($decoded_res->errors)) {
                                    $senderror = $decoded_res->errors;
                                    $return_array['error'][] = array("error" => $senderror);
                                    $shperr =  serialize($decoded_res->errors);
                                } else {
                                    $shperr =  $decoded_res->message;
                                    $return_array['error'][] = array("error" => $shperr);
                                }

                                // $return_array['error'][] = array("error" => $decoded_res->errors);

                                // $shperr =  serialize($decoded_res->errors);

                                $this->user_model->update_shiprocket_err($jsndata->id, $_GET['whshp'], $shperr);
                            } else {



                                $this->user_model->track_sync_order($jsndata->id, $_GET['whshp']);
                                $return_array['success'][] = array("success" => "order sync successfully for order " . $jsndata->id);
                            }
                            $resposne_array = array("name" => "return_array=" . json_encode($return_array));
                            $this->user_model->check_test_response($resposne_array);
                        } else {
                            $resposne_array = array("name" => "invalid token shiprocket");
                            $this->user_model->check_test_response($resposne_array);
                        }
                    } else  if (isset($shiprocket_info[0]->enable_shipping_type) && $shiprocket_info[0]->enable_shipping_type == 'pickr') {




                        // $this->order_sync_pickrr($shiprocket_info);

                        $create_custom = array();
                        $create_customqty = array();
                        $item_listarr = array();
                        foreach ($jsndata->line_items as $products) {
                            if ($products->name != 'Partial Pending Payment') {
                                $create_custom[] = $products->name;
                                $create_customqty[] = $products->qty;
                                if ($products->sku == "") {
                                    $getsku = "PART" . time();
                                } else {
                                    $getsku = $products->sku;
                                }
                                $item_listarr[] = array(
                                    "price" => $products->price,
                                    "item_name" => $products->name,
                                    "quantity" => $products->qty,
                                    "sku" => $getsku,
                                );
                            }
                        }

                        if (!empty($create_custom)) {
                            $order_name = implode(",", $create_custom);
                            $order_name_count = count($create_customqty);
                        }

                        if ($jsndata->billing_address->phone == "") {
                            $phnum = "9865986598";
                        } else {
                            $phnum = str_replace(" ", "", $jsndata->billing_address->phone);
                            $phnum = str_replace("(", "", $phnum);
                            $phnum = str_replace(")", "", $phnum);
                            $phnum = str_replace("-", "", $phnum);
                        }

                        if ($order_pay_sts == 'partial') {
                            $shipping_pay_method = "Partial";
                            $shipping_pay_amount = $remaing_proice;
                            $shipping_pay_amount1 = $remaing_proice;
                        } else if ($order_pay_sts == 'cod') {
                            $shipping_pay_method = "COD";
                            $shipping_pay_amount = $jsndata->total_price;
                            $shipping_pay_amount1 = $jsndata->total_price;
                        } else {
                            $shipping_pay_method = "Prepaid";
                            $shipping_pay_amount = $jsndata->total_price;
                            $shipping_pay_amount1 = 0;
                        }


                        $addres2orders = "";
                        if (isset($jsndata->billing_address->address2)) {
                            $addres2orders = " " . $jsndata->billing_address->address2;
                        }

                        $weightkgs = 0.5;
                        if ($jsndata->total_weight > 0) {
                            $weightkgs = $jsndata->total_weight / 1000;
                            if ($weightkgs > 0) {
                                $weightkgs = $weightkgs;
                            } else {
                                $weightkgs = 0.5;
                            }
                        }

                        $post_params = array(
                            'auth_token' => $shiprocket_info[0]->shp_token,
                            'item_name' => $order_name,
                            'item_list' => $item_listarr,
                            'from_name' => $shiprocket_info[0]->pickrr_company,
                            'from_phone_number' => $shiprocket_info[0]->pickrr_from_phone,
                            'from_address' => $shiprocket_info[0]->shipping_address,
                            'from_pincode' => $shiprocket_info[0]->pickrr_pincode,
                            'to_name' =>  $jsndata->billing_address->first_name . ' ' . $jsndata->billing_address->last_name,
                            'to_phone_number' => $phnum,
                            //'to_phone_number' => '9996242898',
                            'to_pincode' => $jsndata->billing_address->zip,
                            //'to_pincode' => '132157',
                            'to_address' => $jsndata->billing_address->address1 . $addres2orders,
                            'quantity' => $order_name_count,
                            'invoice_value' => $shipping_pay_amount,
                            'cod_amount' => $shipping_pay_amount1,
                            'client_order_id' => str_replace("#", "", $jsndata->name),
                            'item_breadth' => 1,
                            'item_length' => 1,
                            'item_height' => 1,
                            'item_weight' => $weightkgs,
                            'is_reverse' => false
                        );

                        // $resposne_array = array("name" => "Pickerr Order Sync " . json_encode($post_params));
                        // $this->user_model->check_test_response($resposne_array);

                        // try {
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
                        $result1 = curl_exec($ch);
                        $result = json_decode($result1, true);

                        //close connection
                        curl_close($ch);
                        // $log_filename = "log";
                        // // $log_msg = $resp;
                        // if (!file_exists($log_filename)) {

                        //     mkdir($log_filename, 0777, true);
                        // }
                        // $log_file_data = $log_filename . '/log_' . date('d-M-Y') . '.log';
                        // file_put_contents($log_file_data, print_r($result, true));

                        $resposne_array = array("name" => "Pickerr Order Sync= " . $result1);
                        $this->user_model->check_test_response($resposne_array);

                        if (isset($result['err'])) {

                            $return_array[$jsndata->id][] = $result['err'];
                            $this->user_model->update_pickr_err($jsndata->id, $_GET['whshp'], substr($result['err'], 0, 48) . ' missing');
                        } else {
                            //$this->user_model->update_plan_orders(1, $_GET['whshp']); //update sync update order count for price plan
                            $this->user_model->update_pickrr_order($jsndata->id, $_GET['whshp']);
                            $update_orders = array(
                                "order_id" => $jsndata->id,
                                "order_response_tracking_id" => $result['tracking_id'],
                                "shop_url" => $_GET['whshp']
                            );
                            $this->user_model->update_order_details($update_orders);
                            $return_array[$jsndata->id][] = 'Sync Done';
                        }



                        // } catch (\Exception $e) {
                        //     $return_array[] = $e;
                        // }
                    } else  if (isset($shiprocket_info[0]->enable_shipping_type) && $shiprocket_info[0]->enable_shipping_type == 'delhivery') {
                        //echo "delhoivery";

                        if ($order_pay_sts == 'partial') {
                            $shipping_pay_method = "Postpaid";
                            $shipping_pay_amount = $remaing_proice;
                        } else if ($order_pay_sts == 'cod') {
                            $shipping_pay_method = "Postpaid";
                            $shipping_pay_amount = $jsndata->total_price;
                        } else {
                            $shipping_pay_method = "Prepaid";
                            $shipping_pay_amount = $jsndata->total_price;
                        }



                        if ($jsndata->billing_address->phone == "") {
                            $phnum = "9865986598";
                        } else {
                            $phnum = str_replace(" ", "", $jsndata->billing_address->phone);
                            $phnum = str_replace("(", "", $phnum);
                            $phnum = str_replace(")", "", $phnum);
                            $phnum = str_replace("-", "", $phnum);
                        }


                        $addres2orders = "";
                        if (isset($jsndata->billing_address->address2)) {
                            $addres2orders = " " . $jsndata->billing_address->address2;
                        }
                        $postdata = 'format=json&data={
                            "shipments": [
                                {
                                    "add": "' . $jsndata->billing_address->address1 . $addres2orders . '",
                                    "address_type": "home",
                                    "phone": "' . $phnum . '",
                                    "payment_mode": "' . $shipping_pay_method . '",
                                    "name": "' . $jsndata->billing_address->first_name . ' ' . $jsndata->billing_address->last_name . '",
                                    "pin": "' . $jsndata->billing_address->zip . '",
                                    "order": "' . str_replace("#", "", $jsndata->name) . '",
                                    "country": "' . $jsndata->billing_address->country . '",
                                    "cod_amount": ' . $shipping_pay_amount . ',
                                    "waybill": "",
                                    "shipping_mode": "Surface"
                                }
                            ],
                            "pickup_location": {
                                "name": "' . $shiprocket_info[0]->pickup_location . '"
                            }
                        }';

                        $get_result = $this->common->create_custom_order_delhivery($postdata,  $shiprocket_info[0]->shp_token);

                        // $log_filename = "log";
                        // // $log_msg = $resp;
                        // if (!file_exists($log_filename)) {

                        //     mkdir($log_filename, 0777, true);
                        // }
                        // $log_file_data = $log_filename . '/log_' . date('d-M-Y') . '.log';
                        // file_put_contents($log_file_data, print_r($get_result, true));


                        $resposne_array = array("name" => "DelhiVery Order Sync= " . json_encode($get_result));
                        $this->user_model->check_test_response($resposne_array);

                        if (isset($get_result['success']) && ($get_result['success'] == true || $get_result['success'] == 'true')) {
                            // throw new \Exception(print_r($result, true) . "Problem in connecting with Pickrr");
                            // throw new \Exception($result['err']);
                            //$this->user_model->update_plan_orders(1, $_GET['whshp']); //update sync update order count for price plan
                            $this->user_model->update_delhivery_order($jsndata->id, $_GET['whshp']);
                            $return_array[$jsndata->id][] = 'Sync Done';
                        } else {
                            if (!empty($get_result['packages'][0]['remarks'][0])) {
                                $return_array[$jsndata->id][] = $get_result['packages'][0]['remarks'][0];
                                $this->user_model->update_delhivery_err($jsndata->id, $_GET['whshp'], str_replace("'", "", $get_result['packages'][0]['remarks'][0]));

                                // $resposne_array = array("name" => "notes=" . str_replace("'", "", $get_result['packages'][0]['remarks'][0]));
                                // $this->user_model->check_test_response($resposne_array);
                            } else {
                                $return_array[$jsndata->id][] = $get_result['detail'];
                                $this->user_model->update_delhivery_err($jsndata->id, $_GET['whshp'], $get_result['detail']);
                            }
                        }
                        // $resposne_array = array("name" => "delhivery" . json_encode($get_result));
                        // $this->user_model->check_test_response($resposne_array);

                        // $resposne_array = array("name" => "delhivery return_array=" . json_encode($return_array));
                        // $this->user_model->check_test_response($resposne_array);

                        //$this->order_sync_delhivery($shiprocket_info);
                    }
                    //}
                    $webstsrti = $webstsrti + 1;
                    //}
                    echo "200 ok";
                }
                echo "200 ok";
            }

            // } else {
            //     echo "no-data";
            // }
            //}
            echo "200 ok";
            $resposne_array_lst = array("name" => "End Order Sync Process For Shop " . $_GET['whshp']);
            $this->user_model->check_test_response($resposne_array_lst);
        }

        //return json_encode($return_array);
    }

    public function update_token($shop_url)
    {

        //echo $_REQUEST['shop'];
        $shiprocket_info = $this->user_model->get_shiprocket_config_home($shop_url);
        if (!empty($shiprocket_info)) {
            //print_r($shiprocket_info);
            $ship_email = $shiprocket_info[0]->email;
            $ship_password = $shiprocket_info[0]->password;

            // $get_response = $this->common->call_api_curl('https://apiv2.shiprocket.in/v1/external/auth/login?email=' . trim($ship_email) . '&password=' . trim($ship_password) . '', '', 'POST', '');
            $get_response = $this->common->get_shiprocket_token($ship_email, $ship_password);

            $resposne_array_lst = array("name" => "token section " . $get_response);
            $this->user_model->check_test_response($resposne_array_lst);
            $new_res = json_decode($get_response);
            // print_r($new_res);
            // die();
            $insert_array = array(
                "token" => $new_res->token,
                "token_generate_date" => date('Y-m-d'),
                "token_expiray_date" => date('Y-m-d', strtotime('+5 day')),
                "shop_url" => $shop_url,
            );
            $this->user_model->track_shiprocket_api_token($insert_array);
            return $new_res->token;
        } else {
            return "in_correct";
        }
    }
    public function paidordernotify()
    {

        $paid_order_webhook_content = NULL;
        // Get webhook content from the POST
        $webhookpd = fopen('php://input', 'rb');
        while (!feof($webhookpd)) {
            $paid_order_webhook_content .= fread($webhookpd, 4096);
        }
        fclose($webhookpd);
        $paid_orders_content = json_decode($paid_order_webhook_content);
        $get_orders_details = $this->user_model->get_order_detail($paid_orders_content->id);


        // $log_filename = "log";
        // // $log_msg = $resp;
        // if (!file_exists($log_filename)) {

        //     mkdir($log_filename, 0777, true);
        // }
        // $log_file_data = $log_filename . '/log_' . date('d-M-Y') . '.log';
        // file_put_contents($log_file_data, print_r($_GET, true));

        if (!empty($get_orders_details)) {
            $update_orders = array(
                "order_id" => $paid_orders_content->id,
                "order_status" => "paid",
                "order_price" => 0,
                "shop_url" => $_GET['shpname'],
                "pending_amount" => 0
            );
            $this->user_model->update_order_details($update_orders); //update orders with status paid
            // $shiprocket_info = $this->user_model->get_shiprocket_config_home($_GET['shpname']);



            // if (isset($shiprocket_info[0]->enable_shipping_type) && $shiprocket_info[0]->enable_shipping_type == 'ship_roc') {
            // $create_custom = array();
            // $return_array = array();


            // if ($paid_orders_content->billing_address->phone == "") {
            //     $phnum = "9865986598";
            // } else {
            //     $phnum = str_replace(" ", "", $paid_orders_content->billing_address->phone);
            //     $phnum = str_replace("(", "", $phnum);
            //     $phnum = str_replace(")", "", $phnum);
            //     $phnum = str_replace("-", "", $phnum);
            // }

            // if ($order_pay_sts == 'partial') {
            //     $shipping_pay_method = "Partial";
            //     $shipping_pay_amount = $remaing_proice;
            // } else if ($order_pay_sts == 'cod') {
            //     $shipping_pay_method = "COD";
            //     $shipping_pay_amount = $jsndata->total_price;
            // } else {
            //     $shipping_pay_method = "Prepaid";
            //     $shipping_pay_amount = $jsndata->total_price;
            // }

            // // if($jsndata->financial_status == "pending"){
            // //     $shipping_pay_method = "COD";
            // //     $shipping_pay_amount = $jsndata->total_price;
            // // }


            // $create_custom = array(
            //     "order_id" => $paid_orders_content->order_number,
            //     "order_date" => $paid_orders_content->created_at,
            //     "channel_id" => $shiprocket_info[0]->channel_id,
            //     "comment" => "Prepaid",
            //     "billing_customer_name" => $paid_orders_content->billing_address->first_name,
            //     "billing_last_name" => $paid_orders_content->billing_address->last_name,
            //     "billing_address" => $paid_orders_content->billing_address->address1,
            //     "billing_city" => $paid_orders_content->billing_address->city,
            //     "billing_pincode" => $paid_orders_content->billing_address->zip,
            //     "billing_state" => $paid_orders_content->billing_address->province,
            //     "billing_country" => $paid_orders_content->billing_address->country,
            //     "billing_email" => $paid_orders_content->customer->email,
            //     "billing_phone" => trim($phnum),
            //     "shipping_is_billing" => true,
            //     "payment_method" => "Prepaid",
            //     "sub_total" => $paid_orders_content->total_price,
            //     "length" => 1,
            //     "breadth" => 1,
            //     "height" => 1,
            //     "weight" => 1,
            // );

            // foreach ($jsndata->line_items as $productsitm) {
            //     if ($productsitm->name != 'Partial Pending Payment') {
            //         if ($productsitm->sku == "") {
            //             $getsku = "PARTSKU";
            //         } else {
            //             $getsku = $productsitm->sku;
            //         }
            //         $priceamnt = 0;
            //         if (isset($productsitm->properties) && $productsitm->properties[3]->name == 'remaining_amount') {
            //             $priceamnt = $productsitm->properties[3]->value;
            //         } else {
            //             $priceamnt = $productsitm->price;
            //         }
            //         $skuval = $productsitm->sku;
            //         if (isset($productsitm->properties) && $productsitm->properties[4]->name == 'psku') {
            //             $skuval = $productsitm->properties[4]->value;
            //         }
            //         // }else {
            //         //     $priceamnt = $productsitm->price;
            //         // }
            //         $create_custom['order_items'][] = array(
            //             "name" => $productsitm->name,
            //             "sku" => $skuval,
            //             // "sku" => "PARTDGKI",
            //             "units" => $productsitm->quantity,
            //             // "selling_price" => $productsitm->price
            //             "selling_price" => $priceamnt
            //         );
            //     }
            // }


            // // print_r($create_custom);

            // $resposne_array = array("name" => "create_custom=" . json_encode($create_custom));
            // $this->user_model->check_test_response($resposne_array);


            // //    $resposne_array = array("name" => "create_custom=" . json_encode($create_custom));
            // //     $this->user_model->check_test_response($resposne_array);

            // $get_result = $this->common->create_custom_order($create_custom, $store_token);
            // $decoded_res = json_decode($get_result);

            // $resposne_array = array("name" => "ordersync=" . $get_result);
            // $this->user_model->check_test_response($resposne_array);




            // if (isset($decoded_res->message) && $decoded_res->message != "") {

            //     if (isset($decoded_res->errors)) {
            //         $senderror = $decoded_res->errors;
            //         $return_array['error'][] = array("error" => $senderror);
            //         $shperr =  serialize($decoded_res->errors);
            //     } else {
            //         $shperr =  $decoded_res->message;
            //         $return_array['error'][] = array("error" => $shperr);
            //     }

            //     // $return_array['error'][] = array("error" => $decoded_res->errors);

            //     // $shperr =  serialize($decoded_res->errors);

            //     $this->user_model->update_shiprocket_err($jsndata->id, $_GET['whshp'], $shperr);
            // } else {

            //     $this->user_model->update_plan_orders(1, $_GET['whshp']); //update sync update order count for price plan

            //     $this->user_model->track_sync_order($jsndata->id, $_GET['whshp']);
            //     $return_array['success'][] = array("success" => "order sync successfully for order " . $jsndata->id);
            // }
            // $resposne_array = array("name" => "return_array=" . json_encode($return_array));
            // $this->user_model->check_test_response($resposne_array);
            //} else  if (isset($shiprocket_info[0]->enable_shipping_type) && $shiprocket_info[0]->enable_shipping_type == 'pickr') {
            // $log_filename = "log";
            // // $log_msg = $resp;
            // if (!file_exists($log_filename)) {

            //     mkdir($log_filename, 0777, true);
            // }
            // $log_file_data = $log_filename . '/log_' . date('d-M-Y') . '.log';
            // file_put_contents($log_file_data, print_r($get_orders_details, true));


            // //below code for cancel the orders for edit order
            // $post_params_cancel = array(
            //     'auth_token' => $shiprocket_info[0]->shp_token,
            //     'tracking_id' => $get_orders_details->order_response_tracking_id
            // );
            // $resposne_array = array("name" => "canelparms" . json_encode($post_params_cancel));
            // $this->user_model->check_test_response($resposne_array);
            // // try {
            // $json_paramscancel = json_encode($post_params_cancel);
            // $url2 = 'https://pickrr.com/api/order-cancellation/';
            // //open connection
            // $ch2 = curl_init();
            // //set the url, number of POST vars, POST data
            // curl_setopt($ch2, CURLOPT_URL, $url2);
            // curl_setopt($ch2, CURLOPT_POSTFIELDS, $json_paramscancel);
            // curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            // curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
            // //execute post
            // $cancel_result = curl_exec($ch2);
            // $decode_result = json_decode($cancel_result, true);

            // //close connection
            // curl_close($ch2);



            // $resnew = array("name" => "cancel_response" . $cancel_result);
            // $this->user_model->check_test_response($resnew);



            // $create_custom = array();
            // $create_customqty = array();
            // $item_listarr = array();
            // foreach ($paid_orders_content->line_items as $products) {
            //     if ($products->name != 'Partial Pending Payment') {
            //         $create_custom[] = $products->name;
            //         $create_customqty[] = $products->qty;
            //         $item_listarr[] = array(
            //             "price" => $products->price,
            //             "item_name" => $products->name,
            //             "quantity" => $products->qty,
            //             "sku" => $products->sku,
            //         );
            //     }
            // }

            // if (!empty($create_custom)) {
            //     $order_name = implode(",", $create_custom);
            //     $order_name_count = count($create_customqty);
            // }

            // if ($paid_orders_content->billing_address->phone == "") {
            //     $phnum = "9865986598";
            // } else {
            //     $phnum = str_replace(" ", "", $paid_orders_content->billing_address->phone);
            //     $phnum = str_replace("(", "", $phnum);
            //     $phnum = str_replace(")", "", $phnum);
            //     $phnum = str_replace("-", "", $phnum);
            // }


            // $shipping_pay_method = "Prepaid";
            // $shipping_pay_amount = $paid_orders_content->total_price;
            // $shipping_pay_amount1 = 0;




            // $post_params = array(
            //     'auth_token' => $shiprocket_info[0]->shp_token,
            //     'item_name' => $order_name,
            //     'item_list' => $item_listarr,
            //     'from_name' => $shiprocket_info[0]->pickrr_company,
            //     'from_phone_number' => $shiprocket_info[0]->pickrr_from_phone,
            //     'from_address' => $shiprocket_info[0]->shipping_address,
            //     'from_pincode' => $shiprocket_info[0]->pickrr_pincode,
            //     'to_name' =>  $paid_orders_content->billing_address->first_name . ' ' . $paid_orders_content->billing_address->last_name,
            //     'to_phone_number' => $phnum,
            //     //'to_phone_number' => '9996242898',
            //     'to_pincode' => $paid_orders_content->billing_address->zip,
            //     //'to_pincode' => '132157',
            //     'to_address' => $paid_orders_content->billing_address->address1,
            //     'quantity' => $order_name_count,
            //     'invoice_value' => $shipping_pay_amount,
            //     'cod_amount' => $shipping_pay_amount,
            //     'client_order_id' => $paid_orders_content->order_number,
            //     'item_breadth' => 1,
            //     'item_length' => 1,
            //     'item_height' => 1,
            //     'item_weight' => 0.5,
            //     'is_reverse' => false
            // );
            // $resposne_array = array("name" => "pickrerparmsnew" . json_encode($post_params));
            // $this->user_model->check_test_response($resposne_array);
            // // try {
            // $json_params = json_encode($post_params);
            // $url = 'https://www.pickrr.com/api/place-order/';
            // //open connection
            // $ch = curl_init();
            // //set the url, number of POST vars, POST data
            // curl_setopt($ch, CURLOPT_URL, $url);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $json_params);
            // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // //execute post
            // $result1 = curl_exec($ch);
            // $result = json_decode($result1, true);

            // //close connection
            // curl_close($ch);

            // $resposne_array = array("name" => "orderpickrrpanow=" . $result1);
            // $this->user_model->check_test_response($resposne_array);

            // if (isset($result['err'])) {

            //     $return_array[$paid_orders_content->id][] = $result['err'];
            //     $this->user_model->update_pickr_err($paid_orders_content->id, $_GET['whshp'], substr($result['err'], 0, 48) . ' missing');
            // } else {
            //     $this->user_model->update_plan_orders(1, $_GET['whshp']); //update sync update order count for price plan
            //     $this->user_model->update_pickrr_order($paid_orders_content->id, $_GET['whshp']);

            //     $update_orders = array(
            //         "order_id" => $paid_orders_content->id,
            //         "order_response_tracking_id" => $result['tracking_id'],
            //         "shop_url" => $_GET['whshp']
            //     );
            //     $this->user_model->update_order_details($update_orders);


            //     $return_array[$paid_orders_content->id][] = 'Sync Done';
            // }
            // } else  if (isset($shiprocket_info[0]->enable_shipping_type) && $shiprocket_info[0]->enable_shipping_type == 'delhivery') {
            //echo "delhoivery";

            // if ($order_pay_sts == 'partial') {
            //     $shipping_pay_method = "Postpaid";
            //     $shipping_pay_amount = $remaing_proice;
            // } else if ($order_pay_sts == 'cod') {
            //     $shipping_pay_method = "Postpaid";
            //     $shipping_pay_amount = $jsndata->total_price;
            // } else {
            //     $shipping_pay_method = "Prepaid";
            //     $shipping_pay_amount = $jsndata->total_price;
            // }



            // if ($paid_orders_content->billing_address->phone == "") {
            //     $phnum = "9865986598";
            // } else {
            //     $phnum = str_replace(" ", "", $paid_orders_content->billing_address->phone);
            //     $phnum = str_replace("(", "", $phnum);
            //     $phnum = str_replace(")", "", $phnum);
            //     $phnum = str_replace("-", "", $phnum);
            // }

            // $postdata = 'format=json&data={
            //             "shipments": [
            //                 {
            //                     "waybill": "21540310000766"
            //                 }
            //             ]
            //         }';

            // $get_result = $this->common->update_delhivery_order($postdata,  $shiprocket_info[0]->shp_token);


            // $resposne_array = array("name" => "orderpickrr=" . json_encode($get_result));
            // $this->user_model->check_test_response($resposne_array);

            // if (isset($get_result['success']) && ($get_result['success'] == true || $get_result['success'] == 'true')) {
            //     // throw new \Exception(print_r($result, true) . "Problem in connecting with Pickrr");
            //     // throw new \Exception($result['err']);
            //     $this->user_model->update_plan_orders(1, $_GET['whshp']); //update sync update order count for price plan
            //     $this->user_model->update_delhivery_order($jsndata->id, $_GET['whshp']);
            //     $return_array[$jsndata->id][] = 'Sync Done';
            // } else {
            //     if (!empty($get_result['packages'][0]['remarks'][0])) {
            //         $return_array[$jsndata->id][] = $get_result['packages'][0]['remarks'][0];
            //         $this->user_model->update_delhivery_err($jsndata->id, $_GET['whshp'], str_replace("'", "", $get_result['packages'][0]['remarks'][0]));

            //         // $resposne_array = array("name" => "notes=" . str_replace("'", "", $get_result['packages'][0]['remarks'][0]));
            //         // $this->user_model->check_test_response($resposne_array);
            //     } else {
            //         $return_array[$jsndata->id][] = $get_result['detail'];
            //         $this->user_model->update_delhivery_err($jsndata->id, $_GET['whshp'], $get_result['detail']);
            //     }
            // }
            // // $resposne_array = array("name" => "delhivery" . json_encode($get_result));
            // // $this->user_model->check_test_response($resposne_array);

            // $resposne_array = array("name" => "delhivery return_array=" . json_encode($return_array));
            // $this->user_model->check_test_response($resposne_array);

            //$this->order_sync_delhivery($shiprocket_info);
            // }
            // $resposne_array = array("name" => "invoice email paid=" . $_GET['shpname'] . $paid_order_webhook_content);
            // $this->user_model->check_test_response($resposne_array);
        }
        echo "200 ok";
        exit();
    }
    public function update_productswebhk()
    {

        $update_product_content = NULL;

        // Get webhook content from the POST
        $webhookpd = fopen('php://input', 'rb');
        while (!feof($webhookpd)) {
            $update_product_content .= fread($webhookpd, 4096);
        }

        fclose($webhookpd);

        $get_productsup = json_decode($update_product_content);

        $array_get_perc = array(
            "product_id" => $get_productsup->id,
            "shop_url" => $_GET['pxupprshp']
        );
        $get_partpecentage = $this->user_model->get_partial_percentage($array_get_perc);
        // echo "<pre>";
        // print_r($get_partpecentage);
        // echo "</pre>";

        if (!empty($get_partpecentage)) {
            $product_array = array(
                "product_id" => $get_productsup->id,
                "product_title" => $get_productsup->title,
                "shop_url" => $_GET['pxupprshp'],
                "partial_percentage" => $get_partpecentage[0]->partial_percentage
            );
            $this->user_model->add_partial_products($product_array);

            foreach ($get_productsup->variants as $produc_varaien) {
                $product_array = array(
                    "product_id" => $get_productsup->id,
                    "varient_id" => $produc_varaien->id,
                    "title" => $produc_varaien->title,
                    "price" => $produc_varaien->price,
                    "shop_url" => $_GET['pxupprshp'],
                    "partial_percentage" => $get_partpecentage[0]->partial_percentage
                );
                $this->user_model->add_partial_products_varient($product_array);
            }
            // $updateprorespo = array("name" => "update products for shop=" . $update_product_content);
            // $this->user_model->check_test_response($updateprorespo);
        }

        // $log_filename = "log";
        // // $log_msg = $resp;
        // if (!file_exists($log_filename)) {

        //     mkdir($log_filename, 0777, true);
        // }
        // $log_file_data = $log_filename . '/log_' . date('d-M-Y') . '.log';
        // file_put_contents($log_file_data, print_r($get_productsup, true));
    }

    function markpaidorderemail()
    {

        // $update_product_content = NULL;

        // // Get webhook content from the POST
        // $webhookpd = fopen('php://input', 'rb');
        // while (!feof($webhookpd)) {
        //     $update_product_content .= fread($webhookpd, 4096);
        // }

        // fclose($webhookpd);

        // $get_productsup = json_decode($update_product_content);
        // $updateprorespo = array("name" => "mark paid webhook=" . $update_product_content);
        // $this->user_model->check_test_response($updateprorespo);
    }
    function add_cart_webhook_data()
    {

        $getaddtocartdata = NULL;

        // Get webhook content from the POST
        $webhookpd = fopen('php://input', 'rb');
        while (!feof($webhookpd)) {
            $getaddtocartdata .= fread($webhookpd, 4096);
        }

        fclose($webhookpd);

        $get_addtocartdata = json_decode($getaddtocartdata);
        $updateprorespo = array("name" => "cart creat webhook=" . $getaddtocartdata);
        $this->user_model->check_test_response($updateprorespo);
        foreach ($get_addtocartdata->line_items as $cart_item) {

            $condtion_array = array(
                "product_id" => $cart_item->product_id,
                "varient_id" => $cart_item->variant_id
            );

            $get_resulrs = $this->user_model->get_store_product($_GET['cartshop'], $condtion_array);
            if (!empty($get_resulrs)) {
                $partialtype = "partial";
            } else {
                $partialtype = "fullpay";
            }
            $add_to_cart_line_item = array(
                "cart_id" => $get_addtocartdata->id,
                "product_id" => $cart_item->product_id,
                "variant_id" => $cart_item->variant_id,
                "shop_url" => $_GET['cartshop'],
                "product_type" => $partialtype,
            );
            $this->user_model->track_cart_itme_data($add_to_cart_line_item);
        }
    }
    function update_cart_webhook_data()
    {

        $getaddtocartdata = NULL;

        // Get webhook content from the POST
        $webhookpd = fopen('php://input', 'rb');
        while (!feof($webhookpd)) {
            $getaddtocartdata .= fread($webhookpd, 4096);
        }

        fclose($webhookpd);

        $get_addtocartdata = json_decode($getaddtocartdata);
        $updateprorespo = array("name" => "update cart webhook dynamic=" . $getaddtocartdata);
        $this->user_model->check_test_response($updateprorespo);

        $remove_cart_item = array(
            "cart_id" => $get_addtocartdata->id,
            "shop_url" => $_GET['cshop']
        );

        $this->user_model->remove_cart_item($remove_cart_item);

        foreach ($get_addtocartdata->line_items as $cart_item) {

            $condtion_array = array(
                "product_id" => $cart_item->product_id,
                "varient_id" => $cart_item->variant_id
            );

            $get_resulrs = $this->user_model->get_store_product($_GET['cshop'], $condtion_array);
            if (!empty($get_resulrs)) {
                $partialtype = "partial";
                $partial_percentage = $get_resulrs[0]->partial_percentage;
            } else {
                $partialtype = "fullpay";
                $partial_percentage = '';
            }

            if (isset($cart_item->properties)) {
                $cart_proer = json_encode($cart_item->properties);
            } else {
                $cart_proer = "";
            }
            $add_to_cart_line_item = array(
                "cart_id" => $get_addtocartdata->id,
                "product_id" => $cart_item->product_id,
                "variant_id" => $cart_item->variant_id,
                "shop_url" => $_GET['cshop'],
                "product_type" => $partialtype,
                "product_properties" => $cart_proer,
                "partial_percentage" => $partial_percentage,
            );

            $updateprorespo = array("name" => "update items=" . json_encode($add_to_cart_line_item));
            $this->user_model->check_test_response($updateprorespo);
            $this->user_model->track_cart_itme_data($add_to_cart_line_item);
        }
    }
    function product_create_whok()
    {

        $add_proct = NULL;
        // Get webhook content from the POST
        $webhookpd = fopen('php://input', 'rb');
        while (!feof($webhookpd)) {
            $add_proct .= fread($webhookpd, 4096);
        }

        fclose($webhookpd);

        $get_addtocartdata = json_decode($add_proct);
        $updateprorespo = array("name" => "create_product=" . $add_proct);
        $this->user_model->check_test_response($updateprorespo);

        //  $log_filename = WRITEPATH . "whlogslgs";
        // // $log_msg = $resp;
        // if (!file_exists($log_filename)) {

        //     mkdir($log_filename, 0777, true);
        // }
        // $log_file_data = $log_filename . '/log_' . date('d-M-Y') . '.log';
        // file_put_contents($log_file_data, print_r($get_addtocartdata, true)); 


        if ($_GET['cpwshop'] == 'onlyneon1.myshopify.com' && $get_addtocartdata->product_type == 'PPLR_HIDDEN_PRODUCT') {
            $payxnowrest_product_add = array(
                "product_id" => $get_addtocartdata->id,
                "product_title" => $get_addtocartdata->title,
                "shop_url" => $_GET['cpwshop'],
                "partial_percentage" => 30,
                "add_date" => date('Y-m-d'),
                "collection_id" => ''
            );
            //below function is used for add products into partial list & update partial products of store according their plan
            $this->user_model->add_partial_products_customonly($payxnowrest_product_add);

            foreach ($get_addtocartdata->variants as $produc_varaien) {
                $product_array = array(
                    "product_id" => $produc_varaien->product_id,
                    "varient_id" => $produc_varaien->id,
                    "title" => $produc_varaien->title,
                    "price" => $produc_varaien->price,
                    "partial_percentage" => 30,
                    "shop_url" => $_GET['cpwshop'],
                    "collection_id" =>  ''
                );
                $this->user_model->add_partial_products_varient($product_array);
            }
        }
    }
}
echo "200 ok";
