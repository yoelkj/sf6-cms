import { Controller } from "@hotwired/stimulus";
import  $ from "jquery";
import { Modal, Offcanvas } from "bootstrap";

$.noConflict();

/* stimulusFetch: 'lazy' */
export default class extends Controller{

    static values = {
        url: String,
        urlGoToCart: String,
        i18nMsgAddedProduct: String ,
        i18nMsgRequestConfirmation: String,
        i18nMsgViewCart: String,
        i18nMsgItems: String,
        i18nMsgPrice: String
    }

    connect(){}
    initialize(){}

    handleChangeInputValue(e){
        
        let $obj_input = $(e.currentTarget);
        let $obj_content = $obj_input.parent();
        let step = parseInt($obj_content.attr('step'));
        let input_value = parseInt($obj_input.val()); 
        
        if((input_value % step) !== 0){    
            $obj_input.val(step);
        }
        
    }

    handleInputValue(e){

        let $obj_btn = $(e.currentTarget);
        let $obj_content_input = $obj_btn.parent();
        let step = parseInt($obj_content_input.attr('step'));

        let $obj_input = $obj_content_input.find('input[type="text"]').eq(0);

        let input_int_val = parseInt($obj_input.val()); 
        input_int_val = (input_int_val) ? input_int_val : 0;
        
        console.log(input_int_val + step);

        if($obj_btn.attr('push') == 'up'){   
            $obj_input.val( input_int_val + step );
        }

        if($obj_btn.attr('push') == 'down'){
            let new_val = input_int_val - step;
            $obj_input.val( ( new_val <= 0) ? step : new_val );
        }

        //console.log(step, $obj_input.val);

    }



    async handleAddToCart(e){
        
        let main = this;
        
        let $obj_btn = $(e.currentTarget);
        let $obj_tr = $obj_btn.parents('div.wrapper_input');
        let current_html = $obj_btn.html();

        let $obj_input_items = $obj_btn.parent().find('input[type="text"]');
        let items = $obj_input_items.val()

        if(items){

            try {

                let data = {};

                let url_go_to_pay = this.urlGoToCartValue;

                data.code = $obj_btn.attr('code');
                data.price = $obj_btn.attr('price');
                data.pricemask = $obj_btn.attr('pricemask');

                data.description = $obj_tr.attr('description');
                data.product = $obj_tr.attr('iden');

                data.currency = $obj_tr.attr('currency');
                data.items = items;

                await $.ajax({

                    url: this.urlValue,
                    type: "POST",
                    dataType: "JSON",
                    data: data,
        
                    beforeSend: function (jqXHR, settings){
                        $obj_btn.addClass('disabled');
                        $obj_btn.html('<i class="fa fa-refresh fa-spin" aria-hidden="true"></i>');
                    },
        
                    success: function (rdata) {

                        window.location.href = url_go_to_pay;

                        /*
                        let data = rdata.data;
                        let counter = rdata.counter;
                        let subtotal = parseInt(data.items) * parseFloat(data.price);
                        let round_subtotal =  Math.round((subtotal + Number.EPSILON) * 100) / 100;
                        
                        if (data.currency == 'EUR'){
                            round_subtotal = new Intl.NumberFormat('es-ES', {
                                style: 'currency',
                                currency: 'EUR',
                              }).format(round_subtotal);
                        }else if(data.currency == 'USD'){
                            round_subtotal = new Intl.NumberFormat('en-US', {
                                style: 'currency',
                                currency: 'USD',
                              }).format(round_subtotal);
                        }


                        //console.log(data.currency, round_subtotal, data);
                        
                        let mySelectedModal = document.getElementById('generalModal')
                        let obj_modal_body = document.getElementById('generalModalBody');
                        let $obj_modal = $(mySelectedModal);
                        let str_html = '';

                        $obj_modal.find('h5.modal-title').html(main.i18nMsgAddedProductValue);

                        $obj_modal.find('div.modal-footer').hide();

                        str_html += '<div class="row">';
                        str_html += '    <div class="col"><div class="alert alert-info">'+data.description+'</div></div>';
                        str_html += '</div>';

                        str_html += '<div class="row">';
                        str_html += '    <div class="col text-end">'+main.i18nMsgItemsValue+':<br>'+data.items+'</div>';
                        str_html += '    <div class="col text-end">'+main.i18nMsgPriceValue+':<br> '+data.pricemask+'</div>';
                        str_html += '    <div class="col text-end">Total:<br>'+round_subtotal+'</div>';
                        str_html += '</div>';
                        
                        str_html += '<div class="d-grid gap-2 my-3">';
                            //str_html += '    <a id="btnModalGoToCart" class="btn btn-dark btn-lg" href="javascript:void(0);">'+main.i18nMsgViewCartValue+'</a>';
                            str_html += '    <a id="btnPayNow" class="btn btn-dark btn-lg" href="'+url_go_to_pay+'">'+main.i18nMsgRequestConfirmationValue+'</a>';
                        str_html += '</div>';

                        // data-bs-toggle="offcanvas" href="#offcanvasCart" role="button" aria-controls="offcanvasCart"
                        $(obj_modal_body).html(str_html);
                        
                        //Initialize components
                        const canvas = new Offcanvas(document.getElementById('offcanvasCart'));
                        const modal = new Modal(mySelectedModal);
                        
                        //----Show modal
                        modal.show();

                        //Update n items
                        $('#counterCart span').text(counter);
                        

                        $('#btnModalGoToCart').on('click', function(){
                            modal.hide();
                            canvas.show();
                        });
                        */
                        

                    },
                    complete: function(data){

                        $obj_btn.removeClass('disabled');
                        $obj_btn.html(current_html);
        
                    }
                });

            } catch (e) {

                console.log(e)

                $obj_btn.html(current_html);
            }
        }

    }

}