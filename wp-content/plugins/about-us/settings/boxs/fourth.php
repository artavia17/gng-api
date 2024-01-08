<?php
    add_meta_box(
        'fourth',
        'Fourth Section Config',
        function ($post) {

            $title_fourth = get_post_meta( $post->ID, 'title_fourth', true);
            $content_fourth = get_post_meta( $post->ID, 'content_fourth', true);
            $all_icons = get_post_meta( $post->ID, 'all_icons', true);
            

            ?>
            
            <section class="about">
                <section class="section_content">
                    <label for="title_fourth">Add Title</label>
                    <br/>
                    <input type="text" name="title_fourth" id="title_fourth" value="<?= $title_fourth ?>" placeholder="Write here...">                    
                </section>
                <section class="section_content">
                    <label for="content_fourth">Add Content</label>
                    <br/>
                    <section class="editor">
                        <?php
                            wp_editor($content_fourth, 'content_fourth', array('textarea_name' => 'content_fourth'));
                        ?>
                    </section>
                </section>
                <section class="section_content">
                    <label for="content_fourth">Add Values</label>
                    <br/>
                    <input type="hidden" name="all_icons" class="all_icons" value='<?= $all_icons ?>'>
                    <section class="group_list">

                        <section class="item">
                            <span class="title"> *Our Values 1  - Optional</span>

                            <section class="image_container">
                                <div class="images">
                                    <input type="hidden" class="image_code">
                                    <div class="image">

                                    </div>
                                </div>
                                <button type="button" class="button icon_button">Select Icon</button>
                            </section>
                            <section class="text_code">
                                <input type="text" class="description" placeholder="Write here the title...">
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

                .group_list .item{
                    border: 1px dashed #535353;
                    padding: 10px;
                    margin-top: 10px;
                    border-radius: 5px;
                }

                .images{
                    width: 50px;
                    height: 50px;
                    background: #e7e7e7;
                    border-radius: 6px;
                    border: 1px dashed #535353;
                    overflow: hidden;
                }

                .images .image{
                    width: 100%;
                    height: 100%;
                }

                .images .image img{
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }

                .image_container{
                    display: flex;
                    flex-flow: row;
                    align-items: flex-end;
                    margin-top: 10px;
                    column-gap: 4px;
                }

            </style>

            <?php

        },
        'about',
        'advanced',
        'high'
    );