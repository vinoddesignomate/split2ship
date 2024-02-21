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

        // Function to navigate to another page
        function navigateToPage(pageUrl) {
            const Redirect = actions.Redirect;
            const redirect = Redirect.create(app);
            redirect.dispatch(Redirect.Action.REMOTE, {
                url: pageUrl
            });
        }
        // // Example event listener for a button click
        // document.getElementById('myButton').addEventListener('click', function() {
        //     // Replace 'pageUrl' with the actual URL of the page you want to navigate to
        //     navigateToPage('https://www.example.com/another-page');
        // });
    </script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/656785f9e8301d47ec57f032/1hge66mc8';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();

        function openTawkChat() {
            Tawk_API.toggle();
        }
    </script>
    <!--End of Tawk.to Script-->

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
        <div class="relativeLoaderCG56" style="display: none;">
            <div class="loaderCgApp4"></div>
        </div>
        <div class="payxnowandrestondelivery-container">
            <div class="payxnowandrestondelivery-header-wrapper">
                <div class="payxnowandrestondelivery-logo-col">
                    <a onclick='navigateToPage("https://admin.shopify.com/store/<?php echo htmlspecialchars($store_name); ?>/apps/pay-x-now-rest-on-delivery/");' href="javascript:void();"><img src="/public/images/site-logo.svg" alt="site-logo"></a>
                </div>
                <nav class="payxnowandrestondelivery-header-nav-links">
                    <ul>

                        <!-- <li><a onclick='navigateToPage("https://admin.shopify.com/store/<?php echo htmlspecialchars($store_name); ?>/apps/pay-x-now-rest-on-delivery/products-list");' class="<?php echo ($page_name == 'products-list') ? 'payxnowandrestondelivery-active' : '' ?> " href="javascript:void();">
                                <img src="/public/images/product.svg" class="payxnowandrestondelivery-hide-hover" alt="product-icon">
                                <img src="/public/images/product-yellow.svg" class="payxnowandrestondelivery-on-hover" alt="product-icon">
                                Products
                            </a>
                        </li>


                        <li><a onclick='navigateToPage("https://admin.shopify.com/store/<?php echo htmlspecialchars($store_name); ?>/apps/pay-x-now-rest-on-delivery/collection-wise-partial-products");' class="<?php echo ($page_name == 'collection-wise-partial-products') ? 'payxnowandrestondelivery-active' : '' ?> " href="javascript:void();"><img src="/public/images/product.svg" class="payxnowandrestondelivery-hide-hover" alt="product-icon"><img src="/public/images/product-yellow.svg" class="payxnowandrestondelivery-on-hover" alt="product-icon">
                                Bulk Enable Partial Payment</a></li>
                        <li><a onclick='navigateToPage("https://admin.shopify.com/store/<?php echo htmlspecialchars($store_name); ?>/apps/pay-x-now-rest-on-delivery/partial-products-list");' class="<?php echo ($page_name == 'partial-products-list') ? 'payxnowandrestondelivery-active' : '' ?> " href="javascript:void();"><img src="/public/images/partial-prod.svg" class="payxnowandrestondelivery-hide-hover" alt="partial-prod-icon"><img src="/public/images/partial-product-yellow.svg" class="payxnowandrestondelivery-on-hover" alt="partial-prod-icon">
                                Partial Products List</a></li>-->

                        <li><a onclick='navigateToPage("https://admin.shopify.com/store/<?php echo htmlspecialchars($store_name); ?>/apps/pay-x-now-rest-on-delivery");' class="<?php echo ($page_name == 'partial-products-list') ? 'payxnowandrestondelivery-active' : '' ?>" href="javascript:void();"><img src="/public/images/product.svg" class="payxnowandrestondelivery-hide-hover" alt="product-icon">
                                <img src="/public/images/product-yellow.svg" class="payxnowandrestondelivery-on-hover" alt="product-icon">Products</a></li>

                        <li><a onclick='navigateToPage("https://admin.shopify.com/store/<?php echo htmlspecialchars($store_name); ?>/apps/pay-x-now-rest-on-delivery/price-plan");' class="<?php echo ($page_name == 'price-plan') ? 'payxnowandrestondelivery-active' : '' ?> " href="javascript:void();"><img src="/public/images/pricing.svg" class="payxnowandrestondelivery-hide-hover" alt="pricing-icon"><img src="/public/images/pricing-yellow.svg" class="payxnowandrestondelivery-on-hover" alt="pricing-icon">
                                Pricing</a></li>

                        <li><a onclick='navigateToPage("https://admin.shopify.com/store/<?php echo htmlspecialchars($store_name); ?>/apps/pay-x-now-rest-on-delivery/app-tutorials");' class="<?php echo ($page_name == 'app-tutorials') ? 'payxnowandrestondelivery-active' : '' ?> " href="javascript:void();"><img src="/public/images/partial-prod.svg" class="payxnowandrestondelivery-hide-hover" alt="partial-prod-icon"><img src="/public/images/partial-product-yellow.svg" class="payxnowandrestondelivery-on-hover" alt="partial-prod-icon"> Tutorials</a></li>

                        <li><a onclick='navigateToPage("https://admin.shopify.com/store/<?php echo htmlspecialchars($store_name); ?>/apps/pay-x-now-rest-on-delivery/app-configuration");' class="<?php echo ($page_name == 'app-configuration') ? 'payxnowandrestondelivery-active' : '' ?> " href="javascript:void();"><img src="/public/images/configuration.svg" alt="configuration-icon" class="payxnowandrestondelivery-hide-hover"><img src="/public/images/configuration-yellow.svg" class="payxnowandrestondelivery-on-hover" alt="configuration-icon">Configuration</a></li>


                    </ul>
                </nav>
                <a href="javascript:void(0);" class="payxnowandrestondelivery-icon" onclick="myFunction()">
                    <i class="fa fa-bars payxnowandrestondelivery-bar-icon"></i>
                    <i class="fas fa-times payxnowandrestondelivery-cross"></i>
                </a>
            </div>
        </div>
    </header>