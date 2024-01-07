<?php
    add_meta_box(
        'second_section',
        'Second section',
        function ($post) {

            $second_title = get_post_meta( $post->ID, 'title_second', true);
            $second_content = get_post_meta($post->ID, 'second_content', true);

            $buttonexternal = get_post_meta($post->ID, 'buttonexternal_secont', true);
            $buttontext = get_post_meta($post->ID, 'titlebutton_secont', true);
            $buttonlink = get_post_meta($post->ID, 'buttonaction_secont', true);

            ?>
            
            <section class="second_section">
                <section class="section_content">
                    <label for="title_second">Add Title</label>
                    <br/>
                    <input type="text" name="title_second" id="title_second" value="<?= $second_title ?>" placeholder="Write here...">
                </section>
                <section class="section_content">
                    <label for="second_content">Add Content</label>
                    <br/>
                    <section class="editor">
                        <?php
                            wp_editor($second_content, 'second_content', array('textarea_name' => 'second_content'));
                        ?>
                    </section>
                </section>
                <section class="button_section">
                    <label for="buttonexternal_secont" class="margin">Add button externallyn</label>
                    <br/>
                    <label class="switch" for="buttonexternal_secont">
                        <input type="checkbox" id="buttonexternal_secont" name="buttonexternal_secont" <?= $buttonexternal ? 'checked' :  '' ?> >
                        <span class="slider round"></span>
                    </label>
                    <label for="titlebutton_secont" class="margin">Add text button</label>
                    <input type="text" name="titlebutton_secont" id="titlebutton_secont" value="<?= $buttontext ?>" placeholder="Write here...">
                    <br/>
                    <label for="buttonaction_secont" class="margin">Add link button</label>
                    <input type="text" name="buttonaction_secont" id="buttonaction_secont" value="<?= $buttonlink ?>" placeholder="Write here...">
                </section>
            </section>


            <style>

                .second_section .section_content:first-of-type{
                    margin-top: 0px;
                }

                .second_section label{
                    font-weight: bold;
                }

                .second_section .section_content{
                    margin-top: 10px;
                    display: block;
                }

                .second_section input{
                    margin-top: 10px;
                    width: 100%;
                }

                .second_section .editor{
                    margin-top: 10px;
                }

                .home-item,
                .home-item:hover{
                    background: #2271b1;
                    color: #fff !important;
                    position: relative;
                }

                .home-item{
                    padding: 0px 0px !important;
                }

                .home-item div.wp-menu-image:before{
                    color: #fff !important;
                }

                .home-item::after{
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

                .button_section label{
                    font-weight: bold;
                }

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

                .postbox .inside{
                    line-height: 10px;
                }


            </style>

            <?php

        },
        'home',
        'advanced',
        'high'
    );