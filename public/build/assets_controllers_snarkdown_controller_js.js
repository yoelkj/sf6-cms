"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["assets_controllers_snarkdown_controller_js"],{

/***/ "./assets/controllers/snarkdown_controller.js":
/*!****************************************************!*\
  !*** ./assets/controllers/snarkdown_controller.js ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ _default)
/* harmony export */ });
/* harmony import */ var core_js_modules_es_array_concat_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.array.concat.js */ "./node_modules/core-js/modules/es.array.concat.js");
/* harmony import */ var core_js_modules_es_array_concat_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_concat_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.object.define-property.js */ "./node_modules/core-js/modules/es.object.define-property.js");
/* harmony import */ var core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.object.set-prototype-of.js */ "./node_modules/core-js/modules/es.object.set-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_function_bind_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.function.bind.js */ "./node_modules/core-js/modules/es.function.bind.js");
/* harmony import */ var core_js_modules_es_function_bind_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_function_bind_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/es.object.get-prototype-of.js */ "./node_modules/core-js/modules/es.object.get-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! core-js/modules/es.reflect.construct.js */ "./node_modules/core-js/modules/es.reflect.construct.js");
/* harmony import */ var core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! core-js/modules/es.object.create.js */ "./node_modules/core-js/modules/es.object.create.js");
/* harmony import */ var core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! core-js/modules/es.symbol.js */ "./node_modules/core-js/modules/es.symbol.js");
/* harmony import */ var core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! core-js/modules/es.symbol.description.js */ "./node_modules/core-js/modules/es.symbol.description.js");
/* harmony import */ var core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! core-js/modules/es.symbol.iterator.js */ "./node_modules/core-js/modules/es.symbol.iterator.js");
/* harmony import */ var core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_10__);
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! core-js/modules/es.array.iterator.js */ "./node_modules/core-js/modules/es.array.iterator.js");
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_11___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_11__);
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_12___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_12__);
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! core-js/modules/web.dom-collections.iterator.js */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_13___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_13__);
/* harmony import */ var _hotwired_stimulus__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! @hotwired/stimulus */ "./node_modules/@hotwired/stimulus/dist/stimulus.js");
/* harmony import */ var snarkdown__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! snarkdown */ "./node_modules/snarkdown/dist/snarkdown.es.js");
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

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }



var document = window.document;
/* stimulusFetch: 'lazy' */

var _default = /*#__PURE__*/function (_Controller) {
  _inherits(_default, _Controller);

  var _super = _createSuper(_default);

  function _default() {
    var _this;

    _classCallCheck(this, _default);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    _this = _super.call.apply(_super, [this].concat(args));

    _defineProperty(_assertThisInitialized(_this), "outputElement", null);

    return _this;
  }

  _createClass(_default, [{
    key: "initialize",
    value: function initialize() {
      this.outputElement = document.createElement('div');
      this.outputElement.className = 'markdown-preview';
      this.outputElement.textContent = 'MARKDOWN WILL BE RENDERED HERE';
      this.element.append(this.outputElement);
    }
  }, {
    key: "connect",
    value: function connect() {
      this.render();
    }
  }, {
    key: "render",
    value: function render() {
      var markdownContent = this.inputTarget.value;
      this.outputElement.innerHTML = (0,snarkdown__WEBPACK_IMPORTED_MODULE_15__["default"])(markdownContent);
    }
  }]);

  return _default;
}(_hotwired_stimulus__WEBPACK_IMPORTED_MODULE_14__.Controller);

_defineProperty(_default, "targets", ['input']);



/***/ }),

/***/ "./node_modules/snarkdown/dist/snarkdown.es.js":
/*!*****************************************************!*\
  !*** ./node_modules/snarkdown/dist/snarkdown.es.js ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ t)
/* harmony export */ });
var e={"":["<em>","</em>"],_:["<strong>","</strong>"],"*":["<strong>","</strong>"],"~":["<s>","</s>"],"\n":["<br />"]," ":["<br />"],"-":["<hr />"]};function n(e){return e.replace(RegExp("^"+(e.match(/^(\t| )+/)||"")[0],"gm"),"")}function r(e){return(e+"").replace(/"/g,"&quot;").replace(/</g,"&lt;").replace(/>/g,"&gt;")}function t(a,c){var o,l,g,s,p,u=/((?:^|\n+)(?:\n---+|\* \*(?: \*)+)\n)|(?:^``` *(\w*)\n([\s\S]*?)\n```$)|((?:(?:^|\n+)(?:\t|  {2,}).+)+\n*)|((?:(?:^|\n)([>*+-]|\d+\.)\s+.*)+)|(?:!\[([^\]]*?)\]\(([^)]+?)\))|(\[)|(\](?:\(([^)]+?)\))?)|(?:(?:^|\n+)([^\s].*)\n(-{3,}|={3,})(?:\n+|$))|(?:(?:^|\n+)(#{1,6})\s*(.+)(?:\n+|$))|(?:`([^`].*?)`)|(  \n\n*|\n{2,}|__|\*\*|[_*]|~~)/gm,m=[],h="",i=c||{},d=0;function f(n){var r=e[n[1]||""],t=m[m.length-1]==n;return r?r[1]?(t?m.pop():m.push(n),r[0|t]):r[0]:n}function $(){for(var e="";m.length;)e+=f(m[m.length-1]);return e}for(a=a.replace(/^\[(.+?)\]:\s*(.+)$/gm,function(e,n,r){return i[n.toLowerCase()]=r,""}).replace(/^\n+|\n+$/g,"");g=u.exec(a);)l=a.substring(d,g.index),d=u.lastIndex,o=g[0],l.match(/[^\\](\\\\)*\\$/)||((p=g[3]||g[4])?o='<pre class="code '+(g[4]?"poetry":g[2].toLowerCase())+'"><code'+(g[2]?' class="language-'+g[2].toLowerCase()+'"':"")+">"+n(r(p).replace(/^\n+|\n+$/g,""))+"</code></pre>":(p=g[6])?(p.match(/\./)&&(g[5]=g[5].replace(/^\d+/gm,"")),s=t(n(g[5].replace(/^\s*[>*+.-]/gm,""))),">"==p?p="blockquote":(p=p.match(/\./)?"ol":"ul",s=s.replace(/^(.*)(\n|$)/gm,"<li>$1</li>")),o="<"+p+">"+s+"</"+p+">"):g[8]?o='<img src="'+r(g[8])+'" alt="'+r(g[7])+'">':g[10]?(h=h.replace("<a>",'<a href="'+r(g[11]||i[l.toLowerCase()])+'">'),o=$()+"</a>"):g[9]?o="<a>":g[12]||g[14]?o="<"+(p="h"+(g[14]?g[14].length:g[13]>"="?1:2))+">"+t(g[12]||g[15],i)+"</"+p+">":g[16]?o="<code>"+r(g[16])+"</code>":(g[17]||g[1])&&(o=f(g[17]||"--"))),h+=l,h+=o;return(h+a.substring(d)+$()).replace(/^\n+|\n+$/g,"")}
//# sourceMappingURL=snarkdown.es.js.map


/***/ })

}]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYXNzZXRzX2NvbnRyb2xsZXJzX3NuYXJrZG93bl9jb250cm9sbGVyX2pzLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7QUFBQTtBQUNBO0FBQ0EsSUFBTUUsUUFBUSxHQUFHQyxNQUFNLENBQUNELFFBQXhCO0FBRUE7Ozs7Ozs7Ozs7Ozs7Ozs7OztvRUFLb0I7Ozs7Ozs7V0FFaEIsc0JBQWE7TUFDVCxLQUFLRSxhQUFMLEdBQXFCRixRQUFRLENBQUNHLGFBQVQsQ0FBdUIsS0FBdkIsQ0FBckI7TUFDQSxLQUFLRCxhQUFMLENBQW1CRSxTQUFuQixHQUErQixrQkFBL0I7TUFDQSxLQUFLRixhQUFMLENBQW1CRyxXQUFuQixHQUFpQyxnQ0FBakM7TUFDQSxLQUFLQyxPQUFMLENBQWFDLE1BQWIsQ0FBb0IsS0FBS0wsYUFBekI7SUFDSDs7O1dBQ0QsbUJBQVU7TUFDTixLQUFLTSxNQUFMO0lBQ0g7OztXQUNELGtCQUFTO01BQ0wsSUFBTUMsZUFBZSxHQUFHLEtBQUtDLFdBQUwsQ0FBaUJDLEtBQXpDO01BQ0EsS0FBS1QsYUFBTCxDQUFtQlUsU0FBbkIsR0FBK0JiLHNEQUFTLENBQUNVLGVBQUQsQ0FBeEM7SUFDSDs7OztFQWxCd0JYOztxQ0FFUixDQUFDLE9BQUQ7Ozs7Ozs7Ozs7Ozs7Ozs7QUNQckIsT0FBTyw4SUFBOEksY0FBYyxtRUFBbUUsY0FBYyxpQ0FBaUMscUJBQXFCLHFCQUFxQixHQUFrQixnQkFBZ0IsK0dBQStHLEdBQUcsaUlBQWlJLEdBQUcsR0FBRyxHQUFHLDJCQUEyQixJQUFJLCtDQUErQyxHQUFHLHNDQUFzQyxLQUFLLGNBQWMscUNBQXFDLGtEQUFrRCxhQUFhLGFBQWEsU0FBUyxxQkFBcUIsU0FBUyx3REFBd0QsK0JBQStCLDJCQUEyQixZQUFZLHd5QkFBd3lCO0FBQ3J5RCIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL2Fzc2V0cy9jb250cm9sbGVycy9zbmFya2Rvd25fY29udHJvbGxlci5qcyIsIndlYnBhY2s6Ly8vLi9ub2RlX21vZHVsZXMvc25hcmtkb3duL2Rpc3Qvc25hcmtkb3duLmVzLmpzIl0sInNvdXJjZXNDb250ZW50IjpbImltcG9ydCB7IENvbnRyb2xsZXIgfSBmcm9tICdAaG90d2lyZWQvc3RpbXVsdXMnO1xuaW1wb3J0IHNuYXJrZG93biBmcm9tICdzbmFya2Rvd24nO1xuY29uc3QgZG9jdW1lbnQgPSB3aW5kb3cuZG9jdW1lbnQ7XG5cbi8qIHN0aW11bHVzRmV0Y2g6ICdsYXp5JyAqL1xuZXhwb3J0IGRlZmF1bHQgY2xhc3MgZXh0ZW5kcyBDb250cm9sbGVyIHtcbiAgICBcbiAgICBzdGF0aWMgdGFyZ2V0cyA9IFsnaW5wdXQnXTtcbiAgICBcbiAgICBvdXRwdXRFbGVtZW50ID0gbnVsbDtcbiAgICBcbiAgICBpbml0aWFsaXplKCkge1xuICAgICAgICB0aGlzLm91dHB1dEVsZW1lbnQgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdkaXYnKTtcbiAgICAgICAgdGhpcy5vdXRwdXRFbGVtZW50LmNsYXNzTmFtZSA9ICdtYXJrZG93bi1wcmV2aWV3JztcbiAgICAgICAgdGhpcy5vdXRwdXRFbGVtZW50LnRleHRDb250ZW50ID0gJ01BUktET1dOIFdJTEwgQkUgUkVOREVSRUQgSEVSRSc7XG4gICAgICAgIHRoaXMuZWxlbWVudC5hcHBlbmQodGhpcy5vdXRwdXRFbGVtZW50KTtcbiAgICB9XG4gICAgY29ubmVjdCgpIHtcbiAgICAgICAgdGhpcy5yZW5kZXIoKTtcbiAgICB9XG4gICAgcmVuZGVyKCkge1xuICAgICAgICBjb25zdCBtYXJrZG93bkNvbnRlbnQgPSB0aGlzLmlucHV0VGFyZ2V0LnZhbHVlO1xuICAgICAgICB0aGlzLm91dHB1dEVsZW1lbnQuaW5uZXJIVE1MID0gc25hcmtkb3duKG1hcmtkb3duQ29udGVudCk7XG4gICAgfVxufSIsInZhciBlPXtcIlwiOltcIjxlbT5cIixcIjwvZW0+XCJdLF86W1wiPHN0cm9uZz5cIixcIjwvc3Ryb25nPlwiXSxcIipcIjpbXCI8c3Ryb25nPlwiLFwiPC9zdHJvbmc+XCJdLFwiflwiOltcIjxzPlwiLFwiPC9zPlwiXSxcIlxcblwiOltcIjxiciAvPlwiXSxcIiBcIjpbXCI8YnIgLz5cIl0sXCItXCI6W1wiPGhyIC8+XCJdfTtmdW5jdGlvbiBuKGUpe3JldHVybiBlLnJlcGxhY2UoUmVnRXhwKFwiXlwiKyhlLm1hdGNoKC9eKFxcdHwgKSsvKXx8XCJcIilbMF0sXCJnbVwiKSxcIlwiKX1mdW5jdGlvbiByKGUpe3JldHVybihlK1wiXCIpLnJlcGxhY2UoL1wiL2csXCImcXVvdDtcIikucmVwbGFjZSgvPC9nLFwiJmx0O1wiKS5yZXBsYWNlKC8+L2csXCImZ3Q7XCIpfWV4cG9ydCBkZWZhdWx0IGZ1bmN0aW9uIHQoYSxjKXt2YXIgbyxsLGcscyxwLHU9LygoPzpefFxcbispKD86XFxuLS0tK3xcXCogXFwqKD86IFxcKikrKVxcbil8KD86XmBgYCAqKFxcdyopXFxuKFtcXHNcXFNdKj8pXFxuYGBgJCl8KCg/Oig/Ol58XFxuKykoPzpcXHR8ICB7Mix9KS4rKStcXG4qKXwoKD86KD86XnxcXG4pKFs+KistXXxcXGQrXFwuKVxccysuKikrKXwoPzohXFxbKFteXFxdXSo/KVxcXVxcKChbXildKz8pXFwpKXwoXFxbKXwoXFxdKD86XFwoKFteKV0rPylcXCkpPyl8KD86KD86XnxcXG4rKShbXlxcc10uKilcXG4oLXszLH18PXszLH0pKD86XFxuK3wkKSl8KD86KD86XnxcXG4rKSgjezEsNn0pXFxzKiguKykoPzpcXG4rfCQpKXwoPzpgKFteYF0uKj8pYCl8KCAgXFxuXFxuKnxcXG57Mix9fF9ffFxcKlxcKnxbXypdfH5+KS9nbSxtPVtdLGg9XCJcIixpPWN8fHt9LGQ9MDtmdW5jdGlvbiBmKG4pe3ZhciByPWVbblsxXXx8XCJcIl0sdD1tW20ubGVuZ3RoLTFdPT1uO3JldHVybiByP3JbMV0/KHQ/bS5wb3AoKTptLnB1c2gobiksclswfHRdKTpyWzBdOm59ZnVuY3Rpb24gJCgpe2Zvcih2YXIgZT1cIlwiO20ubGVuZ3RoOyllKz1mKG1bbS5sZW5ndGgtMV0pO3JldHVybiBlfWZvcihhPWEucmVwbGFjZSgvXlxcWyguKz8pXFxdOlxccyooLispJC9nbSxmdW5jdGlvbihlLG4scil7cmV0dXJuIGlbbi50b0xvd2VyQ2FzZSgpXT1yLFwiXCJ9KS5yZXBsYWNlKC9eXFxuK3xcXG4rJC9nLFwiXCIpO2c9dS5leGVjKGEpOylsPWEuc3Vic3RyaW5nKGQsZy5pbmRleCksZD11Lmxhc3RJbmRleCxvPWdbMF0sbC5tYXRjaCgvW15cXFxcXShcXFxcXFxcXCkqXFxcXCQvKXx8KChwPWdbM118fGdbNF0pP289JzxwcmUgY2xhc3M9XCJjb2RlICcrKGdbNF0/XCJwb2V0cnlcIjpnWzJdLnRvTG93ZXJDYXNlKCkpKydcIj48Y29kZScrKGdbMl0/JyBjbGFzcz1cImxhbmd1YWdlLScrZ1syXS50b0xvd2VyQ2FzZSgpKydcIic6XCJcIikrXCI+XCIrbihyKHApLnJlcGxhY2UoL15cXG4rfFxcbiskL2csXCJcIikpK1wiPC9jb2RlPjwvcHJlPlwiOihwPWdbNl0pPyhwLm1hdGNoKC9cXC4vKSYmKGdbNV09Z1s1XS5yZXBsYWNlKC9eXFxkKy9nbSxcIlwiKSkscz10KG4oZ1s1XS5yZXBsYWNlKC9eXFxzKls+KisuLV0vZ20sXCJcIikpKSxcIj5cIj09cD9wPVwiYmxvY2txdW90ZVwiOihwPXAubWF0Y2goL1xcLi8pP1wib2xcIjpcInVsXCIscz1zLnJlcGxhY2UoL14oLiopKFxcbnwkKS9nbSxcIjxsaT4kMTwvbGk+XCIpKSxvPVwiPFwiK3ArXCI+XCIrcytcIjwvXCIrcCtcIj5cIik6Z1s4XT9vPSc8aW1nIHNyYz1cIicrcihnWzhdKSsnXCIgYWx0PVwiJytyKGdbN10pKydcIj4nOmdbMTBdPyhoPWgucmVwbGFjZShcIjxhPlwiLCc8YSBocmVmPVwiJytyKGdbMTFdfHxpW2wudG9Mb3dlckNhc2UoKV0pKydcIj4nKSxvPSQoKStcIjwvYT5cIik6Z1s5XT9vPVwiPGE+XCI6Z1sxMl18fGdbMTRdP289XCI8XCIrKHA9XCJoXCIrKGdbMTRdP2dbMTRdLmxlbmd0aDpnWzEzXT5cIj1cIj8xOjIpKStcIj5cIit0KGdbMTJdfHxnWzE1XSxpKStcIjwvXCIrcCtcIj5cIjpnWzE2XT9vPVwiPGNvZGU+XCIrcihnWzE2XSkrXCI8L2NvZGU+XCI6KGdbMTddfHxnWzFdKSYmKG89ZihnWzE3XXx8XCItLVwiKSkpLGgrPWwsaCs9bztyZXR1cm4oaCthLnN1YnN0cmluZyhkKSskKCkpLnJlcGxhY2UoL15cXG4rfFxcbiskL2csXCJcIil9XG4vLyMgc291cmNlTWFwcGluZ1VSTD1zbmFya2Rvd24uZXMuanMubWFwXG4iXSwibmFtZXMiOlsiQ29udHJvbGxlciIsInNuYXJrZG93biIsImRvY3VtZW50Iiwid2luZG93Iiwib3V0cHV0RWxlbWVudCIsImNyZWF0ZUVsZW1lbnQiLCJjbGFzc05hbWUiLCJ0ZXh0Q29udGVudCIsImVsZW1lbnQiLCJhcHBlbmQiLCJyZW5kZXIiLCJtYXJrZG93bkNvbnRlbnQiLCJpbnB1dFRhcmdldCIsInZhbHVlIiwiaW5uZXJIVE1MIl0sInNvdXJjZVJvb3QiOiIifQ==