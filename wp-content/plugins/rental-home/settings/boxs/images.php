<?php
    add_meta_box(
        'galery',
        'Galery',
        function ($post) {

            $galery = get_post_meta($post->ID, 'galery_input', true);

            ?>
            
            <section class="galery">
                <section class="section_content">
                   
                   <section class="images_galery images">


                       <section class="imgs"></section>

                       <section class="group_button">
                           <input type="hidden" name="galery_input" id="galery_input" value='<?= $galery ?>'>
                           <button class="button add_image" type="button" galery="true">Add images</button>
                       </section>

                   </section>

               </section>
            </section>


            <style>

                .galery .section_content:first-of-type{
                    margin-top: 0px;
                }

                .galery label{
                    font-weight: bold;
                }

                .galery .section_content{
                    margin-top: 10px;
                    display: block;
                }

                .galery input{
                    margin-top: 10px;
                    width: 100%;
                }

                .galery .editor{
                    margin-top: 10px;
                }

                .images_galery .imgs{

                    display: grid;
                    grid-template-columns: repeat(3, 1fr);
                    grid-gap: 15px;
                    margin: 10px 0px;

                }

                .images_galery .imgs  img{
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    border-radius: 10px;
                }

                .images_galery .imgs  .img{
                    width: 100%;
                    height: 100%;
                    position: relative;
                }

                .images_galery .imgs  .img button{

                    position: absolute;
                    z-index: 1;
                    right: 10px;
                    top: 10px

                }

                .page-title-action{
                    display: none !important;
                }

            </style>

            <?php

        },
        'rental_home',
        'advanced',
        'high'
    );