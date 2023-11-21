<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/style.css">


    <script src="https://unpkg.com/@shopify/app-bridge@3"></script>
    <!-- <script src="https://unpkg.com/@shopify/app-bridge@3"></script> -->
    <script>
        var AppBridge = window['app-bridge'];
        var actions = window['app-bridge'].actions;
        var createApp = AppBridge.default;
        //var Redirect = actions.Redirect;
        //var currentURL = window.location.href;
        const config = {
            apiKey: 'a47ead69b3d83a8042703f093f3cadb2',
            host: new URLSearchParams(location.search).get("host"),
            forceRedirect: false
        };
        const app = createApp(config);
       /* app.route({
            path: '/apps/splitexchange',
            render: () => {
                // Render your custom template or section here
                // Get a reference to the container where you want to render your HTML
                const container = document.querySelector('#MainContent');
                // Create an HTML element, e.g., a div, and set its innerHTML to your HTML content
                const customHTML = `
                        <div>
                            <h1>Your Custom HTML Content</h1>
                            <p>This is your custom content.</p>
                        </div>
                        `;

                container.innerHTML = customHTML;
            },
        });*/
        // const redirect = Redirect.create(app);
        //console.log('currentURL');
        //console.log(config.shopifyAppBridge.getState().location.currentURL);
    </script>
    <script src='//in.fw-cdn.com/31326200/628621.js' chat='true'>
    </script>
</head>
<?php

$link = $_SERVER['PHP_SELF'];

$link_array = explode('/', $link);

$page_name = end($link_array);


$shop_name = explode(".", $_GET['shop']);
$store_name = $shop_name[0];
if ($page_name == "index.php" || $page_name == "mainpage") {
    $clsname = "payxhomecls";
} else {
    $clsname = $page_name;
}
?>

<body class="<?php echo $clsname; ?> ">

    <!-- Header section -->
    <header>
        <div class="payxnowandrestondelivery-container">
            <div class="payxnowandrestondelivery-header-wrapper">
                <div class="payxnowandrestondelivery-logo-col">
                    <a onclick='abc(event);' href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/"><img src="/public/images/site-logo.svg" alt="site-logo"></a>
                </div>
                <nav class="payxnowandrestondelivery-header-nav-links">
                    <ul>
                        <li><a onclick='abc(event);' class="<?php echo ($page_name == 'products-list') ? 'payxnowandrestondelivery-active' : '' ?> " href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/products-list"><img src="/public/images/product.svg" class="payxnowandrestondelivery-hide-hover" alt="product-icon"><img src="/public/images/product-yellow.svg" class="payxnowandrestondelivery-on-hover" alt="product-icon">
                                Products</a></li>
                        <li><a onclick='abc(event);' class="<?php echo ($page_name == 'collection-wise-partial-products') ? 'payxnowandrestondelivery-active' : '' ?> " href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/collection-wise-partial-products"><img src="/public/images/product.svg" class="payxnowandrestondelivery-hide-hover" alt="product-icon"><img src="/public/images/product-yellow.svg" class="payxnowandrestondelivery-on-hover" alt="product-icon">
                                Bulk Enable Partial Payment</a></li>
                        <li><a onclick='abc(event);' class="<?php echo ($page_name == 'partial-products-list') ? 'payxnowandrestondelivery-active' : '' ?> " href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/partial-products-list"><img src="/public/images/partial-prod.svg" class="payxnowandrestondelivery-hide-hover" alt="partial-prod-icon"><img src="/public/images/partial-product-yellow.svg" class="payxnowandrestondelivery-on-hover" alt="partial-prod-icon">
                                Partial Products List</a></li>
                        <!-- <li><a onclick='abc(event);' class="<?php echo ($page_name == 'show-orders') ? 'payxnowandrestondelivery-active' : '' ?> " href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/show-orders"><img src="/public/images/orders.svg" class="payxnowandrestondelivery-hide-hover" alt="orders-icon"><img src="/public/images/order-yellow.svg" class="payxnowandrestondelivery-on-hover" alt="orders-icon">
                                Orders</a></li> -->
                        <li><a onclick='abc(event);' class="<?php echo ($page_name == 'price-plan') ? 'payxnowandrestondelivery-active' : '' ?> " href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/price-plan"><img src="/public/images/pricing.svg" class="payxnowandrestondelivery-hide-hover" alt="pricing-icon"><img src="/public/images/pricing-yellow.svg" class="payxnowandrestondelivery-on-hover" alt="pricing-icon">
                                Pricing</a></li>
                        <!-- <li><a onclick='abc(event);' class="<?php echo ($page_name == 'shiprocket-config') ? 'payxnowandrestondelivery-active' : '' ?> " href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/shopifypartialapp/public/index.php/shiprocket-config">Shiprocket Config</a></li> -->
                        <li><a onclick='abc(event);' class="<?php echo ($page_name == 'app-configuration') ? 'payxnowandrestondelivery-active' : '' ?> " href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/app-configuration"><img src="/public/images/configuration.svg" alt="configuration-icon" class="payxnowandrestondelivery-hide-hover"><img src="/public/images/configuration-yellow.svg" class="payxnowandrestondelivery-on-hover" alt="configuration-icon">Configuration</a></li>
                    </ul>
                </nav>
                <a href="javascript:void(0);" class="payxnowandrestondelivery-icon" onclick="myFunction()">
                    <i class="fa fa-bars payxnowandrestondelivery-bar-icon"></i>
                    <i class="fas fa-times payxnowandrestondelivery-cross"></i>
                </a>
            </div>
        </div>
    </header>