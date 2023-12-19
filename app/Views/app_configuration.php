<style>
        .text-orange {
                color: #F05523;
        }

        .payxnowandrestondelivery-main-area {
                padding: 25px;
                margin-bottom: 51px;
                margin-top: 0px
        }

        .payxnowandrestondelivery-imgIns {
                margin: 20px auto 0px;
                border: 1px solid rgba(0, 0, 0, 0.10);
                border-radius: 3px;
        }

        .payxnowandrestondelivery-main-area-row {
                display: flex;
                gap: 39px;
                flex-wrap: wrap;
        }

        .payxnowandrestondelivery-main-area-row>div {
                flex: 1;
        }

        .payxnowandrestondelivery-main-heading.payxnowandrestondelivery-back-heading {
                padding: 43px 10px 27px 0px;
        }

        .payxnowandrestondelivery-main-area textarea {
                border-radius: 3px;
                border: 0px;
                padding: 21px 16px;
                background: #E4EBFD;
        }


        .payxnowandrestondelivery-imgIns img {
                width: 100%
        }

        .payxnowandrestondelivery-no-margin .payxnowandrestondelivery-main-area {
                margin-bottom: 0px;
                margin-top: 0;
        }



        .payxnowandrestondelivery-main-area h5 {
                margin: 0px 0px 20px;
                color: #333;
                font-weight: 300;
                font-size: 20px;
                line-height: 27px;
        }







        xmp {
                margin: 0;
        }

        .payxnowandrestondelivery-zip-flex-row {
                display: flex;
                width: 100%;
                justify-content: space-between;
                gap: 45px;
                flex-wrap: wrap;
        }

        /* .payxnowandrestondelivery-zip-flex-row>div {
                flex: 1;
        } */

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

        .payxnowandrestondelivery-form-wrap input[type="checkbox"] {
                width: auto;
        }

        .payxnowandrestondelivery-form-wrap .payxnowandrestondelivery-checkbox-wrap {
                display: flex;
                align-items: center;
        }

        .payxnowandrestondelivery-form-wrap label {
                margin: 0 0 0 10px;
                text-transform: capitalize;
        }

        .payxnowandrestondelivery-form-wrap {

                width: 100%;
                margin-top: 25px;
                border: 1px solid #E6E7E9;
                padding: 27px 24px 34px;
                border-radius: 3px;
        }

        .payxnowandrestondeliver-checkbox-wrap {
                display: flex;
                margin-bottom: 20px;
        }

        .payxnowandrestondelivery-zip-flex-row .payxnowandrestondelivery-col-40 {
                width: 40%;
        }

        .payxnowandrestondelivery-zip-flex-row .payxnowandrestondelivery-col-60 {
                width: calc(60% - 45px);
        }

        .payxnowandrestondelivery-flex-col form .flex-row:last-child {
                margin-top: 11px;
        }

        .payxnowandrestondelivery-form-wrap.payxnowandrestondelivery-flex-row .payxnowandrestondelivery-flex-col {
                flex: 1;
        }

        .payxnowandrestondelivery-form-wrap .partial-text-row .form-small-taxt p {
                color: #F05523;
                font-family: Roboto;
                font-size: 15px;
        }

        .payxnowandrestondelivery-form-wrap .partial-text-row label {
                margin-left: 0;
        }

        .payxnowandrestondelivery-row2 .payxnowandrestondelivery-flex-row>div,
        .payxnowandrestondelivery-row3 .payxnowandrestondelivery-flex-row>div {
                flex: 1;
        }

        .payxnowandrestondelivery-row2 .payxnowandrestondelivery-flex-row,
        .payxnowandrestondelivery-row3 .payxnowandrestondelivery-flex-row,
        .payxnowandrestondelivery-row1 .payxnowandrestondelivery-flex-row {
                gap: 40px;
        }

        .btn-end-form {
                display: flex;
                flex-direction: column;
                align-items: flex-start;

                width: 100%;
                height: 100%;
        }

        .payxnowandrestondelivery-btn-row {
                width: 100%;
                margin-top: 30px;
                flex: none !important;
        }

        @media only screen and (max-width:1024px) {

                .payxnowandrestondelivery-zip-flex-row .payxnowandrestondelivery-col-40,
                .payxnowandrestondelivery-zip-flex-row .payxnowandrestondelivery-col-60 {
                        width: 100%;
                }

                .edit-form-wrapper {
                        max-width: 100%;
                }



        }

        @media only screen and (max-width: 991px) {
                .payxnowandrestondelivery-main-area-row>div {
                        flex: auto;
                        width: 100%;
                }

                .payxnowandrestondelivery-main-area-row {
                        gap: 0px
                }

                .payxnowandrestondelivery-main-area h5 {
                        font-size: 17px;
                        line-height: 23px;
                }

                .payxnowandrestondelivery-main-area {
                        margin-bottom: 35px;
                }
        }

        @media only screen and (max-width:850px) {
                .payxnowandrestondelivery-flex-row {
                        flex-direction: column;
                        gap: 20px;
                }

                .payxnowandrestondelivery-form-wrap {
                        padding: 27px 15px 34px;
                }

                .payxnowandrestondelivery-main-area {
                        padding: 25px 20px;
                }

        }

        @media only screen and (max-width: 767px) {
                .payxnowandrestondelivery-zip-flex-row {
                        display: block;
                }

                .payxnowandrestondelivery-main-area h5 {
                        padding-left: 0px;
                }



                .payxnowandrestondelivery-imgIns {
                        padding: 15px;
                }
        }
</style>
<?php


$shop_name = explode(".", $_GET['shop']);
$store_name = $shop_name[0];

?>
<style>
        .configpageinstr {
                padding: 0;
        }

        .configpageinstr .payxnowandrestondelivery-main-head {
                margin-top: 0;
                margin-bottom: 30px;
        }

        .configpageinstr .alert-wrapper {
                padding: 10px 25px;
                border-radius: 0;
                background-color: #f7e62140;
                border: 3px solid #320c4e3d;
        }

        .configpageinstr p.payxnowandrestondelivery-alert {
                font-size: 16px;
                color: #0C0C0C;
                font-weight: normal;
                line-height: 1.4;
                text-align: center;
        }
</style>
<script src="/public/jscolor.js"></script>
<div class="payxnowandrestondelivery-whiteAreaDiv payxnowandrestondelivery-container">
        <div class="payxnowandrestondelivery-main-heading payxnowandrestondelivery-back-heading">
                <h5> <a onclick='abc(event);' href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/">Back</h5></a>
        </div>

        <?php if ($shpname == 'desinomatetest.myshopify.com') { ?>

                <div class="payxnowandrestondelivery-zip-flex-row">
                        <div class="payxnowandrestondelivery-main-area payxnowandrestondelivery-no-sidebar payxnowandrestondelivery-single-page payxnowandrestondelivery-col-40">
                                <div class="payxnowandrestondelivery-head-wrapper">
                                        <h2 class="">COD payment gatway</h2>
                                </div>
                                <form method="post">
                                        <div class="payxnowandrestondelivery-row3 payxnowandrestondelivery-form-wrap">
                                                <div class="payxnowandrestondelivery-flex-row">
                                                        <div class="payxnowandrestondelivery-flex-col">

                                                                <div class="payxnowandrestondeliver-checkbox-wrap">
                                                                        <input type="checkbox" class="splite_checkbox" id="codgate" <?php echo (isset($get_cod_product[0]->cod_enable) && $get_cod_product[0]->cod_enable == '1') ? 'checked' : ''; ?> name="cod_enable_prcess">
                                                                        <label for="codgate">Enable hide COD</label>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="payxnowandrestondelivery-btn-row">

                                                <div class="btn-row payxnowandrestondelivery-submit-btn" style="margin-top: 10px;">
                                                        <button type="submit" name="enble_cod_prs" class="payxnowandrestondelivery-button payxnowandrestondelivery-main-cta payxnowandrestondelivery-btn-end" value="submit">Submit</button>
                                                </div>

                                        </div>
                                </form>
                        </div>

                        <div class="payxnowandrestondelivery-main-area payxnowandrestondelivery-flex-col payxnowandrestondelivery-col-60">

                                <form method="post">
                                        <div class="payxnowandrestondelivery-head-wrapper">
                                                <h2 class="">Handling Charge</h2>
                                        </div>
                                        <div class="payxnowandrestondelivery-row3 payxnowandrestondelivery-form-wrap">
                                                <div class="payxnowandrestondelivery-flex-row">
                                                        <div class="payxnowandrestondelivery-flex-col">

                                                                <div class="payxnowandrestondeliver-checkbox-wrap">
                                                                        <input type="checkbox" class="splite_checkbox" id="handling_crg" <?php echo (isset($get_cod_product[0]->handling_charge_enalbe) && $get_cod_product[0]->handling_charge_enalbe == '1') ? 'checked' : ''; ?> name="eblehandlingr" onclick="toggleTextBox('handling_crg', 'handliongtt')" value="handlingchgebl">
                                                                        <label for="handling_crg">Enable handling charge</label>
                                                                </div>
                                                        </div>
                                                        <div <?php echo (isset($get_cod_product[0]->handling_charge_enalbe) && $get_cod_product[0]->handling_charge_enalbe == '1') ? 'style="display: block;"' : 'style="display: none;"'; ?> class="payxnowandrestondelivery-flex-col" id="handliongtt">
                                                                <div class="flex-row">
                                                                        <label for="">Title</label>
                                                                        <input type="text" required name="handling_title" value="<?php echo (isset($get_cod_product[0]->product_name) ? $get_cod_product[0]->product_name : ''); ?>">
                                                                </div>
                                                                <div class="flex-row">
                                                                        <label for="">Handling price</label>
                                                                        <input type="number" required name="handle_price" value="<?php echo (isset($get_cod_product[0]->product_price) ? $get_cod_product[0]->product_price : ''); ?>">
                                                                </div>
                                                        </div>


                                                </div>
                                        </div>
                                        <div class="payxnowandrestondelivery-btn-row">

                                                <div class="btn-row payxnowandrestondelivery-submit-btn" style="margin-top: 10px;">
                                                        <button type="submit" name="enable_handling_submit" class="payxnowandrestondelivery-button payxnowandrestondelivery-main-cta payxnowandrestondelivery-btn-end" value="submit">Submit</button>
                                                </div>

                                        </div>
                                </form>
                        </div>

                </div>

        <?php } ?>
        <div class="payxnowandrestondelivery-zip-flex-row">
                <div class="payxnowandrestondelivery-main-area payxnowandrestondelivery-no-sidebar payxnowandrestondelivery-single-page payxnowandrestondelivery-col-40">
                        <div class="payxnowandrestondelivery-head-wrapper">
                                <h2 class="">Cart page settings</h2>
                        </div>
                        <div class="edit-form-wrapper">
                                <form method="post">

                                        <div class="flex-row">
                                                <label for="">Partial payment color code :</label>
                                                <input type="text" name="partbtn_color" data-jscolor="{}" value="<?php echo (isset($gtbtncolor[0]->partial_btn_color) ? $gtbtncolor[0]->partial_btn_color : '006FCF'); ?>">
                                        </div>
                                        <div class="flex-row">
                                                <label for="">Partial payment button text color code :</label>
                                                <input type="text" data-jscolor="{}" name="chk_btn_color" value="<?php echo (isset($gtbtncolor[0]->chk_btn_color) ? $gtbtncolor[0]->chk_btn_color : 'ffffff'); ?>">
                                        </div>
                                        <div class="flex-row">
                                                <label for="">Full payment color code :</label>
                                                <input type="text" data-jscolor="{}" name="fullbtn_color" value="<?php echo (isset($gtbtncolor[0]->full_btn_color) ? $gtbtncolor[0]->full_btn_color : '2F3030'); ?>">
                                        </div>
                                        <div class="flex-row">
                                                <label for="">Full payment button text color code :</label>
                                                <input type="text" data-jscolor="{}" name="full_chk_btn_color" value="<?php echo (isset($gtbtncolor[0]->full_chk_btn_color) ? $gtbtncolor[0]->full_chk_btn_color : 'ffffff'); ?>">
                                        </div>

                                        <div class="flex-row">
                                                <label for="">Cart Summary Section Background color</label>
                                                <input type="text" data-jscolor="{}" name="cart_summary_back_color" value="<?php echo (isset($gtbtncolor[0]->cart_summary_back_color) ? $gtbtncolor[0]->cart_summary_back_color : ''); ?>">
                                        </div>
                                        <div class="flex-row">
                                                <label for="">Cart Summary Section text color</label>
                                                <input type="text" data-jscolor="{}" name="cart_summart_textc" value="<?php echo (isset($gtbtncolor[0]->cart_summart_textc) ? $gtbtncolor[0]->cart_summart_textc : ''); ?>">
                                        </div>
                                        <div class="flex-row">
                                                <label for="">Text 1 </label>
                                                <input type="text" name="cg_partial_dep_text" value="<?php echo ((isset($gtbtncolor[0]->partial_dep_text) && $gtbtncolor[0]->partial_dep_text != "") ? $gtbtncolor[0]->partial_dep_text : 'Partial Deposit'); ?>">
                                        </div>
                                        <div class="flex-row">
                                                <label for="">Text 2 </label>
                                                <input type="text" name="cg_remaining_txtcrt" value="<?php echo ((isset($gtbtncolor[0]->remaining_txtcrt) && $gtbtncolor[0]->remaining_txtcrt != "") ? $gtbtncolor[0]->remaining_txtcrt : 'Remaining Balance'); ?>">
                                        </div>
                                        <div class="flex-row">
                                                <label for="">Text 3 </label>
                                                <input type="text" name="cg_cart_three_txt" value="<?php echo ((isset($gtbtncolor[0]->cart_three_txt) && $gtbtncolor[0]->cart_three_txt != "") ? $gtbtncolor[0]->cart_three_txt : 'You need to pay remaining balance to delivery person'); ?>">
                                        </div>
                                        <div class="flex-row">
                                                <label for="">Partial payment button text </label>
                                                <input type="text" name="cg_partial_btn_text" value="<?php echo ((isset($gtbtncolor[0]->cg_partial_btn_text) && $gtbtncolor[0]->cg_partial_btn_text != "") ? $gtbtncolor[0]->cg_partial_btn_text : 'Partial Payment'); ?>">
                                        </div>
                                        <div class="flex-row">
                                                <label for="">Full payment button text </label>
                                                <input type="text" name="cg_full_btn_text" value="<?php echo ((isset($gtbtncolor[0]->cg_full_btn_text) && $gtbtncolor[0]->cg_full_btn_text != "") ? $gtbtncolor[0]->cg_full_btn_text : 'Full Payment'); ?>">
                                        </div>


                                        <div class="btn-row">
                                                <button type="submit" name="track_color" class="payxnowandrestondelivery-button payxnowandrestondelivery-main-cta payxnowandrestondelivery-btn-end" value="submit">Submit</button>
                                        </div>

                                </form>
                        </div>
                </div>
                <?php //if ($shpname == 'desinomatetest.myshopify.com') {

                ?>
                <div class="payxnowandrestondelivery-main-area payxnowandrestondelivery-flex-col payxnowandrestondelivery-col-60">
                        <form method="post" onsubmit="return validate_chkcart()" class="btn-end-form">
                                <div class="payxnowandrestondelivery-head-wrapper">
                                        <h2 class="">Product Page Button Setting</h2>
                                        <span style="color: red;font-weight: 700;" id="cart_error"></span>
                                </div>
                                <div class="payxnowandrestondelivery-row1 payxnowandrestondelivery-form-wrap payxnowandrestondelivery-flex-row">
                                        <div class="payxnowandrestondelivery-flex-col">
                                                <div class="payxnowandrestondeliver-checkbox-wrap">
                                                        <input type="checkbox" <?php echo (isset($gtbtncolor[0]->add_to_cartbtn) && $gtbtncolor[0]->add_to_cartbtn == '1') ? 'checked' : ''; ?> class="splite_checkbox" id="cartid" name="cart_show_btn[]" value="addtocart">
                                                        <label for="cartid">Enable Add to Cart Button</label>
                                                </div>
                                        </div>
                                        <div class="payxnowandrestondelivery-flex-col">

                                                <div class="flex-row">
                                                        <label for="">Add to cart button color</label>
                                                        <input type="text" data-jscolor="{}" name="add_cart_btn_color" value="<?php echo (isset($gtbtncolor[0]->add_cart_btn_color) ? $gtbtncolor[0]->add_cart_btn_color : ''); ?>">
                                                </div>
                                                <div class="flex-row">
                                                        <label for="">Add to cart button text color</label>
                                                        <input type="text" data-jscolor="{}" name="add_cart_txt_color" value="<?php echo (isset($gtbtncolor[0]->add_cart_text_color) ? $gtbtncolor[0]->add_cart_text_color : ''); ?>">
                                                </div>
                                        </div>





                                </div>

                                <div class="payxnowandrestondelivery-row2 payxnowandrestondelivery-form-wrap">
                                        <div class="payxnowandrestondelivery-flex-row">
                                                <div class="payxnowandrestondelivery-flex-col">

                                                        <div class="btn-end-form-col">
                                                                <div class="payxnowandrestondeliver-checkbox-wrap">
                                                                        <input type="checkbox" <?php echo (isset($gtbtncolor[0]->buy_partial_btn) && $gtbtncolor[0]->buy_partial_btn == '1') ? 'checked' : ''; ?> class="splite_checkbox" id="partby" onclick="toggleTextBox('partby', 'partialbuy')" name="cart_show_btn[]" value="buywithpartial">
                                                                        <label for="partby">Enable Partial Payment Button</label>
                                                                </div>
                                                                <div id="partialbuy" class="partial-text-row" <?php echo (isset($gtbtncolor[0]->buy_partial_btn) && $gtbtncolor[0]->buy_partial_btn == '1') ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                                                        <label for="">Change Partial Pay Button Text </label>
                                                                        <input type="text" name="partialbuybtntext" value="<?php echo (isset($gtbtncolor[0]->partial_buy_now_text) ? $gtbtncolor[0]->partial_buy_now_text : ''); ?>">
                                                                        <div class="form-small-taxt">
                                                                                <p>Pay 10% now rest at delivery</p>
                                                                        </div>
                                                                </div>
                                                        </div>


                                                </div>

                                                <div class="payxnowandrestondelivery-flex-col">

                                                        <div class="flex-row">
                                                                <label for="">Partial buy now button color</label>
                                                                <input type="text" data-jscolor="{}" name="partialbuy_btn_color" value="<?php echo (isset($gtbtncolor[0]->partial_buynow_btn_color) ? $gtbtncolor[0]->partial_buynow_btn_color : ''); ?>">
                                                        </div>
                                                        <div class="flex-row">
                                                                <label for="">Partial buy now button text color</label>
                                                                <input type="text" data-jscolor="{}" name="partialbuy_txt_color" value="<?php echo (isset($gtbtncolor[0]->partial_buynow_text_color) ? $gtbtncolor[0]->partial_buynow_text_color : ''); ?>">
                                                        </div>

                                                </div>

                                        </div>
                                </div>

                                <div class="payxnowandrestondelivery-row3 payxnowandrestondelivery-form-wrap">
                                        <div class="payxnowandrestondelivery-flex-row">
                                                <div class="payxnowandrestondelivery-flex-col">

                                                        <div class="payxnowandrestondeliver-checkbox-wrap">
                                                                <input type="checkbox" <?php echo (isset($gtbtncolor[0]->full_pay_buybtn) && $gtbtncolor[0]->full_pay_buybtn == '1') ? 'checked' : ''; ?> class="splite_checkbox" id="fullbuysplit" name="cart_show_btn[]" value="fullbuynow">
                                                                <label for="fullbuysplit">Enable buy now Button</label>
                                                        </div>
                                                </div>
                                                <div class="payxnowandrestondelivery-flex-col">
                                                        <div class="flex-row">
                                                                <label for="">Full buy now button color</label>
                                                                <input type="text" data-jscolor="{}" name="fullbuy_btn_color" value="<?php echo (isset($gtbtncolor[0]->full_buy_btn_color) ? $gtbtncolor[0]->full_buy_btn_color : ''); ?>">
                                                        </div>
                                                        <div class="flex-row">
                                                                <label for="">Full buy now button text color</label>
                                                                <input type="text" data-jscolor="{}" name="fullbuy_txt_color" value="<?php echo (isset($gtbtncolor[0]->full_buy_text_color) ? $gtbtncolor[0]->full_buy_text_color : ''); ?>">
                                                        </div>
                                                </div>


                                        </div>
                                </div>

                                <div class="payxnowandrestondelivery-btn-row">

                                        <div class="btn-row payxnowandrestondelivery-submit-btn" style="margin-top: 10px;">
                                                <button type="submit" name="track_cart_config" class="payxnowandrestondelivery-button payxnowandrestondelivery-main-cta payxnowandrestondelivery-btn-end" value="submit">Submit</button>
                                        </div>

                                </div>
                        </form>
                </div>

                <?php //} 
                ?>

        </div>
</div>

</div>
<script type="text/javascript">
        function validate_chkcart() {
                var checkboxes = document.querySelectorAll('.splite_checkbox');
                var isChecked = false;
                checkboxes.forEach(function(checkbox) {
                        if (checkbox.checked) {
                                isChecked = true;
                        }
                });

                if (isChecked) {
                        return true; // Form will be submitted
                } else {
                        document.getElementById('cart_error').innerHTML = 'Please select at least one option';
                        return false;

                }
        }

        function toggleTextBox(checkboxId, textboxId) {
                var checkbox = document.getElementById(checkboxId);
                var textbox = document.getElementById(textboxId);

                textbox.style.display = checkbox.checked ? 'block' : 'none';

                if (!checkbox.checked && textboxId == "handliongtt") {
                        $.ajax({
                                type: "POST",
                                url: "disbale_handling_charge",
                                data: 'shop=<?php echo $_GET['shop'];?>&disbale_handling_charge=true',
                                success: function(response) {
                                        
                                }

                        });
                }
        }
</script>