<?php
$shop_name = explode(".", $_GET['shop']);
$store_name = $shop_name[0];
?>
<style>
    #showPopUpCG {
        display: none;
        width: 100%;
        background: rgba(0, 0, 0, 0.5);
        position: fixed;
        height: 100%;
        top: 0px;
        left: 0;
        z-index: 9999;
        float: left;
    }

    .mainBoxCoupon {
        width: 750px;
        max-width: 94%;
        margin: 0px auto;
        background: #fff;
        position: absolute;
        top: 50%;
        left: 50%;
        height: 88%;
        max-height: 800px;
        overflow-x: hidden;
        overflow-y: scroll;
        transform: translate(-50%, -50%);
    }

    .mainBoxCouponInside {
        width: 100%;
        background: #fff;
        float: left;
        position: relative;
        border: 2px solid #cccccc6b;
        box-shadow: 0px 0px 10px #cccccc6b;
        padding: 0px;
        min-height: 300px;
        clear: both;
    }

    .couponSearch {
        background: #cccccc6b;
        padding: 10px;
        margin-bottom: 25px;
        width: 100%;
    }

    .couponSearch .borderInput6 {
        width: 100%;
        border: 1px solid #ccc;
        padding: 12px 8px;
        position: relative;
    }

    .couponSearch .borderInput6 input {
        width: 100%;
        border: none;
        background: none;
        font-size: 15px;
        padding-right: 70px;
    }

    input:focus,
    input:active {
        outline: none;
    }

    .couponSearch .borderInput6 button {
        position: absolute;
        right: 8px;
        top: 11px;
        color: #FC552F;
        font-size: 15px;
        cursor: pointer;
        background: none;
        border: none;
        z-index: 1;
    }

    .couponListMain ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .couponListMain ul li {
        border: 1px solid #cccccc6b;
        margin-bottom: 15px;
    }

    .couponListMain ul li:last-child {
        margin-bottom: 0;
    }

    .couponListMain ul li h5 {
        background: #cccccc6b;
        padding: 12px 15px;
        width: 100%;
        margin: 0;
        font-weight: normal;
        font-size: 15px;
    }

    .insideCoupon01 {
        padding: 20px 15px;
        width: 100%;
        margin: 0;
    }

    .cNinsideCoupon02 {
        width: 100%;
        margin-bottom: 33px;
        position: relative;
    }

    .cNinsideCoupon02 .borderInput6Ins {
        width: 100%;
    }

    .cNinsideCoupon02 .borderInput6Ins .nameOfC {
        border: none;
        text-transform: uppercase;
        background: #f7e08a;
        font-size: 15px;
        display: inline-block;
        padding: 12px 15px 12px 50px;
    }

    .cNinsideCoupon02 button {
        position: absolute;
        right: 8px;
        top: 11px;
        color: #FC552F;
        font-size: 15px;
        cursor: pointer;
        background: none;
        border: none;
        z-index: 1;
    }

    .insideCoupon01 h6 {
        width: 100%;
        margin: 0px 0 10px 0;
        border-bottom: 1px solid #ccc;
        font-weight: normal;
        font-size: 17px;
        padding: 0 0 18px 0;
    }

    .mainBoxCouponInside #deletePopupCG {
        position: absolute;
        top: -18px;
        right: -15px;
        background: #fff;
        font-size: 13px;
        line-height: 19px;
        cursor: pointer;
        color: #000;
        padding: 5px;
        width: 30px;
        height: 30px;
        border-radius: 100%;
        border: 1px solid #ccc;
        text-align: center;
    }

    #popupCGclick {
        cursor: pointer;
    }

    .inlineButtonsCgTabs {
        width: 100%;
        clear: both;
        margin: 0px 0 30px 0;
    }

    .inlineButtonsCgTabs ul {
        list-style: none;
        padding: 0;
        align-items: center;
        flex-wrap: wrap;
        justify-content: center;
        margin: 0;
        display: flex;
        gap: 0px;
    }

    .inlineButtonsCgTabs ul li {
        min-width: 146px;
        max-width: 25%;
        width: -webkit-fill-available;
        background: #6a6a6a;
        min-height: 56px;
        border-radius: 0px;
        align-items: center;
        display: flex;
        text-decoration: none;
        color: #fff;
        padding: 10px 10px;
        font-size: 14px;
        text-align: center;
        letter-spacing: .5px;
        justify-content: center;
        border: none;
        border-right: 1px solid #fff;
    }

    .inlineButtonsCgTabs ul li.activetabcg {
        background: #000;
    }


    .inlineButtonsCgTabs ul li:first-child {
        border-left: 1px solid #fff;
    }

    .videoInsideCg {
        text-align: center;
        width: 100%;
        max-width:500px;
        max-height: 100%;
        margin: 0 auto;
        margin-bottom: 30px;
    }

    .videoInsideCg video {
        width: 100%;
    }

    .wdSetcg {
        width: 100%;
        max-width: 100%;
        padding: 0 30px;
        margin: 0 auto;
    }

    .mainBoxCouponInside ol {
        margin: 0 0 0 18px;
        padding: 0;
        list-style: decimal;
    }

    .mainBoxCouponInside ol li {
        font-size: 18px;
        padding-bottom: 10px;
    }

    .mainBoxCouponInside ol li img {
        width: auto;
        max-width: 100%;
    }

    .inlineButtonsCg {
        width: 100%;
        clear: both;
        float: left;
        margin: 25px 0 20px 0;
        margin-bottom: 0;
        padding-bottom: 25px;
    }

    .inlineButtonsCg ul {
        list-style: none;
        padding: 0;
        align-items: center;
        justify-content: center;
        margin: 0;
        display: flex;
        gap: 15px;
    }

    .inlineButtonsCg ul li a {
        min-width: 120px;
        max-width: 200px;
        background: #000;
        min-height: 56px;
        border-radius: 1px;
        align-items: center;
        display: flex;
        text-decoration: none;
        color: #fff;
        padding: 10px 20px;
        font-size: 16px;
        text-align: center;
        letter-spacing: .5px;
        justify-content: center;
    }

    .inlineButtonsCg ul li a:hover {
        background: #3783e1;
    }

    .mainDivCGRelative .screenTopCgSlide {
        transition: all .25s ease-in-out;
        background: #fff;
        position: absolute;
        left: 100%;
        bottom: 0;
        width: 100%;
    }

    .mainDivCGRelative .screenTopCgSlide.activeArecG {
        position: relative;
        left: 0;
        transition: all .25s ease-in-out !important;
    }

    .mainDivCGRelative .screenTopCgSlide.activeArecG.hideCGthis {
        position: absolute;
        transition: all .25s ease-in-out;
        left: 0;
        display: none;
    }

    .mainDivCGRelative .addCGproductsCls {
        left: 0;
    }

    .mainDivCGRelative {
        display: block;
        overflow-x: hidden;
    }

    .hideCGthis {
        width: 0 !important;
        transition: all .5s ease-in-out !important;
        visibility: hidden;
        opacity: 0;
    }

    .centerCGImg03 {
        text-align: center;
        width: 100%;
    }

    .centerCGImg03 img {
        margin: 15px auto;
    }

    .videoInsideCg iframe {
        max-width: 100% !important;
        width: 100% !important;
        border: 8px solid #3783e13b;
    }

    :root {
        --code-color: darkred;
        --code-bg-color: #F6F6F6;
        --code-font-size: 14px;
        --code-line-height: 1.4;
        --scroll-bar-color: #C5C5C5;
        --scroll-bar-bg-color: #F6F6F6;
    }

    * {
        scrollbar-width: thin;
        scrollbar-color: var(--scroll-bar-color) var(--scroll-bar-bg-color);
    }

    *::-webkit-scrollbar {
        width: 12px;
    }

    *::-webkit-scrollbar-track {
        background: var(--scroll-bar-bg-color);
    }

    *::-webkit-scrollbar-thumb {
        background-color: var(--scroll-bar-color);
        border-radius: 20px;
        border: 3px solid var(--scroll-bar-bg-color);
    }

    @media screen and (max-width:479px) {
        .inlineButtonsCgTabs ul li {
            max-width: 120px;
        }
    }
</style>


<!-- <div id="popupCGclick">Click Me</div> -->
<div id="showPopUpCG">
    <div class="mainBoxCoupon">
        <div class="mainBoxCouponInside">
            <!-- <span id="deletePopupCG">X</span> -->
            <div class="inlineButtonsCgTabs">
                <ul>
                    <li id="enblp" class="tbcls_cg">Enable App </li>
                    <li id="adprdtcg" class="tbcls_cg">Add products </li>
                    <li id="confitbcg" class="tbcls_cg">Configure the App </li>
                    <li id="emptplcg" class="tbcls_cg">Email Templates </li>
                </ul>
            </div>
            <div class="mainDivCGRelative">
                <!---Start Screen 1---->
                <div id="enableCGapp" class="screenTopCgSlide">
                    <div class="videoInsideCg">

                        <iframe width="560" height="280" src="https://www.youtube.com/embed/ASkCOT-IfRw?si=c8M-AfV2q1NbZgoU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

                    </div>
                    <div class="wdSetcg">
                        <ol>
                            <li>Click on online store <div class="centerCGImg03"><img src="/public/images//stp1.webp" /></div>
                            </li>
                            <li>Click on customize button from right side <div class="centerCGImg03"><img src="/public/images/stp2.webp" /></div>
                            </li>
                            <li>Click on third button from the left App Embed <div class="centerCGImg03"><img src="/public/images/step3.webp" /></div>
                            </li>
                            <li>Click on Split2Ship app and enable it <div class="centerCGImg03"><img src="/public/images/stp4.webp" /></div>
                            </li>
                        </ol>
                    </div>

                    <div class="inlineButtonsCg">
                        <ul>
                            <li><a href="javascript:void(0)" onclick="openTawkChat()" id="">Having Trouble? Call Us or Chat with Us</a></li>
                            <li><a href="javascript:void(0)" id="nextCgScreen1">Done</a></li>
                        </ul>
                    </div>

                </div>
                <!---End Screen 1---->

                <!---Start Screen 2---->
                <div id="addCGproducts" class="screenTopCgSlide">
                    <div class="videoInsideCg">
                        <iframe width="560" height="280" src="https://www.youtube.com/embed/3Q8tRv2L6tE?si=HDFDEQgXg68V_OKd" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                    <div class="wdSetcg">
                        <ol type="1" start="5">
                            <li>Click on collection <a onclick='popupclick(event);' href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/products-list">Click here</a>
                                <div class="centerCGImg03"><img src="/public/images/stp2_1.webp" /></div>
                            </li>
                            <li>Click on pencil icon and define how much advance you want to take upfront<div class="centerCGImg03"><img src="/public/images/step2_2.webp" /></div>
                            </li>
                            <li>You can define it by percentage or by fixed amount<div class="centerCGImg03"><img src="/public/images/step2_3.webp" /></div>
                            </li>
                        </ol>
                    </div>

                    <div class="inlineButtonsCg">
                        <ul>
                            <li><a href="javascript:void(0)" onclick="openTawkChat()" id="">Having Trouble? Call Us or Chat with Us</a></li>
                            <li><a href="javascript:void(0)" id="nextCgScreen2">Done</a></li>
                            <li><a href="javascript:void(0)" id="prevstp">Previous Step</a></li>
                        </ul>
                    </div>

                </div>
                <!---End Screen 2---->

                <!---Start Screen 3---->
                <div id="configureCGapp" class="screenTopCgSlide">
                    <div class="videoInsideCg">
                        <iframe width="560" height="280" src="https://www.youtube.com/embed/Whgbr6yXZPI?si=xspexgoC-XR9w3Mi" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                    <div class="wdSetcg">
                        <ol type="1" start="8">
                            <li>Enable the button on cart page and product page <a onclick='popupclick(event);' href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/app-configuration">Click here</a>
                                <div class="centerCGImg03"><img src="/public/images/step3_1.webp" /></div>
                            </li>
                            <li>Make sure you pick the right color for the background of the button and text color on the button <div class="centerCGImg03"><img src="/public/images/step3_2.webp" /></div>
                            </li>
                            <li>We recommend against taking Partial COD charges instead advertise that you will waive of COD charges if they go for Partial COD</li>
                        </ol>
                    </div>

                    <div class="inlineButtonsCg">
                        <ul>
                            <li><a href="javascript:void(0)" onclick="openTawkChat()" id="">Having Trouble? Call Us or Chat with Us</a></li>
                            <li><a href="javascript:void(0)" id="nextCgScreen3">Done</a></li>
                            <li><a href="javascript:void(0)" id="previstp2">Previous Step</a></li>
                        </ul>
                    </div>

                </div>
                <!---End Screen 3---->


                <!---Start Screen 4---->
                <div id="emailCGtemplates" class="screenTopCgSlide">
                    <div class="videoInsideCg">
                        <iframe width="560" height="280" src="https://www.youtube.com/embed/8apDMrtAdXc?si=trvtixNqb6rcTd-7" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                    <div class="wdSetcg">
                        <ol type="1" start="11">
                            <li>Go to the "Tutorial" page of the app <a onclick='popupclick(event);' href="https://admin.shopify.com/store/<?php echo esc($store_name); ?>/apps/pay-x-now-rest-on-delivery/app-tutorials">Click here</a>
                                <div class="centerCGImg03"><img src="/public/images/step4_1.webp" /></div>
                            </li>
                            <li>Scroll down to step number 5 and copy the entire code <div class="centerCGImg03"><img src="/public/images/step4_2.webp" /></div>
                            </li>
                            <li>Navigate to the settings of your store, scroll down, and click on the "Notifications" tab <div class="centerCGImg03"><img src="/public/images/step4_3.webp" /></div>
                            </li>
                            <li>Select the "customer notification" option. <div class="centerCGImg03"><img src="/public/images/step4_4.webp" /></div>
                            </li>
                            <li>Within the Order Processing section, click on "Order Confirmation". <div class="centerCGImg03"><img src="/public/images/step4_5.webp" /></div>
                            </li>
                            <li>Click the "Edit code" button. <div class="centerCGImg03"><img src="/public/images/step_4_6.webp" /></div>
                            </li>
                            <li>Select and delete the entire old code. <div class="centerCGImg03"><img src="/public/images/step_4_7.webp" /></div>
                            </li>
                            <li>Paste the new code that you copied from the app's tutorial page. <div class="centerCGImg03"><img src="/public/images/step4_8.webp" /></div>
                            </li>
                        </ol>
                    </div>

                    <div class="inlineButtonsCg">
                        <ul>
                            <li><a href="javascript:void(0)" onclick="openTawkChat()" id="">Having Trouble? Call Us or Chat with Us</a></li>
                            <li><a href="javascript:void(0)" id="nextCgScreen4">Done</a></li>
                            <li><a href="javascript:void(0)" id="prevstp3">Previous Step</a></li>
                        </ul>
                    </div>

                </div>
                <!---End Screen 4---->


            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    var stepactive = '<?php echo $step_active; ?>';
    // console.log(stepactive);

    function track_steps_ajax(stepsname, stepvlue) {
        var shopname = '<?php echo esc($_GET['shop']); ?>';

        $.ajax({
            type: "POST",
            url: "track_config_steps",
            data: 'shop=' + shopname + '&stepkey=' + stepsname + '&stepvalue=' + stepvlue,
            success: function(response) {}

        });
    }
    
    if (stepactive == 1) {
        $("#showPopUpCG").fadeIn();
        $("#enableCGapp").addClass("addCGproductsCls");
        $("#enableCGapp").addClass("activeArecG");
        $("#enblp").addClass("activetabcg");
        $('body').addClass('popupCgTransparancy');
    } else if (stepactive == 2) {
        $("#showPopUpCG").fadeIn();
        $("#enableCGapp").addClass("hideCGthis");
        $("#addCGproducts").addClass("addCGproductsCls");
        $("#addCGproducts").addClass("activeArecG");
        $("#adprdtcg").addClass("activetabcg");
        $('body').addClass('popupCgTransparancy');
    } else if (stepactive == 3) {
        $("#showPopUpCG").fadeIn();
        $("#addCGproducts").addClass("hideCGthis");
        $("#enableCGapp").addClass("hideCGthis");
        $("#configureCGapp").addClass("addCGproductsCls");
        $("#configureCGapp").addClass("activeArecG");
        $("#confitbcg").addClass("activetabcg");
        $('body').addClass('popupCgTransparancy');
    } else if (stepactive == 4) {
        $("#showPopUpCG").fadeIn();
        $("#enableCGapp").addClass("hideCGthis");
        $("#addCGproducts").addClass("hideCGthis");
        $("#configureCGapp").addClass("hideCGthis");
        $("#emailCGtemplates").addClass("addCGproductsCls");
        $("#emailCGtemplates").addClass("activeArecG");
        $("#emptplcg").addClass("activetabcg");
        $('body').addClass('popupCgTransparancy');
    }

    /*$("#popupCGclick").click(function() {
        $("#showPopUpCG").fadeIn();
    });*/
    $("#deletePopupCG").click(function() {
        $('body').removeClass('popupCgTransparancy');
        $("#showPopUpCG").fadeOut();
    });

    //code for go to previous page one
    $("#prevstp").click(function() {
        $(".tbcls_cg").removeClass("activetabcg");
        $(".screenTopCgSlide").removeClass("activeArecG");
        $(".screenTopCgSlide").removeClass("addCGproductsCls");
        $("#enableCGapp").removeClass("hideCGthis");
        $("#enableCGapp").addClass("addCGproductsCls");
        $("#enableCGapp").addClass("activeArecG");
        $("#enblp").addClass("activetabcg");
    });
    
    $("#previstp2").click(function() {
        $(".tbcls_cg").removeClass("activetabcg");
        $(".screenTopCgSlide").removeClass("activeArecG");
        $(".screenTopCgSlide").removeClass("addCGproductsCls");
        $("#addCGproducts").removeClass("hideCGthis");
        $("#addCGproducts").addClass("addCGproductsCls");
        $("#addCGproducts").addClass("activeArecG");
        $("#adprdtcg").addClass("activetabcg");
    });
    
    $("#prevstp3").click(function() {
        $(".tbcls_cg").removeClass("activetabcg");
        $(".screenTopCgSlide").removeClass("activeArecG");
        $(".screenTopCgSlide").removeClass("addCGproductsCls");
        $("#configureCGapp").removeClass("hideCGthis");
        $("#configureCGapp").addClass("addCGproductsCls");
        $("#configureCGapp").addClass("activeArecG");
        $("#confitbcg").addClass("activetabcg");
    });
    $("#nextCgScreen1").click(function() {
        event.preventDefault();
        $(".tbcls_cg").removeClass("activetabcg");
        $("#enableCGapp").addClass("hideCGthis");
        $("#addCGproducts").addClass("addCGproductsCls");
        $("#addCGproducts").addClass("activeArecG");
        $("#adprdtcg").addClass("activetabcg");

        track_steps_ajax('step1', 1);
        // Scroll to the "addCGproducts" div
        // Scroll to the "addCGproducts" div
        var targetDiv = $(".videoInsideCg");
        $('html, body').animate({
            scrollTop: targetDiv.offset().top
        }, 200); // Adjust the duration as needed
    });

    $("#nextCgScreen2").click(function() {
        $(".tbcls_cg").removeClass("activetabcg");
        var targetDiv = $(".videoInsideCg");
        $('html, body').animate({
            scrollTop: targetDiv.offset().top
        }, 200); // Adjust the duration as needed
        $("#addCGproducts").addClass("hideCGthis");
        $("#configureCGapp").addClass("addCGproductsCls");
        $("#configureCGapp").addClass("activeArecG");
        $("#confitbcg").addClass("activetabcg");
       
        track_steps_ajax('step2', 1);
    });

    $("#nextCgScreen3").click(function() {
        $(".tbcls_cg").removeClass("activetabcg");
        $("#configureCGapp").addClass("hideCGthis");
        $("#emailCGtemplates").addClass("addCGproductsCls");
        $("#emailCGtemplates").addClass("activeArecG");
        $("#emptplcg").addClass("activetabcg");
        var targetDiv = $(".videoInsideCg");
        $('html, body').animate({
            scrollTop: targetDiv.offset().top
        }, 200); // Adjust the duration as needed
        track_steps_ajax('step3', 1);
    });
    $("#nextCgScreen4").click(function() {
        $(".tbcls_cg").removeClass("activetabcg");
        $('body').removeClass('popupCgTransparancy');
       
        $("#showPopUpCG").fadeOut();
        track_steps_ajax('step4', 1);
    });

    function popupclick(event) {
        event.preventDefault();
        var href = event.currentTarget.getAttribute('href')
        window.open(href, '_blank');
    }
</script>