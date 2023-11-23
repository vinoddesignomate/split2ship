<?php

namespace App\Models;

use CodeIgniter\Model;

class ExchangeappModel extends Model
{
    protected $table      = 'ppa_store_token';
    protected $primaryKey = 'id';
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }
    public function track_exchange_orders($data_array, $shopurl)
    {

        $qbuilder_insert = $this->db->table('cg_exchange_return');
        $qbuilder_insert->where('order_id', $data_array['order_id']);
        $qbuilder_insert->where('shop_url', $shopurl);
        $qgetordpro = $qbuilder_insert->get();
        $qbuilder_insert->countAllResults();
        // $del_query = "DELETE FROM orders_products WHERE order_id=?";
        // $this->db->query($del_query, array($data_array['order_id'])); 
        // echo"inmodel<pre>"; print_r($qgetordpro->getResult()); echo"</pre>";
        if (!empty($qgetordpro->getResult())) {

            //$all_result = $q->getResult();
            $this->db->table('cg_exchange_return')->where('order_id', $data_array['order_id'])->update($data_array);
            //return $all_result[0]->id;
            return '2';
        } else {

            $this->db->table('cg_exchange_return')->insert($data_array);
            // return $this->db->insertID();
            return '1';
        }
    }
    public function track_orders_products_exchange($data_array)
    {

        $qbuilder = $this->db->table('cg_exchange_return_order_products');
        $qbuilder->where('product_id', $data_array['product_id']);
        $qbuilder->where('order_id', $data_array['order_id']);
        $qbuilder->where('shop_url', $data_array['shop_url']);
        $q = $qbuilder->get();
        // $qbuilder->countAllResults();
        if (empty($q->getResult())) {
            return  $this->db->table('cg_exchange_return_order_products')->insert($data_array);
        } else {
            $this->db->table('cg_exchange_return_order_products')->where('order_id', $data_array['order_id'])->where('product_id', $data_array['product_id'])->where('shop_url', $data_array['shop_url'])->update($data_array);
            return '';
        }
    }
    public function get_order_info($orderid)
    {
        $getexchange_data = $this->db->table('cg_exchange_return_order_products');
        $getexchange_data->where('order_id', $orderid);
        $getresultdata = $getexchange_data->get();
        return $getresultdata->getResult();
    }
    public function update_exchnage_reason($data_array)
    {

        $qbuilder = $this->db->table('cg_exchange_return_order_products');
        $qbuilder->where('varient_id', $data_array['varient_id']);
        $qbuilder->where('order_id', $data_array['order_id']);
        $qbuilder->where('shop_url', $data_array['shop_url']);
        $q = $qbuilder->get();
        // $qbuilder->countAllResults();
        if (empty($q->getResult())) {
            return  $this->db->table('cg_exchange_return_order_products')->insert($data_array);
        } else {
            $this->db->table('cg_exchange_return_order_products')->where('order_id', $data_array['order_id'])->where('varient_id', $data_array['varient_id'])->where('shop_url', $data_array['shop_url'])->update($data_array);
            return '';
        }
    }
    public function get_items_info($varientsids, $arrayprms)
    {
        // $qbuilder = $this->db->table('track_order_exchange_app');
        // $qbuilder->where('varient_id', $arrayprms['varient_id']);
        // $qbuilder->where('order_id', $arrayprms['order_id']);
        // $qbuilder->where('shop_url', $arrayprms['shop_url']);
        // $getexquery = "SELECT * FROM track_order_exchange_app WHERE varient_id IN (?) AND order_id=? AND shop_url=?";
        // $getreslt = $this->db->query($getexquery,array(implode(",", $varientsids),$arrayprms['order_id'],$arrayprms['shop_url']));
        $getexquery = "SELECT * FROM track_order_exchange_app WHERE varient_id IN (" . implode(',', array_fill(0, count(explode(',', $varientsids)), '?')) . ") AND order_id=? AND shop_url=?";
        $queryParams = array_merge(explode(',', $varientsids), array($arrayprms['order_id'], $arrayprms['shop_url']));
        $getreslt = $this->db->query($getexquery, $queryParams);


        return $getreslt->getResult();
    }
}
