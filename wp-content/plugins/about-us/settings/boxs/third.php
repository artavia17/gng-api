<?php
    add_meta_box(
        'third',
        'Third Section Config',
        function ($post) {

            $third_first_title = get_post_meta( $post->ID, 'third_first_title', true);
            $third_first_content = get_post_meta( $post->ID, 'third_first_content', true);

            $third_second_title = get_post_meta( $post->ID, 'third_second_title', true);
            $third_second_content = get_post_meta( $post->ID, 'third_second_content', true);
            

            ?>
            
            <section class="about">
                <section class="section_content">
                    <label for="third_first_title">Add First Title</label>
                    <br/>
                    <input type="text" name="third_first_title" id="third_first_title" value="<?= $third_first_title ?>" placeholder="Write here...">                    
                </section>
                <section class="section_content">
                    <label for="third_first_content">Add First Content</label>
                    <br/>
                    <section class="editor">
                        <?php
                            wp_editor($third_first_content, 'third_first_content', array('textarea_name' => 'third_first_content'));
                        ?>
                    </section>
                </section>
                <section class="section_content">
                    <label for="third_second_title">Add Second Title</label>
                    <br/>
                    <input type="text" name="third_second_title" id="third_second_title" value="<?= $third_second_title ?>" placeholder="Write here...">                    
                </section>
                <section class="section_content">
                    <label for="third_second_content">Add Second Content</label>
                    <br/>
                    <section class="editor">
                        <?php
                            wp_editor($third_second_content, 'third_second_content', array('textarea_name' => 'third_second_content'));
                        ?>
                    </section>
                </section>
            </section>


            <?php

        },
        'about',
        'advanced',
        'high'
    );