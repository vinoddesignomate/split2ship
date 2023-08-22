<?php

$link = $_SERVER['PHP_SELF'];

$link_array = explode('/', $link);

$page = end($link_array);

$shop_name = explode(".", $_GET['shop']);
$store_name = $shop_name[0];

?>
<form method="POST" onsubmit="return remove_prodct()" id="removform">
    <div class="payxnowandrestondelivery-container">
        <div class="payxnowandrestondelivery-main-heading payxnowandrestondelivery-back-heading">
            <h5> <a onclick="abc(event);" href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/products-list">Back</a></h5>

        </div>
    </div>
    <div class="payxnowandrestondelivery-container">
        <div class="payxnowandrestondelivery-main-area payxnowandrestondelivery-no-sidebar payxnowandrestondelivery-single-page">
            <div class="payxnowandrestondelivery-inner-wrapper">
                <div class="payxnowandrestondelivery-main-data-col">
                    <?php if (!empty($get_list)) { ?>
                        <div class="payxnowandrestondelivery-head-wrapper">
                            <!-- <h2>Product name</h2> -->

                            <button type="submit" class="payxnowandrestondelivery-button payxnowandrestondelivery-main-cta" name="remove_partial_pro" value="remove" id="remove_load_page" class="payxnowandrestondelivery-btn-with-bg payxnowandrestondelivery-main-cta"><i class="fa fa-trash" aria-hidden="true"></i>
                                Remove partial payment</button>

                        </div>
                    <?php  }
                    if (!empty($get_list)) { ?>
                        <div class="payxnowandrestondelivery-table-outer-wrapper">
                            <table>
                                <tr>
                                    <th class="payxnowandrestondelivery-flex-row"><input id="payxnowandrestondelivery_partial_all" class="payxnowandrestondelivery-checkAll" type="checkbox">&nbsp; All</th>
                                    <th>Sr. No</th>
                                    <th>Product Name</th>
                                    <th>Partial Percentage</th>
                                    <th>Action</th>
                                </tr>

                                <?php
                                $shop_name = explode(".", $_GET['shop']);
                                $fstore_name2 = $shop_name[0];
                                // if (!empty($get_list)) {
                                $sr = $start_from;
                                $stsrt = 0;
                                // $start_from = ($page-1) * $num_rec_per_page+1; 
                                foreach ($get_list as $list_product) {

                                ?>
                                    <tr>
                                        <td><input class="payxnowandrestondelivery-chkSelect" type="checkbox" name="assign_remove_pro[]" value="<?php echo esc($list_product->product_id); ?>"></td>
                                        <td> <?php echo esc($sr + $stsrt); ?></td>
                                        <td> <?php echo esc($list_product->product_title); ?></td>
                                        <td>
                                            <form action="track_partial_percentage" id="sub_form_data_<?php echo esc($list_product->id); ?>" class="payxnowandrestondelivery-partial_percentage" method="POST">
                                                <span id="show_per_<?php echo esc($list_product->id); ?>"><?php echo $list_product->partial_percentage; ?></span>
                                                <span style="display:none;" id="show_per_text_<?php echo esc($list_product->id); ?>">
                                                    <input type="text" name="change_partial" class="payxnowandrestondelivery-edit-col" id="partial_textinput_<?php echo esc($list_product->id); ?>" value="<?php echo $list_product->partial_percentage; ?>">

                                                    <input type="hidden" id="priid_<?php echo esc($list_product->id); ?>" name="proid" value="<?php echo esc($list_product->product_id); ?>">

                                                    <input type="hidden" name="update_id" value="<?php echo esc($list_product->id); ?>">
                                                    <input type="button" name="cancel_per" class="payxnowandrestondelivery-cancel_btn" canid="<?php echo esc($list_product->id); ?>" value="cancel">
                                                    <input type="button" class="partial_update_price payxnowandrestondelivery-subbtn" subid="<?php echo esc($list_product->id); ?>" name="update_per" value="Save">
                                                </span>
                                            </form>
                                        </td>
                                        <td class="payxnowandrestondelivery-double-col">
                                            <span class="payxnowandrestondelivery-action-text"> <a class="payxnowandrestondelivery-edit_per" id="<?php echo esc($list_product->id); ?>" href="javascript:void(0);"><img src="/public/images/edit-icon.svg" alt="edit-icon"></a> </span> <span class="payxnowandrestondelivery-action-text"><a onclick="abc2(event);" href="https://admin.shopify.com/store/<?php echo esc($fstore_name2); ?>/apps/pay-x-now-rest-on-delivery/products-remove?id=<?php echo esc($list_product->product_id); ?>"><img src="/public/images/delete-icon.svg" alt="delete-icon"></a></span>
                                        </td>
                                        <!-- <td>
                                <div class="payxnowandrestondelivery-table-inner-wrapper">
                                    <div>
                                        <span class="payxnowandrestondelivery-status-text">Completed</span>
                                        <label class="switch">
                                            <input type="checkbox">
                                            <span class="payxnowandrestondelivery-slider round"></span>
                                        </label>
                                    </div>
                                    <div>
                                        <span class="payxnowandrestondelivery-action-text"><a href="">Remove</a></span>
                                    </div>
                                    <div class="payxnowandrestondelivery-view-col">
                                        <a href=""><img src="./images/eye-icon.svg" alt=""><span>view</span></a>
                                    </div>
                                </div>
                            </td> -->
                                    </tr>
                                <?php
                                    $sr++;
                                } ?>
                            </table>

                        </div>
                        <?php
                        $shop_name = explode(".", $_GET['shop']);
                        $store_namep = $shop_name[0];
                        if ($total_pages > 1) {
                            echo "<ul class='payxnowandrestondelivery-pagination'>";
                            if ($part_page > 1) {
                                echo "<li><a onclick='abc(event)' href='https://admin.shopify.com/store/" . esc($store_namep) . "/apps/pay-x-now-rest-on-delivery/partial-products-list?part_page=" . ($part_page - 1) . "' class='payxnowandrestondelivery-button'>Previous</a></li>";
                            }
                            for ($i = 1; $i <= $total_pages; $i++) {
                                echo "<li><a onclick='abc(event)' href='https://admin.shopify.com/store/" . esc($store_namep) . "/apps/pay-x-now-rest-on-delivery/partial-products-list?part_page=" . $i . "'>" . $i . "</a></li>";
                            };
                            if ($total_pages > $part_page) {
                                echo "<li><a onclick='abc(event)' href='https://admin.shopify.com/store/" . esc($store_namep) . "/apps/pay-x-now-rest-on-delivery/partial-products-list?part_page=" . ($part_page + 1) . "' class='payxnowandrestondelivery-button'>Next</a></li>";
                            }
                            echo "</ul>";
                        }
                        ?>
                    <?php } ?>


                </div>
            </div>
        </div>
        <?php 
        echo "shopname=".$shopname;
        if($shopname == 'desinomatetest.myshopify.com	') { ?>
         <div class="main-area no-sidebar single-page">
        <div class="inner-wrapper">
            <div class="main-data-col">
                <div class="table-heading">
                    <h2>Collection Partial Percentage</h2>
                </div>

                <?php if (!empty($get_store_collections)) { ?>
                    <div class="table-outer-wrapper">
                        <table>
                            <tr>
                                <th>Sr. No</th>
                                <th>Collection Name</th>
                                <th>Partial Percentage</th>
                             
                            </tr>

                            <?php
                            $shop_name = explode(".", $_GET['shop']);
                            $fstore_name2 = $shop_name[0];
                            // if (!empty($get_list)) {
                            $sr = $start_from;
                            $stsrt = 0;
                            // $start_from = ($page-1) * $num_rec_per_page+1; 
                            foreach ($get_store_collections as $list_collections) {
                                // echo "<pre>";
                                // print_r($list_collections);
                                // echo "</pre>";

                                if (isset($get_stored_percentage[$list_collections->collection_id])) {
                                    $col_pergs = $get_stored_percentage[$list_collections->collection_id]['percentage'];
                                } else {
                                    $col_pergs = 0;
                                }

                            ?>
                                <tr>
                                    <td> <?php echo esc($sr + $stsrt); ?></td>
                                    <td> <?php echo esc($list_collections->collections_name); ?></td>
                                    <td>
                                        <form action="collection_track_partial_percentage" id="sub_form_data_<?php echo esc($list_collections->collection_id); ?>" class="part_partial_percentage" method="POST">
                                            <span>
                                                <input type="text" style="width: 32% !important;" class="edit-col" name="colltion_change_partial" id="" value="<?php echo $col_pergs; ?>">
                                                <input type="hidden" name="colltion_change_partial_id" id="" value="<?php echo esc($list_collections->collection_id); ?>">

                                                <input type="button" style="width: 32% !important;" class="subbtn_coll" subid="<?php echo esc($list_collections->collection_id); ?>" name="update_per" value="Save">
                                            </span>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                                $sr++;
                            } ?>
                        </table>

                    </div>

                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>
    </div>
</form>
</div>





<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<script>
    var ship_provder = '';
    $(function() {

        $(".payxnowandrestondelivery-checkAll").click(function() {
            checkwhat = $(this).data("checkwhat");
            $('input:checkbox.' + checkwhat).not(this).prop('checked', this.checked);

        });

        function delproduct(event) {
            event.preventDefault();
            if (confirm("Are you sure to delete ?")) {
                var href = event.currentTarget.getAttribute('href')
                top.window.location = href;
            } else {
                return false;
            }

        }

        // $(".del_per").click(function() {
        //     var attrid = $(this).attr('id');
        // });
        $(".payxnowandrestondelivery-edit_per").click(function() {
            var attrid = $(this).attr('id');
            $("#show_per_" + attrid).hide();
            $("#show_per_text_" + attrid).show();
        });

        $(".payxnowandrestondelivery-cancel_btn").click(function() {
            var canidid = $(this).attr('canid');
            $("#show_per_" + canidid).show();
            $("#show_per_text_" + canidid).hide();
        });

        $('.subbtn_coll').on('click', function(e) {

            const d = new Date();
            let req_time = d.getTime();

            var this_id_frm = $(this).attr('subid');
            var formdata = $("#sub_form_data_" + this_id_frm).serialize();
            var shopname = '<?php echo esc($_GET['shop']); ?>';
            $.ajax({
                type: "POST",
                url: "collection_track_partial_percentage?vart=" + req_time,
                data: 'shop=' + shopname + '&update_per=true&' + formdata,
                success: function(response) {
                    window.location.reload();
                    // $("#show_per_" + this_id_frm).show();
                    // $("#show_per_" + this_id_frm).html(response);
                    // $("#show_per_text_" + this_id_frm).hide();
                }

            });
            return false;
        });

        //$(".checkAll").click(function() {
        $("body").on("click", "#payxnowandrestondelivery_partial_all", function() {
            //alert("hello");

            if ($(this).prop("checked")) {
                $(".payxnowandrestondelivery-chkSelect").prop("checked", true);
            } else {
                $(".payxnowandrestondelivery-chkSelect").prop("checked", false);
            }


        });

    });

    function remove_prodct() {

        var form_data = new FormData(document.querySelector("form"));
        if (!form_data.has("assign_remove_pro[]")) {
            alert('Please select any products');
            return false;
        } else {
            return confirm('Do you really want to remove selected product(s)?');
            //return true;
        }


        // if ($(".payxnowandrestondelivery-chkSelect").prop("checked")) {
        //     var gettxt = confirm('Do you really want to remove selected product(s)?');
        //     if (gettxt) {
        //         $("#removform").submit();
        //     } else {

        //     }
        // } else {
        //     alert('Please select any products');
        //     // return false;
        // }
    }
</script>