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
        .payxnowandrestondelivery-zip-flex-row{display: flex;
    width: 100%;
    justify-content: space-between;
    gap: 39px;
    flex-wrap: wrap;}
    .payxnowandrestondelivery-zip-flex-row > div {
    flex: 1;
}
.postal-btn-export{margin-bottom: 10px;
    background-color: #28a745;
    color: #fff;padding: 5px 26px;margin-right: 10px;}
    .postal-btn:hover{background-color: #3b3b3b;}
    
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
                .payxnowandrestondelivery-zip-flex-row{display: block;}
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
<script src="/public/jscolor.js"></script>
<div class="payxnowandrestondelivery-whiteAreaDiv payxnowandrestondelivery-container">
        <div class="payxnowandrestondelivery-main-heading payxnowandrestondelivery-back-heading">
                <h5> <a onclick='abc(event);' href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/">Back</h5></a>
        </div>

        <div class=" payxnowandrestondelivery-main-area ">

                <h5><b class="text-orange">Step 1:</b> Login to your Shopify store and go to your theme under online .</h5>

                <div class="payxnowandrestondelivery-imgIns"><img src="/public/images/instruct/config1.webp" /></div>
        </div>
        <div class=" payxnowandrestondelivery-main-area ">
                <h5><b class="text-orange">Step 2:</b> Click on “Customize” the theme.</h5>

                <div class="payxnowandrestondelivery-imgIns"><img src="/public/images/instruct/config2.webp" /></div>
        </div>
        <div class=" payxnowandrestondelivery-main-area ">
                <h5><b class="text-orange">Step 3:</b> Select default product under product drop down.</h5>

                <div class="payxnowandrestondelivery-imgIns"><img src="/public/images/instruct/config3.webp" /></div>
        </div>
        <div class="payxnowandrestondelivery-main-area-row">
                <div class=" payxnowandrestondelivery-main-area ">
                        <h5><b class="text-orange">Step 4:</b> Click on “App embeds” in left sidebar. Activate App like this</h5>

                        <div class="payxnowandrestondelivery-imgIns">
                                <img style="width: 58%;" src="/public/images/instruct/app-embed.webp?var=1" />
                        </div>
                </div>
                <!-- <div class=" payxnowandrestondelivery-main-area ">
                        <h5><b class="text-orange">Step 5:</b> Add section where you want to show partial and full pay.</h5>

                        <div class="payxnowandrestondelivery-imgIns"><img src="/public/images/instruct/step-5.webp?var=2" /></div>
                </div> -->
        </div>
        <!-- <div class=" payxnowandrestondelivery-main-area ">
                <h5><b class="text-orange">Step 6:</b> App section will show like this.</h5>

                <div class="payxnowandrestondelivery-imgIns"><img src="/public/images/instruct/config6.webp?var=3" /></div>
        </div> -->
        <div class="payxnowandrestondelivery-main-area-row ">
                <div class="payxnowandrestondelivery-main-area ">
                        <h5><b class="text-orange">Step 5:</b> Replace this code with your theme's order confirmation email template.</h5>
                        <div><textarea rows="20" style="width: 100%;">{% capture email_title %}
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
                                <td class="empty-line">&nbsp;</td>
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
                                {% assign partial_pending_amount = 0 %}
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

                                        <span class="order-list__item-title">{{ line_title }} {% if line.properties.Note == 'Initial Partial Payment'%}<br/><span style="color:red;">Partial Amount={{line.properties.partial_pay}}</span><br/><span style="color:red;">Pending Amount={{line.properties.remaining_amount}}</span><br/>{% endif %} &nbsp;&times;&nbsp;{{ line_display }}</span>
                                        {% assign partial_pending_amount = partial_pending_amount | plus: line.properties.remaining_amount  %}

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

                                {% if partial_pending_amount > 0 %}
                                
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span>Pending Amount</span>
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>{{ partial_pending_amount }}</strong>
                                </td>
                                </tr>
                                {% endif %}


                                {% if order_discount_count > 0 %}
                                {% if order_discount_count == 1 %}
                                
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span>Order Discount</span>
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
                                <span>Order Discounts</span>
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
                                        <img src="{{ 'notifications/discounttag.png' | shopify_asset_url }}" width="18" height="18" class="discount-tag-icon" />
                                        <span class="subtotal-line__discount-title">{{ discount_application.title }} (-{{ discount_application.total_allocated_amount | money }})</span>
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
                                <span>Total</span>
                                </p>
                                </td>
                                <td class="subtotal-line__value">
                                <strong>{{ total_price | money_with_currency }}</strong>
                                </td>
                                </tr>


                                {% endif %}

                                {% if partial_pending_amount > 0 %}
                                <tr class="subtotal-line">
                                <td class="subtotal-line__title">
                                <p>
                                <span>Grand Total</span>
                                </p>
                                </td>
                                <td class="subtotal-line__value">      
                                        {% assign partial_pending_amount2 = partial_pending_amount | append: 0 %}
                                {% assign partial_pending_amount2 = partial_pending_amount2 | append: 0 %} 
                                
                                <strong>{{ total_price | plus: partial_pending_amount2 | money}}</strong>
                                </td>
                                </tr>
                                        {% endif %}
                                        
                                </table>

                                {% if total_discounts > 0 %}
                                        <p class="total-discount">
                                        You saved <span class="total-discount--amount">{{ total_discounts | money }}</span>
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
                                                                &emsp;&emsp;&emsp;&nbsp;Gift card balance - <b>{{ transaction.payment_details.gift_card.balance |  money }}</b>
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
                <!-- <div class=" payxnowandrestondelivery-main-area ">
                        <h5><b class="text-orange">Step 6:</b> Edit Order confirmation email template - Add below code after this code {{ line_title }}.</h5>
                        <div><textarea style="max-width: 624px; height: 84px;width: 100%;">{% if line.properties.Note == 'Initial Partial Payment'%}<br/><span style="color:red;">Partial Amount={{line.properties.partial_pay}}</span><br/><span style="color:red;">Pending Amount={{line.properties.remaining_amount}}</span><br/>{% endif %}</textarea></div>
                        <h5>Add below code before {% for line in subtotal_line_items %}.</h5>
                        <div><textarea style="max-width: 624px; height: 84px;width: 100%;">{% assign partial_pending_amount = 0 %}</textarea></div>
                        <h5>Add below code after {{ line_display }} OR line number 244.</h5>
                        <div><textarea style="max-width: 624px; height: 84px;width: 100%;">{% assign partial_pending_amount = partial_pending_amount | plus: line.properties.remaining_amount  %}</textarea></div>
                </div> -->
        </div>
        <!--<div class="payxnowandrestondelivery-main-area-row ">
                <div class=" payxnowandrestondelivery-main-area ">
                        <h5> <b class="text-orange">Step 7: </b>Edit Order confirmation email template - Fine below after.</h5>

                        <div><textarea style="max-width: 624px; height: 84px;width: 100%;"><tr class="subtotal-line"><td class="subtotal-line__title"><p><span>Subtotal</span></p></td><td class="subtotal-line__value"><strong>{{ subtotal_price | plus: total_order_discount_amount | money }}</strong></td></tr></textarea></div>
                        <h5> Add below code after above code.</h5>
                        <div><textarea style="max-width: 624px; height: 84px;width: 100%;">{% if partial_pending_amount > 0 %}<tr class="subtotal-line"><td class="subtotal-line__title"><p><span>Pending Amount</span></p></td><td class="subtotal-line__value"><strong>{{ partial_pending_amount }}</strong></td></tr>{% endif %}</textarea></div>
                </div>

                <div class=" payxnowandrestondelivery-main-area ">
                        <h5> <b class="text-orange">Step 8: </b>Edit Order confirmation email template - Fine below after.</h5>
                        <div><textarea style="max-width: 624px; height: 84px;width: 100%;"> {% else %}<tr class="subtotal-line"><td class="subtotal-line__title"><p><span>Total</span></p></td><td class="subtotal-line__value"><strong>{{ total_price | money_with_currency }}</strong></td></tr>{% endif %}</textarea></div>
                        <h5> Add below code after above code.</h5>
                        <div><textarea style="max-width: 624px; height: 84px;width: 100%;">{% if partial_pending_amount > 0 %}<tr class="subtotal-line"><td class="subtotal-line__title"><p><span>Grand Total</span></p></td><td class="subtotal-line__value">{% assign partial_pending_amount2 = partial_pending_amount | append: 0 %}<br/>{% assign partial_pending_amount2 = partial_pending_amount2 | append: 0 %}<strong>{{ total_price | plus: partial_pending_amount2 | money}}</strong></td></tr>{% endif %}</textarea></div>
                </div>

                <div class=" payxnowandrestondelivery-main-area ">
                        <h5> <b class="text-orange">Step 9: </b>Edit Order confirmation email template - After the closing of this tag &lt;p class="disclaimer__subtext"&gt;.</h5>
                        <div><textarea style="max-width: 624px; height: 84px;width: 100%;">{% if order.tags != blank %}Actual Product Price = Product price + Partial pending payment - product name{% endif %}</textarea></div>
                </div>

        </div>-->

        <div class="payxnowandrestondelivery-main-area-row ">

                <div class=" payxnowandrestondelivery-main-area ">
                        <h5><b class="text-orange">Step 6:</b> Edit Order refund template - Add below code above this html tag &lt;h3&gt;Order summary&lt;/h3&gt;.</h5>
                        <div><textarea style="max-width: 624px; height: 84px;width: 100%;">{% if order.tags != blank %}<span>If you had placed a partially paid order then only paid amount will be refunded</span>{% endif %}</textarea>
                        </div>
                </div>
                <div class=" payxnowandrestondelivery-main-area ">
                        <h5><b class="text-orange">Step 7:</b>Edit Order invoice template - Add below code in Invoice email.</h5>
                        <div><textarea style="max-width: 624px; height: 84px;width: 100%;"> {% if order.tags != blank %}{% else %}
               <span><td class="button__cell"><a href="{{ checkout_payment_collection_url }}" class="button__text">Pay now</a></td></span> {% endif %}</textarea>
                        </div>

                        <h5><b class="text-orange"></b>In the place of this code.</h5>
                        <div><textarea style="max-width: 624px; height: 84px;width: 100%;"> <span><td class="button__cell"><a href="{{ checkout_payment_collection_url }}" class="button__text">Pay now</a></td></span></textarea>
                        </div>
                </div>
        </div>
        <div class="payxnowandrestondelivery-zip-flex-row">
        <div class="payxnowandrestondelivery-main-area payxnowandrestondelivery-no-sidebar payxnowandrestondelivery-single-page">
                <div class="payxnowandrestondelivery-head-wrapper">
                        <h2 class="">Checkout button colors</h2>
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

                                <!--<div class="flex-row">
                                        <label for="">Checkout button css class name </label>
                                        <input type="text" name="cg_chkout_btn_class" value="<?php echo (isset($gtbtncolor[0]->cg_chkout_btn_class) ? $gtbtncolor[0]->cg_chkout_btn_class : ''); ?>">
                                </div>
                                <div class="flex-row">
                                        <label for="">Cart remove class </label>
                                        <input type="text" name="cg_cart_remove_class" value="<?php echo (isset($gtbtncolor[0]->cg_cart_remove_class) ? $gtbtncolor[0]->cg_cart_remove_class : ''); ?>">
                                </div>-->

                                <div class="btn-row">
                                        <button type="submit" name="track_color" class="payxnowandrestondelivery-button payxnowandrestondelivery-main-cta" value="submit">Submit</button>
                                </div>

                        </form>
                </div>
        </div>
        <?php if ($_GET['shop'] == 'desinomatetest.myshopify.com') { ?>
                <div class="payxnowandrestondelivery-main-area payxnowandrestondelivery-no-sidebar payxnowandrestondelivery-single-page">
                        <div class="payxnowandrestondelivery-head-wrapper">
                                <h2 class="">Upload Zip Codes</h2>
                        </div>
                        <div class="edit-form-wrapper">
                                <form method="post" enctype="multipart/form-data">

                                        <div class="flex-row">
                                                <label for="">Serviced postal codes</label>
                                                <?php if (!empty($get_allzip)) { ?>
                                                        <a onclick='abc(event);' href="https://app.payxnowandrestondelivery.com/exporcsv?shop=<?php echo $_GET['shop']; ?>" class="postal-btn">Export All</a> 
                                                <?php } ?>
                                                <a onclick='abc(event);' href="https://app.payxnowandrestondelivery.com/samplfcsv?shop=<?php echo $_GET['shop']; ?>" class="postal-btn">Sample CSV</a>
                                                <input type="file" required name="zip_code" accept=".csv">
                                        </div>
                                        <div class="btn-row">
                                                <button type="submit" name="upload_zip" class="payxnowandrestondelivery-button payxnowandrestondelivery-main-cta" value="submit">Submit</button>
                                        </div>

                                </form>
                        </div>
                </div>
        <?php } ?>
        </div>
</div>

</div>