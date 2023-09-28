<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'ppa_store_token';
    protected $primaryKey = 'id';
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
        // OR $this->db = db_connect();
    }


    public function insert_data($data = array())
    {
        $this->db->table($this->table)->insert($data);
        return $this->db->insertID();
    }
    public function update_data($shop_url, $data = array())
    {
        $this->db->table($this->table)->update($data, array(
            "shop_url" => $shop_url,
        ));
        return $this->db->affectedRows();
    }
    public function get_data()
    {
        $qbuilds = $this->db->table('test_tbl');
        $qbuilds->select('*');
        $getquery = $qbuilds->get();
        return $getquery->getResult();
    }
    public function get_tokens($shopurl)
    {
        $query = $this->db->query('SELECT * FROM ppa_store_token WHERE shop_url="' . $shopurl . '" LIMIT 1');
        return $query->getRow();
        //return count($query->getResult());
    }
    public function checktokens($shopurl)
    {
        $query = $this->db->query('SELECT * FROM ppa_store_token WHERE shop_url="' . $shopurl . '" LIMIT 1');
        //return $query->getResult();
        return count($query->getResult());
    }
    public function get_store_product($shopurl, $conditionarray)
    {
        $qbuilder = $this->db->table('ppp_products_varient');
        $qbuilder->where('shop_url', $shopurl);
        if (isset($conditionarray['product_id']) && $conditionarray['product_id'] != "") {
            $qbuilder->where('product_id', $conditionarray['product_id']);
        }
        $qbuilder->where('varient_id', $conditionarray['varient_id']);
        $getquery = $qbuilder->get();
        return $getquery->getResult();
    }
    public function track_collections($collection_array, $shopurl)
    {

        $qbuilder = $this->db->table('ppa_store_collections');
        $qbuilder->where('shop_url', $shopurl);
        $qbuilder->where('collection_id', $collection_array['collection_id']);
        $q = $qbuilder->get();
        $qbuilder->countAllResults();
        if (!empty($q->getResult())) {
            $this->db->table('ppa_store_collections')->where('shop_url', $shopurl)->where('collection_id', $collection_array['collection_id'])->update($collection_array);
            return $this->db->affectedRows();
        } else {

            return  $qbuilder->insert($collection_array);
        }
    }
    public function get_collections($shopurl)
    {

        $qbuilds = $this->db->table('ppa_store_collections');
        $qbuilds->select('collection_id,collections_name');
        $qbuilds->where(["shop_url" => $shopurl]);
        $getquery = $qbuilds->get();
        return $getquery->getResult();
    }
    public function add_partial_products($product_array)
    {
        $qbuilder = $this->db->table('app_partial_products');
        $qbuilder->where('shop_url', $product_array['shop_url']);
        $qbuilder->where('product_id', $product_array['product_id']);
        $q = $qbuilder->get();
        $qbuilder->countAllResults();
        if (!empty($q->getResult())) {
            $this->db->table('app_partial_products')->where('shop_url', $product_array['shop_url'])->where('product_id', $product_array['product_id'])->update($product_array);
            return $this->db->affectedRows();
        } else {

            return  $qbuilder->insert($product_array);
        }
    }
    public function add_partial_products_varient($product_varient_array)
    {
        $qbuilder = $this->db->table('ppp_products_varient');
        $qbuilder->where('shop_url', $product_varient_array['shop_url']);
        $qbuilder->where('product_id', $product_varient_array['product_id']);
        $qbuilder->where('varient_id', $product_varient_array['varient_id']);
        $q = $qbuilder->get();
        $qbuilder->countAllResults();
        if (!empty($q->getResult())) {
            $this->db->table('ppp_products_varient')->where('shop_url', $product_varient_array['shop_url'])->where('product_id', $product_varient_array['product_id'])->where('varient_id', $product_varient_array['varient_id'])->update($product_varient_array);
            return $this->db->affectedRows();
        } else {

            return  $qbuilder->insert($product_varient_array);
        }
    }
    public function track_line_item($insertarray)
    {
        $this->db->table('line_item_id_tbl')->insert($insertarray);
        return $this->db->insertID();
    }
    public function get_partial_product_list($shopurl, $searctext = "")
    {

        $qbuilds = $this->db->table('app_partial_products');
        $qbuilds->select('*');
        $qbuilds->where(["shop_url" => $shopurl]);
        if ($searctext != "") {
            $qbuilds->like("product_title", $searctext, 'both'); // Using the LIKE operator
        }
        $getquery = $qbuilds->get();
        return $getquery->getResult();
    }
    public function get_partial_product_list_pagina($shopurl, $start, $limit, $searctext = "")
    {

        $qbuilds = $this->db->table('app_partial_products');
        $qbuilds->select('*');
        $qbuilds->where(["shop_url" => $shopurl]);
        if ($searctext != "") {
            $qbuilds->like("product_title", $searctext, 'both'); // Using the LIKE operator
        }
        $qbuilds->orderBy('movement', 'desc');
        $qbuilds->limit($limit, $start);
        $getquery = $qbuilds->get();
        //$lastQuery = $this->db->getLastQuery(); // Get the last executed query
        //echo "Last Query: " . $lastQuery;
        return $getquery->getResult();
    }
    public function update_partial_percentage($update_data, $proid)
    {
        $this->db->table('app_partial_products')->where('shop_url', $update_data['shop_url'])->where('id', $update_data['id'])->update($update_data);
        $update_query = "UPDATE ppp_products_varient 
                        SET partial_percentage='" . $update_data['partial_percentage'] . "'
                        WHERE shop_url=?
                        AND product_id=?";
        $this->db->query($update_query, array($update_data['shop_url'], $proid));
    }
    public function update_collection_partial_percentage($update_data, $proid)
    {
        $this->db->table('collections_percentage')->where('shop_url', $update_data['shop_url'])->where('collection_id', $update_data['collection_id'])->update($update_data);

        $qbuilder_insert = $this->db->table('collections_percentage');
        $qbuilder_insert->where('shop_url', $update_data['shop_url']);
        $qbuilder_insert->where('collection_id', $update_data['collection_id']);
        $qgetordpro = $qbuilder_insert->get();
        if (!empty($qgetordpro->getResult())) {
            $update_data['coll_sts'] = "update";
            $this->db->table('collections_percentage')->where('shop_url', $update_data['shop_url'])->where('collection_id', $update_data['collection_id'])->update($update_data);
        } else {
            $update_data['coll_sts'] = "new";
            $this->db->table('collections_percentage')->insert($update_data);
        }


        //update partial percentage of products when add partial percentage their collections
        // $update_query1 = "UPDATE ppp_products_varient 
        // SET partial_percentage='" . $update_data['partial_percentage'] . "'
        // WHERE shop_url=?
        // AND collection_id=?";
        // $this->db->query($update_query1, array($update_data['shop_url'], $update_data['collection_id']));

        // $update_query2 = "UPDATE app_partial_products 
        // SET partial_percentage='" . $update_data['partial_percentage'] . "'
        // WHERE shop_url=?
        // AND collection_id=?";
        // $this->db->query($update_query2, array($update_data['shop_url'], $update_data['collection_id']));
    }
    public function track_orders($data_array, $shopurl)
    {

        $qbuilder_insert = $this->db->table('orders');
        $qbuilder_insert->where('order_id', $data_array['order_id']);
        $qbuilder_insert->where('shop_url', $shopurl);
        $qgetordpro = $qbuilder_insert->get();
        $qbuilder_insert->countAllResults();
        // $del_query = "DELETE FROM orders_products WHERE order_id=?";
        // $this->db->query($del_query, array($data_array['order_id'])); 
        // echo"inmodel<pre>"; print_r($qgetordpro->getResult()); echo"</pre>";
        if (!empty($qgetordpro->getResult())) {

            //$all_result = $q->getResult();
            $this->db->table('orders')->where('order_id', $data_array['order_id'])->update($data_array);
            //return $all_result[0]->id;
            return '2';
        } else {

            $this->db->table('orders')->insert($data_array);
            // return $this->db->insertID();
            return '1';
        }
    }

    public function track_orders_products($data_array)
    {

        $qbuilder = $this->db->table('orders_products');
        $qbuilder->where('product_id', $data_array['product_id']);
        $qbuilder->where('order_id', $data_array['order_id']);
        $qbuilder->where('shop_url', $data_array['shop_url']);
        $q = $qbuilder->get();
        // $qbuilder->countAllResults();
        if (empty($q->getResult())) {
            // $del_query = "DELETE FROM orders_products WHERE order_id=?";
            // $this->db->query($del_query, array($data_array['order_id']));
            return  $this->db->table('orders_products')->insert($data_array);
        } else {
            $this->db->table('orders_products')->where('order_id', $data_array['order_id'])->where('product_id', $data_array['product_id'])->where('shop_url', $data_array['shop_url'])->update($data_array);
            return '';
        }
    }
    public function get_all_orders($shopurl, $start, $limit)
    {
        $qbuilds = $this->db->table('orders');
        $qbuilds->select('*');
        // $qbuilds->where(["order_status" => 'pending']);
        $qbuilds->where(["shop_url" => $shopurl]);
        $qbuilds->orderBy('order_date', 'desc');
        $qbuilds->limit($limit, $start);
        $getquery = $qbuilds->get();
        return $getquery->getResult();
    }
    public function get_all_orders_totals($shopurl)
    {
        $qbuilds = $this->db->table('orders');
        $qbuilds->select('*');
        //$qbuilds->where(["order_status" => 'pending']);
        $qbuilds->where(["shop_url" => $shopurl]);
        $qbuilds->orderBy('order_date', 'desc');
        $getquery = $qbuilds->get();
        return $getquery->getResult();
    }
    public function get_token($shop_url)
    {
        $tokenq = "SELECT * FROM shiprocket_api_token WHERE shop_url=? AND token_expiray_date > ?";
        $get_roken_query = $this->db->query($tokenq, array($shop_url, date('Y-m-d')));
        return $get_roken_query->getResult();
    }
    public function get_products_orders($shopurl, $start, $limit)
    {
        $getproducts = "SELECT orders.*,orders_products.product_id,
                        orders_products.product_name,orders_products.product_price,
                        orders_products.product_qty,orders_products.product_sku,orders.shipping_address AS shipadr
                        FROM orders
                        INNER JOIN orders_products
                        ON orders_products.order_id = orders.order_id
                        WHERE orders.shipping_address != '' 
                        AND orders.shop_url=?
                        AND orders.fullfilment_status = ?
                        AND orders.sync_order = ?
                        ORDER BY order_date DESC
                        LIMIT " . $start . ", " . $limit . "";


        $get_orders = $this->db->query($getproducts, array($shopurl, 'Unfulfilled', 0));
        $final_products = array();

        foreach ($get_orders->getResult() as $all_orders) {
            if (!isset($final_products[$all_orders->order_id][0]['shipadr'])) {

                $final_products[$all_orders->order_id][] = array(
                    "order_id" => $all_orders->order_id,
                    "order_number" => $all_orders->order_number,
                    "order_date" => $all_orders->order_date,
                    "order_status" => $all_orders->order_status,
                    "cust_fname" => $all_orders->f_name,
                    "cust_lname" => $all_orders->l_name,
                    "phone" => $all_orders->phone,
                    "email" => $all_orders->email,
                    "shipping_address" => $all_orders->shipping_address,
                    "shipping_address2" => $all_orders->shipping_address2,
                    "shipping_city" => $all_orders->city,
                    "state" => $all_orders->state,
                    "country" => $all_orders->country,
                    "zip" => $all_orders->zip,
                    "phone" => $all_orders->phone,
                    "order_price" => $all_orders->order_price,
                    "total_price" => $all_orders->total_price,
                    "order_weight" => $all_orders->order_weight,
                );
            }
            $final_products[$all_orders->order_id]['items'][] = array(
                "name" => $all_orders->product_name,
                "sku" => $all_orders->product_sku,
                "price" => $all_orders->product_price,
                "qty" => $all_orders->product_qty,
            );
        }
        return $final_products;
    }
    public function track_shiprocket_api_token($data_array)
    {
        //remove old token
        $del_query = "DELETE FROM shiprocket_api_token WHERE shop_url=?";
        $this->db->query($del_query, array($data_array['shop_url']));

        $this->db->table('shiprocket_api_token')->insert($data_array);
    }
    public function track_sync_order($orderid, $shopid)
    {
        $update_q = 'UPDATE orders SET sync_order=1, ship_err=" " WHERE order_id=? AND shop_url=?';
        $this->db->query($update_q, array($orderid, $shopid));
    }
    public function update_order_subtotal($orderid, $update_subtotal, $shopid)
    {
        $update_q = "UPDATE orders SET order_price='" . $update_subtotal . "' WHERE order_id=? AND shop_url=?";
        $this->db->query($update_q, array($orderid, $shopid));
    }

    public function remove_partial_product($id, $shopurl)
    {
        $del_query = "DELETE FROM app_partial_products WHERE product_id=? AND shop_url=?";
        $this->db->query($del_query, array($id, $shopurl));

        $del_query2 = "DELETE FROM ppp_products_varient WHERE product_id=? AND shop_url=?";
        $this->db->query($del_query2, array($id, $shopurl));
    }
    public function get_partial_productget($shopurl)
    {

        $qbuilds = $this->db->table('app_partial_products');
        $qbuilds->select('product_id');
        $qbuilds->where(["shop_url" => $shopurl]);
        $getquery = $qbuilds->get();
        $return_array = array();
        foreach ($getquery->getResult() as $getlist) {
            $return_array[] = $getlist->product_id;
        }
        return $return_array;
    }
    public function get_store_plane($shop_url)
    {

        $query_run1 = "SELECT * FROM ppa_subscribe_store WHERE shop_url=?";
        $querysub = $this->db->query($query_run1, array($shop_url));
        return $querysub->getResult();
    }
    public function track_store_subscribe($insert_data)
    {

        $qbuilder = $this->db->table('ppa_subscribe_store');
        $qbuilder->where('shop_url', $insert_data['shop_url']);
        $q = $qbuilder->get();
        $qbuilder->countAllResults();
        if (!empty($q->getResult())) {
            $this->db->table('ppa_subscribe_store')->where('shop_url', $insert_data['shop_url'])->update($insert_data);
            return $this->db->affectedRows();
        } else {
            return  $qbuilder->insert($insert_data);
        }
    }

    public function update_plan_after_payment($update_data)
    {

        $this->db->table('ppa_subscribe_store')->where('charged_id', $update_data['charged_id'])->update($update_data);
        return $this->db->affectedRows();
    }
    public function update_shops_status($shop_url)
    {
        $updatests = "UPDATE ppa_store_token SET store_status=0 WHERE shop_url=?";
        $this->db->query($updatests, array($shop_url));
    }
    public function delete_webhooks($webhookid)
    {
        $delquery = "DELETE FROM ppa_track_webhooks WHERE webhook_id=?";
        $query = $this->db->query($delquery, array($webhookid));
    }

    public function insert_webhooks($insert_array)
    {

        $qbuilder = $this->db->table('ppa_track_webhooks');
        $qbuilder->where('shop_url', $insert_array['shop_url']);
        $q = $qbuilder->get();
        $qbuilder->countAllResults();
        if (!empty($q->getResult())) {
            $this->db->table('ppa_track_webhooks')->where('shop_url', $insert_array['shop_url'])->update($insert_array);
            return $this->db->affectedRows();
        } else {
            return  $qbuilder->insert($insert_array);
        }
    }
    public function get_store_plan($shop_url)
    {
        $query_run1 = "SELECT * FROM ppa_subscribe_store WHERE shop_url=? AND plan_status=?";
        $querysub = $this->db->query($query_run1, array($shop_url, 'active'));
        return $querysub->getResult();
    }
    public function shiprocket_config_db($insertdata)
    {
        $this->db->table('shiprocket_config')->where('shop_url', $insertdata['shop_url'])->update(array("enable_shipping_type" => ""));
        $qbuilder = $this->db->table('shiprocket_config');
        $qbuilder->where('shop_url', $insertdata['shop_url']);
        $qbuilder->where('shiping_partner_type', $insertdata['shiping_partner_type']);
        $q = $qbuilder->get();
        $qbuilder->countAllResults();
        if (!empty($q->getResult())) {

            $this->db->table('shiprocket_config')->where('shop_url', $insertdata['shop_url'])->where('shiping_partner_type', $insertdata['shiping_partner_type'])->update($insertdata);
            return $this->db->affectedRows();
        } else {

            return  $qbuilder->insert($insertdata);
        }
    }

    public function get_shiprocket_config($shop_url)
    {
        $qbuilder = $this->db->table('shiprocket_config');
        $qbuilder->where('shop_url', $shop_url);
        $q = $qbuilder->get();
        $qbuilder->countAllResults();
        return $q->getResult();
    }
    public function get_shiprocket_config_home($shop_url)
    {
        $dbquery = "SELECT * FROM shiprocket_config
                    WHERE shop_url=?
                    AND enable_shipping_type !='' ";
        $getconfig = $this->db->query($dbquery, array($shop_url));
        return $getconfig->getResult();

        // $qbuilder = $this->db->table('shiprocket_config');
        // $qbuilder->where('shop_url', $shop_url);
        // $qbuilder->where('enable_shipping_type !=', ' ');
        // $q = $qbuilder->get();
        // $qbuilder->countAllResults();
        // return $q->getResult();

    }
    public function get_products_orders_pickrr($shopurl, $start, $limit)
    {
        // $getproducts = "SELECT orders.*,orders_products.product_id,
        //                 orders_products.product_name,orders_products.product_price,
        //                 orders_products.product_qty,orders_products.product_sku,orders.shipping_address AS shipadr
        //                 FROM orders
        //                 INNER JOIN orders_products
        //                 ON orders_products.order_id = orders.order_id
        //                 WHERE orders.shipping_address != '' 
        //                 AND orders.shop_url=?
        //                 AND orders.order_status = ?
        //                 AND orders.pickrr_order_sync = ?
        //                 LIMIT " . $start . ", " . $limit . "";  


        $getproducts = "SELECT orders.*,orders_products.product_id,
                        orders_products.product_name,orders_products.product_price,
                        orders_products.product_qty,orders_products.product_sku,orders.shipping_address AS shipadr
                        FROM orders
                        INNER JOIN orders_products
                        ON orders_products.order_id = orders.order_id
                        WHERE orders.shipping_address != '' 
                        AND orders.shop_url=?
                        AND orders.fullfilment_status = ?
                        AND orders.pickrr_order_sync = ?
                        LIMIT " . $start . ", " . $limit . "";

        $get_orders = $this->db->query($getproducts, array($shopurl, 'Unfulfilled', 0));
        $final_products = array();

        foreach ($get_orders->getResult() as $all_orders) {
            if (!isset($final_products[$all_orders->order_id][0]['shipadr'])) {

                $final_products[$all_orders->order_id][] = array(
                    "order_id" => $all_orders->order_id,
                    "order_number" => $all_orders->order_number,
                    "order_date" => $all_orders->order_date,
                    "cust_fname" => $all_orders->f_name,
                    "cust_lname" => $all_orders->l_name,
                    "phone" => $all_orders->phone,
                    "email" => $all_orders->email,
                    "shipping_address" => $all_orders->shipping_address,
                    "shipping_address2" => $all_orders->shipping_address2,
                    "shipping_city" => $all_orders->city,
                    "state" => $all_orders->state,
                    "order_status" => $all_orders->order_status,
                    "country" => $all_orders->country,
                    "zip" => $all_orders->zip,
                    "phone" => $all_orders->phone,
                    "order_price" => $all_orders->order_price,
                    "total_price" => $all_orders->total_price,
                    "order_weight" => $all_orders->order_weight,
                );
            }
            $final_products[$all_orders->order_id]['items'][] = array(
                "name" => $all_orders->product_name,
                "sku" => $all_orders->product_sku,
                "price" => $all_orders->product_price,
                "qty" => $all_orders->product_qty,
            );
        }
        return $final_products;
    }

    public function get_products_orders_delhivery($shopurl, $start, $limit)
    {
        //echo $shopurl.$start.$limit;
        $getproductsdel = "SELECT orders.*,orders_products.product_id,
                        orders_products.product_name,orders_products.product_price,
                        orders_products.product_qty,orders_products.product_sku,orders.shipping_address AS shipadr
                        FROM orders
                        INNER JOIN orders_products
                        ON orders_products.order_id = orders.order_id
                        WHERE orders.shipping_address != '' 
                        AND orders.shop_url=?
                        AND orders.fullfilment_status = ?
                        AND orders.delhi_very_sync = ?
                        LIMIT " . $start . ", " . $limit . "";

        $get_ordersdel = $this->db->query($getproductsdel, array($shopurl, 'Unfulfilled', '0'));
        $final_productsdel = array();
        //print_r($get_ordersdel->getResult());
        foreach ($get_ordersdel->getResult() as $gtall_orders) {

            if (!isset($final_productsdel[$gtall_orders->order_id][0]['shipadr'])) {

                $final_productsdel[$gtall_orders->order_id][] = array(
                    "order_id" => $gtall_orders->order_id,
                    "order_number" => $gtall_orders->order_number,
                    "order_date" => $gtall_orders->order_date,
                    "order_status" => $gtall_orders->order_status,
                    "cust_fname" => $gtall_orders->f_name,
                    "cust_lname" => $gtall_orders->l_name,
                    "phone" => $gtall_orders->phone,
                    "email" => $gtall_orders->email,
                    "shipping_address" => $gtall_orders->shipping_address,
                    "shipping_address2" => $gtall_orders->shipping_address2,
                    "shipping_city" => $gtall_orders->city,
                    "state" => $gtall_orders->state,
                    "country" => $gtall_orders->country,
                    "zip" => $gtall_orders->zip,
                    "order_price" => $gtall_orders->order_price,
                    "total_price" => $gtall_orders->total_price,
                    "order_weight" => $gtall_orders->order_weight,
                );
            }
            $final_productsdel[$gtall_orders->order_id]['items'][] = array(
                "name" => $gtall_orders->product_name,
                "sku" => $gtall_orders->product_sku,
                "price" => $gtall_orders->product_price,
                "qty" => $gtall_orders->product_qty,
            );
        }
        return $final_productsdel;
    }


    public function update_pickrr_order($orderid, $shopid)
    {
        $update_q = 'UPDATE orders SET pickrr_order_sync=1, pickrr_err = " " WHERE order_id=? AND shop_url=?';
        $this->db->query($update_q, array($orderid, $shopid));
    }

    public function update_delhivery_order($orderid, $shopid)
    {
        $update_q = 'UPDATE orders SET delhi_very_sync=1, delhivery_err = " "  WHERE order_id=? AND shop_url=?';
        $this->db->query($update_q, array($orderid, $shopid));
    }
    public function update_delhivery_err($orderid, $shopid, $msg)
    {
        $update_q = "UPDATE orders SET delhivery_err='" . $msg . "' WHERE order_id=? AND shop_url=?";

        $this->db->query($update_q, array($orderid, $shopid));
    }
    public function update_pickr_err($orderid, $shopid, $msg)
    {
        $update_q = "UPDATE orders SET pickrr_err='" . $msg . "' WHERE order_id=? AND shop_url=?";

        $this->db->query($update_q, array($orderid, $shopid));
    }
    public function update_shiprocket_err($orderid, $shopid, $msg)
    {
        $update_q = "UPDATE orders SET ship_err='" . $msg . "' WHERE order_id=? AND shop_url=?";

        $this->db->query($update_q, array($orderid, $shopid));
    }

    public function check_test_response($data_array)
    {
        $this->db->table('test_tbl')->insert($data_array);
    }
    public function update_plan_orders($updatec, $shop_url)
    {
        $updatests = "UPDATE ppa_subscribe_store SET updated_sync_orders_count=updated_sync_orders_count-" . $updatec . " WHERE shop_url=?";
        $this->db->query($updatests, array($shop_url));
    }

    public function get_collection_percentage($shopurl)
    {
        $get_coll_precn = "SELECT * FROM collections_percentage
                          WHERE shop_url=?";

        $get_coll_result = $this->db->query($get_coll_precn, array($shopurl));
        $final_products = array();

        foreach ($get_coll_result->getResult() as $all_coll_per) {
            // echo "<pre>";
            // print_r($all_coll_per);
            // echo "</pre>";
            $final_products[$all_coll_per->collection_id] = array("percentage" => $all_coll_per->partial_percentage);
        }
        return $final_products;
    }
    public function update_plan_products($updatec, $shop_url)
    {
        $updatests = "UPDATE ppa_subscribe_store SET updated_products_partial=updated_products_partial-" . $updatec . " WHERE shop_url=?";
        $this->db->query($updatests, array($shop_url));

        //update total partial product count in main store db table
        $update_total_par_product_count = "UPDATE ppa_store_token SET total_sync_store_products=total_sync_store_products + " . $updatec . " WHERE shop_url=?";
        $this->db->query($update_total_par_product_count, array($shop_url));
    }

    public function update_plan_products_remove_part($shop_url)
    {
        $updatests = "UPDATE ppa_subscribe_store SET updated_products_partial=updated_products_partial+1 WHERE shop_url=?";
        $this->db->query($updatests, array($shop_url));

        //update total partial product count in main store db table
        $update_total_par_product_count_remove = "UPDATE ppa_store_token SET total_sync_store_products=total_sync_store_products-1 WHERE shop_url=?";
        $this->db->query($update_total_par_product_count_remove, array($shop_url));
    }
    public function testinsert()
    {
        echo $prqury  = "INSERT INTO test_tbl (name) VALUES('testrecord')";
        $getdata = $this->db->query($prqury);
        echo  $getdata;
    }
    public function get_order_detail($orderid)
    {
        $get_order_detail = "SELECT * FROM orders WHERE order_id =?";
        $get_order_detail_result = $this->db->query($get_order_detail, array($orderid));
        return $get_order_detail_result->getRow();
    }
    public function update_order_details($updatedata)
    {
        $this->db->table('orders')->where('order_id', $updatedata['order_id'])->where('shop_url', $updatedata['shop_url'])->update($updatedata);
        return $this->db->affectedRows();
    }
    public function get_webhook_id($shop_url)
    {

        $qbuilder = $this->db->table('ppa_track_webhooks');
        $qbuilder->where('shop_url', $shop_url);
        $q = $qbuilder->get();
        return $q->getResult();
    }
    public function get_cron_collection()
    {

        $collection_q = $this->db->table('collections_percentage');
        $collection_q->where('movements', date('Y-m-d'));
        $collection_q->where('cron_run', 0);
        $collection_q->limit(1);
        $get_collection_data = $collection_q->get();
        return $get_collection_data->getRow();
    }
    public function update_cron_products($updatedata)
    {
        $this->db->table('collections_percentage')->where('collection_id', $updatedata['collection_id'])->where('shop_url', $updatedata['shop_url'])->update($updatedata);
        return $this->db->affectedRows();
    }
    public function add_test_partial($insertdata)
    {

        $qbuilder = $this->db->table('addtestpartproduct');
        $qbuilder->where('product_id', $insertdata['product_id']);
        $q = $qbuilder->get();
        $qbuilder->countAllResults();
        if (!empty($q->getResult())) {
            $this->db->table('addtestpartproduct')->where('product_id', $insertdata['product_id'])->update($insertdata);
            return $this->db->affectedRows();
        } else {

            return  $qbuilder->insert($insertdata);
        }
    }
    public function track_user_log($insert_data)
    {
        $this->db->table('user_track_log')->insert($insert_data);
    }
    public function track_lates_records($update_data)
    {
        $qbuilder = $this->db->table('show_latest_partial');
        $qbuilder->where('shop_url', $update_data['shop_url']);
        $q = $qbuilder->get();
        $qbuilder->countAllResults();
        if (!empty($q->getResult())) {
            $this->db->table('show_latest_partial')->where('shop_url', $update_data['shop_url'])->update($update_data);
            return $this->db->affectedRows();
        } else {

            return  $qbuilder->insert($update_data);
        }
    }
    public function get_lates_records($shop_url)
    {

        $payxnow_qublder = $this->db->table('show_latest_partial');
        $payxnow_qublder->where('shop_url', $shop_url);
        $payxq = $payxnow_qublder->get();
        return $payxq->getResult();
    }
    public function deactivate_price_plane($insert_data)
    {

        $this->db->table('ppa_subscribe_store')->where('shop_url', $insert_data['shop_url'])->update($insert_data);
        return $this->db->affectedRows();
    }
    public function get_charge_id($shop_url)
    {

        $payxnow_qublder = $this->db->table('ppa_subscribe_store');
        $payxnow_qublder->where('shop_url', $shop_url);
        $payxq = $payxnow_qublder->get();
        return $payxq->getResult();
    }
    public function track_checkout_button_color($product_array)
    {
        $qbuilder = $this->db->table('cg_dynamic_css');
        $qbuilder->where('shop_url', $product_array['shop_url']);
        //$qbuilder->where('product_id', $product_array['product_id']);
        $q = $qbuilder->get();
        $qbuilder->countAllResults();
        if (!empty($q->getResult())) {
            $this->db->table('cg_dynamic_css')->where('shop_url', $product_array['shop_url'])->update($product_array);
            return $this->db->affectedRows();
        } else {

            return  $qbuilder->insert($product_array);
        }
    }
    public function get_checkout_button_color($shoup_url)
    {
        $qbuilder = $this->db->table('cg_dynamic_css');
        $qbuilder->where('shop_url', $shoup_url);
        $get_colorbtn = $qbuilder->get();
        return $get_colorbtn->getResult();
    }
    public function get_partial_percentage($product_array)
    {
        $qbuilder = $this->db->table('app_partial_products');
        $qbuilder->where('shop_url', $product_array['shop_url']);
        $qbuilder->where('product_id', $product_array['product_id']);
        $cg_split2shipq = $qbuilder->get();
        return $cg_split2shipq->getResult();
    }
    public function add_partial_products_collections($product_array)
    {
        $qbuilder = $this->db->table('app_partial_products');
        $qbuilder->where('shop_url', $product_array['shop_url']);
        $qbuilder->where('product_id', $product_array['product_id']);
        $q = $qbuilder->get();
        $qbuilder->countAllResults();
        if (!empty($q->getResult())) {
            $this->db->table('app_partial_products')->where('shop_url', $product_array['shop_url'])->where('product_id', $product_array['product_id'])->update($product_array);
            return $this->db->affectedRows();
        } else {
            $this->update_plan_products(1, $product_array['shop_url']);
            return  $qbuilder->insert($product_array);
        }
    }
    public function insert_addcart_webhooks($insert_array)
    {

        $qbuilder = $this->db->table('track_new_webhook');
        $qbuilder->where('shop_url', $insert_array['shop_url']);
        $q = $qbuilder->get();
        $qbuilder->countAllResults();
        if (!empty($q->getResult())) {
            $this->db->table('track_new_webhook')->where('shop_url', $insert_array['shop_url'])->update($insert_array);
            return $this->db->affectedRows();
        } else {
            return  $qbuilder->insert($insert_array);
        }
    }
    public function get_addcart_webhooks($shop_url)
    {

        $qbuilder = $this->db->table('track_new_webhook');
        $qbuilder->where('shop_url', $shop_url);
        $q = $qbuilder->get();
        return $q->getResult();
    }
    public function track_cart_itme_data($add_to_cart_line_item)
    {

        //$del_query = "DELETE FROM add_cart_data_store WHERE shop_url=? AND cart_id=?";
        //$this->db->query($del_query, array($add_to_cart_line_item['shop_url'],$add_to_cart_line_item['cart_id']));

        // $this->db->table('add_cart_data_store')->insert($add_to_cart_line_item);
        // return $this->db->insertID();

        $qbuilder = $this->db->table('add_cart_data_store');
        $qbuilder->where('shop_url', $add_to_cart_line_item['shop_url']);
        $qbuilder->where('cart_id', $add_to_cart_line_item['cart_id']);
        $qbuilder->where('variant_id', $add_to_cart_line_item['variant_id']);
        $q = $qbuilder->get();
        $qbuilder->countAllResults();
        if (!empty($q->getResult())) {
            $this->db->table('add_cart_data_store')->where('shop_url', $add_to_cart_line_item['shop_url'])->where('cart_id', $add_to_cart_line_item['cart_id'])->update($add_to_cart_line_item);
            return $this->db->affectedRows();
        } else {
            return  $qbuilder->insert($add_to_cart_line_item);
        }
    }
    public function remove_cart_item($add_to_cart_line_item)
    {
        $del_query = "DELETE FROM add_cart_data_store WHERE shop_url=? AND cart_id=?";
        $this->db->query($del_query, array($add_to_cart_line_item['shop_url'], $add_to_cart_line_item['cart_id']));
    }
    public function get_cart_itme_based_on_token($getarra)
    {
        $cart_qbuilder = $this->db->table('add_cart_data_store');
        $cart_qbuilder->where('shop_url', $getarra['shop_url']);
        $cart_qbuilder->where('cart_id', $getarra['cart_id']);
        $cart_q = $cart_qbuilder->get();
        return $cart_q->getResult();
    }
    public function check_cron_ruinning_stst($data_array)
    {
        $this->db->table('cron_run_track')->insert($data_array);
    }
    public function remove_add_cart_data($removedata)
    {
        $del_addcartdata_query = "DELETE FROM add_cart_data_store WHERE variant_id=? AND shop_url=?";
        $this->db->query($del_addcartdata_query, array($removedata['variant_id'], $removedata['shop_url']));

        // $deleetproductby_varient = "DELETE FROM app_partial_products WHERE product_id = ( SELECT product_id FROM ppp_products_varient WHERE varient_id = ? LIMIT 0,1 )";
    }
    public function remove_custom_product_partial($removedata)
    {

        //remove products from partial list
        $deleetproductby_varient_products = "DELETE FROM app_partial_products WHERE product_id = ( SELECT product_id FROM ppp_products_varient WHERE varient_id = ? AND shop_url=? LIMIT 0,1 )";
        $this->db->query($deleetproductby_varient_products, array($removedata['variant_id'], $removedata['shop_url']));

        //remove varient from partial list
        $deleetproductby_varient = "DELETE FROM ppp_products_varient WHERE varient_id = ? AND shop_url=?";
        $this->db->query($deleetproductby_varient, array($removedata['variant_id'], $removedata['shop_url']));
    }

    public function add_partial_products_customonly($product_array)
    {
        $qbuilder = $this->db->table('app_partial_products');
        $qbuilder->where('shop_url', $product_array['shop_url']);
        $qbuilder->where('product_id', $product_array['product_id']);
        $q = $qbuilder->get();
        $qbuilder->countAllResults();
        if (!empty($q->getResult())) {
            $this->db->table('app_partial_products')->where('shop_url', $product_array['shop_url'])->where('product_id', $product_array['product_id'])->update($product_array);
            return $this->db->affectedRows();
        } else {
            //$this->update_plan_products(1, $product_array['shop_url']);
            return  $qbuilder->insert($product_array);
        }
    }
    public function remove_update_cart_whook($shopiurl)
    {
        $delete_update_cart_webhook = "DELETE FROM track_new_webhook WHERE shop_url=?";
        $this->db->query($delete_update_cart_webhook, array($shopiurl));
    }
    public function get_all_shops(){
        $get_all_shops = $this->db->query("SELECT * FROM ppa_store_token LIMIT 80,20");
        foreach($get_all_shops->getResult() as $allshop){
            echo"<pre>"; print_r($allshop); echo "</pre>";
            $get_allsyncproducts = $this->db->query("SELECT count(*) as totalpro FROM `app_partial_products` WHERE `shop_url`='".$allshop->shop_url."'");
            
            $gettotl = $get_allsyncproducts->getResult();
            echo "UPDATE ppa_store_token SET total_sync_store_products='".$gettotl[0]->totalpro."' WHERE `shop_url`='".$allshop->shop_url."'";
            $this->db->query("UPDATE ppa_store_token SET total_sync_store_products='".$gettotl[0]->totalpro."' WHERE `shop_url`='".$allshop->shop_url."'");
            
        }
    }

    public function get_all_stores_expiray_plan(){

        // $tokenq = "SELECT * FROM ppa_subscribe_store WHERE token_expiray_date > ?";
        // $get_roken_query = $this->db->query($tokenq, array(date('Y-m-d')));
        // return $get_roken_query->getResult();


        $get_all_shops_exp = $this->db->query("
                                    SELECT ppa_subscribe_store.*,ppa_store_token.access_token,ppa_store_token.total_sync_store_products
                                    FROM ppa_subscribe_store
                                    INNER JOIN ppa_store_token
                                    ON ppa_store_token.shop_url = ppa_subscribe_store.shop_url
                                    WHERE plan_validity < '".date('Y-m-d')."' AND charged_id !='' 
                                    AND plan_status='active'");
        return $get_all_shops_exp->getResult();        
    }
    public function track_zip_codes($insertdata){
        //remove old zip codes
        $del_query = "DELETE FROM cg_zip_codes WHERE shop_url=?";
        $this->db->query($del_query, array($insertdata['shop_url']));

        //replace new zip codes
        $this->db->table('cg_zip_codes')->insert($insertdata);
    }
}
