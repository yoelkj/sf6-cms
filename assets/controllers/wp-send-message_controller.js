import { Controller } from "@hotwired/stimulus";

/* stimulusFetch: 'lazy' */
export default class extends Controller{

    static values = {
        phone: String,
        message: String,
    }

    handleClick(){
        let num= ((this.phoneValue).replace(/\s/g, '')).replace('+', '');
        let msg= this.messageValue;

        window.open(`https://wa.me/${num}?text=${msg}`, '_blank');
    }
}