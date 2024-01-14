<?php

add_meta_box(
    'unavailable',
    'Unavailable',
    function ($post) {

        $galery = get_post_meta($post->ID, 'galery_input', true);
        $unavailable = get_post_meta($post->ID, 'dateInput', true);

        ?>
        
        <section class="unavaible">
            <section class="section_content">
                <label>Add dates that are not enabled</label>
                <br/>
                <input type="hidden" name="dateInput" class="dateInput" value='<?= $unavailable ?>'>
                <section class="group_list">

                    <section class="item">
                        <span class="title">Date 1 - Optional</span>
                        <section class="text_code">
                            <input type="date" class="date">
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


                .unavaible .whatsapp_contents{
                    margin-top: 10px;
                }

                .unavaible .section_content:first-of-type{
                    margin-top: 0px;
                }

                .unavaible label{
                    font-weight: bold;
                }

                .unavaible .item{
                    border: 1px dashed #535353;
                    padding: 10px;
                    margin-top: 10px;
                    border-radius: 5px;
                }

                .unavaible .section_content{
                    margin-top: 10px;
                    display: block;
                }

                .unavaible input{
                    margin-top: 10px;
                    width: 100%;
                }

                .unavaible .code{
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
    'rental_home',
    'advanced',
    'high'
);