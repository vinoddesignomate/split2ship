<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//Auth routes
$routes->get('/install', 'Auth::install_func');
$routes->get('/token', 'Auth::token');

//admin app routes
$routes->match(['get', 'post'],'/', 'Home::index');
$routes->match(['get', 'post'],'/mainpage', 'Home::mainpage');
$routes->match(['get', 'post'],'/product-pagination', 'Home::product_pagination');
$routes->match(['get', 'post'],'/home-product-pagination', 'Home::product_pagination2');
$routes->match(['get', 'post'],'/products-list', 'Home::assign_products_partial');
$routes->match(['get', 'post'],'/partial-products-list', 'Home::show_partial_products');
$routes->match(['get', 'post'],'/partial-latest-products-list', 'Home::show_latest_partial_products');
$routes->match(['get', 'post'],'/show-orders', 'Home::show_all_orders');
$routes->match(['get', 'post'],'/products-remove', 'Home::product_remove');
$routes->match(['get', 'post'],'/track_partial_percentage', 'Home::track_partial_percentage');
$routes->match(['get', 'post'],'/collection_track_partial_percentage', 'Home::collection_track_partial_percentage');
$routes->match(['get', 'post'],'/shiprocket-config', 'Home::shiprocket_config');
$routes->match(['get', 'post'],'/app-configuration', 'Home::app_configuration');
$routes->match(['get', 'post'],'/get_shipping_partners', 'Home::get_shipping_partners');
$routes->match(['get', 'post'],'/track_userinf', 'Home::track_userinfo');



//price plane routes
$routes->match(['get', 'post'],'/price-plan', 'Home::price_plan_page');
$routes->match(['get', 'post'],'/subscribe-app', 'Home::get_subscribe');
$routes->match(['get', 'post'],'/return_url', 'Home::get_subscribe_return');

//store front end routes
$routes->match(['get', 'post'],'/frontend-handler', 'FrontController::get_product_details');
$routes->match(['get', 'post'],'/frontend-temp-ord', 'FrontController::create_draft_order');
$routes->match(['get', 'post'],'/edit-order-graphl', 'FrontController::edit_order_partial');
$routes->match(['get', 'post'],'/frontend-getdata', 'FrontController::test_proxychk');

//webhook urls
$routes->match(['get', 'post'],'/order-sync', 'Home::order_sync');
$routes->match(['get', 'post'],'/order-sync-pickrr', 'Home::order_sync_pickrr');
$routes->match(['get', 'post'],'/paxnow_update_products', 'AppwhookController::update_productswebhk');
$routes->match(['get', 'post'],'/cleanup_app', 'AppwhookController::uninstall_app');
$routes->match(['get', 'post'],'/syncallorders', 'AppwhookController::auto_ordersync');
$routes->match(['get', 'post'],'/paidordernotify', 'AppwhookController::paidordernotify');
$routes->match(['get', 'post'],'/updateordernotify', 'AppwhookController::updateordernotify');
$routes->match(['get', 'post'],'/orderedt', 'AppwhookController::orderedt');

//GDPR mandatory webhooks url
$routes->match(['get', 'post'],'/user-data-user', 'GdprController::user_data_request');  //Customer data request endpoint
$routes->match(['get', 'post'],'/user-data-del', 'GdprController::user_data_erasure');  //Customer data erasure endpoint
$routes->match(['get', 'post'],'/shop-data-endel', 'GdprController::shop_data_del');  //Shop data erasure endpoint



$routes->match(['get', 'post'],'/check-ordercreate', 'FrontController::order_create_cehck');  //Shop data erasure endpoint


//cron job routes
$routes->match(['get', 'post'],'/collection_partial_add', 'FrontController::add_collection_partial_cron'); 


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
