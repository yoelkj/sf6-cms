import { Controller } from "@hotwired/stimulus";
import { Modal } from "bootstrap";

import $ from 'jquery';

$.noConflict();

/* stimulusFetch: 'lazy' */
export default class extends Controller{

    static values = {}

    modal = null;

    handleClick(e){
        
        const btn = $(e.currentTarget);
        const modal_target = btn.closest('.product').find('.modal').eq(0);

        let obj_modal = document.getElementById(modal_target.attr('id'));
        this.modal = new Modal('#'+modal_target.attr('id'));        
        
        obj_modal.addEventListener('show.bs.modal', () => {
            console.log('El modal está abriéndose.');
        });
        
        // Escucha el evento `shown.bs.modal` para confirmar que se ha completado
        obj_modal.addEventListener('shown.bs.modal', () => {
            console.log('El modal se ha abierto completamente.');
        });
        
        this.modal.show();
        
        
        /*
        //Modal information
        const main = this;
        const confirmModal = document.getElementById('modal_confirm')
        
        main.getContent(btn);

        if (confirmModal) {
            confirmModal.addEventListener('show.bs.modal', event => {
                $('#alert-wrapper').hide();
                
            })
        }
        */

    }

    closeModal(){
        //Close modal
        this.modal.hide();

        $('.btn-action-close').off();
                    $('.btn-action-close').on('click', function(){
                       
                        if($(this).attr('action') == 'closeAndContinue' && activeCheck){
                                $('#'+activeCheck).prop('checked', true);
                                $('#'+activeCheck).removeClass('is-invalid')
                                $('#'+activeCheck).addClass('is-valid')    
                        }

                        main.closeModal();
                    });
    }

}