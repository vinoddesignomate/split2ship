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

                <div class="main-area no-sidebar single-page">
                    <div class="inner-wrapper">
                        <div class="main-data-col">
                            <div class="table-heading" style="margin-bottom: 18px;">
                                <?php if ($cg_split_plan_sts == 'show') { ?>
                                    <span id="showcoltrckmsg" style="color:green;font-weight:700;"><?php if (!empty($check_bulk_products_status)) { ?> We have started synching all products in background. It will take some time. You can leave this screen.<?php } ?></span>
                                    <h2 style="margin-top: 7px;">Set partial percentage by collections</h2>

                                    <span>Add all products into partial products list by collections</span>
                                <?php } else { ?>
                                    <h2 style="margin-top: 7px;">Set partial percentage by collections</h2>

                                    <span>This feature is for paid users. Please upgrade your plan <a onclick="abc(event);" href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/price-plan">Upgrade here</a></span>

                                <?php } ?>
                            </div>

                            <?php
                            if ($cg_split_plan_sts == 'show') {
                                if (!empty($get_store_collections)) { ?>
                                    <div class="table-outer-wrapper">
                                        <table>
                                            <tr>
                                                <th>Sr. No</th>
                                                <th>Collection Name</th>
                                                <th>Partial Type</th>
                                                <th>Partial Value</th>
                                            </tr>

                                            <?php
                                            $shop_name = explode(".", $_GET['shop']);
                                            $fstore_name2 = $shop_name[0];
                                            // if (!empty($get_list)) {
                                            //$sr = $start_from;
                                            $stsrt = 1;
                                            // $start_from = ($page-1) * $num_rec_per_page+1; 
                                            foreach ($get_store_collections as $list_collections) {

                                                if (isset($get_stored_percentage[$list_collections->collection_id])) {
                                                    $col_pergs = $get_stored_percentage[$list_collections->collection_id]['percentage'];
                                                    $coll_part_type = $get_stored_percentage[$list_collections->collection_id]['partial_type'];
                                                } else {
                                                    $coll_part_type = "";
                                                    $col_pergs = 0;
                                                }

                                            ?>
                                                <tr>

                                                    <td> <?php echo esc($stsrt); ?></td>
                                                    <td> <?php echo esc($list_collections->collections_name); ?></td>

                                                    <td>
                                                        <form action="collection_track_partial_percentage" id="sub_form_data_newfrm_<?php echo esc($list_collections->collection_id); ?>" class="part_partial_percentage" method="POST">
                                                            <span>
                                                                <select name="change_type" id="change_type_<?php echo esc($list_collections->collection_id); ?>">
                                                                    <option <?php if ($coll_part_type == 'precentage') { ?> selected <?php } ?> value="precentage">Percentage</option>
                                                                    <option <?php if ($coll_part_type == 'fixed') { ?> selected <?php } ?> value="fixed">Fixed</option>
                                                                </select>


                                                            </span>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form action="collection_track_partial_percentage" id="sub_form_data_<?php echo esc($list_collections->collection_id); ?>" class="part_partial_percentage" method="POST">
                                                            <span>
                                                                <input type="text" style="width: 32% !important;" class="edit-col_class" name="colltion_change_partial" id="" value="<?php echo $col_pergs; ?>">
                                                                <input type="hidden" name="colltion_change_partial_id" id="" value="<?php echo esc($list_collections->collection_id); ?>">

                                                                <input type="button" style="width: 32% !important;" class="colbttrack subbtn_coll" subid="<?php echo esc($list_collections->collection_id); ?>" name="update_per" value="Save">
                                                            </span>
                                                        </form>
                                                    </td>


                                                </tr>
                                            <?php
                                                // $sr++;
                                                $stsrt++;
                                            } ?>
                                        </table>

                                    </div>

                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
    $(function() {
        $('.subbtn_coll').on('click', function(e) {

            const d = new Date();
            let req_time = d.getTime();

            var this_id_frm = $(this).attr('subid');
            var formdata = $("#sub_form_data_" + this_id_frm).serialize();
            var shopname = '<?php echo esc($_GET['shop']); ?>';
            var part_type = "&partiatype=" + $("#change_type_" + this_id_frm).val();
            $(".colbttrack").hide();
            $("#showcoltrckmsg").html('');
            $.ajax({
                type: "POST",
                url: "collection_track_partial_percentage?vart=" + req_time,
                data: 'shop=' + shopname + '&update_per=true&' + formdata + part_type,
                success: function(response) {
                    $(".colbttrack").show();
                    $("#showcoltrckmsg").html('Please wait, we have started synching all products in background. It will take some time. You can leave this screen');
                    $("#showcoltrckmsg").css('color', 'green');
                    //window.location.reload();
                    // $("#show_per_" + this_id_frm).show();
                    // $("#show_per_" + this_id_frm).html(response);
                    // $("#show_per_text_" + this_id_frm).hide();
                }

            });
            return false;
        });
    });
</script>