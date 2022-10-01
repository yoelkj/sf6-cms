import { Controller } from '@hotwired/stimulus';

// Import TinyMCE
import tinymce from 'tinymce/tinymce';

// A theme is also required
import 'tinymce/themes/silver/theme';

//import 'tinymce/themes/modern/theme';

// Any plugins you want to use has to be imported
//import 'tinymce/plugins/paste';

import 'tinymce/plugins/fullscreen';
import 'tinymce/plugins/preview'; 
import 'tinymce/plugins/code'; 

export default class extends Controller {

    static targets = ['input']

    initialize () {
        this.defaults = {
            plugins: 'fullscreen preview code ',
        }
    }
    
    connect(){
        let config = Object.assign({ target: this.inputTarget }, this.defaults)
        //console.log(this.inputTargets.length)
        tinymce.init(config)
    }

    /*
    disconnect () {
        tinymce.remove()
    }
    */
}