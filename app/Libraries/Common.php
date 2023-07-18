<?php

namespace App\Libraries;

class Common
{
    public function __construct()
    {
        //$this->CI = &get_instance();
        //load library
        // $this->CI->load->library('form_validation');
        // $this->CI->load->library('session');
        // $this->CI->load->library('email');
        // $this->CI->load->library('pagination');
        //load model

        //$this->CI->load->model('common_model');
    }
    public function testcheck()
    {
        echo "calling";
    }

    public function rest_api($api_endpoint, $query = array(), $method = 'GET', $access_token, $shop_url)
    {
        $url = 'https://' . $shop_url . $api_endpoint;

        if (in_array($method, array('GET', 'DELETE')) && !is_null($query)) {

            $url = $url . '?' . http_build_query($query);
        }
        //echo "curl=".$url;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 3);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);

        $headers[] = "";
        //if (!is_null($access_token)) {
        $headers[] = "X-Shopify-Access-Token: " . $access_token;
        // $headers[] = "X-Shopify-Access-Token: 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";
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //}

        if ($method != 'GET' && in_array($method, array('POST', 'PUT'))) {
            if (is_array($query)) $query = http_build_query($query);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $query);
        }
        $response = curl_exec($curl);
        // echo "response=".$response;
        $error = curl_errno($curl);
        $error_msg  = curl_error($curl);
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
                // $data = explode(":", $conent);
                $data = explode(":", $conent, 2);
                $headers[trim($data[0])] = trim($data[1]);
            }
            return array("headers" => $headers, "body" => $response[1]);
        }
    }
    public function getproductsgrapqlapi($params_array,$shop_url, $acctoken)
    {

        //this commenting code for if we use to filter with colletion id
        //collection(id: "gid://shopify/Collection/443446100266") {
        //}
        $newpageing="";
        $search_query="";
        if(isset($params_array['nextpage_getpage'])){
            $newpageing = 'first: '.$params_array['limit'].',after:"'.$params_array['nextpage_getpage'].'"';
            $startCursor = "startCursor";
            $endCursor = "endCursor";
        }else if(isset($params_array['prev_getpage'])){
            $newpageing = 'last: '.$params_array['limit'].',before:"'.$params_array['prev_getpage'].'"';
            $startCursor = "startCursor";
            $endCursor = "endCursor";
        }else{
            $newpageing = 'first: '.$params_array['limit'].'';
            $startCursor = "";
            $endCursor = "endCursor";
        }
        if(isset($params_array['search_parms'])){
            $search_query = ',query:"title:'.$params_array['search_parms'].'"';
            $get_products_query = array("query" => '{
                products('.$newpageing.''.$search_query.') {
                      edges {
                        node {
                          id
                          title
                          description
                          variants(first: 5) {
                            edges {
                              node {
                                id
                                title
                                price
                              }
                            }
                          }
                        }
                      }
                      pageInfo {
                        hasNextPage
                        hasPreviousPage
                        '.$startCursor.'
                        '.$endCursor.'
                      }
                    }
                  }');
        }else{
            $get_products_query = array("query" => '{
                collection(id: "gid://shopify/Collection/'.$params_array['collection_id'].'") {
                products('.$newpageing.''.$search_query.') {
                      edges {
                        node {
                          id
                          title
                          description
                          variants(first: 5) {
                            edges {
                              node {
                                id
                                title
                                price
                              }
                            }
                          }
                        }
                      }
                      pageInfo {
                        hasNextPage
                        hasPreviousPage
                        '.$startCursor.'
                        '.$endCursor.'
                      }
                    }
                  }
                }');
        }
        
        //print_r($get_products_query);
        return $this->graphql_api($get_products_query, $shop_url, $acctoken);
        
    }
    public function graphql_api($query = array(), $shop_url, $acc_token)
    {

        $url = 'https://' . $shop_url . '/admin/api/2023-01/graphql.json';

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 3);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $headers[] =  "";
        $headers[] =  "Content-Type: application/json";
        if ($acc_token) $headers[] = "X-Shopify-Access-Token: " . $acc_token;

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($query));
        curl_setopt($curl, CURLOPT_POST, true);

        $response = curl_exec($curl);
        $error = curl_errno($curl);
        $error_msg  = curl_error($curl);
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
    function str_btwn($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
    public function draft_order_creat($token, $shopname, $final_array)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://a47ead69b3d83a8042703f093f3cadb2:' . $token . '@' . $shopname . '/admin/api/2022-10/draft_orders.json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            // CURLOPT_POSTFIELDS => '{
            //     "draft_order":{
            //         "line_items":[
            //             {
            //             "title":"Test One",
            //             "price":"20.00",
            //             "quantity":1
            //            },
            //            {
            //            "variant_id": 43254815850724,
            //            "quantity": 1
            //            }
            //     ]                   
            //     }
            // }', 
            CURLOPT_POSTFIELDS => json_encode($final_array),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        //echo $response;

        curl_close($curl);
        $return_array = json_decode($response);
        // print_r($return_array);
        return $return_array->draft_order->invoice_url;
    }
    function create_custom_order($post_data, $store_token)
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/orders/create/adhoc',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($post_data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $store_token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    function create_custom_order_delhivery($post_data, $store_token)
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://track.delhivery.com/api/cmu/create.json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => ($post_data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Token ' . $store_token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response, true);
        curl_close($curl);
        return $response;
    }
    function update_delhivery_order($post_data, $store_token)
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://staging-express.delhivery.com/api/p/edit',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => ($post_data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Token ' . $store_token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response, true);
        curl_close($curl);
        return $response;
    }


    public function call_api_curl($api_url, $query = array(), $method = 'GET', $access_token)
    {


        $url = $api_url;

        if (in_array($method, array('GET', 'DELETE')) && !is_null($query)) {

            $url = $url . '?' . http_build_query($query);
        }
        // echo "curl=".$url;
        $curl = curl_init($url);
        //curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 3);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);

        $headers[] = "";
        if (!is_null($access_token)) {
            $headers[] = "Authorization: " . $access_token;
            // $headers[] = "X-Shopify-Access-Token: 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";
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }
        $headers[] = "Content-Type: application/json";

        if ($method != 'GET' && in_array($method, array('POST', 'PUT'))) {
            if (is_array($query)) $query = http_build_query($query);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $query);
        }
        $response = curl_exec($curl);
        // echo "response=".$response;
        $error = curl_errno($curl);
        $error_msg  = curl_error($curl);
        curl_close($curl);
        if ($error) {
            return "error";
        } else {


            return $response;
        }
    }

    public function payxnow_encodedata($userdata)
    {

        $plaintext = $userdata;
        $encryptionKey = "cd983a8540173d68292f21ab4de644bec471dba50bef7435b8de175044a7c6ab";
        $ivSize = openssl_cipher_iv_length('AES-256-CBC');
        $iv = openssl_random_pseudo_bytes($ivSize);
        $ciphertext = openssl_encrypt($plaintext, 'AES-256-CBC', $encryptionKey, 0, $iv);
        return $encryptedData = base64_encode($iv . $ciphertext);
    }
    public function payxnow_decodedata($userdata)
    {
        //echo $userdata;
        $encryptionKey = "cd983a8540173d68292f21ab4de644bec471dba50bef7435b8de175044a7c6ab";
        $decodedData = base64_decode($userdata);
        $ivSize = openssl_cipher_iv_length('AES-256-CBC');
        $iv = substr($decodedData, 0, $ivSize);
        $ciphertext = substr($decodedData, $ivSize);
        return $decryptedData = openssl_decrypt($ciphertext, 'AES-256-CBC', $encryptionKey, 0, $iv);
    }
}
