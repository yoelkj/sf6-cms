import { Controller } from "@hotwired/stimulus";
import $ from 'jquery';

export default class extends Controller {

    static values = {
        url: String
    }

    static targets = ['form', 'entries', 'pagination'];

    handleScroll(){

        let body = document.body;
        let html = document.documentElement;
        
        let height = Math.max(
            body.scrollHeight,
            body.offsetHeight,
            html.clientHeight,
            html.offsetHeight
        );

        let footer = document.querySelector('.footer');
        let footer_height = footer.offsetHeight;
        
        //console.log(window.pageYOffset,  (height - window.innerHeight) , footer_height  );
        if(window.pageYOffset > height - (window.innerHeight + footer_height)){
            
            console.log(this.hasPaginationTarget);
            
            if(this.hasPaginationTarget){    
                this.loadMore();
            }
        }
    
    }    

    async handleChange(){

        let $form = $(this.formTarget);
        let $entries = $(this.entriesTarget);

        try {
            await $.ajax({
                url: this.urlValue,
                method: $form.prop('method'),
                data: $form.serialize(),
                beforeSend: function(){
                    $form.find('select').addClass('disabled');
                    $entries.html('<div class="col-md text-center my-5"><i class="fa-solid fa-circle-notch fa-spin h1"></i></div>');
                },
                success: function(data){
                    $entries.html(data)
                },
                complete: function(){
                    $form.find('select').removeClass('disabled');
                }
            });
        } catch (e) {
            $entries.html();
        }

    }

    async loadMore(){
        
        var $obj_btn_next = this.paginationTarget.querySelector('a[rel="next"]')
        
        if(!$obj_btn_next) return;
        
        var $form = $(this.formTarget);
        var $entries = $(this.entriesTarget);

        //Get nex page
        var url_next = ($obj_btn_next) ? $obj_btn_next.href: '';
        var url = new URL(url_next);
        var page = url.searchParams.get("page");

        //serialize data
        var serialize_data = $form.serialize()+"&page="+page; 
        
        try {

            await $.ajax({
                url: this.urlValue,
                method: $form.prop('method'),
                data: serialize_data,
                beforeSend: function(){
                    $entries.find('.pagination').remove();
                    $entries.append('<div class="loader col-md-12 text-center my-5"><i class="fa-solid fa-circle-notch fa-spin h1"></i></div>');
                },
                success: function(data){
                    $('.loader').remove();
                    
                    $entries.append(data);
                },
                complete: function(){
                }
            });
  
        } catch (e) {
            $entries.html();
        }

    }

}
