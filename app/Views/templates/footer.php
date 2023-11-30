<!-- FOOTER: DEBUG INFO + COPYRIGHTS -->
<!-- script files -->



</body>

</html>
<?php
$shop_name = explode(".", $_GET['shop']);
$fstore_name = $shop_name[0];
?>
<!-- SCRIPTS -->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="/shopifypartialapp/public/custom.js"></script> -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
    function myFunction() {

        $(".payxnowandrestondelivery-header-nav-links").toggleClass("payxnowandrestondelivery-show");
        $(this).toggleClass("payxnowandrestondelivery-animated");

        // $(".payxnowandrestondelivery-header-nav-links").toggle();
        // return false;

    }

    function new_window_opensplit2ship(event) {
        event.preventDefault();
        var href = event.currentTarget.getAttribute('href')
        top.window.location = href;
        //top.window.open(href, '_blank');
    }

    function abc(event) {
        event.preventDefault();
        var href = event.currentTarget.getAttribute('href')
        top.window.location = href;
    }

    function abc2(event) {
        event.preventDefault();
        var condg = confirm('Are you sure want to remove?');
        //alert(condg);
        if (condg == true) {
            var href = event.currentTarget.getAttribute('href')
            top.window.location = href;
        }

    }
    if (ship_provder == 'ship_roc') {
        $("#ship_roc").show();
        $("#delhivery").hide();
        $("#pickr").hide();
        $("#ship_email").prop('required', true);
        $("#ship_pwd").prop('required', true);
        $("#ship_chnl_id").prop('required', true);
        $("#ship_token").prop('required', false);
        $("#ship_from").prop('required', false);
        $("#ship_token_delh").prop('required', false);
        $("#pick_up_location").prop('required', false);
        $("#pickrr_company").prop('required', false);
        $("#pickrr_phone").prop('required', false);
        $("#pickrr_pincode").prop('required', false);
    } else if (ship_provder == 'delhivery') {
        $("#ship_roc").hide();
        $("#delhivery").show();
        $("#pickr").hide();
        $("#ship_email").prop('required', false);
        $("#ship_pwd").prop('required', false);
        $("#ship_chnl_id").prop('required', false);
        $("#ship_token").prop('required', false);
        $("#ship_from").prop('required', false);
        $("#ship_token_delh").prop('required', true);
        $("#pick_up_location").prop('required', true);
        $("#pickrr_company").prop('required', false);
        $("#pickrr_phone").prop('required', false);
        $("#pickrr_pincode").prop('required', false);
    } else if (ship_provder == 'pickr') {
        $("#ship_roc").hide();
        $("#delhivery").hide();
        $("#pickr").show();
        $("#ship_email").prop('required', false);
        $("#ship_pwd").prop('required', false);
        $("#ship_chnl_id").prop('required', false);
        $("#ship_token_delh").prop('required', false);
        $("#ship_token").prop('required', true);
        $("#ship_from").prop('required', true);
        $("#pick_up_location").prop('required', false);
        $("#pickrr_company").prop('required', true);
        $("#pickrr_phone").prop('required', true);
        $("#pickrr_pincode").prop('required', true);
    }

    $('#delivery_partner').on('change', function(e) {
        var delivery_partner = $("#delivery_partner").val();
        if (delivery_partner == 'ship_roc') {
            $("#ship_roc").show();
            $("#delhivery").hide();
            $("#pickr").hide();
            $("#ship_email").prop('required', true);
            $("#ship_pwd").prop('required', true);
            $("#ship_chnl_id").prop('required', true);
            $("#ship_token").prop('required', false);
            $("#ship_from").prop('required', false);
            $("#ship_token_delh").prop('required', false);
            $("#pick_up_location").prop('required', false);
            $("#pickrr_company").prop('required', false);
            $("#pickrr_phone").prop('required', false);
            $("#pickrr_pincode").prop('required', false);
        } else if (delivery_partner == 'delhivery') {
            $("#ship_roc").hide();
            $("#delhivery").show();
            $("#pickr").hide();
            $("#ship_email").prop('required', false);
            $("#ship_pwd").prop('required', false);
            $("#ship_chnl_id").prop('required', false);
            $("#ship_token").prop('required', false);
            $("#ship_from").prop('required', false);
            $("#ship_token_delh").prop('required', true);
            $("#pick_up_location").prop('required', true);
            $("#pickrr_company").prop('required', false);
            $("#pickrr_phone").prop('required', false);
            $("#pickrr_pincode").prop('required', false);
        } else if (delivery_partner == 'pickr') {
            $("#ship_roc").hide();
            $("#delhivery").hide();
            $("#pickr").show();
            $("#ship_email").prop('required', false);
            $("#ship_pwd").prop('required', false);
            $("#ship_chnl_id").prop('required', false);
            $("#ship_token_delh").prop('required', false);
            $("#ship_token").prop('required', true);
            $("#ship_from").prop('required', true);
            $("#pick_up_location").prop('required', false);
            $("#pickrr_company").prop('required', true);
            $("#pickrr_phone").prop('required', true);
            $("#pickrr_pincode").prop('required', true);
        }
        if (delivery_partner != "") {
            var shopname = '<?php echo esc($_GET['shop']); ?>';
            $.ajax({
                type: "POST",
                url: "get_shipping_partners",
                data: 'shop=' + shopname + '&delv_parnter=' + delivery_partner,
                dataType: "json",
                success: function(response) {

                    if (delivery_partner == 'ship_roc') {
                        $("#ship_email").val(response['email']);
                        $("#ship_pwd").val(response['password']);
                        //$("#ship_chnl_id").val(response['channel_id']);
                    } else if (delivery_partner == 'delhivery') {
                        $("#ship_token_delh").val(response['token']);
                    }
                    if (delivery_partner == 'pickr') {
                        $("#ship_token").val(response['token']);
                        $("#ship_from").val(response['shipping_address']);
                    }
                }

            });
            return false;
        }

    });

    $('#get_coll').on('change', function(e) {
        var sel_val = $("#get_coll").val();
        // var v_name = $("#vendor_name option:selected").text();
        if (sel_val == '') {
            top.window.location = 'https://admin.shopify.com/store/<?php echo esc($fstore_name); ?>/apps/pay-x-now-rest-on-delivery/products-list';
        } else {

            top.window.location = 'https://admin.shopify.com/store/<?php echo esc($fstore_name); ?>/apps/pay-x-now-rest-on-delivery/products-list?collectionparms=' + sel_val;
        }

    });

    $('#get_coll_home').on('change', function(e) {
        var sel_val = $("#get_coll_home").val();
        // var v_name = $("#vendor_name option:selected").text();
        if (sel_val == '') {
            top.window.location = 'https://admin.shopify.com/store/<?php echo esc($fstore_name); ?>/apps/pay-x-now-rest-on-delivery';
        } else {
            top.window.location = 'https://admin.shopify.com/store/<?php echo esc($fstore_name); ?>/apps/pay-x-now-rest-on-delivery?collectionparms=' + sel_val;
        }

    });


    $('.payxnowandrestondelivery-pag_btn').on('click', function(e) {
        $('.payxnowandrestondelivery-pag_btn').removeClass('active');
        var data_info = $(this).attr('data-info');
        var data_rel = $(this).attr('data-rel');
        var data_store = $(this).attr('data-store');
        var vendor_name = $("#vendor_name").val();
        var sel_val = $(".colidchk").val();
        var srchtctval = $(".srchtctval").val();
        if (data_info != "") {
            $('[data-rel=' + data_rel + ']').addClass('active');
        }



        if (data_info != '') {

            $.ajax({
                type: "GET",
                url: "product-pagination",
                data: {
                    page_info: data_info,
                    rel: data_rel,
                    shop: data_store,
                    url: data_store,
                    coll_id: sel_val,
                    vend_id: vendor_name,
                    search_text: srchtctval

                },

                dataType: "json",

                success: function(response) {
                    if (response['prev'] != '') {
                        $('button[data-rel="previous"]').attr('data-info', response['prev']);
                    } else {
                        $('button[data-rel="previous"]').attr('data-info', "");
                    }
                    if (response['next'] != '') {
                        $('button[data-rel="next"]').attr('data-info', response['next']);
                    } else {
                        $('button[data-rel="next"]').attr('data-info', "");
                    }
                    if (response['html'] != '') {
                        $('#product-list').html(response['html']);
                    }
                }

            });

        }



    });

    $('.payxnowandrestondelivery-pag_btn_home').on('click', function(e) {
        $('.payxnowandrestondelivery-pag_btn_home').removeClass('active');
        var data_info = $(this).attr('data-info');
        var data_rel = $(this).attr('data-rel');
        var data_store = $(this).attr('data-store');
        var vendor_name = $("#vendor_name").val();
        var sel_val = $("#get_coll").val();
        if (data_info != "") {
            $('[data-rel=' + data_rel + ']').addClass('active');
        }
        if (data_info != '') {

            $.ajax({
                type: "GET",
                url: "home-product-pagination",
                data: {
                    page_info: data_info,
                    rel: data_rel,
                    shop: data_store,
                    url: data_store,
                    coll_id: sel_val,
                    vend_id: vendor_name

                },

                dataType: "json",

                success: function(response) {
                    if (response['prev'] != '') {
                        $('button[data-rel="previous"]').attr('data-info', response['prev']);
                    } else {
                        $('button[data-rel="previous"]').attr('data-info', "");
                    }
                    if (response['next'] != '') {
                        $('button[data-rel="next"]').attr('data-info', response['next']);
                    } else {
                        $('button[data-rel="next"]').attr('data-info', "");
                    }
                    if (response['html'] != '') {
                        $('#product-list').html(response['html']);
                    }
                }

            });

        }
    });

    $('.partial_update_price').on('click', function(e) {
        // alert('ddd');
        const trvd = new Date();
        let track_req_time = trvd.getTime();
        var this_id_frm = $(this).attr('subid');
        var partial_percentage = $("#partial_textinput_" + this_id_frm).val();
        var update_id = $("#partial_textinput_" + this_id_frm).val();
        var priid = $("#priid_" + this_id_frm).val();
        var shopname = '<?php echo esc($_GET['shop']); ?>';

        var gettpe = "";
        if (shopname == 'desinomatetest.myshopify.com') {
            var selectval = $("#change_type_" + this_id_frm).val();
            gettpe = "&parttype=" + $("#change_type_" + this_id_frm).val();
        } else {
            gettpe = "&parttype=''";
        }


        $.ajax({
            type: "POST",
            url: "track_partial_percentage?rqtme=" + track_req_time,
            data: 'shop=' + shopname + '&update_per=true&change_partial=' + partial_percentage + '&update_id=' + this_id_frm + '&proid=' + priid + gettpe,
            success: function(response) {
                $("#show_per_" + this_id_frm).show();
                $("#show_per_" + this_id_frm).html(response);
                $("#show_per_text_" + this_id_frm).hide();
                if (shopname == 'desinomatetest.myshopify.com') {

                    $("#show_per_type_" + this_id_frm).show();
                    $("#show_per_type_" + this_id_frm).html(selectval);
                    $("#show_per_select_" + this_id_frm).hide();
                }
            }

        });
        return false;
    });

    $('.partial_update_price_lates').on('click', function(e) {
        // alert('ddd');
        const trvd = new Date();
        let track_req_time = trvd.getTime();
        var this_id_frm = $(this).attr('subid');
        var formdata = $("#sub_form_data_" + this_id_frm).serialize();
        var shopname = '<?php echo esc($_GET['shop']); ?>';
        var priid = $("#priid_" + this_id_frm).val();
        var gettpe = "";
        if (shopname == 'desinomatetest.myshopify.com') {
            var selectval = $("#change_type_" + this_id_frm).val();
            gettpe = "&parttype=" + $("#change_type_" + this_id_frm).val();
        } else {
            gettpe = "&parttype=''";
        }
        $.ajax({
            type: "POST",
            url: "track_partial_percentage?rqtme=" + track_req_time,
            data: 'shop=' + shopname + '&update_per=true&' + formdata + gettpe,
            success: function(response) {

                $("#show_per_" + this_id_frm).show();
                $("#show_per_" + this_id_frm).html(response);
                $("#show_per_text_" + this_id_frm).hide();
                if (shopname == 'desinomatetest.myshopify.com') {
                    $("#show_per_type_" + this_id_frm).show();
                    $("#show_per_type_" + this_id_frm).html(selectval);
                    $("#show_per_select_" + this_id_frm).hide();
                }


            }

        });
        return false;
    });
    $('#store_user_trk').on('submit', function(e) {
        $("#ermsg").html('');
        var formdata = $("#store_user_trk").serialize();
        var shopname = '<?php echo esc($_GET['shop']); ?>';
        $.ajax({
            type: "POST",
            url: "shiprocket-config",
            data: 'shop=' + shopname + '&save_users=true&' + formdata,
            success: function(response) {
                var splitresposn = response.split("_");
                if (splitresposn[0] == "error") {
                    $("#ermsg").html(splitresposn[1]);
                    $("#ermsg").css('color', 'red');
                } else {
                    $("#ermsg").html(splitresposn[1]);
                    $("#ermsg").css('color', 'green');
                }


                // setTimeout(function() {
                //     $("#ermsg").hide('blind', {}, 500)
                // }, 5000);
                // $("#show_per_" + this_id_frm).show();
                // $("#show_per_" + this_id_frm).html(response);
                // $("#show_per_text_" + this_id_frm).hide();
            }

        });
        return false;
    });

    $("#checkAll").click(function() {

        if ($(this).prop("checked")) {
            // let ddtatrr = $(this).attr('dattatrr');
            // console.log(ddtatrr);
            //$(".chkSelect").prop("checked", true);
            $("[dattatrr=not_added]").prop("checked", true);
        } else {
            $(".payxnowandrestondelivery-chkSelect").prop("checked", false);
        }

        //$('input:checkbox').not(this).prop('checked', this.checked);
    });

    //call ajax for track user log into database

    var shopname = '<?php echo esc($_GET['shop']); ?>';
    $.ajax({
        type: "GET",
        url: "track_userinf",
        data: 'shop=' + shopname,
        success: function(response) {}

    });

    $(document).ready(function() {
        // Attach a submit event handler to the form
        $("#zipcsvform").submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            // var formData = new FormData(this); // Create a FormData object

            //var formData = $("#zipcsvform").serialize();
            var formData = new FormData(this);
            $("#filmsg").html("Please wait while uploading...");
            // Send an AJAX POST request to the server
            $.ajax({
                type: "POST",
                url: "trackcsvdata", // Replace with your server-side script URL
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    document.getElementById('zipcsvform').reset();
                    if (response == "invalid") {
                        $("#filmsg").html("Please select any csv file");
                        $("#filmsg").css("color", "red");
                    } else if (response == "invalid_format") {
                        $("#filmsg").html("Please select only csv file");
                        $("#filmsg").css("color", "red");
                    } else if (response == "done") {
                        $("#filmsg").html("File upload successfully");
                        $("#filmsg").css("color", "green");
                        $("#clickfile").css("display", "none");
                        $("#export_id").css("display", "inline-block");
                        $("#export_id").html('<a onclick="abc(event);" href="https://app.payxnowandrestondelivery.com/exporcsv?shop=<?php echo $_GET['shop']; ?>" class="postal-btn">Export All</a>');
                    }
                    // Handle the server's response here
                    // console.log("Server response:", response);
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    //console.error("Error:", error);
                },
            });
        });
    });
</script>

<!-- -->
<!-- <script src="https://unpkg.com/@shopify/app-bridge@3"></script> -->
<script>
    // var AppBridge = window['app-bridge'];
    // var actions = window['app-bridge'].actions;
    // var createApp = AppBridge.default;

    // const config = {
    //     apiKey: 'a47ead69b3d83a8042703f093f3cadb2',
    //     host: new URLSearchParams(location.search).get("host"),
    //     forceRedirect: true
    // };
    // const app = createApp(config);
</script>
</body>

</html>