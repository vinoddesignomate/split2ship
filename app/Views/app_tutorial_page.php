<style>
        .text-orange {
                color: #F05523;
        }

        .payxnowandrestondelivery-main-area {
                padding: 25px;
                margin-bottom: 26px;
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
                gap: 39px;
                flex-wrap: wrap;
        }

        .payxnowandrestondelivery-zip-flex-row>div {
                flex: 1;
        }

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
                max-width: 500px;
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

        .video-wrapper iframe {
                max-width: 560px !important;
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

        .text-orange {
                color: #F05523;
        }

        .payxnowandrestondelivery-main-area p {
                font-family: Roboto;
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 154%;
        }

        .payxnowandrestondelivery-single-video-row {
                text-align: center;
                margin: 62px 0px 55px;
        }

        .payxnowandrestondelivery-single-video-row h2 {
                color: #F05523;

                text-align: center;
                font-family: Roboto;
                font-size: 20px;
                font-style: normal;
                font-weight: 700;
                line-height: 120%;
                letter-spacing: 0.1px;
                max-width: 645px;
                margin: 0 auto 12px;
        }

        .video-wrapper iframe {
                border-radius: 5px;
                background: #FFF;
                box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.03);
                padding: 13px;
        }

        .payxnowandrestondelivery-main-area.payxnowandrestondelivery-tutorial-main-area {
                padding: 25px 12px 12px;
                text-align: left;
        }

        .text-center {
                text-align: center;
        }

        .payxnowandrestondelivery-main-area.payxnowandrestondelivery-maintext {
                border: 1px dashed var(--ui-base-400, #d6d6d8);
        }
</style>
<script src="/public/jscolor.js"></script>
<div class="payxnowandrestondelivery-whiteAreaDiv payxnowandrestondelivery-container">
        <div class="payxnowandrestondelivery-main-heading payxnowandrestondelivery-back-heading">
                <h5> <a onclick='navigateToPage("https://admin.shopify.com/store/<?php echo htmlspecialchars($store_name); ?>/apps/pay-x-now-rest-on-delivery");' href="javascript:void(0);">Back</h5></a>
        </div>
        <!-- <div class="payxnowandrestondelivery-main-area text-center payxnowandrestondelivery-maintext">
                <p>Please make sure you go to configuration settings page first to check out to follow how to install the app instructions or you can drop us a whatsapp message - <a href="tel:9354200590" class="text-orange">9354200590</a> else send us an email to <a href="mailto: saurabh@cgcolors.com" class="text-orange">saurabh@cgcolors.com</a>. Our Shopify expert will install and configure the app on your store. This process does not take more than 30 minutes</p>
        </div> -->
        <div class="payxnowandrestondelivery-single-video-row">
                <h2>Split2Ship Installation and configuration | How to install Split2Ship app successfully | Spli2ship</h2>
                <div class="video-wrapper">
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/CH0OAgxvS8I?si=KH-bsxJwCmzokuqJ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
        </div>
        <div class="payxnowandrestondelivery-main-area-row ">
                <div class=" payxnowandrestondelivery-main-area payxnowandrestondelivery-tutorial-main-area">

                        <h5><b class="text-orange">Step 1:</b> Login to your Shopify store and go to your theme under online .</h5>

                        <div class="payxnowandrestondelivery-imgIns"><img src="/public/images/instruct/config1.webp" /></div>
                </div>
                <div class=" payxnowandrestondelivery-main-area payxnowandrestondelivery-tutorial-main-area">

                        <h5><b class="text-orange">Step 2:</b> Click on “Customize” the theme.</h5>

                        <div class="payxnowandrestondelivery-imgIns"><img src="/public/images/instruct/config2.webp" /></div>
                </div>
        </div>
        <div class="payxnowandrestondelivery-main-area-row ">
                <div class=" payxnowandrestondelivery-main-area payxnowandrestondelivery-tutorial-main-area">

                        <h5><b class="text-orange">Step 3:</b> Select default product under product drop down.</h5>

                        <div class="payxnowandrestondelivery-imgIns"><img src="/public/images/instruct/config3.webp" /></div>
                </div>
                <div class=" payxnowandrestondelivery-main-area payxnowandrestondelivery-tutorial-main-area">

                        <h5><b class="text-orange">Step 4:</b> Click on “App embeds” in left sidebar. Activate App like this.</h5>

                        <div class="payxnowandrestondelivery-imgIns"> <img style="width: 58%;" src="/public/images/instruct/app-embed.webp?var=1" /></div>
                </div>
        </div>
        <div class="payxnowandrestondelivery-single-video-row">
                <h2>How to edit the order confirmation email template, Order refund template and invoice template.</h2>
                <div class="video-wrapper">
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/SP6vDq3Xw50?si=wZ5iCt3A9BmoB5WD" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
        </div>
        <div class="payxnowandrestondelivery-main-area-row">
                <div class="payxnowandrestondelivery-main-area">
                        <h5><b class="text-orange">Step 5:</b> Replace this code with your theme's <b>Order Confirmation</b>
                                email template.</h5>
                        <div>
                                <textarea rows="44" style="width: 100%">
                {% capture email_title %}
                                {% if has_pending_payment %}
                                Thank you for your order!
                                {% else %}
                                Thank you for your purchase!
                                {% endif %}
                                {% endcapture %}
                                {% capture email_body %}
                                {% if has_pending_payment %}
                                {% if buyer_action_required %}
                                You’ll get a confirmation email after completing your payment.
                                {% else %}
                                Your payment is being processed. You'll get an email when your order is confirmed.
                                {% endif %}
                                {% else %}
                                {% if requires_shipping %}
                                {% case delivery_method %}
                                        {% when 'pick-up' %}
                                        You’ll receive an email when your order is ready for pickup.
                                        {% when 'local' %}
                                        Hi {{ customer.first_name }}, we're getting your order ready for delivery.
                                        {% else %}
                                        We're getting your order ready to be shipped. We will notify you when it has been sent.
                                {% endcase %}
                                        {% if delivery_instructions != blank  %}
                                        <p><b>Delivery information:</b> {{ delivery_instructions }}</p>
                                        {% endif %}
                                {% if consolidated_estimated_delivery_time %}
                                        <p>
                                        Estimated delivery <b>{{ consolidated_estimated_delivery_time }}</b>
                                        </p>
                                {% endif %}
                                {% endif %}
                                {% endif %}
                                {% assign gift_card_line_items = line_items | where: "gift_card" %}
                                {% assign found_gift_card_with_recipient_email = false %}
                                {% for line_item in gift_card_line_items %}
                                {% if line_item.properties["__shopify_send_gift_card_to_recipient"] and line_item.properties["Recipient email"] %}
                                {% assign found_gift_card_with_recipient_email = true %}
                                {% break %}
                                {% endif %}
                                {% endfor %}
                                {% if found_gift_card_with_recipient_email %}
                                <p>Your gift card recipient will receive an email with their gift card code.</p>
                                {% elsif gift_card_line_items.first %}
                                <p>You’ll receive separate emails for any gift cards.</p>
                                {% endif %}
                                {% endcapture %}

                                <!DOCTYPE html>
                                <html lang="en">
                                <head>
                                <title>{{ email_title }}</title>
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                                <meta name="viewport" content="width=device-width">
                                <link rel="stylesheet" type="text/css" href="/assets/notifications/styles.css">
                                <style>
                                .button__cell { background: {{ shop.email_accent_color }}; }
                                a, a:hover, a:active, a:visited { color: {{ shop.email_accent_color }}; }
                                </style>
                                </head>

                                <body>
                                <table class="body">
                                <tr>
                                        <td>
                                        <table class="header row">
                                <tr>
                                <td class="header__cell">
                                <center>

                                        <table class="container">
                                        <tr>
                                        <td>

                                        <table class="row">
                                                <tr>
                                                <td class="shop-name__cell">
                                                {%- if shop.email_logo_url %}
                                                <img src="{{shop.email_logo_url}}" alt="{{ shop.name }}" width="{{ shop.email_logo_width }}">
                                                {%- else %}
                                                <h1 class="shop-name__text">
                                                        <a href="{{shop.url}}">{{ shop.name }}</a>
                                                </h1>
                                                {%- endif %}
                                                </td>

                                                <td>
                                                <tr>
                                                        <td class="order-number__cell">
                                                        <span class="order-number__text">
                                                        Order {{ order_name }}
                                                        </span>
                                                        </td>
                                                </tr>
                                                {%- if po_number %}
                                                        <tr>
                                                        <td class="po-number__cell">
                                                        <span class="po-number__text">
                                                                PO number #{{ po_number }}
                                                        </span>
                                                        </td>
                                                        </tr>
                                                {%- endif %}
                                                </td>
                                                </tr>
                                        </table>

                                        </td>
                                        </tr>
                                        </table>

                                </center>
                                </td>
                                </tr>
                                </table>

                                        <table class="row content">
                                <tr>
                                <td class="content__cell">
                                <center>
                                        <table class="container">
                                        <tr>
                                        <td>
                                        
                                        <h2>{{ email_title }}</h2>
                                        <p>{{ email_body }}</p>
                                        {% assign transaction_count = transactions | size %}
                                {% if transaction_count > 0 %}
                                {% for transaction in transactions %}
                                {% if transaction.show_buyer_pending_payment_instructions? %}
                                        <p> {{transaction.buyer_pending_payment_notice}} </p>
                                        <p>
                                        <table class="row">
                                        <tr>
                                        {% for instruction in transaction.buyer_pending_payment_instructions %}
                                        <td>{{ instruction.header }}</td>
                                        {% endfor %}
                                        <td>Amount</td>
                                        </tr>
                                        <tr>
                                        {% for instruction in transaction.buyer_pending_payment_instructions %}
                                        <td>{{ instruction.value }}</td>
                                        {% endfor %}
                                        <td>{{transaction.amount | money}}</td>
                                        </tr>
                                        </table>
                                        </p>
                                {% endif %}
                                {% endfor%}
                                {% endif %}

                                        {% if order_status_url %}
                                        <table class="row actions">
                                <tr>
                                <td class="empty-line"> </td>
                                </tr>
                                <tr>
                                <td class="actions__cell">
                                <table class="button main-action-cell">
                                        <tr>
                                        <td class="button__cell"><a href="{{ order_status_url }}" class="button__text">View your order</a></td>
                                        </tr>
                                </table>
                                {% if shop.url %}
                                <table class="link secondary-action-cell">
                                <tr>
                                        <td class="link__cell">or <a href="{{ shop.url }}">Visit our store</a></td>
                                </tr>
                                </table>
                                {% endif %}

                                </td>
                                </tr>
                                </table>

                                        {% else %}
                                        {% if shop.url %}
                                <table class="row actions">
                                <tr>
                                        <td class="actions__cell">
                                        <table class="button main-action-cell">
                                        <tr>
                                        <td class="button__cell"><a href="{{ shop.url }}" class="button__text">Visit our store</a></td>
                                        </tr>
                                        </table>
                                        </td>
                                </tr>
                                </table>
                                {% endif %}

                                        {% endif %}

                                        </td>
                                        </tr>
                                        </table>
                                </center>
                                </td>
                                </tr>
                                </table>

                                        <table class="row section">
                                <tr>
                                <td class="section__cell">
                                <center>
                                        <table class="container">
                                        <tr>
                                        <td>
                                        <!-- {% if order.tags != blank %}<p>Product price has been split into 2 parts thus price has changed in the order email. Actual Product Price = Product price + Partial pending payment - product name</p>{% endif %} -->
                                        <h3>Order summary</h3>
                                        </td>
                                        </tr>
                                        </table>
                                        <table class="container">
                                        <tr>
                                        <td>
                                        
                                        
                                <table class="row">                                
                                {% for line in subtotal_line_items %}
                                <tr class="order-list__item">
                                <td class="order-list__item__cell">
                                <table>
                                        <td style="width: auto; float: left;">
                                        {% if line.image %}
                                        <img src="{{ line | img_url: 'compact_cropped' }}" align="left" width="60" height="60" class="order-list__product-image"/>
                                        {% endif %}
                                        </td>
                                        <td class="order-list__product-description-cell" style="width: 50%; text-align: left;float: left;" align="left">
                                        {% if line.product.title %}
                                        {% assign line_title = line.product.title %}
                                        {% else %}
                                        {% assign line_title = line.title %}
                                        {% endif %}

                                        {% if line.quantity < line.quantity %}
                                        {% capture line_display %} {{ line.quantity }} of {{ line.quantity }} {% endcapture %}
                                        {% else %}
                                        {% assign line_display = line.quantity  %}
                                        {% endif %}

                                        <span class="order-list__item-title">{{ line_title }} × {{ line_display }}</span>
                                        

                                        {% if line.variant.title != 'Default Title' %}
                                        <span class="order-list__item-variant">{{ line.variant.title }}</span><br/>
                                        {% endif %}

                                        {% for group in line.groups %}
                                        <span class="order-list__item-variant">Part of: {{ group.display_title }}</span><br/>
                                        {% endfor %}

                                        {% if line.gift_card and line.properties["__shopify_send_gift_card_to_recipient"] %}
                                        {% for property in line.properties %}
                                {% assign property_first_char = property.first | slice: 0 %}
                                {% if property.last != blank and property_first_char != '_' %}
                                <div class="order-list__item-property">
                                <dt>{{ property.first }}:</dt>
                                <dd>
                                {% if property.last contains '/uploads/' %}
                                        <a href="{{ property.last }}" class="link" target="_blank">
                                        {{ property.last | split: '/' | last }}
                                        </a>
                                {% else %}
                                        {{ property.last }}
                                {% endif %}
                                </dd>
                                </div>
                                {% endif %}
                                {% endfor %}

                                        {% endif %}

                                        {% if line.selling_plan_allocation %}
                                        <span class="order-list__item-variant">{{ line.selling_plan_allocation.selling_plan.name }}</span><br/>
                                        {% endif %}

                                        {% if line.refunded_quantity > 0 %}
                                        <span class="order-list__item-refunded">Refunded</span>
                                        {% endif %}

                                        {% if line.discount_allocations %}
                                        {% for discount_allocation in line.discount_allocations %}
                                        {% if discount_allocation.discount_application.target_selection != 'all' %}
                                        <p>
                                                <span class="order-list__item-discount-allocation">
                                                <img src="{{ 'notifications/discounttag.png' | shopify_asset_url }}" width="18" height="18" class="discount-tag-icon" />
                                                <span>
                                                {{ discount_allocation.discount_application.title | upcase }}
                                                (-{{ discount_allocation.amount | money }})
                                                </span>
                                                </span>
                                        </p>
                                        {% endif %}
                                        {% endfor %}
                                        {% endif %}
                                        </td>
                                        <td class="order-list__price-cell" style="float: right;">
                                        {% if line.original_line_price != line.final_line_price %}
                                        <del class="order-list__item-original-price">{{ line.original_line_price | money }}</del>
                                        {% endif %}
                                        <p class="order-list__item-price">
                                        {% if line.final_line_price > 0 %}
                                                {{ line.final_line_price | money }}
                                        {% else %}
                                                Free
                                        {% endif %}
                                        </p>
                                        
                                        
                                        </td>
                                </table>
                                </td>
                                </tr>{% endfor %}
                                </table>

                                        <table class="row subtotal-lines">
                                <tr>
                                <td class="subtotal-spacer"></td>
                                <td>
                                <table class="row subtotal-table">

                                        
                                {% assign order_discount_count = 0 %}
                                {% assign total_order_discount_amount = 0 %}
                                {% assign has_shipping_discount = false %}

                                {% for discount_application in discount_applications %}
                                {% if discount_application.target_selection == 'all' and discount_application.target_type == 'line_item' %}
                                {% assign order_discount_count = order_discount_count | plus: 1 %}
                                {% assign total_order_discount_amount = total_order_discount_amount | plus: discount_application.total_allocated_amount  %}
                                {% endif %}
                                {% if discount_application.target_type == 'shipping_line' %}
                                {% assign has_shipping_discount = true %}
                                {% assign shipping_discount = discount_application.title %}
                                {% assign shipping_amount = discount_application.total_allocated_amount %}
                                  
                                {% endif %}
                                  {% assign discod2 = discount_application.title %}
                                {% endfor %}



                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span>Subtotal</span>
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>{{ subtotal_price | plus: total_order_discount_amount | money }}</strong>
                                </td>
                                </tr>

                                {% if order_discount_count > 0 %}
                                {% if order_discount_count == 1 %}
                                
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                {% if discod2 contains 'Remaining_Amount' %}
                                    <span>Remaining Balance</span>
                                  {% else %}
                                <span>Order Discount</span>
                                   {% endif %}
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>-{{ total_order_discount_amount | money }}</strong>
                                </td>
                                </tr>

                                {% endif %}
                                {% if order_discount_count > 1 %}
                                
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                 {% if discod2 contains 'Remaining_Amount' %}
                                    <span>Remaining Balance</span>
                                  {% else %}
                                <span>Order Discount</span>
                                   {% endif %}
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>-{{ total_order_discount_amount | money }}</strong>
                                </td>
                                </tr>

                                {% endif %}
                                {% for discount_application in discount_applications %}
                                {% if discount_application.target_selection == 'all' and discount_application.target_type != 'shipping_line' %}
                                  {% assign discod1 = discount_application.title %}
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span class="subtotal-line__discount">
                                        <img src="{{ 'notifications/discounttag.png' | shopify_asset_url }}" width="18" height="18" class="discount-tag-icon" />
                                        <span class="subtotal-line__discount-title">{% if discount_application.title contains 'Remaining_Amount' %} Balance Pay To Delivery Person: {{ discount_application.total_allocated_amount | money }} {% else %}{{ discount_application.title }} (-{{ discount_application.total_allocated_amount | money }}){% endif %}</span>
                                </span>
                                </p>
                                </td>
                                </tr>

                                {% endif %}
                                {% endfor %}
                                {% endif %}


                                        {% if delivery_method == 'pick-up' %}
                                        
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span>Pickup</span>
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>{{ shipping_price | money }}</strong>
                                </td>
                                </tr>

                                        {% else %}
                                        {% if has_shipping_discount %}
                                
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span>Shipping</span>
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>Free</strong>
                                </td>
                                </tr>

                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span class="subtotal-line__discount">
                                        <img src="{{ 'notifications/discounttag.png' | shopify_asset_url }}" width="18" height="18" class="discount-tag-icon" />
                                        <span class="subtotal-line__discount-title">{{ shipping_discount }} (-{{ shipping_amount | money }})</span>
                                </span>
                                </p>
                                </td>
                                </tr>

                                {% else %}
                                
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span>Shipping</span>
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>{{ shipping_price | money }}</strong>
                                </td>
                                </tr>

                                {% endif %}

                                        {% endif %}

                                        {% if total_duties %}
                                        
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span>Duties</span>
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>{{ total_duties | money }}</strong>
                                </td>
                                </tr>

                                        {% endif %}

                                        
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span>Taxes</span>
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>{{ tax_price | money }}</strong>
                                </td>
                                </tr>


                                        {% if total_tip and total_tip > 0 %}
                                        
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span>Tip</span>
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>{{ total_tip | money }}</strong>
                                </td>
                                </tr>

                                        {% endif %}
                                </table>
                                {% assign transaction_size = 0 %}
                                {% assign transaction_amount = 0 %}
                                {% for transaction in transactions %}
                                        {% if transaction.status == "success" %}
                                        {% unless transaction.kind == "authorization" or transaction.kind == "void" %}
                                        {% assign transaction_size = transaction_size | plus: 1 %}
                                        {% assign transaction_amount = transaction_amount | plus: transaction.amount %}
                                        {% endunless %}
                                        {% endif %}
                                {% endfor %}
                                <table class="row subtotal-table subtotal-table--total">
                                {% if payment_terms and payment_terms.automatic_capture_at_fulfillment == false or b2b?%}
                                        {% assign due_at_date = payment_terms.next_payment.due_at | date: "%b %d, %Y" %}
                                        
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span>Total paid today</span>
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>{{ transaction_amount | money_with_currency }}</strong>
                                </td>
                                </tr>

                                        <div class="payment-terms">
                                        
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span>Total due {{ due_at_date }}</span>
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>{{ payment_terms.next_payment.amount_due | money_with_currency }}</strong>
                                </td>
                                </tr>

                                        </div>
                                {% else %}
                                        
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                  {% if discod1 contains 'Remaining_Amount' %}
                                <span>Total Amount Paid</span>
                                  {% else %}
                                   <span>Total</span>
                                  {% endif %}
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>{{ total_price | money_with_currency }}</strong>
                                </td>
                                </tr>


                                {% endif %}
                                
                                        
                                </table>

                                {% if total_discounts > 0 %}
                                        <p class="total-discount">
                                        
                                        {% if discod1 contains 'Remaining_Amount' %} Balance Pay To Delivery Person {% else %} You saved {% endif %}<span class="total-discount--amount">{{ total_discounts | money }}</span>
                                        </p>
                                {% endif %}

                                {% unless payment_terms %}
                                {% if transaction_size > 1 or transaction_amount < total_price %}
                                        <table class="row subtotal-table">
                                        <tr><td colspan="2" class="subtotal-table__line"></td></tr>
                                        <tr><td colspan="2" class="subtotal-table__small-space"></td></tr>

                                        {% for transaction in transactions %}
                                        {% if transaction.status == "success" and transaction.kind == "capture" or transaction.kind == "sale" %}
                                        {% if transaction.payment_details.credit_card_company %}
                                                {% capture transaction_name %}{{ transaction.payment_details.credit_card_company }} (ending in {{ transaction.payment_details.credit_card_last_four_digits }}){% endcapture %}
                                        {% else %}
                                                {% capture transaction_name %}{{ transaction.gateway_display_name }}{% endcapture %}
                                        {% endif %}

                                        
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span>{{transaction_name}}</span>
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>{{ transaction.amount | money }}</strong>
                                </td>
                                </tr>

                                        {% endif %}
                                        {% if transaction.kind == 'refund' %}
                                        {% if transaction.payment_details.credit_card_company %}
                                                {% assign refund_method_title = transaction.payment_details.credit_card_company %}
                                        {% else %}
                                                {% assign refund_method_title = transaction.gateway %}
                                        {% endif %}

                                        
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span>Refund</span>
                                        <br>
                                        <small>{{ refund_method_title | capitalize }}</small>
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>- {{ transaction.amount | money }}</strong>
                                </td>
                                </tr>

                                        {% endif %}
                                        {% endfor %}
                                        </table>
                                {% endif %}


                                {% endunless %}
                                </td>
                                </tr>
                                </table>


                                        </td>
                                        </tr>
                                        </table>
                                </center>
                                </td>
                                </tr>
                                </table>

                                        <table class="row section">
                                <tr>
                                <td class="section__cell">
                                <center>
                                        <table class="container">
                                        <tr>
                                        <td>
                                        <h3>Customer information</h3>
                                        </td>
                                        </tr>
                                        </table>
                                        <table class="container">
                                        <tr>
                                        <td>
                                        
                                        <table class="row">
                                        <tr>
                                                {% if requires_shipping and shipping_address %}
                                                <td class="customer-info__item">
                                                <h4>Shipping address</h4>
                                                {{ shipping_address | format_address }}
                                                </td>
                                                {% endif %}
                                                {% if billing_address %}
                                                <td class="customer-info__item">
                                                <h4>Billing address</h4>
                                                {{ billing_address | format_address }}
                                                </td>
                                                {% endif %}
                                        </tr>
                                        </table>
                                        <table class="row">
                                        <tr>
                                                {% if company_location %}
                                                <td class="customer-info__item">
                                                <h4>Location</h4>
                                                <p>
                                                {{ company_location.name }}
                                                </p>
                                                </td>
                                                {% endif %}
                                                {% if transaction_size > 0 or payment_terms and payment_terms.automatic_capture_at_fulfillment == false or b2b? %}
                                                <td class="customer-info__item">
                                                <h4>Payment</h4>
                                                <p class="customer-info__item-content">
                                                {% if payment_terms %}
                                                        {% assign due_date = payment_terms.next_payment.due_at | default: nil %}
                                                        {% if payment_terms.type == 'receipt' or payment_terms.type == 'fulfillment' and payment_terms.next_payment.due_at == nil %}
                                                        {{ payment_terms.translated_name }}<br>
                                                        {% else %}
                                                        {{ payment_terms.translated_name }}: Due {{ due_date | date: format: 'date' }}<br>
                                                        {% endif %}
                                                {% endif %}
                                                {% if transaction_size > 0 %}
                                                        {% for transaction in transactions %}
                                                        {% if transaction.status == "success" or transaction.status == "pending" %}
                                                        {% if transaction.kind == "capture" or transaction.kind == "sale" %}
                                                        {% if transaction.payment_details.credit_card_company %}
                                                                <img src="{{ transaction.payment_details.credit_card_company | payment_icon_png_url  }}" class="customer-info__item-credit" height="24" alt="{{ transaction.payment_details.credit_card_company }}">
                                                                <span>ending with {{ transaction.payment_details.credit_card_last_four_digits }}</span><br>
                                                        {% elsif transaction.gateway_display_name == "Gift card" %}
                                                                <img src="{{ transaction.gateway_display_name | downcase | replace: ' ', '-'  | payment_type_img_url }}" class="customer-info__item-credit" height="24">
                                                                ending with {{ transaction.payment_details.gift_card.last_four_characters | upcase }}<br>
                                                                    Gift card balance - <b>{{ transaction.payment_details.gift_card.balance |  money }}</b>
                                                        {% elsif transaction.gateway_display_name != "Shop Cash" %}
                                                                {{ transaction.gateway_display_name }}<br>
                                                        {% endif %}
                                                        {% elsif transaction.kind == "authorization" and transaction.gateway_display_name == "Shop Cash" %}
                                                        <span>Shop Cash - <b>{{ transaction.amount | money }}</b></span>
                                                        {% endif %}
                                                        {% endif %}
                                                        {% endfor %}
                                                {% endif %}
                                                </p>
                                                </td>
                                                {% endif %}
                                        </tr>
                                        <tr>
                                                {% if requires_shipping and shipping_address %}
                                                {% if shipping_method %}
                                                <td class="customer-info__item">
                                                <h4>Shipping method</h4>
                                                        <p>
                                                        {% if delivery_promise_branded_shipping_line %}
                                                        {{ delivery_promise_branded_shipping_line }}
                                                        {% else %}
                                                        {{ shipping_method.title }}
                                                        {% endif %}
                                                        </p>
                                                </td>
                                                {% endif %}
                                                {% endif %}
                                        </tr>
                                        </table>

                                        </td>
                                        </tr>
                                        </table>
                                </center>
                                </td>
                                </tr>
                                </table>

                                        <table class="row footer">
                                <tr>
                                <td class="footer__cell">
                                <center>
                                        <table class="container">
                                        <tr>
                                        <td>
                                        
                                        <p class="disclaimer__subtext">If you have any questions, reply to this email or contact us at <a href="mailto:{{ shop.email }}">{{ shop.email }}</a></p>
                                        {% if order.tags != blank %}Actual Product Price = Product price + Partial pending payment - product name{% endif %}
                                        </td>
                                        </tr>
                                        </table>
                                </center>
                                </td>
                                </tr>
                                </table>

                                <img src="{{ 'notifications/spacer.png' | shopify_asset_url }}" class="spacer" height="1" />

                                        </td>
                                </tr>
                                </table>
                                </body>
                                </html>


                                
            </textarea>
                        </div>

                </div>
                <div class="payxnowandrestondelivery-main-area-row1">
                        <div class="payxnowandrestondelivery-main-area">
                                <h5><b class="text-orange">Step 6:</b> Replace this code with your theme's <b>Order refund</b> email template</h3>.</h5>
                                <div>
                                                                <textarea rows="44" style="width: 100%">
                                                {% if refund_line_items.size == item_count %}
                                {% capture email_title %}Your order has been refunded{% endcapture %}
                                {% elsif refund_line_items.size == 0 %}
                                {% capture email_title %}You have received a refund{% endcapture %}
                                {% else %}
                                {% capture email_title %}Some items in your order have been refunded{% endcapture %}
                                {% endif %}
                                {% capture email_body %}Total amount refunded: <strong>{{ amount | money_with_currency }}</strong>{% endcapture %}

                                <!DOCTYPE html>
                                <html lang="en">
                                <head>
                                <title>{{ email_title }}</title>
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                                <meta name="viewport" content="width=device-width">
                                <link rel="stylesheet" type="text/css" href="/assets/notifications/styles.css">
                                <style>
                                .button__cell { background: {{ shop.email_accent_color }}; }
                                a, a:hover, a:active, a:visited { color: {{ shop.email_accent_color }}; }
                                </style>
                                </head>

                                <body>
                                <table class="body">
                                <tr>
                                        <td>
                                        <table class="header row">
                                <tr>
                                <td class="header__cell">
                                <center>

                                        <table class="container">
                                        <tr>
                                        <td>

                                        <table class="row">
                                                <tr>
                                                <td class="shop-name__cell">
                                                {%- if shop.email_logo_url %}
                                                <img src="{{shop.email_logo_url}}" alt="{{ shop.name }}" width="{{ shop.email_logo_width }}">
                                                {%- else %}
                                                <h1 class="shop-name__text">
                                                        <a href="{{shop.url}}">{{ shop.name }}</a>
                                                </h1>
                                                {%- endif %}
                                                </td>

                                                <td>
                                                <tr>
                                                        <td class="order-number__cell">
                                                        <span class="order-number__text">
                                                        Order {{ order_name }}
                                                        </span>
                                                        </td>
                                                </tr>
                                                {%- if po_number %}
                                                        <tr>
                                                        <td class="po-number__cell">
                                                        <span class="po-number__text">
                                                                PO number #{{ po_number }}
                                                        </span>
                                                        </td>
                                                        </tr>
                                                {%- endif %}
                                                </td>
                                                </tr>
                                        </table>

                                        </td>
                                        </tr>
                                        </table>

                                </center>
                                </td>
                                </tr>
                                </table>

                                        <table class="row content">
                                <tr>
                                <td class="content__cell">
                                <center>
                                        <table class="container">
                                        <tr>
                                        <td>
                                        
                                        <h2>{{ email_title }}</h2>
                                        <p>{{ email_body }}</p>

                                        </td>
                                        </tr>
                                        </table>
                                </center>
                                </td>
                                </tr>
                                </table>

                                        <table class="row section">
                                <tr>
                                <td class="section__cell">
                                <center>
                                        <table class="container">
                                        <tr>
                                        <td>
                                        {% if order.tags != blank %}<span>If you had placed a partially paid order then only paid amount will be refunded</span>{% endif %}
                                        <h3>Order summary</h3>
                                        </td>
                                        </tr>
                                        </table>
                                        <table class="container">
                                        <tr>
                                        <td>
                                        
                                        
                                <table class="row">
                                {% for line in subtotal_line_items %}
                                <tr class="order-list__item">
                                <td class="order-list__item__cell">
                                <table>
                                        <td>
                                        {% if line.image %}
                                        <img src="{{ line | img_url: 'compact_cropped' }}" align="left" width="60" height="60" class="order-list__product-image"/>
                                        {% endif %}
                                        </td>
                                        <td class="order-list__product-description-cell">
                                        {% if line.product.title %}
                                        {% assign line_title = line.product.title %}
                                        {% else %}
                                        {% assign line_title = line.title %}
                                        {% endif %}

                                        {% if line.quantity < line.quantity %}
                                        {% capture line_display %} {{ line.quantity }} of {{ line.quantity }} {% endcapture %}
                                        {% else %}
                                        {% assign line_display = line.quantity  %}
                                        {% endif %}

                                        <span class="order-list__item-title">{{ line_title }}&nbsp;&times;&nbsp;{{ line_display }}</span>

                                        {% if line.variant.title != 'Default Title' %}
                                        <span class="order-list__item-variant">{{ line.variant.title }}</span><br/>
                                        {% endif %}

                                        {% for group in line.groups %}
                                        <span class="order-list__item-variant">Part of: {{ group.display_title }}</span><br/>
                                        {% endfor %}

                                        {% if line.gift_card and line.properties["__shopify_send_gift_card_to_recipient"] %}
                                        {% for property in line.properties %}
                                {% assign property_first_char = property.first | slice: 0 %}
                                {% if property.last != blank and property_first_char != '_' %}
                                <div class="order-list__item-property">
                                <dt>{{ property.first }}:</dt>
                                <dd>
                                {% if property.last contains '/uploads/' %}
                                        <a href="{{ property.last }}" class="link" target="_blank">
                                        {{ property.last | split: '/' | last }}
                                        </a>
                                {% else %}
                                        {{ property.last }}
                                {% endif %}
                                </dd>
                                </div>
                                {% endif %}
                                {% endfor %}

                                        {% endif %}

                                        {% if line.selling_plan_allocation %}
                                        <span class="order-list__item-variant">{{ line.selling_plan_allocation.selling_plan.name }}</span><br/>
                                        {% endif %}

                                        {% if line.refunded_quantity > 0 %}
                                        <span class="order-list__item-refunded">Refunded</span>
                                        {% endif %}

                                        {% if line.discount_allocations %}
                                        {% for discount_allocation in line.discount_allocations %}
                                        {% if discount_allocation.discount_application.target_selection != 'all' %}
                                        <p>
                                                <span class="order-list__item-discount-allocation">
                                                {% if discount_application.title contains 'Remaining_Amount' %}
                                                {% else %}
                                                <img src="{{ 'notifications/discounttag.png' | shopify_asset_url }}" width="18" height="18" class="discount-tag-icon" />
                                                <span>
                                                {{ discount_allocation.discount_application.title | upcase }}
                                                (-{{ discount_allocation.amount | money }})
                                                </span>
                                                {% endif %}
                                                </span>
                                        </p>
                                        {% endif %}
                                        {% assign discod1 = discount_application.title %}
                                        {% endfor %}
                                        {% endif %}
                                        </td>
                                        <td class="order-list__price-cell">
                                        {% if line.original_line_price != line.final_line_price %}
                                        <del class="order-list__item-original-price">{{ line.original_line_price | money }}</del>
                                        {% endif %}
                                        <p class="order-list__item-price">
                                        {% if line.final_line_price > 0 %}
                                                {{ line.final_line_price | money }}
                                        {% else %}
                                                Free
                                        {% endif %}
                                        </p>
                                        </td>
                                </table>
                                </td>
                                </tr>{% endfor %}
                                </table>

                                        <table class="row subtotal-lines">
                                <tr>
                                <td class="subtotal-spacer"></td>
                                <td>
                                <table class="row subtotal-table">

                                        
                                {% assign order_discount_count = 0 %}
                                {% assign total_order_discount_amount = 0 %}
                                {% assign has_shipping_discount = false %}

                                {% for discount_application in discount_applications %}
                                {% if discount_application.target_selection == 'all' and discount_application.target_type == 'line_item' %}
                                {% assign order_discount_count = order_discount_count | plus: 1 %}
                                {% assign total_order_discount_amount = total_order_discount_amount | plus: discount_application.total_allocated_amount  %}
                                {% endif %}
                                {% if discount_application.target_type == 'shipping_line' %}
                                {% assign has_shipping_discount = true %}
                                {% assign shipping_discount = discount_application.title %}
                                {% assign shipping_amount = discount_application.total_allocated_amount %}
                                {% endif %}
                                {% assign discod1 = discount_application.title %}   
                                {% endfor %}



                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span>Subtotal</span>
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>{{ subtotal_price | plus: total_order_discount_amount | money }}</strong>
                                </td>
                                </tr>



                                {% if order_discount_count > 0 %}
                                {% if order_discount_count == 1 %}
                                
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                {% if discod1 contains 'Remaining_Amount' %}
                                <span>Pending Amount</span>
                                {% else %}
                                <span>Order Discount</span>
                                {% endif %}
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>-{{ total_order_discount_amount | money }}</strong>
                                </td>
                                </tr>

                                {% endif %}
                                {% if order_discount_count > 1 %}
                                
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                {% if discod1 contains 'Remaining_Amount' %}
                                <span>Pending Amount</span>
                                {% else %}
                                <span>Order Discounts</span>
                                {% endif %}
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>-{{ total_order_discount_amount | money }}</strong>
                                </td>
                                </tr>

                                {% endif %}
                                {% for discount_application in discount_applications %}
                                {% if discount_application.target_selection == 'all' and discount_application.target_type != 'shipping_line' %}
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span class="subtotal-line__discount">
                                        {% if discount_application.title contains 'Remaining_Amount' %}
                                        {% else %}
                                        <img src="{{ 'notifications/discounttag.png' | shopify_asset_url }}" width="18" height="18" class="discount-tag-icon" />
                                        <span class="subtotal-line__discount-title">{{ discount_application.title }} (-{{ discount_application.total_allocated_amount | money }})</span>
                                        {% endif %}
                                </span>
                                </p>
                                </td>
                                </tr>

                                {% endif %}
                                {% endfor %}
                                {% endif %}


                                        {% if delivery_method == 'pick-up' %}
                                        
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span>Pickup</span>
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>{{ shipping_price | money }}</strong>
                                </td>
                                </tr>

                                        {% else %}
                                        {% if has_shipping_discount %}
                                
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span>Shipping</span>
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>Free</strong>
                                </td>
                                </tr>

                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span class="subtotal-line__discount">
                                        <img src="{{ 'notifications/discounttag.png' | shopify_asset_url }}" width="18" height="18" class="discount-tag-icon" />
                                        <span class="subtotal-line__discount-title">{{ shipping_discount }} (-{{ shipping_amount | money }})</span>
                                </span>
                                </p>
                                </td>
                                </tr>

                                {% else %}
                                
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span>Shipping</span>
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>{{ shipping_price | money }}</strong>
                                </td>
                                </tr>

                                {% endif %}

                                        {% endif %}

                                        {% if total_duties %}
                                        
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span>Duties</span>
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>{{ total_duties | money }}</strong>
                                </td>
                                </tr>

                                        {% endif %}

                                        
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span>Taxes</span>
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>{{ tax_price | money }}</strong>
                                </td>
                                </tr>


                                        {% if total_tip and total_tip > 0 %}
                                        
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span>Tip</span>
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>{{ total_tip | money }}</strong>
                                </td>
                                </tr>

                                        {% endif %}
                                </table>
                                {% assign transaction_size = 0 %}
                                {% assign transaction_amount = 0 %}
                                {% for transaction in transactions %}
                                        {% if transaction.status == "success" %}
                                        {% unless transaction.kind == "authorization" or transaction.kind == "void" %}
                                        {% assign transaction_size = transaction_size | plus: 1 %}
                                        {% assign transaction_amount = transaction_amount | plus: transaction.amount %}
                                        {% endunless %}
                                        {% endif %}
                                {% endfor %}
                                <table class="row subtotal-table subtotal-table--total">
                                {% if payment_terms and payment_terms.automatic_capture_at_fulfillment == false or b2b?%}
                                        {% assign due_at_date = payment_terms.next_payment.due_at | date: "%b %d, %Y" %}
                                        
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span>Total paid today</span>
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>{{ transaction_amount | money_with_currency }}</strong>
                                </td>
                                </tr>

                                        <div class="payment-terms">
                                        
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span>Total due {{ due_at_date }}</span>
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>{{ payment_terms.next_payment.amount_due | money_with_currency }}</strong>
                                </td>
                                </tr>

                                        </div>
                                {% else %}
                                        
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                {% if discod1 contains 'Remaining_Amount' %}
                                <span>Partial Amount Paid</span>
                                {% else %}
                                <span>Total</span>
                                {% endif %}
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>{{ total_price | money_with_currency }}</strong>
                                </td>
                                </tr>

                                {% endif %}
                                </table>

                                {% if total_discounts > 0 %}
                                        <p class="total-discount">
                                        {% if discod1 contains 'Remaining_Amount' %} {% else %} You saved <span class="total-discount--amount">{{ total_discounts | money }}{% endif %}</span>
                                        </p>
                                {% endif %}

                                {% unless payment_terms %}
                                {% if transaction_size > 1 or transaction_amount < total_price %}
                                        <table class="row subtotal-table">
                                        <tr><td colspan="2" class="subtotal-table__line"></td></tr>
                                        <tr><td colspan="2" class="subtotal-table__small-space"></td></tr>

                                        {% for transaction in transactions %}
                                        {% if transaction.status == "success" and transaction.kind == "capture" or transaction.kind == "sale" %}
                                        {% if transaction.payment_details.credit_card_company %}
                                                {% capture transaction_name %}{{ transaction.payment_details.credit_card_company }} (ending in {{ transaction.payment_details.credit_card_last_four_digits }}){% endcapture %}
                                        {% else %}
                                                {% capture transaction_name %}{{ transaction.gateway_display_name }}{% endcapture %}
                                        {% endif %}

                                        
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span>{{transaction_name}}</span>
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>{{ transaction.amount | money }}</strong>
                                </td>
                                </tr>

                                        {% endif %}
                                        {% if transaction.kind == 'refund' %}
                                        {% if transaction.payment_details.credit_card_company %}
                                                {% assign refund_method_title = transaction.payment_details.credit_card_company %}
                                        {% else %}
                                                {% assign refund_method_title = transaction.gateway %}
                                        {% endif %}

                                        
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span>Refund</span>
                                        <br>
                                        <small>{{ refund_method_title | capitalize }}</small>
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>- {{ transaction.amount | money }}</strong>
                                </td>
                                </tr>

                                        {% endif %}
                                        {% endfor %}
                                        </table>
                                {% endif %}


                                {% endunless %}
                                </td>
                                </tr>
                                </table>


                                        </td>
                                        </tr>
                                        </table>
                                </center>
                                </td>
                                </tr>
                                        {% if discod1 contains 'Remaining_Amount' %}
                                        <tr>
                                        <td>
                                        <p class="disclaimer__subtext">If you had placed a partially paid order then only paid amount will be refunded</p>
                                        </td>
                                        </tr>
                                        {% endif %}
                                </table>

                                        <table class="row footer">
                                <tr>
                                <td class="footer__cell">
                                <center>
                                        <table class="container">
                                        <tr>
                                        <td>
                                        
                                        <p class="disclaimer__subtext">If you have any questions, reply to this email or contact us at <a href="mailto:{{ shop.email }}">{{ shop.email }}</a></p>
                                        </td>
                                        </tr>
                                        </table>
                                </center>
                                </td>
                                </tr>
                                </table>

                                <img src="{{ 'notifications/spacer.png' | shopify_asset_url }}" class="spacer" height="1" />

                                        </td>
                                </tr>
                                </table>
                                </body>
                                </html>

            </textarea>
                                </div>

                        </div>
                        <div class="payxnowandrestondelivery-main-area">
                                <h5><b class="text-orange">Step 7:</b> Replace <b>New Order</b> email template.</h5>
                                <p>Templaet path: Setting->Notifications->Staff notifications->New Order</p>
                                <div>
                                        <textarea rows="44" style="width: 100%">

                                                <!DOCTYPE html>
                                                <html lang="en">
                                                <head>
                                                <title>{{ email_title }}</title>
                                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                                                <meta name="viewport" content="width=device-width">
                                                
                                                <link rel="stylesheet" type="text/css" media="screen" href="/assets/admin/merchant_mailer/style.css">
                                                <style data-premailer="ignore">
                                                .button__cell { background: {{ shop.email_accent_color }}; }
                                                a, a:hover, a:active, a:visited { color: {{ shop.email_accent_color }}; }
                                                @media print{
                                                body {
                                                        color: black !important;
                                                }

                                                .subtitle-lines,
                                                .subtotal-line__title,
                                                .subtotal-line__value {
                                                        padding: 0 !important;
                                                        margin: 0 !important;
                                                }

                                                .subtotal-table {
                                                        margin: 0 !important;
                                                }
                                                }
                                                </style>
                                                </head>

                                                <body>
                                                <table class="row">
                                                <tr class="mail-priority-indicator mail-priority-indicator--{% if fulfillment_aborted or has_high_risks? %}high{% else %}low{% endif %}">
                                                        <td></td>
                                                </tr>
                                                </table>
                                                <table class="body">
                                                <tr>
                                                        <td>
                                                        {% if fulfillment_aborted %}
                                                        <center>
                                                        <table class="row banner-container banner-alert__table">
                                                <tr>
                                                        <td class="banner-alert__cell">
                                                        <img src="{{ 'mailer/merchant/critical_alert.png' | cdn_asset_url }}" alt="Critical Alert" width="20px">
                                                        </td>
                                                        <td class="banner-description__cell">
                                                        <strong class="banner-alert__title">Order was not fulfilled automatically</strong>
                                                        High risk of fraud detected. Before fulfilling this order or capturing payment, please review the Risk Analysis and determine if this order is fraudulent.
                                                        </td>
                                                </tr>
                                                </table>

                                                        </center>
                                                        {% endif %}
                                                        {% if has_high_risks? %}
                                                        <center>
                                                        <table class="row banner-container banner-alert__table">
                                                <tr>
                                                        <td class="banner-alert__cell">
                                                        <img src="{{ 'mailer/merchant/critical_alert.png' | cdn_asset_url }}" alt="Critical Alert" width="20px">
                                                        </td>
                                                        <td class="banner-description__cell">
                                                        <strong class="banner-alert__title">High risk of fraud detected</strong>
                                                        Before fulfilling this order or capturing payment, please review the Risk Analysis and determine if this order is fraudulent.
                                                        </td>
                                                </tr>
                                                </table>

                                                        </center>
                                                        {% endif %}
                                                        <table class="row">
                                                <tr>
                                                <td class="section__cell">
                                                <center>
                                                        <table class="container section">
                                                        <tr>
                                                        <td>
                                                        
                                                        <table class="row content">
                                                <tr>
                                                <td class="content__cell {% if no_top_border == 'hide_border' %}no_top__border{% endif %}">
                                                <center>
                                                        <table class="container">
                                                        <tr>
                                                        <td>
                                                        
                                                        <table class="row">
                                                                <tr>
                                                                <td>
                                                                {% assign current_date = date | date: "%b %d" %}
                                                                {% assign current_time = date | date: "%l:%M %P" %}
                                                                {% if customer.name %}
                                                                {{ customer.name }} placed order {{ name }} on {{ current_date }} at {{ current_time | strip }}.
                                                                {% else %}
                                                                Someone placed order {{ name }} on {{ current_date }} at {{ current_time | strip }}.
                                                                {% endif %}
                                                                <table class="row actions" style="width: auto;">
                                                <tr>
                                                <td class="empty-line">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                <td class="actions__cell">
                                                        <table class="button main-action-cell">
                                                        <tr>
                                                        <td><a href="https://{{ shop.permanent_domain }}/admin/orders/{{ id }}" class="mail-button" style="margin-right:5px">View order</a></td>
                                                        </tr>
                                                        </table>
                                                </td>
                                                </tr>
                                                </table>

                                                                </td>
                                                                </tr>
                                                        </table>

                                                        </td>
                                                        </tr>
                                                        </table>
                                                </center>
                                                </td>
                                                </tr>
                                                </table>
                                                        <table class="row content">
                                                <tr>
                                                <td class="content__cell {% if no_top_border == 'hide_border' %}no_top__border{% endif %}">
                                                <center>
                                                        <table class="container">
                                                        <tr>
                                                        <td>
                                                        
                                                        <strong class="order-list__summary-title">Order summary</strong>
                                                        <br>
                                                        <br>
                                                        
                                                <table class="row">
                                                {% for line in subtotal_line_items %}
                                                <tr class="order-list__item">
                                                <td class="order-list__item__cell">
                                                <table>
                                                        <td>
                                                        {% if line.image %}
                                                        <img src="{{ line | img_url: 'compact_cropped' }}" align="left" width="60" height="60" class="order-list__product-image"/>
                                                        {% endif %}
                                                        </td>
                                                        <td class="order-list__product-description-cell">
                                                        {% if line.quantity < line.quantity %}
                                                        {% capture line_display %} {{ line.quantity }} of {{ line.quantity }} {% endcapture %}
                                                        {% else %}
                                                        {% assign line_display = line.quantity  %}
                                                        {% endif %}

                                                        <span class="order-list__item-title">
                                                        {% if line.product.title == blank %}
                                                        {{ line.title }}</span><br/>
                                                        {% else %}
                                                        {{ line.product.title }}
                                                        {% endif %}
                                                        </span><br/>

                                                        {% if line.quantity %}
                                                        {% if line.original_line_price != line.final_line_price %}
                                                        <span><del class="order-list__item-original-price">{{ line.original_price | money }}</del></span>
                                                        {% endif %}
                                                        <span>{{ line.final_price | money }} × {{ line.quantity }} </span><br/>
                                                        {% endif %}

                                                        {% if line.variant.title != 'Default Title' %}
                                                        <span class="order-list__item-variant">{{ line.variant.title }}</span>

                                                        {% if line.sku != blank %}
                                                        <span class="order-list__item-variant">• </span>
                                                        {% endif %}
                                                        {% endif %}

                                                        {% if line.sku != blank %}
                                                        <span class="order-list__item-variant">SKU: {{ line.sku }}</span>
                                                        {% endif %}

                                                        {% if line.selling_plan_allocation != nil %}
                                                        <p class="order-list__item-variant">{{ line.selling_plan_allocation.selling_plan.name }}</p>
                                                        {% endif %}

                                                        {% if line.discount_allocations %}
                                                        {% for discount_allocation in line.discount_allocations %}
                                                        {% if discount_allocation.discount_application.target_selection != 'all' %}
                                                                <span class="order-list__item-discount-allocation">
                                                                <img src="{{ 'notifications/discounttag.png' | shopify_asset_url }}" width="18" height="18" class="discount-tag-icon" />
                                                                <span>
                                                                {{ discount_allocation.discount_application.title | upcase }}
                                                                (-{{ discount_allocation.amount | money }})
                                                                </span>
                                                                </span>
                                                        {% endif %}
                                                        {% endfor %}
                                                        {% endif %}
                                                        </td>
                                                        <td class="order-list__price-cell">
                                                        <p class="order-list__item-price">
                                                        {% if line.final_line_price > 0 %}
                                                                {{ line.final_line_price | money }}
                                                        {% else %}
                                                                Free
                                                        {% endif %}
                                                        </p>
                                                        </td>
                                                </table>
                                                </td>
                                                </tr>{% endfor %}
                                                </table>

                                                        <table class="row subtotal-lines">
                                                <tr>
                                                <td>
                                                <table class="row subtotal-table">


                                                        {% assign order_discount_count = 0 %}
                                                        {% assign total_order_discounts = 0 %}
                                                        {% assign has_shipping_discount = false %}

                                                        {% for discount_application in discount_applications %}
                                                        {% if discount_application.target_selection == 'all' and discount_application.target_type == 'line_item' %}
                                                        {% assign order_discount_count = order_discount_count | plus: 1 %}
                                                        {% assign total_order_discount_amount = total_order_discounts | plus: discount_application.total_allocated_amount  %}
                                                        {% endif %}
                                                        {% if discount_application.target_type == 'shipping_line' %}
                                                        {% assign has_shipping_discount = true %}
                                                        {% assign shipping_discount = discount_application.title %}
                                                        {% assign shipping_amount = discount_application.total_allocated_amount %}
                                                        {% endif %}
                                                        {% assign discod1 = discount_application.title %}
                                                        {% endfor %}

                                                        
                                                <tr class="subtotal-line">
                                                <td class="subtotal-line__title">
                                                <p>
                                                {% if titleBold %}
                                                        <span><strong>Subtotal</strong></span>
                                                {% else %}
                                                        <span>Subtotal</span>
                                                {% endif %}
                                                </p>
                                                </td>
                                                <td class="subtotal-line__value">
                                                {% if valueBold %}
                                                <strong>{{ subtotal_price | plus: total_order_discount_amount | money }}</strong>
                                                {% else %}
                                                {{ subtotal_price | plus: total_order_discount_amount | money }}
                                                {% endif %}
                                                </td>
                                                </tr>


                                                        {% if order_discount_count > 0 %}
                                                        {% if order_discount_count == 1 %}
                                                        
                                                <tr class="subtotal-line">
                                                <td class="subtotal-line__title">
                                                <p>
                                                {% if discod1 contains 'Remaining_Amount' %}
                                                        <span>Pending Amount</span>
                                                {% elsif discod1 contains 'Partial Payment' %}
                                                        <span>Partial Amount Paid</span>
                                                {% else %}
                                                        <span>Order Discount</span>
                                                {% endif %}
                                                </p>
                                                </td>
                                                <td class="subtotal-line__value">
                                                <span>-{{ total_order_discount_amount | money }}</span>
                                                </td>
                                                </tr>

                                                        {% endif %}
                                                        {% if order_discount_count > 1 %}
                                                        
                                                <tr class="subtotal-line">
                                                <td class="subtotal-line__title">
                                                <p>
                                                {% if discod1 contains 'Remaining_Amount' %}
                                                        <span>Pending Amount</span>
                                                {% elsif discod1 contains 'Partial Payment' %}
                                                        <span>Partial Amount Paid</span>
                                                {% else %}
                                                        <span>Order Discount</span>
                                                {% endif %}
                                                </p>
                                                </td>
                                                <td class="subtotal-line__value">
                                                <span>-{{ total_order_discount_amount  | money }}</span>
                                                </td>
                                                </tr>

                                                        {% endif %}
                                                        {% for discount_application in discount_applications %}

                                                        {% if discount_application.target_selection == 'all' and discount_application.target_type != 'shipping_line' %}
                                                        <tr class="subtotal-line">
                                                <td class="subtotal-line__title">
                                                <p>
                                                <span class="subtotal-line__discount">
                                                        {% if discount_application.title contains 'Remaining_Amount' %}
                                                        {% else %}
                                                        {% if discount_application.title contains 'Partial Payment' %}
                                                        {% else %}
                                                        <img src="{{ 'notifications/discounttag.png' | shopify_asset_url }}" width="18" height="18" class="discount-tag-icon" />
                                                        <span class="subtotal-line__discount-title">{{ discount_application.title }} (-{{ discount_application.total_allocated_amount | money }})</span>
                                                        {% endif %}
                                                        {% endif %}
                                                </span>
                                                </p>
                                                </td>
                                                </tr>

                                                        {% endif %}
                                                        {% endfor %}
                                                        {% endif %}

                                                        {% if delivery_method == 'pick-up' %}
                                                        
                                                <tr class="subtotal-line">
                                                <td class="subtotal-line__title">
                                                <p>
                                                {% if titleBold %}
                                                        <span><strong>Pickup</strong></span>
                                                {% else %}
                                                        <span>Pickup</span>
                                                {% endif %}
                                                </p>
                                                </td>
                                                <td class="subtotal-line__value">
                                                {% if valueBold %}
                                                <strong>{{ shipping_price | money }}</strong>
                                                {% else %}
                                                {{ shipping_price | money }}
                                                {% endif %}
                                                </td>
                                                </tr>

                                                        {% else %}
                                                        {% if has_shipping_discount %}
                                                        
                                                <tr class="subtotal-line">
                                                <td class="subtotal-line__title">
                                                <p>
                                                {% if titleBold %}
                                                        <span><strong>Shipping</strong></span>
                                                {% else %}
                                                        <span>Shipping</span>
                                                {% endif %}
                                                        <span class="">
                                                        <span class="subtotal-line__discount-title">{% if shipping_method.title.size > 0 %}({{ shipping_method.title }}){% endif %}</span>
                                                        </span>
                                                </p>
                                                </td>
                                                <td class="subtotal-line__value">
                                                {% if valueBold %}
                                                <strong>Free</strong>
                                                {% else %}
                                                Free
                                                {% endif %}
                                                </td>
                                                </tr>

                                                        <tr class="subtotal-line">
                                                <td class="subtotal-line__title">
                                                <p>
                                                <span class="subtotal-line__discount">
                                                        <img src="{{ 'notifications/discounttag.png' | shopify_asset_url }}" width="18" height="18" class="discount-tag-icon" />
                                                        <span class="subtotal-line__discount-title">{{ shipping_discount }} (-{{ shipping_amount | money }})</span>
                                                </span>
                                                </p>
                                                </td>
                                                </tr>

                                                        {% else %}
                                                        
                                                <tr class="subtotal-line">
                                                <td class="subtotal-line__title">
                                                <p>
                                                {% if titleBold %}
                                                        <span><strong>Shipping</strong></span>
                                                {% else %}
                                                        <span>Shipping</span>
                                                {% endif %}
                                                        <span class="">
                                                        <span class="subtotal-line__discount-title">{% if shipping_method.title.size > 0 %}({{ shipping_method.title }}){% endif %}</span>
                                                        </span>
                                                </p>
                                                </td>
                                                <td class="subtotal-line__value">
                                                {% if valueBold %}
                                                <strong>{{ shipping_price | money }}</strong>
                                                {% else %}
                                                {{ shipping_price | money }}
                                                {% endif %}
                                                </td>
                                                </tr>

                                                        {% endif %}
                                                        {% endif %}

                                                        {% if total_duties %}
                                                        
                                                <tr class="subtotal-line">
                                                <td class="subtotal-line__title">
                                                <p>
                                                {% if titleBold %}
                                                        <span><strong>Duties</strong></span>
                                                {% else %}
                                                        <span>Duties</span>
                                                {% endif %}
                                                </p>
                                                </td>
                                                <td class="subtotal-line__value">
                                                {% if valueBold %}
                                                <strong>{{ total_duties | money }}</strong>
                                                {% else %}
                                                {{ total_duties | money }}
                                                {% endif %}
                                                </td>
                                                </tr>

                                                        {% endif %}

                                                        {% for tax_line in tax_lines %}
                                                        
                                                <tr class="subtotal-line">
                                                <td class="subtotal-line__title">
                                                <p>
                                                {% if titleBold %}
                                                        <span><strong>Tax</strong></span>
                                                {% else %}
                                                        <span>Tax</span>
                                                {% endif %}
                                                        <span class="subtotal-line__discount">
                                                        <span class="subtotal-line__discount-title">{% if tax_line.title.size > 0 %}({{ tax_line.title }} {{ tax_line.rate | times: 100 }}%){% endif %}</span>
                                                        </span>
                                                </p>
                                                </td>
                                                <td class="subtotal-line__value">
                                                {% if valueBold %}
                                                <strong>{{ tax_line.price | money }}</strong>
                                                {% else %}
                                                {{ tax_line.price | money }}
                                                {% endif %}
                                                </td>
                                                </tr>

                                                        {% endfor %}

                                                </table>
                                                <table class="row subtotal-table subtotal-table--total">
                                                        
                                                <tr class="subtotal-line">
                                                <td class="subtotal-line__title">
                                                <p>
                                                {% if titleBold %}
                                                        {% if discod1 contains 'Remaining_Amount' %}
                                                        <span><strong>Partial Amount paid</strong></span>
                                                        {% elsif discod1 contains 'Partial Payment' %}
                                                        <span><strong>Pending Amount</strong></span>
                                                        {% else %}
                                                        <span><strong>Total</strong></span>
                                                        {% endif %}
                                                {% else %}
                                                        {% if discod1 contains 'Remaining_Amount' %}
                                                        <span>Partial Amount paid</span>
                                                        {% elsif discod1 contains 'Partial Payment' %}
                                                        <span>Pending Amount</span>
                                                        {% else %}
                                                        <span>Total</span>
                                                        {% endif %}
                                                {% endif %}
                                                </p>
                                                </td>
                                                <td class="subtotal-line__value">
                                                {% if valueBold %}
                                                <strong>{{ total_price | money_with_currency }}</strong>
                                                {% else %}
                                                {{ total_price | money_with_currency }}
                                                {% endif %}
                                                </td>
                                                </tr>

                                                </table>
                                                </td>
                                                </tr>
                                                </table>


                                                        </td>
                                                        </tr>
                                                        </table>
                                                </center>
                                                </td>
                                                </tr>
                                                </table>
                                                        <table class="row content">
                                                <tr>
                                                <td class="content__cell {% if no_top_border == 'hide_border' %}no_top__border{% endif %}">
                                                <center>
                                                        <table class="container">
                                                        <tr>
                                                        <td>
                                                        
                                                        {% if gateway %}
                                                                <table class="row">
                                                                <tr>
                                                                <td class="customer-info__item customer-info__item--last">
                                                                <strong>Payment processing method</strong>
                                                                <br>
                                                                <p>{{ gateway }}</p>
                                                                </td>
                                                                </tr>
                                                                </table>
                                                        {% endif %}
                                                        {% if requires_shipping and shipping_address %}
                                                                {% if shipping_methods.first %}
                                                                <br>
                                                                <table class="row">
                                                                <tr>
                                                                <td class="customer-info__item customer-info__item--last">
                                                                        <strong>Delivery method</strong>
                                                                        <br>
                                                                        {% for shipping_method in shipping_methods %}
                                                                        <p>{{ shipping_method.title }}</p>
                                                                        {% endfor %}
                                                                </td>
                                                                </tr>
                                                                </table>
                                                                {% endif %}
                                                                <br>
                                                                <table class="row">
                                                                <tr>
                                                                <td class="customer-info__item customer-info__item--last">
                                                                <strong>Shipping address</strong>
                                                                <br>
                                                                <p>
                                                                        {{ shipping_address.name }}<br>
                                                                        {{ shipping_address.street }}<br>
                                                                        {{ shipping_address.city }},
                                                                        {{ shipping_address.province }}
                                                                        {{ shipping_address.zip }}<br>
                                                                        {{ shipping_address.country }}<br>
                                                                        {{ shipping_address.phone }}<br>
                                                                </p>
                                                                </td>
                                                                </tr>
                                                                {% if po_number %}
                                                                <tr>
                                                                <td>
                                                                <strong>PO number</strong><br/>
                                                                <p>#{{ po_number }}</p>
                                                                </td>
                                                                </tr>
                                                                {% endif %}
                                                                </table>
                                                        {% endif %}

                                                        </td>
                                                        </tr>
                                                        </table>
                                                </center>
                                                </td>
                                                </tr>
                                                </table>

                                                        </td>
                                                        </tr>
                                                        </table>
                                                </center>
                                                </td>
                                                </tr>
                                                </table>
                                                        <footer class="no-print">
                                                <br>
                                                <table border="0" cellpadding="0" cellspacing="0" class="mail-footer">
                                                <tbody>
                                                <tr>
                                                        <td align="center" valign="bottom">
                                                        <img src="{{ 'mailer/merchant/shopify_logo.png' | cdn_asset_url }}" alt="Shopify" width="89">
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <td align="center">
                                                        <p><span class="apple-link">151 O'Connor Street, Ground floor, Ottawa, ON, K2P 2L8</span></p>
                                                        </td>
                                                </tr>
                                                </tbody>
                                                </table>
                                                </footer>

                                                <img class="no-print" src="{{ 'notifications/spacer.png' | shopify_asset_url }}" class="spacer" height="1" />

                                                        </td>
                                                </tr>
                                                </table>
                                                </body>
                                                </html>

                                                                                        </textarea>
                                </div>
                               
                        </div>
                </div>


        </div>

</div>