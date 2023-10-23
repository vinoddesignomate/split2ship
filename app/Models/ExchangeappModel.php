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
}
?>