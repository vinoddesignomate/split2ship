<div class="formContainer customInput" style="--bg-color: #000000; --opacity: 0.50; --radius: 24px;">
    <form action="post">
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
            <div class="Polaris-Stack__Item"><button id="getorderinfo" class="_xButton_l3r25_2 _active_l3r25_41" style="cursor: pointer;"><span class="_content_l3r25_56"><span>Create return</span></span></button></div>
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
                        setCookie('orderid', response.order_id, 365);
                        document.getElementById('Polaris-Heading_head').innerHTML = "Order number: #" + response.order_num;
                        document.getElementById('Polaris-Heading_date').innerHTML = response.order_date;

                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });

            //select order info by order id
            document.getElementById("getorderinfo").addEventListener("click", function() {
                var orderid = getCookie('orderid');

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
                        //console.log(response);
                        const exhcshow_orders = document.querySelector(".Polaris-Layout__Section");
                        if (exhcshow_orders) {
                            exhcshow_orders.style.display = "block";
                        }
                        setCookie('orderid', response.order_id, 365);
                        document.getElementById('Polaris-Heading_head').innerHTML = "Order number: #" + response.order_num;
                        document.getElementById('Polaris-Heading_date').innerHTML = response.order_date;

                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });

        });

        function setCookie(cname, cvalue, exdays) {
            const d = new Date();
            d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
            let expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        function getCookie(cname) {
            let name = cname + "=";
            let ca = document.cookie.split(";");
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == " ") {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

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