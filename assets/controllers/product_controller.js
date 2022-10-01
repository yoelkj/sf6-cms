import { Controller } from '@hotwired/stimulus';
import axios from 'axios';

export default class extends Controller {
    
    static values = {
        url: String
    }

    showDeail(event) {

        event.preventDefault();

        axios.get(this.urlValue)
            .then((response) => {
                const audio = new Audio(response.data.url);
                audio.play();
            });
        

    }
}
