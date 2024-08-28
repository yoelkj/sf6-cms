/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

// activates collapse functionality
import { Collapse } from 'bootstrap';

import CookieConsent from "@klaxit/cookie-consent"

// --------------- Consent cockies
let obj_hidd_trans = document.getElementById("hiddTrans");
let modal_consent_title =  obj_hidd_trans.getAttribute('modalConsentTitle');
let modal_consent_desc =   obj_hidd_trans.getAttribute('modalConsentDesc');
let modal_consent_btn_acceptAll  =      obj_hidd_trans.getAttribute('modalConsentBtnAcceptAll'); 
let modal_consent_btn_acceptSelected  = obj_hidd_trans.getAttribute('modalConsentBtnAcceptSelected'); 
let modal_consent_btn_reject  =       obj_hidd_trans.getAttribute('modalConsentBtnReject'); 
let modal_consent_btn_showSettings  = obj_hidd_trans.getAttribute('modalConsentBtnShowSettings'); 
let modal_consent_btn_hideSettings  = obj_hidd_trans.getAttribute('modalConsentBtnHideSettings'); 
let modal_consent_essentials_desc  =  obj_hidd_trans.getAttribute('modalConsentEssentialsDesc'); 
let modal_consent_analityc_desc  =    obj_hidd_trans.getAttribute('modalConsentAnalitycDesc');

const options = {
    "title": modal_consent_title,
    "description": modal_consent_desc,
    "buttons": {
        "acceptAll": modal_consent_btn_acceptAll,
        "acceptSelected": modal_consent_btn_acceptSelected,
        "reject": modal_consent_btn_reject,
        "showSettings": modal_consent_btn_showSettings,
        "hideSettings": modal_consent_btn_hideSettings
    },
    "categories": {
        "essentials": {
            "label": "Essential",
            "description": modal_consent_essentials_desc,
            "checked": true,
            "mandatory": true
        },
        "analytics": {
            "label": "Analytics",
            "description": modal_consent_analityc_desc
        }
    },
    "cookie": {
        "name": "cookie_consent",
        "domain": null,
        "expiryDays": 365,
        "secure": false,
        "sameSite": "COESA"
    }

}

const cc = new CookieConsent(options);

if(!cc.status){
    cc.open();
}else{
console.log(cc.status);
}
