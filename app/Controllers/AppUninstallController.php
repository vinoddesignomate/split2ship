<?php

namespace App\Controllers;
use App\Models\UserModel;

class AppUninstallController extends BaseController
{



    // function __construct()
    // {

    //     //helper(['form', 'url']);

    //     // $session = \Config\Services::session();

    //     $this->user_model = new UserModel();

    //     //$this->check_subscribe();

    // }

    public function uninstall_app()
    {
        
        $userModel = new UserModel();
        $shop_header = $_SERVER['HTTP_X_SHOPIFY_SHOP_DOMAIN'];
        $get_webhook_details = $userModel->get_webhook_id($shop_header);
        if (!empty($get_webhook_details)) {
            $webid = $get_webhook_details[0]->webhook_id;
            // $insertara = array(
            //     "reposne" => json_encode($_SERVER),
            //     "date_time" => date('Y-m-d H:i:s')
            // );
            // $userModel->insert_logs($insertara);
            $get_details = $userModel->get_tokens($shop_header);
            $userModel->delete_webhooks($webid);
            $userModel->update_shops_status($shop_header);
            $insert_logs = array(
                "shop_url"=>$shop_header,
                "shop_status"=>"Uninstalled",
                "movements"=>date('Y-m-d H:i:s'),
            );
           $userModel->update_install_uninstall_logs($insert_logs);
        }
        echo "200 ok";
        exit();
    }
}
echo "200 ok";
