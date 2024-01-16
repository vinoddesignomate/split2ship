<style>
    .popupCgTransparancy {
        position: relative;
    }

    .popupCgTransparancy:before {
        width: 100%;
        background: rgba(0, 0, 0, 0.5);
        float: left;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
    }

    #showPopUpCG {
        display: none;
        position: relative;
        z-index: 99999;
    }

    .mainBoxCoupon {
        width: 650px;
        max-width: 100%;
        margin: 30px auto;
        background: #fff;
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
        min-width: 120px;
        max-width: 161px;
        width: -webkit-fill-available;
        background: #3783e1;
        min-height: 56px;
        border-radius: 0px;
        align-items: center;
        display: flex;
        text-decoration: none;
        color: #fff;
        padding: 10px 10px;
        font-size: 16px;
        text-align: center;
        letter-spacing: .5px;
        justify-content: center;
        border: none;
        border-right: 1px solid #fff;
    }

    .inlineButtonsCgTabs ul li:first-child {
        border-left: 1px solid #fff;
    }

    .videoInsideCg {
        text-align: center;
        width: 450px;
        max-width: 90%;
        max-height: 100%;
        margin: 0 auto;
        margin-bottom: 30px;
    }

    .videoInsideCg video {
        width: 100%;
    }

    .wdSetcg {
        width: 650px;
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
        margin: 0;
        margin-top: 8px;
        width: 100%;
        max-width: 100%;
    }

    .inlineButtonsCg {
        width: 100%;
        clear: both;
        margin: 25px 0 20px 0;
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

    .inlineButtonsCg ul li {}

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

    .mainDivCGRelative {
        position: relative;
        width: 100%;
    }

    .mainDivCGRelative .screenTopCgSlide {
        transition: aal .2s ease-in-out;
        left: 0;
        top: 0;
        width: 100%;
    }

    .mainDivCGRelative .addCGproductsCls {
        left: 0;
    }

    .mainDivCGRelative {
        display: flex;
        overflow-x: hidden;
    }

    .hideCGthis {
        width: 0 !important;
        transition: all .1s ease-in-out !important;
        visibility: hidden;
        display: none;
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
            <span id="deletePopupCG">X</span>
            <div class="inlineButtonsCgTabs">
                <ul>
                    <li>Enable App </li>
                    <li>Add products </li>
                    <li>Configure the App </li>
                    <li>Email Templates </li>
                </ul>
            </div>
            <div class="mainDivCGRelative">
                <!---Start Screen 1---->
                <div id="enableCGapp" class="screenTopCgSlide">
                    <div class="videoInsideCg">
                        <video controls>
                            <source src="mov_bbb.mp4" type="video/mp4">
                            <source src="mov_bbb.ogg" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="wdSetcg">
                        <ol>
                            <li>Click on online store </li>
                            <li>Click on customize button from right side <br /><img src="/public/images/img1.jpg" /></li>
                            <li>Click on third button from the left â€“ App Embed <br /><img src="/public/images/img1.jpg" /> </li>
                            <li>Click on Split2Ship app and enable it <br /><img src="/public/images/img1.jpg" /> </li>
                        </ol>
                    </div>

                    <div class="inlineButtonsCg">
                        <ul>
                            <li><a href="javascript:void(0)" id="">Having Trouble? Call Us or Chat with Us</a></li>
                            <li><a href="javascript:void(0)" id="nextCgScreen1">Done</a></li>
                        </ul>
                    </div>

                </div>
                <!---End Screen 1---->

                <!---Start Screen 2---->
                <div id="addCGproducts" class="screenTopCgSlide">
                    <div class="videoInsideCg">
                        <video controls>
                            <source src="mov_bbb.mp4" type="video/mp4">
                            <source src="mov_bbb.ogg" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="wdSetcg">
                        <ol type="1" start="5">
                            <li>Click on collection</li>
                            <li>Click on pencil icon and define how much advance you want to take upfront</li>
                            <li>You can define it by percentage or by fixed amount</li>
                        </ol>
                    </div>

                    <div class="inlineButtonsCg">
                        <ul>
                            <li><a href="javascript:void(0)" id="">Having Trouble? Call Us or Chat with Us</a></li>
                            <li><a href="javascript:void(0)" id="nextCgScreen2">Done</a></li>
                            <li><a href="javascript:void(0)" id="">Previous Step</a></li>
                        </ul>
                    </div>

                </div>
                <!---End Screen 2---->

                <!---Start Screen 3---->
                <div id="configureCGapp" class="screenTopCgSlide">
                    <div class="videoInsideCg">
                        <video controls>
                            <source src="mov_bbb.mp4" type="video/mp4">
                            <source src="mov_bbb.ogg" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="wdSetcg">
                        <ol type="1" start="8">
                            <li>Enable the button on cart page and product page</li>
                            <li>Make sure you pick the right color for the background of the button and text color on the button</li>
                            <li>We recommend against taking Partial COD charges instead advertise that you will waive of COD charges if they go for Partial COD</li>
                        </ol>
                    </div>

                    <div class="inlineButtonsCg">
                        <ul>
                            <li><a href="javascript:void(0)" id="">Having Trouble? Call Us or Chat with Us</a></li>
                            <li><a href="javascript:void(0)" id="nextCgScreen3">Done</a></li>
                            <li><a href="javascript:void(0)" id="">Previous Step</a></li>
                        </ul>
                    </div>

                </div>
                <!---End Screen 3---->


                <!---Start Screen 4---->
                <div id="emailCGtemplates" class="screenTopCgSlide">
                    <div class="videoInsideCg">
                        <video controls>
                            <source src="mov_bbb.mp4" type="video/mp4">
                            <source src="mov_bbb.ogg" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="wdSetcg">
                        <ol type="1" start="11">
                            <li>Lorem Ipsum</li>
                            <li>Lorem Ipsum is dummy text</li>
                        </ol>
                    </div>

                    <div class="inlineButtonsCg">
                        <ul>
                            <li><a href="javascript:void(0)" id="">Having Trouble? Call Us or Chat with Us</a></li>
                            <li><a href="javascript:void(0)" id="">Done</a></li>
                            <li><a href="javascript:void(0)" id="">Previous Step</a></li>
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
    $("#showPopUpCG").fadeIn();
    $('body').addClass('popupCgTransparancy');

    /*$("#popupCGclick").click(function() {
        $("#showPopUpCG").fadeIn();
    });*/
    $("#deletePopupCG").click(function() {
        $('body').removeClass('popupCgTransparancy');
        $("#showPopUpCG").fadeOut();
    });


    $("#nextCgScreen1").click(function() {
        $("#enableCGapp").addClass("hideCGthis");
        $("#addCGproducts").addClass("addCGproductsCls");
    });

    $("#nextCgScreen2").click(function() {
        $("#addCGproducts").addClass("hideCGthis");
        $("#configureCGapp").addClass("addCGproductsCls");
    });

    $("#nextCgScreen3").click(function() {
        $("#configureCGapp").addClass("hideCGthis");
        $("#emailCGtemplates").addClass("addCGproductsCls");
    });
</script>