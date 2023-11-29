<?php

$link = $_SERVER['PHP_SELF'];

$link_array = explode('/', $link);

$page = end($link_array);

$shop_name = explode(".", $_GET['shop']);
$store_name = $shop_name[0];

?>
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
                    <div class="payxnowandrestondelivery-table-outer-wrapper">
                        <table>
                            <tr>
                                <th>Sr. No</th>
                                <th>Product Name</th>
                                <?php if ($_GET['shop'] == 'desinomatetest.myshopify.com') {

                                ?>
                                    <th>Partial Type</th>
                                    <th>Partial value</th>
                                <?php } else { ?>
                                    <th>Partial Percentage</th>
                                <?php } ?>
                                <th>Action</th>
                            </tr>

                            <?php
                            $shop_name = explode(".", $_GET['shop']);
                            $fstore_name2 = $shop_name[0];
                            // if (!empty($get_list)) {
                            // $sr = $start_from;
                            $stsrt = 1;
                            // $start_from = ($page-1) * $num_rec_per_page+1; 
                            foreach ($get_list as $list_product) {

                            ?>

                                <tr>
                                    <td> <?php echo esc($stsrt); ?></td>
                                    <td> <?php echo esc($list_product->product_title); ?></td>
                                    <?php if ($_GET['shop'] == 'desinomatetest.myshopify.com') { ?>

                                        <td>

                                            <span id="show_per_<?php echo esc($list_product->id); ?>"></span>
                                            <span id="show_per_text_<?php echo esc($list_product->id); ?>">
                                                <!-- <input type="text" name="change_partial" class="payxnowandrestondelivery-edit-col" id="" value="<?php echo $list_product->partial_percentage; ?>"> -->
                                                <select name="change_type" id="change_type_<?php echo esc($list_product->id); ?>">
                                                    <option value="precentage">Percentage</option>
                                                    <option value="fixed">Fixed</option>
                                                </select>
                                            </span>

                                        </td>
                                        <td>

                                            <span id="show_per_<?php echo esc($list_product->id); ?>"></span>
                                            <span id="show_per_text_<?php echo esc($list_product->id); ?>">
                                                <input type="text" name="change_partial" class="payxnowandrestondelivery-edit-col" id="" value="<?php echo $list_product->partial_percentage; ?>">
                                                <input type="hidden" id="priid_<?php echo esc($list_product->id); ?>" name="proid" value="<?php echo esc($list_product->product_id); ?>">
                                                <input type="hidden" name="update_id" value="<?php echo esc($list_product->id); ?>">
                                                <!-- <input type="button" name="cancel_per" class="payxnowandrestondelivery-cancel_btn" canid="<?php echo esc($list_product->id); ?>" value="cancel"> -->
                                                <input type="button" class="partial_update_price_lates payxnowandrestondelivery-subbtn" subid="<?php echo esc($list_product->id); ?>" name="update_per" value="Save">
                                            </span>

                                        </td>

                                    <?php } else { ?>
                                        <td>
                                            <form action="track_partial_percentage" id="sub_form_data_<?php echo esc($list_product->id); ?>" class="payxnowandrestondelivery-partial_percentage" method="POST">
                                                <span id="show_per_<?php echo esc($list_product->id); ?>"></span>
                                                <span id="show_per_text_<?php echo esc($list_product->id); ?>">
                                                    <input type="text" name="change_partial" class="payxnowandrestondelivery-edit-col" id="" value="<?php echo $list_product->partial_percentage; ?>">
                                                    <input type="hidden" id="priid_<?php echo esc($list_product->id); ?>" name="proid" value="<?php echo esc($list_product->product_id); ?>">
                                                    <input type="hidden" name="update_id" value="<?php echo esc($list_product->id); ?>">
                                                    <!-- <input type="button" name="cancel_per" class="payxnowandrestondelivery-cancel_btn" canid="<?php echo esc($list_product->id); ?>" value="cancel"> -->
                                                    <input type="button" class="partial_update_price_lates payxnowandrestondelivery-subbtn" subid="<?php echo esc($list_product->id); ?>" name="update_per" value="Save">
                                                </span>
                                            </form>
                                        </td>
                                    <?php } ?>
                                    <td class="payxnowandrestondelivery-double-col">
                                        <span class="payxnowandrestondelivery-action-text"> <a class="payxnowandrestondelivery-edit_per" id="<?php echo esc($list_product->id); ?>" href="javascript:void(0);"><img src="/public/images/edit-icon.svg" alt="edit-icon"></a> </span> <span class="payxnowandrestondelivery-action-text"><a onclick="abc2(event);" href="https://admin.shopify.com/store/<?php echo esc($fstore_name2); ?>/apps/pay-x-now-rest-on-delivery/products-remove?id=<?php echo esc($list_product->product_id); ?>"><img src="/public/images/delete-icon.svg" alt="delete-icon"></a></span>
                                    </td>

                                </tr>

                            <?php
                                $stsrt++;
                            } ?>
                        </table>

                    </div>

                <?php } ?>


            </div>
        </div>
    </div>
</div>
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
        

    });
</script>