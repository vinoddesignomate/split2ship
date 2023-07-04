<!-- main area -->
<div class="payxnowandrestondelivery-container">
    <div class="payxnowandrestondelivery-main-area">
        <div class="payxnowandrestondelivery-inner-wrapper">

            <div class="payxnowandrestondelivery-main-data-col">
                <div class="payxnowandrestondelivery-head-wrapper">
                    <h2>Delivery partner name</h2>

                </div>
                <div class="payxnowandrestondelivery-form-wrapper">
                    <form id="store_user_trk" method="post" class="payxnowandrestondelivery-custom-form">
                        <span id="ermsg"></span>
                        <div class="">
                            <label for="">Email Address</label>
                            <input type="email" id="ship_email" name="ship_email" placeholder="Exsmp@email.com" value="<?php echo isset($shiprocket_info[0]->email) ? $shiprocket_info[0]->email : '';?>">
                        </div>
                        <div class="payxnowandrestondelivery-password-row">
                            <label for="">Password 
                                <!-- <span><a href="">Forgot Password</a></span> -->
                        </label>

                            <input type="text" name="ship_pwd" id="ship_pwd" placeholder="Enter password" value="<?php echo isset($shiprocket_info[0]->password) ? $shiprocket_info[0]->password : '';?>">
                        </div>
                        <div class="">
                            <label for="">Channel ID</label>
                            <input  type="text" id="ship_chnl_id" name="ship_chnl_id" placeholder="Enter channel id" value="<?php echo isset($shiprocket_info[0]->channel_id) ? $shiprocket_info[0]->channel_id : '';?>">
                        </div>
                        <div class=" payxnowandrestondelivery-form-btn">
                        <?php if (empty($shiprocket_info)) { ?>
                            <button type="submit" name="save_users" id="savebtn" class="payxnowandrestondelivery-button" value="save">Save</button>
                            <?php } else { ?>
                            <button type="submit" name="save_users" id="savebtn" value="save" class="payxnowandrestondelivery-button">Update</button>
                            <?php } ?>

                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
</div>