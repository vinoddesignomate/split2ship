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

        @media only screen and (max-width: 767px) {
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
<div class="payxnowandrestondelivery-whiteAreaDiv payxnowandrestondelivery-container">
        <div class="payxnowandrestondelivery-main-heading payxnowandrestondelivery-back-heading">
                <h5> <a onclick='abc(event);' href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/">Back</h5></a>
        </div>
        <form method="post">
                <table>
                        <tr>
                                <td>Partial payment checkout button color</td>
                                <td><input type="text" name="partbtn_color" id=""></td>
                        </tr>
                        <tr>
                                <td>Full payment checkout button color</td>
                                <td><input type="text" name="fullbtn_color" id=""></td>
                        </tr>
                        <tr>
                                
                                <td><button type="submit" name="track_color" value="submit">Submit</button></td>
                        </tr>
                </table>
        </form>
        <div class=" payxnowandrestondelivery-main-area ">

                <h5><b class="text-orange">Step 1:</b> Login to your Shopify store and go to your theme under online .</h5>

                <div class="payxnowandrestondelivery-imgIns"><img src="/public/images/instruct/config1.webp" /></div>
        </div>
        <div class=" payxnowandrestondelivery-main-area ">
                <h5><b class="text-orange">Step 2:</b> click on “Customize” the theme.</h5>

                <div class="payxnowandrestondelivery-imgIns"><img src="/public/images/instruct/config2.webp" /></div>
        </div>
        <div class=" payxnowandrestondelivery-main-area ">
                <h5><b class="text-orange">Step 3:</b> Select default product under product drop down.</h5>

                <div class="payxnowandrestondelivery-imgIns"><img src="/public/images/instruct/config3.webp" /></div>
        </div>
        <div class="payxnowandrestondelivery-main-area-row">
                <div class=" payxnowandrestondelivery-main-area ">
                        <h5><b class="text-orange">Step 4:</b> click on “App embeds” in left sidebar. Activate App like this</h5>

                        <div class="payxnowandrestondelivery-imgIns"><img src="/public/images/instruct/app-embed.webp?var=1" /></div>
                </div>
                <div class=" payxnowandrestondelivery-main-area ">
                        <h5><b class="text-orange">Step 5:</b> Add section where you want to show partial and full pay.</h5>

                        <div class="payxnowandrestondelivery-imgIns"><img src="/public/images/instruct/step-5.webp?var=2" /></div>
                </div>
        </div>
        <div class=" payxnowandrestondelivery-main-area ">
                <h5><b class="text-orange">Step 6:</b> App section will show like this.</h5>

                <div class="payxnowandrestondelivery-imgIns"><img src="/public/images/instruct/config6.webp?var=3" /></div>
        </div>
        <div class="payxnowandrestondelivery-main-area-row ">
                <div class="payxnowandrestondelivery-main-area ">
                        <h5><b class="text-orange">Step 7:</b> For change into Order confirmation email add below code in email template above order summary.</h5>
                        <div><textarea style="max-width: 624px; height: 84px;width: 100%;">{% if order.tags != blank %}<p>Product price has been split into 2 parts thus price has changed in the order email. Actual Product Price = Product price + Partial pending payment - product name</p>{% endif %}</textarea>
                        </div>
                </div>
                <div class=" payxnowandrestondelivery-main-area ">
                        <h5><b class="text-orange">Step 8:</b> For change into Order confirmation email add below code in email template after {{ line_title }}.</h5>
                        <div><textarea style="max-width: 624px; height: 84px;width: 100%;">{% if line.properties.Note == 'Initial Partial Payment'%}<span>Partial Amount={{line.properties.partial_pay}}</span><br/><span>Pending Amount={{line.properties.remaining_amount}}</span><br/>{% endif %}</textarea></div>
                </div>
        </div>
        <div class="payxnowandrestondelivery-main-area-row ">
                <div class=" payxnowandrestondelivery-main-area ">
                        <h5> <b class="text-orange">Step 9: </b>add below code in confirmation email at the end of template.</h5>
                        <div><textarea style="max-width: 624px; height: 84px;width: 100%;">{% if order.tags != blank %}Actual Product Price = Product price + Partial pending payment - product name{% endif %}</textarea></div>
                </div>
                <div class=" payxnowandrestondelivery-main-area ">
                        <h5><b class="text-orange">Step 10:</b> add below code in refund email template above order summary.</h5>
                        <div><textarea style="max-width: 624px; height: 84px;width: 100%;">{% if order.tags != blank %}<span>If you had placed a partially paid order then only paid amount will be refunded</span>{% endif %}</textarea>
                        </div>
                </div>
                <div class=" payxnowandrestondelivery-main-area ">
                        <h5><b class="text-orange">Step 11:</b> add below code in Invoice email.</h5>
                        <div><textarea style="max-width: 624px; height: 84px;width: 100%;"> {% if order.tags != blank %}{% else %}
               <span><td class="button__cell"><a href="{{ checkout_payment_collection_url }}" class="button__text">Pay now</a></td></span> {% endif %}</textarea>
                        </div>

                        <h5><b class="text-orange"></b> Place of this code.</h5>
                        <div><textarea style="max-width: 624px; height: 84px;width: 100%;"> <span><td class="button__cell"><a href="{{ checkout_payment_collection_url }}" class="button__text">Pay now</a></td></span></textarea>
                        </div>
                </div>
        </div>
</div>

</div>