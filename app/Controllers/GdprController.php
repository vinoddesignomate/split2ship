<?php

namespace App\Controllers;

use App\Models\UserModel;

class GdprController extends BaseController
{
    function verify_webhook($data, $hmac_header)
    {
        $calculated_hmac = base64_encode(hash_hmac('sha256', $data, '704c6b4e32bd9430a20de89e1373bb71', true));
        return hash_equals($hmac_header, $calculated_hmac);
    }
    public function user_data_request()
    {
        //define('CLIENT_SECRET', 'my_client_secret');
        if (isset($_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'])) {
            $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
            $data = file_get_contents('php://input');
            $verified = $this->verify_webhook($data, $hmac_header);

            if ($verified) {
                echo json_encode('200 OK');
            } else {

                ob_start();
                header('HTTP/1.0 401 Unauthorized');
                echo '401 Unauthorized';
                exit;
            }
        } else {
            ob_start();
            header('HTTP/1.0 401 Unauthorized');
            echo '401 Unauthorized';
            exit;
        }
    }
    public function user_data_erasure()
    {
        if (isset($_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'])) {
            $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
            $data = file_get_contents('php://input');
            $verified = $this->verify_webhook($data, $hmac_header);

            if ($verified) {
                echo json_encode('200 OK');
            } else {
                ob_start();
                header('HTTP/1.0 401 Unauthorized');
                echo '401 Unauthorized';
                exit;
            }
        } else {
            ob_start();
            header('HTTP/1.0 401 Unauthorized');
            echo '401 Unauthorized';
            exit;
        }
    }
    public function shop_data_del()
    {
        if (isset($_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'])) {
            $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
            $data = file_get_contents('php://input');
            $verified = $this->verify_webhook($data, $hmac_header);

            if ($verified) {
                echo json_encode('200 OK');
            } else {
                ob_start();
                header('HTTP/1.0 401 Unauthorized');
                echo '401 Unauthorized';
                exit;
            }
        } else {

            ob_start();
            header('HTTP/1.0 401 Unauthorized');
            echo '401 Unauthorized';
            exit;
        }
    }
}
