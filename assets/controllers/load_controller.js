import { Controller } from "@hotwired/stimulus";

import AOS from 'aos';
import 'aos/dist/aos.css';

export default class extends Controller{
    //easing: 'ease-in-out',
    connect(){
        AOS.init({
            duration: 2000,
            once: true,
            mirror: false
        });
    }
}