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
                    <?php /*if (isset($plan_details[0]->plan_name) && ($plan_details[0]->plan_name == 'basic' && $plan_details[0]->updated_sync_orders_count != 0 && $plan_details[0]->plan_validity >= date('Y-m-d'))) { */?>

                    <?php if (isset($plan_details[0]->plan_name) && ($plan_details[0]->plan_name == 'basic' && $plan_details[0]->plan_validity >= date('Y-m-d'))) { ?>
                        <a href="javascript:void(0);" class="payxnowandrestondelivery-button">Active</a>
                    <?php } else { ?>
                        <a onclick='abc(event);' href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/subscribe-app?plan=basic" class="payxnowandrestondelivery-button">Buy</a>
                    <?php } ?>
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
                    <?php if (isset($plan_details[0]->plan_name) && ($plan_details[0]->plan_name == 'advanced' && $plan_details[0]->plan_validity >= date('Y-m-d'))) { ?>
                        <a href="javascript:void(0);" class="payxnowandrestondelivery-button">Active</a>

                    <?php } else { ?>
                        <a onclick='abc(event);' href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/subscribe-app?plan=advanced" class="payxnowandrestondelivery-button">Buy</a>
                    <?php } ?>
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
                    <?php if (isset($plan_details[0]->plan_name) && ($plan_details[0]->plan_name == 'pro' && $plan_details[0]->plan_validity >= date('Y-m-d'))) { ?>
                        <a href="javascript:void(0);" class="payxnowandrestondelivery-button">Active</a>
                    <?php } else { ?>
                        <a onclick='abc(event);' href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/subscribe-app?plan=pro" class="payxnowandrestondelivery-button">Buy</a>
                    <?php } ?>

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
                    <?php if (isset($plan_details[0]->plan_name) && ($plan_details[0]->plan_name == 'ultimate' && $plan_details[0]->plan_validity >= date('Y-m-d'))) { ?>
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
</script>