<?php
    add_meta_box(
        'footer',
        'Footer Config',
        function ($post) {

            $instagram = get_post_meta( $post->ID, 'instagram', true);
            $userinstagram = get_post_meta( $post->ID, 'userinstagram', true);
            $address = get_post_meta( $post->ID, 'address', true);
            $numbers = get_post_meta( $post->ID, 'phone_numbers', true);
            $email = get_post_meta( $post->ID, 'email', true);
            

            ?>
            
            <section class="footer">
                <section class="section_content">
                    <label for="instagram">Add Instagram</label>
                    <br/>
                    <section class="instagram">
                        <input type="text" name="instagram" id="instagram" value="<?= $instagram ?>" placeholder="Write url here...">
                        <input type="text" name="userinstagram" id="userinstagram" value="<?= $userinstagram ?>" placeholder="Write user here...">
                    </section>
                </section>
                <section class="section_content">
                    <label for="address">Add Address</label>
                    <br/>
                    <input type="text" name="address" id="address" value="<?= $address ?>" placeholder="Write here...">
                </section>
                <section class="section_content">
                    <label for="email">Add Email</label>
                    <br/>
                    <input type="text" name="email" id="email" value="<?= $email ?>" placeholder="Write here...">
                </section>
                <section class="section_content">
                    <label>Add Phone Numbers</label>
                    <br/>
                    <input type="hidden" name="phone_numbers" class="phoneNumber" value='<?= $numbers ?>'>
                    <section class="group_list">

                        <section class="item">
                            <span class="title"> *Phone number 1  - Optional</span>

                            <section class="whatsapp_contents">
                                <span>Redirect to WhatsApp: </span>
                                <label class="switch">
                                    <input type="checkbox" id="whatsapp" class="whatsapp" name="whatsapp"/>
                                    <span class="slider round"></span>
                                </label>
                            </section>

                            <section class="text_code">
                                <input type="text" class="country" placeholder="Write here the country initials...">
                                <input type="text" class="code" placeholder="Write here the country code...">
                                <input type="text" class="number" placeholder="Write here the phone number...">
                                <button class="button add" type="button">Add</button>
                            </section>
                        </section>

                    </section>
                </section>
            </section>


            <style>


                .group_list .item span{
                    /* margin-top: 10px; */
                    display: block;
                    font-weight: bold;
                    font-size: 0.75rem;
                    user-select: none;
                    pointer-events: none;
                }

                .group_list .item .text_code{

                    display: flex;
                    justify-content: center;
                    align-items: center;
                    column-gap: 5px;

                }

                .group_list .item button{
                    margin-top: 10px;
                }

                .footer-item,
                .footer-item:hover,
                .footer-item:focus,
                .footer-item:active{
                    background: #2271b1;
                    color: #fff !important;
                    position: relative;
                }

                .footer-item div.wp-menu-image:before{
                    color: #fff !important;
                }

                .footer .whatsapp_contents{
                    display: flex;
                    align-items: center;
                    column-gap: 10px;
                }

                .footer-item::after{
                    right: 0;
                    border: solid 8px transparent;
                    content: " ";
                    height: 0;
                    width: 0;
                    position: absolute;
                    pointer-events: none;
                    border-right-color: #f0f0f1;
                    top: 50%;
                    margin-top: -8px;
                }

                .footer .whatsapp_contents{
                    margin-top: 10px;
                }

                .footer .section_content:first-of-type{
                    margin-top: 0px;
                }

                .footer label{
                    font-weight: bold;
                }

                .footer .item{
                    border: 1px dashed #535353;
                    padding: 10px;
                    margin-top: 10px;
                    border-radius: 5px;
                }

                .footer .section_content{
                    margin-top: 10px;
                    display: block;
                }

                .footer input{
                    margin-top: 10px;
                    width: 100%;
                }

                .footer .code{
                    width: calc(100% - 100px);
                }

                .page-title-action{
                    display: none !important;
                }


                /* The switch - the box around the slider */
                .switch {
                    position: relative;
                    display: inline-block;
                    width: 52px;
                    height: 25px;
                }

                /* Hide default HTML checkbox */
                .switch input {
                    opacity: 0;
                    width: 0;
                    height: 0;
                }

                /* The slider */
                .slider {
                    position: absolute;
                    cursor: pointer;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background-color: #ccc;
                    -webkit-transition: .4s;
                    transition: .4s;
                }

                .slider:before {
                    position: absolute;
                    content: "";
                    height: 17px;
                    width: 17px;
                    left: 4px;
                    bottom: 4px;
                    background-color: white;
                    -webkit-transition: .4s;
                    transition: .4s;
                }

                input:checked + .slider {
                    background-color: #2196F3;
                }

                input:focus + .slider {
                    box-shadow: 0 0 1px #2196F3;
                }

                input:checked + .slider:before {
                    -webkit-transform: translateX(26px);
                    -ms-transform: translateX(26px);
                    transform: translateX(26px);
                }

                /* Rounded sliders */
                .slider.round {
                    border-radius: 34px;
                }

                .slider.round:before {
                    border-radius: 50%;
                }

                .instagram{
                    display: flex;
                }

            </style>

            <?php

        },
        'footer',
        'advanced',
        'high'
    );