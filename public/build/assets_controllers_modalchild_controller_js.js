"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["assets_controllers_modalchild_controller_js"],{

/***/ "./assets/controllers/modalchild_controller.js":
/*!*****************************************************!*\
  !*** ./assets/controllers/modalchild_controller.js ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ _default)
/* harmony export */ });
/* harmony import */ var core_js_modules_es_array_concat_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.array.concat.js */ "./node_modules/core-js/modules/es.array.concat.js");
/* harmony import */ var core_js_modules_es_array_concat_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_concat_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_array_find_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.array.find.js */ "./node_modules/core-js/modules/es.array.find.js");
/* harmony import */ var core_js_modules_es_array_find_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_find_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.object.define-property.js */ "./node_modules/core-js/modules/es.object.define-property.js");
/* harmony import */ var core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/es.object.set-prototype-of.js */ "./node_modules/core-js/modules/es.object.set-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var core_js_modules_es_function_bind_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/es.function.bind.js */ "./node_modules/core-js/modules/es.function.bind.js");
/* harmony import */ var core_js_modules_es_function_bind_js__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_function_bind_js__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! core-js/modules/es.object.get-prototype-of.js */ "./node_modules/core-js/modules/es.object.get-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! core-js/modules/es.reflect.construct.js */ "./node_modules/core-js/modules/es.reflect.construct.js");
/* harmony import */ var core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! core-js/modules/es.object.create.js */ "./node_modules/core-js/modules/es.object.create.js");
/* harmony import */ var core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! core-js/modules/es.symbol.js */ "./node_modules/core-js/modules/es.symbol.js");
/* harmony import */ var core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! core-js/modules/es.symbol.description.js */ "./node_modules/core-js/modules/es.symbol.description.js");
/* harmony import */ var core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_10__);
/* harmony import */ var core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! core-js/modules/es.symbol.iterator.js */ "./node_modules/core-js/modules/es.symbol.iterator.js");
/* harmony import */ var core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_11___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_11__);
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! core-js/modules/es.array.iterator.js */ "./node_modules/core-js/modules/es.array.iterator.js");
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_12___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_12__);
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_13___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_13__);
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! core-js/modules/web.dom-collections.iterator.js */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_14___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_14__);
/* harmony import */ var _hotwired_stimulus__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! @hotwired/stimulus */ "./node_modules/@hotwired/stimulus/dist/stimulus.js");
/* harmony import */ var bootstrap__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.esm.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_17___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_17__);
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




jquery__WEBPACK_IMPORTED_MODULE_17___default().noConflict();
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

    _defineProperty(_assertThisInitialized(_this), "modal", null);

    return _this;
  }

  _createClass(_default, [{
    key: "handleClick",
    value: function handleClick(e) {
      var btn = jquery__WEBPACK_IMPORTED_MODULE_17___default()(e.currentTarget);
      var modal_target = btn.closest('.caption').find('.modal').eq(0);
      var obj_modal = document.getElementById(modal_target.attr('id'));
      this.modal = new bootstrap__WEBPACK_IMPORTED_MODULE_16__.Modal('#' + modal_target.attr('id'));
      obj_modal.addEventListener('show.bs.modal', function () {
        console.log('El modal está abriéndose.');
      }); // Escucha el evento `shown.bs.modal` para confirmar que se ha completado

      obj_modal.addEventListener('shown.bs.modal', function () {
        console.log('El modal se ha abierto completamente.');
      });
      this.modal.show();
      /*
      //Modal information
      const main = this;
      const confirmModal = document.getElementById('modal_confirm')
      
      main.getContent(btn);
       if (confirmModal) {
          confirmModal.addEventListener('show.bs.modal', event => {
              $('#alert-wrapper').hide();
              
          })
      }
      */
    }
  }, {
    key: "closeModal",
    value: function closeModal() {
      //Close modal
      this.modal.hide();
      jquery__WEBPACK_IMPORTED_MODULE_17___default()('.btn-action-close').off();
      jquery__WEBPACK_IMPORTED_MODULE_17___default()('.btn-action-close').on('click', function () {
        if (jquery__WEBPACK_IMPORTED_MODULE_17___default()(this).attr('action') == 'closeAndContinue' && activeCheck) {
          jquery__WEBPACK_IMPORTED_MODULE_17___default()('#' + activeCheck).prop('checked', true);
          jquery__WEBPACK_IMPORTED_MODULE_17___default()('#' + activeCheck).removeClass('is-invalid');
          jquery__WEBPACK_IMPORTED_MODULE_17___default()('#' + activeCheck).addClass('is-valid');
        }

        main.closeModal();
      });
    }
  }]);

  return _default;
}(_hotwired_stimulus__WEBPACK_IMPORTED_MODULE_15__.Controller);

_defineProperty(_default, "values", {});



/***/ })

}]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYXNzZXRzX2NvbnRyb2xsZXJzX21vZGFsY2hpbGRfY29udHJvbGxlcl9qcy5qcyIsIm1hcHBpbmdzIjoiOzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7QUFBQTtBQUNBO0FBRUE7QUFFQUUseURBQUE7QUFFQTs7Ozs7Ozs7Ozs7Ozs7Ozs7OzREQUtZOzs7Ozs7O1dBRVIscUJBQVlFLENBQVosRUFBYztNQUVWLElBQU1DLEdBQUcsR0FBR0gsOENBQUMsQ0FBQ0UsQ0FBQyxDQUFDRSxhQUFILENBQWI7TUFDQSxJQUFNQyxZQUFZLEdBQUdGLEdBQUcsQ0FBQ0csT0FBSixDQUFZLFVBQVosRUFBd0JDLElBQXhCLENBQTZCLFFBQTdCLEVBQXVDQyxFQUF2QyxDQUEwQyxDQUExQyxDQUFyQjtNQUVBLElBQUlDLFNBQVMsR0FBR0MsUUFBUSxDQUFDQyxjQUFULENBQXdCTixZQUFZLENBQUNPLElBQWIsQ0FBa0IsSUFBbEIsQ0FBeEIsQ0FBaEI7TUFDQSxLQUFLQyxLQUFMLEdBQWEsSUFBSWQsNkNBQUosQ0FBVSxNQUFJTSxZQUFZLENBQUNPLElBQWIsQ0FBa0IsSUFBbEIsQ0FBZCxDQUFiO01BRUFILFNBQVMsQ0FBQ0ssZ0JBQVYsQ0FBMkIsZUFBM0IsRUFBNEMsWUFBTTtRQUM5Q0MsT0FBTyxDQUFDQyxHQUFSLENBQVksMkJBQVo7TUFDSCxDQUZELEVBUlUsQ0FZVjs7TUFDQVAsU0FBUyxDQUFDSyxnQkFBVixDQUEyQixnQkFBM0IsRUFBNkMsWUFBTTtRQUMvQ0MsT0FBTyxDQUFDQyxHQUFSLENBQVksdUNBQVo7TUFDSCxDQUZEO01BSUEsS0FBS0gsS0FBTCxDQUFXSSxJQUFYO01BR0E7QUFDUjtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7SUFHSzs7O1dBRUQsc0JBQVk7TUFDUjtNQUNBLEtBQUtKLEtBQUwsQ0FBV0ssSUFBWDtNQUVBbEIsOENBQUMsQ0FBQyxtQkFBRCxDQUFELENBQXVCbUIsR0FBdkI7TUFDWW5CLDhDQUFDLENBQUMsbUJBQUQsQ0FBRCxDQUF1Qm9CLEVBQXZCLENBQTBCLE9BQTFCLEVBQW1DLFlBQVU7UUFFekMsSUFBR3BCLDhDQUFDLENBQUMsSUFBRCxDQUFELENBQVFZLElBQVIsQ0FBYSxRQUFiLEtBQTBCLGtCQUExQixJQUFnRFMsV0FBbkQsRUFBK0Q7VUFDdkRyQiw4Q0FBQyxDQUFDLE1BQUlxQixXQUFMLENBQUQsQ0FBbUJDLElBQW5CLENBQXdCLFNBQXhCLEVBQW1DLElBQW5DO1VBQ0F0Qiw4Q0FBQyxDQUFDLE1BQUlxQixXQUFMLENBQUQsQ0FBbUJFLFdBQW5CLENBQStCLFlBQS9CO1VBQ0F2Qiw4Q0FBQyxDQUFDLE1BQUlxQixXQUFMLENBQUQsQ0FBbUJHLFFBQW5CLENBQTRCLFVBQTVCO1FBQ1A7O1FBRURDLElBQUksQ0FBQ0MsVUFBTDtNQUNILENBVEQ7SUFVZjs7OztFQTFEd0I1Qjs7b0NBRVQiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvY29udHJvbGxlcnMvbW9kYWxjaGlsZF9jb250cm9sbGVyLmpzIl0sInNvdXJjZXNDb250ZW50IjpbImltcG9ydCB7IENvbnRyb2xsZXIgfSBmcm9tIFwiQGhvdHdpcmVkL3N0aW11bHVzXCI7XG5pbXBvcnQgeyBNb2RhbCB9IGZyb20gXCJib290c3RyYXBcIjtcblxuaW1wb3J0ICQgZnJvbSAnanF1ZXJ5JztcblxuJC5ub0NvbmZsaWN0KCk7XG5cbi8qIHN0aW11bHVzRmV0Y2g6ICdsYXp5JyAqL1xuZXhwb3J0IGRlZmF1bHQgY2xhc3MgZXh0ZW5kcyBDb250cm9sbGVye1xuXG4gICAgc3RhdGljIHZhbHVlcyA9IHt9XG5cbiAgICBtb2RhbCA9IG51bGw7XG5cbiAgICBoYW5kbGVDbGljayhlKXtcbiAgICAgICAgXG4gICAgICAgIGNvbnN0IGJ0biA9ICQoZS5jdXJyZW50VGFyZ2V0KTtcbiAgICAgICAgY29uc3QgbW9kYWxfdGFyZ2V0ID0gYnRuLmNsb3Nlc3QoJy5jYXB0aW9uJykuZmluZCgnLm1vZGFsJykuZXEoMCk7XG5cbiAgICAgICAgbGV0IG9ial9tb2RhbCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKG1vZGFsX3RhcmdldC5hdHRyKCdpZCcpKTtcbiAgICAgICAgdGhpcy5tb2RhbCA9IG5ldyBNb2RhbCgnIycrbW9kYWxfdGFyZ2V0LmF0dHIoJ2lkJykpOyAgICAgICAgXG4gICAgICAgIFxuICAgICAgICBvYmpfbW9kYWwuYWRkRXZlbnRMaXN0ZW5lcignc2hvdy5icy5tb2RhbCcsICgpID0+IHtcbiAgICAgICAgICAgIGNvbnNvbGUubG9nKCdFbCBtb2RhbCBlc3TDoSBhYnJpw6luZG9zZS4nKTtcbiAgICAgICAgfSk7XG4gICAgICAgIFxuICAgICAgICAvLyBFc2N1Y2hhIGVsIGV2ZW50byBgc2hvd24uYnMubW9kYWxgIHBhcmEgY29uZmlybWFyIHF1ZSBzZSBoYSBjb21wbGV0YWRvXG4gICAgICAgIG9ial9tb2RhbC5hZGRFdmVudExpc3RlbmVyKCdzaG93bi5icy5tb2RhbCcsICgpID0+IHtcbiAgICAgICAgICAgIGNvbnNvbGUubG9nKCdFbCBtb2RhbCBzZSBoYSBhYmllcnRvIGNvbXBsZXRhbWVudGUuJyk7XG4gICAgICAgIH0pO1xuICAgICAgICBcbiAgICAgICAgdGhpcy5tb2RhbC5zaG93KCk7XG4gICAgICAgIFxuICAgICAgICBcbiAgICAgICAgLypcbiAgICAgICAgLy9Nb2RhbCBpbmZvcm1hdGlvblxuICAgICAgICBjb25zdCBtYWluID0gdGhpcztcbiAgICAgICAgY29uc3QgY29uZmlybU1vZGFsID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ21vZGFsX2NvbmZpcm0nKVxuICAgICAgICBcbiAgICAgICAgbWFpbi5nZXRDb250ZW50KGJ0bik7XG5cbiAgICAgICAgaWYgKGNvbmZpcm1Nb2RhbCkge1xuICAgICAgICAgICAgY29uZmlybU1vZGFsLmFkZEV2ZW50TGlzdGVuZXIoJ3Nob3cuYnMubW9kYWwnLCBldmVudCA9PiB7XG4gICAgICAgICAgICAgICAgJCgnI2FsZXJ0LXdyYXBwZXInKS5oaWRlKCk7XG4gICAgICAgICAgICAgICAgXG4gICAgICAgICAgICB9KVxuICAgICAgICB9XG4gICAgICAgICovXG5cbiAgICB9XG5cbiAgICBjbG9zZU1vZGFsKCl7XG4gICAgICAgIC8vQ2xvc2UgbW9kYWxcbiAgICAgICAgdGhpcy5tb2RhbC5oaWRlKCk7XG5cbiAgICAgICAgJCgnLmJ0bi1hY3Rpb24tY2xvc2UnKS5vZmYoKTtcbiAgICAgICAgICAgICAgICAgICAgJCgnLmJ0bi1hY3Rpb24tY2xvc2UnKS5vbignY2xpY2snLCBmdW5jdGlvbigpe1xuICAgICAgICAgICAgICAgICAgICAgICBcbiAgICAgICAgICAgICAgICAgICAgICAgIGlmKCQodGhpcykuYXR0cignYWN0aW9uJykgPT0gJ2Nsb3NlQW5kQ29udGludWUnICYmIGFjdGl2ZUNoZWNrKXtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJCgnIycrYWN0aXZlQ2hlY2spLnByb3AoJ2NoZWNrZWQnLCB0cnVlKTtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJCgnIycrYWN0aXZlQ2hlY2spLnJlbW92ZUNsYXNzKCdpcy1pbnZhbGlkJylcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJCgnIycrYWN0aXZlQ2hlY2spLmFkZENsYXNzKCdpcy12YWxpZCcpICAgIFxuICAgICAgICAgICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgICAgICAgICBtYWluLmNsb3NlTW9kYWwoKTtcbiAgICAgICAgICAgICAgICAgICAgfSk7XG4gICAgfVxuXG59Il0sIm5hbWVzIjpbIkNvbnRyb2xsZXIiLCJNb2RhbCIsIiQiLCJub0NvbmZsaWN0IiwiZSIsImJ0biIsImN1cnJlbnRUYXJnZXQiLCJtb2RhbF90YXJnZXQiLCJjbG9zZXN0IiwiZmluZCIsImVxIiwib2JqX21vZGFsIiwiZG9jdW1lbnQiLCJnZXRFbGVtZW50QnlJZCIsImF0dHIiLCJtb2RhbCIsImFkZEV2ZW50TGlzdGVuZXIiLCJjb25zb2xlIiwibG9nIiwic2hvdyIsImhpZGUiLCJvZmYiLCJvbiIsImFjdGl2ZUNoZWNrIiwicHJvcCIsInJlbW92ZUNsYXNzIiwiYWRkQ2xhc3MiLCJtYWluIiwiY2xvc2VNb2RhbCJdLCJzb3VyY2VSb290IjoiIn0=