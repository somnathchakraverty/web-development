App.controller('dashboardController', dashboardController);
dashboardController.$inject = ['$scope', '$rootScope', '$location', '$anchorScroll', 'DashboardService', 'BookOrderService', '$timeout', '$window', 'cartService', 'ConstConfig', '$http'];

function dashboardController(scope, $rootScope, $location, $anchorScroll, DashboardService, BookOrderService, $timeout, $window, cartService, ConstConfig, $http) {
    scope.editProfile = false;
    scope.familyList = [];
    scope.nodata = false;
    scope.selection = [];

    scope.heghtInInches = 0;
    scope.addGlucose = false;
    scope.userAge = 0;
    scope.addBP = false;
    scope.subscribe = false;

    scope.loaderVar = true;
    
    scope.reorderReport = false;
    scope.reportSharemsgflag = false;
    scope.nodataReport = false;
  
    scope.slotFlag = false;
    scope.dayFlag = false;
    scope.orderDetail = false;
    
    scope.userWeight = '';
    scope.report = {};
    scope.userDetail = {};
    scope.loaderVar1 = true;
    scope.customerDetails = {};
    scope.bookingEveryList = [{ value: "01" }, { value: "02" }, { value: "03" }, { value: "04" }, { value: "05" }, { value: "06" }, { value: "07" }, { value: "08" }, { value: "09" }, { value: "10" }, { value: "11" }, { value: "12" }, { value: "13" }, { value: "14" }, { value: "15" }, { value: "16" }, { value: "17" }, { value: "18" }, { value: "19" }, { value: "20" }, { value: "21" }, { value: "22" }, { value: "23" }, { value: "24" }, { value: "25" }, { value: "26" }, { value: "27" }, { value: "28" }, { value: "29" }, { value: "30" }];
    scope.repeatDate = '03';
    scope.userBooking = { repeat: 'month' };
    scope.bmr = scope.bmi = scope.profilecomplete = 0;


    // Token
    var token = localStorage.getItem("token");

    scope.heightList = [{ id: "24", value: "2'0\"" }, { id: "25", value: "2'1\"" }, { id: "26", value: "2'2\"" }, { id: "27", value: "2'3\"" }, { id: "28", value: "2'4\"" }, { id: "29", value: "2'5\"" }, { id: "30", value: "2'6\"" }, { id: "31", value: "2'7\"" }, { id: "32", value: "2'8\"" }, { id: "33", value: "2'9\"" }, { id: "34", value: "2'10\"" }, { id: "35", value: "2'11\"" }, { id: "36", value: "3'0\"" }, { id: "37", value: "3'1\"" }, { id: "38", value: "3'2\"" }, { id: "39", value: "3'3\"" }, { id: "40", value: "3'4\"" }, { id: "41", value: "3'5\"" }, { id: "42", value: "3'6\"" }, { id: "43", value: "3'7\"" }, { id: "44", value: "3'8\"" }, { id: "45", value: "3'9\"" }, { id: "46", value: "3'10\"" }, { id: "47", value: "3'11\"" }, { id: "48", value: "4'0\"" }, { id: "49", value: "4'1\"" }, { id: "50", value: "4'2\"" }, { id: "51", value: "4'3\"" }, { id: "52", value: "4'4\"" }, { id: "53", value: "4'5\"" }, { id: "54", value: "4'6\"" }, { id: "55", value: "4'7\"" }, { id: "56", value: "4'8\"" }, { id: "57", value: "4'9\"" }, { id: "58", value: "4'10\"" }, { id: "59", value: "4'11\"" }, { id: "60", value: "5'0\"" }, { id: "61", value: "5'1\"" }, { id: "62", value: "5'2\"" }, { id: "63", value: "5'3\"" }, { id: "64", value: "5'4\"" }, { id: "65", value: "5'5\"" }, { id: "66", value: "5'6\"" }, { id: "67", value: "5'7\"" }, { id: "68", value: "5'8\"" }, { id: "69", value: "5'9\"" }, { id: "70", value: "5'10\"" }, { id: "71", value: "5'11\"" }, { id: "72", value: "6'0\"" }, { id: "73", value: "6'1\"" }, { id: "74", value: "6'2\"" }, { id: "75", value: "6'3\"" }, { id: "76", value: "6'4\"" }, { id: "77", value: "6'5\"" }, { id: "78", value: "6'6\"" }, { id: "79", value: "6'7\"" }, { id: "80", value: "6'8\"" }, { id: "81", value: "6'9\"" }, { id: "82", value: "6'10\"" }, { id: "83", value: "6'11\"" }, { id: "84", value: "7'0\"" }, { id: "85", value: "7'1\"" }, { id: "86", value: "7'2\"" }, { id: "87", value: "7'3\"" }, { id: "88", value: "7'4\"" }, { id: "89", value: "7'5\"" }, { id: "90", value: "7'6\"" }, { id: "91", value: "7'7\"" }, { id: "92", value: "7'8\"" }, { id: "93", value: "7'9\"" }, { id: "94", value: "7'10\"" }, { id: "95", value: "7'11\"" }]; // data for height
    scope.userHeightFeetList = [{ value: "2" }, { value: "3" }, { value: "4" }, { value: "5" }, { value: "6" }, { value: "7" }, { value: "8" }];
    scope.userHeightInchList = [{ value: "0" }, { value: "1" }, { value: "2" }, { value: "3" }, { value: "4" }, { value: "5" }, { value: "6" }, { value: "7" }, { value: "8" }, { value: "9" }, { value: "10" }, { value: "11" }];

    //get user data
    scope.getdashboardData = function() {
        if (localStorage.getItem("isLogin") == 'true') {
            var log_user_id = JSON.parse(localStorage.getItem("user")).user_id;
            var opts = { "user_id": log_user_id , "log_user_id": log_user_id};
        } else {
            var opts = { "user_id": "" };
        }

        DashboardService.getmyProfileData(opts, function(data) {
            if (data.status === true) {
                scope.profileData = data.data;
                scope.userBloodType = scope.profileData.user_detail.blood_group;
                scope.userWeight = scope.profileData.user_detail.weight;
                scope.userHeight = scope.profileData.user_detail.height;
                scope.heghtInInches = scope.profileData.user_detail.height;
                scope.userCompanyName = scope.profileData.user_detail.company;
                scope.userInsuranceCompany = scope.profileData.user_detail.insurance_company;
                scope.username = scope.profileData.user_detail.name;
                scope.userage = scope.profileData.user_detail.age;
                scope.usergender = scope.profileData.user_detail.gender;
                scope.city = scope.profileData.user_detail.city;
                scope.country = scope.profileData.user_detail.country_name;
                scope.familyList = scope.profileData.family_member;
                if(scope.profileData.user_detail.image !== 0) {
                    scope.stepsModel = decodeURIComponent(scope.profileData.user_detail.image);
                }
                
                scope.userEmail = scope.profileData.user_detail.email_address;
                scope.userContact = scope.profileData.user_detail.contact_number;
                scope.country_code = scope.profileData.user_detail.country_code;
                scope.userWaist = scope.profileData.user_detail.waist;
                scope.loaderVar = false;

                if (scope.userContact !== '') {
                    scope.userContactDisabled = true;
                } else {
                    scope.userContactDisabled = false;
                }
            }
             else if (data.status === "error") {
                if(data.code == 'TOKEN_EXPIRED' || data.code == 'INVALID_TOKEN' || data.code == 'AUTH_FAILED') {
                    $rootScope.$broadcast('tokenExpired');
                }
            }
        });
    };
    scope.getdashboardData();

    // Edit user detail
    scope.profileEdit = function() {
        scope.editProfile = true;
        var feet = parseInt(parseInt(scope.userHeight) / 12);
        var inch = parseInt(scope.userHeight) % 12;
        scope.userHeightFeet = feet.toString();
        scope.userHeightInch = inch.toString();
    };

    // Edit user detail
    scope.cancelEdit = function() {
        scope.editProfile = false;
        scope.getdashboardData();
    };

    //getting height value on change
    scope.getHeight = function() {
        scope.heghtInInches = (parseInt(scope.userHeightFeet) * 12) + parseInt(scope.userHeightInch);
    };

    //update user details
    scope.updateData = [];
    scope.updateProfile = function(isValid) {
        if (isValid) {
            scope.bmiCalculator();
            scope.bmrCalculator();
            scope.editProfile = false;
            var log_user_id = JSON.parse(localStorage.getItem("user")).user_id;
            var opts = {
                "log_user_id": log_user_id,
                "userId": log_user_id,
                "bloodtype": scope.userBloodType,
                "weight": scope.userWeight ? scope.userWeight : "",
                "age": scope.userage,
                "gender": scope.usergender,
                "height": scope.heghtInInches,
                "waist": scope.userWaist ? scope.userWaist : "",
                "companyname": scope.userCompanyName ? scope.userCompanyName : "",
                "insurancecompany": scope.userInsuranceCompany ? scope.userInsuranceCompany : "",
                "email": scope.userEmail,
                "mobile": scope.userContact
            };

            DashboardService.updateProfile(opts, function(data) {
                if (data.status === true) {
                    scope.updateData = data.data;
                    scope.userBloodType = scope.updateData.blood_group;
                    scope.userWeight = scope.updateData.weight;
                    scope.userHeight = scope.updateData.height;
                    scope.heghtInInches = scope.updateData.height;
                    scope.userCompanyName = scope.updateData.company;
                    scope.usergender = scope.updateData.gender;
                    scope.userage = scope.updateData.age;
                    scope.userInsuranceCompany = scope.updateData.insurance_company;
                    scope.userEmail = scope.updateData.email_address;
                    scope.userContact = scope.updateData.contact_number;
                    scope.userWaist = scope.updateData.waist;
                    scope.bmiCalculator();
                    scope.profileComplete();
                    scope.profileData.user_detail.gender = scope.updateData.gender;
                    scope.profileData.user_detail.age = scope.updateData.age;

                    if (scope.userContact !== '') {
                        scope.userContactDisabled = true;
                    } else {
                        scope.userContactDisabled = false;
                    }

                    var local = JSON.parse(localStorage.getItem("user"));
                    local.relatives.forEach(function(ele, index) {
                        if (ele.name === scope.username) {
                            ele.gender = scope.usergender;
                            ele.age = scope.userage
                        }
                    });
                    localStorage.setItem("user", JSON.stringify(local));
                    
                    scope.cartData = cartService.getCartDetails();
                    if(scope.cartData.length > 0){
                        scope.cartData.forEach(function(ele, index) {
                            if (ele.name == scope.username) {
                                scope.cartData[index].gender = scope.updateData.gender;
                                scope.cartData[index].age = scope.updateData.age;
                            }
                        });
                        cartService.setCartDetails(scope.cartData);
                    }
                }
            });
        }
    };

    //anchor link on same page
    // scope.gotoMyBooking = function() {
    //     scope.history = false;
    //     //$location.hash('mybooking');
    //     $anchorScroll('mybooking');
    //     $('#booking').addClass('selected');
    //     $('#report').removeClass('selected');
    // };

    // scope.gotoReport = function() {
    //     scope.history = true;
    //     //$location.hash('myreport');
    //     $anchorScroll('myreport');
    //     $('#report').addClass('selected');
    //     $('#booking').removeClass('selected');
    // };

    // scope.$on('my-booking', function(event, args) {
    //     scope.history = false;
    //     $anchorScroll('mybooking');
    //     $('#booking').addClass('selected');
    //     $('#report').removeClass('selected');
    // });

    // profile image upload
    scope.stepsModel = '';

    scope.imageUpload = function(element) {
        //console.log(element);
        var reader = new FileReader();
        reader.onload = scope.imageIsLoaded;
        reader.readAsDataURL(element.files[0]);
    };

    scope.imageIsLoaded = function(opt) {
        // scope.$apply(function() {
        //     // scope.stepsModel = e.target.result;
        //     // $('body').append($('<img />').attr('src', e.target.result));
            var fullPath = document.getElementById('uploadDoc').value;
            var log_user_id = JSON.parse(localStorage.getItem("user")).user_id;
            var opts = {
                "name": fullPath.split(/(\\|\/)/g).pop(),
                "image": opt,
                "user_id": log_user_id,
                "log_user_id" : log_user_id
            };

            DashboardService.uploadImage(opts, function(data) {
                if (data.status === true) {
                    scope.stepsModel = data.data.image;
                    scope.profileComplete();
                }
                else {
                    $window.alert(data.message);
                }
            });
        //});
    };

    // cover image upload
    scope.coverImage = '';

    scope.imageUploadcover = function(element) {
        var reader = new FileReader();
        reader.onload = scope.imageIsLoadedcover;
        reader.readAsDataURL(element.files[0]);
    };

    scope.imageIsLoadedcover = function(e) {
        scope.$apply(function() {
            //  scope.coverImage = e.target.result;
            // $('body').append($('<img />').attr('src', e.target.result));
            var log_user_id = JSON.parse(localStorage.getItem("user")).user_id;
            var fullPath = document.getElementById('uploadcover').value;
            var opts = {
                "name": fullPath.split(/(\\|\/)/g).pop(),
                "image": e.target.result,
                "user_id": log_user_id,
                "log_user_id": log_user_id
            };

            DashboardService.uploadCoverImage(opts, function(data) {
                if (data.status === true) {
                    scope.coverImage = data.data.image;
                }
            });
        });
    };

    // function to calculate BMI
    scope.bmiCalculator = function() {
        if (scope.userWeight !== '' && scope.heghtInInches !== '') {
            var meter = ((scope.heghtInInches * 0.025) * (scope.heghtInInches * 0.025));
            var num = scope.userWeight / meter;
            scope.bmi = Math.round(num * 100) / 100;
        } else {
            scope.bmi = 0;
        }
    };

    // function to calculate BMR
    scope.bmrCalculator = function() {
        var num;
        if (scope.userWeight !== '' && scope.heghtInInches !== '') {
            if (scope.usergender == "F") {
                num = ((10 * scope.userWeight) + (6.25 * (scope.heghtInInches * 2.54)) - (5 * scope.userage)) - 161;
            } else {
                num = ((10 * scope.userWeight) + (6.25 * (scope.heghtInInches * 2.54)) - (5 * scope.userage)) + 5;
            }
            scope.bmr = Math.round(num * 100) / 100;
        } else {
            scope.bmr = 0;
        }
    };

    $timeout(function() {
        scope.bmiCalculator();
        scope.bmrCalculator();
        scope.profileComplete();
    }, 3000);

    // function for profile completeness
    scope.profileComplete = function() {
        scope.profilecomplete = 0;

        if (scope.userBloodType !== '') {
            scope.profilecomplete += 10;
        }
        if (scope.userWeight !== '') {
            scope.profilecomplete += 10;
        }
        if (scope.userHeight !== '') {
            scope.profilecomplete += 10;
        }
        if (scope.userCompanyName !== '') {
            scope.profilecomplete += 10;
        }
        if (scope.userInsuranceCompany !== '') {
            scope.profilecomplete += 10;
        }
        if (scope.stepsModel) {
            scope.profilecomplete += 10;
        }
        if (scope.userEmail !== '') {
            scope.profilecomplete += 5;
        }
        if (scope.userContact !== '') {
            scope.profilecomplete += 10;
        }
        if (scope.bmi !== 0) {
            scope.profilecomplete += 5;
        }
        if (scope.userWaist) {
            scope.profilecomplete += 10;
        }
        if (scope.usergender) {
            scope.profilecomplete += 5;
        }
        if (scope.userage !== "0") {
            scope.profilecomplete += 5;
        }
    };
    
    $rootScope.$on("update_mobile", function() {
        scope.userContact = JSON.parse(localStorage.getItem("user")).mobile;
        if (scope.userContact !== '') {
            scope.userContactDisabled = true;
        } else {
            scope.userContactDisabled = false;
        }
    });
}
