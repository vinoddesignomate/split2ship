<style>
    .boxesMain09 {
        width: 100%;
        box-sizing: border-box;
        float: left;
        clear: both;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        box-shadow: 0px 1px 2px #cccccc7a;
        padding: 25px;
        border-radius: 15px;
    }

    .boxesMain09 .forIMGpurpose {
        width: 25%;
        border: 1px solid #ccc;
        box-sizing: border-box;
        border-radius: 15px;
        float: left;
    }

    .boxesMain09 .forIMGpurpose img {
        width: 100%;
    }

    .boxesMain09 .forTextpurpose {
        width: 75%;
        box-sizing: border-box;
        padding-left: 30px;
        float: left;
    }

    .forTextpurpose h4 {
        font-size: 18px;
        color: #000;
        margin: 0 0 20px 0;
        font-weight: normal;
        line-height: 1.4;
    }

    .forTextpurpose h5 {
        font-size: 14px;
        color: #000;
        margin: 0 0 20px 0;
        font-weight: normal;
        line-height: 1.4;
    }

    .boxesMain09 .reasonDefine {
        border-top: 1px solid #ccc;
        margin: 0;
        float: left;
        width: 100%;
        padding: 0;
        margin-top: 25px;
        padding-top: 25px;
    }

    .boxesMain09 .reasonDefine h6 {
        font-size: 15px;
        color: #000;
        margin: 0;
        font-weight: normal;
        line-height: 1.4;
    }

    .boxesMain09 .reasonDefine h6 span {
        color: #666;
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
</style>
<div class="formContainer customInput" style="--bg-color: #000000; --opacity: 0.50; --radius: 24px;">
    <form action="post" id="input_start_process">
        <div class="headerForm">Return Center</div>
        <div class="noShadowInputContainer removeTop">
            <div class="">
                <div class="Polaris-Labelled__LabelWrapper">
                    <div class="Polaris-Label"><label id="order_number_valLabel" for="order_number_val" class="Polaris-Label__Text">Order Number</label></div>
                </div>
                <div class="Polaris-Connected">
                    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                        <div class="Polaris-TextField"><input id="order_number_val" autocomplete="off" class="Polaris-TextField__Input Polaris-TextField__Input--hasClearButton" type="text" aria-labelledby="order_number_valLabel" aria-invalid="false" value="">
                            <div class="Polaris-TextField__Backdrop"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="noShadowInputContainer removeTop">
            <div class="">
                <div class="Polaris-Labelled__LabelWrapper">
                    <div class="Polaris-Label"><label id="order_email_valLabel" for="order_email_val" class="Polaris-Label__Text">Email Address</label></div>
                </div>
                <div class="Polaris-Connected">
                    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                        <div class="Polaris-TextField"><input id="order_email_val" autocomplete="off" class="Polaris-TextField__Input Polaris-TextField__Input--hasClearButton" type="email" aria-labelledby="order_email_valLabel" aria-invalid="false" value="">
                            <div class="Polaris-TextField__Backdrop"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div><button id="split_exchng" type="button" class="_xButton_l3r25_2 _fromLogin_l3r25_22 _block_l3r25_38" disabled style="cursor: default;"><span class="_content_l3r25_56"><span>Start Your Return</span></span></button><span style="text-align: center; word-break: break-word;"><span class="Polaris-TextStyle--variationSubdued">You have a maximum of 30 days from the date of your purchase to make a return.</span></span>
        <div class="line"></div><span class="cursor-pointer leading-[24px]">View the full return policy</span>
    </form>



    <div style="display:none" class="Polaris-Layout__Section">
        <div class="Polaris-Stack Polaris-Stack--alignmentCenter">
            <div class="Polaris-Stack__Item Polaris-Stack__Item--fill">
                <div class="_titleContainer_y6eic_2">
                    <h2 id="Polaris-Heading_head" class="Polaris-Heading"> </h2>
                    <span id="Polaris-Heading_date" class="Polaris-TextStyle--variationSubdued"></span>
                </div>
            </div>
            <input type="hidden" id="ordif" name="ordid" value="" />
            <div class="Polaris-Stack__Item"><button id="getorderinfo" class="_xButton_l3r25_2 _active_l3r25_41" style="cursor: pointer;"><span class="_content_l3r25_56"><span>Create return</span></span></button></div>
        </div>
    </div>
    <div>
        <form method="post">
            <div id="order_info">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div id="popup_config" style="display:none;" class="popup-container config_popup">
        <div class="popup-content">

            <p id="plmsg_config">Please visit the page first to review the installation instructions for the app. Alternatively, you can reach out to us via WhatsApp at <a onclick="abc(event);" href="tel:+919354200590">9354200590</a>, or send us an email at <a onclick="abc(event);" href="mailto:saurabh@cgcolors.com">saurabh@cgcolors.com</a>. <br /><br />Our Shopify expert will then proceed to install and configure the app on your store. This process typically takes no more than 30 minutes.</p>

        </div>
    </div>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {

            var inputField = document.getElementById("order_number_val");
            var inputField2 = document.getElementById("order_email_val");
            inputField.addEventListener("input", getinpoutdata);
            inputField2.addEventListener("input", getinpoutdata);

            document.getElementById("split_exchng").addEventListener("click", function() {
                var ordernum = document.getElementById("order_number_val");
                var emailfields = document.getElementById("order_email_val");
                var orderf = "";
                var emailf = "";
                if (ordernum) {
                    orderf = ordernum.value;
                }
                if (emailfields) {
                    emailf = emailfields.value;
                }
                var send_data = JSON.stringify({
                    'shopname': '<?php echo $_GET['shop']; ?>',
                    'ordernum': orderf,
                    'emailf': emailf,
                });

                fetch('https://app.payxnowandrestondelivery.com/fetch-order', {
                        method: 'POST',
                        body: send_data
                    })
                    .then(response => response.json())
                    .then(response => {
                        //console.log(response);
                        const exhcshow_orders = document.querySelector(".Polaris-Layout__Section");
                        if (exhcshow_orders) {
                            exhcshow_orders.style.display = "block";
                        }
                        document.getElementById('input_start_process').style.display = "none";

                        document.getElementById('ordif').value = response.order_id;
                        document.getElementById('Polaris-Heading_head').innerHTML = "Order number: #" + response.order_num;
                        document.getElementById('Polaris-Heading_date').innerHTML = response.order_date;

                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });

            // Get a reference to your checkbox element
            // var plorischeckbox = document.querySelector('.Polaris-Checkbox__Input');

            // Add an event listener to the checkbox
            document.querySelector('body').addEventListener('click', function(event) {
                if (event.target.classList.contains('Polaris-Checkbox__Input')) {
                    var idattr = event.target.getAttribute('idattr');
                    if (event.target.checked) {
                        console.log(idattr);
                        document.getElementById("reason_" + idattr).style.display = 'inline-block';
                        // alert('Checkbox is checked!');

                        // var popup = document.getElementById("popup_config");
                        // popup.style.display = "block";
                        // var body = document.body;
                        // body.classList.add("package_popup_visible");

                    } else {
                        document.getElementById("reason_" + idattr).style.display = 'none';
                        //alert('Checkbox is unchecked!');
                    }
                }
            });


            //select order info by order id
            document.getElementById("getorderinfo").addEventListener("click", function() {
                var orderid = document.getElementById('ordif').value;

                var send_data = JSON.stringify({
                    'shopname': '<?php echo $_GET['shop']; ?>',
                    'orderid': orderid
                });

                fetch('https://app.payxnowandrestondelivery.com/fetch-order-info', {
                        method: 'POST',
                        body: send_data
                    })
                    .then(response => response.json())
                    .then(response => {
                        var infiohtm = "";
                        const exhcshow_orders = document.querySelector(".Polaris-Layout__Section");
                        if (exhcshow_orders) {
                            exhcshow_orders.style.display = "none";
                        }
                        document.getElementById('input_start_process').style.display = "none";
                        var lpid = 1;
                        for (var i = 0; i < response.length; i++) {
                            infiohtm += '<input type="hidden" name="getid" value="' + response[i]['varient_id'] + '"><div class="boxesMain09"><div class="forIMGpurpose"><img src="' + response[i]['product_image'] + '" /></div><div class="forTextpurpose"><h4>' + response[i]['product_name'] + '</h4><h5>' + response[i]['product_price'] + ' x ' + response[i]['product_qty'] + '</h5></div><div class="reasonDefine"><h6>Non Reason: <span>Unfulfilled</span></h6></div><span><input id="' + response[i]['varient_id'] + '" type="checkbox" idattr="' + lpid + '" class="Polaris-Checkbox__Input" aria-invalid="false" role="checkbox" aria-checked="false" value=""></span><select id="reason_' + lpid + '" style="display:none;" name="get_reason[]"><option>Arrive too late</option><option>Poor Quality</option><option>Looks Different</option><option>Does suit me</option><option>Parcel damaged on arrival</option><option>Poor Quality</option></select></div>';
                            lpid++;
                        }
                        document.getElementById('order_info').innerHTML = infiohtm;


                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });

        });

        function getinpoutdata() {
            var inputField = document.getElementById("order_number_val");
            var inputField2 = document.getElementById("order_email_val");
            var split_exchngButton = document.getElementById('split_exchng');
            var enteredText = inputField.value;
            var enteredText2 = inputField2.value;
            // console.log("Entered text: " + enteredText);
            // console.log("Entered text2: " + enteredText2);

            if (enteredText !== '' && enteredText2 !== '') {
                split_exchngButton.removeAttribute('disabled');
            } else {
                split_exchngButton.setAttribute('disabled', 'disabled');
            }

        }
    </script>