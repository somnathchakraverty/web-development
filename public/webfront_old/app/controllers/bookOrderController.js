App.controller('bookOrderController', bookOrderController);
bookOrderController.$inject = ['$scope', '$rootScope', 'BookOrderService', '$http', 'searchDetail', '$element', 'dataShare', 'dataShare1', '$location', '$localStorage', '$sessionStorage', '$q', 'HomeService', '$window', '$filter', '$timeout', 'ConstConfig', '$analytics', '$state', 'cartService'];

function bookOrderController(scope, $rootScope, BookOrderService, $http, searchDetail, element, dataShare, dataShare1, $location, $localStorage, $sessionStorage, $q, HomeService, $window, $filter, $timeout, ConstConfig, $analytics, $state, cartService) {
    scope.popularPackageList = false;
    scope.loginModal = false;
    scope.forgotPwdModal = false;
    scope.signupModal = false;
    scope.changePwdModal = false;
    scope.mobileModal = false;
    scope.firstPageList = [];
    scope.orderList = false;
    scope.userId = null;
    scope.selection = [];
    scope.addToCartModal = false;
    scope.btnshow = false;
    scope.rel = false;
    scope.addNewAddress = false;
    scope.newlocation = false;
    scope.hideSuggestedLocation = false;
    scope.relative = false;
    scope.guestUser = false;
    scope.alertDiv = false;
    scope.samepkg = false;
    scope.addhide = false;
    scope.loggedin = false;
    scope.searchFlag = false;
    scope.addfield = true;
    scope.loc_id = '';
    scope.customSearchVal = "";
    scope.suggestPackageList = [];
    scope.localityList = [];
    scope.customerDetails = [];
    scope.filters = {};
    scope.filters.suggested_test = [];
    scope.searchValue = [];
    $rootScope.selectData = [];
    $rootScope.total = 0;
    scope.cityList = [];
    scope.temp = [];
    scope.member = [];
    scope.noTimeSlot = false;
    scope.amount = 0;
    scope.subtotal = 0;
    scope.displayData = {};
    scope.habitListCheckbox = {};
    scope.displayList = false;
    $rootScope.count = 0;
    scope.flag = false;
    scope.flagSelf = false;
    scope.notificationPeak = false;
    scope.collectiontimeflag = false;
    scope.notification = false;
    scope.customerIndex = undefined;
    scope.loading = true;
    scope.previewDiv = 99;
    //scope.disable = false;
    scope.disableName = false;
    scope.disableRelation = false;
    scope.disablePhone = false;
    scope.disableGender = false;
    scope.viewPkgbox = false;
    //scope.arrayList = [];
    scope.includeList = [];
    scope.pkglimit = 2;
    scope.healthian_package = [];
    scope.customincludeList = [];
    scope.customincludeList1 = [];
    scope.accordionList = [];
    scope.tempUser = [];
    scope.previewList = [];
    scope.RelationShip = [];
    scope.RelationShipwithoutSelf = [];
    scope.pkgNew = [];
    scope.addNewPatient = false;
    scope.addNewPatientSocial = false;

    scope.patientAddErrorDiv = false;
    scope.errorMsg = "";
    localStorage.removeItem("booking_id");

    var widgetIdSEOWEB;
    var widgetIdSEOMOB;


    var isMobile = {
        Android: function() {
                return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
                return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
                return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
                return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
                return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
                return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };

    var cityArray = JSON.parse(localStorage.getItem("cityID"));
    if (cityArray === null) {
        localStorage.setItem("cityID", JSON.stringify([{ "city_id": "23", "city_name": "Gurgaon" }]));
    }

    // scope.$on('data_shared', function() {
    //     scope.customerDetails = dataShare.getData();

    //     if (scope.customerDetails[0].pkg.healthian_price !== 0) {
    //         scope.orderList = true;
    //         $rootScope.count++;
    //         //scope.flag = true;
    //         if (localStorage.getItem("isLogin") != 'true') {
    //             scope.tempUser = JSON.parse(localStorage.getItem("tempUser"));
    //         }
    //         scope.getcustomerForm.sampledate = scope.customerDetails[0].date;
    //         scope.getcustomerForm.location = scope.customerDetails[0].location;
    //         scope.getcustomerForm.sampletime = scope.customerDetails[0].time_slot;
    //         scope.totalAmount();
    //     }
    //     scope.collectiontimeflag = true;
    // });

    if (localStorage.getItem("time_slot") !== null && localStorage.getItem("time_slot") !== "") {
        var opts = { "slot_id": JSON.parse(localStorage.getItem("time_slot")).slot_id };
        BookOrderService.getSlotEmptyById(opts, function(data) {
            localStorage.removeItem("time_slot");
        });
    }

    scope.packageTestList = [];
    scope.showPkgtests = function(obj) {
        scope.packageTestList = [];

        doPostWithOutToken($http, ConstConfig.serverUrl + "commonservice/getTestDetailByGroupId", { "group_id": obj.testId }, "", function(data) {
            if(data.data) {
                scope.packageTestList = data.data;
                scope.display_name = obj.display_name;
                scope.test_include = 0;
                console.log(scope.packageTestList);
                var content_ids=[];
                var contents=[];
                var lengthObj=scope.packageTestList.length;
                var content_type="product";
                scope.packageTestList.forEach(function(element, index) {
                    content_ids.push(element.deal.deal_type+"_"+element.deal.deal_type_id);
                    contents.push({'id': element.deal.deal_type+"_"+element.deal.deal_type_id , 'quantity': 1, 'item_price':element.deal.price});
                    element.tests.forEach(function(ele, index) {
                        if (ele.ptype == 'profile') {
                            scope.test_include += ele.tests.length;
                        } else if (ele.ptype == 'parameter') {
                            scope.test_include += 1;
                        }
                    })
                });

                if (typeof($window.fbq) !== 'undefined') {
                    var fbData=[];
                    fbData['content_ids']=content_ids;
                    fbData['contents']= contents;
                    fbData['content_type']=content_type;
                    fbData['content_category']='Orderbook > View Details';
                    $window.fbq('track', 'ViewContent', fbData);
                }
            }
        });
        scope.viewPkgbox = !scope.viewPkgbox;
    };

    scope.findCityDetail = function(obj) {
        scope.cityObj = [];
        scope.cityObj.push(obj);
        localStorage.setItem("cityID", JSON.stringify(scope.cityObj));
    };

    if (localStorage.getItem("isLogin") == 'true') {
        scope.loggedin = true;
    }


    // for showing front page search result
    scope.frontPageSearchInt = function() {
        scope.tags = searchDetail.getSearchPackages();
        if(scope.tags.length > 0) {
            scope.tags.forEach(function(ele, ind) {
                scope.habitListCheckbox[ele.id] = true;
                scope.searchValue.push({ "text": ele.text, "id": ele.id });
            });

            scope.createSearchRequest();
        }
        else {
            scope.includeList = [];
            scope.customincludeList = [];
            scope.customincludeList1 = [];
            scope.loading = false;
        }
    };

    $rootScope.addTags = function(item) {

        var obj = { "text": item.text, "id": item.id };
        scope.findIndex('searchValue', item.text, "text", function(index) {
            if (index == -1)
                scope.searchValue.push(obj);
        });

    };

    scope.createSearchRequest = function() {
        if (scope.tags.length != 0) {
            scope.searchFlag = true;
        }
        var testList = scope.tags || [];
        var searchList = {
            "filters": { "suggested_test": [], "cities": { "city_id": JSON.parse(localStorage.getItem("cityID"))[0].city_id } },
            "searchValue": testList
        };

        doPostWithOutToken($http, ConstConfig.serverUrl + "search", searchList, "", function(data) {
            scope.radiology = data.data.radiology || [];
            scope.pathology = data.data.pathology || [];

            if (scope.pathology === 0) {
                scope.firstPageList = [];
                scope.accordionList = [];
                scope.includeList = [];
                scope.customincludeList = [];
                scope.customincludeList1 = [];
                scope.healthian_package = [];
            } else {
                scope.includeList = [];
                scope.customincludeList = [];
                scope.customincludeList1 = [];
                scope.loading = false;
                scope.firstPageList = scope.pathology;
                if (scope.firstPageList.healthian_package !== undefined && scope.firstPageList.healthian_package.length > 0) {
                    scope.firstPageList.custom_package = scope.firstPageList.healthian_package[0];
                    scope.customincludeList = scope.firstPageList.custom_package.include_tests;
                    scope.customincludeList1 = scope.firstPageList.custom_package.also_include_tests;
                }
                if (scope.firstPageList.non_healthian_package !== undefined && scope.firstPageList.non_healthian_package.length > 0) {
                    scope.firstPageList.non_healthian_package.forEach(function(ele, ind) {

                        scope.accordionList[ind] = ele;
                        scope.accordionList[ind].tests = scope.testAlreadyInList(ele.tests);
                    });
                }

                if (scope.firstPageList.healthian_package !== undefined) {
                    scope.healthian_package = scope.firstPageList.healthian_package;
                    for (var i = 1; i < scope.pkglimit; i++) {
                        scope.includeList.push(scope.healthian_package[i]);
                    }
                }
                scope.dataforcheckout = scope.pathology;
            }
        });
    };

    scope.viewMore = function() {
        scope.includeList = [];
        scope.pkglimit += 5;
        for (var i = 1; i < scope.pkglimit; i++) {
            if(i<scope.healthian_package.length) {
                scope.includeList.push(scope.healthian_package[i]);
            }            
        }
    };

    // this method is used for adding test and packages from "add more test/package button"
    scope.checkSelection = function($event) {

        var tagValue = $($event.target).find("a").text() || $($event.target).text();
        var tagId = $($event.target).find("a").attr('id') || $($event.target).attr('id');
        var selectedClass = $($event.target).closest("li").hasClass("selectedtest");
        var suggestPackage = $($event.target).closest("li").hasClass("suggestpackage");

        if (selectedClass) {
            scope.findIndex('tags', tagValue, "text", function(index) {
                if (index !== -1) {
                    scope.tags.splice(index, 1);
                    $($event.target).closest("li").removeClass("selectedtest");
                    scope.findIndex('searchValue', tagValue, "text", function(index) {
                        if (index !== -1) {
                            scope.searchValue.splice(index, 1);
                        }
                    });
                }
            });

        } else if (suggestPackage) {
            var obj = { "text": tagValue, "id": tagId };
            scope.findIndex('tags', tagValue, "text", function(index) {
                if (index == -1) {
                    scope.tags.push(obj);
                    scope.searchValue.push(obj);
                    $('li:contains("' + tagValue + '")').addClass("selectedtest");
                }
            });

        } else {
            // var obj = {"text":tagValue} ;
            var obj = { "text": tagValue, "id": tagId };
            scope.findIndex('tags', tagValue, "text", function(index) {
                if (index == -1) {
                    scope.tags.push(obj);
                    scope.searchValue.push(obj);

                    $($event.target).closest("li").addClass("selectedtest");
                }
            });
        }
    };

    scope.showHomeHealthkarma = function() {
        if (isMobile.any()) {
            scope.hide_healthkarma_popup = false;
        }
    }

    /* For Search Auto-Complete */
    scope.loadTags = function(query) {

        if (isMobile.any()) {
            scope.hide_healthkarma_popup = true;
        }

        return $http({
            method: "GET",
            url: ConstConfig.couponUrl + "webv1/web_api/packageSuggestion",
            params: {
                "keyword": query,
                "city_id": JSON.parse(localStorage.getItem("cityID"))[0].city_id
            },
            headers: {
                "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
            }
        }).success(function(data) {
            if (data.data == null) {
                if (isMobile.any()) {
                    scope.hide_healthkarma_popup = true;
                }
                $analytics.eventTrack('Received Zero Suggestions from Auto-suggestor', { category: 'Search', label: query });
            }
        });
    };

    scope.toggleList = function() {
        scope.tags.forEach(function(ele, index) {
            $('.Navpopulartests li:contains("' + ele.text + '")').addClass("selectedtest");
        });

        $('tags-input .tags .tag-item').css({ 'background': '#1b75bc', 'color': 'white' });
        scope.popularPackageList = !scope.popularPackageList;

        if (isMobile.any()) {
            scope.hide_healthkarma_popup = true;
        }

    };

    scope.addToCart = function(data) {
        scope.cartclicked = true;
      
        var tempPkg = angular.copy(data);
        cartService.setTempPackage(tempPkg);

        if (localStorage.getItem("isLogin") == 'true') {
            scope.member = JSON.parse(localStorage.getItem("user")).relatives;
            
            if (scope.member.length !== 0 && ($rootScope.count === 0 || typeof $rootScope.count === "undefined")) {
                scope.tempUser = scope.member;
                localStorage.setItem("tempUser", JSON.stringify(scope.tempUser));
            } else {
                scope.tempUser = JSON.parse(localStorage.getItem("tempUser"));
            }
            scope.addToCartModal = true;

            $analytics.eventTrack('Book to cart', { category: 'My Cart', label: tempPkg.display_name, value: tempPkg.healthian_price });
            $state.go('user_selection_cart');
        } else {
            scope.$$childHead.loginModal = !scope.$$childHead.loginModal;
            scope.$$childHead.signupModal = false;
            scope.$$childHead.loginTab = false;
            scope.$$childHead.signupText = "Continue to Cart";
        }
        scope.temp = data;
    };

    scope.$on('showPatientDialog', function(event, data) {
        
        if (localStorage.getItem("isLogin") == 'true') {
            $rootScope.loggedin = true;

            var name = JSON.parse(localStorage.getItem("user")).name;
            var firstName = name.split(" ");
            $rootScope.user = firstName[0].charAt(0).toUpperCase().concat(firstName[0].substr(1));

            scope.userLoginDetails = JSON.parse(localStorage.getItem("user"));
            if (localStorage.getItem("isSocialLogin") == 'true') {
                if (scope.userLoginDetails.mobile === "") {
                    scope.mobileModal = true;
                } else {
                    scope.mobileModal = false;
                }
            }
            var tempSelectedPackage = cartService.getTempPackage();
            scope.addToCart(tempSelectedPackage);
        }
    });

    scope.customSearch = function() {
        doPostWithOutToken($http, ConstConfig.serverUrl + "commonservice/packageSuggestion", { "keyword": scope.customSearchVal }, "", function(data) {
            scope.suggestPackageList = data.data;
        });
    };


    scope.customLocalitySearch = function(txt) {
        scope.getcustomerForm.sampledate = '';
        scope.getcustomerForm.collectiondate.$dirty = false;
        if (scope.getcustomerForm.location === undefined || scope.getcustomerForm.location === '') {
            scope.getcustomerForm.location = "";
        }
        var opts = { "city_id": JSON.parse(localStorage.getItem("cityID"))[0].city_id, "locality": scope.getcustomerForm.location };

        BookOrderService.getLocalityByCity(opts, function(data) {
            if (data.status == "success") {
                scope.localityList = data.data;
                scope.hideSuggestedLocation = true;
                scope.addNewAddress = false;
                scope.newlocation = false;
            } else if (data.status == "error") {
                if (data.message == "Record not found") {
                    scope.addNewAddress = true;
                    scope.hideSuggestedLocation = false;
                } else {
                    scope.hideSuggestedLocation = false;
                }
            } else {
                scope.addNewAddress = false;
            }
        });
    };

    scope.checkSelection1 = function(row) {
        localStorage.setItem("locality", JSON.stringify(row));
        scope.getcustomerForm.location = row.location_name;
        scope.loc_id = row.loc_id;
        scope.addNewAddress = false;
        scope.hideSuggestedLocation = false;
    };


    scope.testAlreadyInList = function(item) {
        var otherTests = [];
        if (item !== undefined) {
            item.forEach(function(ele, ind1) {
                var index = -1;
                scope.tags.forEach(function(ele1, ind) {
                    var str1 = ele1.text.toString().toUpperCase();
                    var str2 = ele.tcategory_name.toString().toUpperCase();
                    if (str2 == str1) {
                        index = ind;
                    }
                });
                if (index == -1) {
                    otherTests.push(ele);
                }
            });
        }
        return otherTests;
    };

    scope.findIndex = function(array, tagValue, textvalue, call) {
        var index = -1;
        scope[array].forEach(function(ele, ind) {
            if ((tagValue || "").replace(/\s/g, "") === (ele[textvalue] || "").replace(/\s/g, "")) {
                index = ind;
            }
        });
        call(index);
    };

    scope.updateSearch = function() {
        $window.scrollTo(0, angular.element(document.getElementById('topdiv')).offsetTop);
        scope.pkglimit = 2;
        if (scope.searchValue.length != 0) {
            scope.searchFlag = true;
        }
        scope.loading = true;
        scope.filters.suggested_test = $rootScope.selectData || [];

        var search = scope.searchValue || [];
        scope.filters.cities = { "city_id": JSON.parse(localStorage.getItem("cityID"))[0].city_id };
        var searchList = {
            "filters": scope.filters,
            "searchValue": scope.searchValue
        };
        
        if(typeof($window.fbq) !== 'undefined') {
            $window.fbq('track', 'Search', searchList);
        }
        $analytics.eventTrack('Search From Orderbook Page', { category: 'Search', label: searchList });
        
        doPostWithOutToken($http, ConstConfig.serverUrl + "search", searchList, "", function(data) {

            scope.popularPackageList = false;
            scope.includeList = [];
            scope.loading = false;
            scope.customincludeList = [];
            scope.customincludeList1 = [];

            if(data.data) {
                if(_.isEmpty(data.data.pathology)) {
                    scope.firstPageList = [];
                }
                else {
                    scope.firstPageList = data.data.pathology;
                }
                
                if (scope.firstPageList.healthian_package !== undefined && scope.firstPageList.healthian_package.length > 0) {
                    scope.firstPageList.custom_package = scope.firstPageList.healthian_package[0];
                    scope.customincludeList = scope.firstPageList.custom_package.include_tests;
                    scope.customincludeList1 = scope.firstPageList.custom_package.also_include_tests;
                }

                if (scope.firstPageList.non_healthian_package !== undefined && scope.firstPageList.non_healthian_package.length > 0) {
                    scope.firstPageList.non_healthian_package.forEach(function(ele, ind) {
                        scope.accordionList[ind] = ele;
                        scope.accordionList[ind].tests = scope.testAlreadyInList(ele.tests);
                    });
                }

                if (scope.firstPageList.healthian_package !== undefined) {
                    scope.healthian_package = scope.firstPageList.healthian_package;
                    for (var i = 1; i < scope.pkglimit; i++) {
                        scope.includeList.push(scope.healthian_package[i]);
                    }
                }
            }
            
        });
    };


    scope.riskstatus = {};
    scope.habitstatus = {};

    //service call for get all Habits 
    scope.getAllHabits = function() {
        BookOrderService.getAllHabitsDetails(function(data) {
            if (data.status === true) {
                scope.habitList = data.data;
                scope.habitList.forEach(function(ele1, ind) {
                    scope.habitstatus[ele1.id] = false;
                }); 
            }
        });
    };

    scope.habitToggleOpen = function(ic) {
        _.map(scope.habitstatus, function(val, key) {
            if (key === ic) {
                scope.habitstatus[ic] = !scope.habitstatus[ic];
            } else {
                scope.habitstatus[key] = false;
            }
        });
    }

    $timeout(function() {
        angular.element("div.box-content").addClass('removed');
        angular.element("div.box-content").hide(0);
        angular.element(".coupon-handle span").toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
    }, 3000);

   

    //service call for get all risks 
    scope.getAllRiskDetails = function() {
        BookOrderService.getAllRiskDetails(function(data) {
            if (data.status === true) {
                scope.riskgroups = data.data;
                scope.riskgroups.forEach(function(ele1, ind) {
                    scope.riskstatus[ele1.id] = false;
                });
            }
        });
    };

    scope.riskToggleOpen = function(ic) {
        _.map(scope.riskstatus, function(val, key) {
            if (key === ic) {
                scope.riskstatus[ic] = !scope.riskstatus[ic];
            } else {
                scope.riskstatus[key] = false;
            }
        });
    }

    // function for add suggested test
    scope.toggleSelection = function toggleSelection(obj) {
        scope.findIndex('selection', obj.test_name, "test_name", function(index) {
            if (index == -1) {
                scope.selection.push(obj);
                scope.addTest();
            } else {
                scope.selection.splice(index, 1);
                if(!scope.habitListCheckbox[obj.test_id]) {
                    $rootScope.removeTag({"text":obj.test_name, "id": obj.test_id});

                    $rootScope.selectData.forEach(function(rootEle, rootInd) {
                        if (obj.test_name == rootEle.text) {
                            $rootScope.selectData.splice(rootInd, 1);
                        }
                    });

                    scope.findIndex('tags', obj.test_name, "text", function(index) {
                        if (index !== -1) {
                            scope.tags.splice(index, 1);
                            scope.findIndex('searchValue', obj.test_name, "text", function(index) {
                                if (index !== -1) {
                                    scope.searchValue.splice(index, 1);
                                }
                            });
                        }
                    }); 

                }
                else {
                    scope.addTest();
                }          
            }
        });
    };

    scope.addTest = function() {
        $('.added-parameter').slideToggle("fast");
        //$('#fadeOuttest').delay(1000).fadeOut(1000);

        scope.selection.forEach(function(ele, index) {
            var eleExist = -1;
            $rootScope.selectData.forEach(function(rootEle, rootInd) {
                if (ele.test_name == rootEle.text) {
                    eleExist = 1;
                }
            });

            scope.tags.forEach(function(rootEle, rootInd) {
                if (ele.test_name == rootEle.text) {
                    eleExist = 1;
                }
            });

            scope.searchValue.forEach(function(rootEle, rootInd) {
                if (ele.test_name == rootEle.text) {
                    eleExist = 1;
                }
            });

            if (eleExist != 1) {
                $rootScope.selectData.push({ "text": ele.test_name, "id": ele.test_id });
                scope.tags.push({ "text": ele.test_name, "id": ele.test_id });
            }
        });
        scope.updateSearch();
    };

    scope.suggestedListActions = function() {
        scope.hideSuggestedTest = true;
        $('.added-parameter1').slideToggle("fast");
        $('#suggestTestMsg').delay(1000).fadeOut(1000);
    };

    $rootScope.removeTag = function(item) {
        scope.findIndex('searchValue', item.text, "text", function(index) {
            if (index != -1) {
                scope.searchValue.splice(index, 1);
            }
        });

        scope.habitListCheckbox[item.id] = false;
        scope.findIndex('selection', item.text, "test_name", function(index) {
            if (index != -1) {
                scope.selection.splice(index, 1);
                $rootScope.selectData.splice(index, 1);
            }
        });

        $rootScope.selectData.forEach(function(rootEle, rootInd) {
            if (item.text == rootEle.text) {
                $rootScope.selectData.splice(rootInd, 1);
            }
        });

        $timeout(function() {
            scope.updateSearch();
        }, 1000);
    };

    // scope.totalAmount = function() {
    //     scope.amount = 0;
    //     scope.customerDetails.forEach(function(ele, index) {
    //         ele.newpkg.forEach(function(ele1, index) {
    //             scope.amount += parseInt(ele1.healthian_price);
    //         });
    //     });
    //     if (scope.amount == 0) {
    //         scope.orderList = false;
    //         scope.addToCartModal = false;
    //     }
    //     localStorage.setItem("amountfinal", scope.amount);
    // };

    scope.getSubTotal = function(obj, $index) {
        scope.subtotal = 0;
        obj.forEach(function(ele, index) {
            scope.subtotal += parseInt(ele.healthian_price);
        });
        return scope.subtotal;
    };

    scope.getTestIncluedCount = function(obj, $index) {
        var includeCount = obj.include_tests.length;
        var alsoIncludeCount = obj.also_include_tests.length;
        return includeCount + alsoIncludeCount;
    };

    scope.getTestInclued = function(obj, $index) {
        var test = '';
        var temp = '';

        obj.include_tests.forEach(function(ele, index) {
            temp = ele.tcategory_name + ",";
            test += temp;
        });
        obj.also_include_tests.forEach(function(ele1, index1) {
            temp = ele1.tcategory_name + ",";
            test += temp;
        });
        return test;
    };

    /* Count no. of package count */
    scope.getPkgCount = function(obj, $index) {
        scope.testCount = 0;
        obj.newpkg.forEach(function(ele, index) {
            scope.testCount++;
        });
        return scope.testCount;
    };

    /* Used to clear search */
    scope.clearSearch = function() {
        scope.searchValue = [];
        scope.habitListCheckbox = {};
        scope.selection = [];
        $rootScope.selectData = [];
        scope.tags = [];
        $(".populartests li").removeClass("selectedtest");
        scope.updateSearch();
    };


    scope.getPopularPackageTest = function() {
        // load data and call for data load
        $http({
            method: "GET",
            url: ConstConfig.couponUrl + "webv1/web_api/getPopularPackages",
            params: {
                "city": JSON.parse(localStorage.getItem("cityID"))[0].city_name
            },
        }).success(function(data) {
            if(data.data) {
                scope.popularPackages1 = data.data;
            }
            else {
                scope.popularPackages1 = [];
            }
        });

        $http({
            method: "GET",
            url: ConstConfig.couponUrl + "webv1/web_api/getPopulerTests",
            params: {
                "city": JSON.parse(localStorage.getItem("cityID"))[0].city_name
            },
        }).success(function(data) {
            if(data.data) {
                scope.popularTest1 = data.data;
            }
            else {
                scope.popularTest1 = [];
            }
        });

        // doGet($http, ConstConfig.couponUrl + "webv1/web_api/getPopulerTests", function(data) {
        //     if(data.data) {
        //         scope.popularTest1 = data.data;
        //     }
        // });
    }
    
    scope.getPopularPackageTest();

    scope.getAllRiskDetails();
    scope.getAllHabits();
    scope.frontPageSearchInt();
  
    // Reset Coupon data local storage
    scope.coupondata = {};
    localStorage.setItem("coupondata", JSON.stringify(scope.coupondata));

    scope.$on('changeCityDropown', function(event, data) {
        scope.updateSearch();
        scope.getPopularPackageTest();
    });

    scope.closeMobileCallToBookPopup = function() {
        $analytics.eventTrack('Mobile - Call To Book Pop up - Close', { category: 'Mobile Call To Book Pop up' });
        scope.mobileCallToBookPopupDiv = false;
    }
    
    angular.element('#mobileCallToBook_bg').click(function(){
        scope.closeMobileCallToBookPopup();
    });

    scope.closeCallToBookPopup = function() {
        angular.element('#callToBook_bg').fadeOut(0);
        angular.element('#callToBookPopup').slideUp(0);

        $analytics.eventTrack('Call To Book Pop up - Close', { category: 'Call To Book Pop up' });
    }

    angular.element('#callToBook_bg').click(function(){
        scope.closeCallToBookPopup();
    });

    angular.element('#closeCallToBookmodal').click(function(){
        scope.closeCallToBookPopup();
    });

    scope.exitCallToBookError = false;
    scope.mobileCallToBookPopupDiv = false;
    scope.callToBookMobileError = false;
    
    scope.callToBook = function(pkg_name) {
        scope.clickedPackage  = pkg_name;

        if (localStorage.getItem("isLogin") == 'true') {
            var userId = JSON.parse(localStorage.getItem("user")).user_id;

            var requestData = {
                "data":  {
                    "utm_id": 'web-call-to-book',
                    "user_id" : userId,
                    "originator": "orderbook",
                    "source": "web"
                }
            };

            requestData['data']['message'] = 'Customer search for : '+ scope.clickedPackage;

            if (isMobile.any()) {
                requestData['data']['utm_id'] = 'mob-call-to-book';
                requestData['data']['source'] = 'mobile';
                scope.sendDirectDetailsMobile(requestData);
            }
            else {
                scope.sendDirectDetailsDesktop(requestData);
            }
        }
        else {
            if (isMobile.any()) {
                scope.mobileCallToBookPopupDiv = true;

                // if(typeof grecaptcha !== 'undefined') {
                //     if($("#seo_ctb_orderbook_mob").length ==0) {
                //         $('#seo_ctb_mob').html("");
                //         $('<div/>', {id: 'seo_ctb_orderbook_mob'}).appendTo('#seo_ctb_mob');

                //         if(widgetIdSEOMOB == 0) {
                //             grecaptcha.reset(widgetIdSEOMOB);
                //             if($('#seo_ctb_orderbook_mob').length) {
                //                 widgetIdSEOMOB = grecaptcha.render('seo_ctb_orderbook_mob', {'sitekey' : $rootScope.gCatchaKey});
                //             }
                //         }
                //         else {
                //             if($('#seo_ctb_orderbook_mob').length) {
                //                 widgetIdSEOMOB = grecaptcha.render('seo_ctb_orderbook_mob', {'sitekey' : $rootScope.gCatchaKey});
                //             }
                //         }
                //     }                                
                // }

            }
            else {
                angular.element('#callToBookPopup').css('left', ($window.innerWidth/2 - $('#callToBookPopup').width()/2));
                angular.element('#callToBookPopup').css('top', ($window.innerHeight/3 - $('#callToBookPopup').height()/2));

                angular.element('#callToBook_bg').fadeIn(100);
                angular.element('#callToBookPopup').fadeIn(100);
                angular.element("#customerno123").focus();

                // if(typeof grecaptcha !== 'undefined') {
                //     if($("#seo_ctb_orderbook_web").length ==0) {
                        
                //         $('#seo_ctb_web').html("");
                //         $('<div/>', {id: 'seo_ctb_orderbook_web'}).appendTo('#seo_ctb_web');

                //         if(widgetIdSEOWEB == 0) {
                //             grecaptcha.reset(widgetIdSEOWEB);
                //             if($('#seo_ctb_orderbook_web').length) {
                //                 widgetIdSEOWEB = grecaptcha.render('seo_ctb_orderbook_web', {'sitekey' : $rootScope.gCatchaKey});
                //             }
                //         }
                //         else {
                //             if($('#seo_ctb_orderbook_web').length) {
                //                 widgetIdSEOWEB = grecaptcha.render('seo_ctb_orderbook_web', {'sitekey' : $rootScope.gCatchaKey});
                //             }
                //         }
                //     }                                
                // }
            }
        }
        
    }

    scope.changeCallToBookDetailsPopupButtonColor = function() {
        if(scope.customerctbNo) {
            if (scope.customerctbNo.length !== 10 || isNaN(scope.customerctbNo) || scope.customerctbNo === undefined || scope.customerctbNo === '') {
                angular.element("#callToBooksubmitbtn").css('background','#b7b7b7');
                angular.element("#callToBooksubmitbtn").css('border', '1px solid #cecece');
                angular.element("#callToBooksubmitbtn").css('background-image','linear-gradient(to bottom, #b7b7b7 0%, #cecece 100%)');
            }
            else {
                angular.element("#callToBooksubmitbtn").css('background','#e1530d');
                angular.element("#callToBooksubmitbtn").css('border', '1px solid #eaeaea');
                angular.element("#callToBooksubmitbtn").css('background-image','linear-gradient(to bottom, #ff7632 0%, #e1530d 100%)');
            }
        }
    }

    scope.sendCallToBookDetails = function() {
        //var g_recaptcha_response = grecaptcha.getResponse(widgetIdSEOWEB);

        scope.addLeadFormSubmitted = false;

        if (scope.customerctbNo === undefined || scope.customerctbNo === '') {
            scope.addCallToBookLeadForm.customerno123.$dirty = true;
            scope.addCallToBookLeadForm.customerno123.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: 'Call To Book Pop up', label: 'Validation Fail : Mobile no. not enter' });
            return false;
        }  

        if(isNaN(scope.customerctbNo)) {
            scope.ctb_mobile_valid_error = true;
            scope.ctb_mobile_valid_msg = "Enter valid Mobile number";
            $analytics.eventTrack('Validation Fail', { category: 'Call To Book Pop up', label: 'Validation Fail : Not a number' });

            $timeout(function() {
                scope.mobile_valid_error = false;
            }, 2000);
            return false;
        }
        if(scope.customerctbNo.length !== 10) {
            scope.ctb_mobile_valid_error = true;
            scope.ctb_mobile_valid_msg = "Mobile number should be of 10 digits";
            $analytics.eventTrack('Validation Fail', { category: 'Call To Book Pop up', label: 'Validation Fail : Not 10 digits' });

            $timeout(function() {
                scope.mobile_valid_error = false;
            }, 2000);
            return false;
        }

        // if(g_recaptcha_response.length == 0) {
        //     $window.alert("Please check Captcha Checkbox");
        //     return false;
        // }

        var requestData = {
            "data":  {
                "utm_id": 'web-call-to-book',
                "name":scope.customerctbName,
                "mobile":scope.customerctbNo,
                "source": "web",
                "originator": "orderbook"
            }
        };

        if(localStorage.getItem("guid")) {
            requestData['data']['guid'] = localStorage.getItem("guid");
        }

        requestData['data']['message'] = 'Customer search for : '+ scope.clickedPackage;

        var url = ConstConfig.couponUrl + "webv1/web_api/saveEmailCompaignData";
        doPostWithOutToken($http, url, requestData, "", function(data) {
            if (data.status) {
                scope.exitCallToBookError = true;
                if(data.message === 'Lead successfully inserted') {
                    /* For Analytics - Payment Mode */
                    scope.clickedPackage = '';
                    $analytics.eventTrack('Lead Captured', {
                        category: 'Call To Book Pop up',
                        label: scope.customerctbNo,
                    });

                    if(typeof($window.fbq) !== 'undefined') {
                        $window.fbq('track', 'Lead', requestData);
                    }                    
                }

                scope.customerctbName = '';
                scope.customerctbNo = '';   
                scope.Message = '';
                scope.addCallToBookLeadForm.name123.$dirty = false;
                scope.addCallToBookLeadForm.customerno123.$dirty = false;
                scope.ctb_mob_valid_error = false;

                $timeout(function() {
                    scope.exitCallToBookError = false;
                    scope.closeCallToBookPopup();
                }, 4000);
            } else {               
                alert(data.message);
            }
            //grecaptcha.reset(widgetIdSEOWEB);
        });
    }

    scope.sendDirectDetailsDesktop = function(requestData) {
        var url = ConstConfig.couponUrl + "webv1/web_api/sendLoggedInLeadInfo";
        doPostWithOutToken($http, url, requestData, "", function(data) {
            if (data.status) {
                scope.exitCallToBookError = true;
                if(data.message === 'Lead successfully inserted') {
                    /* For Analytics - Payment Mode */
                    scope.clickedPackage = '';
                    $analytics.eventTrack('Lead Captured', {
                        category: 'Call To Book Pop up',
                        label: scope.customerctbNo,
                    });

                    if(typeof($window.fbq) !== 'undefined') {
                        $window.fbq('track', 'Lead', requestData);
                    } 
                }
                scope.Message = '';

                angular.element('#callToBookPopup').css('left', ($window.innerWidth/2 - $('#callToBookPopup').width()/2));
                angular.element('#callToBookPopup').css('top', ($window.innerHeight/3 - $('#callToBookPopup').height()/2));

                angular.element('#callToBook_bg').fadeIn(100);
                angular.element('#callToBookPopup').fadeIn(100);
                angular.element("#customerno123").focus();

                $timeout(function() {
                    scope.exitCallToBookError = false;
                    scope.closeCallToBookPopup();
                }, 4000);

            } else {
                alert(data.message);
            }
        });

    }

    scope.changeMobileCallToBookPopupButtonColor = function() {
        if(scope.ctbcustomerNo) {
            if (scope.ctbcustomerNo.length !== 10 || isNaN(scope.ctbcustomerNo) || scope.ctbcustomerNo === undefined || scope.ctbcustomerNo === '') {
                angular.element("#ctbmobilepopupsubmitbtn").css('background','#b7b7b7');
                angular.element("#ctbmobilepopupsubmitbtn").css('border', '1px solid #cecece');
    			angular.element("#ctbmobilepopupsubmitbtn").css('background-image','linear-gradient(to bottom, #b7b7b7 0%, #cecece 100%)');
    			
            }
            else {
                angular.element("#ctbmobilepopupsubmitbtn").css('background','#e1530d');
                angular.element("#ctbmobilepopupsubmitbtn").css('border', '1px solid #eaeaea');
    			angular.element("#ctbmobilepopupsubmitbtn").css('background-image','linear-gradient(to bottom, #ff7632 0%, #e1530d 100%)');
            }
        }
    }

    scope.sendDirectDetailsMobile = function(requestData) {
        var url = ConstConfig.couponUrl + "webv1/web_api/sendLoggedInLeadInfo";
        doPostWithOutToken($http, url, requestData, "", function(data) {
            if (data.status) {
                scope.callToBookMobileError = true;
                if(data.message === 'Lead successfully inserted') {
                    /* For Analytics - Payment Mode */
                    scope.clickedPackage = '';
                    $analytics.eventTrack('Lead Captured', {
                        category: 'Mobile Call To Book Pop up',
                        label: scope.customerctbNo,
                    });

                    if(typeof($window.fbq) !== 'undefined') {
                        $window.fbq('track', 'Lead', requestData);
                    } 
                }
                scope.Message = '';
                scope.mobileCallToBookPopupDiv = true;

                $timeout(function() {
                    scope.callToBookMobileError = false;
                    scope.closeMobileCallToBookPopup();
                }, 4000);

            } else {
                alert(data.message);
            }
        });

    }

    scope.sendMobileCTBPopupDetails = function() {
        //var g_recaptcha_response = grecaptcha.getResponse(widgetIdSEOMOB);

        scope.addLeadFormSubmitted = false;

        if (scope.ctbcustomerNo === undefined || scope.ctbcustomerNo === '') {
            scope.addMobileCTBPopupLeadForm.ctbcustomerno.$dirty = true;
            scope.addMobileCTBPopupLeadForm.ctbcustomerno.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: 'Mobile Call To Book Pop up', label: 'Validation Fail : Mobile no. not enter' });
            return false;
        }

        if (isNaN(scope.ctbcustomerNo)) {
            scope.ctb_mob_valid_error = true;
            scope.ctb_mob_valid_msg = "Enter valid Mobile number";
            $analytics.eventTrack('Validation Fail', { category: 'Mobile Call To Book Pop up', label: 'Validation Fail : Not a number' });

            $timeout(function() {
                scope.ctb_mob_valid_error = false;
            }, 2000);
            return false;
        }
        if (scope.ctbcustomerNo.length !== 10) {
            scope.ctb_mob_valid_error = true;
            scope.ctb_mob_valid_msg = "Mobile number should be of 10 digits";
            $analytics.eventTrack('Validation Fail', { category: 'Mobile Call To Book Pop up', label: 'Validation Fail : Not 10 digits' });

            $timeout(function() {
                scope.ctb_mob_valid_error = false;
            }, 2000);
            return false;
        }

        // if(g_recaptcha_response.length == 0) {
        //     $window.alert("Please check Captcha Checkbox");
        //     return false;
        // }

        var requestData = {
            "data": {
                "utm_id": 'mob-call-to-book',
                "name": scope.ctbcustomerName,
                "mobile": scope.ctbcustomerNo,
                "originator": "orderbook",
                "source": "mobile"
            }
        };

        requestData['data']['message'] = 'Customer search for : '+ scope.clickedPackage;

        if(localStorage.getItem("guid")) {
            requestData['data']['guid'] = localStorage.getItem("guid");
        }

        var url = ConstConfig.couponUrl + "webv1/web_api/saveEmailCompaignData";
        doPostWithOutToken($http, url, requestData, "", function(data) {
            if (data.status) {
                scope.callToBookMobileError = true;
                 /* Pixel Fire in case of new number */
                if(data.message === 'Lead successfully inserted') {
                    scope.clickedPackage = '';
                    /* For Analytics - Payment Mode */
                    $analytics.eventTrack('Lead Captured', {
                        category: 'Mobile Call To Book Pop up',
                        label: scope.ctbcustomerNo,
                    });

                    if(typeof($window.fbq) !== 'undefined') {
                        $window.fbq('track', 'Lead', requestData);
                    }                    
                }

                scope.ctbcustomerName = '';
                scope.ctbcustomerNo = '';
                scope.addMobileCTBPopupLeadForm.ctbname.$dirty = false;
                scope.addMobileCTBPopupLeadForm.ctbcustomerno.$dirty = false;

                $timeout(function() {
                    scope.callToBookMobileError = false;
                    scope.closeMobileCallToBookPopup();
                }, 4000);
            } else {                
                alert(data.message);
            }
            //grecaptcha.reset(widgetIdSEOMOB);
        });
    }
}

