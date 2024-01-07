<?php
    add_meta_box(
        'first',
        'First Section Config',
        function ($post) {

            $title_first = get_post_meta( $post->ID, 'title_first', true);
            $content_first = get_post_meta( $post->ID, 'content_first', true);
            

            ?>
            
            <section class="about">
                <section class="section_content">
                    <label for="title_first">Add Title</label>
                    <br/>
                    <input type="text" name="title_first" id="title_first" value="<?= $title_first ?>" placeholder="Write here...">                    
                </section>
                <section class="section_content">
                    <label for="content_first">Add Content</label>
                    <br/>
                    <section class="editor">
                        <?php
                            wp_editor($content_first, 'content_first', array('textarea_name' => 'content_first'));
                        ?>
                    </section>
                </section>
            </section>

            <style>

                .about-item,
                .about-item:hover,
                .about-item:focus,
                .about-item:active{
                    background: #2271b1;
                    color: #fff !important;
                    position: relative;
                }

                .about-item div.wp-menu-image:before{
                    color: #fff !important;
                }

                .about-item::after{
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

                .about label{
                    font-weight: bold;
                }

                .about .section_content:first-of-type{
                    margin-top: 0px;
                }

                .about .section_content{
                    margin-top: 10px;
                    display: block;
                }

                .about input{
                    margin-top: 10px;
                    width: 100%;
                }

                .about  .editor{
                    margin-top: 10px;
                }

                .page-title-action{
                    display: none !important;
                }


            </style>

            <?php

        },
        'about',
        'advanced',
        'high'
    );