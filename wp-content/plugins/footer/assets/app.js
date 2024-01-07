
const jsonNumber = {};

window.addEventListener('DOMContentLoaded', () => {

    writenElement();

    setItems();

});

function setItems(){

    const hiddenElement = document.querySelector('.phoneNumber');
    const elementFather = document.querySelector('.group_list');

    if(hiddenElement){

        const value = JSON.parse(hiddenElement.value);
        const count = Object.keys(value).length;

        for(let i = 0; i < count - 1; i++){
            elementFather.insertAdjacentHTML("beforeend", printHtml(i + 1));
        }

        const elements = elementFather.querySelectorAll('.item');

        Object.keys(value).forEach( key => {

            const elementIndividual = elements[key];

            const inputCheck = elementIndividual.querySelector('.whatsapp');
            const inputCode = elementIndividual.querySelector('.code');
            const inputNumber = elementIndividual.querySelector('.number');
            const inputCountry = elementIndividual.querySelector('.country');

            inputCheck.checked = value[key].whatsapp;
            inputCode.value = value[key].code;
            inputNumber.value = value[key].number;
            inputCountry.value = value[key].country;

        });

        writenElement();

    }


}


function writenElement(){

    const elementFather = document.querySelector('.group_list')
    const elements = elementFather.querySelectorAll('.item')

    elements.forEach( element => {
        
        const inputsCodeAll = element.querySelectorAll('input');

        inputClik(elements, elementFather);

        inputsCodeAll.forEach( input => {

            input.oninput = () => {

                setJson(elements)
                inputClik(elements, elementFather)

            }

        });

    });

}

function inputClik(elements, elementFather){

    elements.forEach( (item, key) =>{

        const add = item.querySelector('.add');
        const remove = item.querySelector('.remove');
        
        add.onclick = () => {

            elementFather.insertAdjacentHTML("beforeend", printHtml(elements.length));

            writenElement();

        }

        if(remove){

            remove.onclick = () => {

                item.remove();

                const newElements = elementFather.querySelectorAll('.item')

                newElements.forEach( (itemTitle, key) => {

                    const newTitle = itemTitle.querySelector('.title');

                    if(newTitle){
                        newTitle.textContent = `*Phone number ${key + 1} ${ key + 1 == 1 ? ' - Optional' : ' - Required' }`;
                    }

                });

                writenElement();

                setJson(newElements)

            }

        }

    });

}

function setJson(elements){

    const newJson = {};
    const hiddenElement = document.querySelector('.phoneNumber')

    elements.forEach( (item, key) =>{

        const redirect = item.querySelector('.whatsapp').checked;
        const code = item.querySelector('.code').value;
        const number = item.querySelector('.number').value;
        const country = item.querySelector('.country').value;

        if(code.length && number.length){

            newJson[key] = {
                'whatsapp': redirect,
                'code': code,
                'number': number,
                'country': country,
            }

        }


    });

    console.log(newJson);

    hiddenElement.value = JSON.stringify(newJson);

}

function printHtml(count){


    const html = `
        <section class="item">
            <span class="title"> *Phone number ${count + 1} ${ count + 1 == 1 ? ' - Optional' : ' - Required' } </span>

            <section class="whatsapp_contents">
                <span>Redirect to WhatsApp: </span>
                <label class="switch">
                    <input type="checkbox" id="whatsapp" class="whatsapp" name="whatsapp"/>
                    <span class="slider round"></span>
                </label>
            </section>

            <section class="text_code">
                <input type="text" class="country" required placeholder="Write here the country initials...">
                <input type="text" class="code" required placeholder="Write here the country code...">
                <input type="text" class="number" required placeholder="Write here the phone number...">
                <button class="button add" type="button">Add</button>
                <button class="button remove" type="button">Remove</button>
            </section>
        </section>
    `;

    return html;

}