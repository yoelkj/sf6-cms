import { Controller } from "@hotwired/stimulus";

export default class extends Controller{

    static values = {
        text: String,
        position: Number
    }

    static targets = ['btn'];

    initialize(){
        this.btnTarget.innerHTML = this.textValue;
    }

    handleScroll(){
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            this.btnTarget.classList.add('show');
        } else {
            this.btnTarget.classList.remove('show');
        }

        /*
        let obj_slogan = document.querySelector('.container-logo em');
        let windowY = window.scrollY;
  
        if (windowY <= 50) {
            // Scrolling UP
            obj_slogan.classList.add('d-block');
            obj_slogan.classList.remove('d-none');
        } else {
            // Scrolling DOWN
            obj_slogan.classList.add('d-none');
            obj_slogan.classList.remove('d-block');
        }
        */


    }

    handleClick(e){
        
        document.body.scrollTop = this.positionValue; // For Safari
        document.documentElement.scrollTop = this.positionValue; // For Chrome, Firefox, IE and Opera

    }

}