
const jsonDate = {};

window.addEventListener('DOMContentLoaded', () => {

    writenElement();

    setItems();

});

function setItems(){

    const hiddenElement = document.querySelector('.dateInput');
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
            const inputDate = elementIndividual.querySelector('.date');

            inputDate.value = value[key].date;

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
                        newTitle.textContent = `*Date ${key + 1} ${ key + 1 == 1 ? ' - Optional' : ' - Required' }`;
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
    const hiddenElement = document.querySelector('.dateInput')

    elements.forEach( (item, key) =>{

        const date = item.querySelector('.date').value;

        newJson[key] = {
            'date': date,
        }


    });

    console.log(newJson);

    hiddenElement.value = JSON.stringify(newJson);

}

function printHtml(count){


    const html = `
        <section class="item">
            <span class="title"> *Date ${count + 1} ${ count + 1 == 1 ? ' - Optional' : ' - Required' } </span>

            <section class="text_code">
                <input type="date" class="date" required>
                <button class="button add" type="button">Add</button>
                <button class="button remove" type="button">Remove</button>
            </section>
        </section>
    `;

    return html;

}