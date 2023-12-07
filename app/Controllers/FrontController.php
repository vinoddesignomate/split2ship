<?php

namespace App\Controllers;

use App\Models\FrontModel;
use App\Models\UserModel;
use App\Models\ExchangeappModel;

class FrontController extends BaseController
{
    protected $base;
    protected $front_model;
    protected $user_model;
    protected $exchange_model;

    function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        helper(['form', 'url']);
        $session = \Config\Services::session();
        //$this->front_model = new FrontModel();
        $this->user_model = new UserModel();
        $this->exchange_model = new ExchangeappModel();
    }
    public function get_product_details()
    {

        $shopname = str_replace("https://", "", $this->request->getPost('shopname'));
        $shopname = str_replace("http://", "", $shopname);

        $plan_details = $this->user_model->get_store_plan($shopname);

        if (!empty($plan_details)) {
            if ($plan_details[0]->plan_status == 'active' && $plan_details[0]->updated_sync_orders_count > 0) {
                if ($this->request->getPost('pid')) {
                    $condtion_array = array(
                        "product_id" => $this->request->getPost('pid'),
                        "varient_id" => $this->request->getPost('vid')
                    );
                } else {
                    $condtion_array = array(
                        "varient_id" => $this->request->getPost('vid')
                    );
                }
                $get_resulrs = $this->user_model->get_store_product($shopname, $condtion_array);
                $gtbtncolor = $this->user_model->get_checkout_button_color($shopname);

                if (!empty($get_resulrs)) {

                    if (isset($get_resulrs[0]->partial_percentage) && $get_resulrs[0]->partial_percentage != "") {
                        $partial_percentage = str_replace("%", "", $get_resulrs[0]->partial_percentage);
                        $propartialper = ($partial_percentage / 100) * $get_resulrs[0]->price;
                        $partperctg = $partial_percentage;
                    } else {
                        $propartialper = (10 / 100) * $get_resulrs[0]->price;
                        $partperctg = 10;
                    }
                    if ($partperctg > $get_resulrs[0]->price) {
                        return 'not_found';
                    } else {

                        if (empty($gtbtncolor)) {
                            $return_array = array(
                                "full_price" => $get_resulrs[0]->price,
                                "pro_pack" => $partperctg,
                                "partial_type" => $get_resulrs[0]->partial_type,
                                "partial_price" => $propartialper,
                                "cart_form_class" => isset($gtbtncolor[0]->cart_form_class) ? $gtbtncolor[0]->cart_form_class : 'shopify-product-form',
                                "cart_button_id" => isset($gtbtncolor[0]->addcartbtn_cg) ? $gtbtncolor[0]->addcartbtn_cg : 'product-add-to-cart',
                                "cg_chkout_btn_class" => isset($gtbtncolor[0]->cg_chkout_btn_class) ? $gtbtncolor[0]->cg_chkout_btn_class : 'btn-checkout',
                                "add_to_cartbtn" => 1,
                                "buy_partial_btn" => '',
                                "full_pay_buybtn" => '',
                                "add_to_cart_text" => '',
                                "partial_buy_now_text" => '',
                                "full_buy_now_text" => '',
                                "add_cart_btn_color" => '',
                                "add_cart_text_color" => '',
                                "partial_buynow_btn_color" => '',
                                "partial_buynow_text_color" => '',
                                "full_buy_btn_color" => '',
                                "full_buy_text_color" => '',
                            );
                        } else {
                            $return_array = array(
                                "full_price" => $get_resulrs[0]->price,
                                "pro_pack" => $partperctg,
                                "partial_type" => $get_resulrs[0]->partial_type,
                                "partial_price" => $propartialper,
                                "cart_form_class" => isset($gtbtncolor[0]->cart_form_class) ? $gtbtncolor[0]->cart_form_class : 'shopify-product-form',
                                "cart_button_id" => isset($gtbtncolor[0]->addcartbtn_cg) ? $gtbtncolor[0]->addcartbtn_cg : 'product-add-to-cart',
                                "cg_chkout_btn_class" => isset($gtbtncolor[0]->cg_chkout_btn_class) ? $gtbtncolor[0]->cg_chkout_btn_class : 'btn-checkout',
                                "add_to_cartbtn" => isset($gtbtncolor[0]->add_to_cartbtn) ? $gtbtncolor[0]->add_to_cartbtn : 1,
                                "buy_partial_btn" => $gtbtncolor[0]->buy_partial_btn,
                                "full_pay_buybtn" => $gtbtncolor[0]->full_pay_buybtn,
                                "add_to_cart_text" => $gtbtncolor[0]->add_to_cart_text,
                                "partial_buy_now_text" => $gtbtncolor[0]->partial_buy_now_text,
                                "full_buy_now_text" => $gtbtncolor[0]->full_buy_now_text,
                                "add_cart_btn_color" => $gtbtncolor[0]->add_cart_btn_color,
                                "add_cart_text_color" => $gtbtncolor[0]->add_cart_text_color,
                                "partial_buynow_btn_color" => $gtbtncolor[0]->partial_buynow_btn_color,
                                "partial_buynow_text_color" => $gtbtncolor[0]->partial_buynow_text_color,
                                "full_buy_btn_color" => $gtbtncolor[0]->full_buy_btn_color,
                                "full_buy_text_color" => $gtbtncolor[0]->full_buy_text_color,
                            );
                        }
                        return json_encode($return_array);
                    }
                } else {
                    return 'not_found';
                }
            } else {
                return 'not_found';
            }
        } else {
            return 'not_found';
        }
    }
    function generateRandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }
    public function create_coupon_discount_order($body_data_decode, $remaining_price)
    {
        $returndata = array();
        $shopname = str_replace("https://", "", $body_data_decode['shopname']);
        $shopname = str_replace("http://", "", $shopname);
        $get_details = $this->user_model->get_tokens($shopname);
        // $randnum = rand(1, 100);
        $randnum = $this->generateRandomString(6);
        $coupon_name = 'Remaining_Amount(' . $randnum . ')';
        $creatruledata = [
            "price_rule" => [
                "title" => $coupon_name,
                "target_type" => "line_item",
                "value_type" => 'fixed_amount',
                "value" => $remaining_price,
                "target_selection" => "all",
                "customer_selection" => "all",
                "allocation_method" => "across",
                "starts_at" => date("Y-m-d H:i:s"),
            ]
        ];
        //print_r($creatruledata);
        $getprietuleid = $this->common->rest_api('/admin/api/2023-10/price_rules.json', $creatruledata, 'POST', $get_details->access_token, $shopname);

        $getprietuleidrec = json_decode($getprietuleid['body'], true);
        //print_r($getprietuleidrec);
        if (array_key_exists('errors', $getprietuleidrec)) {
            echo "invalid";
        } else {

            $creatediscode = [
                "discount_code" => [
                    "code" => $coupon_name,
                ]
            ];


            $createcoupon = $this->common->rest_api('/admin/api/2023-10/price_rules/' . $getprietuleidrec['price_rule']['id'] . '/discount_codes.json', $creatediscode, 'POST', $get_details->access_token, $shopname);
            $createcouponrec = json_decode($createcoupon['body'], true);
            //print_r($createcouponrec);
            if (array_key_exists('errors', $createcouponrec)) {
                echo "invalid";
            } else {
                echo $coupon_name . "spltcg" . $getprietuleidrec['price_rule']['id'] . "spltcg" . $createcouponrec['discount_code']['id'];
            }
        }
        //print_r($returndata);
        //return $returndata;
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


        if ($get_details->zip_code_enable_disabled == 0) {
            $line_item_arra = array();
            $chekpartial = 0;
            $remaining_price = 0;
            $illp = 0;
            // if ($_SERVER['HTTP_X_FORWARDED_FOR'] == '103.80.119.106') {
            //     echo "<pre>";
            //     print_r($cartarray);
            //     echo "</pre>";
            //     //die();
            // }

            // if ($_SERVER['HTTP_X_FORWARDED_FOR'] == '103.80.119.106') {
            //     $reqship = false;
            // }else{
            //     $reqship = true;
            // }
            $reqship = true;
            $ilosku = 1;
            foreach ($cartarray as $item_cart) {


                if (isset($item_cart['psku']) && $item_cart['psku'] != "") {
                    $itmeskysplit =  $item_cart['psku'];
                } else {
                    $itmeskysplit =  "PART" . $ilosku . time();
                }


                if (isset($item_cart['paytype']) && $item_cart['paytype'] == 'Available') {
                    $size_tems = array();

                    foreach ($item_cart['cg_variant_options'] as $split_varient_options) {
                        if ($split_varient_options['name'] != "Title") {
                            $size_tems[] = $split_varient_options['value'];
                            // $line_item['properties'][] = array(
                            //     "name" => $split_varient_options['name'],
                            //     "value" => $split_varient_options['value']
                            // );
                        }
                    }

                    if (!empty($size_tems)) {
                        $size_order_name = implode("/", $size_tems);
                        $size_order_namenn = " - " . $size_order_name;
                        // $order_name_count = count($create_customqty);
                    } else {
                        $size_order_namenn = "";
                    }

                    $chekpartial = 1;
                    $final_price = $item_cart['price'] / $item_cart['qty'];

                    //calculating partial product discount amount start code


                    $remamoun = str_replace("-", "", $item_cart['rem_p']);
                    $payprice = $item_cart['price'];
                    $total_price = $payprice + $remamoun;
                    //calculating partial product discount amount end code
                    //if ($shopname == 'desinomatetest.myshopify.com') {
                    if ($total_price != $item_cart['item_original_price']) {

                        $itmorgprice = $item_cart['original_line_price'];
                        $dicountcodepay = $itmorgprice - $total_price;
                        //if ($dicountcodepay > 0) {
                        //$adddsicount = array("name" => "Discount", "value" => $dicountcodepay);
                        //$discounfroundedValue = round($dicountcodepay, 2);
                        //$formattedValuediscount = number_format($discounfroundedValue, 2, '.', '');
                        //$formattedValuediscount = sprintf("%.2f", $dicountcodepay);


                        //$roundedValue = bcadd($dicountcodepay, '0.005', 2); // Add 0.005 to round up
                        $formattedValuediscount = number_format($dicountcodepay, 2, '.', '');


                        $line_item  = array(
                            "title" => $item_cart['title'] . $size_order_namenn,
                            "price" => $final_price,
                            "quantity" => $item_cart['qty'],
                            "sku" => $itmeskysplit,
                            //"product_id" => $item_cart['product_id'],
                            "requires_shipping" => $reqship,
                            "grams" => $item_cart['grams'],
                            "gift_card" => true,
                            "properties" => array(
                                array("name" => "Note", "value" => "Initial Partial Payment"),
                                array("name" => "variant_code", "value" => $item_cart['id']),
                                array("name" => "partial_pay", "value" => number_format($item_cart['price'], 2, '.', '')),
                                array("name" => "remaining_amount", "value" => str_replace("-", "", $item_cart['rem_p'])),
                                array("name" => "Discount", "value" => $formattedValuediscount)
                                //array("name" => "Discount", "value" => number_format($dicountcodepay, 2, '.', ''))
                                //array("name" => "Discount", "value" => $item_cart['product_id']),
                                // array("name" => "psku", "value" => $itmeskysplit)
                            )
                        );
                    } else {
                        $line_item  = array(
                            "title" => $item_cart['title'] . $size_order_namenn,
                            "price" => $final_price,
                            "quantity" => $item_cart['qty'],
                            "sku" => $itmeskysplit,
                            //"product_id" => $item_cart['product_id'],
                            "requires_shipping" => $reqship,
                            "grams" => $item_cart['grams'],
                            "gift_card" => true,
                            "properties" => array(
                                array("name" => "Note", "value" => "Initial Partial Payment"),
                                array("name" => "variant_code", "value" => $item_cart['id']),
                                array("name" => "partial_pay", "value" => $item_cart['price']),
                                array("name" => "remaining_amount", "value" => str_replace("-", "", $item_cart['rem_p']))
                            )
                        );
                    }
                    /* } else {
                        $line_item  = array(
                            "title" => $item_cart['title'] . $size_order_namenn,
                            "price" => $final_price,
                            "quantity" => $item_cart['qty'],
                            "sku" => $itmeskysplit,
                            //"product_id" => $item_cart['product_id'],
                            "requires_shipping" => $reqship,
                            "grams" => $item_cart['grams'],
                            "gift_card" => true,
                            "properties" => array(
                                array("name" => "Note", "value" => "Initial Partial Payment"),
                                array("name" => "variant_code", "value" => $item_cart['id']),
                                array("name" => "partial_pay", "value" => $item_cart['price']),
                                array("name" => "remaining_amount", "value" => str_replace("-", "", $item_cart['rem_p']))
                                //array("name" => "Discount", "value" => $item_cart['product_id']),
                                // array("name" => "psku", "value" => $itmeskysplit)
                            )
                        );
                    }*/
                    $remaining_price = $remaining_price + $item_cart['rem_p'];
                } else {

                    //if ($_SERVER['HTTP_X_FORWARDED_FOR'] == '103.80.119.106') {
                    if ($item_cart['line_price'] != $item_cart['original_line_price']) {


                        $coupencodeprice = $item_cart['original_line_price']  - $item_cart['line_price'];

                        $coupencodeprice = ($coupencodeprice / $item_cart['qty']);
                        //$coupencodeprice = ($item_cart['line_level_total_discount'] / $item_cart['qty']);
                        // $coupencodeprice = round($coupencodeprice);

                        $getcpncodep = $body_data_decode['getcpncode'];
                        if ($getcpncodep != "") {
                            $couponname = $getcpncodep;
                        } else {
                            $couponname = 'Automatic';
                        }
                        $line_item = array(
                            "variant_id" => $item_cart['id'],
                            "quantity" => $item_cart['qty'],
                            "gift_card" => true,
                            "sku" => $itmeskysplit,
                            "grams" => $item_cart['grams'],
                            "applied_discount" => array(
                                "description" => $couponname,
                                "title" => $couponname,
                                "value_type" => "fixed_amount",
                                "value" => $coupencodeprice,
                                "amount" => $coupencodeprice,
                            ),
                            "properties" => array(
                                array("name" => "Note", "value" => "Full Payment"),
                                array("name" => "full_pay", "value" => $item_cart['price'])
                            ),
                            "requires_shipping" => $reqship
                        );
                    } else {
                        $line_item = array(
                            "variant_id" => $item_cart['id'],
                            "quantity" => $item_cart['qty'],
                            "gift_card" => true,
                            "sku" => $itmeskysplit,
                            "grams" => $item_cart['grams'],
                            "properties" => array(
                                array("name" => "Note", "value" => "Full Payment"),
                                array("name" => "full_pay", "value" => $item_cart['price'])
                            ),
                            "requires_shipping" => $reqship
                        );
                    }
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

                // if ($_SERVER['HTTP_X_FORWARDED_FOR'] == '103.80.119.106') {
                //code for add variants name & value to order
                if (isset($item_cart['allproperties'])) {
                    foreach ($item_cart['allproperties'] as $keypropty => $proval) {
                        if ($keypropty != "PARTIAL_PAYMENT" && substr($keypropty, 0, 1) !== "_") {
                            $line_item['properties'][] = array(
                                "name" => $keypropty,
                                "value" => $proval
                            );
                        }
                    }
                }
                //}

                $illp = $illp + 1;
                $ilosku = $ilosku + 1;
                $line_item_arra[] = $line_item;
            }
            $final_total_price_rem = str_replace("-", "", $remaining_price);

            $final_array = array("draft_order" => array("line_items" => $line_item_arra, "tags" => "partial_" . $final_total_price_rem));

            if ($shopname == 'desinomatetest.myshopify.com') {
                //if ($_SERVER['HTTP_X_FORWARDED_FOR'] == '42.109.222.28') {
                $this->create_coupon_discount_order($body_data_decode, $remaining_price);
                // }
                //if ($shopname == 'desinomatetest.myshopify.com') {
                // return $this->common->draft_order_creat2($get_details->access_token, $shopname, $final_array);
            } else {
                return $this->common->draft_order_creat($get_details->access_token, $shopname, $final_array);
            }
        } else {
            echo "zip_enabled";
        }

        //return $return_array->draft_order->invoice_url;
    }

    public function create_draft_order_zip()
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
        // if ($_SERVER['HTTP_X_FORWARDED_FOR'] == '103.80.119.106') {
        //     echo "<pre>";
        //     print_r($cartarray);
        //     echo "</pre>";
        //     die();
        // }
        $ilosku = 1;
        $reqship = true;
        foreach ($cartarray as $item_cart) {


            if (isset($item_cart['psku']) && $item_cart['psku'] != "") {
                $itmeskysplit =  $item_cart['psku'];
            } else {
                $itmeskysplit =  "PART" . $ilosku . time();
            }


            if (isset($item_cart['paytype']) && $item_cart['paytype'] == 'Available') {
                $size_tems = array();

                foreach ($item_cart['cg_variant_options'] as $split_varient_options) {
                    if ($split_varient_options['name'] != "Title") {
                        $size_tems[] = $split_varient_options['value'];
                        // $line_item['properties'][] = array(
                        //     "name" => $split_varient_options['name'],
                        //     "value" => $split_varient_options['value']
                        // );
                    }
                }

                if (!empty($size_tems)) {
                    $size_order_name = implode("/", $size_tems);
                    $size_order_namenn = " - " . $size_order_name;
                    // $order_name_count = count($create_customqty);
                } else {
                    $size_order_namenn = "";
                }

                $chekpartial = 1;
                $final_price = $item_cart['price'] / $item_cart['qty'];
                $remamoun = str_replace("-", "", $item_cart['rem_p']);
                $payprice = $item_cart['price'];
                $total_price = $payprice + $remamoun;
                //calculating partial product discount amount end code
                //if ($shopname == 'desinomatetest.myshopify.com') {
                if ($total_price != $item_cart['item_original_price']) {

                    $itmorgprice = $item_cart['original_line_price'];
                    $dicountcodepay = $itmorgprice - $total_price;
                    //if ($dicountcodepay > 0) {
                    //$adddsicount = array("name" => "Discount", "value" => $dicountcodepay);
                    //$discounfroundedValue = round($dicountcodepay, 2);
                    //$formattedValuediscount = number_format($discounfroundedValue, 2, '.', '');
                    //$formattedValuediscount = sprintf("%.2f", $dicountcodepay);


                    //$roundedValue = bcadd($dicountcodepay, '0.005', 2); // Add 0.005 to round up
                    $formattedValuediscount = number_format($dicountcodepay, 2, '.', '');


                    $line_item  = array(
                        "title" => $item_cart['title'] . $size_order_namenn,
                        "price" => $final_price,
                        "quantity" => $item_cart['qty'],
                        "sku" => $itmeskysplit,
                        //"product_id" => $item_cart['product_id'],
                        "requires_shipping" => $reqship,
                        "grams" => $item_cart['grams'],
                        "gift_card" => true,
                        "properties" => array(
                            array("name" => "Note", "value" => "Initial Partial Payment"),
                            array("name" => "variant_code", "value" => $item_cart['id']),
                            array("name" => "partial_pay", "value" => number_format($item_cart['price'], 2, '.', '')),
                            array("name" => "remaining_amount", "value" => str_replace("-", "", $item_cart['rem_p'])),
                            array("name" => "Discount", "value" => $formattedValuediscount)
                            //array("name" => "Discount", "value" => number_format($dicountcodepay, 2, '.', ''))
                            //array("name" => "Discount", "value" => $item_cart['product_id']),
                            // array("name" => "psku", "value" => $itmeskysplit)
                        )
                    );
                } else {
                    $line_item  = array(
                        "title" => $item_cart['title'] . $size_order_namenn,
                        "price" => $final_price,
                        "quantity" => $item_cart['qty'],
                        "sku" => $itmeskysplit,
                        //"product_id" => $item_cart['product_id'],
                        "requires_shipping" => $reqship,
                        "grams" => $item_cart['grams'],
                        "gift_card" => true,
                        "properties" => array(
                            array("name" => "Note", "value" => "Initial Partial Payment"),
                            array("name" => "variant_code", "value" => $item_cart['id']),
                            array("name" => "partial_pay", "value" => $item_cart['price']),
                            array("name" => "remaining_amount", "value" => str_replace("-", "", $item_cart['rem_p']))
                        )
                    );
                }
                /*  } else {
                    $line_item  = array(
                        "title" => $item_cart['title'] . $size_order_namenn,
                        "price" => $final_price,
                        "quantity" => $item_cart['qty'],
                        "sku" => $itmeskysplit,
                        //"product_id" => $item_cart['product_id'],
                        "requires_shipping" => $reqship,
                        "grams" => $item_cart['grams'],
                        "gift_card" => true,
                        "properties" => array(
                            array("name" => "Note", "value" => "Initial Partial Payment"),
                            array("name" => "variant_code", "value" => $item_cart['id']),
                            array("name" => "partial_pay", "value" => $item_cart['price']),
                            array("name" => "remaining_amount", "value" => str_replace("-", "", $item_cart['rem_p']))
                            //array("name" => "Discount", "value" => $item_cart['product_id']),
                            // array("name" => "psku", "value" => $itmeskysplit)
                        )
                    );
                }*/
                $remaining_price = $remaining_price + $item_cart['rem_p'];
            } else {
                //if ($_SERVER['HTTP_X_FORWARDED_FOR'] == '103.80.119.106') {
                if ($item_cart['line_price'] != $item_cart['original_line_price']) {


                    $coupencodeprice = $item_cart['original_line_price']  - $item_cart['line_price'];

                    $coupencodeprice = ($coupencodeprice / $item_cart['qty']);
                    //$coupencodeprice = ($item_cart['line_level_total_discount'] / $item_cart['qty']);
                    // $coupencodeprice = round($coupencodeprice);

                    $getcpncodep = $body_data_decode['getcpncode'];
                    if ($getcpncodep != "") {
                        $couponname = $getcpncodep;
                    } else {
                        $couponname = 'Automatic';
                    }
                    $line_item = array(
                        "variant_id" => $item_cart['id'],
                        "quantity" => $item_cart['qty'],
                        "gift_card" => true,
                        "sku" => $itmeskysplit,
                        "grams" => $item_cart['grams'],
                        "applied_discount" => array(
                            "description" => $couponname,
                            "title" => $couponname,
                            "value_type" => "fixed_amount",
                            "value" => $coupencodeprice,
                            "amount" => $coupencodeprice,
                        ),
                        "properties" => array(
                            array("name" => "Note", "value" => "Full Payment"),
                            array("name" => "full_pay", "value" => $item_cart['price'])
                        ),
                        "requires_shipping" => $reqship
                    );
                } else {
                    $line_item = array(
                        "variant_id" => $item_cart['id'],
                        "quantity" => $item_cart['qty'],
                        "gift_card" => true,
                        "sku" => $itmeskysplit,
                        "grams" => $item_cart['grams'],
                        "properties" => array(
                            array("name" => "Note", "value" => "Full Payment"),
                            array("name" => "full_pay", "value" => $item_cart['price'])
                        ),
                        "requires_shipping" => $reqship
                    );
                }
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

            // if ($_SERVER['HTTP_X_FORWARDED_FOR'] == '103.80.119.106') {
            //code for add variants name & value to order
            if (isset($item_cart['allproperties'])) {
                foreach ($item_cart['allproperties'] as $keypropty => $proval) {
                    if ($keypropty != "PARTIAL_PAYMENT" && substr($keypropty, 0, 1) !== "_") {
                        $line_item['properties'][] = array(
                            "name" => $keypropty,
                            "value" => $proval
                        );
                    }
                }
            }
            //}

            $illp = $illp + 1;
            $ilosku = $ilosku + 1;
            $line_item_arra[] = $line_item;
        }
        //echo $chekpartial;
        //    print_r($line_item_arra);

        // if ($_SERVER['HTTP_X_FORWARDED_FOR'] == '103.80.119.106') {
        //     echo "line_item_arra<pre>";
        //     print_r($line_item_arra);
        //     echo "</pre>";
        //     die();
        // }

        $final_total_price_rem = str_replace("-", "", $remaining_price);

        //$final_array = array("draft_order" => array("line_items" => $line_item_arra, "tags" => "partial_" . $final_total_price_rem, "applied_discount" => array("code" => "Y293PCH4G53W")));

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

            if ($get_lates_colection->partial_type == '') {
                $coll_parttype = 'percentage';
            } else {
                $coll_parttype = $get_lates_colection->partial_type;
            }

            if (isset($get_lates_colection->partial_percentage) && $get_lates_colection->partial_percentage != "" && $get_lates_colection->partial_percentage != 0) {
                $get_updated_plan = $this->user_model->get_store_plane($get_lates_colection->shop_url); //get activated store how many products count have
                $get_details = $this->user_model->get_tokens($get_lates_colection->shop_url); //get shop token

                if ($get_updated_plan[0]->plan_name == 'basic') {
                    $total_pro = 200;
                } else {
                    $total_pro = $this->plane_details[$get_updated_plan[0]->plan_name]['partial_product'];
                }

                //if ($get_updated_plan[0]->plan_status == 'active' && $get_updated_plan[0]->updated_products_partial > 0) {
                if ($get_details->total_sync_store_products < $total_pro) {
                    $cron_limit_set = 50;

                    //below block for get products first time from page 1
                    if ($get_lates_colection->cron_page_num == 1) {
                        $data = array();
                        $colcturl = "/admin/api/2023-07/products.json";
                        $products = $this->common->rest_api($colcturl, array("collection_id" => $get_lates_colection->collection_id, "limit" => $cron_limit_set), 'GET', $get_details->access_token, $get_lates_colection->shop_url);

                        $product_list = json_decode($products['body'], true);
                        if (!array_key_exists('errors', $product_list)) {

                            if (!empty($product_list)) {
                                $headers = $products['headers'];
                                if (isset($headers['link'])) {
                                    $nextPageURL = $this->common->str_btwn($headers['link'], '<', '>');
                                    $nextPageURLparam = parse_url($nextPageURL);
                                    parse_str($nextPageURLparam['query'], $value);
                                    $data['page_info'] = $value['page_info'];
                                }
                                $data['headers_list'] = $headers;

                                if (isset($get_lates_colection->partial_percentage) && $get_lates_colection->partial_percentage != "") {
                                    $partpercentg = str_replace("%", "", $get_lates_colection->partial_percentage);
                                } else {
                                    $partpercentg = 10;
                                }
                                foreach ($product_list as $product) {
                                    foreach ($product as $key => $value) {
                                        $payxnowrest_product_add = array(
                                            "product_id" => $value['id'],
                                            "product_title" => $value['title'],
                                            "shop_url" => $get_lates_colection->shop_url,
                                            "partial_percentage" => $partpercentg,
                                            "partial_type" => $coll_parttype,
                                            "add_date" => date('Y-m-d'),
                                            "collection_id" => $get_lates_colection->collection_id,
                                            "total_pro" => $total_pro
                                        );
                                        //below function is used for add products into partial list & update partial products of store according their plan
                                        $this->user_model->add_partial_products_collections($payxnowrest_product_add);
                                        foreach ($value['variants'] as $produc_varaien) {
                                            $product_array = array(
                                                "product_id" => $produc_varaien['product_id'],
                                                "varient_id" => $produc_varaien['id'],
                                                "title" => $produc_varaien['title'],
                                                "price" => $produc_varaien['price'],
                                                "partial_percentage" => $partpercentg,
                                                "partial_type" => $coll_parttype,
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
                        if (!array_key_exists('errors', $product_list)) {
                            if (!empty($product_list)) {
                                if (isset($get_lates_colection->partial_percentage) && $get_lates_colection->partial_percentage != "") {
                                    $partpercentg = str_replace("%", "", $get_lates_colection->partial_percentage);
                                } else {
                                    $partpercentg = 10;
                                }
                                foreach ($product_list as $product) {
                                    foreach ($product as $key => $value) {

                                        $payxnowrest_product_add = array(
                                            "product_id" => $value['id'],
                                            "product_title" => $value['title'],
                                            "shop_url" => $get_lates_colection->shop_url,
                                            "partial_percentage" => $partpercentg,
                                            "partial_type" => $coll_parttype,
                                            "add_date" => date('Y-m-d'),
                                            "collection_id" => $get_lates_colection->collection_id,
                                            "total_pro" => $total_pro
                                        );
                                        $this->user_model->add_partial_products_collections($payxnowrest_product_add);
                                        foreach ($value['variants'] as $produc_varaien) {
                                            $product_array = array(
                                                "product_id" => $produc_varaien['product_id'],
                                                "varient_id" => $produc_varaien['id'],
                                                "title" => $produc_varaien['title'],
                                                "price" => $produc_varaien['price'],
                                                "partial_percentage" => $partpercentg,
                                                "partial_type" => $coll_parttype,
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
                    }
                } else {
                    $payxnowrest_collect_update = array(
                        "cron_run" => 1,
                        "cron_page_num" => 0,
                        "shop_url" => $get_lates_colection->shop_url,
                        "collection_id" => $get_lates_colection->collection_id,
                    );
                    $this->user_model->update_cron_products($payxnowrest_collect_update);
                    //track upgrade message if merchants owner used all products quota for partial add products               
                    $this->user_model->update_data($get_lates_colection->shop_url, array(
                        "package_upgrade_message" => 'You are out of products limit, please upgrade your plan and add more products.',
                    ));
                }
                echo "done";
            } else {
                echo "not found";
                $payxnowrest_collect_update = array(
                    "cron_run" => 1,
                    "cron_page_num" => 0,
                    "shop_url" => $get_lates_colection->shop_url,
                    "collection_id" => $get_lates_colection->collection_id,
                );
                $this->user_model->update_cron_products($payxnowrest_collect_update);
            }
        } else {
            echo "not found";
        }
        $updateprorespo = array(
            "name" => "run collectioncrn job=" . json_encode($get_lates_colection),
            "movement" => date('Y-m-d H:i')
        );
        $this->user_model->check_cron_ruinning_stst($updateprorespo);
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
                "cart_summary_back_color" => isset($gtbtncolor[0]->cart_summary_back_color) ? $gtbtncolor[0]->cart_summary_back_color : '#fff',
                "cart_summart_textc" => isset($gtbtncolor[0]->cart_summart_textc) ? $gtbtncolor[0]->cart_summart_textc : '#000',
                "add_to_cartbtn" => $gtbtncolor[0]->add_to_cartbtn,
                "buy_partial_btn" => $gtbtncolor[0]->buy_partial_btn,
                "full_pay_buybtn" => $gtbtncolor[0]->full_pay_buybtn,
                "add_to_cart_text" => $gtbtncolor[0]->add_to_cart_text,
                "partial_buy_now_text" => $gtbtncolor[0]->partial_buy_now_text,
                "full_buy_now_text" => $gtbtncolor[0]->full_buy_now_text,
                "add_cart_btn_color" => $gtbtncolor[0]->add_cart_btn_color,
                "add_cart_text_color" => $gtbtncolor[0]->add_cart_text_color,
                "partial_buynow_btn_color" => $gtbtncolor[0]->partial_buynow_btn_color,
                "partial_buynow_text_color" => $gtbtncolor[0]->partial_buynow_text_color,
                "full_buy_btn_color" => $gtbtncolor[0]->full_buy_btn_color,
                "full_buy_text_color" => $gtbtncolor[0]->full_buy_text_color,
                "partial_dep_text" => ($gtbtncolor[0]->partial_dep_text != "") ? $gtbtncolor[0]->partial_dep_text : 'Partial Deposit',
                "remaining_txtcrt" => ($gtbtncolor[0]->remaining_txtcrt != "") ? $gtbtncolor[0]->remaining_txtcrt : 'Remaining Balance',
                "cart_three_txt" => ($gtbtncolor[0]->cart_three_txt != "") ? $gtbtncolor[0]->cart_three_txt : 'You need to pay remaining balance to delivery person',
                "cg_partial_btn_text" => ($gtbtncolor[0]->cg_partial_btn_text != "") ? $gtbtncolor[0]->cg_partial_btn_text : 'Partial Payment',
                "cg_full_btn_text" => ($gtbtncolor[0]->cg_full_btn_text != "") ? $gtbtncolor[0]->cg_full_btn_text : 'Full Payment',

            );
            return json_encode($return_array);
        } else {
            return "no_color";
        }
    }
    public function check_product_type_cart()
    {
        //print_r($this->request->getPost());
        // $shopname = str_replace("https://", "", $this->request->getPost('shopname'));
        // $shopname = str_replace("http://", "", $shopname);
        $returnarray = array();
        $plan_details = $this->user_model->get_store_plan($this->request->getPost('shopname'));
        if (!empty($plan_details)) {
            if ($plan_details[0]->plan_status == 'active' && $plan_details[0]->updated_sync_orders_count > 0) {
                $setaray = array(
                    "cart_id" => $this->request->getPost('tokenid'),
                    "shop_url" => $this->request->getPost('shopname')
                );
                $get_products = $this->user_model->get_cart_itme_based_on_token($setaray);
                if (!empty($get_products)) {

                    foreach ($get_products as $itmeprod) {
                        if ($itmeprod->product_properties != "") {
                            $protiesdstrrrat = json_decode($itmeprod->product_properties, true); // Convert to an associative array

                            $proety_size_tems = array();
                            foreach ($protiesdstrrrat as $key => $getprt) {
                                //if ($key != "parma") {
                                $proety_size_tems[$key] = $getprt;
                                //}
                                unset($proety_size_tems['PARTIAL_PAYMENT']);
                            }
                            $proety_size_tems["PARTIAL_PAYMENT"] = "Available";

                            $returnarray[] = array(
                                "varient_id" => $itmeprod->variant_id,
                                "product_id" => $itmeprod->product_id,
                                "product_type" => $itmeprod->product_type,
                                "partial_percentage" => $itmeprod->partial_percentage,
                                "product_properties" => $proety_size_tems, // Set $proety_size_tems as product_properties
                            );
                        } else {
                            $proety_size_tems = array();
                            if ($itmeprod->product_type == "partial") {
                                $proety_size_tems["PARTIAL_PAYMENT"] = "Available";
                            } else {
                                $proety_size_tems = "";
                            }
                            $returnarray[] = array(
                                "varient_id" => $itmeprod->variant_id,
                                "product_id" => $itmeprod->product_id,
                                "partial_percentage" => $itmeprod->partial_percentage,
                                "product_type" => $itmeprod->product_type,
                                "product_properties" => $proety_size_tems, // If product_properties is empty
                                //"product_properties" => '', // If product_properties is empty
                            );
                        }
                    }
                }
            }
        }
        return json_encode($returnarray);
    }
    public function update_store_package_cron()
    {
        $all_expiray_plnane = $this->user_model->get_all_stores_expiray_plan();


        foreach ($all_expiray_plnane as $allshpal) {
            $get_register_webhook = $this->common->rest_api('/admin/api/2023-07/recurring_application_charges/' . $allshpal->charged_id . '.json', array(), 'GET', $allshpal->access_token, $allshpal->shop_url);
            $get_register_webhookset = json_decode($get_register_webhook['body'], true);



            if (isset($get_register_webhookset['recurring_application_charge']['status']) && $get_register_webhookset['recurring_application_charge']['status'] == 'active') {

                $plane_start_endate = date('Y-m-d', strtotime('+' . $this->plane_details[$allshpal->plan_name]['validity'] . ' days'));

                if ($allshpal->total_sync_store_products != "") {
                    $update_order_count = $this->plane_details[$allshpal->plan_name]['partial_product'] - $allshpal->total_sync_store_products;
                } else {
                    $update_order_count = $this->plane_details[$allshpal->plan_name]['partial_product'];
                }


                $update_data = array(
                    "shop_url" => $allshpal->shop_url,
                    "charged_id" => $get_register_webhookset['recurring_application_charge']['id'],
                    "plan_status" => $get_register_webhookset['recurring_application_charge']['status'],
                    "activate_date" => date('Y-m-d'),
                    "sync_orders_count" => $this->plane_details[$allshpal->plan_name]['order_sunc'],
                    "updated_sync_orders_count" => $this->plane_details[$allshpal->plan_name]['order_sunc'],
                    "total_products_partial" => $this->plane_details[$allshpal->plan_name]['partial_product'],
                    "updated_products_partial" => $update_order_count,
                    "plan_validity" => $get_register_webhookset['recurring_application_charge']['billing_on']
                );
                $this->user_model->track_store_subscribe($update_data);
            }
        }
        $updateprorespo = array(
            "name" => "run update package job=",
            "movement" => date('Y-m-d H:i')
        );
        $this->user_model->check_cron_ruinning_stst($updateprorespo);
        echo "done";
    }
    public function exportcsv()
    {
        $get_allzip = $this->user_model->get_all_zipcodes($_GET['shop']);

        $csvFile = fopen('php://temp', 'w');

        if (!$csvFile) {
            die("Failed to create CSV file");
        }

        // Add a header row to the CSV file (optional)
        $header = array("Postal Code");
        fputcsv($csvFile, $header);

        // Loop through the database result and write each row to the CSV file
        // while ($row = $result->fetch_assoc()) {
        foreach ($get_allzip as $allgetval) {
            $lineData = array($allgetval->zipcodes);
            fputcsv($csvFile, $lineData);
        }

        // Close the database connection and CSV file
        //$mysqli->close();
        //fclose($csvFile);
        // Set HTTP headers to force download of the CSV file
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="export.csv"');

        // Output the CSV data
        rewind($csvFile); // Rewind the file pointer to the beginning
        fpassthru($csvFile); // Output the CSV data to the browser
        //echo "<script>top.window.location='https://admin.shopify.com/store/" . $this->shope_name . "/apps/pay-x-now-rest-on-delivery/app-configuration'</script>";
        exit;
    }
    public function samplfcsv()
    {
        // $get_allzip = $this->user_model->get_all_zipcodes($_GET['shop']);

        $csvFile = fopen('php://temp', 'w');

        if (!$csvFile) {
            die("Failed to create CSV file");
        }

        // Add a header row to the CSV file (optional)
        $header = array("Postal Code");
        fputcsv($csvFile, $header);
        $examplarray = array("110041", "110042", "110044", "110045", "110046", "110047", "110048");

        // Loop through the database result and write each row to the CSV file
        // while ($row = $result->fetch_assoc()) {
        foreach ($examplarray as $key => $allgetval) {
            $lineData = array($allgetval);
            fputcsv($csvFile, $lineData);
        }

        // Close the database connection and CSV file
        //$mysqli->close();
        //fclose($csvFile);
        // Set HTTP headers to force download of the CSV file
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="sample_export.csv"');

        // Output the CSV data
        rewind($csvFile); // Rewind the file pointer to the beginning
        fpassthru($csvFile); // Output the CSV data to the browser

        exit;
    }
    public function zipcodevali()
    {

        $body_data = file_get_contents('php://input');
        //echo $body_data;
        $body_data_decode = json_decode($body_data, TRUE);
        //print_r($body_data_decode);

        $shopname = str_replace("https://", "", $body_data_decode['shopname']);
        $shopname = str_replace("http://", "", $shopname);
        $zipode = $body_data_decode['zipode'];
        $zip_regex = "/^[1-9]{1}[0-9]{2}\\s{0,1}[0-9]{3}$/";
        $pregmatchvar = preg_match($zip_regex, $zipode);
        if ($pregmatchvar == 1) {

            $get_allzip = $this->user_model->get_all_zipcodes($shopname, $zipode);


            if (empty($get_allzip)) {
                echo "valid";
            } else {
                echo "invalid";
            }
        } else {
            echo "invalidzip";
        }
    }

    public function trackcsvdata()
    {

        if (($_FILES["zip_code"]["tmp_name"] != "")) {

            $fileType = $_FILES['zip_code']['type'];
            if ($fileType == 'text/csv' || $fileType == 'application/csv') {
                $this->user_model->remove_oldzip($this->request->getPost('shop'));
                $csvFile = $_FILES["zip_code"]["tmp_name"];

                if (($handle = fopen($csvFile, "r")) !== false) {

                    while (($data = fgetcsv($handle)) !== false) {
                        // echo "data<pre>";
                        // print_r($data);
                        // echo "</pre>";
                        if ($data[0] != 'Postal Code') {
                            $zipcode_data = array(
                                "zipcodes" => $data[0],
                                "shop_url" => $this->request->getPost('shop'),
                                "movement" => date('Y-m-d H:i:s')
                            );
                            $this->user_model->track_zip_codes($zipcode_data); //replace OR insert zip codes
                        }
                    }
                }
                echo "done";
            } else {
                echo "invalid_format";
            }
        } else {
            echo "invalid";
        }
    }
    public function getstorecouponcodes()
    {

        $body_data = file_get_contents('php://input');
        //echo $body_data;
        $body_data_decode = json_decode($body_data, TRUE);

        $prdyid = array();
        foreach ($body_data_decode['carttknval'] as $crtval) {
            $prdyid[] = $crtval['product_id'];
        }
        //$prdyid = array("1256","25968");
        $shopname = str_replace("https://", "", $body_data_decode['shopname']);
        $shopname = str_replace("http://", "", $shopname);


        $get_details = $this->user_model->get_tokens($shopname);
        $getprietuleid = $this->common->rest_api('/admin/api/2023-10/price_rules.json', array(), 'GET', $get_details->access_token, $shopname);
        $getprietuleidrec = json_decode($getprietuleid['body'], true);
         echo "getprietuleidrec<pre>";
                    print_r($getprietuleidrec);
                    echo "</pre>";
        $return_array = array();
        foreach ($getprietuleidrec['price_rules'] as $allcoupon) {
            if ($allcoupon['target_type'] != 'shipping_line') {
                if (!empty($allcoupon['entitled_product_ids'])) {
                    $getvalues = array_intersect($prdyid, $allcoupon['entitled_product_ids']);
                    // echo "getvalues<pre>";
                    // print_r($getvalues);
                    // echo "</pre>";
                    if (empty($getvalues)) {
                        $disbaleval = 1;
                    } else {
                        $disbaleval = 0;
                    }
                } else {
                    $disbaleval = 0;
                }
                $return_array[] = array(
                    'coupon_name' => $allcoupon['title'],
                    'coupon_type' => $allcoupon['value_type'],
                    'coupon_value' => $allcoupon['value'],
                    'disbaleval' => $disbaleval
                );
            }
        }
        // echo "getprietuleidrec<pre>";
        // print_r($return_array);
        // echo "</pre>";
        return json_encode($return_array);
    }
    public function exchange_return_split()
    {
        $data = array();
        echo view('exchange_return', $data);
    }
    public function fetch_exhange_orders()
    {
        $body_data = file_get_contents('php://input');
        $body_data_decode = json_decode($body_data, TRUE);
        if ((isset($body_data_decode['ordernum']) && $body_data_decode['ordernum'] != "") && (isset($body_data_decode['emailf']) && $body_data_decode['emailf'] != "")) {

            $get_details = $this->user_model->get_tokens($body_data_decode['shopname']);


            /** get order details by order number & email**/

            $getprietuleid = $this->common->rest_api('/admin/api/2023-07/orders.json?name=' . $body_data_decode['ordernum'] . '&email=' . $body_data_decode['emailf'], array(), 'GET', $get_details->access_token, $body_data_decode['shopname']);

            $get_all_oders = json_decode($getprietuleid['body'], true);
            $products_array = array();

            // Filter the orders for the exact order name "1301"
            $searchName = $body_data_decode['ordernum'];
            $exactMatchOrders = array_filter($get_all_oders['orders'], function ($order) use ($searchName) {
                return $order['name'] === $searchName;
            });

            // Print the exact match orders
            // print_r($exactMatchOrders);


            // echo"<pre>get_all_oders"; print_r($get_all_oders); echo "</pre>";
            // die();
            foreach ($get_all_oders as $order) {
                foreach ($order as $key => $value) {

                    if (empty($value['fulfillments'])) {
                        $fullmenststs = "Unfulfilled";
                    } else {
                        $fullmenststs = "fulfilled";
                    }

                    $orders_data = array(
                        "order_id" => $value['id'],
                        "order_number" => str_replace("#", "", $value['name']),
                        "order_status" => 'processing',
                        "order_ccy" => $value['currency'],
                        "order_date" => $value['created_at'],
                        "order_price" => $value['current_subtotal_price'],
                        "email" => $this->common->payxnow_encodedata($value['contact_email']),
                        "shop_url" => $body_data_decode['shopname'],
                        "fullfilment_status" => $fullmenststs
                    );
                    if (isset($value['shipping_address'])) {
                        $orders_data['shipping_address'] = $this->common->payxnow_encodedata($value['shipping_address']['address1']);

                        $orders_data['shipping_address2'] = (isset($value['shipping_address']['address2']) ? $this->common->payxnow_encodedata($value['shipping_address']['address2']) : '');

                        $orders_data['city'] = (isset($value['shipping_address']['city']) ? $this->common->payxnow_encodedata($value['shipping_address']['city']) : '');
                        $orders_data['state'] = (isset($value['shipping_address']['province']) ? $this->common->payxnow_encodedata($value['shipping_address']['province']) : '');
                        $orders_data['pincode'] = (isset($value['shipping_address']['zip']) ? $value['shipping_address']['zip'] : '');
                        //$orders_data['phone'] = (isset($value['shipping_address']['phone']) ? $this->common->payxnow_encodedata($value['shipping_address']['phone']) : '');
                        $orders_data['fname'] = (isset($value['shipping_address']['first_name']) ? $this->common->payxnow_encodedata($value['shipping_address']['first_name']) : '');
                        $orders_data['lname'] = (isset($value['shipping_address']['last_name']) ? $this->common->payxnow_encodedata($value['shipping_address']['last_name']) : '');
                        //$orders_data['email'] = (isset($value['shipping_address']['email']) ? $value['shipping_address']['email'] :'' );
                        $orders_data['country'] = (isset($value['shipping_address']['country']) ? $this->common->payxnow_encodedata($value['shipping_address']['country']) : '');
                    } else  if (isset($value['billing_address'])) {

                        $orders_data['shipping_address'] = $this->common->payxnow_encodedata($value['billing_address']['address1']);
                        $orders_data['shipping_address2'] = (isset($value['billing_address']['address2']) ? $this->common->payxnow_encodedata($value['billing_address']['address2']) : '');
                        $orders_data['city'] = (isset($value['billing_address']['city']) ? $this->common->payxnow_encodedata($value['billing_address']['city']) : '');
                        $orders_data['state'] = (isset($value['billing_address']['province']) ? $this->common->payxnow_encodedata($value['billing_address']['province']) : '');
                        $orders_data['pincode'] = (isset($value['billing_address']['zip']) ? $value['billing_address']['zip'] : '');
                        //$orders_data['phone'] = (isset($value['billing_address']['phone']) ? $this->common->payxnow_encodedata($value['billing_address']['phone']) : '');
                        $orders_data['fname'] = (isset($value['billing_address']['first_name']) ? $this->common->payxnow_encodedata($value['billing_address']['first_name']) : '');
                        $orders_data['lname'] = (isset($value['billing_address']['last_name']) ? $this->common->payxnow_encodedata($value['billing_address']['last_name']) : '');
                        //$orders_data['email'] = (isset($value['shipping_address']['email']) ? $value['shipping_address']['email'] :'' );
                        $orders_data['country'] = (isset($value['billing_address']['country']) ? $this->common->payxnow_encodedata($value['billing_address']['country']) : '');
                    }
                    //echo"orders_data<pre>"; print_r($orders_data); echo"</pre>";

                    $incid = $this->exchange_model->track_exchange_orders($orders_data, $body_data_decode['shopname']);

                    foreach ($value['line_items'] as $products) {
                        if ($products['name'] != "Partial Pending Payment") {
                            if (isset($products['properties'][0]['value']) && $products['properties'][0]['value'] == 'Initial Partial Payment') {
                                $item_price = $products['properties'][2]['value'] + $products['properties'][3]['value'];
                                $productvarient = $products['properties'][1]['value'];
                            } else {
                                $item_price = $products['price'];
                                $productvarient = $products['variant_id'];
                            }
                            // if ($products['variant_id'] == "") {
                            //     if (isset($products['properties'][1]['value']) && $products['properties'][1]['value'] == 'variant_code') {
                            //         $productvarient = $products['properties'][1]['value'];
                            //     } else {
                            //         $productvarient = "";
                            //     }
                            // } else {
                            //     $productvarient = $products['variant_id'];
                            // }
                            $orders_products_data = array(
                                "order_id" => $value['id'],
                                "product_id" => $products['id'],
                                "varient_id" => $productvarient,
                                "product_name" => $products['name'],
                                "product_price" => $item_price,
                                "product_qty" => $products['quantity'],
                                "shop_url" => $body_data_decode['shopname']
                            );



                            $this->exchange_model->track_orders_products_exchange($orders_products_data);
                        }
                    }
                }
            }
            $products_array = array();
            if (isset($get_all_oders['orders'][0]['created_at'])) {
                $products_array = array(
                    "order_id" => $get_all_oders['orders'][0]['id'],
                    "order_num" => $body_data_decode['ordernum'],
                    "order_date" => $get_all_oders['orders'][0]['created_at']
                );
            }


            echo json_encode($products_array);
        } else {
            echo "invalid";
        }
    }
    function get_orders_info()
    {
        $body_data = file_get_contents('php://input');
        $body_data_decode = json_decode($body_data, TRUE);
        $get_details = $this->user_model->get_tokens($body_data_decode['shopname']);

        $getresultdata = $this->exchange_model->get_order_info($body_data_decode['orderid']);
        // echo "<pre>";
        // print_r($getresultdata);
        // echo "</pre>";
        $returnProductArray = array();
        foreach ($getresultdata as $getorderinfo) {
            $getvarimg = $this->common->rest_api('/admin/api/2023-07/variants/' . $getorderinfo->varient_id . '.json', array(), 'GET', $get_details->access_token, $body_data_decode['shopname']);

            $getvrntimg = json_decode($getvarimg['body'], true);
            // echo "<pre>";
            // print_r($getvrntimg);
            // echo "</pre>";
            if (!empty($getvarimg)) {
                $product_id = $getvrntimg['variant']['product_id'];

                $getimfsrcdata = $this->common->rest_api('/admin/api/2023-07/products/' . $product_id . '.json', array(), 'GET', $get_details->access_token, $body_data_decode['shopname']);

                $getimfdata = json_decode($getimfsrcdata['body'], true);
                // echo "<pre>getimfdata";
                // print_r($getimfdata);
                // echo "</pre>";
                $image_url = null;
                if (!empty($getimfdata['product']['images'])) {
                    foreach ($getimfdata['product']['images'] as $image) {
                        // Check if the image is associated with the variant
                        if (in_array($getorderinfo->varient_id, $image['variant_ids'])) {
                            $image_url = $image['src'];
                            break;
                        }
                    }
                    if ($image_url == "") {
                        $image_url = $getimfdata['product']['image']['src'];
                    } else {
                        $image_url = $image_url;
                    }
                } else {
                    $image_url = "https://cdn.shopifycdn.net/s/files/1/0580/0080/1969/t/1/assets/no-product-logo.png";
                }
                //echo "image_url=" . $image_url;
                $returnProductArray[] = array(
                    "product_name" => $getorderinfo->product_name,
                    "id" => $getorderinfo->id,
                    "varient_id" => $getorderinfo->varient_id,
                    "product_id" => $product_id,
                    "product_price" => $getorderinfo->product_price,
                    "product_qty" => $getorderinfo->product_qty,
                    "product_image" => $image_url,
                );
            }
        }
        return json_encode($returnProductArray);
    }
    function track_return_exchange_order()
    {
        $body_data = file_get_contents('php://input');
        $body_data_decode = json_decode($body_data, TRUE);
        //print_r($body_data_decode);
        try {
            $i = 0;
            foreach ($body_data_decode['productid'] as $key => $getprodv) {
                //if($getprodv)
                $orders_products_data = array(
                    "order_id" => $body_data_decode['orderid'],
                    "varient_id" => $getprodv,
                    "shop_url" => $body_data_decode['shopname'],
                    "return_exchange_reason" => $body_data_decode['reason'][$i]
                );
                $this->exchange_model->update_exchnage_reason($orders_products_data);
                $i++;
            }
            $return['msg'] = "done";
            // echo"done";
        } catch (Exception $e) {
            // Handle the exception here
            $return['msg'] = $e->getMessage();
            // echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return json_encode($return);
    }
    public function track_return_process()
    {
        $body_data = file_get_contents('php://input');
        $body_data_decode = json_decode($body_data, TRUE);
        // echo "<pre>";
        // print_r($body_data_decode);
        // echo "</pre>";
        $get_details = $this->user_model->get_tokens($body_data_decode['shopname']);
        if ($body_data_decode['getreturn'] == 'info') {
            $moreparms = array(
                "order_id" => $body_data_decode['orderid'],
                "shop_url" => $body_data_decode['shopname']
            );
            $getdata = $this->exchange_model->get_items_info($body_data_decode['varid'], $moreparms);
            // echo "<pre>";
            // print_r($getdata);
            // echo "</pre>";
            foreach ($getdata as $getdata) {

                $getvarimg = $this->common->rest_api('/admin/api/2023-07/variants/' . $getdata->varient_id . '.json', array(), 'GET', $get_details->access_token, $body_data_decode['shopname']);

                $getvrntimg = json_decode($getvarimg['body'], true);
                if (!empty($getvarimg)) {
                    $product_id = $getvrntimg['variant']['product_id'];
                    $getimfsrcdata = $this->common->rest_api('/admin/api/2023-07/products/' . $product_id . '.json', array(), 'GET', $get_details->access_token, $body_data_decode['shopname']);

                    $getimfdata = json_decode($getimfsrcdata['body'], true);

                    // echo "getimfdata<pre>";
                    // print_r($getimfdata);
                    // echo "</pre>";
                    $image_url = null;
                    if (!empty($getimfdata['product']['images'])) {
                        foreach ($getimfdata['product']['images'] as $image) {
                            // Check if the image is associated with the variant
                            if (in_array($getdata->varient_id, $image['variant_ids'])) {
                                $image_url = $image['src'];
                                break;
                            }
                        }
                        if ($image_url == "") {
                            $image_url = $getimfdata['product']['image']['src'];
                        } else {
                            $image_url = $image_url;
                        }
                    } else {
                        $image_url = "https://cdn.shopifycdn.net/s/files/1/0580/0080/1969/t/1/assets/no-product-logo.png";
                    }

                    $return_info[] = array(
                        "product_name" => $getdata->product_name,
                        "id" => $getdata->id,
                        "varient_id" => $getdata->varient_id,
                        "product_price" => $getdata->product_price,
                        "product_qty" => $getdata->product_qty,
                        "product_image" => $image_url,
                        "product_discount" => $getdata->product_discount,
                        "product_tax" => $getdata->product_tax,
                        "exchange_reason" => $getdata->return_exchange_reason,
                    );
                }
            }
            return json_encode($return_info);
        } else  if ($body_data_decode['getreturn'] == 'track_return') {
            echo "<pre>";
            print_r($body_data_decode);
            echo "</pre>";
        }
    }
    public function frontend_reset_coupon()
    {
        echo "body_data_decode<pre>";
        print_r($this->request->getPost());
        echo "</pre>";
        $get_details = $this->user_model->get_tokens($this->request->getPost('shopname'));

        $accessToken = 'your-access-token';
        $store = 'your-shopify-store.myshopify.com';
        $discountCodeId = 'discount_code_id';

        //$baseUrl = "https://".$this->request->getPost('shopname')."/admin/api/2023-10"; // Replace '2021-04' with the latest API version available
       // $url = 'https://' . $this->request->getPost('shopname') . "/admin/api/2023-10/price_rules/".$this->request->getPost('dis_cod_id')."/discount_codes/".$this->request->getPost('priceruleid').".json";
        $url = 'https://' . $this->request->getPost('shopname') . "/admin/api/2023-10/price_rules/19906083651888/discount_codes/1409621459248.json";
        // $endpoint = "/price_rules/$discountCodeId.json";

        // $url = $baseUrl . $endpoint;

        $curl = curl_init($url);

        // Set cURL options
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'X-Shopify-Access-Token: ' . $get_details->access_token
        ]);

        // Execute cURL session and get the response
        $response = curl_exec($curl);
        $error = curl_error($curl);

        // Close cURL session
        curl_close($curl);
        echo "response1=".$response;
        // Check for errors
        if ($error) {
            echo "cURL Error: $error";
        } else {
            // Decode the JSON response
            echo "response=".$response;
            $result = json_decode($response, true);

        }


        // $getprietuleid = $this->common->rest_api('/admin/api/2023-10/price_rules/'.$this->request->getPost('priceruleid').'/discount_codes/'.$this->request->getPost('dis_cod_id').'.json', array(), 'DELETE', $get_details->access_token, $this->request->getPost('shopname'));

        $getprietuleid = $this->common->rest_api('/admin/api/2023-10/price_rules/'.$this->request->getPost('dis_cod_id').'/discount_codes/'.$this->request->getPost('priceruleid').'.json', array(), 'GET', $get_details->access_token, $this->request->getPost('shopname'));
        print_r($getprietuleid);
    }
    public function update_double_create()
    {
        // $resposne_array = array("name" => "insertion from AWS");
        // $this->user_model->check_test_response($resposne_array);
        // echo "insert";       

        /* $getallorders = $this->user_model->get_failed_order();
        if (!empty($getallorders)) {
            foreach ($getallorders as $faikedorder) {
                // echo "<pre>";
                // print_r($faikedorder);
                // echo "</pre>";
                $get_details = $this->user_model->get_tokens($faikedorder->shop_url);

                $getprietuleid = $this->common->rest_api('/admin/api/2023-07/orders/' . $faikedorder->orderid_paid . '.json', array(), 'GET', $get_details->access_token, $faikedorder->shop_url);

                $getprietuleidrec = json_decode($getprietuleid['body'], true);
                // echo "getprietuleidrec<pre>";
                // print_r($getprietuleidrec);
                // echo "</pre>";

                $paid_price = 0;
                $linitemdisount = 0;
                $taxamounttotal = 0;
                $order_tax = 0;
                $tax_lines = [];
                $line_items = [];

                /*foreach ($getprietuleidrec['order']['line_items'] as $products) {
                    //set condition for get only main products
                    if (!empty($products['properties']) && isset($products['properties'])) {
                        $chkpropeties = array("proertie" => "get");
                        if ($products['name'] != "Partial Pending Payment") {
                            if (isset($products['properties'][0]['value']) && $products['properties'][0]['value'] == 'Initial Partial Payment') {
                                $item_price = $products['properties'][2]['value'];
                                $tax_price = $products['properties'][3]['value'];
                                $productvarient = $products['properties'][1]['value'];
                                if (isset($products['properties'][4]['value']) && $products['properties'][4]['name'] == 'Discount') {
                                    $item_discount_item = $products['properties'][4]['value'];
                                } else {
                                    $item_discount_item = 0;
                                }
                                $paidprice_get = $products['properties'][2]['value'];
                            } else {
                                $item_price = $products['price'];
                                if (isset($products['total_discount']) && $products['total_discount'] != "") {
                                    $item_discount_item = $products['total_discount'];
                                } else {
                                    $item_discount_item = 0;
                                }
                                $productvarient = $products['variant_id'];
                                $tax_price = 0;
                                $paidprice_get = $products['properties'][1]['value'];
                            }
        
                            $linitemdisount = $linitemdisount + $item_discount_item;
        
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
                                    "quantity" => $products->quantity
                                ];
        
                            $paid_price = $paid_price + $paidprice_get;
                        }
                    } else {
                        $chkpropeties = array();
                    }
                }

            }
        }*/
    }
}
