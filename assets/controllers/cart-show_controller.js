import { Controller } from "@hotwired/stimulus";
//import payform from "payform";

import $ from 'jquery';

//import 'flatpickr/dist/themes/light.css';
//import flatpickr from "flatpickr";

$.noConflict();

/* stimulusFetch: 'lazy' */
export default class extends Controller{

    
    static values = {
        uriCheckoutForm: String,
        uriRemoveCartItem: String,
        uriRedir: String,
        transSendingdata: String
    }
    
    static targets = ['summary', 'option', 'send'];

    connect(){

        let main = this;

        /*
        flatpickr('.datetimepicker', {
            allowInput: true,
            dateFormat: "d/m/Y",
            //defaultDate: '01/01/'+(current_year - 18),
            onOpen: function(selectedDates, dateStr, instance){
                let $obj_input = $(instance.input);
            
                if(!$obj_input.val()){
                    $obj_input.val(main.getCurrentDate());
                }
            },
            //onReady: function () {}, 
        });
        */

        $('.btn-del-row').on('click', function(){

            let obj_row = $(this).parent().parent();
            let del_class = obj_row.attr('class');

            if(del_class){
                main.ajaxRemoveCartItem($(this), del_class);
            }

        });

    }

    initialize(){
        this.fillCartData();

        window.addEventListener( "pageshow", function ( event ) {
            var historyTraversal = event.persisted || 
                                   ( typeof window.performance != "undefined" && 
                                        window.performance.navigation.type === 2 );
            if ( historyTraversal ) {
              // Handle page restore.
              window.location.reload();
            }
          });
    }

    fillCartData(){

        let $selected_option = $(this.optionTarget);
        let $obj_summary_data = $(this.summaryTarget);
        let total = $obj_summary_data.attr('total')
        let totalMask = $obj_summary_data.attr('totalMask')
        //let currency= $obj_summary_data.attr('currency')
        
        let orderid= $obj_summary_data.attr('orderid')
        let ordermask= $obj_summary_data.attr('ordermask')
        //let status= $obj_summary_data.attr('status')
        

        //Preview
        $('#totalPayment').text(totalMask)

        //Form
        $('#payTotalMask').text(totalMask);
        $('#paySubtotal, #payTotal').val(total)
        $('#total_prices_ref').text(total)
        
        
        $('#payOrder').val(orderid)
        $('#payOrderMask').val(ordermask)
        
        //$('.currency_symbol').text(currency)

        let cardBrand = $selected_option.attr('cardBrand')
        let cardComm = $selected_option.attr('cardComm')

        $('#cardBrand').val(cardBrand)
        
        this.ajaxCheckoutForm($selected_option.val(), cardBrand, cardComm, orderid, ordermask, total, 1);

    }


    /*
    selectOption(){
        let $obj_summary_data = $(this.summaryTarget);
        let total = $obj_summary_data.attr('total')
        let orderid= $obj_summary_data.attr('orderid')
        let ordermask= $obj_summary_data.attr('ordermask')
        console.log(total, orderid, ordermask);

        this.optionTargets.forEach((el, i) => {
            let $obj_input = $(el);
            if($obj_input.is(':checked')) {
                let cardBrand = $(this).attr('cardBrand')
                let cardComm = $(this).attr('cardComm')
                $('#cardBrand').val(cardBrand)
                this.ajaxCheckoutForm($obj_input.val(), cardBrand, cardComm, orderid, ordermask, total, 1)   
            }
        })
    }
    */

    async ajaxCheckoutForm(method_payment, cardBrand, cardComm, order, ordermask, total, generate_form = 0){
    
        var data = {}
        
        data.generate_form = generate_form
        data.method_payment = method_payment
        data.order = order
        data.ordermask = ordermask
        data.total = total
        data.card_brand = cardBrand
        data.card_comm = cardComm
        
        try {
            await $.ajax({
            url: this.uriCheckoutFormValue,
            dataType: "json",
            type: "POST",
            data: data,
            beforeSend: function (jqXHR, settings) {
                
                $('#frmCheckout, #orderButtons, #summaryModal, #alertModalComplete').hide()
                $('#loaderGetForm').show()
                if($('#headPorcent').length) $('#headPorcent').remove()
                
            },
            success: function (data) {
        
                //let order_subtotal = parseFloat(total);
                //let order_comm  = parseFloat(data.card_comm);
                //let order_comm_c = ((order_comm != NaN && order_comm))?(order_subtotal*(order_comm/100)):0.00
                //let order_total = order_subtotal;//(order_comm != NaN && order_comm)?(order_subtotal + (order_subtotal*(order_comm/100))):order_subtotal
        
                //$('#commissionMethodPayment').text(order_comm_c.toFixed(2))
                
                //$('#totalPayment').text(order_total.toFixed(2))
                //$('#paySubtotal').text(order_subtotal.toFixed(2))
                //$('#payTotal').val(order_total.toFixed(2))
        
                //$('table#summary thead tr').find('th').eq(1).append('<span id="headPorcent">&nbsp;&nbsp;'+order_comm+'%</span>');
        
                if(data.status == 200 ) $('#moreFieldspayment').html(data.response)
                else $('#moreFieldspayment').html('<div class="alert alert-danger">EN ESTOS MOMENTOS NO SE PUEDE COMPLETAR EL PROCESO, INTENTELO NUEVAMENTE.</div>')
                
                /*
                if($('input#cardnumber').length){
                
                    let $obj_cardn = $('input#cardnumber')
                    let $obj_carded = $('input#expirationdate')
                    let $obj_cardsc = $('input#securitycode')
                    
                    //console.log($obj_cardn);
                    //payform.cardNumberInput($obj_cardn);
                    //payform.detachExpiryInput($obj_carded);
                    //payform.detachCvcInput($obj_cardsc);

                    
                    $obj_cardn.focusout(function() {
                        let valid_cc = payform.validateCardNumber($(this).val()); //=> true
                        let card_type = payform.parseCardType($(this).val()); //=> 'visa'
                    })
            
                    $obj_carded.focusout(function() {
                        let valid_fv = payform.validateCardNumber($(this).val()); //=> true
                    })
            
                    $obj_cardsc.focusout(function() {
                        let valid_sc = payform.validateCardNumber($(this).val()); //=> true
                    })
                    
        
                }
                */
        
            },
            complete: function (data) {
                $('#loaderGetForm').hide()
                $('#frmCheckout, #orderButtons, #summaryModal').show()
            },
            error: function(jqXHR, exception){}
            })
        } catch (e) {
            console.log(e);
            $body.html('<div class="alert alert-danger">Error! please try again</div>');
        }

    }

    handleGrantedChange(e){

        let $obj_check_change = $(e.currentTarget);
        let $is_checked_granted_check = $obj_check_change[0].checked;

        if(!$is_checked_granted_check){
            $obj_check_change.removeClass('is-valid');
            $obj_check_change.addClass('is-invalid');
        }else{
            $obj_check_change.addClass('is-valid');
            $obj_check_change.removeClass('is-invalid');
        }

        
    }

    async handleSend(e) {

        let $obj_send_btn = $(e.currentTarget);

        let obj_main = this;

        //Validate
        let $is_checked_granted_check = $('#privacyGranted')[0].checked;
        
        if($('#agencyAdditionalData').length){

            //this.validateField($('#reference'));
            //this.validateField($('#agente'));
            this.validateField($('#agenteEmail'));

            if($('#reference').hasClass('is-invalid') || $('#agente').hasClass('is-invalid') || $('#agenteEmail').hasClass('is-invalid')) return false
        }

        if(!$is_checked_granted_check){
            $('#privacyGranted').removeClass('is-valid');
            $('#privacyGranted').addClass('is-invalid');
            return false;
        }else{
            $('#privacyGranted').addClass('is-valid');
            $('#privacyGranted').removeClass('is-invalid');
        }

        if($('#privacyGrantedTour').length){

            let $is_checked_granted_check_tour = $('#privacyGrantedTour')[0].checked;
            if(!$is_checked_granted_check_tour){
                $('#privacyGrantedTour').removeClass('is-valid');
                $('#privacyGrantedTour').addClass('is-invalid');
                return false;
            }else{
                $('#privacyGrantedTour').addClass('is-valid');
                $('#privacyGrantedTour').removeClass('is-invalid');
            }
        }


        /*
        if ($('.optMethodPay').length == 1) not_pay = 1;
        
        if ($('.optMethodPay').length > 1) {
          $('.optMethodPay').each(function () {
              if ($(this).is(':checked') && ($(this).val() == 1 ||  $(this).val() == 2)) {
                not_pay = 1;
              }
          })
        }
        */

        try {

            let content_sent_btn = $obj_send_btn.html();

            await $.ajax({

                url: $('#frmCheckout').attr('action'),
                data: $('#frmCheckout, #agencyAdditionalData, #packsData').serialize(),
                type: "POST",
                beforeSend: function () {
                    
                    $('#message').html('');
                    $obj_send_btn.html('<strong>'+obj_main.transSendingdataValue+' <i class="fas fa-sync fa-spin"></i><strong>');
                    //$obj_send_btn.addClass('disabled');
                    $('.btn-pay-actions').addClass('disabled');
                    
                },
                success: function (data) {

                    let url_redirect = '';

                    console.log(data.hasOwnProperty('access_payment_form'));

                    if(data.hasOwnProperty('access_payment_form') && data.hasOwnProperty('url')){
                        url_redirect = data.url; 
                    }else{
                        url_redirect = obj_main.uriRedirValue;
                    }

                    $(location).attr('href', url_redirect);
                    return;

                },
                complete: function (data) {
                    //$('#btn_send_order').removeClass('disabled')
                    //$('#frmCheckout').hide();
                    //$('#orderButtons').hide();
                    $('#btn_send_order').html( content_sent_btn);
                    $('.btn-pay-actions').removeClass('disabled');
                }
            });

        } catch (e) {
            console.log(e);
            $('#message').html('<div class="alert alert-danger">Error! please try again</div>');
        }
    }

    validateField($obj_input){

        if($obj_input.attr('type') =='email'){

            if($obj_input.val() && (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($obj_input.val()))){
                
                $obj_input.addClass('is-valid');
                $obj_input.removeClass('is-invalid');
                
            }
            
        }else{

            if(!$obj_input.val()){
                $obj_input.removeClass('is-valid');
                $obj_input.addClass('is-invalid');
                
            }else{
                $obj_input.addClass('is-valid');
                $obj_input.removeClass('is-invalid');
                
            }

        }     
        
    }


    getCurrentDate(){
        const date = new Date();
        let currentDay= String(date.getDate()).padStart(2, '0');
        let currentMonth = String(date.getMonth()+1).padStart(2,"0");
        let currentYear = date.getFullYear();
        return `${currentDay}/${currentMonth}/${currentYear}`;
    }


    async ajaxRemoveCartItem($obj_btn, code){

        var data = {}

        data.code = code;

        try {
            await $.ajax({
            url: this.uriRemoveCartItemValue,
            dataType: "json",
            type: "POST",
            data: data,
            beforeSend: function (jqXHR, settings) {
                $obj_btn.find('.fa').eq(0).attr('class', 'fa fa-refresh fa-spin fa-fw');                
            },
            success: function (data) {
                location.reload();
            },
            complete: function (data) {
                
            },
            error: function(jqXHR, exception){}
            })
        } catch (e) {
            console.log(e);
        }

    }

    
}