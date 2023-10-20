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
        </div><button id="split_exchng" type="button" class="_xButton_l3r25_2 _fromLogin_l3r25_22 _block_l3r25_38" style="cursor: default;"><span class="_content_l3r25_56"><span>Start Your Return</span></span></button><span style="text-align: center; word-break: break-word;"><span class="Polaris-TextStyle--variationSubdued">You have a maximum of 30 days from the date of your purchase to make a return.</span></span>
        <div class="line"></div><span class="cursor-pointer leading-[24px]">View the full return policy</span>
    </form>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {

            var inputField = document.getElementById("order_number_val");
            inputField.addEventListener("input", function() {
                // This function will be called whenever the user enters or changes text.
                //alert('get enter');
                const enteredText = inputField.value;
                console.log("Entered text: " + enteredText);
            });

            document.getElementById("split_exchng").addEventListener("click", function() {

                var send_data = JSON.stringify({
                    'shopname': '<?php echo $_GET['shop']; ?>'
                });

                fetch('https://app.payxnowandrestondelivery.com/fetch-order', {
                        method: 'POST',
                        body: send_data
                    })
                    .then(response => response.text())
                    .then(response => {


                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });

        });
    </script>