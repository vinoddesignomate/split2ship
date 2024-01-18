<style>
    .payxnowandrestondelivery-zip-flex-row {
        display: flex;
        width: 100%;
        justify-content: space-between;
        gap: 39px;
        flex-wrap: wrap;
    }

    .payxnowandrestondelivery-zip-flex-row>div {
        flex: 1;
    }

    .postal-btn {
        margin-bottom: 10px;
        background-color: #28a745;
        color: #fff;
        padding: 5px 26px;
        margin-right: 10px;
    }

    .postal-btn:hover {
        background-color: #3b3b3b;
    }

    @media only screen and (max-width: 767px) {
        .payxnowandrestondelivery-zip-flex-row {
            display: block;
        }
    }
</style>

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

    /***************config popup css start */


    #popup_config {
        max-width: 650px;
    }

    #popup_config .popup-content {
        max-width: 650px;
        padding: 30px;
        border-radius: 0;
        border-left: 8px solid #1760A5;
        border-right: 8px solid #10277cde;
        border-top: 8px solid #1760A5;
        border-bottom: 8px solid #10277cde;
    }

    #popup_config .payxnowandrestondelivery-close-popup-btn {
        border-radius: 0 !important;
        color: #ffffffe0;
        right: 7px;
    }

    #popup_config .popup-content p {
        font-size: 19px;
        color: #000c;
        line-height: 1.4;
    }

    #popup_config .popup-content p a {
        color: #1760a5;
        text-decoration: underline;
    }

    .closeButtonCg {
        width: 100%;
        margin-top: 30px;
        display: block;
        text-align: center;
    }

    .closeButtonCg a {
        display: inline-block;
        background: #1760A5;
        color: #fff;
        border: nne;
        transition: all .4s ease-in-out;
        padding: 10px 30px;
    }

    .closeButtonCg a:hover {
        background: #10277cde
    }

    @media screen and (max-width:767px) {
        #popup_config .popup-content {
            padding: 25px;
        }
    }

    /************config popup css end*/

    @media screen and (max-width:610px) {
        .payxnowandrestondelivery-close-popup-btn {
            right: 12px
        }
    }
</style>
<?php
$shop_name = explode(".", $_GET['shop']);
$store_namecnf = $shop_name[0];
?>
<div id="popup" class="popup-container">
    <div class="popup-content">
        <!-- <h2>Hello, this is a message!</h2> -->
        <p id="plmsg"></p>
        <button class="payxnowandrestondelivery-close-popup-btn" onclick="hidePopup()">X</button>
    </div>
</div>

<div id="popup_config" class="popup-container config_popup">
    <div class="popup-content">
        <!-- <h2>Hello, this is a message!</h2> -->
        <p id="plmsg_config">Please visit the <a onclick="abc(event);" href="https://admin.shopify.com/store/<?php echo esc($store_namecnf); ?>/apps/pay-x-now-rest-on-delivery/app-configuration">configuration settings</a> page first to review the installation instructions for the app. Alternatively, you can reach out to us via WhatsApp at <a onclick="abc(event);" href="tel:+919354200590">9354200590</a>, or send us an email at <a onclick="abc(event);" href="mailto:saurabh@cgcolors.com">saurabh@cgcolors.com</a>. <br /><br />Our Shopify expert will then proceed to install and configure the app on your store. This process typically takes no more than 30 minutes.</p>
        <div class="closeButtonCg"><a onclick="abc(event);" href="https://admin.shopify.com/store/<?php echo esc($store_namecnf); ?>/apps/pay-x-now-rest-on-delivery/app-configuration">Close</a></div>
        <!-- <button class="payxnowandrestondelivery-close-popup-btn" onclick="config_hidePopup()">X</button> -->
    </div>
</div>

<div id="package_expire" class="popup-container config_popup" style="display: none;">
    <div class="popup-content">
        <!-- <h2>Hello, this is a message!</h2> -->
        <p id="package_expire_config">You have reached of your orders limit, Please upgrade your plan.</p>
        <div class="closeButtonCg"><a onclick="abc(event);" href="https://admin.shopify.com/store/<?php echo esc($store_namecnf); ?>/apps/pay-x-now-rest-on-delivery/price-plan">Upgrade</a></div>
    </div>
</div>


<div id="popup_config_update_app" class="popup-container config_popup" style="display: none;">
    <div class="popup-content">
        <!-- <h2>Hello, this is a message!</h2> -->
        <p id="plmsg_config">Please update app for new feature</p>
        <div class="closeButtonCg"><a onclick="abc(event);" href="https://app.payxnowandrestondelivery.com/public/install?shop=<?php echo esc($_GET['shop']); ?>">Update Now</a></div>
        <!-- <button class="payxnowandrestondelivery-close-popup-btn" onclick="config_hidePopup()">X</button> -->
    </div>
</div>

<div class="payxnowandrestondelivery-body-wrapper">
    <!-- **********************************************
                        SECTION-1
    **************************************************** -->
    <section class="payxnowandrestondelivery-sec-space">

        <!--<div class="payxnowandrestondelivery-container">
            <div class="payxnowandrestondelivery-main-head">
                <div class="alert-wrapper payxnowandrestondelivery-main-heading" style="border: 1px solid #de350a;">
                    <p class="payxnowandrestondelivery-alert" style="color: #de350a; font-size:20px">There is some maintenance going on, so if you're facing any issues please contact us on :- 9354200590</p>
                </div>
            </div>
        </div>-->

        <!-- <div class="payxnowandrestondelivery-container">
            <div class="payxnowandrestondelivery-main-head">
                <div class="alert-wrapper payxnowandrestondelivery-main-heading">
                    <p class="payxnowandrestondelivery-alert">Since you have split2ship app installed, we recommend not to enable COD app</p>
                </div>

            </div>
        </div> -->
        <div class="payxnowandrestondelivery-main-area text-center payxnowandrestondelivery-maintext">
            <p>Please make sure you go to configuration settings page first to check out to follow how to install the app instructions or you can drop us a whatsapp message - <a href="tel:9354200590" class="text-orange">9354200590</a> else send us an email to <a href="mailto: saurabh@cgcolors.com" class="text-orange">saurabh@cgcolors.com</a>. Our Shopify expert will install and configure the app on your store. This process does not take more than 30 minutes</p>
        </div>
        <?php if ($get_details_store->show_config_popup == '0') {
        ?>

            <script type="text/javascript">
                //show_popup_config();

                // var popup = document.getElementById("popup_config");
                // popup.style.display = "block";
                // var body = document.body;
                // body.classList.add("package_popup_visible");
            </script>
        <?php }


        if ($get_details_store->update_app == '0') {
        ?>

            <script type="text/javascript">
                //show_popup_config();

                var popup = document.getElementById("popup_config_update_app");
                popup.style.display = "block";
                var body = document.body;
                body.classList.add("package_popup_visible");
            </script>
        <?php }
        if ($get_details_store->force_update == '0') {
        ?>

            <script type="text/javascript">
                //show_popup_config();

                var popup = document.getElementById("popup_config_update_app");
                popup.style.display = "block";
                var body = document.body;
                body.classList.add("package_popup_visible");
            </script>

        <?php  }

        if ($show_package_popup == 'yes') {
        ?>

            <script type="text/javascript">
                var popup = document.getElementById("package_expire");
                popup.style.display = "block";
                var body = document.body;
                body.classList.add("package_popup_visible");
            </script>
        <?php } ?>

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
                                                                $partiall_added2 = "not_added";
                                                                $cls = "payxnowandrestondelivery-text-red";
                                                            } else {
                                                                $partiall_added = "Added";
                                                                $partiall_added2 = "added";
                                                                $cls = "payxnowandrestondelivery-text-green";
                                                            }
                                            ?>
                                                            <tr>
                                                                <td><input class="payxnowandrestondelivery-chkSelect" dattatrr="<?php echo esc($partiall_added2); ?>" type="checkbox" type="checkbox" name="assign_pro[]" value="<?php echo esc($prodctid); ?>"></td>
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
    <!--<section class="payxnowandrestondelivery-sec-space">
       
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
       
        <div class="payxnowandrestondelivery-container">
            <div class="payxnowandrestondelivery-main-area">

                <form method="post" id="store_user_trk">

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
                                    <span style="font-weight: bold;" id="ermsg"></span>
                                    <div id="ship_roc">
                                        <div>Please create a API user in shiprocket panel <a target="_blank" style="font-weight: bold;color: blue;" onclick='new_window_opensplit2ship(event);' href="https://app.shiprocket.in/api-user">from here</a>, and add those details here.</div>
                                        <div class="">
                                            <label for="">Email Address</label>
                                            <input type="email" id="ship_email" required name="ship_email" placeholder="abc@email.com" value="<?php echo isset($shiprocket_info[0]->email) ? $shiprocket_info[0]->email : ''; ?>">
                                        </div>
                                        <div class="payxnowandrestondelivery-password-row">
                                            <label for="">Password
                                            </label>

                                            <input type="password" name="ship_pwd" required id="ship_pwd" placeholder="Enter password" value="<?php echo isset($shiprocket_info[0]->password) ? $shiprocket_info[0]->password : ''; ?>">
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
       
    </section>-->


    <section class="payxnowandrestondelivery-sec-space">
        <div class="payxnowandrestondelivery-container">
            <div class="payxnowandrestondelivery-main-head">
                <div class="payxnowandrestondelivery-main-heading">
                    <h1>Patial payment by Postal codes</h1>

                </div>

            </div>
        </div>
        <div class="payxnowandrestondelivery-container">
            <div class="payxnowandrestondelivery-main-area payxnowandrestondelivery-no-sidebar payxnowandrestondelivery-single-page">
                <div class="payxnowandrestondelivery-head-wrapper">
                    <h2 class="">Upload Zip Codes</h2>
                    <p><input type="checkbox" name="zip_en_dis" <?php if ($get_details->zip_code_enable_disabled == 1) { ?> checked <?php } ?> style="float: left;width: 1%;">Enable Partial payment by postal code</p>
                </div>
                <?php if ($get_details->zip_code_enable_disabled == 0) { ?>
                    <div id="zipc_en_dis" class="edit-form-wrapper" style="display: none;">
                    <?php } else { ?>
                        <div id="zipc_en_dis" class="edit-form-wrapper">
                        <?php } ?>
                        <form id="zipcsvform" enctype="multipart/form-data">
                            <input type="hidden" name="shop" value="<?php echo $_GET['shop'] ?>" />
                            <div class="flex-row">
                                <label for="">Upload Non serviceable postal codes</label>
                                <?php if (!empty($get_allzip)) { ?>
                                    <a id="clickfile" onclick='abc(event);' href="https://app.payxnowandrestondelivery.com/exporcsv?shop=<?php echo $_GET['shop']; ?>" class="postal-btn">Export All</a>
                                <?php } ?>
                                <span id="export_id" style="display: none;"></span>
                                <a onclick='abc(event);' href="https://app.payxnowandrestondelivery.com/samplfcsv?shop=<?php echo $_GET['shop']; ?>" class="postal-btn">Sample CSV</a>
                                <input type="file" required name="zip_code" accept=".csv">
                            </div>
                            <div class="btn-row">
                                <button type="submit" name="upload_zip" class="payxnowandrestondelivery-button payxnowandrestondelivery-main-cta" value="submit">Submit</button>

                            </div>
                            <span id="filmsg"></span>

                        </form>
                        </div>
                    </div>
            </div>
            <section>


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
                                        <?php
                                        if ($get_details_store->total_sync_store_products <= 200) {
                                            if (isset($plan_details[0]->plan_name) && ($plan_details[0]->plan_name == 'basic' && $plan_details[0]->plan_status == 'active')) { ?>
                                                <a href="javascript:void(0);" class="payxnowandrestondelivery-button">Active</a>
                                            <?php } else { ?>
                                                <a onclick='abc(event);' href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/subscribe-app?plan=basic" class="payxnowandrestondelivery-button">Buy</a>
                                            <?php }
                                        } else { ?>
                                            <a href="javascript:void(0);" onclick="showPopup('basic')" class="payxnowandrestondelivery-button">Buy</a>
                                        <?php  } ?>
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
                                            if (isset($plan_details[0]->plan_name) && ($plan_details[0]->plan_name == 'advanced' && $plan_details[0]->plan_status == 'active')) { ?>
                                                <a href="javascript:void(0);" class="payxnowandrestondelivery-button">Active</a>

                                            <?php } else { ?>
                                                <a onclick='abc(event);' href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/subscribe-app?plan=advanced" class="payxnowandrestondelivery-button">Buy</a>
                                            <?php }
                                        } else { ?>
                                            <a href="javascript:void(0);" onclick="showPopup('advanced')" class="payxnowandrestondelivery-button">Buy</a>
                                        <?php  } ?>

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
                                            if (isset($plan_details[0]->plan_name) && ($plan_details[0]->plan_name == 'pro' && $plan_details[0]->plan_status == 'active')) { ?>
                                                <a href="javascript:void(0);" class="payxnowandrestondelivery-button">Active</a>
                                            <?php } else { ?>
                                                <a onclick='abc(event);' href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/subscribe-app?plan=pro" class="payxnowandrestondelivery-button">Buy</a>
                                            <?php }
                                        } else { ?>
                                            <a href="javascript:void(0);" onclick="showPopup('pro')" class="payxnowandrestondelivery-button">Buy</a>
                                        <?php  } ?>
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
        </div>
        <script>
            var radioButtons = document.querySelectorAll('input[name="zip_en_dis"]');
            radioButtons.forEach(function(radioButton) {
                radioButton.addEventListener('change', function(event) {
                    var enblvar = 0;
                    if (radioButton.checked) {
                        $("#zipc_en_dis").show();
                        enblvar = 1;
                    } else {
                        $("#zipc_en_dis").hide();
                        enblvar = 0;
                    }
                    var shopname = '<?php echo esc($_GET['shop']); ?>';
                    $.ajax({
                        type: "POST",
                        url: "enablezipprocess",
                        data: 'shop=' + shopname + '&enblvar=' + enblvar,
                        success: function(response) {

                        }

                    });
                });
            });
            var ship_provder = '<?php echo $ship_provider; ?>';
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

            function show_popup_config() {
                var popup = document.getElementById("popup");
                popup.style.display = "block";
                var body = document.body;
                body.classList.add("package_popup_visible");
                $("#plmsg").html('Please make sure you go to configuration settings page first to check out to follow how to install the app instructions or you can drop us a whatsapp message - 9354200590 else send us an email to saurabh@cgcolors.com. Our Shopify expert will install and configure the app on your store. This process does not take more than 30 minutes');

            }

            // Function to hide the popup
            function hidePopup() {
                var popup = document.getElementById("popup");
                popup.style.display = "none";
                var body = document.body;
                // Remove the class from the body element
                body.classList.remove("package_popup_visible");
            }

            function config_hidePopup() {
                var popup = document.getElementById("popup_config");
                popup.style.display = "none";
                var body = document.body;
                // Remove the class from the body element
                body.classList.remove("package_popup_visible");
            }
        </script>