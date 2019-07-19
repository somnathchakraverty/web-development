var App = angular.module('App', ['ui.router', 'ui.bootstrap', 'ngTagsInput', 'ngStorage', 'facebook', 'googleplus', 'angulartics', 'angulartics.google.analytics','slick', '720kb.socialshare','angularLazyImg', 'naif.base64', 'ngSanitize', 'rzModule']);

App.filter('titleCase', function() {
    return function(input) {
        input = input || '';
        return input.replace(/\w\S*/g, function(txt) {
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase(); 
        });
    };
});


App.filter('getById', function() {
  return function(input, id) {
    var i=0, len=input.length;
    for (; i<len; i++) {
      if (+input[i].id == +id) {
        return input[i];
      }
    }
    return null;
  }
});

App.filter('moment', function() {
    return function(dateString, format) {
        return moment(dateString).format(format);
    };
}).filter('height', function() {
    return function(input) {
    	var a = input.split(".");
        return a[0]+"'"+a[1]+'"';
    };
}).filter('dtime', function() {
    return function(dateString) {
        return moment(dateString).format("hh:mm A");
    };
});

App.filter('ampm', function() {
    return function(value) {
        if (!value) {
            return ''; 
        }
        var temp = value.split(":");
        var hours = temp[0];
        var minutes = temp[1];
        var ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12;
        minutes = minutes < 10 ? '' + minutes : minutes;
        var strTime = hours + ':' + minutes + ' ' + ampm;
        return strTime;
    }
}).filter('num', function() {
    return function(input) {
       return parseInt(input, 10);
    }
});

// here we define our unique filter
App.filter('unique', function() {
   // we will return a function which will take in a collection
   // and a keyname
   return function(collection, keyname) {
      // we define our output and keys array;
      var output = [], 
          keys = [];
      
      // we utilize angular's foreach function
      // this takes in our original collection and an iterator function
      if(collection) {
        angular.forEach(collection, function(item) {
            // we check to see whether our object exists
            var key = item[keyname];
            // if it's not already part of our keys array
            if(keys.indexOf(key) === -1) {
                // add it to our keys array
                keys.push(key); 
                // push this item to our final output array
                output.push(item);
            }
        });
      }
      // return our array which should be devoid of
      // any duplicates
      return output;
   };
});


'use strict';
angular.module('slick', []).directive('slick', [
  '$timeout',
  function ($timeout) {
    return {
      restrict: 'AEC',
      scope: {
        initOnload: '@',
        data: '=',
        currentIndex: '=',
        accessibility: '@',
        adaptiveHeight: '@',
        arrows: '@',
        asNavFor: '@',
        appendArrows: '@',
        appendDots: '@',
        autoplay: '@',
        autoplaySpeed: '@',
        centerMode: '@',
        centerPadding: '@',
        cssEase: '@',
        customPaging: '&',
        dots: '@',
        draggable: '@',
        easing: '@',
        fade: '@',
        focusOnSelect: '@',
        infinite: '@',
        initialSlide: '@',
        lazyLoad: '@',
        onBeforeChange: '&',
        onAfterChange: '&',
        onInit: '&',
        onReInit: '&',
        onSetPosition: '&',
        pauseOnHover: '@',
        pauseOnDotsHover: '@',
        responsive: '=',
        rtl: '@',
        slide: '@',
        slidesToShow: '@',
        slidesToScroll: '@',
        speed: '@',
        swipe: '@',
        swipeToSlide: '@',
        touchMove: '@',
        touchThreshold: '@',
        useCSS: '@',
        variableWidth: '@',
        vertical: '@',
        prevArrow: '@',
        nextArrow: '@'
      },
      link: function (scope, element, attrs) {
        var destroySlick, initializeSlick, isInitialized;
        destroySlick = function () {
          return $timeout(function () {
            var slider;
            slider = $(element);
            slider.slick('unslick');
            slider.find('.slick-list').remove();
            return slider;
          });
        };
        initializeSlick = function () {
          return $timeout(function () {
            var currentIndex, customPaging, slider;
            slider = $(element);
            if (scope.currentIndex != null) {
              currentIndex = scope.currentIndex;
            }
            customPaging = function (slick, index) {
              return scope.customPaging({
                slick: slick,
                index: index
              });
            };
            slider.slick({
              accessibility: scope.accessibility !== 'false',
              adaptiveHeight: scope.adaptiveHeight === 'true',
              arrows: scope.arrows !== 'false',
              asNavFor: scope.asNavFor ? scope.asNavFor : void 0,
              appendArrows: scope.appendArrows ? $(scope.appendArrows) : $(element),
              appendDots: scope.appendDots ? $(scope.appendDots) : $(element),
              autoplay: scope.autoplay === 'true',
              autoplaySpeed: scope.autoplaySpeed != null ? parseInt(scope.autoplaySpeed, 10) : 3000,
              centerMode: scope.centerMode === 'true',
              centerPadding: scope.centerPadding || '50px',
              cssEase: scope.cssEase || 'ease',
              customPaging: attrs.customPaging ? customPaging : void 0,
              dots: scope.dots === 'true',
              draggable: scope.draggable !== 'false',
              easing: scope.easing || 'linear',
              fade: scope.fade === 'true',
              focusOnSelect: scope.focusOnSelect === 'true',
              infinite: scope.infinite !== 'false',
              initialSlide: scope.initialSlide || 0,
              lazyLoad: scope.lazyLoad || 'ondemand',
              beforeChange: attrs.onBeforeChange ? scope.onBeforeChange : void 0,
              onReInit: attrs.onReInit ? scope.onReInit : void 0,
              onSetPosition: attrs.onSetPosition ? scope.onSetPosition : void 0,
              pauseOnHover: scope.pauseOnHover !== 'false',
              responsive: scope.responsive || void 0,
              rtl: scope.rtl === 'true',
              slide: scope.slide || 'div',
              slidesToShow: scope.slidesToShow != null ? parseInt(scope.slidesToShow, 10) : 1,
              slidesToScroll: scope.slidesToScroll != null ? parseInt(scope.slidesToScroll, 10) : 1,
              speed: scope.speed != null ? parseInt(scope.speed, 10) : 300,
              swipe: scope.swipe !== 'false',
              swipeToSlide: scope.swipeToSlide === 'true',
              touchMove: scope.touchMove !== 'false',
              touchThreshold: scope.touchThreshold ? parseInt(scope.touchThreshold, 10) : 5,
              useCSS: scope.useCSS !== 'false',
              variableWidth: scope.variableWidth === 'true',
              vertical: scope.vertical === 'true',
              prevArrow: scope.prevArrow ? $(scope.prevArrow) : void 0,
              nextArrow: scope.nextArrow ? $(scope.nextArrow) : void 0
            });
            slider.on('init', function (sl) {
              if (attrs.onInit) {
                scope.onInit();
              }
              if (currentIndex != null) {
                return sl.slideHandler(currentIndex);
              }
            });
            slider.on('afterChange', function (event, slick, currentSlide, nextSlide) {
              if (scope.onAfterChange) {
                scope.onAfterChange();
              }
              if (currentIndex != null) {
                return scope.$apply(function () {
                  currentIndex = currentSlide;
                  return scope.currentIndex = currentSlide;
                });
              }
            });
            return scope.$watch('currentIndex', function (newVal, oldVal) {
              if (currentIndex != null && newVal != null && newVal !== currentIndex) {
                return slider.slick('slickGoTo', newVal);
              }
            });
          });
        };
        if (scope.initOnload) {
          isInitialized = false;
          return scope.$watch('data', function (newVal, oldVal) {
            if (newVal != null) {
              if (isInitialized) {
                destroySlick();
              }
              initializeSlick();
              return isInitialized = true;
            }
          });
        } else {
          return initializeSlick();
        }
      }
    };
  }
]);