<?php
    add_meta_box(
        'first_section',
        'First section',
        function ($post) {

            // $buttonexternal = get_post_meta($post->ID, 'buttonexternal', true);
            // $buttontext = get_post_meta($post->ID, 'titlebutton', true);
            // $buttonlink = get_post_meta($post->ID, 'buttonaction', true);

            $first_title = get_post_meta( $post->ID, 'title_first', true);
            $first_content = get_post_meta($post->ID, 'first_content', true);
            $first_galery = get_post_meta($post->ID, 'first_galery', true);

            ?>
            
            <section class="first_section">
                <section class="section_content">
                    <label for="title_first">Add Title</label>
                    <br/>
                    <input type="text" name="title_first" id="title_first" value="<?= $first_title ?>" placeholder="Write here...">
                </section>
                <section class="section_content">
                    <label for="content_first">Add Content</label>
                    <br/>
                    <section class="editor">
                        <?php
                            wp_editor($first_content, 'first_content', array('textarea_name' => 'first_content'));
                        ?>
                    </section>
                </section>
                <section class="section_content">
                   
                    <label for="mytheme_gallery"><?php esc_html_e( 'Project Gallery', 'mytheme' ); ?></label>
                    
                    <section class="images_galery images">


                        <section class="imgs"></section>

                        <section class="group_button">
                            <input type="hidden" name="first_galery" id="first_galery" value='<?= $first_galery ?>'>
                            <button class="button add_image" type="button" galery="true">Add images</button>
                        </section>

                    </section>

                </section>
            </section>


            <style>

                .first_section .section_content:first-of-type{
                    margin-top: 0px;
                }

                .first_section label{
                    font-weight: bold;
                }

                .first_section .section_content{
                    margin-top: 10px;
                    display: block;
                }

                .first_section input{
                    margin-top: 10px;
                    width: 100%;
                }

                .first_section .editor{
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
        'home',
        'advanced',
        'high'
    );