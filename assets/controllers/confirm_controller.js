import { Controller } from "@hotwired/stimulus";
import { Modal } from "bootstrap";

import $ from 'jquery';

$.noConflict();

/* stimulusFetch: 'lazy' */
export default class extends Controller{

    static values = {
        urlget: String,
    }

    modal = null;

    handleClick(e){
        
        //Open modal
        this.modal = new Modal('#modal_confirm');        
        this.modal.show();

        //Modal information
        const main = this;
        const btn = $(e.currentTarget);
        const confirmModal = document.getElementById('modal_confirm')
        
        main.getContent(btn);

        if (confirmModal) {
            confirmModal.addEventListener('show.bs.modal', event => {
                $('#alert-wrapper').hide();
                
            })
        }

    }

    closeModal(){
        //Close modal
        this.modal.hide();
    }

    async getContent($obj_btn){
        
        const main = this;
        
        let $body = $('#modal_confirm').find('.modal-body');
        let data = {};

        let activeCheck = $obj_btn.attr('activeCheck');

        //data.orderid = $obj_btn.attr('orderid');

        try {
            await $.ajax({
                url: this.urlgetValue,
                method: 'POST',
                data: data,
                beforeSend: function(){
                    $body.html('<div class="col-md text-center my-5"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span></div>');
                },
                success: function(data){


                    $body.html('');
                    $body.html(data); 
                    
                    $('.btn-action-close').off();
                    $('.btn-action-close').on('click', function(){
                       
                        if($(this).attr('action') == 'closeAndContinue' && activeCheck){
                                $('#'+activeCheck).prop('checked', true);
                                $('#'+activeCheck).removeClass('is-invalid')
                                $('#'+activeCheck).addClass('is-valid')    
                        }

                        main.closeModal();
                    });
                
                },
                complete: function(){}
            });
        } catch (e) {
            $body.html('<div class="alert alert-danger">Error! please try again<div>');
        }
    
    }

}