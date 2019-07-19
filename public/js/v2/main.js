/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/v2/bootstrap-datepicker.js":
/***/ (function(module, exports) {

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

/* =========================================================
 * bootstrap-datepicker.js 
 * http://www.eyecon.ro/bootstrap-datepicker
 * =========================================================
 * Copyright 2012 Stefan Petre
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================= */

!function ($) {

	// Picker object

	var Datepicker = function Datepicker(element, options) {
		this.element = $(element);
		this.format = DPGlobal.parseFormat(options.format || this.element.data('date-format') || 'mm/dd/yyyy');
		this.picker = $(DPGlobal.template).appendTo('body').on({
			click: $.proxy(this.click, this) //,
			//mousedown: $.proxy(this.mousedown, this)
		});
		this.isInput = this.element.is('input');
		this.component = this.element.is('.date') ? this.element.find('.add-on') : false;

		if (this.isInput) {
			this.element.on({
				focus: $.proxy(this.show, this),
				//blur: $.proxy(this.hide, this),
				keyup: $.proxy(this.update, this)
			});
		} else {
			if (this.component) {
				this.component.on('click', $.proxy(this.show, this));
			} else {
				this.element.on('click', $.proxy(this.show, this));
			}
		}

		this.minViewMode = options.minViewMode || this.element.data('date-minviewmode') || 0;
		if (typeof this.minViewMode === 'string') {
			switch (this.minViewMode) {
				case 'months':
					this.minViewMode = 1;
					break;
				case 'years':
					this.minViewMode = 2;
					break;
				default:
					this.minViewMode = 0;
					break;
			}
		}
		this.viewMode = options.viewMode || this.element.data('date-viewmode') || 0;
		if (typeof this.viewMode === 'string') {
			switch (this.viewMode) {
				case 'months':
					this.viewMode = 1;
					break;
				case 'years':
					this.viewMode = 2;
					break;
				default:
					this.viewMode = 0;
					break;
			}
		}
		this.startViewMode = this.viewMode;
		this.weekStart = options.weekStart || this.element.data('date-weekstart') || 0;
		this.weekEnd = this.weekStart === 0 ? 6 : this.weekStart - 1;
		this.onRender = options.onRender;
		this.fillDow();
		this.fillMonths();
		this.update();
		this.showMode();
	};

	Datepicker.prototype = {
		constructor: Datepicker,

		show: function show(e) {
			this.picker.show();
			this.height = this.component ? this.component.outerHeight() : this.element.outerHeight();
			this.place();
			$(window).on('resize', $.proxy(this.place, this));
			if (e) {
				e.stopPropagation();
				e.preventDefault();
			}
			if (!this.isInput) {}
			var that = this;
			$(document).on('mousedown', function (ev) {
				if ($(ev.target).closest('.datepicker').length == 0) {
					that.hide();
				}
			});
			this.element.trigger({
				type: 'show',
				date: this.date
			});
		},

		hide: function hide() {
			this.picker.hide();
			$(window).off('resize', this.place);
			this.viewMode = this.startViewMode;
			this.showMode();
			if (!this.isInput) {
				$(document).off('mousedown', this.hide);
			}
			//this.set();
			this.element.trigger({
				type: 'hide',
				date: this.date
			});
		},

		set: function set() {
			var formated = DPGlobal.formatDate(this.date, this.format);
			if (!this.isInput) {
				if (this.component) {
					this.element.find('input').prop('value', formated);
				}
				this.element.data('date', formated);
			} else {
				this.element.prop('value', formated);
			}
		},

		setValue: function setValue(newDate) {
			if (typeof newDate === 'string') {
				this.date = DPGlobal.parseDate(newDate, this.format);
			} else {
				this.date = new Date(newDate);
			}
			this.set();
			this.viewDate = new Date(this.date.getFullYear(), this.date.getMonth(), 1, 0, 0, 0, 0);
			this.fill();
		},

		place: function place() {
			var offset = this.component ? this.component.offset() : this.element.offset();
			this.picker.css({
				top: offset.top + this.height,
				left: offset.left
			});
		},

		update: function update(newDate) {
			this.date = DPGlobal.parseDate(typeof newDate === 'string' ? newDate : this.isInput ? this.element.prop('value') : this.element.data('date'), this.format);
			this.viewDate = new Date(this.date.getFullYear(), this.date.getMonth(), 1, 0, 0, 0, 0);
			this.fill();
		},

		fillDow: function fillDow() {
			var dowCnt = this.weekStart;
			var html = '<tr>';
			while (dowCnt < this.weekStart + 7) {
				html += '<th class="dow">' + DPGlobal.dates.daysMin[dowCnt++ % 7] + '</th>';
			}
			html += '</tr>';
			this.picker.find('.datepicker-days thead').append(html);
		},

		fillMonths: function fillMonths() {
			var html = '';
			var i = 0;
			while (i < 12) {
				html += '<span class="month">' + DPGlobal.dates.monthsShort[i++] + '</span>';
			}
			this.picker.find('.datepicker-months td').append(html);
		},

		fill: function fill() {
			var d = new Date(this.viewDate),
			    year = d.getFullYear(),
			    month = d.getMonth(),
			    currentDate = this.date.valueOf();
			this.picker.find('.datepicker-days th:eq(1)').text(DPGlobal.dates.months[month] + ' ' + year);
			var prevMonth = new Date(year, month - 1, 28, 0, 0, 0, 0),
			    day = DPGlobal.getDaysInMonth(prevMonth.getFullYear(), prevMonth.getMonth());
			prevMonth.setDate(day);
			prevMonth.setDate(day - (prevMonth.getDay() - this.weekStart + 7) % 7);
			var nextMonth = new Date(prevMonth);
			nextMonth.setDate(nextMonth.getDate() + 42);
			nextMonth = nextMonth.valueOf();
			var html = [];
			var clsName, prevY, prevM;
			while (prevMonth.valueOf() < nextMonth) {
				if (prevMonth.getDay() === this.weekStart) {
					html.push('<tr>');
				}
				clsName = this.onRender(prevMonth);
				prevY = prevMonth.getFullYear();
				prevM = prevMonth.getMonth();
				if (prevM < month && prevY === year || prevY < year) {
					clsName += ' old';
				} else if (prevM > month && prevY === year || prevY > year) {
					clsName += ' new';
				}
				if (prevMonth.valueOf() === currentDate) {
					clsName += ' active';
				}
				html.push('<td class="day ' + clsName + '">' + prevMonth.getDate() + '</td>');
				if (prevMonth.getDay() === this.weekEnd) {
					html.push('</tr>');
				}
				prevMonth.setDate(prevMonth.getDate() + 1);
			}
			this.picker.find('.datepicker-days tbody').empty().append(html.join(''));
			var currentYear = this.date.getFullYear();

			var months = this.picker.find('.datepicker-months').find('th:eq(1)').text(year).end().find('span').removeClass('active');
			if (currentYear === year) {
				months.eq(this.date.getMonth()).addClass('active');
			}

			html = '';
			year = parseInt(year / 10, 10) * 10;
			var yearCont = this.picker.find('.datepicker-years').find('th:eq(1)').text(year + '-' + (year + 9)).end().find('td');
			year -= 1;
			for (var i = -1; i < 11; i++) {
				html += '<span class="year' + (i === -1 || i === 10 ? ' old' : '') + (currentYear === year ? ' active' : '') + '">' + year + '</span>';
				year += 1;
			}
			yearCont.html(html);
		},

		click: function click(e) {
			e.stopPropagation();
			e.preventDefault();
			var target = $(e.target).closest('span, td, th');
			if (target.length === 1) {
				switch (target[0].nodeName.toLowerCase()) {
					case 'th':
						switch (target[0].className) {
							case 'switch':
								this.showMode(1);
								break;
							case 'prev':
							case 'next':
								this.viewDate['set' + DPGlobal.modes[this.viewMode].navFnc].call(this.viewDate, this.viewDate['get' + DPGlobal.modes[this.viewMode].navFnc].call(this.viewDate) + DPGlobal.modes[this.viewMode].navStep * (target[0].className === 'prev' ? -1 : 1));
								this.fill();
								this.set();
								break;
						}
						break;
					case 'span':
						if (target.is('.month')) {
							var month = target.parent().find('span').index(target);
							this.viewDate.setMonth(month);
						} else {
							var year = parseInt(target.text(), 10) || 0;
							this.viewDate.setFullYear(year);
						}
						if (this.viewMode !== 0) {
							this.date = new Date(this.viewDate);
							this.element.trigger({
								type: 'changeDate',
								date: this.date,
								viewMode: DPGlobal.modes[this.viewMode].clsName
							});
						}
						this.showMode(-1);
						this.fill();
						this.set();
						break;
					case 'td':
						if (target.is('.day') && !target.is('.disabled')) {
							var day = parseInt(target.text(), 10) || 1;
							var month = this.viewDate.getMonth();
							if (target.is('.old')) {
								month -= 1;
							} else if (target.is('.new')) {
								month += 1;
							}
							var year = this.viewDate.getFullYear();
							this.date = new Date(year, month, day, 0, 0, 0, 0);
							this.viewDate = new Date(year, month, Math.min(28, day), 0, 0, 0, 0);
							this.fill();
							this.set();
							this.element.trigger({
								type: 'changeDate',
								date: this.date,
								viewMode: DPGlobal.modes[this.viewMode].clsName
							});
						}
						break;
				}
			}
		},

		mousedown: function mousedown(e) {
			e.stopPropagation();
			e.preventDefault();
		},

		showMode: function showMode(dir) {
			if (dir) {
				this.viewMode = Math.max(this.minViewMode, Math.min(2, this.viewMode + dir));
			}
			this.picker.find('>div').hide().filter('.datepicker-' + DPGlobal.modes[this.viewMode].clsName).show();
		}
	};

	$.fn.datepicker = function (option, val) {
		return this.each(function () {
			var $this = $(this),
			    data = $this.data('datepicker'),
			    options = (typeof option === 'undefined' ? 'undefined' : _typeof(option)) === 'object' && option;
			if (!data) {
				$this.data('datepicker', data = new Datepicker(this, $.extend({}, $.fn.datepicker.defaults, options)));
			}
			if (typeof option === 'string') data[option](val);
		});
	};

	$.fn.datepicker.defaults = {
		onRender: function onRender(date) {
			return '';
		}
	};
	$.fn.datepicker.Constructor = Datepicker;

	var DPGlobal = {
		modes: [{
			clsName: 'days',
			navFnc: 'Month',
			navStep: 1
		}, {
			clsName: 'months',
			navFnc: 'FullYear',
			navStep: 1
		}, {
			clsName: 'years',
			navFnc: 'FullYear',
			navStep: 10
		}],
		dates: {
			days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
			daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
			daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"],
			months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
			monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
		},
		isLeapYear: function isLeapYear(year) {
			return year % 4 === 0 && year % 100 !== 0 || year % 400 === 0;
		},
		getDaysInMonth: function getDaysInMonth(year, month) {
			return [31, DPGlobal.isLeapYear(year) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
		},
		parseFormat: function parseFormat(format) {
			var separator = format.match(/[.\/\-\s].*?/),
			    parts = format.split(/\W+/);
			if (!separator || !parts || parts.length === 0) {
				throw new Error("Invalid date format.");
			}
			return { separator: separator, parts: parts };
		},
		parseDate: function parseDate(date, format) {
			var parts = date.split(format.separator),
			    date = new Date(),
			    val;
			date.setHours(0);
			date.setMinutes(0);
			date.setSeconds(0);
			date.setMilliseconds(0);
			if (parts.length === format.parts.length) {
				var year = date.getFullYear(),
				    day = date.getDate(),
				    month = date.getMonth();
				for (var i = 0, cnt = format.parts.length; i < cnt; i++) {
					val = parseInt(parts[i], 10) || 1;
					switch (format.parts[i]) {
						case 'dd':
						case 'd':
							day = val;
							date.setDate(val);
							break;
						case 'mm':
						case 'm':
							month = val - 1;
							date.setMonth(val - 1);
							break;
						case 'yy':
							year = 2000 + val;
							date.setFullYear(2000 + val);
							break;
						case 'yyyy':
							year = val;
							date.setFullYear(val);
							break;
					}
				}
				date = new Date(year, month, day, 0, 0, 0);
			}
			return date;
		},
		formatDate: function formatDate(date, format) {
			var val = {
				d: date.getDate(),
				m: date.getMonth() + 1,
				yy: date.getFullYear().toString().substring(2),
				yyyy: date.getFullYear()
			};
			val.dd = (val.d < 10 ? '0' : '') + val.d;
			val.mm = (val.m < 10 ? '0' : '') + val.m;
			var date = [];
			for (var i = 0, cnt = format.parts.length; i < cnt; i++) {
				date.push(val[format.parts[i]]);
			}
			return date.join(format.separator);
		},
		headTemplate: '<thead>' + '<tr>' + '<th class="prev">&lsaquo;</th>' + '<th colspan="5" class="switch"></th>' + '<th class="next">&rsaquo;</th>' + '</tr>' + '</thead>',
		contTemplate: '<tbody><tr><td colspan="7"></td></tr></tbody>'
	};
	DPGlobal.template = '<div class="datepicker dropdown-menu">' + '<div class="datepicker-days">' + '<table class=" table-condensed">' + DPGlobal.headTemplate + '<tbody></tbody>' + '</table>' + '</div>' + '<div class="datepicker-months">' + '<table class="table-condensed">' + DPGlobal.headTemplate + DPGlobal.contTemplate + '</table>' + '</div>' + '<div class="datepicker-years">' + '<table class="table-condensed">' + DPGlobal.headTemplate + DPGlobal.contTemplate + '</table>' + '</div>' + '</div>';
}(window.jQuery);

/***/ }),

/***/ "./resources/assets/js/v2/bootstrap.min.js":
/***/ (function(module, exports) {

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

/*!
 * Bootstrap v3.3.7 (http://getbootstrap.com)
 * Copyright 2011-2016 Twitter, Inc.
 * Licensed under the MIT license
 */
if ("undefined" == typeof jQuery) throw new Error("Bootstrap's JavaScript requires jQuery");+function (a) {
  "use strict";
  var b = a.fn.jquery.split(" ")[0].split(".");if (b[0] < 2 && b[1] < 9 || 1 == b[0] && 9 == b[1] && b[2] < 1 || b[0] > 3) throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher, but lower than version 4");
}(jQuery), +function (a) {
  "use strict";
  function b() {
    var a = document.createElement("bootstrap"),
        b = { WebkitTransition: "webkitTransitionEnd", MozTransition: "transitionend", OTransition: "oTransitionEnd otransitionend", transition: "transitionend" };for (var c in b) {
      if (void 0 !== a.style[c]) return { end: b[c] };
    }return !1;
  }a.fn.emulateTransitionEnd = function (b) {
    var c = !1,
        d = this;a(this).one("bsTransitionEnd", function () {
      c = !0;
    });var e = function e() {
      c || a(d).trigger(a.support.transition.end);
    };return setTimeout(e, b), this;
  }, a(function () {
    a.support.transition = b(), a.support.transition && (a.event.special.bsTransitionEnd = { bindType: a.support.transition.end, delegateType: a.support.transition.end, handle: function handle(b) {
        if (a(b.target).is(this)) return b.handleObj.handler.apply(this, arguments);
      } });
  });
}(jQuery), +function (a) {
  "use strict";
  function b(b) {
    return this.each(function () {
      var c = a(this),
          e = c.data("bs.alert");e || c.data("bs.alert", e = new d(this)), "string" == typeof b && e[b].call(c);
    });
  }var c = '[data-dismiss="alert"]',
      d = function d(b) {
    a(b).on("click", c, this.close);
  };d.VERSION = "3.3.7", d.TRANSITION_DURATION = 150, d.prototype.close = function (b) {
    function c() {
      g.detach().trigger("closed.bs.alert").remove();
    }var e = a(this),
        f = e.attr("data-target");f || (f = e.attr("href"), f = f && f.replace(/.*(?=#[^\s]*$)/, ""));var g = a("#" === f ? [] : f);b && b.preventDefault(), g.length || (g = e.closest(".alert")), g.trigger(b = a.Event("close.bs.alert")), b.isDefaultPrevented() || (g.removeClass("in"), a.support.transition && g.hasClass("fade") ? g.one("bsTransitionEnd", c).emulateTransitionEnd(d.TRANSITION_DURATION) : c());
  };var e = a.fn.alert;a.fn.alert = b, a.fn.alert.Constructor = d, a.fn.alert.noConflict = function () {
    return a.fn.alert = e, this;
  }, a(document).on("click.bs.alert.data-api", c, d.prototype.close);
}(jQuery), +function (a) {
  "use strict";
  function b(b) {
    return this.each(function () {
      var d = a(this),
          e = d.data("bs.button"),
          f = "object" == (typeof b === "undefined" ? "undefined" : _typeof(b)) && b;e || d.data("bs.button", e = new c(this, f)), "toggle" == b ? e.toggle() : b && e.setState(b);
    });
  }var c = function c(b, d) {
    this.$element = a(b), this.options = a.extend({}, c.DEFAULTS, d), this.isLoading = !1;
  };c.VERSION = "3.3.7", c.DEFAULTS = { loadingText: "loading..." }, c.prototype.setState = function (b) {
    var c = "disabled",
        d = this.$element,
        e = d.is("input") ? "val" : "html",
        f = d.data();b += "Text", null == f.resetText && d.data("resetText", d[e]()), setTimeout(a.proxy(function () {
      d[e](null == f[b] ? this.options[b] : f[b]), "loadingText" == b ? (this.isLoading = !0, d.addClass(c).attr(c, c).prop(c, !0)) : this.isLoading && (this.isLoading = !1, d.removeClass(c).removeAttr(c).prop(c, !1));
    }, this), 0);
  }, c.prototype.toggle = function () {
    var a = !0,
        b = this.$element.closest('[data-toggle="buttons"]');if (b.length) {
      var c = this.$element.find("input");"radio" == c.prop("type") ? (c.prop("checked") && (a = !1), b.find(".active").removeClass("active"), this.$element.addClass("active")) : "checkbox" == c.prop("type") && (c.prop("checked") !== this.$element.hasClass("active") && (a = !1), this.$element.toggleClass("active")), c.prop("checked", this.$element.hasClass("active")), a && c.trigger("change");
    } else this.$element.attr("aria-pressed", !this.$element.hasClass("active")), this.$element.toggleClass("active");
  };var d = a.fn.button;a.fn.button = b, a.fn.button.Constructor = c, a.fn.button.noConflict = function () {
    return a.fn.button = d, this;
  }, a(document).on("click.bs.button.data-api", '[data-toggle^="button"]', function (c) {
    var d = a(c.target).closest(".btn");b.call(d, "toggle"), a(c.target).is('input[type="radio"], input[type="checkbox"]') || (c.preventDefault(), d.is("input,button") ? d.trigger("focus") : d.find("input:visible,button:visible").first().trigger("focus"));
  }).on("focus.bs.button.data-api blur.bs.button.data-api", '[data-toggle^="button"]', function (b) {
    a(b.target).closest(".btn").toggleClass("focus", /^focus(in)?$/.test(b.type));
  });
}(jQuery), +function (a) {
  "use strict";
  function b(b) {
    return this.each(function () {
      var d = a(this),
          e = d.data("bs.carousel"),
          f = a.extend({}, c.DEFAULTS, d.data(), "object" == (typeof b === "undefined" ? "undefined" : _typeof(b)) && b),
          g = "string" == typeof b ? b : f.slide;e || d.data("bs.carousel", e = new c(this, f)), "number" == typeof b ? e.to(b) : g ? e[g]() : f.interval && e.pause().cycle();
    });
  }var c = function c(b, _c) {
    this.$element = a(b), this.$indicators = this.$element.find(".carousel-indicators"), this.options = _c, this.paused = null, this.sliding = null, this.interval = null, this.$active = null, this.$items = null, this.options.keyboard && this.$element.on("keydown.bs.carousel", a.proxy(this.keydown, this)), "hover" == this.options.pause && !("ontouchstart" in document.documentElement) && this.$element.on("mouseenter.bs.carousel", a.proxy(this.pause, this)).on("mouseleave.bs.carousel", a.proxy(this.cycle, this));
  };c.VERSION = "3.3.7", c.TRANSITION_DURATION = 600, c.DEFAULTS = { interval: 5e3, pause: "hover", wrap: !0, keyboard: !0 }, c.prototype.keydown = function (a) {
    if (!/input|textarea/i.test(a.target.tagName)) {
      switch (a.which) {case 37:
          this.prev();break;case 39:
          this.next();break;default:
          return;}a.preventDefault();
    }
  }, c.prototype.cycle = function (b) {
    return b || (this.paused = !1), this.interval && clearInterval(this.interval), this.options.interval && !this.paused && (this.interval = setInterval(a.proxy(this.next, this), this.options.interval)), this;
  }, c.prototype.getItemIndex = function (a) {
    return this.$items = a.parent().children(".item"), this.$items.index(a || this.$active);
  }, c.prototype.getItemForDirection = function (a, b) {
    var c = this.getItemIndex(b),
        d = "prev" == a && 0 === c || "next" == a && c == this.$items.length - 1;if (d && !this.options.wrap) return b;var e = "prev" == a ? -1 : 1,
        f = (c + e) % this.$items.length;return this.$items.eq(f);
  }, c.prototype.to = function (a) {
    var b = this,
        c = this.getItemIndex(this.$active = this.$element.find(".item.active"));if (!(a > this.$items.length - 1 || a < 0)) return this.sliding ? this.$element.one("slid.bs.carousel", function () {
      b.to(a);
    }) : c == a ? this.pause().cycle() : this.slide(a > c ? "next" : "prev", this.$items.eq(a));
  }, c.prototype.pause = function (b) {
    return b || (this.paused = !0), this.$element.find(".next, .prev").length && a.support.transition && (this.$element.trigger(a.support.transition.end), this.cycle(!0)), this.interval = clearInterval(this.interval), this;
  }, c.prototype.next = function () {
    if (!this.sliding) return this.slide("next");
  }, c.prototype.prev = function () {
    if (!this.sliding) return this.slide("prev");
  }, c.prototype.slide = function (b, d) {
    var e = this.$element.find(".item.active"),
        f = d || this.getItemForDirection(b, e),
        g = this.interval,
        h = "next" == b ? "left" : "right",
        i = this;if (f.hasClass("active")) return this.sliding = !1;var j = f[0],
        k = a.Event("slide.bs.carousel", { relatedTarget: j, direction: h });if (this.$element.trigger(k), !k.isDefaultPrevented()) {
      if (this.sliding = !0, g && this.pause(), this.$indicators.length) {
        this.$indicators.find(".active").removeClass("active");var l = a(this.$indicators.children()[this.getItemIndex(f)]);l && l.addClass("active");
      }var m = a.Event("slid.bs.carousel", { relatedTarget: j, direction: h });return a.support.transition && this.$element.hasClass("slide") ? (f.addClass(b), f[0].offsetWidth, e.addClass(h), f.addClass(h), e.one("bsTransitionEnd", function () {
        f.removeClass([b, h].join(" ")).addClass("active"), e.removeClass(["active", h].join(" ")), i.sliding = !1, setTimeout(function () {
          i.$element.trigger(m);
        }, 0);
      }).emulateTransitionEnd(c.TRANSITION_DURATION)) : (e.removeClass("active"), f.addClass("active"), this.sliding = !1, this.$element.trigger(m)), g && this.cycle(), this;
    }
  };var d = a.fn.carousel;a.fn.carousel = b, a.fn.carousel.Constructor = c, a.fn.carousel.noConflict = function () {
    return a.fn.carousel = d, this;
  };var e = function e(c) {
    var d,
        e = a(this),
        f = a(e.attr("data-target") || (d = e.attr("href")) && d.replace(/.*(?=#[^\s]+$)/, ""));if (f.hasClass("carousel")) {
      var g = a.extend({}, f.data(), e.data()),
          h = e.attr("data-slide-to");h && (g.interval = !1), b.call(f, g), h && f.data("bs.carousel").to(h), c.preventDefault();
    }
  };a(document).on("click.bs.carousel.data-api", "[data-slide]", e).on("click.bs.carousel.data-api", "[data-slide-to]", e), a(window).on("load", function () {
    a('[data-ride="carousel"]').each(function () {
      var c = a(this);b.call(c, c.data());
    });
  });
}(jQuery), +function (a) {
  "use strict";
  function b(b) {
    var c,
        d = b.attr("data-target") || (c = b.attr("href")) && c.replace(/.*(?=#[^\s]+$)/, "");return a(d);
  }function c(b) {
    return this.each(function () {
      var c = a(this),
          e = c.data("bs.collapse"),
          f = a.extend({}, d.DEFAULTS, c.data(), "object" == (typeof b === "undefined" ? "undefined" : _typeof(b)) && b);!e && f.toggle && /show|hide/.test(b) && (f.toggle = !1), e || c.data("bs.collapse", e = new d(this, f)), "string" == typeof b && e[b]();
    });
  }var d = function d(b, c) {
    this.$element = a(b), this.options = a.extend({}, d.DEFAULTS, c), this.$trigger = a('[data-toggle="collapse"][href="#' + b.id + '"],[data-toggle="collapse"][data-target="#' + b.id + '"]'), this.transitioning = null, this.options.parent ? this.$parent = this.getParent() : this.addAriaAndCollapsedClass(this.$element, this.$trigger), this.options.toggle && this.toggle();
  };d.VERSION = "3.3.7", d.TRANSITION_DURATION = 350, d.DEFAULTS = { toggle: !0 }, d.prototype.dimension = function () {
    var a = this.$element.hasClass("width");return a ? "width" : "height";
  }, d.prototype.show = function () {
    if (!this.transitioning && !this.$element.hasClass("in")) {
      var b,
          e = this.$parent && this.$parent.children(".panel").children(".in, .collapsing");if (!(e && e.length && (b = e.data("bs.collapse"), b && b.transitioning))) {
        var f = a.Event("show.bs.collapse");if (this.$element.trigger(f), !f.isDefaultPrevented()) {
          e && e.length && (c.call(e, "hide"), b || e.data("bs.collapse", null));var g = this.dimension();this.$element.removeClass("collapse").addClass("collapsing")[g](0).attr("aria-expanded", !0), this.$trigger.removeClass("collapsed").attr("aria-expanded", !0), this.transitioning = 1;var h = function h() {
            this.$element.removeClass("collapsing").addClass("collapse in")[g](""), this.transitioning = 0, this.$element.trigger("shown.bs.collapse");
          };if (!a.support.transition) return h.call(this);var i = a.camelCase(["scroll", g].join("-"));this.$element.one("bsTransitionEnd", a.proxy(h, this)).emulateTransitionEnd(d.TRANSITION_DURATION)[g](this.$element[0][i]);
        }
      }
    }
  }, d.prototype.hide = function () {
    if (!this.transitioning && this.$element.hasClass("in")) {
      var b = a.Event("hide.bs.collapse");if (this.$element.trigger(b), !b.isDefaultPrevented()) {
        var c = this.dimension();this.$element[c](this.$element[c]())[0].offsetHeight, this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded", !1), this.$trigger.addClass("collapsed").attr("aria-expanded", !1), this.transitioning = 1;var e = function e() {
          this.transitioning = 0, this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse");
        };return a.support.transition ? void this.$element[c](0).one("bsTransitionEnd", a.proxy(e, this)).emulateTransitionEnd(d.TRANSITION_DURATION) : e.call(this);
      }
    }
  }, d.prototype.toggle = function () {
    this[this.$element.hasClass("in") ? "hide" : "show"]();
  }, d.prototype.getParent = function () {
    return a(this.options.parent).find('[data-toggle="collapse"][data-parent="' + this.options.parent + '"]').each(a.proxy(function (c, d) {
      var e = a(d);this.addAriaAndCollapsedClass(b(e), e);
    }, this)).end();
  }, d.prototype.addAriaAndCollapsedClass = function (a, b) {
    var c = a.hasClass("in");a.attr("aria-expanded", c), b.toggleClass("collapsed", !c).attr("aria-expanded", c);
  };var e = a.fn.collapse;a.fn.collapse = c, a.fn.collapse.Constructor = d, a.fn.collapse.noConflict = function () {
    return a.fn.collapse = e, this;
  }, a(document).on("click.bs.collapse.data-api", '[data-toggle="collapse"]', function (d) {
    var e = a(this);e.attr("data-target") || d.preventDefault();var f = b(e),
        g = f.data("bs.collapse"),
        h = g ? "toggle" : e.data();c.call(f, h);
  });
}(jQuery), +function (a) {
  "use strict";
  function b(b) {
    var c = b.attr("data-target");c || (c = b.attr("href"), c = c && /#[A-Za-z]/.test(c) && c.replace(/.*(?=#[^\s]*$)/, ""));var d = c && a(c);return d && d.length ? d : b.parent();
  }function c(c) {
    c && 3 === c.which || (a(e).remove(), a(f).each(function () {
      var d = a(this),
          e = b(d),
          f = { relatedTarget: this };e.hasClass("open") && (c && "click" == c.type && /input|textarea/i.test(c.target.tagName) && a.contains(e[0], c.target) || (e.trigger(c = a.Event("hide.bs.dropdown", f)), c.isDefaultPrevented() || (d.attr("aria-expanded", "false"), e.removeClass("open").trigger(a.Event("hidden.bs.dropdown", f)))));
    }));
  }function d(b) {
    return this.each(function () {
      var c = a(this),
          d = c.data("bs.dropdown");d || c.data("bs.dropdown", d = new g(this)), "string" == typeof b && d[b].call(c);
    });
  }var e = ".dropdown-backdrop",
      f = '[data-toggle="dropdown"]',
      g = function g(b) {
    a(b).on("click.bs.dropdown", this.toggle);
  };g.VERSION = "3.3.7", g.prototype.toggle = function (d) {
    var e = a(this);if (!e.is(".disabled, :disabled")) {
      var f = b(e),
          g = f.hasClass("open");if (c(), !g) {
        "ontouchstart" in document.documentElement && !f.closest(".navbar-nav").length && a(document.createElement("div")).addClass("dropdown-backdrop").insertAfter(a(this)).on("click", c);var h = { relatedTarget: this };if (f.trigger(d = a.Event("show.bs.dropdown", h)), d.isDefaultPrevented()) return;e.trigger("focus").attr("aria-expanded", "true"), f.toggleClass("open").trigger(a.Event("shown.bs.dropdown", h));
      }return !1;
    }
  }, g.prototype.keydown = function (c) {
    if (/(38|40|27|32)/.test(c.which) && !/input|textarea/i.test(c.target.tagName)) {
      var d = a(this);if (c.preventDefault(), c.stopPropagation(), !d.is(".disabled, :disabled")) {
        var e = b(d),
            g = e.hasClass("open");if (!g && 27 != c.which || g && 27 == c.which) return 27 == c.which && e.find(f).trigger("focus"), d.trigger("click");var h = " li:not(.disabled):visible a",
            i = e.find(".dropdown-menu" + h);if (i.length) {
          var j = i.index(c.target);38 == c.which && j > 0 && j--, 40 == c.which && j < i.length - 1 && j++, ~j || (j = 0), i.eq(j).trigger("focus");
        }
      }
    }
  };var h = a.fn.dropdown;a.fn.dropdown = d, a.fn.dropdown.Constructor = g, a.fn.dropdown.noConflict = function () {
    return a.fn.dropdown = h, this;
  }, a(document).on("click.bs.dropdown.data-api", c).on("click.bs.dropdown.data-api", ".dropdown form", function (a) {
    a.stopPropagation();
  }).on("click.bs.dropdown.data-api", f, g.prototype.toggle).on("keydown.bs.dropdown.data-api", f, g.prototype.keydown).on("keydown.bs.dropdown.data-api", ".dropdown-menu", g.prototype.keydown);
}(jQuery), +function (a) {
  "use strict";
  function b(b, d) {
    return this.each(function () {
      var e = a(this),
          f = e.data("bs.modal"),
          g = a.extend({}, c.DEFAULTS, e.data(), "object" == (typeof b === "undefined" ? "undefined" : _typeof(b)) && b);f || e.data("bs.modal", f = new c(this, g)), "string" == typeof b ? f[b](d) : g.show && f.show(d);
    });
  }var c = function c(b, _c2) {
    this.options = _c2, this.$body = a(document.body), this.$element = a(b), this.$dialog = this.$element.find(".modal-dialog"), this.$backdrop = null, this.isShown = null, this.originalBodyPad = null, this.scrollbarWidth = 0, this.ignoreBackdropClick = !1, this.options.remote && this.$element.find(".modal-content").load(this.options.remote, a.proxy(function () {
      this.$element.trigger("loaded.bs.modal");
    }, this));
  };c.VERSION = "3.3.7", c.TRANSITION_DURATION = 300, c.BACKDROP_TRANSITION_DURATION = 150, c.DEFAULTS = { backdrop: !0, keyboard: !0, show: !0 }, c.prototype.toggle = function (a) {
    return this.isShown ? this.hide() : this.show(a);
  }, c.prototype.show = function (b) {
    var d = this,
        e = a.Event("show.bs.modal", { relatedTarget: b });this.$element.trigger(e), this.isShown || e.isDefaultPrevented() || (this.isShown = !0, this.checkScrollbar(), this.setScrollbar(), this.$body.addClass("modal-open"), this.escape(), this.resize(), this.$element.on("click.dismiss.bs.modal", '[data-dismiss="modal"]', a.proxy(this.hide, this)), this.$dialog.on("mousedown.dismiss.bs.modal", function () {
      d.$element.one("mouseup.dismiss.bs.modal", function (b) {
        a(b.target).is(d.$element) && (d.ignoreBackdropClick = !0);
      });
    }), this.backdrop(function () {
      var e = a.support.transition && d.$element.hasClass("fade");d.$element.parent().length || d.$element.appendTo(d.$body), d.$element.show().scrollTop(0), d.adjustDialog(), e && d.$element[0].offsetWidth, d.$element.addClass("in"), d.enforceFocus();var f = a.Event("shown.bs.modal", { relatedTarget: b });e ? d.$dialog.one("bsTransitionEnd", function () {
        d.$element.trigger("focus").trigger(f);
      }).emulateTransitionEnd(c.TRANSITION_DURATION) : d.$element.trigger("focus").trigger(f);
    }));
  }, c.prototype.hide = function (b) {
    b && b.preventDefault(), b = a.Event("hide.bs.modal"), this.$element.trigger(b), this.isShown && !b.isDefaultPrevented() && (this.isShown = !1, this.escape(), this.resize(), a(document).off("focusin.bs.modal"), this.$element.removeClass("in").off("click.dismiss.bs.modal").off("mouseup.dismiss.bs.modal"), this.$dialog.off("mousedown.dismiss.bs.modal"), a.support.transition && this.$element.hasClass("fade") ? this.$element.one("bsTransitionEnd", a.proxy(this.hideModal, this)).emulateTransitionEnd(c.TRANSITION_DURATION) : this.hideModal());
  }, c.prototype.enforceFocus = function () {
    a(document).off("focusin.bs.modal").on("focusin.bs.modal", a.proxy(function (a) {
      document === a.target || this.$element[0] === a.target || this.$element.has(a.target).length || this.$element.trigger("focus");
    }, this));
  }, c.prototype.escape = function () {
    this.isShown && this.options.keyboard ? this.$element.on("keydown.dismiss.bs.modal", a.proxy(function (a) {
      27 == a.which && this.hide();
    }, this)) : this.isShown || this.$element.off("keydown.dismiss.bs.modal");
  }, c.prototype.resize = function () {
    this.isShown ? a(window).on("resize.bs.modal", a.proxy(this.handleUpdate, this)) : a(window).off("resize.bs.modal");
  }, c.prototype.hideModal = function () {
    var a = this;this.$element.hide(), this.backdrop(function () {
      a.$body.removeClass("modal-open"), a.resetAdjustments(), a.resetScrollbar(), a.$element.trigger("hidden.bs.modal");
    });
  }, c.prototype.removeBackdrop = function () {
    this.$backdrop && this.$backdrop.remove(), this.$backdrop = null;
  }, c.prototype.backdrop = function (b) {
    var d = this,
        e = this.$element.hasClass("fade") ? "fade" : "";if (this.isShown && this.options.backdrop) {
      var f = a.support.transition && e;if (this.$backdrop = a(document.createElement("div")).addClass("modal-backdrop " + e).appendTo(this.$body), this.$element.on("click.dismiss.bs.modal", a.proxy(function (a) {
        return this.ignoreBackdropClick ? void (this.ignoreBackdropClick = !1) : void (a.target === a.currentTarget && ("static" == this.options.backdrop ? this.$element[0].focus() : this.hide()));
      }, this)), f && this.$backdrop[0].offsetWidth, this.$backdrop.addClass("in"), !b) return;f ? this.$backdrop.one("bsTransitionEnd", b).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION) : b();
    } else if (!this.isShown && this.$backdrop) {
      this.$backdrop.removeClass("in");var g = function g() {
        d.removeBackdrop(), b && b();
      };a.support.transition && this.$element.hasClass("fade") ? this.$backdrop.one("bsTransitionEnd", g).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION) : g();
    } else b && b();
  }, c.prototype.handleUpdate = function () {
    this.adjustDialog();
  }, c.prototype.adjustDialog = function () {
    var a = this.$element[0].scrollHeight > document.documentElement.clientHeight;this.$element.css({ paddingLeft: !this.bodyIsOverflowing && a ? this.scrollbarWidth : "", paddingRight: this.bodyIsOverflowing && !a ? this.scrollbarWidth : "" });
  }, c.prototype.resetAdjustments = function () {
    this.$element.css({ paddingLeft: "", paddingRight: "" });
  }, c.prototype.checkScrollbar = function () {
    var a = window.innerWidth;if (!a) {
      var b = document.documentElement.getBoundingClientRect();a = b.right - Math.abs(b.left);
    }this.bodyIsOverflowing = document.body.clientWidth < a, this.scrollbarWidth = this.measureScrollbar();
  }, c.prototype.setScrollbar = function () {
    var a = parseInt(this.$body.css("padding-right") || 0, 10);this.originalBodyPad = document.body.style.paddingRight || "", this.bodyIsOverflowing && this.$body.css("padding-right", a + this.scrollbarWidth);
  }, c.prototype.resetScrollbar = function () {
    this.$body.css("padding-right", this.originalBodyPad);
  }, c.prototype.measureScrollbar = function () {
    var a = document.createElement("div");a.className = "modal-scrollbar-measure", this.$body.append(a);var b = a.offsetWidth - a.clientWidth;return this.$body[0].removeChild(a), b;
  };var d = a.fn.modal;a.fn.modal = b, a.fn.modal.Constructor = c, a.fn.modal.noConflict = function () {
    return a.fn.modal = d, this;
  }, a(document).on("click.bs.modal.data-api", '[data-toggle="modal"]', function (c) {
    var d = a(this),
        e = d.attr("href"),
        f = a(d.attr("data-target") || e && e.replace(/.*(?=#[^\s]+$)/, "")),
        g = f.data("bs.modal") ? "toggle" : a.extend({ remote: !/#/.test(e) && e }, f.data(), d.data());d.is("a") && c.preventDefault(), f.one("show.bs.modal", function (a) {
      a.isDefaultPrevented() || f.one("hidden.bs.modal", function () {
        d.is(":visible") && d.trigger("focus");
      });
    }), b.call(f, g, this);
  });
}(jQuery), +function (a) {
  "use strict";
  function b(b) {
    return this.each(function () {
      var d = a(this),
          e = d.data("bs.tooltip"),
          f = "object" == (typeof b === "undefined" ? "undefined" : _typeof(b)) && b;!e && /destroy|hide/.test(b) || (e || d.data("bs.tooltip", e = new c(this, f)), "string" == typeof b && e[b]());
    });
  }var c = function c(a, b) {
    this.type = null, this.options = null, this.enabled = null, this.timeout = null, this.hoverState = null, this.$element = null, this.inState = null, this.init("tooltip", a, b);
  };c.VERSION = "3.3.7", c.TRANSITION_DURATION = 150, c.DEFAULTS = { animation: !0, placement: "top", selector: !1, template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>', trigger: "hover focus", title: "", delay: 0, html: !1, container: !1, viewport: { selector: "body", padding: 0 } }, c.prototype.init = function (b, c, d) {
    if (this.enabled = !0, this.type = b, this.$element = a(c), this.options = this.getOptions(d), this.$viewport = this.options.viewport && a(a.isFunction(this.options.viewport) ? this.options.viewport.call(this, this.$element) : this.options.viewport.selector || this.options.viewport), this.inState = { click: !1, hover: !1, focus: !1 }, this.$element[0] instanceof document.constructor && !this.options.selector) throw new Error("`selector` option must be specified when initializing " + this.type + " on the window.document object!");for (var e = this.options.trigger.split(" "), f = e.length; f--;) {
      var g = e[f];if ("click" == g) this.$element.on("click." + this.type, this.options.selector, a.proxy(this.toggle, this));else if ("manual" != g) {
        var h = "hover" == g ? "mouseenter" : "focusin",
            i = "hover" == g ? "mouseleave" : "focusout";this.$element.on(h + "." + this.type, this.options.selector, a.proxy(this.enter, this)), this.$element.on(i + "." + this.type, this.options.selector, a.proxy(this.leave, this));
      }
    }this.options.selector ? this._options = a.extend({}, this.options, { trigger: "manual", selector: "" }) : this.fixTitle();
  }, c.prototype.getDefaults = function () {
    return c.DEFAULTS;
  }, c.prototype.getOptions = function (b) {
    return b = a.extend({}, this.getDefaults(), this.$element.data(), b), b.delay && "number" == typeof b.delay && (b.delay = { show: b.delay, hide: b.delay }), b;
  }, c.prototype.getDelegateOptions = function () {
    var b = {},
        c = this.getDefaults();return this._options && a.each(this._options, function (a, d) {
      c[a] != d && (b[a] = d);
    }), b;
  }, c.prototype.enter = function (b) {
    var c = b instanceof this.constructor ? b : a(b.currentTarget).data("bs." + this.type);return c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()), a(b.currentTarget).data("bs." + this.type, c)), b instanceof a.Event && (c.inState["focusin" == b.type ? "focus" : "hover"] = !0), c.tip().hasClass("in") || "in" == c.hoverState ? void (c.hoverState = "in") : (clearTimeout(c.timeout), c.hoverState = "in", c.options.delay && c.options.delay.show ? void (c.timeout = setTimeout(function () {
      "in" == c.hoverState && c.show();
    }, c.options.delay.show)) : c.show());
  }, c.prototype.isInStateTrue = function () {
    for (var a in this.inState) {
      if (this.inState[a]) return !0;
    }return !1;
  }, c.prototype.leave = function (b) {
    var c = b instanceof this.constructor ? b : a(b.currentTarget).data("bs." + this.type);if (c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()), a(b.currentTarget).data("bs." + this.type, c)), b instanceof a.Event && (c.inState["focusout" == b.type ? "focus" : "hover"] = !1), !c.isInStateTrue()) return clearTimeout(c.timeout), c.hoverState = "out", c.options.delay && c.options.delay.hide ? void (c.timeout = setTimeout(function () {
      "out" == c.hoverState && c.hide();
    }, c.options.delay.hide)) : c.hide();
  }, c.prototype.show = function () {
    var b = a.Event("show.bs." + this.type);if (this.hasContent() && this.enabled) {
      this.$element.trigger(b);var d = a.contains(this.$element[0].ownerDocument.documentElement, this.$element[0]);if (b.isDefaultPrevented() || !d) return;var e = this,
          f = this.tip(),
          g = this.getUID(this.type);this.setContent(), f.attr("id", g), this.$element.attr("aria-describedby", g), this.options.animation && f.addClass("fade");var h = "function" == typeof this.options.placement ? this.options.placement.call(this, f[0], this.$element[0]) : this.options.placement,
          i = /\s?auto?\s?/i,
          j = i.test(h);j && (h = h.replace(i, "") || "top"), f.detach().css({ top: 0, left: 0, display: "block" }).addClass(h).data("bs." + this.type, this), this.options.container ? f.appendTo(this.options.container) : f.insertAfter(this.$element), this.$element.trigger("inserted.bs." + this.type);var k = this.getPosition(),
          l = f[0].offsetWidth,
          m = f[0].offsetHeight;if (j) {
        var n = h,
            o = this.getPosition(this.$viewport);h = "bottom" == h && k.bottom + m > o.bottom ? "top" : "top" == h && k.top - m < o.top ? "bottom" : "right" == h && k.right + l > o.width ? "left" : "left" == h && k.left - l < o.left ? "right" : h, f.removeClass(n).addClass(h);
      }var p = this.getCalculatedOffset(h, k, l, m);this.applyPlacement(p, h);var q = function q() {
        var a = e.hoverState;e.$element.trigger("shown.bs." + e.type), e.hoverState = null, "out" == a && e.leave(e);
      };a.support.transition && this.$tip.hasClass("fade") ? f.one("bsTransitionEnd", q).emulateTransitionEnd(c.TRANSITION_DURATION) : q();
    }
  }, c.prototype.applyPlacement = function (b, c) {
    var d = this.tip(),
        e = d[0].offsetWidth,
        f = d[0].offsetHeight,
        g = parseInt(d.css("margin-top"), 10),
        h = parseInt(d.css("margin-left"), 10);isNaN(g) && (g = 0), isNaN(h) && (h = 0), b.top += g, b.left += h, a.offset.setOffset(d[0], a.extend({ using: function using(a) {
        d.css({ top: Math.round(a.top), left: Math.round(a.left) });
      } }, b), 0), d.addClass("in");var i = d[0].offsetWidth,
        j = d[0].offsetHeight;"top" == c && j != f && (b.top = b.top + f - j);var k = this.getViewportAdjustedDelta(c, b, i, j);k.left ? b.left += k.left : b.top += k.top;var l = /top|bottom/.test(c),
        m = l ? 2 * k.left - e + i : 2 * k.top - f + j,
        n = l ? "offsetWidth" : "offsetHeight";d.offset(b), this.replaceArrow(m, d[0][n], l);
  }, c.prototype.replaceArrow = function (a, b, c) {
    this.arrow().css(c ? "left" : "top", 50 * (1 - a / b) + "%").css(c ? "top" : "left", "");
  }, c.prototype.setContent = function () {
    var a = this.tip(),
        b = this.getTitle();a.find(".tooltip-inner")[this.options.html ? "html" : "text"](b), a.removeClass("fade in top bottom left right");
  }, c.prototype.hide = function (b) {
    function d() {
      "in" != e.hoverState && f.detach(), e.$element && e.$element.removeAttr("aria-describedby").trigger("hidden.bs." + e.type), b && b();
    }var e = this,
        f = a(this.$tip),
        g = a.Event("hide.bs." + this.type);if (this.$element.trigger(g), !g.isDefaultPrevented()) return f.removeClass("in"), a.support.transition && f.hasClass("fade") ? f.one("bsTransitionEnd", d).emulateTransitionEnd(c.TRANSITION_DURATION) : d(), this.hoverState = null, this;
  }, c.prototype.fixTitle = function () {
    var a = this.$element;(a.attr("title") || "string" != typeof a.attr("data-original-title")) && a.attr("data-original-title", a.attr("title") || "").attr("title", "");
  }, c.prototype.hasContent = function () {
    return this.getTitle();
  }, c.prototype.getPosition = function (b) {
    b = b || this.$element;var c = b[0],
        d = "BODY" == c.tagName,
        e = c.getBoundingClientRect();null == e.width && (e = a.extend({}, e, { width: e.right - e.left, height: e.bottom - e.top }));var f = window.SVGElement && c instanceof window.SVGElement,
        g = d ? { top: 0, left: 0 } : f ? null : b.offset(),
        h = { scroll: d ? document.documentElement.scrollTop || document.body.scrollTop : b.scrollTop() },
        i = d ? { width: a(window).width(), height: a(window).height() } : null;return a.extend({}, e, h, i, g);
  }, c.prototype.getCalculatedOffset = function (a, b, c, d) {
    return "bottom" == a ? { top: b.top + b.height, left: b.left + b.width / 2 - c / 2 } : "top" == a ? { top: b.top - d, left: b.left + b.width / 2 - c / 2 } : "left" == a ? { top: b.top + b.height / 2 - d / 2, left: b.left - c } : { top: b.top + b.height / 2 - d / 2, left: b.left + b.width };
  }, c.prototype.getViewportAdjustedDelta = function (a, b, c, d) {
    var e = { top: 0, left: 0 };if (!this.$viewport) return e;var f = this.options.viewport && this.options.viewport.padding || 0,
        g = this.getPosition(this.$viewport);if (/right|left/.test(a)) {
      var h = b.top - f - g.scroll,
          i = b.top + f - g.scroll + d;h < g.top ? e.top = g.top - h : i > g.top + g.height && (e.top = g.top + g.height - i);
    } else {
      var j = b.left - f,
          k = b.left + f + c;j < g.left ? e.left = g.left - j : k > g.right && (e.left = g.left + g.width - k);
    }return e;
  }, c.prototype.getTitle = function () {
    var a,
        b = this.$element,
        c = this.options;return a = b.attr("data-original-title") || ("function" == typeof c.title ? c.title.call(b[0]) : c.title);
  }, c.prototype.getUID = function (a) {
    do {
      a += ~~(1e6 * Math.random());
    } while (document.getElementById(a));return a;
  }, c.prototype.tip = function () {
    if (!this.$tip && (this.$tip = a(this.options.template), 1 != this.$tip.length)) throw new Error(this.type + " `template` option must consist of exactly 1 top-level element!");return this.$tip;
  }, c.prototype.arrow = function () {
    return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow");
  }, c.prototype.enable = function () {
    this.enabled = !0;
  }, c.prototype.disable = function () {
    this.enabled = !1;
  }, c.prototype.toggleEnabled = function () {
    this.enabled = !this.enabled;
  }, c.prototype.toggle = function (b) {
    var c = this;b && (c = a(b.currentTarget).data("bs." + this.type), c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()), a(b.currentTarget).data("bs." + this.type, c))), b ? (c.inState.click = !c.inState.click, c.isInStateTrue() ? c.enter(c) : c.leave(c)) : c.tip().hasClass("in") ? c.leave(c) : c.enter(c);
  }, c.prototype.destroy = function () {
    var a = this;clearTimeout(this.timeout), this.hide(function () {
      a.$element.off("." + a.type).removeData("bs." + a.type), a.$tip && a.$tip.detach(), a.$tip = null, a.$arrow = null, a.$viewport = null, a.$element = null;
    });
  };var d = a.fn.tooltip;a.fn.tooltip = b, a.fn.tooltip.Constructor = c, a.fn.tooltip.noConflict = function () {
    return a.fn.tooltip = d, this;
  };
}(jQuery), +function (a) {
  "use strict";
  function b(b) {
    return this.each(function () {
      var d = a(this),
          e = d.data("bs.popover"),
          f = "object" == (typeof b === "undefined" ? "undefined" : _typeof(b)) && b;!e && /destroy|hide/.test(b) || (e || d.data("bs.popover", e = new c(this, f)), "string" == typeof b && e[b]());
    });
  }var c = function c(a, b) {
    this.init("popover", a, b);
  };if (!a.fn.tooltip) throw new Error("Popover requires tooltip.js");c.VERSION = "3.3.7", c.DEFAULTS = a.extend({}, a.fn.tooltip.Constructor.DEFAULTS, { placement: "right", trigger: "click", content: "", template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>' }), c.prototype = a.extend({}, a.fn.tooltip.Constructor.prototype), c.prototype.constructor = c, c.prototype.getDefaults = function () {
    return c.DEFAULTS;
  }, c.prototype.setContent = function () {
    var a = this.tip(),
        b = this.getTitle(),
        c = this.getContent();a.find(".popover-title")[this.options.html ? "html" : "text"](b), a.find(".popover-content").children().detach().end()[this.options.html ? "string" == typeof c ? "html" : "append" : "text"](c), a.removeClass("fade top bottom left right in"), a.find(".popover-title").html() || a.find(".popover-title").hide();
  }, c.prototype.hasContent = function () {
    return this.getTitle() || this.getContent();
  }, c.prototype.getContent = function () {
    var a = this.$element,
        b = this.options;return a.attr("data-content") || ("function" == typeof b.content ? b.content.call(a[0]) : b.content);
  }, c.prototype.arrow = function () {
    return this.$arrow = this.$arrow || this.tip().find(".arrow");
  };var d = a.fn.popover;a.fn.popover = b, a.fn.popover.Constructor = c, a.fn.popover.noConflict = function () {
    return a.fn.popover = d, this;
  };
}(jQuery), +function (a) {
  "use strict";
  function b(c, d) {
    this.$body = a(document.body), this.$scrollElement = a(a(c).is(document.body) ? window : c), this.options = a.extend({}, b.DEFAULTS, d), this.selector = (this.options.target || "") + " .nav li > a", this.offsets = [], this.targets = [], this.activeTarget = null, this.scrollHeight = 0, this.$scrollElement.on("scroll.bs.scrollspy", a.proxy(this.process, this)), this.refresh(), this.process();
  }function c(c) {
    return this.each(function () {
      var d = a(this),
          e = d.data("bs.scrollspy"),
          f = "object" == (typeof c === "undefined" ? "undefined" : _typeof(c)) && c;e || d.data("bs.scrollspy", e = new b(this, f)), "string" == typeof c && e[c]();
    });
  }b.VERSION = "3.3.7", b.DEFAULTS = { offset: 10 }, b.prototype.getScrollHeight = function () {
    return this.$scrollElement[0].scrollHeight || Math.max(this.$body[0].scrollHeight, document.documentElement.scrollHeight);
  }, b.prototype.refresh = function () {
    var b = this,
        c = "offset",
        d = 0;this.offsets = [], this.targets = [], this.scrollHeight = this.getScrollHeight(), a.isWindow(this.$scrollElement[0]) || (c = "position", d = this.$scrollElement.scrollTop()), this.$body.find(this.selector).map(function () {
      var b = a(this),
          e = b.data("target") || b.attr("href"),
          f = /^#./.test(e) && a(e);return f && f.length && f.is(":visible") && [[f[c]().top + d, e]] || null;
    }).sort(function (a, b) {
      return a[0] - b[0];
    }).each(function () {
      b.offsets.push(this[0]), b.targets.push(this[1]);
    });
  }, b.prototype.process = function () {
    var a,
        b = this.$scrollElement.scrollTop() + this.options.offset,
        c = this.getScrollHeight(),
        d = this.options.offset + c - this.$scrollElement.height(),
        e = this.offsets,
        f = this.targets,
        g = this.activeTarget;if (this.scrollHeight != c && this.refresh(), b >= d) return g != (a = f[f.length - 1]) && this.activate(a);if (g && b < e[0]) return this.activeTarget = null, this.clear();for (a = e.length; a--;) {
      g != f[a] && b >= e[a] && (void 0 === e[a + 1] || b < e[a + 1]) && this.activate(f[a]);
    }
  }, b.prototype.activate = function (b) {
    this.activeTarget = b, this.clear();var c = this.selector + '[data-target="' + b + '"],' + this.selector + '[href="' + b + '"]',
        d = a(c).parents("li").addClass("active");d.parent(".dropdown-menu").length && (d = d.closest("li.dropdown").addClass("active")), d.trigger("activate.bs.scrollspy");
  }, b.prototype.clear = function () {
    a(this.selector).parentsUntil(this.options.target, ".active").removeClass("active");
  };var d = a.fn.scrollspy;a.fn.scrollspy = c, a.fn.scrollspy.Constructor = b, a.fn.scrollspy.noConflict = function () {
    return a.fn.scrollspy = d, this;
  }, a(window).on("load.bs.scrollspy.data-api", function () {
    a('[data-spy="scroll"]').each(function () {
      var b = a(this);c.call(b, b.data());
    });
  });
}(jQuery), +function (a) {
  "use strict";
  function b(b) {
    return this.each(function () {
      var d = a(this),
          e = d.data("bs.tab");e || d.data("bs.tab", e = new c(this)), "string" == typeof b && e[b]();
    });
  }var c = function c(b) {
    this.element = a(b);
  };c.VERSION = "3.3.7", c.TRANSITION_DURATION = 150, c.prototype.show = function () {
    var b = this.element,
        c = b.closest("ul:not(.dropdown-menu)"),
        d = b.data("target");if (d || (d = b.attr("href"), d = d && d.replace(/.*(?=#[^\s]*$)/, "")), !b.parent("li").hasClass("active")) {
      var e = c.find(".active:last a"),
          f = a.Event("hide.bs.tab", { relatedTarget: b[0] }),
          g = a.Event("show.bs.tab", { relatedTarget: e[0] });if (e.trigger(f), b.trigger(g), !g.isDefaultPrevented() && !f.isDefaultPrevented()) {
        var h = a(d);this.activate(b.closest("li"), c), this.activate(h, h.parent(), function () {
          e.trigger({ type: "hidden.bs.tab", relatedTarget: b[0] }), b.trigger({ type: "shown.bs.tab", relatedTarget: e[0] });
        });
      }
    }
  }, c.prototype.activate = function (b, d, e) {
    function f() {
      g.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !1), b.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded", !0), h ? (b[0].offsetWidth, b.addClass("in")) : b.removeClass("fade"), b.parent(".dropdown-menu").length && b.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !0), e && e();
    }var g = d.find("> .active"),
        h = e && a.support.transition && (g.length && g.hasClass("fade") || !!d.find("> .fade").length);g.length && h ? g.one("bsTransitionEnd", f).emulateTransitionEnd(c.TRANSITION_DURATION) : f(), g.removeClass("in");
  };var d = a.fn.tab;a.fn.tab = b, a.fn.tab.Constructor = c, a.fn.tab.noConflict = function () {
    return a.fn.tab = d, this;
  };var e = function e(c) {
    c.preventDefault(), b.call(a(this), "show");
  };a(document).on("click.bs.tab.data-api", '[data-toggle="tab"]', e).on("click.bs.tab.data-api", '[data-toggle="pill"]', e);
}(jQuery), +function (a) {
  "use strict";
  function b(b) {
    return this.each(function () {
      var d = a(this),
          e = d.data("bs.affix"),
          f = "object" == (typeof b === "undefined" ? "undefined" : _typeof(b)) && b;e || d.data("bs.affix", e = new c(this, f)), "string" == typeof b && e[b]();
    });
  }var c = function c(b, d) {
    this.options = a.extend({}, c.DEFAULTS, d), this.$target = a(this.options.target).on("scroll.bs.affix.data-api", a.proxy(this.checkPosition, this)).on("click.bs.affix.data-api", a.proxy(this.checkPositionWithEventLoop, this)), this.$element = a(b), this.affixed = null, this.unpin = null, this.pinnedOffset = null, this.checkPosition();
  };c.VERSION = "3.3.7", c.RESET = "affix affix-top affix-bottom", c.DEFAULTS = { offset: 0, target: window }, c.prototype.getState = function (a, b, c, d) {
    var e = this.$target.scrollTop(),
        f = this.$element.offset(),
        g = this.$target.height();if (null != c && "top" == this.affixed) return e < c && "top";if ("bottom" == this.affixed) return null != c ? !(e + this.unpin <= f.top) && "bottom" : !(e + g <= a - d) && "bottom";var h = null == this.affixed,
        i = h ? e : f.top,
        j = h ? g : b;return null != c && e <= c ? "top" : null != d && i + j >= a - d && "bottom";
  }, c.prototype.getPinnedOffset = function () {
    if (this.pinnedOffset) return this.pinnedOffset;this.$element.removeClass(c.RESET).addClass("affix");var a = this.$target.scrollTop(),
        b = this.$element.offset();return this.pinnedOffset = b.top - a;
  }, c.prototype.checkPositionWithEventLoop = function () {
    setTimeout(a.proxy(this.checkPosition, this), 1);
  }, c.prototype.checkPosition = function () {
    if (this.$element.is(":visible")) {
      var b = this.$element.height(),
          d = this.options.offset,
          e = d.top,
          f = d.bottom,
          g = Math.max(a(document).height(), a(document.body).height());"object" != (typeof d === "undefined" ? "undefined" : _typeof(d)) && (f = e = d), "function" == typeof e && (e = d.top(this.$element)), "function" == typeof f && (f = d.bottom(this.$element));var h = this.getState(g, b, e, f);if (this.affixed != h) {
        null != this.unpin && this.$element.css("top", "");var i = "affix" + (h ? "-" + h : ""),
            j = a.Event(i + ".bs.affix");if (this.$element.trigger(j), j.isDefaultPrevented()) return;this.affixed = h, this.unpin = "bottom" == h ? this.getPinnedOffset() : null, this.$element.removeClass(c.RESET).addClass(i).trigger(i.replace("affix", "affixed") + ".bs.affix");
      }"bottom" == h && this.$element.offset({ top: g - b - f });
    }
  };var d = a.fn.affix;a.fn.affix = b, a.fn.affix.Constructor = c, a.fn.affix.noConflict = function () {
    return a.fn.affix = d, this;
  }, a(window).on("load", function () {
    a('[data-spy="affix"]').each(function () {
      var c = a(this),
          d = c.data();d.offset = d.offset || {}, null != d.offsetBottom && (d.offset.bottom = d.offsetBottom), null != d.offsetTop && (d.offset.top = d.offsetTop), b.call(c, d);
    });
  });
}(jQuery);

/***/ }),

/***/ "./resources/assets/js/v2/custom.js":
/***/ (function(module, exports) {

var _$$owlCarousel;

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

$(document).ready(function () {

    // search result
    // $('.check-boxes').css('display', 'none');
    // $('.filter-box h4').append('<i class="fa fa-plus-circle"></i>');
    // $('.filter-box h4').addClass('check-active');
    // $('.filter-box h4').click(function() {
    //   $('.filter-box').children('.check-boxes').hide();
    //   $('.filter-box').find('i').removeClass('fa-minus-circle').addClass('fa-plus-circle');  
    //   $(this).parent('.filter-box').children('.check-boxes').show();
    //    $(this).find('i').toggleClass('fa-plus-circle fa-minus-circle');

    //$(this).parent('div').parent('.filter-box').find('.check-boxes').slideToggle();
    //$('.filter-box').siblings('.check-boxes').hide();

    $('.filter-box h4').click(function () {
        // demo start
        $(this).parent('div').parent('.filter-box').parent('.relative-div').addClass('parent-height').siblings().removeClass('parent-height');
        var divHeight = $(this).parents('.filter-box').find('.check-boxes').height() * 1 + $('.heading-h4').height() * 1;
        $('.parent-height').css('height', 'auto');
        // $('.parent-height').css('height', divHeight+'px');
        // demo end

        $('.filter-box').children('.check-boxes').stop().slideUp();
        $('.filter-box h4').removeClass('current-filter');
        $(this).addClass('current-filter').siblings().removeClass('current-filter');
        //$(this).toggleClass('current-filter');
        if (!$(this).parents('.filter-box').find('.check-boxes').is(':hidden')) {
            $(this).removeClass('current-filter');
        }

        $(this).parent('div').parent('.filter-box').children('.check-boxes').stop().slideToggle();
    });
});

// labs page tab
// tabbed content
// http://www.entheosweb.com/tutorials/css/tabs.asp
$(".tab_content").hide();
$(".tab_content:first").show();

/* if in tab mode */
$("ul.tabs li").click(function () {

    $(".tab_content").hide();
    var activeTab = $(this).attr("rel");
    $("#" + activeTab).fadeIn();

    $("ul.tabs li").removeClass("active");
    $(this).addClass("active");

    $(".tab_drawer_heading").removeClass("d_active");
    $(".tab_drawer_heading[rel^='" + activeTab + "']").addClass("d_active");

    /*$(".tabs").css("margin-top", function(){ 
       return ($(".tab_container").outerHeight() - $(".tabs").outerHeight() ) / 2;
    });*/
});
$(".tab_container").css("min-height", function () {
    return $(".tabs").outerHeight() + 50;
});
/* if in drawer mode */
$(".tab_drawer_heading").click(function () {

    $(".tab_content").hide();
    var d_activeTab = $(this).attr("rel");
    $("#" + d_activeTab).fadeIn();

    $(".tab_drawer_heading").removeClass("d_active");
    $(this).addClass("d_active");

    $("ul.tabs li").removeClass("active");
    $("ul.tabs li[rel^='" + d_activeTab + "']").addClass("active");
});

/* Extra class "tab_last" 
   to add border to bottom side
   of last tab 
$('ul.tabs li').last().addClass("tab_last");*/

// labs page tab end

$(".slidingDiv").addClass("show_hide");
$(".fixed-bar").click(function () {
    $(".slidingDiv").animate({
        width: "toggle"
    });
});

$('[data-toggle="tooltip"]').tooltip();

$("#owl-demo1").owlCarousel({

    autoPlay: 3000, //Set AutoPlay to 3 seconds
    items: 1,
    itemsDesktop: [1199, 1],
    itemsDesktopSmall: [979, 1],
    itemsMobile: [767, 1],
    pagination: true

});

$("#teams-slider1").owlCarousel((_$$owlCarousel = {
    navigation: true,
    pagination: false,
    items: 3,
    infinite: true,
    itemsDesktop: [1199, 3],
    itemsDesktopSmall: [980, 2],
    itemsMobile: [600, 2]
}, _defineProperty(_$$owlCarousel, 'itemsMobile', [360, 1]), _defineProperty(_$$owlCarousel, 'autoPlay', true), _defineProperty(_$$owlCarousel, 'loop', 1), _defineProperty(_$$owlCarousel, 'navigationText', ["", ""]), _$$owlCarousel));

$("#teams-slider2").owlCarousel({
    navigation: true,
    pagination: false,
    items: 3,
    infinite: true,
    itemsDesktop: [1199, 3],
    itemsDesktopSmall: [980, 2],
    itemsMobile: [600, 1],
    autoPlay: true,
    loop: 1,
    navigationText: ["", ""]
});

$("#blog-inner").owlCarousel({
    navigation: true,
    pagination: false,
    items: 3,
    infinite: true,
    itemsDesktop: [1199, 3],
    itemsDesktopSmall: [980, 2],
    itemsMobile: [600, 1],
    autoPlay: true,
    loop: 1,
    navigationText: ["", ""]
});

// $("#teams-slider3").owlCarousel({
//     navigation : true,
//     pagination : false,
//     items : 3,
//     infinite: true,
//     itemsDesktop:[1199,3],
//     itemsDesktopSmall:[980,2],
//     itemsMobile : [600,1],
//     autoPlay:true,
//     loop:1,
//     navigationText : ["",""]
// });

$("#teams-slider4").owlCarousel({
    navigation: true,
    pagination: false,
    items: 4,
    infinite: true,
    itemsDesktop: [1199, 3],
    itemsDesktopSmall: [980, 2],
    itemsMobile: [600, 1],
    autoPlay: true,
    loop: 1,
    navigationText: ["", ""]
});

// $("#teams-slider5").owlCarousel({
//     navigation : true,
//     pagination : false,
//     items : 3,
//     infinite: true,
//     itemsDesktop:[1199,3],
//     itemsDesktopSmall:[980,2],
//     itemsMobile : [600,1],
//     autoPlay:true,
//     loop:1,
//     navigationText : ["",""]
// });

// $("#recomendation").owlCarousel({
//     navigation : true,
//     pagination : false,
//     items : 3,
//     infinite: true,
//     itemsDesktop:[1199,3],
//     itemsDesktopSmall:[980,2],
//     itemsMobile : [600,1],
//     autoPlay:true,
//     loop:1,
//     navigationText : ["",""]
// });


$("#special-offer").owlCarousel({
    navigation: true,
    pagination: false,
    items: 4,
    infinite: true,
    itemsDesktop: [1199, 3],
    itemsDesktopSmall: [980, 2],
    itemsMobile: [600, 1],
    autoPlay: true,
    loop: 1,
    navigationText: ["", ""]
});

$("#time-slider").owlCarousel({
    navigation: true,
    pagination: false,
    items: 8,
    infinite: true,
    itemsDesktop: [1199, 3],
    itemsDesktopSmall: [980, 2],
    itemsMobile: [600, 1],
    autoPlay: true,
    loop: true,
    navigationText: ["", ""]
});

$("#profile-slider").owlCarousel({
    navigation: true,
    pagination: true,
    items: 6,
    infinite: true,
    itemsDesktop: [1199, 3],
    itemsDesktopSmall: [980, 2],
    itemsMobile: [600, 1],
    autoPlay: true,
    loop: true,
    navigationText: ["", ""]
});

$("#inner-banner").owlCarousel({
    navigation: true,
    pagination: false,
    items: 2,
    infinite: true,
    itemsDesktop: [1199, 2],
    itemsDesktopSmall: [980, 1],
    itemsMobile: [600, 1],
    autoPlay: true,
    loop: 1,
    navigationText: ["", ""]
});

$('.investor-cont h2+div').matchHeight({
    byRow: 0
});
$('.about-icon').matchHeight({
    byRow: 0
});
$('.book-div').matchHeight({
    byRow: 0
});
$('.carer-group').matchHeight({
    byRow: 0
});

// });

// ===== Scroll to Top ==== 
$(window).scroll(function () {
    if ($(this).scrollTop() >= 300) {
        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200); // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200); // Else fade out the arrow
    }
});
$('#return-to-top').click(function () {
    // When arrow is clicked
    $('body,html').animate({
        scrollTop: 0 // Scroll to top of body
    }, 500);
});

function copy(element_id) {
    var aux = document.createElement("div");
    aux.setAttribute("contentEditable", true);
    aux.innerHTML = document.getElementById(element_id).innerHTML;
    aux.setAttribute("onfocus", "document.execCommand('selectAll',false,null)");
    document.body.appendChild(aux);
    aux.focus();
    document.execCommand("copy");
    document.body.removeChild(aux);
}

$('ul.nav li.dropdown').hover(function () {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
}, function () {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
    // for multipal select and search
    //$('select').selectpicker();
});

//Filter Dropdown

$(".drop-filter").hover(function () {
    $(".drop-filter-show").show();
    $(".drop-filter-show1").hide();
    // $(".drop-filter").addClass("arrow")
    // $(".drop-filter1").removeClass("arrow")
});

$(".close-filter").click(function () {
    $(".drop-filter-show").hide();
    $(".drop-filter-show1").hide();
    // $(".drop-filter").removeClass("arrow")
    // $(".drop-filter1").removeClass("arrow")
});

$(".drop-filter1").hover(function () {
    $(".drop-filter-show1").show();
    $(".drop-filter-show").hide();
    // $(".drop-filter1").addClass("arrow")
    // $(".drop-filter").removeClass("arrow")
});
$(".search-section").hover(function () {
    $(".drop-filter-show1").hide();
    $(".drop-filter-show").hide();
    // $(".drop-filter1").addClass("arrow")
    // $(".drop-filter").removeClass("arrow")
});
//load more

$(".moreBox").slice(0, 1).show();
if ($(".more-result:hidden").length != 0) {
    $("#loadMore").show();
}
$("#loadMore").on('click', function (e) {
    e.preventDefault();
    $(".moreBox:hidden").slice(0, 6).slideDown();
    if ($(".moreBox:hidden").length == 0) {
        $("#loadMore").fadeOut('slow');
    }
});

// masanary
$(document).ready(function () {
    $('#pinBoot').pinterest_grid({
        no_columns: 3,
        padding_x: 10,
        padding_y: 10,
        margin_bottom: 50,
        single_column_breakpoint: 700
    });
});

;(function ($, window, document, undefined) {
    var pluginName = 'pinterest_grid',
        defaults = {
        padding_x: 10,
        padding_y: 10,
        no_columns: 3,
        margin_bottom: 50,
        single_column_breakpoint: 700
    },
        columns,
        $article,
        article_width;

    function Plugin(element, options) {
        this.element = element;
        this.options = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }

    Plugin.prototype.init = function () {
        var self = this,
            resize_finish;

        $(window).resize(function () {
            clearTimeout(resize_finish);
            resize_finish = setTimeout(function () {
                self.make_layout_change(self);
            }, 11);
        });

        self.make_layout_change(self);

        setTimeout(function () {
            $(window).resize();
        }, 500);
    };

    Plugin.prototype.calculate = function (single_column_mode) {
        var self = this,
            tallest = 0,
            row = 0,
            $container = $(this.element),
            container_width = $container.width();
        $article = $(this.element).children();

        if (single_column_mode === true) {
            article_width = $container.width() - self.options.padding_x;
        } else {
            article_width = ($container.width() - self.options.padding_x * self.options.no_columns) / self.options.no_columns;
        }

        $article.each(function () {
            $(this).css('width', article_width);
        });

        columns = self.options.no_columns;

        $article.each(function (index) {
            var current_column,
                left_out = 0,
                top = 0,
                $this = $(this),
                prevAll = $this.prevAll(),
                tallest = 0;

            if (single_column_mode === false) {
                current_column = index % columns;
            } else {
                current_column = 0;
            }

            for (var t = 0; t < columns; t++) {
                $this.removeClass('c' + t);
            }

            if (index % columns === 0) {
                row++;
            }

            $this.addClass('c' + current_column);
            $this.addClass('r' + row);

            prevAll.each(function (index) {
                if ($(this).hasClass('c' + current_column)) {
                    top += $(this).outerHeight() + self.options.padding_y;
                }
            });

            if (single_column_mode === true) {
                left_out = 0;
            } else {
                left_out = index % columns * (article_width + self.options.padding_x);
            }

            $this.css({
                'left': left_out,
                'top': top
            });
        });

        this.tallest($container);
        $(window).resize();
    };

    Plugin.prototype.tallest = function (_container) {
        var column_heights = [],
            largest = 0;

        for (var z = 0; z < columns; z++) {
            var temp_height = 0;
            _container.find('.c' + z).each(function () {
                temp_height += $(this).outerHeight();
            });
            column_heights[z] = temp_height;
        }

        largest = Math.max.apply(Math, column_heights);
        _container.css('height', largest + (this.options.padding_y + this.options.margin_bottom));
    };

    Plugin.prototype.make_layout_change = function (_self) {
        if ($(window).width() < _self.options.single_column_breakpoint) {
            _self.calculate(true);
        } else {
            _self.calculate(false);
        }
    };

    $.fn[pluginName] = function (options) {
        return this.each(function () {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName, new Plugin(this, options));
            }
        });
    };
})(jQuery, window, document);

/***/ }),

/***/ "./resources/assets/js/v2/jquery.lazyloadxt.min.js":
/***/ (function(module, exports) {

/* Lazy Load XT 1.1.0 | MIT License */
!function (a, b, c, d) {
  function e(a, b) {
    return a[b] === d ? t[b] : a[b];
  }function f() {
    var a = b.pageYOffset;return a === d ? r.scrollTop : a;
  }function g(a, b) {
    var c = t["on" + a];c && (w(c) ? c.call(b[0]) : (c.addClass && b.addClass(c.addClass), c.removeClass && b.removeClass(c.removeClass))), b.trigger("lazy" + a, [b]), k();
  }function h(b) {
    g(b.type, a(this).off(p, h));
  }function i(c) {
    if (z.length) {
      c = c || t.forceLoad, A = 1 / 0;var d,
          e,
          i = f(),
          j = b.innerHeight || r.clientHeight,
          k = b.innerWidth || r.clientWidth;for (d = 0, e = z.length; e > d; d++) {
        var l,
            m = z[d],
            q = m[0],
            s = m[n],
            u = !1,
            v = c || y(q, o) < 0;if (a.contains(r, q)) {
          if (c || !s.visibleOnly || q.offsetWidth || q.offsetHeight) {
            if (!v) {
              var x = q.getBoundingClientRect(),
                  B = s.edgeX,
                  C = s.edgeY;l = x.top + i - C - j, v = i >= l && x.bottom > -C && x.left <= k + B && x.right > -B;
            }if (v) {
              m.on(p, h), g("show", m);var D = s.srcAttr,
                  E = w(D) ? D(m) : q.getAttribute(D);E && (q.src = E), u = !0;
            } else A > l && (A = l);
          }
        } else u = !0;u && (y(q, o, 0), z.splice(d--, 1), e--);
      }e || g("complete", a(r));
    }
  }function j() {
    B > 1 ? (B = 1, i(), setTimeout(j, t.throttle)) : B = 0;
  }function k(a) {
    z.length && (a && "scroll" === a.type && a.currentTarget === b && A >= f() || (B || setTimeout(j, 0), B = 2));
  }function l() {
    v.lazyLoadXT();
  }function m() {
    i(!0);
  }var n = "lazyLoadXT",
      o = "lazied",
      p = "load error",
      q = "lazy-hidden",
      r = c.documentElement || c.body,
      s = b.onscroll === d || !!b.operamini || !r.getBoundingClientRect,
      t = { autoInit: !0, selector: "img[data-src]", blankImage: "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7", throttle: 99, forceLoad: s, loadEvent: "pageshow", updateEvent: "load orientationchange resize scroll touchmove focus", forceEvent: "lazyloadall", oninit: { removeClass: "lazy" }, onshow: { addClass: q }, onload: { removeClass: q, addClass: "lazy-loaded" }, onerror: { removeClass: q }, checkDuplicates: !0 },
      u = { srcAttr: "data-src", edgeX: 0, edgeY: 0, visibleOnly: !0 },
      v = a(b),
      w = a.isFunction,
      x = a.extend,
      y = a.data || function (b, c) {
    return a(b).data(c);
  },
      z = [],
      A = 0,
      B = 0;a[n] = x(t, u, a[n]), a.fn[n] = function (c) {
    c = c || {};var d,
        f = e(c, "blankImage"),
        h = e(c, "checkDuplicates"),
        i = e(c, "scrollContainer"),
        j = e(c, "show"),
        l = {};a(i).on("scroll", k);for (d in u) {
      l[d] = e(c, d);
    }return this.each(function (d, e) {
      if (e === b) a(t.selector).lazyLoadXT(c);else {
        var i = h && y(e, o),
            m = a(e).data(o, j ? -1 : 1);if (i) return void k();f && "IMG" === e.tagName && !e.src && (e.src = f), m[n] = x({}, l), g("init", m), z.push(m), k();
      }
    });
  }, a(c).ready(function () {
    g("start", v), v.on(t.updateEvent, k).on(t.forceEvent, m), a(c).on(t.updateEvent, k), t.autoInit && (v.on(t.loadEvent, l), l());
  });
}(window.jQuery || window.Zepto || window.$, window, document);

/***/ }),

/***/ "./resources/assets/js/v2/owl.carousel.min.js":
/***/ (function(module, exports) {

"function" !== typeof Object.create && (Object.create = function (f) {
  function g() {}g.prototype = f;return new g();
});
(function (f, g, k) {
  var l = { init: function init(a, b) {
      this.$elem = f(b);this.options = f.extend({}, f.fn.owlCarousel.options, this.$elem.data(), a);this.userOptions = a;this.loadContent();
    }, loadContent: function loadContent() {
      function a(a) {
        var d,
            e = "";if ("function" === typeof b.options.jsonSuccess) b.options.jsonSuccess.apply(this, [a]);else {
          for (d in a.owl) {
            a.owl.hasOwnProperty(d) && (e += a.owl[d].item);
          }b.$elem.html(e);
        }b.logIn();
      }var b = this,
          e;"function" === typeof b.options.beforeInit && b.options.beforeInit.apply(this, [b.$elem]);"string" === typeof b.options.jsonPath ? (e = b.options.jsonPath, f.getJSON(e, a)) : b.logIn();
    }, logIn: function logIn() {
      this.$elem.data("owl-originalStyles", this.$elem.attr("style"));this.$elem.data("owl-originalClasses", this.$elem.attr("class"));this.$elem.css({ opacity: 0 });this.orignalItems = this.options.items;this.checkBrowser();this.wrapperWidth = 0;this.checkVisible = null;this.setVars();
    }, setVars: function setVars() {
      if (0 === this.$elem.children().length) return !1;this.baseClass();this.eventTypes();this.$userItems = this.$elem.children();this.itemsAmount = this.$userItems.length;
      this.wrapItems();this.$owlItems = this.$elem.find(".owl-item");this.$owlWrapper = this.$elem.find(".owl-wrapper");this.playDirection = "next";this.prevItem = 0;this.prevArr = [0];this.currentItem = 0;this.customEvents();this.onStartup();
    }, onStartup: function onStartup() {
      this.updateItems();this.calculateAll();this.buildControls();this.updateControls();this.response();this.moveEvents();this.stopOnHover();this.owlStatus();!1 !== this.options.transitionStyle && this.transitionTypes(this.options.transitionStyle);!0 === this.options.autoPlay && (this.options.autoPlay = 5E3);this.play();this.$elem.find(".owl-wrapper").css("display", "block");this.$elem.is(":visible") ? this.$elem.css("opacity", 1) : this.watchVisibility();this.onstartup = !1;this.eachMoveUpdate();"function" === typeof this.options.afterInit && this.options.afterInit.apply(this, [this.$elem]);
    }, eachMoveUpdate: function eachMoveUpdate() {
      !0 === this.options.lazyLoad && this.lazyLoad();!0 === this.options.autoHeight && this.autoHeight();this.onVisibleItems();"function" === typeof this.options.afterAction && this.options.afterAction.apply(this, [this.$elem]);
    }, updateVars: function updateVars() {
      "function" === typeof this.options.beforeUpdate && this.options.beforeUpdate.apply(this, [this.$elem]);this.watchVisibility();this.updateItems();this.calculateAll();this.updatePosition();this.updateControls();this.eachMoveUpdate();"function" === typeof this.options.afterUpdate && this.options.afterUpdate.apply(this, [this.$elem]);
    }, reload: function reload() {
      var a = this;g.setTimeout(function () {
        a.updateVars();
      }, 0);
    }, watchVisibility: function watchVisibility() {
      var a = this;if (!1 === a.$elem.is(":visible")) a.$elem.css({ opacity: 0 }), g.clearInterval(a.autoPlayInterval), g.clearInterval(a.checkVisible);else return !1;a.checkVisible = g.setInterval(function () {
        a.$elem.is(":visible") && (a.reload(), a.$elem.animate({ opacity: 1 }, 200), g.clearInterval(a.checkVisible));
      }, 500);
    }, wrapItems: function wrapItems() {
      this.$userItems.wrapAll('<div class="owl-wrapper">').wrap('<div class="owl-item"></div>');this.$elem.find(".owl-wrapper").wrap('<div class="owl-wrapper-outer">');this.wrapperOuter = this.$elem.find(".owl-wrapper-outer");this.$elem.css("display", "block");
    },
    baseClass: function baseClass() {
      var a = this.$elem.hasClass(this.options.baseClass),
          b = this.$elem.hasClass(this.options.theme);a || this.$elem.addClass(this.options.baseClass);b || this.$elem.addClass(this.options.theme);
    }, updateItems: function updateItems() {
      var a, b;if (!1 === this.options.responsive) return !1;if (!0 === this.options.singleItem) return this.options.items = this.orignalItems = 1, this.options.itemsCustom = !1, this.options.itemsDesktop = !1, this.options.itemsDesktopSmall = !1, this.options.itemsTablet = !1, this.options.itemsTabletSmall = !1, this.options.itemsMobile = !1;a = f(this.options.responsiveBaseWidth).width();a > (this.options.itemsDesktop[0] || this.orignalItems) && (this.options.items = this.orignalItems);if (!1 !== this.options.itemsCustom) for (this.options.itemsCustom.sort(function (a, b) {
        return a[0] - b[0];
      }), b = 0; b < this.options.itemsCustom.length; b += 1) {
        this.options.itemsCustom[b][0] <= a && (this.options.items = this.options.itemsCustom[b][1]);
      } else a <= this.options.itemsDesktop[0] && !1 !== this.options.itemsDesktop && (this.options.items = this.options.itemsDesktop[1]), a <= this.options.itemsDesktopSmall[0] && !1 !== this.options.itemsDesktopSmall && (this.options.items = this.options.itemsDesktopSmall[1]), a <= this.options.itemsTablet[0] && !1 !== this.options.itemsTablet && (this.options.items = this.options.itemsTablet[1]), a <= this.options.itemsTabletSmall[0] && !1 !== this.options.itemsTabletSmall && (this.options.items = this.options.itemsTabletSmall[1]), a <= this.options.itemsMobile[0] && !1 !== this.options.itemsMobile && (this.options.items = this.options.itemsMobile[1]);this.options.items > this.itemsAmount && !0 === this.options.itemsScaleUp && (this.options.items = this.itemsAmount);
    }, response: function response() {
      var a = this,
          b,
          e;if (!0 !== a.options.responsive) return !1;e = f(g).width();a.resizer = function () {
        f(g).width() !== e && (!1 !== a.options.autoPlay && g.clearInterval(a.autoPlayInterval), g.clearTimeout(b), b = g.setTimeout(function () {
          e = f(g).width();a.updateVars();
        }, a.options.responsiveRefreshRate));
      };f(g).resize(a.resizer);
    }, updatePosition: function updatePosition() {
      this.jumpTo(this.currentItem);!1 !== this.options.autoPlay && this.checkAp();
    }, appendItemsSizes: function appendItemsSizes() {
      var a = this,
          b = 0,
          e = a.itemsAmount - a.options.items;a.$owlItems.each(function (c) {
        var d = f(this);d.css({ width: a.itemWidth }).data("owl-item", Number(c));if (0 === c % a.options.items || c === e) c > e || (b += 1);d.data("owl-roundPages", b);
      });
    }, appendWrapperSizes: function appendWrapperSizes() {
      this.$owlWrapper.css({ width: this.$owlItems.length * this.itemWidth * 2, left: 0 });this.appendItemsSizes();
    }, calculateAll: function calculateAll() {
      this.calculateWidth();this.appendWrapperSizes();this.loops();this.max();
    }, calculateWidth: function calculateWidth() {
      this.itemWidth = Math.round(this.$elem.width() / this.options.items);
    }, max: function max() {
      var a = -1 * (this.itemsAmount * this.itemWidth - this.options.items * this.itemWidth);this.options.items > this.itemsAmount ? this.maximumPixels = a = this.maximumItem = 0 : (this.maximumItem = this.itemsAmount - this.options.items, this.maximumPixels = a);return a;
    }, min: function min() {
      return 0;
    }, loops: function loops() {
      var a = 0,
          b = 0,
          e,
          c;this.positionsInArray = [0];this.pagesInArray = [];for (e = 0; e < this.itemsAmount; e += 1) {
        b += this.itemWidth, this.positionsInArray.push(-b), !0 === this.options.scrollPerPage && (c = f(this.$owlItems[e]), c = c.data("owl-roundPages"), c !== a && (this.pagesInArray[a] = this.positionsInArray[e], a = c));
      }
    }, buildControls: function buildControls() {
      if (!0 === this.options.navigation || !0 === this.options.pagination) this.owlControls = f('<div class="owl-controls"/>').toggleClass("clickable", !this.browser.isTouch).appendTo(this.$elem);!0 === this.options.pagination && this.buildPagination();!0 === this.options.navigation && this.buildButtons();
    }, buildButtons: function buildButtons() {
      var a = this,
          b = f('<div class="owl-buttons"/>');a.owlControls.append(b);a.buttonPrev = f("<div/>", { "class": "owl-prev", html: a.options.navigationText[0] || "" });a.buttonNext = f("<div/>", { "class": "owl-next", html: a.options.navigationText[1] || "" });b.append(a.buttonPrev).append(a.buttonNext);b.on("touchstart.owlControls mousedown.owlControls", 'div[class^="owl"]', function (a) {
        a.preventDefault();
      });b.on("touchend.owlControls mouseup.owlControls", 'div[class^="owl"]', function (b) {
        b.preventDefault();f(this).hasClass("owl-next") ? a.next() : a.prev();
      });
    }, buildPagination: function buildPagination() {
      var a = this;a.paginationWrapper = f('<div class="owl-pagination"/>');a.owlControls.append(a.paginationWrapper);a.paginationWrapper.on("touchend.owlControls mouseup.owlControls", ".owl-page", function (b) {
        b.preventDefault();Number(f(this).data("owl-page")) !== a.currentItem && a.goTo(Number(f(this).data("owl-page")), !0);
      });
    }, updatePagination: function updatePagination() {
      var a, b, e, c, d, g;if (!1 === this.options.pagination) return !1;this.paginationWrapper.html("");a = 0;b = this.itemsAmount - this.itemsAmount % this.options.items;for (c = 0; c < this.itemsAmount; c += 1) {
        0 === c % this.options.items && (a += 1, b === c && (e = this.itemsAmount - this.options.items), d = f("<div/>", { "class": "owl-page" }), g = f("<span></span>", { text: !0 === this.options.paginationNumbers ? a : "", "class": !0 === this.options.paginationNumbers ? "owl-numbers" : "" }), d.append(g), d.data("owl-page", b === c ? e : c), d.data("owl-roundPages", a), this.paginationWrapper.append(d));
      }this.checkPagination();
    }, checkPagination: function checkPagination() {
      var a = this;if (!1 === a.options.pagination) return !1;a.paginationWrapper.find(".owl-page").each(function () {
        f(this).data("owl-roundPages") === f(a.$owlItems[a.currentItem]).data("owl-roundPages") && (a.paginationWrapper.find(".owl-page").removeClass("active"), f(this).addClass("active"));
      });
    }, checkNavigation: function checkNavigation() {
      if (!1 === this.options.navigation) return !1;!1 === this.options.rewindNav && (0 === this.currentItem && 0 === this.maximumItem ? (this.buttonPrev.addClass("disabled"), this.buttonNext.addClass("disabled")) : 0 === this.currentItem && 0 !== this.maximumItem ? (this.buttonPrev.addClass("disabled"), this.buttonNext.removeClass("disabled")) : this.currentItem === this.maximumItem ? (this.buttonPrev.removeClass("disabled"), this.buttonNext.addClass("disabled")) : 0 !== this.currentItem && this.currentItem !== this.maximumItem && (this.buttonPrev.removeClass("disabled"), this.buttonNext.removeClass("disabled")));
    }, updateControls: function updateControls() {
      this.updatePagination();this.checkNavigation();this.owlControls && (this.options.items >= this.itemsAmount ? this.owlControls.hide() : this.owlControls.show());
    }, destroyControls: function destroyControls() {
      this.owlControls && this.owlControls.remove();
    }, next: function next(a) {
      if (this.isTransition) return !1;
      this.currentItem += !0 === this.options.scrollPerPage ? this.options.items : 1;if (this.currentItem > this.maximumItem + (!0 === this.options.scrollPerPage ? this.options.items - 1 : 0)) if (!0 === this.options.rewindNav) this.currentItem = 0, a = "rewind";else return this.currentItem = this.maximumItem, !1;this.goTo(this.currentItem, a);
    }, prev: function prev(a) {
      if (this.isTransition) return !1;this.currentItem = !0 === this.options.scrollPerPage && 0 < this.currentItem && this.currentItem < this.options.items ? 0 : this.currentItem - (!0 === this.options.scrollPerPage ? this.options.items : 1);if (0 > this.currentItem) if (!0 === this.options.rewindNav) this.currentItem = this.maximumItem, a = "rewind";else return this.currentItem = 0, !1;this.goTo(this.currentItem, a);
    }, goTo: function goTo(a, b, e) {
      var c = this;if (c.isTransition) return !1;"function" === typeof c.options.beforeMove && c.options.beforeMove.apply(this, [c.$elem]);a >= c.maximumItem ? a = c.maximumItem : 0 >= a && (a = 0);c.currentItem = c.owl.currentItem = a;if (!1 !== c.options.transitionStyle && "drag" !== e && 1 === c.options.items && !0 === c.browser.support3d) return c.swapSpeed(0), !0 === c.browser.support3d ? c.transition3d(c.positionsInArray[a]) : c.css2slide(c.positionsInArray[a], 1), c.afterGo(), c.singleItemTransition(), !1;a = c.positionsInArray[a];!0 === c.browser.support3d ? (c.isCss3Finish = !1, !0 === b ? (c.swapSpeed("paginationSpeed"), g.setTimeout(function () {
        c.isCss3Finish = !0;
      }, c.options.paginationSpeed)) : "rewind" === b ? (c.swapSpeed(c.options.rewindSpeed), g.setTimeout(function () {
        c.isCss3Finish = !0;
      }, c.options.rewindSpeed)) : (c.swapSpeed("slideSpeed"), g.setTimeout(function () {
        c.isCss3Finish = !0;
      }, c.options.slideSpeed)), c.transition3d(a)) : !0 === b ? c.css2slide(a, c.options.paginationSpeed) : "rewind" === b ? c.css2slide(a, c.options.rewindSpeed) : c.css2slide(a, c.options.slideSpeed);c.afterGo();
    }, jumpTo: function jumpTo(a) {
      "function" === typeof this.options.beforeMove && this.options.beforeMove.apply(this, [this.$elem]);a >= this.maximumItem || -1 === a ? a = this.maximumItem : 0 >= a && (a = 0);this.swapSpeed(0);!0 === this.browser.support3d ? this.transition3d(this.positionsInArray[a]) : this.css2slide(this.positionsInArray[a], 1);this.currentItem = this.owl.currentItem = a;this.afterGo();
    }, afterGo: function afterGo() {
      this.prevArr.push(this.currentItem);this.prevItem = this.owl.prevItem = this.prevArr[this.prevArr.length - 2];this.prevArr.shift(0);this.prevItem !== this.currentItem && (this.checkPagination(), this.checkNavigation(), this.eachMoveUpdate(), !1 !== this.options.autoPlay && this.checkAp());"function" === typeof this.options.afterMove && this.prevItem !== this.currentItem && this.options.afterMove.apply(this, [this.$elem]);
    }, stop: function stop() {
      this.apStatus = "stop";g.clearInterval(this.autoPlayInterval);
    },
    checkAp: function checkAp() {
      "stop" !== this.apStatus && this.play();
    }, play: function play() {
      var a = this;a.apStatus = "play";if (!1 === a.options.autoPlay) return !1;g.clearInterval(a.autoPlayInterval);a.autoPlayInterval = g.setInterval(function () {
        a.next(!0);
      }, a.options.autoPlay);
    }, swapSpeed: function swapSpeed(a) {
      "slideSpeed" === a ? this.$owlWrapper.css(this.addCssSpeed(this.options.slideSpeed)) : "paginationSpeed" === a ? this.$owlWrapper.css(this.addCssSpeed(this.options.paginationSpeed)) : "string" !== typeof a && this.$owlWrapper.css(this.addCssSpeed(a));
    },
    addCssSpeed: function addCssSpeed(a) {
      return { "-webkit-transition": "all " + a + "ms ease", "-moz-transition": "all " + a + "ms ease", "-o-transition": "all " + a + "ms ease", transition: "all " + a + "ms ease" };
    }, removeTransition: function removeTransition() {
      return { "-webkit-transition": "", "-moz-transition": "", "-o-transition": "", transition: "" };
    }, doTranslate: function doTranslate(a) {
      return { "-webkit-transform": "translate3d(" + a + "px, 0px, 0px)", "-moz-transform": "translate3d(" + a + "px, 0px, 0px)", "-o-transform": "translate3d(" + a + "px, 0px, 0px)", "-ms-transform": "translate3d(" + a + "px, 0px, 0px)", transform: "translate3d(" + a + "px, 0px,0px)" };
    }, transition3d: function transition3d(a) {
      this.$owlWrapper.css(this.doTranslate(a));
    }, css2move: function css2move(a) {
      this.$owlWrapper.css({ left: a });
    }, css2slide: function css2slide(a, b) {
      var e = this;e.isCssFinish = !1;e.$owlWrapper.stop(!0, !0).animate({ left: a }, { duration: b || e.options.slideSpeed, complete: function complete() {
          e.isCssFinish = !0;
        } });
    }, checkBrowser: function checkBrowser() {
      var a = k.createElement("div");a.style.cssText = "  -moz-transform:translate3d(0px, 0px, 0px); -ms-transform:translate3d(0px, 0px, 0px); -o-transform:translate3d(0px, 0px, 0px); -webkit-transform:translate3d(0px, 0px, 0px); transform:translate3d(0px, 0px, 0px)";
      a = a.style.cssText.match(/translate3d\(0px, 0px, 0px\)/g);this.browser = { support3d: null !== a && 1 === a.length, isTouch: "ontouchstart" in g || g.navigator.msMaxTouchPoints };
    }, moveEvents: function moveEvents() {
      if (!1 !== this.options.mouseDrag || !1 !== this.options.touchDrag) this.gestures(), this.disabledEvents();
    }, eventTypes: function eventTypes() {
      var a = ["s", "e", "x"];this.ev_types = {};!0 === this.options.mouseDrag && !0 === this.options.touchDrag ? a = ["touchstart.owl mousedown.owl", "touchmove.owl mousemove.owl", "touchend.owl touchcancel.owl mouseup.owl"] : !1 === this.options.mouseDrag && !0 === this.options.touchDrag ? a = ["touchstart.owl", "touchmove.owl", "touchend.owl touchcancel.owl"] : !0 === this.options.mouseDrag && !1 === this.options.touchDrag && (a = ["mousedown.owl", "mousemove.owl", "mouseup.owl"]);this.ev_types.start = a[0];this.ev_types.move = a[1];this.ev_types.end = a[2];
    }, disabledEvents: function disabledEvents() {
      this.$elem.on("dragstart.owl", function (a) {
        a.preventDefault();
      });this.$elem.on("mousedown.disableTextSelect", function (a) {
        return f(a.target).is("input, textarea, select, option");
      });
    },
    gestures: function gestures() {
      function a(a) {
        if (void 0 !== a.touches) return { x: a.touches[0].pageX, y: a.touches[0].pageY };if (void 0 === a.touches) {
          if (void 0 !== a.pageX) return { x: a.pageX, y: a.pageY };if (void 0 === a.pageX) return { x: a.clientX, y: a.clientY };
        }
      }function b(a) {
        "on" === a ? (f(k).on(d.ev_types.move, e), f(k).on(d.ev_types.end, c)) : "off" === a && (f(k).off(d.ev_types.move), f(k).off(d.ev_types.end));
      }function e(b) {
        b = b.originalEvent || b || g.event;d.newPosX = a(b).x - h.offsetX;d.newPosY = a(b).y - h.offsetY;d.newRelativeX = d.newPosX - h.relativePos;
        "function" === typeof d.options.startDragging && !0 !== h.dragging && 0 !== d.newRelativeX && (h.dragging = !0, d.options.startDragging.apply(d, [d.$elem]));(8 < d.newRelativeX || -8 > d.newRelativeX) && !0 === d.browser.isTouch && (void 0 !== b.preventDefault ? b.preventDefault() : b.returnValue = !1, h.sliding = !0);(10 < d.newPosY || -10 > d.newPosY) && !1 === h.sliding && f(k).off("touchmove.owl");d.newPosX = Math.max(Math.min(d.newPosX, d.newRelativeX / 5), d.maximumPixels + d.newRelativeX / 5);!0 === d.browser.support3d ? d.transition3d(d.newPosX) : d.css2move(d.newPosX);
      }
      function c(a) {
        a = a.originalEvent || a || g.event;var c;a.target = a.target || a.srcElement;h.dragging = !1;!0 !== d.browser.isTouch && d.$owlWrapper.removeClass("grabbing");d.dragDirection = 0 > d.newRelativeX ? d.owl.dragDirection = "left" : d.owl.dragDirection = "right";0 !== d.newRelativeX && (c = d.getNewPosition(), d.goTo(c, !1, "drag"), h.targetElement === a.target && !0 !== d.browser.isTouch && (f(a.target).on("click.disable", function (a) {
          a.stopImmediatePropagation();a.stopPropagation();a.preventDefault();f(a.target).off("click.disable");
        }), a = f._data(a.target, "events").click, c = a.pop(), a.splice(0, 0, c)));b("off");
      }var d = this,
          h = { offsetX: 0, offsetY: 0, baseElWidth: 0, relativePos: 0, position: null, minSwipe: null, maxSwipe: null, sliding: null, dargging: null, targetElement: null };d.isCssFinish = !0;d.$elem.on(d.ev_types.start, ".owl-wrapper", function (c) {
        c = c.originalEvent || c || g.event;var e;if (3 === c.which) return !1;if (!(d.itemsAmount <= d.options.items)) {
          if (!1 === d.isCssFinish && !d.options.dragBeforeAnimFinish || !1 === d.isCss3Finish && !d.options.dragBeforeAnimFinish) return !1;
          !1 !== d.options.autoPlay && g.clearInterval(d.autoPlayInterval);!0 === d.browser.isTouch || d.$owlWrapper.hasClass("grabbing") || d.$owlWrapper.addClass("grabbing");d.newPosX = 0;d.newRelativeX = 0;f(this).css(d.removeTransition());e = f(this).position();h.relativePos = e.left;h.offsetX = a(c).x - e.left;h.offsetY = a(c).y - e.top;b("on");h.sliding = !1;h.targetElement = c.target || c.srcElement;
        }
      });
    }, getNewPosition: function getNewPosition() {
      var a = this.closestItem();a > this.maximumItem ? a = this.currentItem = this.maximumItem : 0 <= this.newPosX && (this.currentItem = a = 0);return a;
    }, closestItem: function closestItem() {
      var a = this,
          b = !0 === a.options.scrollPerPage ? a.pagesInArray : a.positionsInArray,
          e = a.newPosX,
          c = null;f.each(b, function (d, g) {
        e - a.itemWidth / 20 > b[d + 1] && e - a.itemWidth / 20 < g && "left" === a.moveDirection() ? (c = g, a.currentItem = !0 === a.options.scrollPerPage ? f.inArray(c, a.positionsInArray) : d) : e + a.itemWidth / 20 < g && e + a.itemWidth / 20 > (b[d + 1] || b[d] - a.itemWidth) && "right" === a.moveDirection() && (!0 === a.options.scrollPerPage ? (c = b[d + 1] || b[b.length - 1], a.currentItem = f.inArray(c, a.positionsInArray)) : (c = b[d + 1], a.currentItem = d + 1));
      });return a.currentItem;
    }, moveDirection: function moveDirection() {
      var a;0 > this.newRelativeX ? (a = "right", this.playDirection = "next") : (a = "left", this.playDirection = "prev");return a;
    }, customEvents: function customEvents() {
      var a = this;a.$elem.on("owl.next", function () {
        a.next();
      });a.$elem.on("owl.prev", function () {
        a.prev();
      });a.$elem.on("owl.play", function (b, e) {
        a.options.autoPlay = e;a.play();a.hoverStatus = "play";
      });a.$elem.on("owl.stop", function () {
        a.stop();a.hoverStatus = "stop";
      });a.$elem.on("owl.goTo", function (b, e) {
        a.goTo(e);
      });
      a.$elem.on("owl.jumpTo", function (b, e) {
        a.jumpTo(e);
      });
    }, stopOnHover: function stopOnHover() {
      var a = this;!0 === a.options.stopOnHover && !0 !== a.browser.isTouch && !1 !== a.options.autoPlay && (a.$elem.on("mouseover", function () {
        a.stop();
      }), a.$elem.on("mouseout", function () {
        "stop" !== a.hoverStatus && a.play();
      }));
    }, lazyLoad: function lazyLoad() {
      var a, b, e, c, d;if (!1 === this.options.lazyLoad) return !1;for (a = 0; a < this.itemsAmount; a += 1) {
        b = f(this.$owlItems[a]), "loaded" !== b.data("owl-loaded") && (e = b.data("owl-item"), c = b.find(".lazyOwl"), "string" !== typeof c.data("src") ? b.data("owl-loaded", "loaded") : (void 0 === b.data("owl-loaded") && (c.hide(), b.addClass("loading").data("owl-loaded", "checked")), (d = !0 === this.options.lazyFollow ? e >= this.currentItem : !0) && e < this.currentItem + this.options.items && c.length && this.lazyPreload(b, c)));
      }
    }, lazyPreload: function lazyPreload(a, b) {
      function e() {
        a.data("owl-loaded", "loaded").removeClass("loading");b.removeAttr("data-src");"fade" === d.options.lazyEffect ? b.fadeIn(400) : b.show();"function" === typeof d.options.afterLazyLoad && d.options.afterLazyLoad.apply(this, [d.$elem]);
      }function c() {
        f += 1;d.completeImg(b.get(0)) || !0 === k ? e() : 100 >= f ? g.setTimeout(c, 100) : e();
      }var d = this,
          f = 0,
          k;"DIV" === b.prop("tagName") ? (b.css("background-image", "url(" + b.data("src") + ")"), k = !0) : b[0].src = b.data("src");c();
    }, autoHeight: function autoHeight() {
      function a() {
        var a = f(e.$owlItems[e.currentItem]).height();e.wrapperOuter.css("height", a + "px");e.wrapperOuter.hasClass("autoHeight") || g.setTimeout(function () {
          e.wrapperOuter.addClass("autoHeight");
        }, 0);
      }function b() {
        d += 1;e.completeImg(c.get(0)) ? a() : 100 >= d ? g.setTimeout(b, 100) : e.wrapperOuter.css("height", "");
      }var e = this,
          c = f(e.$owlItems[e.currentItem]).find("img"),
          d;void 0 !== c.get(0) ? (d = 0, b()) : a();
    }, completeImg: function completeImg(a) {
      return !a.complete || "undefined" !== typeof a.naturalWidth && 0 === a.naturalWidth ? !1 : !0;
    }, onVisibleItems: function onVisibleItems() {
      var a;!0 === this.options.addClassActive && this.$owlItems.removeClass("active");this.visibleItems = [];for (a = this.currentItem; a < this.currentItem + this.options.items; a += 1) {
        this.visibleItems.push(a), !0 === this.options.addClassActive && f(this.$owlItems[a]).addClass("active");
      }this.owl.visibleItems = this.visibleItems;
    }, transitionTypes: function transitionTypes(a) {
      this.outClass = "owl-" + a + "-out";this.inClass = "owl-" + a + "-in";
    }, singleItemTransition: function singleItemTransition() {
      var a = this,
          b = a.outClass,
          e = a.inClass,
          c = a.$owlItems.eq(a.currentItem),
          d = a.$owlItems.eq(a.prevItem),
          f = Math.abs(a.positionsInArray[a.currentItem]) + a.positionsInArray[a.prevItem],
          g = Math.abs(a.positionsInArray[a.currentItem]) + a.itemWidth / 2;a.isTransition = !0;a.$owlWrapper.addClass("owl-origin").css({ "-webkit-transform-origin": g + "px", "-moz-perspective-origin": g + "px", "perspective-origin": g + "px" });d.css({ position: "relative", left: f + "px" }).addClass(b).on("webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend", function () {
        a.endPrev = !0;d.off("webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend");a.clearTransStyle(d, b);
      });c.addClass(e).on("webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend", function () {
        a.endCurrent = !0;c.off("webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend");a.clearTransStyle(c, e);
      });
    }, clearTransStyle: function clearTransStyle(a, b) {
      a.css({ position: "", left: "" }).removeClass(b);this.endPrev && this.endCurrent && (this.$owlWrapper.removeClass("owl-origin"), this.isTransition = this.endCurrent = this.endPrev = !1);
    }, owlStatus: function owlStatus() {
      this.owl = { userOptions: this.userOptions, baseElement: this.$elem, userItems: this.$userItems, owlItems: this.$owlItems, currentItem: this.currentItem, prevItem: this.prevItem, visibleItems: this.visibleItems, isTouch: this.browser.isTouch, browser: this.browser, dragDirection: this.dragDirection };
    }, clearEvents: function clearEvents() {
      this.$elem.off(".owl owl mousedown.disableTextSelect");
      f(k).off(".owl owl");f(g).off("resize", this.resizer);
    }, unWrap: function unWrap() {
      0 !== this.$elem.children().length && (this.$owlWrapper.unwrap(), this.$userItems.unwrap().unwrap(), this.owlControls && this.owlControls.remove());this.clearEvents();this.$elem.attr("style", this.$elem.data("owl-originalStyles") || "").attr("class", this.$elem.data("owl-originalClasses"));
    }, destroy: function destroy() {
      this.stop();g.clearInterval(this.checkVisible);this.unWrap();this.$elem.removeData();
    }, reinit: function reinit(a) {
      a = f.extend({}, this.userOptions, a);this.unWrap();this.init(a, this.$elem);
    }, addItem: function addItem(a, b) {
      var e;if (!a) return !1;if (0 === this.$elem.children().length) return this.$elem.append(a), this.setVars(), !1;this.unWrap();e = void 0 === b || -1 === b ? -1 : b;e >= this.$userItems.length || -1 === e ? this.$userItems.eq(-1).after(a) : this.$userItems.eq(e).before(a);this.setVars();
    }, removeItem: function removeItem(a) {
      if (0 === this.$elem.children().length) return !1;a = void 0 === a || -1 === a ? -1 : a;this.unWrap();this.$userItems.eq(a).remove();this.setVars();
    } };f.fn.owlCarousel = function (a) {
    return this.each(function () {
      if (!0 === f(this).data("owl-init")) return !1;f(this).data("owl-init", !0);var b = Object.create(l);b.init(a, this);f.data(this, "owlCarousel", b);
    });
  };f.fn.owlCarousel.options = { items: 5, itemsCustom: !1, itemsDesktop: [1199, 4], itemsDesktopSmall: [979, 3], itemsTablet: [768, 2], itemsTabletSmall: !1, itemsMobile: [479, 1], singleItem: !1, itemsScaleUp: !1, slideSpeed: 200, paginationSpeed: 800, rewindSpeed: 1E3, autoPlay: !1, stopOnHover: !1, navigation: !1, navigationText: ["prev", "next"], rewindNav: !0, scrollPerPage: !1, pagination: !0, paginationNumbers: !1,
    responsive: !0, responsiveRefreshRate: 200, responsiveBaseWidth: g, baseClass: "owl-carousel", theme: "owl-theme", lazyLoad: !1, lazyFollow: !0, lazyEffect: "fade", autoHeight: !1, jsonPath: !1, jsonSuccess: !1, dragBeforeAnimFinish: !0, mouseDrag: !0, touchDrag: !0, addClassActive: !1, transitionStyle: !1, beforeUpdate: !1, afterUpdate: !1, beforeInit: !1, afterInit: !1, beforeMove: !1, afterMove: !1, afterAction: !1, startDragging: !1, afterLazyLoad: !1 };
})(jQuery, window, document);

/***/ }),

/***/ 0:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__("./resources/assets/js/v2/bootstrap.min.js");
__webpack_require__("./resources/assets/js/v2/owl.carousel.min.js");
__webpack_require__("./resources/assets/js/v2/bootstrap-datepicker.js");
__webpack_require__("./resources/assets/js/v2/custom.js");
module.exports = __webpack_require__("./resources/assets/js/v2/jquery.lazyloadxt.min.js");


/***/ })

/******/ });