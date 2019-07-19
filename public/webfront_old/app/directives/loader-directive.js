App.directive('loading', function() {
    return {
        restrict: 'E',
        replace: true,
        // template: '<div class="loading"><img src="http://www.nasa.gov/multimedia/videogallery/ajax-loader.gif" width="120" height="120" /><br><br><h2>LOADING...</h2></div>',
        template: '<div class="loader initial"></div>',
        link: function(scope, element, attr) {
            scope.$watch('loading', function(val) {
                if (val)
                    $(element).show();
                else
                    $(element).hide();
            });
        }
    }
});

App.directive('googleplace', function($rootScope) {
    return {
        require: 'ngModel',
        link: function(scope, element, attrs, model) {
            var options = {
                types: [],
                componentRestrictions: {country: "in"}
            };
            scope.gPlace = new google.maps.places.Autocomplete(element[0], options);
            var geocoder = new google.maps.Geocoder();

            google.maps.event.addListener(scope.gPlace, 'place_changed', function() {
                scope.sublocalityDropDownSelected = true;
                scope.distanceError = false;
                var place = scope.gPlace.getPlace();
                if (!place.geometry) {
                    window.alert("Autocomplete's returned place contains no geometry");
                    return;
                }
                var cityDropDown = JSON.parse(localStorage.getItem("cityID"))[0].city_name;
                place.address_components.forEach(function(ele, ind) {
                    if (ele.types[0] == "postal_code") {
                        scope.postal_code = ele.long_name;
                        $rootScope.postal_code = scope.postal_code;
                    }
                    if (ele.types[0] === "locality" || ele.types[0] === "administrative_area_level_3") {
                        scope.sub_city = ele.short_name.toLowerCase();
                        $rootScope.sub_city = scope.sub_city;
                    }
                });

                scope.sub_lat = place.geometry.location.lat();
                scope.sub_long = place.geometry.location.lng();

                $rootScope.sub_lat = scope.sub_lat;
                $rootScope.sub_long = scope.sub_long;

                // if (!scope.ignoreGeoCodeLocality) {
                //     scope.distanceBetweenLocSubloc = getDistanceFromLatLonInKm(scope.sub_lat, scope.sub_long, scope.loc_lat, scope.loc_long);

                //     if (scope.distanceBetweenLocSubloc <= 8) {
                //         scope.distanceError = false;
                //     } else {
                //         scope.distanceError = true;
                //         scope.distanceErrorMsg = "Please choose another sub-locality because distance b/w locality and sub-locality is more than 8 Kms";
                //     }
                // } else {
                // if our locality not in google search then we ignore distance restriction 
                // but atleast sublocality is in same city

                if (cityDropDown.toLowerCase() !== scope.sub_city && scope.addAddressForm) {
                    var cityList = JSON.parse(localStorage.getItem("cityList"));
                    if (scope.sub_city === 'gurugram') {
                        scope.distanceError = false;
                        
                        cityList.forEach(function(ele, ind) {
                            if(ele.city_name.toLowerCase() === 'gurgaon') {
                                scope.searchCity = scope.sub_city;
                                localStorage.setItem("cityID", JSON.stringify([{ "city_id": ele.city_id, "city_name": ele.city_name }]));
                            }
                        });
                    } 
                    else if (scope.sub_city === 'new delhi') {
                        scope.distanceError = false;
                        
                        cityList.forEach(function(ele, ind) {
                            if(ele.city_name.toLowerCase() === 'delhi') {
                                scope.searchCity = scope.sub_city;
                                localStorage.setItem("cityID", JSON.stringify([{ "city_id": ele.city_id, "city_name": ele.city_name }]));
                            }
                        });
                    }
                    else {
                        scope.distanceError = false;
                        cityList.forEach(function(ele, ind) {
                            if(ele.city_name.toLowerCase() ===  scope.sub_city) {
                                scope.searchCity = scope.sub_city;
                                localStorage.setItem("cityID", JSON.stringify([{ "city_id": ele.city_id, "city_name": ele.city_name }]));
                            }
                        });
                        //scope.searchCity = scope.sub_city;
                        // scope.distanceError = true;
                        // scope.sublocalityDropDownSelected = false;
                        // scope.distanceErrorMsg = "Please choose locality of " + cityDropDown + " city";
                        // scope.chosenPlace = "";
                        // element.val("");
                        // scope.addAddressForm.pacinput.$dirty = false;
                    }
                }

                scope.getLocalityUsingLatLong();

                /* Formula to calculate distance between two geocodes */
                function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
                    var R = 6371; // Radius of the earth in km
                    var dLat = deg2rad(lat2 - lat1); // deg2rad below
                    var dLon = deg2rad(lon2 - lon1);
                    var a =
                        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                        Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
                        Math.sin(dLon / 2) * Math.sin(dLon / 2);
                    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                    var d = R * c; // Distance in km
                    return d;
                }

                function deg2rad(deg) {
                    return deg * (Math.PI / 180)
                }

                scope.tempsublocality = element.val();

                scope.$apply(function() {
                    model.$setViewValue(element.val());
                });
            });
        }
    };
});

App.directive('googleplaceaddress', function($rootScope) {
    return {
        require: 'ngModel',
        link: function(scope, element, attrs, model) {
            var options = {
                types: [],
                componentRestrictions: {country: "in"}
            };
            scope.gPlace = new google.maps.places.Autocomplete(element[0], options);
            var geocoder = new google.maps.Geocoder();

            google.maps.event.addListener(scope.gPlace, 'place_changed', function() {
                
    
                var place = scope.gPlace.getPlace();
                if (!place.geometry) {
                    window.alert("Autocomplete's returned place contains no geometry");
                    return;
                }
                var cityDropDown = JSON.parse(localStorage.getItem("cityID"))[0].city_name;
                place.address_components.forEach(function(ele, ind) {
                    if (ele.types[0] == "postal_code") {
                        scope.postal_code = ele.long_name;
                        $rootScope.postal_code = scope.postal_code;
                    }
                    if (ele.types[0] === "locality" || ele.types[0] === "administrative_area_level_3") {
                        scope.sub_city = ele.short_name.toLowerCase();
                        $rootScope.sub_city = scope.sub_city;
                    }
                });

                scope.sep_sub_lat = place.geometry.location.lat();
                scope.sep_sub_long = place.geometry.location.lng();
                scope.selected_address_id = element.attr('data-address');
                scope.sublocalityDropDownSelected[scope.selected_address_id] = true;


                $rootScope.sep_sub_lat = scope.sep_sub_lat;
                $rootScope.sep_sub_long = scope.sep_sub_long;
                $rootScope.selected_address_id = scope.selected_address_id;

             

                if (cityDropDown.toLowerCase() !== scope.sub_city) {
                    var cityList = JSON.parse(localStorage.getItem("cityList"));
                    if (scope.sub_city === 'gurugram') {
                        scope.distanceError[scope.selected_address_id] = false;
                        
                        cityList.forEach(function(ele, ind) {
                            if(ele.city_name.toLowerCase() === 'gurgaon') {
                                scope.searchCity = scope.sub_city;
                                localStorage.setItem("cityID", JSON.stringify([{ "city_id": ele.city_id, "city_name": ele.city_name }]));
                            }
                        });
                    } 
                    else if (scope.sub_city === 'new delhi') {
                        scope.distanceError[scope.selected_address_id] = false;
                        
                        cityList.forEach(function(ele, ind) {
                            if(ele.city_name.toLowerCase() === 'delhi') {
                                scope.searchCity = scope.sub_city;
                                localStorage.setItem("cityID", JSON.stringify([{ "city_id": ele.city_id, "city_name": ele.city_name }]));
                            }
                        });
                    }
                    else {
                        scope.distanceError[scope.selected_address_id] = false;
                        cityList.forEach(function(ele, ind) {
                            if(ele.city_name.toLowerCase() ===  scope.sub_city) {
                                scope.searchCity = scope.sub_city;
                                localStorage.setItem("cityID", JSON.stringify([{ "city_id": ele.city_id, "city_name": ele.city_name }]));
                            }
                        });
                    }
                }
                scope.getLocalityUsingLatLong();
                
                scope.tempsublocality = element.val();

                scope.$apply(function() {
                    model.$setViewValue(element.val());
                });
            });
        }
    };
});

App.directive('googleplaceseperate', function($rootScope) {
    return {
        require: 'ngModel',
        link: function(scope, element, attrs, model) {
            var options = {
                types: [],
                componentRestrictions: {country: "in"}
            };
            scope.gPlace = new google.maps.places.Autocomplete(element[0], options);
            var geocoder = new google.maps.Geocoder();

            google.maps.event.addListener(scope.gPlace, 'place_changed', function() {
                scope.sublocalityDropDownSelectedSeperate = true;
                scope.distanceErrorSeperate = false;
                var place = scope.gPlace.getPlace();
                if (!place.geometry) {
                    window.alert("Autocomplete's returned place contains no geometry");
                    return;
                }
                var cityDropDown = JSON.parse(localStorage.getItem("cityID"))[0].city_name;
                place.address_components.forEach(function(ele, ind) {
                    if (ele.types[0] == "postal_code") {
                        //console.log("postal code", ele.long_name);
                        scope.postal_code = ele.long_name;
                        $rootScope.postal_code = scope.postal_code;
                        scope.postal_code_new = scope.postal_code;
                    }
                    if (ele.types[0] === "locality" || ele.types[0] === "administrative_area_level_3") {
                        scope.sub_city = ele.short_name.toLowerCase();
                        $rootScope.sub_city = scope.sub_city;
                    }
                });

                scope.sub_lat = place.geometry.location.lat();
                scope.sub_long = place.geometry.location.lng();

                $rootScope.sub_lat = scope.sub_lat;
                $rootScope.sub_long = scope.sub_long;

                if (cityDropDown.toLowerCase() !== scope.sub_city && scope.addAddressForm) {
                    var cityList = JSON.parse(localStorage.getItem("cityList"));
                    if (scope.sub_city === 'gurugram') {
                        scope.distanceError = false;
                        
                        cityList.forEach(function(ele, ind) {
                            if(ele.city_name.toLowerCase() === 'gurgaon') {
                                scope.searchCity = scope.sub_city;
                                localStorage.setItem("cityID", JSON.stringify([{ "city_id": ele.city_id, "city_name": ele.city_name }]));
                            }
                        });
                    } 
                    else if (scope.sub_city === 'new delhi') {
                        scope.distanceErrorSeperate = false;
                        
                        cityList.forEach(function(ele, ind) {
                            if(ele.city_name.toLowerCase() === 'delhi') {
                                scope.searchCity = scope.sub_city;
                                localStorage.setItem("cityID", JSON.stringify([{ "city_id": ele.city_id, "city_name": ele.city_name }]));
                            }
                        });
                    }
                    else {
                        scope.distanceErrorSeperate = false;
                        cityList.forEach(function(ele, ind) {
                            if(ele.city_name.toLowerCase() ===  scope.sub_city) {
                                scope.searchCity = scope.sub_city;
                                localStorage.setItem("cityID", JSON.stringify([{ "city_id": ele.city_id, "city_name": ele.city_name }]));
                            }
                        });
                    }
                }

                scope.getLocalityUsingLatLongSeperate();

                scope.tempsublocality = element.val();

                scope.$apply(function() {
                    model.$setViewValue(element.val());
                });
            });
        }
    };
});

App.directive('fileModel', ['$parse', function($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.fileModel);
            var modelSetter = model.assign;

            scope.imageIsLoadedcover = function(e) {
                scope.$apply(function() {
                    var fullPath = document.getElementById('uploadDoc').value;
                    scope.opts = { "name": fullPath.split(/(\\|\/)/g).pop(), "doc": e.target.result };
                });
            };

            element.bind('change', function() {
                scope.$apply(function() {
                    var reader = new FileReader();
                    reader.onload = scope.imageIsLoadedcover;
                    reader.readAsDataURL(element[0].files[0]);
                    // modelSetter(scope, element[0].files[0]);
                });
            });
        }
    };
}]);

//for sticky search on order detail page

App.directive('setClassWhenAtTop', function($window) {
    var $win = angular.element($window); // wrap window object as jQuery object

    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var topClass = attrs.setClassWhenAtTop, // get CSS class from directive's attribute value
                offsetTop = element.offset().top; // get element's top relative to the document

            $win.on('scroll', function(e) {
                if ($win.scrollTop() >= offsetTop) {
                    element.addClass(topClass);
                } else {
                    element.removeClass(topClass);
                }
            });
        }
    };
});

App.directive('ngEnter', function() {
    return function(scope, element, attrs) {
        element.bind("keydown keypress", function(event) {
            if (event.which === 13) {
                scope.$apply(function() {
                    scope.$eval(attrs.ngEnter);
                });
                event.preventDefault();
            }
        });
    };
});

App.directive("ngMobileClick", [function () {
    return function (scope, element, attrs) {
        element.bind("touchstart click", function (event) {
            event.preventDefault();
            event.stopPropagation();

            scope.$apply(attrs["ngMobileClick"]);
        });
    }
}]);

App.directive("copyToClipboard", copyClipboardDirective);
    function copyClipboardDirective() {
        var clip;
        function link(scope, element) {
            function clipboardSimulator() {
                var self = this,
                    textarea,
                    container;
                function createTextarea() {
                    if (!self.textarea) {
                        container = document.createElement('div');
                        container.id = 'simulate-clipboard-container';
                        container.setAttribute('style', ['position: fixed;', 'left: 0px;', 'top: 0px;', 'width: 0px;', 'height: 0px;', 'z-index: 100;', 'opacity: 0;', 'display: block;'].join(''));
                        document.body.appendChild(container);
                        textarea = document.createElement('textarea');
                        textarea.setAttribute('style', ['width: 1px;', 'height: 1px;', 'padding: 0px;'].join(''));
                        textarea.id = 'simulate-clipboard';
                        self.textarea = textarea;
                        container.appendChild(textarea);
                    }
                }
                createTextarea();
            }
            clipboardSimulator.prototype.copy = function() {
                this.textarea.innerHTML = '';
                this.textarea.appendChild(document.createTextNode(scope.textToCopy));
                //this.textarea.focus();//
                this.textarea.select();
                setTimeout(function() {
                    document.execCommand('copy');
                    //document.getElementById('cclip').style.display = 'block';
                }, 20);
               // setTimeout(function() {
               //     document.getElementById('cclip').style.display = 'none';
               // },4000);
            };
            clip = new clipboardSimulator();
            element[0].addEventListener('click', function() {
                clip.copy();
            });
        }
        return {
            restrict: 'A',
            link: link,
            scope: {
                textToCopy: '='
            }
        };
    };

App.directive('profilefileModel', ['$parse', function($parse) {
    return {
        restrict: 'A',
        scope: { someCtrlFn: '&callbackFn', opts: "="},
        link: function(scope, element, attrs) {
            scope.imageIs = function(e) {
                scope.$apply(function() {
                    var fullPath = document.getElementById('uploadDoc').value;
                    scope.opts = { "name": fullPath.split(/(\\|\/)/g).pop(), "doc": e.target.result };
                    scope.someCtrlFn(scope.opts);
                });
            };

            element.bind('change', function() {
                scope.$apply(function() {
                    var reader = new FileReader();
                    reader.onload = scope.imageIs;
                    reader.readAsDataURL(element[0].files[0]); 
                });
            });
            
        }
    };
}]);

App.directive('compileTemplate', function($compile, $parse){
    return {
        link: function(scope, element, attr){
            var parsed = $parse(attr.ngBindHtml);
            function getStringValue() {
                return (parsed(scope) || '').toString();
            }

            // Recompile if the template changes
            scope.$watch(getStringValue, function() {
                // The -9999 makes it skip directives so that we do not recompile ourselves
                $compile(element, null, -9999)(scope);  
            });
        }
    }
});