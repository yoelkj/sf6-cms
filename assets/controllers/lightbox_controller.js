


import { Controller } from "@hotwired/stimulus";


import lightbox from "lightbox2";
import 'lightbox2/dist/css/lightbox.css';

/* stimulusFetch: 'lazy' */
export default class extends Controller{

    connect(){
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
          })
    }
}