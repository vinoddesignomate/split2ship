<div class="payxnowandrestondelivery-body-wrapper">
    <!-- **********************************************
                        SECTION-1
    **************************************************** -->
    <section class="payxnowandrestondelivery-sec-space">

        <div class="payxnowandrestondelivery-container">
            <div class="payxnowandrestondelivery-main-head">
                <div class="alert-wrapper payxnowandrestondelivery-main-heading" style="border: 1px solid #de350a;">
                    <p class="payxnowandrestondelivery-alert" style="color: #de350a; font-size:20px">There is some maintenance going on, so if you're facing any issues please contact us</p>
                </div>    
            </div>   
        </div> 
        
        <div class="payxnowandrestondelivery-container">
            <div class="payxnowandrestondelivery-main-head">
                <div class="alert-wrapper payxnowandrestondelivery-main-heading">
                    <p class="payxnowandrestondelivery-alert">Since you have split2ship app installed, we recommend not to enable COD app</p>
                </div>

            </div>   
        </div>

        <!-- main-head -->
        <div class="payxnowandrestondelivery-container">
            <div class="payxnowandrestondelivery-main-head">
                <div class="payxnowandrestondelivery-main-heading">
                    <h1>Add Product</h1>
                </div>

            </div>
        </div>
        <!-- main-head ends -->

        <!-- main area -->
        <div class="payxnowandrestondelivery-container">
            <div class="payxnowandrestondelivery-main-area payxnowandrestondelivery-no-sidebar">
                <form method="POST">
                    <div class="payxnowandrestondelivery-inner-wrapper">
                        <div class="payxnowandrestondelivery-side-bar-col">
                            <h2>Pick Collection</h2>
                            <div class="payxnowandrestondelivery-custom-select mobile-center">
                                <select style="display:block;" class="colidchk" required id="get_coll_home" name="get_coll">
                                    <option value="0">Select Collection...</option>
                                    <?php foreach ($get_store_collections as $get_collections) { ?>

                                        <option <?php if (isset($_GET['collectionparms']) && $_GET['collectionparms'] == $get_collections->collection_id) { ?> selected <?php } ?> value="<?php echo esc($get_collections->collection_id); ?>"><?php echo esc($get_collections->collections_name); ?></option>

                                    <?php } ?>

                                </select>
                                <div class="search-wrapper">
                                    <form class="custom-search" action="" method="post">
                                        <input type="text" placeholder="Search.." class="srchtctval" name="search_text" value="<?php echo (isset($searctxt) ? $searctxt : ''); ?>">
                                        <button type="submit" name="search_query"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="payxnowandrestondelivery-main-data-col">
                            <div class="payxnowandrestondelivery-head-wrapper">
                                <h2>Product name</h2>
                                <?php if ($checkcol == 'yes') { ?>
                                    <button type="submit" class="payxnowandrestondelivery-button payxnowandrestondelivery-main-cta" name="assign_save" value="save" id="load_page" class="payxnowandrestondelivery-btn-with-bg">+ &nbsp; Add Partial Payment</button>
                                <?php } ?>
                            </div>
                            <?php if ($checkcol == 'yes') { ?>
                                <div class="payxnowandrestondelivery-table-outer-wrapper">
                                    <table>
                                        <tr>
                                            <th class="payxnowandrestondelivery-flex-row"><input id="checkAll" type="checkbox">&nbsp; All</th>
                                            <th>Product ID</th>
                                            <th>Product Name</th>
                                            <th>Partially Added Status</th>
                                        </tr>
                                        <tbody id="product-list">
                                            <?php

                                            if (!empty($products)) {
                                                foreach ($products as $edge) {
                                                    foreach ($edge as $value) {
                                                        if (isset($value['node'])) {
                                                            $prodctid = str_replace("gid://shopify/Product/", "", $value['node']['id']);
                                                            if (!in_array($prodctid, $get_part_list)) {
                                                                $partiall_added = "Not Added";
                                                                $cls = "payxnowandrestondelivery-text-red";
                                                            } else {
                                                                $partiall_added = "Added";
                                                                $cls = "payxnowandrestondelivery-text-green";
                                                            }
                                            ?>
                                                            <tr>
                                                                <td><input class="payxnowandrestondelivery-chkSelect" type="checkbox" type="checkbox" name="assign_pro[]" value="<?php echo esc($prodctid); ?>"></td>
                                                                <td> <?php echo esc($prodctid); ?></td>
                                                                <td> <?php echo esc($value['node']['title']); ?></td>
                                                                <td class="<?php echo $cls; ?>"><?php echo esc($partiall_added); ?></td>

                                                            </tr>
                                            <?php

                                                        }
                                                    }
                                                }
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>


                                <?php

                                if (!empty($products)) {

                                    //if (isset($page_info)) {
                                    if (isset($pagenewxt)) {
                                ?>

                                        <div class="payxnowandrestondelivery-listButtonNext">

                                            <button type="button" data-info="" class="payxnowandrestondelivery-pag_btn" data-rel="previous" data-store="<?php echo $_GET['shop']; ?>">Previous</button>

                                            <button type="button" class="payxnowandrestondelivery-pag_btn" data-info="<?php echo esc($pagenewxt); ?>" data-rel="next" data-store="<?php echo esc($_GET['shop']); ?>">Next</button>

                                        </div>

                            <?php
                                    }
                                }
                            }
                            ?>
                            <div class="payxnowandrestondelivery-head-wrapper payxnowandrestondelivery-justify-end">
                                <!-- <h2>Product name</h2> -->
                                <?php if ($checkcol == 'yes') { ?>
                                    <button type="submit" class="payxnowandrestondelivery-button payxnowandrestondelivery-main-cta" name="assign_save" value="save" id="load_page" class="payxnowandrestondelivery-btn-with-bg">+ &nbsp; Add Partial Payment</button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- main area ends-->
    </section>
    <!-- **********************************************
                        SECTION-2
    **************************************************** -->
    <section class="payxnowandrestondelivery-sec-space">
        <!-- main-head -->
        <div class="payxnowandrestondelivery-container">
            <div class="payxnowandrestondelivery-main-head">
                <div class="payxnowandrestondelivery-main-heading">
                    <h1>Shipping Configuration</h1>
                    <?php
                    //echo $this->globetest;
                    //echo $myCommon->payxnow_decod_encode_info2(); 

                    ?>
                </div>

            </div>
        </div>
        <!-- main-head ends -->

        <!-- main area -->
        <div class="payxnowandrestondelivery-container">
            <div class="payxnowandrestondelivery-main-area">

                <form method="post" id="store_user_trk">
                    <span id="ermsg"></span>
                    <div class="payxnowandrestondelivery-inner-wrapper">
                        <div class="payxnowandrestondelivery-side-bar-col">
                            <h2>Delivery Partner </h2>
                            <?php
                            //echo"<pre>"; print_r($shiprocket_info); echo"</pre>";
                            ?>
                            <div class="payxnowandrestondelivery-custom-select mobile-center">
                                <select style="display:block;" required id="delivery_partner" name="delivery_partner">
                                    <option value="">Select Shipping Method...</option>
                                    <option <?php if (isset($shiprocket_info[0]->enable_shipping_type) && $shiprocket_info[0]->enable_shipping_type == 'ship_roc') { ?> selected <?php } ?> value="ship_roc">Shiprocket</option>
                                    <option <?php if (isset($shiprocket_info[0]->enable_shipping_type) && $shiprocket_info[0]->enable_shipping_type == 'delhivery') { ?> selected <?php } ?> value="delhivery">Delhivery</option>
                                    <option <?php if (isset($shiprocket_info[0]->enable_shipping_type) && $shiprocket_info[0]->enable_shipping_type == 'pickr') { ?> selected <?php } ?> value="pickr">Pickrr</option>

                                </select>
                            </div>
                            <div class="payxnowandrestondelivery-flex-row payxnowandrestondelivery-image-row">
                                <div><img src="/public/images/delhivery-img.webp" alt="delhivery-icon"></div>
                                <div><img src="/public/images/pickrr.webp" alt="pickrr-icon"></div>
                                <div><img src="/public/images/shiprocket.webp" alt="shiprocket-icon"></div>
                            </div>
                        </div>
                        <div class="payxnowandrestondelivery-main-data-col">
                            <div class="payxnowandrestondelivery-head-wrapper">
                                <h2 class="payxnowandrestondelivery-mobile-center">Delivery partner name</h2>

                            </div>
                            <div class="payxnowandrestondelivery-form-border">
                                <div class="payxnowandrestondelivery-form-wrapper">

                                    <div id="ship_roc">
                                        <div class="">
                                            <label for="">Email Address</label>
                                            <input type="email" id="ship_email" required name="ship_email" placeholder="abc@email.com" value="<?php echo isset($shiprocket_info[0]->email) ? $shiprocket_info[0]->email : ''; ?>">
                                        </div>
                                        <div class="payxnowandrestondelivery-password-row">
                                            <label for="">Password
                                            </label>

                                            <input type="text" name="ship_pwd" required id="ship_pwd" placeholder="Enter password" value="<?php echo isset($shiprocket_info[0]->password) ? $shiprocket_info[0]->password : ''; ?>">
                                        </div>
                                        <div class="">
                                            <label for="">Channel ID</label>
                                            <input type="text" id="ship_chnl_id" required name="ship_chnl_id" placeholder="Enter channel id" value="<?php echo isset($shiprocket_info[0]->channel_id) ? $shiprocket_info[0]->channel_id : ''; ?>">
                                        </div>
                                    </div>

                                    <div id="delhivery" style="display: none;">
                                        <div class="">
                                            <label for="">Token</label>
                                            <input type="text" id="ship_token_delh" required name="ship_token_del" value="<?php echo isset($shiprocket_info[0]->shp_token) ? $shiprocket_info[0]->shp_token : ''; ?>">
                                        </div>
                                        <div class="">
                                            <label for="">Pick Up Location</label>
                                            <input type="text" id="pick_up_location" required name="pick_up_location" value="<?php echo isset($shiprocket_info[0]->pickup_location) ? $shiprocket_info[0]->pickup_location : ''; ?>">
                                        </div>
                                    </div>

                                    <div id="pickr" style="display: none;">
                                        <div class="">
                                            <label for="">Token <span style="font-size: 11px;">(from pickrr panel)</span></label>
                                            <input type="text" id="ship_token" required name="ship_token" placeholder="Enter Token" value="<?php echo isset($shiprocket_info[0]->shp_token) ? $shiprocket_info[0]->shp_token : ''; ?>">
                                        </div>
                                        <div class="">
                                            <label for="">From name <span style="font-size: 11px;">(from pickrr panel)</span></label>
                                            <input type="text" id="pickrr_company" required name="pickrr_company" placeholder="Enter From Name" value="<?php echo isset($shiprocket_info[0]->pickrr_company) ? $shiprocket_info[0]->pickrr_company : ''; ?>">
                                        </div>
                                        <div class="">
                                            <label for="">From Phone <span style="font-size: 11px;">(from pickrr panel)</span></label>
                                            <input type="text" id="pickrr_phone" required name="pickrr_phone" placeholder="Enter From Phone" value="<?php echo isset($shiprocket_info[0]->pickrr_from_phone) ? $shiprocket_info[0]->pickrr_from_phone : ''; ?>">
                                        </div>
                                        <div class="">
                                            <label for="">From PinCode <span style="font-size: 11px;">(from pickrr panel)</span></label>
                                            <input type="text" id="pickrr_pincode" required name="pickrr_pincode" placeholder="Enter From PinCode" value="<?php echo isset($shiprocket_info[0]->pickrr_pincode) ? $shiprocket_info[0]->pickrr_pincode : ''; ?>">
                                        </div>
                                        <div class="">
                                            <label for="">Shipping from address <span style="font-size: 11px;">(from pickrr panel)</span></label>
                                            <input type="text" id="ship_from" required name="ship_from" placeholder="Shipping Address" value="<?php echo isset($shiprocket_info[0]->shipping_address) ? $shiprocket_info[0]->shipping_address : ''; ?>">
                                        </div>
                                    </div>

                                    <div class=" payxnowandrestondelivery-form-btn">
                                        <button type="submit" name="ship_method" value="save" class="payxnowandrestondelivery-button">Save</button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!-- main area ends-->
    </section>
    <!-- **********************************************
                        SECTION-3
    **************************************************** -->
    <section class="payxnowandrestondelivery-sec-space">
        <!-- main-head -->
        <div class="payxnowandrestondelivery-container">
            <div class="payxnowandrestondelivery-main-head">
                <div class="payxnowandrestondelivery-main-heading">
                    <h1>Order Summary</h1>

                </div>

            </div>
        </div>
        <!-- main-head ends -->

        <!-- main area -->
        <div class="payxnowandrestondelivery-container">
            <div class="payxnowandrestondelivery-main-area payxnowandrestondelivery-no-sidebar">
                <div class="payxnowandrestondelivery-inner-wrapper">
                    <div class="payxnowandrestondelivery-main-data-col">
                        <div class="payxnowandrestondelivery-table-outer-wrapper">
                            <table>
                                <tr>

                                    <th>Customer</th>
                                    <th>Pending Amount</th>
                                    <th>Total Amount</th>
                                </tr>

                                <?php

                                if (!empty($order_list)) {
                                    foreach ($order_list as $get_all_products) {



                                        if (trim($get_all_products->order_status) == 'pending') {
                                            $chkedsts = "";
                                        } else {
                                            $chkedsts = "checked";
                                        }

                                        if ($get_all_products->sync_order == 1) {
                                            $chkedsts1 = "checked";
                                        } else {
                                            $chkedsts1 = "";
                                        }

                                ?>
                                        <tr>

                                            <td><?php echo esc($myCommon->payxnow_decodedata($get_all_products->f_name) . ' ' . $myCommon->payxnow_decodedata($get_all_products->l_name)); ?></td>
                                            <td class="payxnowandrestondelivery-amount-bg"><span><?php echo esc($get_all_products->pending_amount . ' ' . $get_all_products->order_ccy); ?></span></td>
                                            <td class="payxnowandrestondelivery-amount-bg"><span><?php echo esc($get_all_products->total_price . ' ' . $get_all_products->order_ccy); ?></span></td>

                                        </tr>

                                <?php }
                                } ?>
                            </table>
                        </div>
                        <?php
                        $shop_name = explode(".", $_GET['shop']);
                        $store_namep = $shop_name[0];
                        ?>
                        <div class="payxnowandrestondelivery-btn-col">
                            <a onclick='abc(event);' href="https://admin.shopify.com/store/<?php echo esc($store_namep) ?>/apps/pay-x-now-rest-on-delivery/show-orders" class="payxnowandrestondelivery-button">View More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main area ends-->
    </section>
    <!-- **********************************************
                        SECTION-4
    **************************************************** -->
    <section class="payxnowandrestondelivery-sec-space">
        <!-- main-head -->
        <div class="payxnowandrestondelivery-container">
            <div class="payxnowandrestondelivery-main-head">
                <div class="payxnowandrestondelivery-main-heading">
                    <h1>Upgrade</h1>
                </div>

            </div>
        </div>
        <!-- main-head ends -->
        <?php
        $shop_name = explode(".", $_GET['shop']);
        $store_name = $shop_name[0];

        ?>
        <!-- main area -->
        <div class="payxnowandrestondelivery-container">
            <div class="payxnowandrestondelivery-main-area payxnowandrestondelivery-pricing-sec">
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
                            <?php if (isset($plan_details[0]->plan_name) && ($plan_details[0]->plan_name == 'basic' && $plan_details[0]->updated_sync_orders_count != 0 && $plan_details[0]->plan_validity >= date('Y-m-d'))) { ?>
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
                            <?php if (isset($plan_details[0]->plan_name) && ($plan_details[0]->plan_name == 'advanced' && $plan_details[0]->updated_sync_orders_count != 0 && $plan_details[0]->plan_validity >= date('Y-m-d'))) { ?>
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
                            <?php if (isset($plan_details[0]->plan_name) && ($plan_details[0]->plan_name == 'pro' && $plan_details[0]->updated_sync_orders_count != 0 && $plan_details[0]->plan_validity >= date('Y-m-d'))) { ?>
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
                            <?php if (isset($plan_details[0]->plan_name) && ($plan_details[0]->plan_name == 'ultimate' && $plan_details[0]->updated_sync_orders_count != 0 && $plan_details[0]->plan_validity >= date('Y-m-d'))) { ?>
                                <a href="javascript:void(0);" class="payxnowandrestondelivery-button">Active</a>
                            <?php } else { ?>
                                <a onclick='abc(event);' href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/subscribe-app?plan=ultimate" class="payxnowandrestondelivery-button">Buy</a>
                            <?php } ?>
                        </div>
                    </div>


                </div>
            </div>
        </div>
</div>
<script>
    var ship_provder = '<?php echo $ship_provider; ?>';
</script>