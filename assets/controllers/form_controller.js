import { Controller } from "@hotwired/stimulus";

/* stimulusFetch: 'lazy' */
export default class extends Controller{

    connect(){

        //validation form
        var form = this.element;
        
        form.addEventListener('submit', function (event) {
                
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
    
            form.classList.add('was-validated')
        
        }, false)

    }

}