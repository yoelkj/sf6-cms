


import { Controller } from "@hotwired/stimulus";


import lightbox from "lightbox2";
import 'lightbox2/dist/css/lightbox.css';


export default class extends Controller{

    connect(){

        console.log('lb galery');

        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
          })
    }
}