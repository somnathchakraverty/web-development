App.controller('instantbookingController', instantbookingController);
instantbookingController.$inject = ['$scope', 'dataShare', 'dataShare1', '$localStorage', '$filter', '$sessionStorage', '$timeout', '$rootScope', '$location', '$http', '$q', 'BookOrderService', '$state', '$stateParams', 'ConstConfig', '$analytics','$sce'];
function instantbookingController(scope, dataShare, dataShare1, $localStorage, $filter, $sessionStorage, $timeout, $rootScope, $location, $http, $q, BookOrderService, $state, $stateParams, ConstConfig, $analytics,$sce) {

    scope.packageList = [];
    var cityArray = JSON.parse(localStorage.getItem("cityID"));
    if (cityArray === null) {
        localStorage.setItem("cityID", JSON.stringify([{"city_id": "23", "city_name": "Gurgaon"}]));
    }
    scope.contact_number = '';
    scope.email_address = '';
    scope.user_exists = false;
    scope.instant_booking_state = 'addtocart';
    scope.getinstantForm =[];
    scope.timeSlotForm =[];
    scope.slot_id = '';
    scope.SlotError = '';
    scope.couponCode = '';
    scope.firstDateslots = '';
    scope.secondDateslots = '';
    scope.thirdDateslots = '';
    scope.fourthDateslots = '';
    scope.fifthDateslots = '';

    scope.hardcopy_price = 0;

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

    if (isMobile.any()) {
        scope.device = 'mobile';
    }
    else {
        scope.device = 'web';
    }
    
    scope.discount = '';
    scope.payradio ='paytm';
    scope.userDetail = {};
    scope.showBookingLoader = true;
    var token = localStorage.getItem("token");
    scope.token = token;
    var paymentUrl = ConstConfig.paymentUrl;
    scope.mobikwikAction = $sce.trustAsResourceUrl(paymentUrl+'mobikwikpayment');
    scope.payzappAction = $sce.trustAsResourceUrl(paymentUrl+'payzapppayment');
    scope.payuAction = $sce.trustAsResourceUrl(paymentUrl + 'payupayment');
    scope.paytmAction = $sce.trustAsResourceUrl(paymentUrl+'paytmpayment');
    if ($location.search()) {
        scope.name = $location.search().name;
        scope.email_address = $location.search().email;
        scope.phone = $location.search().phone;
        scope.package_id = $location.search().package_id;
    }
    var path =$location.path();
    if(path === '/book/full-body-checkup') {
        scope.static_package_name = 'Healthians Full body checkup with Thyroid Profile';
        scope.static_actual_price = 2850;
        scope.static_healthians_price = 999;
        scope.static_discount = 65;
        scope.package_id='206';
        scope.pdetails = JSON.parse('{"test_details":[{"id":"1","ptype":"profile","name":"Lipid Profile","link_rewrite":"lipid-profile","package_id":"206","tests":[{"profile_id":"1","id":"625","ptype":"parameter","name":"Cholesterol-Total, Serum","link_rewrite":"cholesterol-total-serum"},{"profile_id":"1","id":"1033","ptype":"parameter","name":"HDL Cholesterol Direct","link_rewrite":"hdl-cholesterol-direct"},{"profile_id":"1","id":"1638","ptype":"parameter","name":"LDL Cholesterol -Direct","link_rewrite":"ldl-cholesterol-direct"},{"profile_id":"1","id":"2165","ptype":"parameter","name":"Triglycerides, Serum","link_rewrite":"triglycerides-serum"},{"profile_id":"1","id":"2272","ptype":"parameter","name":"Non - HDL Cholesterol, Serum","link_rewrite":"non-hdl-cholesterol-serum"},{"profile_id":"1","id":"2273","ptype":"parameter","name":"VLDL","link_rewrite":"vldl"},{"profile_id":"1","id":"2274","ptype":"parameter","name":"LDL\/HDL RATIO","link_rewrite":"ldl-hdl-ratio"},{"profile_id":"1","id":"2275","ptype":"parameter","name":"CHOL\/HDL RATIO","link_rewrite":"chol-hdl-ratio"},{"profile_id":"1","id":"2297","ptype":"parameter","name":"HDL \/ LDL Cholesterol Ratio","link_rewrite":"hdl-ldl-cholesterol-ratio"}]},{"id":"2","ptype":"profile","name":"Liver Function Test","link_rewrite":"liver-function-test","package_id":"206","tests":[{"profile_id":"2","id":"135","ptype":"parameter","name":"Albumin, Serum","link_rewrite":"albumin-serum"},{"profile_id":"2","id":"150","ptype":"parameter","name":"Alkaline Phosphatase, Serum","link_rewrite":"alkaline-phosphatase-serum"},{"profile_id":"2","id":"502","ptype":"parameter","name":"Bilirubin Direct, Serum","link_rewrite":"bilirubin-direct-serum"},{"profile_id":"2","id":"504","ptype":"parameter","name":"Bilirubin Total, Serum","link_rewrite":"bilirubin-total-serum"},{"profile_id":"2","id":"970","ptype":"parameter","name":"GGTP (Gamma GT)","link_rewrite":"ggtp-gamma-gt"},{"profile_id":"2","id":"1947","ptype":"parameter","name":"Proteins, Serum","link_rewrite":"proteins-serum"},{"profile_id":"2","id":"2024","ptype":"parameter","name":"SGOT AST","link_rewrite":"sgot-ast"},{"profile_id":"2","id":"2025","ptype":"parameter","name":"SGPT ALT","link_rewrite":"sgpt-alt"},{"profile_id":"2","id":"2269","ptype":"parameter","name":"Bilirubin- Indirect, serum","link_rewrite":"bilirubin-indirect-serum"},{"profile_id":"2","id":"2270","ptype":"parameter","name":"Globulin","link_rewrite":"globulin"},{"profile_id":"2","id":"2271","ptype":"parameter","name":"A\/G Ratio","link_rewrite":"a-g-ratio"},{"profile_id":"2","id":"2302","ptype":"parameter","name":"SGOT\/SGPT Ratio","link_rewrite":"sgot-sgpt-ratio"}]},{"id":"4","ptype":"profile","name":"Thyroid Profile-Total","link_rewrite":"thyroid-profile-total","package_id":"206","tests":[{"profile_id":"4","id":"2097","ptype":"parameter","name":"T3, Total Tri Iodothyronine","link_rewrite":"t3-total-tri-iodothyronine"},{"profile_id":"4","id":"2099","ptype":"parameter","name":"T4, Total Thyroxine","link_rewrite":"t4-total-thyroxine"},{"profile_id":"4","id":"2192","ptype":"parameter","name":"TSH-Ultrasensitive","link_rewrite":"tsh-ultrasensitive"}]},{"id":"6","ptype":"profile","name":"Kidney Function Test","link_rewrite":"kidney-function-test","package_id":"206","tests":[{"profile_id":"6","id":"531","ptype":"parameter","name":"BUN Urea Nitrogen, Serum","link_rewrite":"bun-urea-nitrogen-serum"},{"profile_id":"6","id":"548","ptype":"parameter","name":"Calcium Total, Serum","link_rewrite":"calcium-total-serum"},{"profile_id":"6","id":"621","ptype":"parameter","name":"Chlorides, Serum","link_rewrite":"chlorides-serum"},{"profile_id":"6","id":"696","ptype":"parameter","name":"Creatinine, Serum","link_rewrite":"creatinine-serum"},{"profile_id":"6","id":"1919","ptype":"parameter","name":"Potassium, Serum","link_rewrite":"potassium-serum"},{"profile_id":"6","id":"1947","ptype":"parameter","name":"Proteins, Serum","link_rewrite":"proteins-serum"},{"profile_id":"6","id":"2040","ptype":"parameter","name":"Sodium, Serum","link_rewrite":"sodium-serum"},{"profile_id":"6","id":"2206","ptype":"parameter","name":"Urea, Serum","link_rewrite":"urea-serum"},{"profile_id":"6","id":"2208","ptype":"parameter","name":"Uric Acid, Serum","link_rewrite":"uric-acid-serum"},{"profile_id":"6","id":"2298","ptype":"parameter","name":"BUN\/Creatinine Ratio ","link_rewrite":"bun-creatinine-ratio"},{"profile_id":"6","id":"2299","ptype":"parameter","name":"Urea\/Creatinine Ratio","link_rewrite":"urea-creatinine-ratio"},{"profile_id":"6","id":"2303","ptype":"parameter","name":"EGFR","link_rewrite":"egfr-5"}]},{"id":"7","ptype":"profile","name":"Urine Routine & Microscopy","link_rewrite":"urine-routine-microscopy","package_id":"206","tests":[{"profile_id":"7","id":"1886","ptype":"parameter","name":"pH Urine","link_rewrite":"ph-urine"},{"profile_id":"7","id":"2044","ptype":"parameter","name":"Specific gravity","link_rewrite":"specific-gravity"},{"profile_id":"7","id":"2211","ptype":"parameter","name":"Urobilinogen","link_rewrite":"urobilinogen"},{"profile_id":"7","id":"2276","ptype":"parameter","name":"Colour","link_rewrite":"colour"},{"profile_id":"7","id":"2277","ptype":"parameter","name":"Transparency","link_rewrite":"transparency"},{"profile_id":"7","id":"2279","ptype":"parameter","name":"Albumin","link_rewrite":"albumin"},{"profile_id":"7","id":"2280","ptype":"parameter","name":"Sugar","link_rewrite":"sugar"},{"profile_id":"7","id":"2281","ptype":"parameter","name":"Ketone","link_rewrite":"ketone"},{"profile_id":"7","id":"2283","ptype":"parameter","name":"Bile pigments, urine","link_rewrite":"bile-pigments-urine"},{"profile_id":"7","id":"2285","ptype":"parameter","name":"Red blood cells","link_rewrite":"red-blood-cells"},{"profile_id":"7","id":"2286","ptype":"parameter","name":"Pus cells (Leukocytes)","link_rewrite":"pus-cells-leukocytes"},{"profile_id":"7","id":"2287","ptype":"parameter","name":"Epithelial cells","link_rewrite":"epithelial-cells"},{"profile_id":"7","id":"2288","ptype":"parameter","name":"Crystals","link_rewrite":"crystals"},{"profile_id":"7","id":"2289","ptype":"parameter","name":"Cast","link_rewrite":"cast"},{"profile_id":"7","id":"2290","ptype":"parameter","name":"Bacteria","link_rewrite":"bacteria"},{"profile_id":"7","id":"2291","ptype":"parameter","name":"Yeast cells","link_rewrite":"yeast-cells"},{"profile_id":"7","id":"2304","ptype":"parameter","name":"Nitrate","link_rewrite":"nitrate"}]},{"id":"977","ptype":"parameter","name":"Glucose","link_rewrite":"glucose","package_id":"206"}]}');
		scope.test_count=54;
		
    }
    if(path === '/book/blood-screening-with-lft') {
        scope.static_package_name = 'Basic Blood Screening With LFT';
        scope.static_actual_price = 2100;
        scope.static_healthians_price = 599;
        scope.static_discount = 71;
        scope.package_id='222';
		scope.test_count=39;
        scope.pdetails = JSON.parse('{"test_details":[{"id":"1","ptype":"profile","name":"Lipid Profile","link_rewrite":"lipid-profile","package_id":"222","tests":[{"profile_id":"1","id":"625","ptype":"parameter","name":"Cholesterol-Total, Serum","link_rewrite":"cholesterol-total-serum"},{"profile_id":"1","id":"1033","ptype":"parameter","name":"HDL Cholesterol Direct","link_rewrite":"hdl-cholesterol-direct"},{"profile_id":"1","id":"1638","ptype":"parameter","name":"LDL Cholesterol -Direct","link_rewrite":"ldl-cholesterol-direct"},{"profile_id":"1","id":"2165","ptype":"parameter","name":"Triglycerides, Serum","link_rewrite":"triglycerides-serum"},{"profile_id":"1","id":"2272","ptype":"parameter","name":"Non - HDL Cholesterol, Serum","link_rewrite":"non-hdl-cholesterol-serum"},{"profile_id":"1","id":"2273","ptype":"parameter","name":"VLDL","link_rewrite":"vldl"},{"profile_id":"1","id":"2274","ptype":"parameter","name":"LDL\/HDL RATIO","link_rewrite":"ldl-hdl-ratio"},{"profile_id":"1","id":"2275","ptype":"parameter","name":"CHOL\/HDL RATIO","link_rewrite":"chol-hdl-ratio"},{"profile_id":"1","id":"2297","ptype":"parameter","name":"HDL \/ LDL Cholesterol Ratio","link_rewrite":"hdl-ldl-cholesterol-ratio"}]},{"id":"2","ptype":"profile","name":"Liver Function Test","link_rewrite":"liver-function-test","package_id":"222","tests":[{"profile_id":"2","id":"135","ptype":"parameter","name":"Albumin, Serum","link_rewrite":"albumin-serum"},{"profile_id":"2","id":"150","ptype":"parameter","name":"Alkaline Phosphatase, Serum","link_rewrite":"alkaline-phosphatase-serum"},{"profile_id":"2","id":"502","ptype":"parameter","name":"Bilirubin Direct, Serum","link_rewrite":"bilirubin-direct-serum"},{"profile_id":"2","id":"504","ptype":"parameter","name":"Bilirubin Total, Serum","link_rewrite":"bilirubin-total-serum"},{"profile_id":"2","id":"970","ptype":"parameter","name":"GGTP (Gamma GT)","link_rewrite":"ggtp-gamma-gt"},{"profile_id":"2","id":"1947","ptype":"parameter","name":"Proteins, Serum","link_rewrite":"proteins-serum"},{"profile_id":"2","id":"2024","ptype":"parameter","name":"SGOT AST","link_rewrite":"sgot-ast"},{"profile_id":"2","id":"2025","ptype":"parameter","name":"SGPT ALT","link_rewrite":"sgpt-alt"},{"profile_id":"2","id":"2269","ptype":"parameter","name":"Bilirubin- Indirect, serum","link_rewrite":"bilirubin-indirect-serum"},{"profile_id":"2","id":"2270","ptype":"parameter","name":"Globulin","link_rewrite":"globulin"},{"profile_id":"2","id":"2271","ptype":"parameter","name":"A\/G Ratio","link_rewrite":"a-g-ratio"},{"profile_id":"2","id":"2302","ptype":"parameter","name":"SGOT\/SGPT Ratio","link_rewrite":"sgot-sgpt-ratio"}]},{"id":"7","ptype":"profile","name":"Urine Routine & Microscopy","link_rewrite":"urine-routine-microscopy","package_id":"222","tests":[{"profile_id":"7","id":"1886","ptype":"parameter","name":"pH Urine","link_rewrite":"ph-urine"},{"profile_id":"7","id":"2044","ptype":"parameter","name":"Specific gravity","link_rewrite":"specific-gravity"},{"profile_id":"7","id":"2211","ptype":"parameter","name":"Urobilinogen","link_rewrite":"urobilinogen"},{"profile_id":"7","id":"2276","ptype":"parameter","name":"Colour","link_rewrite":"colour"},{"profile_id":"7","id":"2277","ptype":"parameter","name":"Transparency","link_rewrite":"transparency"},{"profile_id":"7","id":"2279","ptype":"parameter","name":"Albumin","link_rewrite":"albumin"},{"profile_id":"7","id":"2280","ptype":"parameter","name":"Sugar","link_rewrite":"sugar"},{"profile_id":"7","id":"2281","ptype":"parameter","name":"Ketone","link_rewrite":"ketone"},{"profile_id":"7","id":"2283","ptype":"parameter","name":"Bile pigments, urine","link_rewrite":"bile-pigments-urine"},{"profile_id":"7","id":"2285","ptype":"parameter","name":"Red blood cells","link_rewrite":"red-blood-cells"},{"profile_id":"7","id":"2286","ptype":"parameter","name":"Pus cells (Leukocytes)","link_rewrite":"pus-cells-leukocytes"},{"profile_id":"7","id":"2287","ptype":"parameter","name":"Epithelial cells","link_rewrite":"epithelial-cells"},{"profile_id":"7","id":"2288","ptype":"parameter","name":"Crystals","link_rewrite":"crystals"},{"profile_id":"7","id":"2289","ptype":"parameter","name":"Cast","link_rewrite":"cast"},{"profile_id":"7","id":"2290","ptype":"parameter","name":"Bacteria","link_rewrite":"bacteria"},{"profile_id":"7","id":"2291","ptype":"parameter","name":"Yeast cells","link_rewrite":"yeast-cells"},{"profile_id":"7","id":"2304","ptype":"parameter","name":"Nitrate","link_rewrite":"nitrate"}]},{"id":"977","ptype":"parameter","name":"Glucose","link_rewrite":"glucose","package_id":"222"}] }');
    }
    if(path === '/book/blood-screening-with-kft') {
        scope.static_package_name = 'Basic Blood Screening With KFT';
        scope.static_actual_price = 2100;
        scope.static_healthians_price = 599;
        scope.static_discount = 71;
        scope.package_id='223';
		scope.test_count=39;
        scope.pdetails = JSON.parse('{"test_details":[{"id":"1","ptype":"profile","name":"Lipid Profile","link_rewrite":"lipid-profile","package_id":"223","tests":[{"profile_id":"1","id":"625","ptype":"parameter","name":"Cholesterol-Total, Serum","link_rewrite":"cholesterol-total-serum"},{"profile_id":"1","id":"1033","ptype":"parameter","name":"HDL Cholesterol Direct","link_rewrite":"hdl-cholesterol-direct"},{"profile_id":"1","id":"1638","ptype":"parameter","name":"LDL Cholesterol -Direct","link_rewrite":"ldl-cholesterol-direct"},{"profile_id":"1","id":"2165","ptype":"parameter","name":"Triglycerides, Serum","link_rewrite":"triglycerides-serum"},{"profile_id":"1","id":"2272","ptype":"parameter","name":"Non - HDL Cholesterol, Serum","link_rewrite":"non-hdl-cholesterol-serum"},{"profile_id":"1","id":"2273","ptype":"parameter","name":"VLDL","link_rewrite":"vldl"},{"profile_id":"1","id":"2274","ptype":"parameter","name":"LDL\/HDL RATIO","link_rewrite":"ldl-hdl-ratio"},{"profile_id":"1","id":"2275","ptype":"parameter","name":"CHOL\/HDL RATIO","link_rewrite":"chol-hdl-ratio"},{"profile_id":"1","id":"2297","ptype":"parameter","name":"HDL \/ LDL Cholesterol Ratio","link_rewrite":"hdl-ldl-cholesterol-ratio"}]},{"id":"6","ptype":"profile","name":"Kidney Function Test","link_rewrite":"kidney-function-test","package_id":"223","tests":[{"profile_id":"6","id":"531","ptype":"parameter","name":"BUN Urea Nitrogen, Serum","link_rewrite":"bun-urea-nitrogen-serum"},{"profile_id":"6","id":"548","ptype":"parameter","name":"Calcium Total, Serum","link_rewrite":"calcium-total-serum"},{"profile_id":"6","id":"621","ptype":"parameter","name":"Chlorides, Serum","link_rewrite":"chlorides-serum"},{"profile_id":"6","id":"696","ptype":"parameter","name":"Creatinine, Serum","link_rewrite":"creatinine-serum"},{"profile_id":"6","id":"1919","ptype":"parameter","name":"Potassium, Serum","link_rewrite":"potassium-serum"},{"profile_id":"6","id":"1947","ptype":"parameter","name":"Proteins, Serum","link_rewrite":"proteins-serum"},{"profile_id":"6","id":"2040","ptype":"parameter","name":"Sodium, Serum","link_rewrite":"sodium-serum"},{"profile_id":"6","id":"2206","ptype":"parameter","name":"Urea, Serum","link_rewrite":"urea-serum"},{"profile_id":"6","id":"2208","ptype":"parameter","name":"Uric Acid, Serum","link_rewrite":"uric-acid-serum"},{"profile_id":"6","id":"2298","ptype":"parameter","name":"BUN\/Creatinine Ratio ","link_rewrite":"bun-creatinine-ratio"},{"profile_id":"6","id":"2299","ptype":"parameter","name":"Urea\/Creatinine Ratio","link_rewrite":"urea-creatinine-ratio"},{"profile_id":"6","id":"2303","ptype":"parameter","name":"EGFR","link_rewrite":"egfr-5"}]},{"id":"7","ptype":"profile","name":"Urine Routine & Microscopy","link_rewrite":"urine-routine-microscopy","package_id":"223","tests":[{"profile_id":"7","id":"1886","ptype":"parameter","name":"pH Urine","link_rewrite":"ph-urine"},{"profile_id":"7","id":"2044","ptype":"parameter","name":"Specific gravity","link_rewrite":"specific-gravity"},{"profile_id":"7","id":"2211","ptype":"parameter","name":"Urobilinogen","link_rewrite":"urobilinogen"},{"profile_id":"7","id":"2276","ptype":"parameter","name":"Colour","link_rewrite":"colour"},{"profile_id":"7","id":"2277","ptype":"parameter","name":"Transparency","link_rewrite":"transparency"},{"profile_id":"7","id":"2279","ptype":"parameter","name":"Albumin","link_rewrite":"albumin"},{"profile_id":"7","id":"2280","ptype":"parameter","name":"Sugar","link_rewrite":"sugar"},{"profile_id":"7","id":"2281","ptype":"parameter","name":"Ketone","link_rewrite":"ketone"},{"profile_id":"7","id":"2283","ptype":"parameter","name":"Bile pigments, urine","link_rewrite":"bile-pigments-urine"},{"profile_id":"7","id":"2285","ptype":"parameter","name":"Red blood cells","link_rewrite":"red-blood-cells"},{"profile_id":"7","id":"2286","ptype":"parameter","name":"Pus cells (Leukocytes)","link_rewrite":"pus-cells-leukocytes"},{"profile_id":"7","id":"2287","ptype":"parameter","name":"Epithelial cells","link_rewrite":"epithelial-cells"},{"profile_id":"7","id":"2288","ptype":"parameter","name":"Crystals","link_rewrite":"crystals"},{"profile_id":"7","id":"2289","ptype":"parameter","name":"Cast","link_rewrite":"cast"},{"profile_id":"7","id":"2290","ptype":"parameter","name":"Bacteria","link_rewrite":"bacteria"},{"profile_id":"7","id":"2291","ptype":"parameter","name":"Yeast cells","link_rewrite":"yeast-cells"},{"profile_id":"7","id":"2304","ptype":"parameter","name":"Nitrate","link_rewrite":"nitrate"}]},{"id":"977","ptype":"parameter","name":"Glucose","link_rewrite":"glucose","package_id":"223"}]}');

    }
    scope.getuserDetails = function (type, keyword) {
        doPost($http, ConstConfig.serverUrl + "commonservice/getprofiledetails", {
            "keyword": keyword,
            "type": type
        }, "", function (data) {

            if (data.status) {
                scope.name = data.data.name;
                scope.phone = parseInt(data.data.contact_number);
                scope.email_address = data.data.email_address;
                scope.address = data.data.address;
                scope.locality = data.data.locality;
                scope.locality_id = data.data.locality_id;
                scope.address_id = data.data.address_id;
                scope.city_name = data.data.city_name;
                scope.state_id = data.data.state_id;
                scope.state_name = data.data.state_name;
                scope.latitude = data.data.latitude;
                scope.longitude = data.data.longitude;
                scope.pin_code = data.data.pin_code;
                scope.gender = data.data.gender;
                scope.age = parseInt(data.data.age);
                scope.user_id = data.data.user_id;
                scope.billing_user_id = scope.user_id;
                localStorage.setItem("token",data.data.token);
                scope.token = data.data.token;
                doPost($http, ConstConfig.serverUrl + "commonservice/time_slots_post", {"date": scope.availableSlotDates[0].date, "locality_id": scope.locality_id, "amount": scope.deal_price}, data.data.token, function (data) {
                    if(data.data) {
                        scope.firstDateslots = data.data;
                    } else {

                    }
                });
                scope.user_exists = true;
            }
        });
    };
    doPost($http, ConstConfig.serverUrl + "commonservice/getSlotDates", {}, "", function (dateResponse) {
        if (dateResponse.status == "success") {
            scope.availableSlotDates = dateResponse.data;
        } else {
            scope.availableSlotDates = [];
        }
    });
    scope.validateForm = function (form) {

        scope.empty_package=false;
        if(!parseInt(form.instant_package.$viewValue)) {

            scope.invalid_form = true;
            scope.empty_package=true;
            scope.fireInvalidFormEvent(form);
            return false;

        }
        if((form.email_address.$viewValue)) {
            var x = form.email_address.$viewValue
            var atpos = x.indexOf("@");
            var dotpos = x.lastIndexOf(".");
            if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
                scope.invalid_form = true;
                form.email_address.$invalid=true;
                scope.fireInvalidFormEvent(form);
                return false;
            }
        }
        if (form.$valid == false) {
            scope.fireInvalidFormEvent(form);
            scope.invalid_form = true;
        }

        else {
            scope.package_id = parseInt(form.instant_package.$viewValue);
            scope.package_info = $filter('getById')(scope.packageList, scope.package_id);
            scope.deal_price =  scope.package_info.healthians_price;
            scope.pin_code = parseInt(form.pin_code.$viewValue);

            if (!scope.user_id) {
                scope.name = form.name.$viewValue;
                scope.phone = parseInt(form.phone.$viewValue);
                scope.email_address = form.email_address.$viewValue;
                scope.gender = form.gender.$viewValue;
                scope.age = parseInt(form.age.$viewValue);
                scope.hno = form.hno.$viewValue;
                scope.landmark = form.landmark.$viewValue;
                scope.sublocality = form.sublocality.$viewValue;
                scope.address = scope.hno + ',' + scope.landmark + ',' + scope.sublocality;
                scope.relationship = 'self';

                var pdata = {
                    "name": scope.name,
                    "phone": scope.phone,
                    "email_address": scope.email_address,
                    "address": scope.address,
                    "sublocality": scope.sublocality,
                    "locality_id": scope.locality_id,
                    "pin_code": scope.pin_code,
                    "gender": scope.gender,
                    "age": scope.age,
                    "package_id": scope.package_id,
                    "relationship": scope.relationship,
                    "city": scope.city_name,
                    "source": scope.device,                  
                    "hno": scope.hno,
                    "landmark": scope.landmark,
                    "city_id": scope.city_id,
                    "state_id": scope.state_id,
                    "lat": $rootScope.sub_lat,
                    "long": $rootScope.sub_long
                };

                doPost($http, ConstConfig.serverUrl + "commonservice/CheckMarketingusers", pdata, "", function (data) {
                    if (data.status) {
                        scope.user_id = data.data.user_id;
                        $analytics.eventTrack('Success', { category: 'Booking Screen 1', label: scope.name+','+scope.phone+','+scope.email_address});
                        scope.billing_user_id = scope.user_id;
                        scope.address_id = data.data.address_id;
                        localStorage.setItem("token",data.data.token);
                        scope.token = data.data.token;
                        scope.instant_booking_state = 'time_slot';
                        doPost($http, ConstConfig.serverUrl + "commonservice/time_slots_post", {"date": scope.availableSlotDates[0].date, "locality_id": scope.locality_id, "amount": scope.deal_price}, data.data.token, function (data) {
                            if(data.code == 200) {
                                scope.firstDateslots = data.data;
                                scope.instant_booking_state = 'time_slot';
                                $('.nav-tabs').scrollingTabs();
                            }
                        });
                    }
                });

            }
           if(scope.user_id){
               $analytics.eventTrack('Success', { category: 'Booking Screen 1', label: scope.name+','+scope.phone+','+scope.email_address});
               scope.instant_booking_state = 'time_slot';
               $('.nav-tabs').scrollingTabs();
           }
        }

    }
    scope.fireInvalidFormEvent = function (form) {
        $analytics.eventTrack('Failed', { category: 'Booking Screen 1',  label: form.name.$viewValue+','+parseInt(form.phone.$viewValue)+','+form.email_address.$viewValue});
    }

    doPost($http, ConstConfig.serverUrl + "commonservice/getPackages", {"city": scope.city_id}, "", function (data) {
        if (data.status === 'success') {
            scope.packageList = data.data;
        } else {
            scope.errorMessage = 'No Time slot available for this date.';
        }

    });


    scope.getLocalityUsingLatLong = function () {
        var getLocalityURL = ConstConfig.serverUrl + "commonservice/getnearestlocality";
        var requestData = {
            "lat": $rootScope.sub_lat,
            "long": $rootScope.sub_long
        };

        doPost($http, getLocalityURL, requestData, "", function (response) {
            scope.out_of_area = false;
            if (response.status == true) {
                scope.locality_id = response.data.locality_id;
                scope.locality = response.data.locality;
                scope.city_name = response.data.city_name;
                scope.city_id = response.data.city_id;
                scope.state_id = response.data.state_id;
                scope.state_name = response.data.state_name;
                scope.latitude = $rootScope.sub_lat;
                scope.longitude = $rootScope.sub_long;
                scope.pin_code =  parseInt($rootScope.postal_code);
            } else {
                var $form = $('#getinstantForm');
                $form.find('[name=locality]').val('');
                scope.out_of_area = true;
                }
        });

    }
    scope.getDateWiseSlot = function(slotDate, day_num) {
             doPost($http, ConstConfig.serverUrl + "commonservice/time_slots_post", {"date": slotDate, "locality_id": scope.locality_id, "amount": scope.deal_price}, scope.token, function (data) {
            if(data.code == 200) {
                    switch(day_num) {
                            case 1:
                                    scope.firstDateslots = data.data;
                                    break;
                                case 2:
                                    scope.secondDateslots = data.data;
                                    break;
                                case 3:
                                    scope.thirdDateslots = data.data;
                                    break;
                                case 4:
                                    scope.fourthDateslots = data.data;
                                    break;
                                case 5:
                                    scope.fifthDateslots = data.data;
                                    break;
                                default:
                                   break;
                                        }
                                scope.errorMessage = '';
                            } else {
                                scope.errorMessage = 'No Time slot available for this date.';
                            }
                   });
            }

    scope.setTimeSlot = function(selected_time_slot, slot_start_time, slot_end_time){
        if(scope.slot_id === selected_time_slot) {
            scope.SlotError = '';
            scope.slot_id = '';
            return false;
        }
        $(".tab-content  a").removeClass("selected");
        scope.slot_id = selected_time_slot;
        scope.time_slot = {"slot_id": selected_time_slot,"start_time":slot_start_time,"end_time":slot_end_time};
        scope.SlotError = '';
    }
    scope.freezeTimeSlot = function() {
        if(scope.slot_id != '') {
            if(token == null || token == 'undefined' || token =='' ) {
                token = localStorage.getItem("token");
            }
            doPost($http, ConstConfig.serverUrl + "commonservice/freezeSlotBySlotId", {"slot_id": scope.slot_id}, token, function (freezeSlotResponse) {
                if(freezeSlotResponse.code == 200) {
                    scope.instant_booking_state = 'payment';
                    scope.SlotError = '';
                    $analytics.eventTrack('Success', { category: 'Date & Slot screen', label: scope.user_id});
                } else {
                    scope.SlotError = 'Please choose another slot.';
                    $analytics.eventTrack('Failed', { category: 'Date & Slot screen', label: scope.user_id});
                }
            });
        } else {
            scope.SlotError = 'Please select time-slot for sample.';
            $analytics.eventTrack('Failed', { category: 'Date & Slot screen', label: scope.user_id})
            return false;
        }
    }
    scope.verifyCoupon = function(coupon_code) {
        scope.couponDisabled = true;
        if(!coupon_code) {
            scope.couponError = 'Please Enter a coupon code';
            scope.updatePrice();
            return false;
        }
        if(coupon_code.trim() != '') {
            var cpostdata = {
                "data": {
                    "coupon_code" : coupon_code,
                    "customer_id":scope.user_id,
                    "city_id":scope.city_id,
                    "platform": "web",
                    "billing_amount":scope.package_info.healthians_price,
                    "no_of_customer":1,
                    "package":scope.package_id,
                    "profile":"",
                    "parameter":"",
                    "is_online":scope.payradio == 'cash' ? 0 : 1,
                    "payment_gateway":scope.payradio,
                    "customer_mobile":scope.phone,
                    "customer_email":scope.email_address,
                    "apply_discount":0
                }
            };
            $http({
                method: "POST",
                url: ConstConfig.couponUrl + "Coupon_engine_api/CouponApply",
                data : cpostdata,
                headers : { 
                    "Content-Type" : "application/x-www-form-urlencoded; charset=utf-8"
                }
            }).success(function(coupondata){
                if(coupondata.status) {
                    if (coupondata.data.hasOwnProperty("discount")) {
                        scope.couponDisabled = true;
                        scope.coupon_message = 'Coupon applied successfully.';
                        scope.couponError = '';
                        scope.discount = coupondata.data.discount;
                        scope.couponCode = coupon_code;
                        scope.updatePrice();
                        $analytics.eventTrack('Applies coupon', { category: 'Make Payment screen', label: scope.user_id+'-'+scope.couponCode,value:scope.discount });
                    } else {
                        scope.couponDisabled = false;
                        scope.couponError = coupondata.message;
                        scope.coupon_message = '';
                        scope.discount = 0;
                        scope.updatePrice();
                    }
                }
                else {
                    scope.couponDisabled = false;
                    scope.couponError = coupondata.message;
                    scope.coupon_message = '';
                    scope.discount = 0;
                    scope.updatePrice();
                }
            }).error(function(){
                scope.couponDisabled = false;
            });

            // doPost($http, ConstConfig.serverUrl + "Coupon_engine_api/CouponApply",cpostdata, token, function (couponResponse) {
            //     if(couponResponse.data.discount > 0) {
            //         scope.coupon_message = 'Coupon applied successfully.';
            //         scope.couponError = '';
            //         scope.discount = couponResponse.data.discount;
            //         scope.couponCode = coupon_code;
            //         scope.updatePrice();
            //         $analytics.eventTrack('Applies coupon', { category: 'Make Payment screen', label: scope.user_id+'-'+scope.couponCode,value:scope.discount });
            //     } else {
            //         scope.couponError = couponResponse.message;
            //         scope.coupon_message = '';
            //         scope.discount = 0;
            //         scope.updatePrice();
            //     }
            // });
        } else {
            scope.SlotError = 'Please select time-slot for sample.';
            return false;
        }
    }


    scope.finalPay = function() {
        scope.showBookingLoader = false;
        
        scope.address_detail = {
            "address_id":scope.address_id,
            "address" :scope.address,
            "lat":scope.latitude,
            "long":scope.longitude,
            "state_id":scope.state_id,
            "state_name" :scope.state_name,
            "city" :scope.city_name,
            "locality_id" : scope.locality_id,
            "pincode" :scope.pin_code
        };
        
        scope.order_detail = [{
            "user_id":scope.user_id,
            "package":[{
                "tcategory_id" :scope.package_info.tcategory_id,
                "healthians_price":scope.package_info.healthians_price,
                "actaul_price":scope.package_info.actaul_price
                }]
            }];
        
        var post_data = {
            "billing_user_id":scope.billing_user_id,
            "address":scope.address_detail,
            "deal_price":scope.package_info.healthians_price,
            "order_detail":scope.order_detail,
            "time_slot":scope.time_slot, 
            "coupon":scope.couponCode, 
            "discount":scope.discount, 
            "email":scope.email_address,
            "hard_copy" :scope.is_hard_copy,
            "webbooking_type": "instant_booking",
            "booked_from": scope.device
        };

        doPost($http, ConstConfig.serverUrl + "commonservice/bookorder",post_data, token, function (orderResponse) {
            if(orderResponse.status) {
                scope.booking_id = orderResponse.data.booking_id;
                 localStorage.setItem("booking_id",scope.booking_id);
                scope.userDetail.name = scope.name;
                scope.userDetail.mobile = scope.phone;
                scope.userDetail.user_id = scope.user_id;
                scope.userDetail.age = scope.age;
                 localStorage.setItem("userDetail", JSON.stringify(scope.userDetail));
                scope.makePaymentInstant(orderResponse.data.booking_id);
            } else {
                scope.showBookingLoader = true;
            }
        });
    }
    scope.setpayradio = function(payment_mode) {
        scope.payradio = payment_mode;
        $analytics.eventTrack('Selects '+payment_mode, { category: 'Make Payment screen',label:scope.user_id,value:scope.hardcopy_sum_price});
    }

    scope.hardCopyFunc = function() {
        if(scope.hardcopy_price == '') {
            var url = ConstConfig.serverUrl + 'commonservice/get_hard_copy_price';
            doGet($http, url, function(data) {
                $analytics.eventTrack('Checked Hard Copy', { category: 'Make Payment screen' });
                scope.hardcopy_price = data.data.price;
                scope.updatePrice();
                scope.is_hard_copy='yes';
            });
        } else {
            scope.hardcopy_price = '';
            scope.is_hard_copy='no';
            scope.updatePrice();

        }
    }
    scope.updatePrice = function () {

        if (scope.hardcopy_price) {
            scope.hardcopy_sum_price = parseInt(scope.deal_price) + parseInt(scope.hardcopy_price);
        } else {
            scope.hardcopy_sum_price = parseInt(scope.deal_price);
        }
        if(scope.discount) {
            scope.hardcopy_sum_price =parseInt(scope.hardcopy_sum_price) - parseInt(scope.discount);
        }
        else {
            scope.hardcopy_sum_price =parseInt(scope.hardcopy_sum_price);
        }

    }
    scope.makePaymentInstant = function(booking_id) {

        scope.showBookingLoader = false;
        localStorage.setItem("type_of_payment", (scope.payradio == 'cash' ? "Cash on delivery" : "Online"));

        /* For Analytics - Payment Mode */


        scope.loaderVar = true;
        if (scope.hardcopy_price) {
            scope.txnAmount = parseInt(scope.deal_price) + parseInt(scope.hardcopy_price);
        } else {
            scope.txnAmount = parseInt(scope.deal_price);
        }
        if(scope.discount) {
        scope.txnAmount =parseInt(scope.txnAmount) - parseInt(scope.discount);
        }
        else {
            scope.txnAmount =parseInt(scope.txnAmount);
        }
        $analytics.eventTrack('Complete Order', {
            category: 'Make Payment screen',
            label: scope.user_id,
            value:scope.txnAmount
        });
        if (scope.payradio == 'cash') {
            /* Update Payment Type in case of COD */
            /* To Do : Update payment type in non-cod in payment gateway code */
            var codURL = ConstConfig.serverUrl + "commonservice/update_payment_type";
            var codpayload = {
                "booking_id": booking_id,
                "payment_type": (scope.payradio == 'cash' ? "Cash on delivery" : "Online"),
                "term_condition": true,
                "user_id": scope.user_id
            }
            doPost($http, codURL, codpayload, token, function(data) {
                scope.showBookingLoader = false;
                if(data.status) {
                    $state.go('payment-summary', {
                        action:'Get',
                        booking_id:booking_id,
                        mobile:scope.phone,
                        user_id:scope.user_id
                    });
                    scope.confirm_booking = true;
                }
                else {
                    scope.showBookingLoader = true;
                }
            });

        } else if (scope.payradio == 'paytm') {

            localStorage.setItem("makepayment_to_summary", "true");
            var $form = $('#paytmForm');
            $form.find('[name=booking_id]').val(booking_id);
            $form.find('[name=txnAmount]').val(scope.txnAmount);
            $form.find('[name=custName]').val(scope.name);
            $form.find('[name=custMobile]').val(scope.phone);
            $form.find('[name=custEmail]').val(scope.email_address);
            $form.find('[name=user_id]').val(scope.user_id);
            $form.find('[name=stm_id]').val(scope.slot_id);
            $form.submit();
        } else if (scope.payradio == 'mobikwik') {
            localStorage.setItem("makepayment_to_summary", "true");
            var $form = $('#mobikwikForm');
            $form.find('[name=booking_id]').val(booking_id);
            $form.find('[name=txnAmount]').val(scope.txnAmount);
            $form.find('[name=custName]').val(scope.name);
            $form.find('[name=custMobile]').val(scope.phone);
            $form.find('[name=custEmail]').val(scope.email_address);
            $form.find('[name=stm_id]').val(scope.slot_id);
            $form.submit();
        } else if (scope.payradio == 'payu') {

        localStorage.setItem("makepayment_to_summary", "true");
        var $form = $('#payuForm');
        $form.find('[name=booking_id]').val(booking_id);
        $form.find('[name=txnAmount]').val(scope.txnAmount);
        $form.find('[name=custName]').val(scope.name);
        $form.find('[name=custMobile]').val(scope.phone);
        $form.find('[name=custEmail]').val(scope.email_address);
        $form.find('[name=stm_id]').val(scope.slot_id);
        $form.submit();
    }
    scope.hideContinue = false;
    };
}


