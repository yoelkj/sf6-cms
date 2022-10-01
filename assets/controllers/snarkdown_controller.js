import { Controller } from '@hotwired/stimulus';
import snarkdown from 'snarkdown';
const document = window.document;

/* stimulusFetch: 'lazy' */
export default class extends Controller {
    
    static targets = ['input'];
    
    outputElement = null;
    
    initialize() {
        this.outputElement = document.createElement('div');
        this.outputElement.className = 'markdown-preview';
        this.outputElement.textContent = 'MARKDOWN WILL BE RENDERED HERE';
        this.element.append(this.outputElement);
    }
    connect() {
        this.render();
    }
    render() {
        const markdownContent = this.inputTarget.value;
        this.outputElement.innerHTML = snarkdown(markdownContent);
    }
}