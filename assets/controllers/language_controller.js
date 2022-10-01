import { Controller } from "@hotwired/stimulus";

export default class extends Controller{
    
    static targets = ['lang'];
    activeLanguage;

    static values = {
        primaryColor: String, 
        secondaryColor: String,
        locale: String    
    }

    connect(){
        
        if(this.primaryColorValue && this.primaryColorValue){
            const buttons = this.element.getElementsByClassName("btn");
            
            Array.from(buttons).forEach( el => {
                if(el.className.match('active')) el.style.background = this.primaryColorValue;
                if(el.className.match('disabled')) el.style.background = this.secondaryColorValue;
            });
        }
    }

    onCLick(event){
        
        const currentTarget = event.currentTarget;
        this.activeLanguage = currentTarget.getAttribute("language");

        if(this.localeValue == this.activeLanguage || currentTarget.className.match('disabled')) return false;
        
        window.location.replace((window.location.href).replace('/'+this.localeValue+'/', '/'+this.activeLanguage+'/'));

    }

}