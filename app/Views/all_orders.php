<?php
$shop_name = explode(".", $_GET['shop']);
$store_namep = $shop_name[0];
?>
<!-- main-head -->
<div class="payxnowandrestondelivery-container">

    <div class="payxnowandrestondelivery-main-heading payxnowandrestondelivery-back-heading">
        <h5> <a onclick='abc(event);' href="https://admin.shopify.com/store/<?php echo esc($store_namep); ?>/apps/pay-x-now-rest-on-delivery/">Back</h5></a>
    </div>


</div>
<!-- main-head ends -->

<!-- main area -->
<div class="payxnowandrestondelivery-container">
    <div class="payxnowandrestondelivery-main-area payxnowandrestondelivery-no-sidebar payxnowandrestondelivery-single-page">
        <div class="payxnowandrestondelivery-inner-wrapper">
            <div class="payxnowandrestondelivery-main-data-col">
                <div class="payxnowandrestondelivery-table-heading">
                    <h2>Product name</h2>

                    <?php
                    if (isset($shiprocket_info[0]->enable_shipping_type) && $shiprocket_info[0]->enable_shipping_type == 'ship_roc') {
                        $type = 'ship';
                    } else  if (isset($shiprocket_info[0]->enable_shipping_type) && $shiprocket_info[0]->enable_shipping_type == 'pickr') {
                        $type = 'pickr';
                    } else  if (isset($shiprocket_info[0]->enable_shipping_type) && $shiprocket_info[0]->enable_shipping_type == 'delhivery') {
                        $type = 'delhivery';
                    }
                    if (!empty($shiprocket_info) && !empty($plan_details)) {
                        if (($plan_details[0]->updated_sync_orders_count != 0 && $plan_details[0]->plan_validity >= date('Y-m-d'))) {
                    ?>
                            <div class="rowSep">
                                <div class="rowSepCol12 btnM30 text-center-00">
                                    <a class="payxnowandrestondelivery-start_sync payxnowandrestondelivery-button payxnowandrestondelivery-main-cta" href="javascript:void(0);" id="load_page myBtn">Sync Orders </a>
                                    <div id="syncstartt"></div>
                                </div>
                                <!-- <div id="myModal">
                    <div class="modal-wrapper">
                        <ul>
                            <li><a href="">test</a></li>
                            <li><a href="">test</a></li>
                        </ul>
                    </div>
                </div> -->

                            </div>
                        <?php } else { ?>
                            <div class="payxnowandrestondelivery-container">
                                <div class="payxnowandrestondelivery-main-head">
                                    <div class="alert-wrapper payxnowandrestondelivery-main-heading">
                                        <p class="payxnowandrestondelivery-alert">Please Upgrade Your Plane.</p>
                                    </div>

                                </div>
                            </div>
                    <?php }
                    } ?>

                    <!-- <a href="#" class="button">Sync Order</a> -->
                </div>

                <div class="payxnowandrestondelivery-table-outer-wrapper">
                    <table>
                        <tr>
                            <!-- <th class="flex-row"><input type="checkbox">&nbsp; All</th> -->
                            <th>Order ID</th>
                            <th>Order Date</th>
                            <th>Customer</th>
                            <th>Pending Amount</th>
                            <th>Total Amount</th>
                            <!--<th>Status</th>-->
                            <th>Sync Status</th>
                            <th>Fullfill Status</th>
                        </tr>

                        <?php

                        if (!empty($order_list)) {
                            foreach ($order_list as $get_all_products) {

                                //echo"<pre>"; print_r($get_all_products); echo"</pre>";

                                if (trim($get_all_products->order_status) == 'pending') {
                                    $chkedsts = "";
                                } else {
                                    $chkedsts = "checked";
                                }

                                if ($get_all_products->sync_order == 1 && $type == 'ship') {
                                    $chkedsts1 = "<p style='color: #fff;background: #28a745!important;padding: 4px 19px;border-radius:50px;line-height: 140%;'>Synched</p>";
                                } elseif (!empty($get_all_products->ship_err) && $type == 'ship') {
                                    $getdata = unserialize($get_all_products->ship_err);
                                    if (!empty($getdata)) {
                                        $newchkmsg = "";
                                        foreach ($getdata as $key => $value) {
                                            //echo $value;
                                            foreach ($value as $getval) {

                                                if ($getval != "validation.present") {
                                                    $newchkmsg .= "<p style='color: #fff;background: red;padding: 4px;'>" . $getval . "</p>";
                                                }
                                            }
                                        }
                                    } else {
                                        $newchkmsg = "<p>Not Synched</p>";
                                    }
                                    $chkedsts1 = $newchkmsg;
                                } elseif ($get_all_products->pickrr_order_sync == 1 && $type == 'pickr') {
                                    $chkedsts1 = "<p style='color: #fff;background: #28a745!important;padding: 4px 19px;border-radius:50px;line-height: 140%;'>Synched</p>";
                                } elseif (!empty($get_all_products->pickrr_err && $type == 'pickr')) {
                                    $chkedsts1 = "<p style='color: #fff;background: red;padding: 4px;'>" . $get_all_products->pickrr_err . "</p>";
                                } else if ($get_all_products->delhi_very_sync == 1 && $type == 'delhivery') {
                                    $chkedsts1 = "<p style='color: #fff;background: #28a745!important;padding: 4px 19px;border-radius:50px;line-height: 140%;'>Synched</p>";
                                } elseif (!empty($get_all_products->delhivery_err && $type == 'delhivery')) {
                                    $chkedsts1 = "<p style='color: #fff;background: red;padding: 4px;'>" . $get_all_products->delhivery_err . "</p>";
                                } else {
                                    $chkedsts1 = "<p>Not Synched</p>";
                                }
                        ?>
                                <tr>
                                    <!-- <td class="flex-row"><input type="checkbox"></td> -->
                                    <td><?php echo esc($get_all_products->order_id); ?></td>
                                    <td><?php echo esc($get_all_products->order_date); ?></td>
                                    <td><?php echo esc($myCommon->payxnow_decodedata($get_all_products->f_name) . ' ' . $myCommon->payxnow_decodedata($get_all_products->l_name)); ?></td>
                                    <td class="payxnowandrestondelivery-amount-bg"><span><?php echo esc($get_all_products->pending_amount . ' ' . $get_all_products->order_ccy); ?></span></td>
                                    <td class="payxnowandrestondelivery-amount-bg"><span><?php echo esc($get_all_products->total_price . ' ' . $get_all_products->order_ccy); ?></span></td>
                                    <!--<td><span class="payxnowandrestondelivery-status-text">Completed</span><label class="switch">
                                             <input type="checkbox" <?php echo $chkedsts; ?>>
                                             <span class="slider round"></span>
                                         </label></td>-->
                                    <td>
                                        <div class="payxnowandrestondelivery-table-inner-wrapper">
                                            <div>
                                                <span style="font-size:14px;" class="payxnowandrestondelivery-status-text"> <?php echo $chkedsts1; ?></span>

                                            </div>
                                            <!-- <div class="view-col">
                                                 <a href=""><img src="./images/eye-icon.svg" alt=""><span>view</span></a>
                                             </div> -->
                                        </div>
                                    </td>
                                    <td class="payxnowandrestondelivery-fullfilment-text"><span><?php echo ucfirst($get_all_products->fullfilment_status); ?></span></td>

                                </tr>
                        <?php

                            }
                        }





                        ?>
                    </table>

                </div>
                <?php

                if ($total_pages > 1) {
                    echo "<ul class='payxnowandrestondelivery-pagination'>";
                    if ($order_paging > 1) {
                        echo "<li><a onclick='abc(event)' href='https://admin.shopify.com/store/" . esc($store_namep) . "/apps/pay-x-now-rest-on-delivery/show-orders?order_paging=" . ($order_paging - 1) . "' class='payxnowandrestondelivery-button'>Previous</a></li>";
                    }
                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo "<li><a onclick='abc(event)' href='https://admin.shopify.com/store/" . esc($store_namep) . "/apps/pay-x-now-rest-on-delivery/show-orders?order_paging=" . $i . "'>" . $i . "</a></li>";
                    };
                    if ($total_pages > $order_paging) {
                        echo "<li><a onclick='abc(event)' href='https://admin.shopify.com/store/" . esc($store_namep) . "/apps/pay-x-now-rest-on-delivery/show-orders?order_paging=" . ($order_paging + 1) . "' class='payxnowandrestondelivery-button'>Next</a></li>";
                    }
                    echo "</ul>";
                }
                ?>

            </div>
        </div>
    </div>
</div>
<!-- main area ends-->


<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<script>
    var ship_provder = '';
    var ordpage = '<?php echo $order_paging; ?>';
    var orderlimit = '<?php echo $orderlimit; ?>';
    $(function() {

        $(".payxnowandrestondelivery-checkAll").click(function() {
            checkwhat = $(this).data("checkwhat");
            $('input:checkbox.' + checkwhat).not(this).prop('checked', this.checked);
        });

        // 
        $(".payxnowandrestondelivery-start_sync").click(function() {
            $("#syncstartt").html('Order Synchronization Started');
            var timstm = '<?php echo time(); ?>';
            $.ajax({
                type: "GET",
                url: "order-sync",
                data: 'shop=<?php echo esc($_GET['shop']); ?>&ordpage=' + ordpage + '&orderlimit=' + orderlimit + '&timstm=' + timstm,
                success: function(response) {
                    $("#syncstartt").html('Order Synchronization Done');
                    location.reload();
                    // $("#syncstartt").html(response);
                }
            });
        });

        //  $(".start_sync_picker").click(function() {
        //      $("#syncstartt").html('Order Synchronization Started with pickrr');
        //      $.ajax({
        //          type: "GET",
        //          url: "order-sync-pickrr",
        //          data: 'shop=<?php echo esc($_GET['shop']); ?>&ordpage=' + ordpage + '&orderlimit=' + orderlimit,
        //          success: function(response) {
        //              $("#syncstartt").html('Order Synchronization Done');
        // 		 location.reload();
        //             // $("#syncstartt").html(response);
        //          }
        //      });
        //  });


        // btn popup
        // $("#myBtn").click(function() {

        //     $('#myModal').modal('show');
        // });

    });
</script>