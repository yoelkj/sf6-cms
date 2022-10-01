import { Controller } from "@hotwired/stimulus";

export default class extends Controller{
    
    static targets = ['choice', 'input']
    
    initialize () {
        
    }

    connect(){
        
    }


    handleChoiceChange(event){

        /*

        //validation
        this.choiceTargets.forEach((element) => {
            var idx = element.selectedIndex;
            
            if(!element.options[idx].value){
                element.setAttribute('required', '');
            }
        });

        const addCollectionButtons = document.getElementsByClassName('field-collection-add-button');
        
        if(this.choiceTargets.length == 1){
            
            for (var i = 0; i < addCollectionButtons.length; i ++) {
                addCollectionButtons[i].style.display = 'block';
            }

            return;
        }else{
            
            
            console.log(addCollectionButtons);

            for (var i = 0; i < addCollectionButtons.length; i ++) {
                addCollectionButtons[i].style.display = 'none';
            }

        }
        */
        
        /*
        var currentTarget = event.currentTarget;
        var selected_value = currentTarget.value;

        this.choiceTargets.forEach((element) => {
            var idx = element.selectedIndex;
            
            if(element.options[idx].value == selected_value){
                currentTarget.value = '';
            }
        });
        */

        
        //    if (element.dataset.colorId == this.colorIdValue) {
        //        element.classList.add('selected');
        //    } else {
        //        element.classList.remove('selected');
        //    }
            

    }


    findDuplicated(targets){

        var first_value = '';
        targets.forEach(element => {
            first_value = element.options[element.selectedIndex].value;
            

        
        });

    }



}