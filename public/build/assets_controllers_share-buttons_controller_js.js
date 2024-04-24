(self["webpackChunk"] = self["webpackChunk"] || []).push([["assets_controllers_share-buttons_controller_js"],{

/***/ "./assets/controllers/share-buttons_controller.js":
/*!********************************************************!*\
  !*** ./assets/controllers/share-buttons_controller.js ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ _default)
/* harmony export */ });
/* harmony import */ var core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.object.set-prototype-of.js */ "./node_modules/core-js/modules/es.object.set-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_function_bind_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.function.bind.js */ "./node_modules/core-js/modules/es.function.bind.js");
/* harmony import */ var core_js_modules_es_function_bind_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_function_bind_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.object.get-prototype-of.js */ "./node_modules/core-js/modules/es.object.get-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/es.reflect.construct.js */ "./node_modules/core-js/modules/es.reflect.construct.js");
/* harmony import */ var core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/es.object.create.js */ "./node_modules/core-js/modules/es.object.create.js");
/* harmony import */ var core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! core-js/modules/es.object.define-property.js */ "./node_modules/core-js/modules/es.object.define-property.js");
/* harmony import */ var core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! core-js/modules/es.symbol.js */ "./node_modules/core-js/modules/es.symbol.js");
/* harmony import */ var core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! core-js/modules/es.symbol.description.js */ "./node_modules/core-js/modules/es.symbol.description.js");
/* harmony import */ var core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! core-js/modules/es.symbol.iterator.js */ "./node_modules/core-js/modules/es.symbol.iterator.js");
/* harmony import */ var core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! core-js/modules/es.array.iterator.js */ "./node_modules/core-js/modules/es.array.iterator.js");
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_10__);
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_11___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_11__);
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! core-js/modules/web.dom-collections.iterator.js */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_12___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_12__);
/* harmony import */ var _hotwired_stimulus__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! @hotwired/stimulus */ "./node_modules/@hotwired/stimulus/dist/stimulus.js");
/* harmony import */ var share_buttons_dist_share_buttons_js__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! share-buttons/dist/share-buttons.js */ "./node_modules/share-buttons/dist/share-buttons.js");
/* harmony import */ var share_buttons_dist_share_buttons_js__WEBPACK_IMPORTED_MODULE_14___default = /*#__PURE__*/__webpack_require__.n(share_buttons_dist_share_buttons_js__WEBPACK_IMPORTED_MODULE_14__);
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }















function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); Object.defineProperty(subClass, "prototype", { writable: false }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } else if (call !== void 0) { throw new TypeError("Derived constructors may only return object or undefined"); } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }



/* stimulusFetch: 'lazy' */

var _default = /*#__PURE__*/function (_Controller) {
  _inherits(_default, _Controller);

  var _super = _createSuper(_default);

  function _default() {
    _classCallCheck(this, _default);

    return _super.apply(this, arguments);
  }

  _createClass(_default, [{
    key: "connect",
    value: function connect() {}
  }]);

  return _default;
}(_hotwired_stimulus__WEBPACK_IMPORTED_MODULE_13__.Controller);



/***/ }),

/***/ "./node_modules/share-buttons/dist/share-buttons.js":
/*!**********************************************************!*\
  !*** ./node_modules/share-buttons/dist/share-buttons.js ***!
  \**********************************************************/
/***/ (function(module) {

!function(e,t){ true?module.exports=t():0}(this,function(){"use strict";var A=window,S=A.document;var e=new function(){function u(e,r){return e.replace(/\{(\d+)\}/g,function(e,t){return r[t]||e})}function l(e){return e.join(" - ")}function h(e){A.console.log(e)}function r(e){for(var t=S.querySelectorAll(e),r=0;r<t.length;r++)t[r].style.display="none"}var d="copy",p="share",f="navigator.share(): ",n="This feature is not supported on this browser or operating system.";function b(e){return encodeURIComponent(e)}function m(e){return decodeURIComponent(e)}this.i=function(){for(var e=S.querySelectorAll(".share-btn"),t=e.length;t--;)a(e[t]);A.navigator.clipboard||(r('[data-id="copy"]'),h("navigator.clipboard(): "+n)),A.navigator.canShare||(r('[data-id="share"]'),h(f+n))};var a=function(e){for(var t=e.querySelectorAll("a"),r=t.length;r--;)i(t[r],{id:"",url:o(e),title:c(e),desc:s(e)})},i=function(e,t){t.id=y(e,"data-id"),t.id&&(w(e,"click"),g(e,"click",t))},o=function(e){return y(e,"data-url")||A.location.href||" "},c=function(e){return y(e,"data-title")||S.title||" "},s=function(e){var t=S.querySelector("meta[name=description]");return y(e,"data-desc")||t&&y(t,"content")||" "},k=0,v={},w=function(e,t){var r=e.getAttribute("data-sharebtn-ref");r&&(e.removeEventListener?e.removeEventListener(t,v[r]):e.detachEvent("on"+t,v[r+"ie"]))},g=function(e,t,r){function n(){x(r.id,r.url,r.title,r.desc)}function a(){n.call(e)}var i=e.getAttribute("data-sharebtn-ref");i||(i=++k,e.setAttribute("data-sharebtn-ref",i)),v[i]=n,v[i+"ie"]=a,e.addEventListener?e.addEventListener(t,n):e.attachEvent("on"+t,a)},y=function(e,t){return e.getAttribute(t)},x=function(e,t,r,n){var a=b(t),i=b(n),o=b(r),c=o||i||"";switch(e){case"fb":E(u("https://www.facebook.com/sharer/sharer.php?u={0}&quote={1}",[a,o]),r);break;case"vk":E(u("https://vk.com/share.php?url={0}&title={1}",[a,l([o,i])]),r);break;case"tw":E(u("https://twitter.com/intent/tweet?url={0}&text={1}",[a,l([o,i])]),r);break;case"tg":E(u("https://t.me/share/url?url={0}&text={1}",[a,l([o,i])]),r);break;case"pk":E(u("https://getpocket.com/edit?url={0}&title={1}",[a,l([o,i])]),r);break;case"re":E(u("https://reddit.com/submit?url={0}&title={1}",[a,o]),r);break;case"ev":E(u("https://www.evernote.com/clip.action?url={0}&t={1}",[a,o]),r);break;case"in":E(u("https://www.linkedin.com/shareArticle?mini=true&url={0}&title={1}&summary={2}&source={0}",[a,o,l([o,i])]),r);break;case"pi":E(u("https://pinterest.com/pin/create/button/?url={0}&media={0}&description={1}",[a,l([o,i])]),r);break;case"sk":E(u("https://web.skype.com/share?url={0}&source=button&text={1}",[a,l([o,i])]),r);break;case"wa":E(u("https://wa.me/?text={0}%20{1}",[l([o,i]),a]),r);break;case"ok":E(u("https://connect.ok.ru/dk?st.cmd=WidgetSharePreview&service=odnoklassniki&st.shareUrl={0}",[a]),r);break;case"tu":E(u("https://www.tumblr.com/widgets/share/tool?posttype=link&title={0}&caption={0}&content={1}&canonicalUrl={1}&shareSource=tumblr_share_button",[l([o,i]),a]),r);break;case"hn":E(u("https://news.ycombinator.com/submitlink?t={0}&u={1}",[l([o,i]),a]),r);break;case"xi":E(u("https://www.xing.com/app/user?op=share;url={0};title={1}",[a,l([o,i])]),r);break;case"mail":0<o.length&&0<i.length&&(c=l([o,i])),0<a.length&&(c=c+" / "+a),A.location.href=u("mailto:?subject={0}&body={1}",[o,c]);break;case"print":A.print();break;case d:A.navigator.clipboard.writeText(m(a));break;case p:var s={title:c=m(l([o,i])),text:c,url:m(a)};A.navigator.share(s).then(function(){}).catch(function(e){h(f+"Error")})}},E=function(e,t){var r=void 0!==A.screenLeft?A.screenLeft:screen.left,n=void 0!==A.screenTop?A.screenTop:screen.top,a=A.innerWidth||S.documentElement.clientWidth||screen.width,i=A.innerHeight||S.documentElement.clientHeight||screen.height,r=A.open(e,"",u("resizable,toolbar=yes,location=yes,scrollbars=yes,menubar=yes,width={0},height={1},top={2},left={3}",[600,400,i/3-400/3+n,a/2-300+r]));null!==r&&r.focus&&r.focus()}};return e.i(),{update:function(){e.i()}}});

/***/ })

}]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYXNzZXRzX2NvbnRyb2xsZXJzX3NoYXJlLWJ1dHRvbnNfY29udHJvbGxlcl9qcy5qcyIsIm1hcHBpbmdzIjoiOzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7QUFBQTtBQUVBO0FBRUE7Ozs7Ozs7Ozs7Ozs7OztXQUdJLG1CQUFTLENBQUU7Ozs7RUFGY0E7Ozs7Ozs7Ozs7OztBQ0w3QixlQUFlLEtBQW9ELG9CQUFvQixDQUE0RSxDQUFDLGlCQUFpQixhQUFhLDBCQUEwQixxQkFBcUIsZ0JBQWdCLG9CQUFvQixPQUFPLGlCQUFpQixlQUFlLEVBQUUsY0FBYyxxQkFBcUIsY0FBYyxpQkFBaUIsY0FBYyxvQ0FBb0MsV0FBVyw4QkFBOEIsc0hBQXNILGNBQWMsNkJBQTZCLGNBQWMsNkJBQTZCLGtCQUFrQixzREFBc0QsSUFBSSxTQUFTLHFJQUFxSSxrQkFBa0IsNkNBQTZDLElBQUksU0FBUyxvQ0FBb0MsRUFBRSxpQkFBaUIsd0RBQXdELGVBQWUsNkNBQTZDLGVBQWUsdUNBQXVDLGVBQWUsZ0RBQWdELGdEQUFnRCxTQUFTLGlCQUFpQiwwQ0FBMEMseUZBQXlGLG1CQUFtQixhQUFhLDZCQUE2QixhQUFhLFVBQVUsMENBQTBDLHVJQUF1SSxpQkFBaUIseUJBQXlCLHFCQUFxQixvQ0FBb0MsVUFBVSw0REFBNEQsRUFBRSxRQUFRLEVBQUUsWUFBWSxNQUFNLDRDQUE0QyxFQUFFLFFBQVEsRUFBRSxtQkFBbUIsTUFBTSxvREFBb0QsRUFBRSxPQUFPLEVBQUUsbUJBQW1CLE1BQU0sMENBQTBDLEVBQUUsT0FBTyxFQUFFLG1CQUFtQixNQUFNLDhDQUE4QyxFQUFFLFFBQVEsRUFBRSxtQkFBbUIsTUFBTSw2Q0FBNkMsRUFBRSxRQUFRLEVBQUUsWUFBWSxNQUFNLHdEQUF3RCxFQUFFLElBQUksRUFBRSxZQUFZLE1BQU0sbUVBQW1FLEVBQUUsUUFBUSxFQUFFLFVBQVUsRUFBRSxTQUFTLEVBQUUscUJBQXFCLE1BQU0sNERBQTRELEVBQUUsUUFBUSxFQUFFLGNBQWMsRUFBRSxtQkFBbUIsTUFBTSwrQ0FBK0MsRUFBRSxxQkFBcUIsRUFBRSxtQkFBbUIsTUFBTSxtQ0FBbUMsRUFBRSxJQUFJLEVBQUUsbUJBQW1CLE1BQU0sb0dBQW9HLEVBQUUsVUFBVSxNQUFNLDZFQUE2RSxFQUFFLFVBQVUsRUFBRSxVQUFVLEVBQUUsZUFBZSxFQUFFLG1EQUFtRCxNQUFNLHlEQUF5RCxFQUFFLElBQUksRUFBRSxtQkFBbUIsTUFBTSxxREFBcUQsS0FBSyxHQUFHLE9BQU8sRUFBRSxtQkFBbUIsTUFBTSw4R0FBOEcsRUFBRSxPQUFPLEVBQUUsU0FBUyxNQUFNLHNCQUFzQixNQUFNLDZDQUE2QyxNQUFNLGNBQWMscUNBQXFDLHNDQUFzQyxvQkFBb0IsYUFBYSxHQUFHLGlCQUFpQixvVEFBb1QsRUFBRSxTQUFTLEVBQUUsTUFBTSxFQUFFLE9BQU8sRUFBRSxvQ0FBb0MsK0JBQStCLGNBQWMsa0JBQWtCLFFBQVEiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvY29udHJvbGxlcnMvc2hhcmUtYnV0dG9uc19jb250cm9sbGVyLmpzIiwid2VicGFjazovLy8uL25vZGVfbW9kdWxlcy9zaGFyZS1idXR0b25zL2Rpc3Qvc2hhcmUtYnV0dG9ucy5qcyJdLCJzb3VyY2VzQ29udGVudCI6WyJpbXBvcnQgeyBDb250cm9sbGVyIH0gZnJvbSBcIkBob3R3aXJlZC9zdGltdWx1c1wiO1xuXG5pbXBvcnQgXCJzaGFyZS1idXR0b25zL2Rpc3Qvc2hhcmUtYnV0dG9ucy5qc1wiO1xuXG4vKiBzdGltdWx1c0ZldGNoOiAnbGF6eScgKi9cbmV4cG9ydCBkZWZhdWx0IGNsYXNzIGV4dGVuZHMgQ29udHJvbGxlcntcbiAgICBcbiAgICBjb25uZWN0KCl7fVxufSIsIiFmdW5jdGlvbihlLHQpe1wib2JqZWN0XCI9PXR5cGVvZiBleHBvcnRzJiZcInVuZGVmaW5lZFwiIT10eXBlb2YgbW9kdWxlP21vZHVsZS5leHBvcnRzPXQoKTpcImZ1bmN0aW9uXCI9PXR5cGVvZiBkZWZpbmUmJmRlZmluZS5hbWQ/ZGVmaW5lKHQpOihlPWV8fHNlbGYpLlNoYXJlQnV0dG9ucz10KCl9KHRoaXMsZnVuY3Rpb24oKXtcInVzZSBzdHJpY3RcIjt2YXIgQT13aW5kb3csUz1BLmRvY3VtZW50O3ZhciBlPW5ldyBmdW5jdGlvbigpe2Z1bmN0aW9uIHUoZSxyKXtyZXR1cm4gZS5yZXBsYWNlKC9cXHsoXFxkKylcXH0vZyxmdW5jdGlvbihlLHQpe3JldHVybiByW3RdfHxlfSl9ZnVuY3Rpb24gbChlKXtyZXR1cm4gZS5qb2luKFwiIC0gXCIpfWZ1bmN0aW9uIGgoZSl7QS5jb25zb2xlLmxvZyhlKX1mdW5jdGlvbiByKGUpe2Zvcih2YXIgdD1TLnF1ZXJ5U2VsZWN0b3JBbGwoZSkscj0wO3I8dC5sZW5ndGg7cisrKXRbcl0uc3R5bGUuZGlzcGxheT1cIm5vbmVcIn12YXIgZD1cImNvcHlcIixwPVwic2hhcmVcIixmPVwibmF2aWdhdG9yLnNoYXJlKCk6IFwiLG49XCJUaGlzIGZlYXR1cmUgaXMgbm90IHN1cHBvcnRlZCBvbiB0aGlzIGJyb3dzZXIgb3Igb3BlcmF0aW5nIHN5c3RlbS5cIjtmdW5jdGlvbiBiKGUpe3JldHVybiBlbmNvZGVVUklDb21wb25lbnQoZSl9ZnVuY3Rpb24gbShlKXtyZXR1cm4gZGVjb2RlVVJJQ29tcG9uZW50KGUpfXRoaXMuaT1mdW5jdGlvbigpe2Zvcih2YXIgZT1TLnF1ZXJ5U2VsZWN0b3JBbGwoXCIuc2hhcmUtYnRuXCIpLHQ9ZS5sZW5ndGg7dC0tOylhKGVbdF0pO0EubmF2aWdhdG9yLmNsaXBib2FyZHx8KHIoJ1tkYXRhLWlkPVwiY29weVwiXScpLGgoXCJuYXZpZ2F0b3IuY2xpcGJvYXJkKCk6IFwiK24pKSxBLm5hdmlnYXRvci5jYW5TaGFyZXx8KHIoJ1tkYXRhLWlkPVwic2hhcmVcIl0nKSxoKGYrbikpfTt2YXIgYT1mdW5jdGlvbihlKXtmb3IodmFyIHQ9ZS5xdWVyeVNlbGVjdG9yQWxsKFwiYVwiKSxyPXQubGVuZ3RoO3ItLTspaSh0W3JdLHtpZDpcIlwiLHVybDpvKGUpLHRpdGxlOmMoZSksZGVzYzpzKGUpfSl9LGk9ZnVuY3Rpb24oZSx0KXt0LmlkPXkoZSxcImRhdGEtaWRcIiksdC5pZCYmKHcoZSxcImNsaWNrXCIpLGcoZSxcImNsaWNrXCIsdCkpfSxvPWZ1bmN0aW9uKGUpe3JldHVybiB5KGUsXCJkYXRhLXVybFwiKXx8QS5sb2NhdGlvbi5ocmVmfHxcIiBcIn0sYz1mdW5jdGlvbihlKXtyZXR1cm4geShlLFwiZGF0YS10aXRsZVwiKXx8Uy50aXRsZXx8XCIgXCJ9LHM9ZnVuY3Rpb24oZSl7dmFyIHQ9Uy5xdWVyeVNlbGVjdG9yKFwibWV0YVtuYW1lPWRlc2NyaXB0aW9uXVwiKTtyZXR1cm4geShlLFwiZGF0YS1kZXNjXCIpfHx0JiZ5KHQsXCJjb250ZW50XCIpfHxcIiBcIn0saz0wLHY9e30sdz1mdW5jdGlvbihlLHQpe3ZhciByPWUuZ2V0QXR0cmlidXRlKFwiZGF0YS1zaGFyZWJ0bi1yZWZcIik7ciYmKGUucmVtb3ZlRXZlbnRMaXN0ZW5lcj9lLnJlbW92ZUV2ZW50TGlzdGVuZXIodCx2W3JdKTplLmRldGFjaEV2ZW50KFwib25cIit0LHZbcitcImllXCJdKSl9LGc9ZnVuY3Rpb24oZSx0LHIpe2Z1bmN0aW9uIG4oKXt4KHIuaWQsci51cmwsci50aXRsZSxyLmRlc2MpfWZ1bmN0aW9uIGEoKXtuLmNhbGwoZSl9dmFyIGk9ZS5nZXRBdHRyaWJ1dGUoXCJkYXRhLXNoYXJlYnRuLXJlZlwiKTtpfHwoaT0rK2ssZS5zZXRBdHRyaWJ1dGUoXCJkYXRhLXNoYXJlYnRuLXJlZlwiLGkpKSx2W2ldPW4sdltpK1wiaWVcIl09YSxlLmFkZEV2ZW50TGlzdGVuZXI/ZS5hZGRFdmVudExpc3RlbmVyKHQsbik6ZS5hdHRhY2hFdmVudChcIm9uXCIrdCxhKX0seT1mdW5jdGlvbihlLHQpe3JldHVybiBlLmdldEF0dHJpYnV0ZSh0KX0seD1mdW5jdGlvbihlLHQscixuKXt2YXIgYT1iKHQpLGk9YihuKSxvPWIociksYz1vfHxpfHxcIlwiO3N3aXRjaChlKXtjYXNlXCJmYlwiOkUodShcImh0dHBzOi8vd3d3LmZhY2Vib29rLmNvbS9zaGFyZXIvc2hhcmVyLnBocD91PXswfSZxdW90ZT17MX1cIixbYSxvXSkscik7YnJlYWs7Y2FzZVwidmtcIjpFKHUoXCJodHRwczovL3ZrLmNvbS9zaGFyZS5waHA/dXJsPXswfSZ0aXRsZT17MX1cIixbYSxsKFtvLGldKV0pLHIpO2JyZWFrO2Nhc2VcInR3XCI6RSh1KFwiaHR0cHM6Ly90d2l0dGVyLmNvbS9pbnRlbnQvdHdlZXQ/dXJsPXswfSZ0ZXh0PXsxfVwiLFthLGwoW28saV0pXSkscik7YnJlYWs7Y2FzZVwidGdcIjpFKHUoXCJodHRwczovL3QubWUvc2hhcmUvdXJsP3VybD17MH0mdGV4dD17MX1cIixbYSxsKFtvLGldKV0pLHIpO2JyZWFrO2Nhc2VcInBrXCI6RSh1KFwiaHR0cHM6Ly9nZXRwb2NrZXQuY29tL2VkaXQ/dXJsPXswfSZ0aXRsZT17MX1cIixbYSxsKFtvLGldKV0pLHIpO2JyZWFrO2Nhc2VcInJlXCI6RSh1KFwiaHR0cHM6Ly9yZWRkaXQuY29tL3N1Ym1pdD91cmw9ezB9JnRpdGxlPXsxfVwiLFthLG9dKSxyKTticmVhaztjYXNlXCJldlwiOkUodShcImh0dHBzOi8vd3d3LmV2ZXJub3RlLmNvbS9jbGlwLmFjdGlvbj91cmw9ezB9JnQ9ezF9XCIsW2Esb10pLHIpO2JyZWFrO2Nhc2VcImluXCI6RSh1KFwiaHR0cHM6Ly93d3cubGlua2VkaW4uY29tL3NoYXJlQXJ0aWNsZT9taW5pPXRydWUmdXJsPXswfSZ0aXRsZT17MX0mc3VtbWFyeT17Mn0mc291cmNlPXswfVwiLFthLG8sbChbbyxpXSldKSxyKTticmVhaztjYXNlXCJwaVwiOkUodShcImh0dHBzOi8vcGludGVyZXN0LmNvbS9waW4vY3JlYXRlL2J1dHRvbi8/dXJsPXswfSZtZWRpYT17MH0mZGVzY3JpcHRpb249ezF9XCIsW2EsbChbbyxpXSldKSxyKTticmVhaztjYXNlXCJza1wiOkUodShcImh0dHBzOi8vd2ViLnNreXBlLmNvbS9zaGFyZT91cmw9ezB9JnNvdXJjZT1idXR0b24mdGV4dD17MX1cIixbYSxsKFtvLGldKV0pLHIpO2JyZWFrO2Nhc2VcIndhXCI6RSh1KFwiaHR0cHM6Ly93YS5tZS8/dGV4dD17MH0lMjB7MX1cIixbbChbbyxpXSksYV0pLHIpO2JyZWFrO2Nhc2VcIm9rXCI6RSh1KFwiaHR0cHM6Ly9jb25uZWN0Lm9rLnJ1L2RrP3N0LmNtZD1XaWRnZXRTaGFyZVByZXZpZXcmc2VydmljZT1vZG5va2xhc3NuaWtpJnN0LnNoYXJlVXJsPXswfVwiLFthXSkscik7YnJlYWs7Y2FzZVwidHVcIjpFKHUoXCJodHRwczovL3d3dy50dW1ibHIuY29tL3dpZGdldHMvc2hhcmUvdG9vbD9wb3N0dHlwZT1saW5rJnRpdGxlPXswfSZjYXB0aW9uPXswfSZjb250ZW50PXsxfSZjYW5vbmljYWxVcmw9ezF9JnNoYXJlU291cmNlPXR1bWJscl9zaGFyZV9idXR0b25cIixbbChbbyxpXSksYV0pLHIpO2JyZWFrO2Nhc2VcImhuXCI6RSh1KFwiaHR0cHM6Ly9uZXdzLnljb21iaW5hdG9yLmNvbS9zdWJtaXRsaW5rP3Q9ezB9JnU9ezF9XCIsW2woW28saV0pLGFdKSxyKTticmVhaztjYXNlXCJ4aVwiOkUodShcImh0dHBzOi8vd3d3LnhpbmcuY29tL2FwcC91c2VyP29wPXNoYXJlO3VybD17MH07dGl0bGU9ezF9XCIsW2EsbChbbyxpXSldKSxyKTticmVhaztjYXNlXCJtYWlsXCI6MDxvLmxlbmd0aCYmMDxpLmxlbmd0aCYmKGM9bChbbyxpXSkpLDA8YS5sZW5ndGgmJihjPWMrXCIgLyBcIithKSxBLmxvY2F0aW9uLmhyZWY9dShcIm1haWx0bzo/c3ViamVjdD17MH0mYm9keT17MX1cIixbbyxjXSk7YnJlYWs7Y2FzZVwicHJpbnRcIjpBLnByaW50KCk7YnJlYWs7Y2FzZSBkOkEubmF2aWdhdG9yLmNsaXBib2FyZC53cml0ZVRleHQobShhKSk7YnJlYWs7Y2FzZSBwOnZhciBzPXt0aXRsZTpjPW0obChbbyxpXSkpLHRleHQ6Yyx1cmw6bShhKX07QS5uYXZpZ2F0b3Iuc2hhcmUocykudGhlbihmdW5jdGlvbigpe30pLmNhdGNoKGZ1bmN0aW9uKGUpe2goZitcIkVycm9yXCIpfSl9fSxFPWZ1bmN0aW9uKGUsdCl7dmFyIHI9dm9pZCAwIT09QS5zY3JlZW5MZWZ0P0Euc2NyZWVuTGVmdDpzY3JlZW4ubGVmdCxuPXZvaWQgMCE9PUEuc2NyZWVuVG9wP0Euc2NyZWVuVG9wOnNjcmVlbi50b3AsYT1BLmlubmVyV2lkdGh8fFMuZG9jdW1lbnRFbGVtZW50LmNsaWVudFdpZHRofHxzY3JlZW4ud2lkdGgsaT1BLmlubmVySGVpZ2h0fHxTLmRvY3VtZW50RWxlbWVudC5jbGllbnRIZWlnaHR8fHNjcmVlbi5oZWlnaHQscj1BLm9wZW4oZSxcIlwiLHUoXCJyZXNpemFibGUsdG9vbGJhcj15ZXMsbG9jYXRpb249eWVzLHNjcm9sbGJhcnM9eWVzLG1lbnViYXI9eWVzLHdpZHRoPXswfSxoZWlnaHQ9ezF9LHRvcD17Mn0sbGVmdD17M31cIixbNjAwLDQwMCxpLzMtNDAwLzMrbixhLzItMzAwK3JdKSk7bnVsbCE9PXImJnIuZm9jdXMmJnIuZm9jdXMoKX19O3JldHVybiBlLmkoKSx7dXBkYXRlOmZ1bmN0aW9uKCl7ZS5pKCl9fX0pOyJdLCJuYW1lcyI6WyJDb250cm9sbGVyIl0sInNvdXJjZVJvb3QiOiIifQ==