jQuery(document).ready( function($){

    let custom_upload;

    $('.add_image').click( function(e){

        e.preventDefault();

        const galery = $(e.currentTarget).attr('galery');
        const parentElement = $(e.currentTarget).parent();
        const inputHidden = parentElement.find('input[type=hidden]')[0];

        if(custom_upload){
            custom_upload.open();
            return;
        }

        custom_upload = wp.media.frames.file_frame = wp.media({
            multiple: galery ? 'add' : false,
            library: { type: 'image' },
            button: { text : 'Add images' },
        });
        

        custom_upload.on('select', function(){

            $images_data = custom_upload.state().get('selection').toJSON();
            
            inputHidden.value = JSON.stringify($images_data);

            setGaleryImage($)

        });

        custom_upload.on('open', function() {
         
            const jsonImages = getGalery($);
            const selection = custom_upload.state().get('selection');

            jsonImages.forEach( item => {
                const id = item.id;
                const attachment = wp.media.attachment(id);
                attachment.fetch();
                selection.add(attachment ? [attachment] : []);

            });

        });

        custom_upload.open();


    });

    setGaleryImage($);

});


function getGalery($){
    const getImagesValue = $('#galery_input').val();
    return JSON.parse(getImagesValue);
}

function setGaleryImage($){

    const json = getGalery($);
    let imagesHTML = ''

    if(json.length){
        json.forEach( item => {

            imagesHTML += `<div class="img">
                                <img src="${item.url}" />
                                <button class="button removeItem" type="button" id="${item.id}">Remove</button>
                           </div>`;
    
        });
    }else {
        imagesHTML = '<p>No images</p>'
    }
    

    $('.images_galery .imgs').html(imagesHTML);

    remove($)

}

function remove($){


    $('.removeItem').click(function(e){

        const id = $(e.currentTarget).attr('id');

        const getImagesValue = $('#galery_input');
        const getValue = JSON.parse(getImagesValue.val());


        const newElements = getValue.filter( e => {
            return e.id != id;
        })


        getImagesValue[0].value = JSON.stringify(newElements);

        setGaleryImage($);

    });



}