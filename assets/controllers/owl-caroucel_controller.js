import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel/dist/assets/owl.theme.default.css';
import { Controller } from "@hotwired/stimulus";

import $ from 'jquery';
import 'owl.carousel';

export default class extends Controller{


    static values = {
        targetId: String,
        items: Number
    }

    connect(){

        var obj_params = {
            margin:20,
            nav:true,
            autoplay:true,
            dots: false,

            loop: true,
            autoplayTimeout:3000,
            items: this.itemsValue,
            autoplayHoverPause:true,

            autoWidth:false,
            navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],

            responsive:{
                0:{
                    items:1
                },
                600:{
                    items: (this.itemsValue) ? this.itemsValue : 2
                },
                1000:{
                    items: (this.itemsValue) ? this.itemsValue : 2
                }
            }
        };  

        $(this.targetIdValue).owlCarousel(obj_params);
    
    }
}