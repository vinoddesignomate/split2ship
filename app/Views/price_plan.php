<?php
$shop_name = explode(".", $_GET['shop']);
$store_name = $shop_name[0];

// echo "aaa<pre>";
//             print_r($plan_details);
//             echo "</pre>";
?>
<!-- main-head -->
<div class="payxnowandrestondelivery-container">

    <div class="payxnowandrestondelivery-main-heading payxnowandrestondelivery-back-heading">
        <h5> <a onclick='abc(event);' href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/">Back</h5></a>
    </div>


</div>
<!-- main-head ends -->
<!-- main area -->
<style>
    /* Styling for the popup container */
    body.price-plan.package_popup_visible {
        overflow-y: hidden;
        position: relative;
    }

    .popup-container {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        width: 100%;
        height: auto;
        max-width: 400px;
        transform: translate(-50%, -50%);
        align-items: center;
        justify-content: center;
        z-index: 999;
        padding: 0px 15px;

    }

    /* Styling for the popup content */
    .popup-content p {
        font-size: 18px;
        line-height: 130%;
    }

    .popup-content {

        text-align: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        padding: 50px 20px;
        border-radius: 5px;
        max-width: 400px;
    }

    .payxnowandrestondelivery-close-popup-btn {
        position: absolute;
        top: -7px;
        right: 0px;
        background-color: #10277c;
        color: #fff;
        border-radius: 50%;
        width: 25px;
        height: 25px;
    }

    body.package_popup_visible:after {
        content: '';
        position: fixed;
        background-color: #0000008a;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 111;
    }

    .payxnowandrestondelivery-pricing-btn a.payxnowandrestondelivery-button {
        margin-bottom: 13px;
    }

    @media screen and (max-width:610px) {
        .payxnowandrestondelivery-close-popup-btn {
            right: 12px
        }
    }
</style>
<?php

// if ($_SERVER['HTTP_X_FORWARDED_FOR'] == '103.80.119.106') {
//     echo "get_details_store<pre>";
//     print_r($get_details_store);
//     echo "</pre>";
// }
?>
<div id="popup" class="popup-container">
    <div class="popup-content">
        <!-- <h2>Hello, this is a message!</h2> -->
        <p id="plmsg"></p>
        <button class="payxnowandrestondelivery-close-popup-btn" onclick="hidePopup()">X</button>
    </div>
</div>

<div class="payxnowandrestondelivery-container">
    <div class="payxnowandrestondelivery-main-area">
        <div class="payxnowandrestondelivery-head-wrapper">
            <h2>Pricing</h2>

        </div>
        <div class="payxnowandrestondelivery-inner-wrapper payxnowandrestondelivery-pricing-row">
            <div class="payxnowandrestondelivery-pricing-col">
                <ul class="payxnowandrestondelivery-pricing-inner-wrapper">

                    <h4 class="payxnowandrestondelivery-pink-bg">Basic</h4>
                    <li>
                        <h3 class="payxnowandrestondelivery-text-violet">Free</h3>
                    </li>
                    <li>
                        <p>200 products partial add</p>
                    </li>
                    <li>
                        <p>20 orders sync</p>
                    </li>
                    <li>
                        <p>Integration with all shipping</p>
                    </li>
                    <li>
                        <p>Offer partial payment on upto 200 products</p>
                    </li>
                    <br><br><br>

                </ul>
                <div class="payxnowandrestondelivery-pricing-btn">


                    <?php
                    if ($get_details_store->total_sync_store_products <= 200) {
                        $showplan = "<a onclick='abc(event);' href='https://admin.shopify.com/store/" . esc($store_name) . "/apps/pay-x-now-rest-on-delivery/subscribe-app?plan=basic' class='payxnowandrestondelivery-button'>Buy</a>";
                    } else {
                        $showplan = "<a href='javascript:void(0);' onclick='showPopup('basic')' class='payxnowandrestondelivery-button'>Buy</a>";
                    }
                    if (isset($plan_details[0]->plan_name) && ($plan_details[0]->plan_name == 'basic' && $plan_details[0]->plan_status == 'active')) { ?>
                        <a href="javascript:void(0);" class="payxnowandrestondelivery-button">Active</a>
                    <?php } else {

                        echo $showplan; ?>

                    <?php }
                    ?>
                </div>
            </div>
            <div class="payxnowandrestondelivery-pricing-col">
                <ul class="payxnowandrestondelivery-pricing-inner-wrapper">

                    <h4 class="payxnowandrestondelivery-blue-bg">Advanced</h4>
                    <li>
                        <h3><span class="payxnowandrestondelivery-text-small payxnowandrestondelivery-font-bold">$</span> <span class="payxnowandrestondelivery-text-violet">17.95</span> <span class="payxnowandrestondelivery-text-small">/ month</span></h3>
                    </li>
                    <li>
                        <p>2000 products partial add</p>
                    </li>
                    <li>
                        <p>200 order sync</p>
                    </li>
                    <li>
                        <p>Email Support</p>
                    </li>
                    <li>
                        <p>Integration with all shipping</p>
                    </li>
                    <li>
                        <p>Offer partial payment on upto 2000 products</p>
                    </li>

                </ul>
                <div class="payxnowandrestondelivery-pricing-btn">
                    <?php

                    if ($get_details_store->total_sync_store_products <= 2000) {
                        $showplan = "<a onclick='abc(event);' href='https://admin.shopify.com/store/" . esc($store_name) . "/apps/pay-x-now-rest-on-delivery/subscribe-app?plan=advanced' class='payxnowandrestondelivery-button'>Buy</a>";
                    } else {
                        $showplan = "<a href='javascript:void(0);' onclick='showPopup('advanced')' class='payxnowandrestondelivery-button'>Buy</a>";
                    }


                    if (isset($plan_details[0]->plan_name) && ($plan_details[0]->plan_name == 'advanced' && $plan_details[0]->plan_status == 'active')) { ?>
                        <a href="javascript:void(0);" class="payxnowandrestondelivery-button">Active</a>

                    <?php } else {
                        echo $showplan;
                    ?>
                        <!-- <a onclick='abc(event);' href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/subscribe-app?plan=advanced" class="payxnowandrestondelivery-button">Buy</a> -->
                    <?php }
                    ?>
                </div>
            </div>


            <div class="payxnowandrestondelivery-pricing-col">
                <ul class="payxnowandrestondelivery-pricing-inner-wrapper">

                    <h4 class="payxnowandrestondelivery-green-bg">Pro</h4>
                    <li>
                        <h3><span class="payxnowandrestondelivery-text-small payxnowandrestondelivery-font-bold">$</span> <span class="payxnowandrestondelivery-text-violet">30.95</span> <span class="payxnowandrestondelivery-text-small">/ month</span></h3>
                    </li>
                    <li>
                        <p>5000 products partial add</p>
                    </li>
                    <li>
                        <p>Unlimited orders sync</p>
                    </li>
                    <li>
                        <p>Premium Support</p>
                    </li>
                    <li>
                        <p>Integration with all shipping</p>
                    </li>
                    <li>
                        <p>Offer partial payment on upto 5000 products</p>
                    </li>

                </ul>
                <div class="payxnowandrestondelivery-pricing-btn">
                    <?php

                    if ($get_details_store->total_sync_store_products <= 5000) {
                        $showplan = "<a onclick='abc(event);' href='https://admin.shopify.com/store/" . esc($store_name) . "/apps/pay-x-now-rest-on-delivery/subscribe-app?plan=pro' class='payxnowandrestondelivery-button'>Buy</a>";
                    } else {
                        $showplan = "<a href='javascript:void(0);' onclick='showPopup('pro')' class='payxnowandrestondelivery-button'>Buy</a>";
                    }


                    if (isset($plan_details[0]->plan_name) && ($plan_details[0]->plan_name == 'pro' && $plan_details[0]->plan_status == 'active')) { ?>
                        <a href="javascript:void(0);" class="payxnowandrestondelivery-button">Active</a>
                    <?php } else {
                        echo $showplan;
                    ?>
                        <!-- <a onclick='abc(event);' href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/subscribe-app?plan=pro" class="payxnowandrestondelivery-button">Buy</a> -->
                    <?php }
                    ?>

                </div>
            </div>
            <div class="payxnowandrestondelivery-pricing-col">
                <ul class="payxnowandrestondelivery-pricing-inner-wrapper">

                    <h4 class="payxnowandrestondelivery-yellow-bg">Ultimate</h4>
                    <li>
                        <h3><span class="payxnowandrestondelivery-text-small payxnowandrestondelivery-font-bold">$</span> <span class="payxnowandrestondelivery-text-violet">60.95</span> <span class="payxnowandrestondelivery-text-small">/ month</span></h3>
                    </li>
                    <li>
                        <p>10000 products partial add</p>
                    </li>
                    <li>
                        <p>Unlimited orders sync</p>
                    </li>
                    <li>
                        <p>Premium Support</p>
                    </li>
                    <li>
                        <p>Integration with all shipping</p>
                    </li>
                    <li>
                        <p>Offer partial payment on upto 10000 products</p>
                    </li>

                </ul>
                <div class="payxnowandrestondelivery-pricing-btn">
                    <?php if (isset($plan_details[0]->plan_name) && ($plan_details[0]->plan_name == 'ultimate' && $plan_details[0]->plan_status == 'active')) { ?>

                        <a href="javascript:void(0);" class="payxnowandrestondelivery-button">Active</a>
                    <?php } else { ?>
                        <a onclick='abc(event);' href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/subscribe-app?plan=ultimate" class="payxnowandrestondelivery-button">Buy</a>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    var ship_provder = '';

    // Function to show the popup
    function showPopup(planename) {
        var popup = document.getElementById("popup");
        popup.style.display = "block";
        var body = document.body;
        body.classList.add("package_popup_visible");
        var plnmsg = "";
        if (planename === 'basic') {
            plnmsg = "You need to keep only 200 products in partial list for activating this plan.";
        } else if (planename === 'advanced') {
            plnmsg = "You need to keep only 2000 products in partial list for activating this plan.";
        } else if (planename === 'pro') {
            plnmsg = "You need to keep only 5000 products in partial list for activating this plan.";
        } else if (planename === 'ultimate') {
            plnmsg = "You need to keep only 10000 products in partial list for activating this plan.";
        }
        $("#plmsg").html(plnmsg);

    }

    // Function to hide the popup
    function hidePopup() {
        var popup = document.getElementById("popup");
        popup.style.display = "none";
        var body = document.body;
        // Remove the class from the body element
        body.classList.remove("package_popup_visible");
    }
</script>