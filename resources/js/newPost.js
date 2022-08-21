

function onSelectBar(){

    console.log('aaa');

    const barList = document.getElementsByClassName('v-btn__content');

    for(let i = 0; i < barList.length; i++){

        barList[i].addEventListener('click',this.getBarName);
        this.closeModal;
    }

}

function getBarName(){

    let barName = this.innerHTML;
    console.log(barName);

}

function closeModal(){

    

}

export default {
    onSelectBar,
    getBarName,
    closeModal,
}