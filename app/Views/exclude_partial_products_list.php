<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
    var shopname = '<?php echo esc($_GET['shop']); ?>';
    $.ajax({
        type: "GET",
        url: "track_countall",
        data: 'shop=' + shopname,
        success: function(response) {}

    });
</script>
<?php

$link = $_SERVER['PHP_SELF'];

$link_array = explode('/', $link);

$page = end($link_array);

$shop_name = explode(".", $_GET['shop']);
$store_name = $shop_name[0];

?>
<style>
    .additionalCGtext {
        display: inline-block;
        color: #000;
        letter-spacing: .2px;
        background: #F2F6FF;
        padding: 10px;
        font-size: 15px;
    }

    .additionalCGtextred {
        display: inline-block;
        color: #000;
        letter-spacing: .2px;
        background: red;
        padding: 10px;
        font-size: 15px;
    }

    .cg_splite_partialtype {
        display: flex;
        gap: 5px;
        justify-content: center;
    }

    .cg_splite_partialtype .payxnowandrestondelivery-edit-col {
        border-radius: 3px;
        border: 1px solid rgba(0, 0, 0, .3);
        background: #fff;
        box-shadow: 4px 4px 4px 0 rgba(0, 0, 0, .1) inset;
        max-width: 90px;
    }
</style>
<div class="payxnowandrestondelivery-container">
    <div class="payxnowandrestondelivery-main-heading payxnowandrestondelivery-back-heading">
        <h5> <a onclick='navigateToPage("https://admin.shopify.com/store/<?php echo htmlspecialchars($store_name); ?>/apps/pay-x-now-rest-on-delivery/products-list");' href="javascript:void(0);">Back</a></h5>

    </div>
</div>
<div class="payxnowandrestondelivery-container">
    <div class="payxnowandrestondelivery-main-area payxnowandrestondelivery-no-sidebar payxnowandrestondelivery-single-page">
        <div class="payxnowandrestondelivery-inner-wrapper">
            <div class="payxnowandrestondelivery-main-data-col">

                <div class="payxnowandrestondelivery-head-wrapper list_search">
                    <!-- <h2>Product name</h2> -->

                    <div class="flex-wrapper">
                        <form id="searchbox" class="flex-wrapper" method="POST" onsubmit="return search_text_partial()">
                            <div class="search-wrapper">

                                <input type="text" placeholder="Search.." class="srchtctval" id="list_search" name="search_text" value="<?php echo $search_list; ?>">
                                <button type="submit" id="lstsearchq" name="search_query"><i class="fa fa-search"></i></button>

                            </div>
                            <a onclick='abc(event);' class="payxnowandrestondelivery-button payxnowandrestondelivery-main-cta" href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/partial-products-list">Clear</a>
                        </form>
                    </div>
                    <?php

                
                    ?>

                </div>

                <?php
                if (!empty($get_list)) { ?>
                    <form method="POST" onsubmit="return remove_prodct()" id="removform">
                        <button type="submit" class="payxnowandrestondelivery-button payxnowandrestondelivery-main-cta" name="remove_partial_pro" value="remove" id="remove_load_page" class="payxnowandrestondelivery-btn-with-bg payxnowandrestondelivery-main-cta"><i class="fa fa-trash" aria-hidden="true"></i>
                            Remove partial payment</button>

                        <div class="payxnowandrestondelivery-table-outer-wrapper">
                            <table>
                                <tr>
                                    <th class="payxnowandrestondelivery-flex-row"><input id="payxnowandrestondelivery_partial_all" class="payxnowandrestondelivery-checkAll" type="checkbox">&nbsp; All</th>
                                    <th>Sr. No</th>
                                    <th>Product Name</th>
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
                                    <tr tblid="<?php echo esc($list_product->id); ?>">
                                        <td><input class="payxnowandrestondelivery-chkSelect" type="checkbox" name="assign_remove_pro[]" value="<?php echo esc($list_product->product_id); ?>"></td>
                                        <td> <?php echo esc($sr + $stsrt); ?></td>
                                        <td> <?php echo esc($list_product->title); ?></td>                                        

                                        <td class="payxnowandrestondelivery-double-col">
                                             <span class="payxnowandrestondelivery-action-text"><a class="paycnoe_del_exclude" delid="<?php echo esc($list_product->id); ?>" href="javascript:void(0);"><img src="/public/images/delete-icon.svg" alt="delete-icon"></a></span>
                                        </td>
                                       
                                    </tr>
                                <?php
                                    $sr++;
                                } ?>
                            </table>

                        </div>
                    </form>
                    <?php
                    $shop_name = explode(".", $_GET['shop']);
                    $store_namep = $shop_name[0];
                    if ($total_pages > 1) {
                        echo "<ul class='payxnowandrestondelivery-pagination'>";
                        if ($part_page > 1) { ?>

                        <li><a onclick="navigateToPage('https://admin.shopify.com/store/<?php echo htmlspecialchars($store_name); ?>/apps/pay-x-now-rest-on-delivery/exclude_products_list?part_page=<?php echo ($part_page - 1);?>')" href='javascript:void(0);' class='payxnowandrestondelivery-button'>Previous</a></li>


                         <?php } else {
                            echo "<li><a onclick='abc(event)' href='javascript:void(0);' class='cg_cpliteship_disabled-link payxnowandrestondelivery-button'>Previous</a></li>";
                        }
                        
                        if ($total_pages > $part_page) { ?> 
                            <li><a onclick="navigateToPage('https://admin.shopify.com/store/<?php echo htmlspecialchars($store_name); ?>/apps/pay-x-now-rest-on-delivery/exclude_products_list?part_page=<?php echo ($part_page + 1);?>')" href='javascript:void(0);' class='payxnowandrestondelivery-button'>Next</a></li>
                        <?php }
                        echo "</ul>";
                    }
                    ?>
                <?php } ?>


            </div>
        </div>
    </div>
    <?php
    if (empty($get_list)) { ?>
        <div class="payxnowandrestondelivery-not-found-msg">
            <h2>Product Not found</h2>
        </div>
    <?php } ?>

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

        $('.paycnoe_del_exclude').on('click', function(e) {
        var condg = confirm('Are you sure want to remove?');
        //alert(condg);
        if (condg == true) {
            const trvd = new Date();
            let track_req_time = trvd.getTime();
            var this_id_frm = $(this).attr('delid');

            $.ajax({
                type: "POST",
                url: "exclude-products-remove?id=" + this_id_frm,
                data: 'shop=' + shopname,
                success: function(response) {
                    //alert('Product remove successfully');
                    navigateToPage('https://admin.shopify.com/store/<?php echo htmlspecialchars($store_name); ?>/apps/pay-x-now-rest-on-delivery/exclude_products_list?pro=tru');
                    //location.reload();
                }

            });
            return false;
        }
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
            $("#show_per_type_" + attrid).hide();
            $("#show_per_text_" + attrid).show();
            $("#show_per_select_" + attrid).show();
        });

        $(".payxnowandrestondelivery-cancel_btn").click(function() {
            var canidid = $(this).attr('canid');
            $("#show_per_" + canidid).show();
            $("#show_per_text_" + canidid).hide();

            // var selectval = $("#change_type_" + canidid).val();
            $("#show_per_type_" + canidid).show();
            //$("#show_per_type_" + canidid).html(selectval);
            $("#show_per_select_" + canidid).hide();

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

        var form_data = new FormData(document.querySelector("#removform"));
        if (!form_data.has("assign_remove_pro[]")) {
            alert('Please select any products');
            return false;
        } else {
            return confirm('Do you really want to remove selected product(s)?');
            //return true;
        }

    }

    function search_text_partial() {
        var getsearchval = $("#list_search").val();
        if (getsearchval.length < 3) {
            alert("Please enter minimum 3 characters length");
            return false;
        }

    }
</script>