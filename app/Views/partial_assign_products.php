<form method="POST" action="">

    <div class="payxnowandrestondelivery-container">
        <div class="payxnowandrestondelivery-main-area payxnowandrestondelivery-no-sidebar payxnowandrestondelivery-detail-page">
            <div class="payxnowandrestondelivery-inner-wrapper">
                <div class="payxnowandrestondelivery-side-bar-col">
                    <h2>Pick Collection</h2>
                    <div class="payxnowandrestondelivery-custom-select">
                        <select style="display:block;" required id="get_coll" name="get_coll">
                            <option value="0">Select Collection...</option>
                            <?php foreach ($get_store_collections as $get_collections) { ?>

                                <option <?php if (isset($_GET['collectionparms']) && $_GET['collectionparms'] == $get_collections->collection_id) { ?> selected <?php } ?> value="<?php echo esc($get_collections->collection_id); ?>"><?php echo esc($get_collections->collections_name); ?></option>

                            <?php } ?>

                        </select>
                        <!--<div style="margin-top: 11px;width: 67%;">
                            <form method="post" action="">
                                <input type="text" name="search_string">
                                <button type="submit" name="search" value="Search" class="payxnowandrestondelivery-button payxnowandrestondelivery-main-cta"></button>
                            </form>
                        </div>-->
                    </div>
                </div>
                <div class="payxnowandrestondelivery-main-data-col">
                    <div class="payxnowandrestondelivery-head-wrapper">
                        <h2>Product name</h2>
                        <?php if ($checkcol == 'yes') { ?>
                            <button type="submit" class="payxnowandrestondelivery-button payxnowandrestondelivery-main-cta" name="assign_save" value="save" id="load_page" class="payxnowandrestondelivery-btn-with-bg payxnowandrestondelivery-main-cta">+ &nbsp; Partial payment setup</button>
                            <!-- <a href="#" class="button">+ &nbsp; Partial payment setup</a> -->
                        <?php } ?>
                    </div>
                    <?php if ($checkcol == 'yes') { ?>
                        <div class="payxnowandrestondelivery-table-outer-wrapper">
                            <table>

                                <tr>
                                    <th class="payxnowandrestondelivery-flex-row"><input class="payxnowandrestondelivery-checkAll" type="checkbox">&nbsp; All</th>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Partially Added Status</th>
                                </tr>
                                <tbody id="product-list">

                                    <?php
                                    //echo"<pre>"; print_r($get_part_list); echo"</pre>";
                                    if (!empty($products)) {
                                        foreach ($products as $edge) {
                                            //print_r($edge);
                                            foreach ($edge as $value) {
                                                //foreach ($node as $key => $value) {
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

                                                    //  $image = count($value['images']) > 0 ? $value['images'][0]['src'] : "";
                                    ?>
                                                    <tr>
                                                        <td><input class="payxnowandrestondelivery-chkSelect" type="checkbox" dattatrr="<?php echo esc($partiall_added2); ?>" name="assign_pro[]" value="<?php echo esc($prodctid); ?>"></td>
                                                        <td> <?php echo esc($prodctid); ?></td>
                                                        <td> <?php echo esc($value['node']['title']); ?></td>
                                                        <td class="<?php echo $cls; ?>"><span><?php echo esc($partiall_added); ?></span></td>

                                                    </tr>
                                    <?php

                                                }
                                                // }
                                            }
                                        }
                                    }





                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php

                        if (!empty($products)) {

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
                </div>
            </div>
        </div>
    </div>
    <?php if ($checkcol == 'yes') { ?>
        <!-- <div class="rowSep">

            <div class="rowSepCol12 btnM30 text-center-00">

                <button type="submit" name="assign_save" value="save" id="load_page" class="btn-with-bg">Add</button>

            </div>

        </div> -->
    <?php } ?>
</form>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<script>
    var ship_provder = '';
    $(function() {

        //$(".checkAll").click(function() {
        $("body").on("click", ".payxnowandrestondelivery-checkAll", function() {

            if ($(this).prop("checked")) {
                // let ddtatrr = $(this).attr('dattatrr');
                // console.log(ddtatrr);
                //$(".chkSelect").prop("checked", true);
                $("[dattatrr=not_added]").prop("checked", true);
            } else {
                $(".payxnowandrestondelivery-chkSelect").prop("checked", false);
            }

            // alert('clciked');
            // let checkwhat = $(this).data("checkwhat");
            // $('input:checkbox.' + checkwhat).not(this).prop('checked', this.checked);

        });

    });
</script>