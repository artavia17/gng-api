let buttonAdd, containerElement, hiddenGlobal;
let jsonElement = {};

window.addEventListener('DOMContentLoaded', () => {

    buttonAdd = document.querySelectorAll('.item .add');
    containerElement = document.querySelector('.group_list');
    hiddenGlobal = document.querySelector('.all_icons');
    
    setNewIcons();
    selectIcon();
    createElement();
    inputElement();

});

function setNewIcons(){

    const jsonElement = JSON.parse(hiddenGlobal.value);
    const count = Object.keys(jsonElement).length;

    for(let i = 0; i < count - 1; i++){
        containerElement.insertAdjacentHTML('beforeend', htmlCode(`*Our Values ${i + 2}  - Required`));
    }

    const allElement = containerElement.querySelectorAll('.item');

    Object.keys(jsonElement).forEach( e => {

        const key = Number(e);
        const jsonUniqElement = jsonElement[key];
        const element = allElement[key];
        const imageCode = element.querySelector('.image_code');
        const image = element.querySelector('.image');
        const description = element.querySelector('.description');

        imageCode.value = JSON.stringify(jsonUniqElement.icon);

        if(jsonUniqElement.icon.url){
            image.innerHTML = `<img src="${jsonUniqElement.icon.url}" />`;
        }

        description.value = jsonUniqElement.title;

    });

    buttonAdd = document.querySelectorAll('.item .add');
    removeElement();


}

function selectIcon(){

    const buttonIcon = document.querySelectorAll('.icon_button');
    let custom_upload;
    let image_data;

    buttonIcon.forEach( e => {

        e.onclick = () => {

            let parent = e.parentElement;
            let image = parent.querySelector('.images');
            let image_input = image.querySelector('input');
            let image_container = image.querySelector('.image');

            if(custom_upload){
                custom_upload.open();
                return;
            }

            custom_upload = wp.media.frames.file_frame = wp.media({
                multiple: false,
                library: { type: 'image' },
                button: { text: 'Add Icon' },
            });

            custom_upload.on('select', function(){

                image_data = custom_upload.state().get('selection').toJSON()[0];
                image_input.value = JSON.stringify(image_data);
                image_container.innerHTML = `<img src="${image_data.url}" />`;
                getJson();

            });

            custom_upload.open();

        }

    });

}

function createElement(){

    injectElement();
    removeElement();

}

function removeElement(){

    const remove = containerElement.querySelectorAll('.remove');

    remove.forEach( e => {

        e.onclick = () => {

            e.parentElement.parentElement.remove();
            title();
            getJson();

        }

    })


}

function injectElement(){

    buttonAdd.forEach( e =>{

        e.onclick = () => {
            
            containerElement.insertAdjacentHTML('beforeend', htmlCode());

            buttonAdd = document.querySelectorAll('.item .add');

            createElement();
            selectIcon();
            title();
            inputElement();

        }

    });

}

function inputElement(){

    const element = containerElement.querySelectorAll('input');

    element.forEach(e=>{
        e.oninput = () => {

            getJson();

        }
    })

}

function title(){

    const titleElement = containerElement.querySelectorAll('.title');

    titleElement.forEach( (item, key) =>{

        item.textContent = key + 1 == 1 ? `*Our Values ${key + 1}  - Optional` : `*Our Values ${key + 1}  - Required`;

    });

}


function htmlCode(title = ''){

    let html = `
        <section class="item">
            <span class="title">${title}</span>

            <section class="image_container">
                <div class="images">
                    <input type="hidden" class="image_code">
                    <div class="image"></div>
                </div>
                <button type="button" class="button icon_button">Select Icon</button>
            </section>
            <section class="text_code">
                <input type="text" class="description" placeholder="Write here the title...">
                <button class="button add" type="button">Add</button>
                <button class="button remove" type="button">Remove</button>
            </section>
        </section>
    `

    return html;

}


function getJson(){

    let item = document.querySelectorAll('.item');
    jsonElement = {};
    console.clear();

    item.forEach( (e, key) =>{

        const imageCode = e.querySelector('.image_code');
        const text = e.querySelector('.description');

        jsonElement[key] = {
            'title': text.value,
            'icon': imageCode.value ? JSON.parse(imageCode.value) : ''
        }

    });

    hiddenGlobal.value = JSON.stringify(jsonElement);

}