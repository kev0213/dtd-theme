webpackJsonp([0],[
/* 0 */,
/* 1 */,
/* 2 */,
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _EasySlider = __webpack_require__(5);

var _EasySlider2 = _interopRequireDefault(_EasySlider);

var _Modal = __webpack_require__(6);

var _Modal2 = _interopRequireDefault(_Modal);

var _Work = __webpack_require__(12);

var _Work2 = _interopRequireDefault(_Work);

var _Api = __webpack_require__(11);

var _Api2 = _interopRequireDefault(_Api);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

window._ = __webpack_require__(2);

window.$ = window.jQuery = __webpack_require__(1);

window.Hammer = __webpack_require__(0);

(function () {

    /**
     * 常數WIN永遠指向 $(window)
     */
    var WIN = $(window);

    var $page = $('html, body');

    new _Work2.default();

    /**
     * 初始化所有 EasySlider
     */
    var easySliders = [];
    (function ($easySliders) {

        if (!$easySliders.length) {
            easySliders = undefined;
            return;
        }

        for (var i = 0; i < $easySliders.length; i++) {
            easySliders.push(new _EasySlider2.default($($easySliders[i])));
        }
    })($('.easy-slider'));

    /**
     * 初始化所有 Modal
     */
    var modals = {};
    (function ($modals, $buttons, $cover) {

        if (!$modals.length) {
            modals = undefined;
            return;
        }

        var buttons = $buttons || $('.modal-btn');

        var cover = $cover || $('.modal-cover');

        for (var i = 0; i < $modals.length; i++) {
            modals[$modals[i].id] = new _Modal2.default($($modals[i]));
        }

        buttons.on('click', function () {
            var target = $(this).data('target');
            cover.addClass('show');
            $page.addClass('modal-open');
            $('#' + target + ', .' + target).addClass('show');
        });

        cover.on('click', function (event) {

            var e = event || window.event;

            if (this != e.target) return;

            cover.removeClass('show');
            $modals.removeClass('show');
            $page.removeClass('modal-open');
        });
    })($('.modal'));

    /**
     * 初始化所有 tab-nav
     */
    (function ($tabNav, $tabContent) {

        if (!$tabNav.length) return;

        $tabNav.find('.tab').on('click', function () {
            var $this = $(this);

            /** 更新 active tab */
            $this.siblings().removeClass('active');
            $this.addClass('active');

            /** 更新對應的 tab content. */
            $tabContent.children().removeClass('active');
            $tabContent.find('.' + $this.attr('target')).addClass('active');
        });
    })($('.tab-nav'), $('.tab-content'));
})();

/***/ }),
/* 4 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

/**
 * 這個 component 依賴 jquery, hammerjs
 * 使用前確保已經引入以上兩套 library.
 */
var EasySlider = function () {

    /**
     * container 必須是 jQuery 物件
     * 例如：$('.easy-slider')
     */
    function EasySlider(container) {
        _classCallCheck(this, EasySlider);

        /**
         * 屬性初始化
         */
        this.activeItemIndex = 0;
        this.container = container;
        this.items = container.find('.slider-item');
        this.control = container.find('.slider-control');
        this.controlDots = this.control.find('.control-dot');
        this.prevBtn = this.container.find('.prev-btn');
        this.nextBtn = this.container.find('.next-btn');

        /** 元件初始化 */
        this.init();
    }

    _createClass(EasySlider, [{
        key: 'init',
        value: function init() {
            var _this = this;

            var self = this;

            var el = this.container[0];

            var mc = new Hammer(el);

            /** 初始化 slider 的 panleft 事件  */
            mc.on('swipeleft', _.debounce(function () {
                self.moveToNext();
            }, 50));

            /** 初始化 slider 的 panright 事件  */
            mc.on('swiperight', _.debounce(function () {
                self.moveToPrev();
            }, 50));

            /** 如果有 prev btn, 初始化它的事件監聽 */
            if (this.prevBtn.length) {
                this.prevBtn.on('click', function () {
                    _this.moveToPrev();
                });
            }

            /** 如果有 next btn, 初始化它的事件監聽 */
            if (this.nextBtn.length) {
                this.nextBtn.on('click', function () {
                    _this.moveToNext();
                });
            }

            /** 直接點擊 "點點" */
            this.controlDots.on('click', function () {
                self.moveTo(self.controlDots.index(this));
            });
        }
    }, {
        key: 'moveToPrev',
        value: function moveToPrev() {

            /** 計算合理的上 prev index */
            var index = this.activeItemIndex ? this.activeItemIndex - 1 : this.items.length - 1;

            /** 移動至該引索 */
            this.moveTo(index);
        }
    }, {
        key: 'moveToNext',
        value: function moveToNext() {

            /** 計算合理的上 next index */
            var index = this.activeItemIndex === this.items.length - 1 ? 0 : this.activeItemIndex + 1;

            /** 移動至該引索 */
            this.moveTo(index);
        }
    }, {
        key: 'moveTo',
        value: function moveTo(index) {

            /** 如果有 control dot, 更新 active */
            if (this.controlDots.length) {
                this.controlDots.removeClass('active');
                this.controlDots.eq(index).addClass('active');
            }

            /** 設定當下激活的 slide item */
            this.setCurrent(index);
        }
    }, {
        key: 'setCurrent',
        value: function setCurrent(index) {

            /** 更新 current active slide item */
            this.activeItemIndex = index;

            /** 移動 */
            this.items.css({
                'transform': 'translateX(-' + index * 100 + '%)'
            });
        }
    }]);

    return EasySlider;
}();

exports.default = EasySlider;
;

/***/ }),
/* 6 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Modal = function () {
    function Modal(modal) {
        _classCallCheck(this, Modal);

        this.modal = modal;
        this.init();
    }

    _createClass(Modal, [{
        key: 'init',
        value: function init() {
            // 
        }
    }, {
        key: 'show',
        value: function show(callback) {
            this.modal.addClass('show');
            if (callback) callback;
        }
    }, {
        key: 'hide',
        value: function hide(callback) {
            this.modal.removeClass('show');
            if (callback) callback;
        }
    }]);

    return Modal;
}();

exports.default = Modal;

/***/ }),
/* 7 */,
/* 8 */,
/* 9 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(3);
module.exports = __webpack_require__(4);


/***/ }),
/* 10 */,
/* 11 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
var baseUrl = '';
if (location.hostname == 'localhost') {
    baseUrl = '/dtd/wp-admin/admin-ajax.php';
} else {
    baseUrl = '/wp-admin/admin-ajax.php';
}

exports.default = {
    getWork: baseUrl + '?action=get_custom_posts_api&postType=work'
};

/***/ }),
/* 12 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _jquery = __webpack_require__(1);

var _jquery2 = _interopRequireDefault(_jquery);

var _Api = __webpack_require__(11);

var _Api2 = _interopRequireDefault(_Api);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Work = function () {
    function Work(obj) {
        _classCallCheck(this, Work);

        this.init();
    }

    _createClass(Work, [{
        key: 'init',
        value: function init() {

            _jquery2.default.ajax({
                type: "GET",
                url: _Api2.default.getWork,
                dataType: "json",
                data: { postType: 'work', taxonomy: 'work_type', term: 'code' },
                success: function success(response) {
                    console.log(response);
                }
            });
        }
    }]);

    return Work;
}();

exports.default = Work;

/***/ })
],[9]);