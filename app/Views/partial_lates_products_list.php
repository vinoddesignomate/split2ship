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
                                <th>Partial Percentage</th>
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
                                    <td>
                                        <form action="track_partial_percentage" id="sub_form_data_<?php echo esc($list_product->id); ?>" class="payxnowandrestondelivery-partial_percentage" method="POST">
                                            <span id="show_per_<?php echo esc($list_product->id); ?>"></span>
                                            <span id="show_per_text_<?php echo esc($list_product->id); ?>">
                                                <input type="text" name="change_partial" class="payxnowandrestondelivery-edit-col" id="" value="<?php echo $list_product->partial_percentage; ?>">
                                                <input type="hidden" name="proid" value="<?php echo esc($list_product->product_id); ?>">
                                                <input type="hidden" name="update_id" value="<?php echo esc($list_product->id); ?>">
                                                <!-- <input type="button" name="cancel_per" class="payxnowandrestondelivery-cancel_btn" canid="<?php echo esc($list_product->id); ?>" value="cancel"> -->
                                                <input type="button" class="payxnowandrestondelivery-subbtn" subid="<?php echo esc($list_product->id); ?>" name="update_per" value="Save">
                                            </span>
                                        </form>
                                    </td>
                                    <td class="payxnowandrestondelivery-double-col">
                                        <span class="payxnowandrestondelivery-action-text"> <a class="payxnowandrestondelivery-edit_per" id="<?php echo esc($list_product->id); ?>" href="javascript:void(0);"><img src="/payxnowandrestondelivery/public/images/edit-icon.svg" alt="edit-icon"></a> </span> <span class="payxnowandrestondelivery-action-text"><a onclick="abc2(event);" href="https://admin.shopify.com/store/<?php echo esc($fstore_name2); ?>/apps/pay-x-now-rest-on-delivery/payxnowandrestondelivery/public/index.php/products-remove?id=<?php echo esc($list_product->product_id); ?>"><img src="/payxnowandrestondelivery/public/images/delete-icon.svg" alt="delete-icon"></a></span>
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

        $('.subbtn_coll').on('click', function(e) {

            const d = new Date();
            let req_time = d.getTime();

            var this_id_frm = $(this).attr('subid');
            var formdata = $("#sub_form_data_" + this_id_frm).serialize();
            var shopname = '<?php echo esc($_GET['shop']); ?>';
            $.ajax({
                type: "POST",
                url: "collection_track_partial_percentage?vart="+req_time,
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

    });
</script>