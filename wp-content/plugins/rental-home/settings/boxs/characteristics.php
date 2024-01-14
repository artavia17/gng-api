<?php
    add_meta_box(
        'characteristics',
        'Characteristics',
        function ($post) {
    
            $bedrooms = get_post_meta($post->ID, 'bedrooms', true);
            $bathrooms = get_post_meta($post->ID, 'bathrooms', true);
            $beds = get_post_meta($post->ID, 'beds', true);
            $baths = get_post_meta($post->ID, 'baths', true);
            $sq_ft = get_post_meta($post->ID, 'sq_ft', true);

            ?>
            
            <section class="characteristics">
                <section class="section_content">
                    <label for="bedrooms">Add Bedrooms</label>
                    <input type="number" id="bedrooms" name="bedrooms" placeholder="Write here the number of bedrooms..." value="<?= $bedrooms ?>">
                </section>

                <section class="section_content">
                    <label for="bathrooms">Add Bathrooms</label>
                    <input type="number" id="bathrooms" name="bathrooms" placeholder="Write here the number of bathrooms..." value="<?= $bathrooms ?>">
                </section>

                <section class="section_content">
                    <label for="beds">Add Beds</label>
                    <input type="number" id="beds" name="beds" placeholder="Write here the number of beds..." value="<?= $beds ?>">
                </section>

                <section class="section_content">
                    <label for="baths">Add Baths</label>
                    <input type="number" id="baths" name="baths" placeholder="Write here the number of baths..." value="<?= $baths ?>">
                </section>

                <section class="section_content">
                    <label for="sq_ft">Add SQ FT</label>
                    <input type="number" id="sq_ft" name="sq_ft" placeholder="Write here the number of sq ft..." value="<?= $sq_ft ?>">
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
                    
                    .characteristics {
                        display: grid;
                        grid-template-columns: repeat(2, 1fr);
                        grid-gap: 15px;
                        margin-top: 10px;
                    }
    
                    .characteristics .whatsapp_contents{
                        margin-top: 10px;
                    }
    
                    .characteristics .section_content:first-of-type{
                        /* margin-top: 0px; */
                    }
    
                    .characteristics label{
                        font-weight: bold;
                    }
    
                    .characteristics .item{
                        border: 1px dashed #535353;
                        padding: 10px;
                        margin-top: 10px;
                        border-radius: 5px;
                    }
    
                    .characteristics .section_content{
                        margin-top: 0px;
                        display: block;
                    }

                    .characteristics .section_content:last-of-type{
                        grid-area: 3 / span 2;
                    }
    
                    .characteristics input{
                        margin-top: 10px;
                        width: 100%;
                    }
    
                    .characteristics .code{
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