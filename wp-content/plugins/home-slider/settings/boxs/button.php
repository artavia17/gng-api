<?php
    add_meta_box(
        'button',
        'Button config',
        function ($post) {

            $buttonexternal = get_post_meta($post->ID, 'buttonexternal', true);
            $buttontext = get_post_meta($post->ID, 'titlebutton', true);
            $buttonlink = get_post_meta($post->ID, 'buttonaction', true);

            ?>
            
            <section class="button_section">
                <label for="buttonexternal">Add button externallyn</label>
                <br/>
                <label class="switch" for="buttonexternal">
                    <input type="checkbox" id="buttonexternal" name="buttonexternal" <?= $buttonexternal ? 'checked' :  '' ?> >
                    <span class="slider round"></span>
                </label>
                <label for="titlebutton" class="margin">Add text button</label>
                <input type="text" name="titlebutton" id="titlebutton" value="<?= $buttontext ?>" placeholder="Write here...">
                <br/>
                <label for="buttonaction" class="margin">Add link button</label>
                <input type="text" name="buttonaction" id="buttonaction" value="<?= $buttonlink ?>" placeholder="Write here...">
            </section>

            <style>

                .button_section label{

                    font-weight: bold;

                }

                .button_section .switch,
                .button_section .margin{
                    margin-top: 10px;
                    display: block;
                }

                .button_section input{
                    width: 100%;
                    margin-top: 10px;
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

            </style>

            <?php

        },
        'slider',
        'advanced',
        'high'
    );