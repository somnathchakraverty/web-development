App.controller('healthtestController', healthtestController);
healthtestController.$inject = ['$scope', '$timeout', '$rootScope', '$location', '$http', '$stateParams', 'ConstConfig', 'HomeService', '$window', '$analytics', '$interval', '$state'];

function healthtestController(scope, $timeout, $rootScope, $location, $http, $stateParams, ConstConfig, HomeService, $window, $analytics, $interval, $state) {

    $rootScope.meta_robots = 'noindex, nofollow';
    
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

    scope.stateParms = $stateParams;
    scope.ga_category = 'web-health-test-campaign';

    if (scope.stateParms) {
        if(scope.stateParms.link_rewrite) {
            if(scope.stateParms.link_rewrite === "liver-function-test") {
                scope.display_name = 'Liver Function Test';
                scope.display_order_price = 'Price Starting <span class="fontrupee rs_class" >`</span> 250';
                scope.display_image = 'assets/images/campaign/liver-function-test.jpg';
                
                scope.display_data = [{
                    "headline": "Measures levels of ",
                    "data": [
                        'Protein', 'Liver enzymes', 'Bilirubin in the blood.'
                    ]
                },
                {
                    "headline": "Helps to Diagnose:",
                    "data": [
                        'Viral Hepatitis(A,B,C)', 'Cirrhosis', 'Alcoholic liver disease', 'Effects of few medicines'
                    ]
                }];
            }
            else if(scope.stateParms.link_rewrite === "kidney-function-test") {
                scope.display_name = 'Kidney Function Test';
                scope.display_order_price = 'Price Starting @ <span class="fontrupee rs_class" >`</span> 250';
                scope.display_image = 'assets/images/campaign/kidney-test.jpg';
                
                scope.display_data = [{
                    "headline": "Tests required in case of:",
                    "data": [
                        'Urinary Tract Infection (UTI)','Diabetes', 'High blood pressure (BP)', 'Kidney Stones', 'Excessive use of pain killers', 'Frequent urination', 'Blood & pain while passing Urine', 'Swelling of hands and feet'
                    ]
                }];
            }
            else if(scope.stateParms.link_rewrite === "lipid-profile-test") {
                scope.display_name = 'Lipid Profile/Cholesterol';
                scope.display_order_price = 'Price Starting @ <span class="fontrupee rs_class" >`</span> 300';
                scope.display_image = 'assets/images/campaign/lipid-profile.jpg';
                scope.display_data = [{
                    "headline": "",
                    "data": [
                        'Measures abnormalities in: Cholesterol, Triglycerides',
                        'Assesses the risk of Heart Diseases',
                        'Monitors the effectiveness of the treatment'
                    ]
                }];
            }
            else if(scope.stateParms.link_rewrite === "thyroid-profile") {
                scope.display_name = 'Thyroid Function Test';
                scope.display_order_price = 'Price Starting @  <span class="fontrupee rs_class" >`</span> 270';
                scope.display_image = 'assets/images/campaign/Thyroid-test.jpg';
                scope.display_data = [{
                    "headline": "Helps to Diagnose:",
                    "data": [
                        'Hyperthyroidism - with symptoms like: Weight Loss, Anxiety, Menstrual problems, Cardiac problems, Tremors',
                        'Hypothyroidism - with symptoms like: Weight gain, Lack of energy, Depression, Menstrual problems'
                    ]
                }];
            }
            else if(scope.stateParms.link_rewrite === "HbA1c") {
                scope.display_name = 'HbA1c Test';
                scope.display_order_price = 'Price Starting @ <span class="fontrupee rs_class" >`</span> 350';
                scope.display_image = 'assets/images/campaign/HbA1c.jpg';
                
                scope.display_data = [{
                    "headline": "",
                    "data": [
                        'Best test to detect Diabetes',
                        'Measures average blood glucose level for 3 months before the test',
                        'Monitors diabetes management over a period of time'
                    ]
                }];
            }
            else if(scope.stateParms.link_rewrite === "vitamin-test") {
                scope.display_name = 'Vitamin Test <span class="span_sub_test">(Vitamin D3, Vitamin B12)</span>';
                scope.display_order_price = 'Package Startig @ <span class="fontrupee rs_class" >`</span> 999	';
                scope.display_image = 'assets/images/campaign/Vitamin-B12.jpg';
                scope.display_data = [{
                    "headline": "Vitamin D test helps to detect:",
                    "data": [
                        'Vitamin D Deficiency',
                        'Bone Weakness',
                        'Bone malfunctions']
                    },
                    {
                        "headline": "Vitamin B12 test helps to:",
                        "data": [
                            'Monitor the level of Vitamin B12 in the blood',
                            'Low levels of Vitamin B12 can cause: Nerve damage, Deterioration in brain functions, Decrease in blood cell production causing Anaemia'
                            ]
                    }];
            }
            else if(scope.stateParms.link_rewrite === "senior-citizen-package") {
                scope.display_name = 'Senior Citizen Package';
                scope.display_order_price = 'Health Check-up starting @ <span class="fontrupee rs_class" >`</span> 1299';
                scope.display_image = 'assets/images/campaign/senior-citizen-package.jpg';
                scope.display_data = [{
                    "headline": "",
                    "data": [
                        'Package especially designed for Senior Citizens.',
                        'Helps to diagnose common chronic illness like Diabetes, Cholesterol, Thyroid, Kidney & Liver problems.',
                        'Monitors effectiveness of ongoing treatment.']
                    }];
            }
			 else if(scope.stateParms.link_rewrite === "iron-studies") {
                scope.display_name = 'Iron Studies';
                scope.display_order_price = 'Price Starting @ <span class="fontrupee rs_class" >`</span> 390';
                scope.display_image = 'assets/images/campaign/iron-studies.jpg';
                scope.display_data = [{
                    "headline": "",
                    "data": [
                        'Measures Iron level in the body.',
                        'Deficiency of iron can cause Anaemia.',
                        'Excess iron can damage Heart, Pancreas, Liver & Skin']
                    }];
            }
			else if(scope.stateParms.link_rewrite === "complete-hemogram") {
                scope.display_name = 'Complete Hemogram';
                scope.display_order_price = 'Price Starting @ <span class="fontrupee rs_class" >`</span> 200';
                scope.display_image = 'assets/images/campaign/complete-hemogram.jpg';
                scope.display_data = [{
                    "headline": "Helps to detect & monitor treatment of:",
                    "data": [
                        'Anaemia',
                        'Infections',
                        'Inflammation',
						'Leukaemia (Blood Cancer)']
                    }];
            }
			else if(scope.stateParms.link_rewrite === "dengue-test") {
                scope.display_name = 'Dengue Test';
                scope.display_order_price = 'Complete Package @ <span class="fontrupee rs_class" >`</span> 999';
                scope.display_image = 'assets/images/campaign/Malaria.jpg';
                scope.display_data = [{
                    "headline": "Includes 3 tests:",
                    "data": [
                        'Dengue IgG Antibody- for detection of past antibody',
                        'Dengue IgM Antibody – for detection of recent infection',
                        'Dengue NS1 Antigen - for detection on first day of fever']
                    }];
            }
			else if(scope.stateParms.link_rewrite === "cancer-test") {
                scope.display_name = 'Cancer Test';
                scope.display_order_price = 'Complete Package @ <span class="fontrupee rs_class" >`</span> 2899';
                scope.display_image = 'assets/images/campaign/Cancer.jpg';
                scope.display_data = [{
                    "headline": "",
                    "data": [
                        'PSA : To screen prostate cancer in males,<br>to monitor effectiveness of treatment',
                        'CA-125 : Tumor marker to diagnose Ovarian cancer',
						'CA- 19.9 Serum : Tumor marker to diagnose Colon & Pancreatic Cancer',
                        'CA-15.3 : Tumor marker to diagnose Breast Cancer']
                    }];
            }
			else if(scope.stateParms.link_rewrite === "std-package") {
                scope.display_name = 'STD Package';
                scope.display_order_price = 'Complete Package @ <span class="fontrupee rs_class" >`</span> 899';
                scope.display_image = 'assets/images/campaign/STD-Package.jpg';
                scope.display_data = [{
                    "headline": "Healthians is officially recognized by NACO to conduct HIV test.<br>Includes tests to diagnose STD’s like:",
                    "data": [
                        'Hepatitis B & C',
                        'Syphilis',						
                        'HIV',
						'<span class="secret">* Complete secrecy will be maintained</span>']
                    }];
            }
			else if(scope.stateParms.link_rewrite === "pancreas-pancreatitis-package") {
                scope.display_name = 'Pancreas | Pancreatitis Package';
                scope.display_order_price = 'Complete Package @ <span class="fontrupee rs_class" >`</span> 1399';
                scope.display_image = 'assets/images/campaign/kidney-test.jpg';
                scope.display_data = [{
                    "headline": "Includes tests to determine:",
                    "data": [
                        'Pancreatic disorders (damage or inflammation)',                        					
                        'Pancreatitis']
                    }];
            }
			else if(scope.stateParms.link_rewrite === "arthritis-test") {
                scope.display_name = 'Arthritis Test';
                scope.display_order_price = 'Complete Package @ <span class="fontrupee rs_class" >`</span> 999';
                scope.display_image = 'assets/images/campaign/Arthritis.jpg';
                scope.display_data = [{
                    "headline": "Test required to:",
                    "data": [
                        'Know the root cause behind joint pains & swellings',                        					
                        'Measure effectiveness of treatment of Rheumatoid Arthritis']
                    }];
            }
			else if(scope.stateParms.link_rewrite === "heart-checkup") {
                scope.display_name = 'Heart Checkup';
                scope.display_order_price = 'Complete Package @ <span class="fontrupee rs_class" >`</span> 899';
                scope.display_image = 'assets/images/campaign/heart.jpg';
                scope.display_data = [{
                    "headline": "To screen the risk of Coronary Artery Diseases & Heart Attack<br>Recommended in cases of: ",
                    "data": [
                        'Obesity',
						'Sedentary Lifestyle',
						'Alcohol Consumption',                        					
                        'High Homocysteine levels',
						'Family history of heart diseases']
                    }];
            }
			else if(scope.stateParms.link_rewrite === "chikungunya-test") {
                scope.display_name = 'Chikungunya Test';
                scope.display_order_price = 'Price Starting @ <span class="fontrupee rs_class" >`</span> 600';
                scope.display_image = 'assets/images/campaign/Malaria.jpg';
                scope.display_data = [{
                    "headline": "",
                    "data": [
                        'Required for detection of Chikungunya infection']
                    }];
            }
			else if(scope.stateParms.link_rewrite === "typhoid-test") {
                scope.display_name = 'Typhoid Test';
                scope.display_order_price = 'Price Starting @ <span class="fontrupee rs_class" >`</span> 330';
                scope.display_image = 'assets/images/campaign/Cancer.jpg';
                scope.display_data = [{
                    "headline": "Recommended to diagnose typhoid fever<br> Medically advised incase of:",
                    "data": [
                        'High fever',
						'Abdominal pain',
						'Headaches',
						'Rose spots'
						]
                    }];
            }
			else if(scope.stateParms.link_rewrite === "malaria-test") {
                scope.display_name = 'Malaria Test';
                scope.display_order_price = 'Price Starting @ <span class="fontrupee rs_class" >`</span> 350';
                scope.display_image = 'assets/images/campaign/Malaria.jpg';
                scope.display_data = [{
                    "headline": "",
                    "data": [
                        'Malarial Antigen',
						'Vivax & Falciparum tests are a group of rapid diagnostic tests for quick diagnosis of malaria'
						]
                    }];
            }
			else if(scope.stateParms.link_rewrite === "basic-female-hormones") {
                scope.display_name = 'Basic Female Hormones';
                scope.display_order_price = 'Package Starting @ <span class="fontrupee rs_class" >`</span> 899';
                scope.display_image = 'assets/images/campaign/Basic-Female-Hormones.jpg';
                scope.display_data = [{
                    "headline": "This package monitors the important female hormones, levels of which are responsible for:",
                    "data": [
                        'Ovulation',
						'Menstrual cycles',
						'Fertilisation',
						'Conception',
						'Infertility cases'						
						]
                    }];
            }
			
            else {
                $state.go('home');
            }
        }
        else {
            $state.go('home');
        }
        scope.utmid = scope.stateParms.utmid;

        if(typeof scope.stateParms.email !== 'undefined') {
            scope.customerEmail = scope.stateParms.email
        }
        if(typeof scope.stateParms.name !== 'undefined') {
            scope.customerName = scope.stateParms.name;
        }
        if(typeof scope.stateParms.mobile !== 'undefined') {
            scope.customerNo = scope.stateParms.mobile;
        }

        if(scope.utmid == 'ucb') {
            var newScript = document.createElement('script');
            newScript.type = 'text/javascript';
            newScript.id = 'ucb_id';
            document.getElementsByTagName("head")[0].append(newScript);

            angular.element("#ucb_id").append('(function(w, d, t, s, q, m, n) { if (w.utq) return; q = w.utq = function() { q.process ? q.process(arguments) : q.queue.push(arguments); }; q.queue = []; m = d.getElementsByTagName(t)[0]; n = d.createElement(t); n.src = s; n.async = true; m.parentNode.insertBefore(n, m); })(window, document, "script", "https://pixel-insight.ucweb.com/ucads/utracking.js");utq("init", "43282752605257935");utq("set", "trackurl", "pixel-insight.ucweb.com/intl_utrace");utq("track", "PageView");');
        }

        if(scope.utmid == 'quora') {
            var newScript = document.createElement('script');
            newScript.type = 'text/javascript';
            newScript.id = 'quora_id';
            document.getElementsByTagName("head")[0].append(newScript);

            var newScript1 = document.createElement('noscript');
            newScript1.type = 'text/javascript';
            newScript1.id = 'noscript_quora_id';
            document.getElementsByTagName("head")[0].append(newScript1);

            angular.element("#quora_id").append('!function(q,e,v,n,t,s){if(q.qp) return; n=q.qp=function(){n.qp?n.qp.apply(n,arguments):n.queue.push(arguments);}; n.queue=[];t=document.createElement(e);t.async=!0;t.src=v; s=document.getElementsByTagName(e)[0]; s.parentNode.insertBefore(t,s);}(window, "script", "https://a.quora.com/qevents.js");qp("init", "bb9ba203758241a094941b86a559f3fe");qp("track", "ViewContent");');
            angular.element("#noscript_quora_id").append('<img height="1" width="1" style="display:none" src="https://q.quora.com/_/ad/bb9ba203758241a094941b86a559f3fe/pixel?tag=ViewContent&noscript=1"/>');
        }
    }

    scope.package_info = '';
    scope.booknow = false;
    scope.compaignmsg = false;

    //service call for get city 
    scope.getCityList = function() {
        HomeService.getCityDetail(function(data) {
            if (data.status == 'success') {
                scope.cityList = data.data;
            }
        });
    };

    scope.getCityList();

    scope.sendDetails = function() {
        //var g_recaptcha_response = grecaptcha.getResponse(widgetId5);
        scope.addLeadFormSubmitted = false;

        if (scope.customerNo === undefined || scope.customerNo === '') {
            scope.addLeadForm.customerno.$dirty = true;
            scope.addLeadForm.customerno.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'Mobile No. not enter' });
            return false;
        }
        else if (scope.customerName === undefined || scope.customerName === '') {
            scope.addLeadForm.name.$dirty = true;
            scope.addLeadForm.name.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'Name not enter' });
            return false;
        }  
        else if (scope.City === undefined || scope.City === '') {
            scope.addLeadForm.city.$dirty = true;
            scope.addLeadForm.city.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'City not select' });
            return false;
        }

        // if(g_recaptcha_response.length == 0) {
        //     $window.alert("Please check Captcha Checkbox");
        //     return false;
        // }

        if (scope.stateParms) {
            scope.utmid = scope.stateParms.utmid;

            if(scope.utmid === '') {
               scope.utmid = 'web-health-test-campaign'            
            }

            if(scope.utmid !== '') {
                var requestData = {
                    "data":  {
                        "utm_id": scope.utmid,
                        "name":scope.customerName,
                        "email":scope.customerEmail,
                        "mobile":scope.customerNo,
                        "city":scope.City,
                        "source": "web",
                        //"g_recaptcha_response": g_recaptcha_response                    
                    }
                };

                /* Capture Utm Parameters */
                if(typeof scope.stateParms.utm_source !== 'undefined') {
                    requestData['data']['utm_source'] = scope.stateParms.utm_source;
                }
                if(typeof scope.stateParms.utm_campaign !== 'undefined') {
                    requestData['data']['utm_campaign'] = scope.stateParms.utm_campaign;
                }
                if(typeof scope.stateParms.utm_medium !== 'undefined') {
                    requestData['data']['utm_medium'] = scope.stateParms.utm_medium;
                }

                requestData['data']['message'] = 'Customer search for : '+ scope.display_name;

                if(localStorage.getItem("guid")) {
                    requestData['data']['guid'] = localStorage.getItem("guid");
                }


                var url = ConstConfig.couponUrl + "webv1/web_api/saveEmailCompaignData";

                doPostWithOutToken($http, url, requestData, "", function(data) {
                    if (data.status) {
                        var cphone = scope.customerNo;
                        scope.customerName = '';
                        scope.customerEmail = '';
                        scope.customerNo = '';

                        scope.addLeadForm.name.$dirty = false;
                        scope.addLeadForm.customerno.$dirty = false;
                        scope.addLeadForm.customeremail.$dirty = false;

                        scope.compaignmsg = true;

                        /* Expire Exit Popup */
                        var now = new Date();
                        var exp = new Date(now.getTime() + (1 * 24 * 60 * 60 * 1000));
                        if (isMobile.any()) {
                            document.cookie = 'ExitPopupMobileCookie=1; expires=' + exp.toUTCString();
                            localStorage.setItem("isLeadCaptured", true);
                        }
                        else {
                            document.cookie = 'ExpirationCookieTest=1; expires=' + exp.toUTCString();
                            localStorage.setItem("isLeadCaptured", true);
                        }


                        /* Pixel Fire in case of new number */
                        if(data.message === 'Lead successfully inserted') {

                            scope.gtag_report_conversion($window.location.href);    

                            /* For Analytics - Payment Mode */
                            $analytics.eventTrack('Lead Captured', {
                                category: scope.ga_category,
                                label: cphone
                            });

                            if(typeof($window.fbq) !== 'undefined') {
                                $window.fbq('track', 'Lead', requestData);
                            }         

                            if(scope.utmid === 'ucb') {
                                if(typeof($window.utq) !== 'undefined') {
                                    $window.utq("trackCustom", "GenerateLead");
                                }
                            }

                            if(scope.utmid === 'quora') {
                                if(typeof($window.qp) !== 'undefined') {
                                    $window.qp('track', 'GenerateLead');
                                }
                            }         

                            var pixelUrl = ConstConfig.serverUrl + "commonservice/getVendorPixel";

                            var pixelrequest = {
                                "vendor_code": scope.utmid,
                                "page_source":"landing",
                                "lead_id": data.lead_id
                            }                    

                            doPostWithOutToken($http, pixelUrl, pixelrequest,"",function(data){                            
                                
                                if(data.status) {
                                    angular.element("footer").append(data.data);
                                    /* For Analytics - Pixel */
                                    if(typeof scope.stateParms.publisher_id !== 'undefined') {
                                        $analytics.eventTrack('Vendor Publisher Pixel', {
                                            category: scope.utmid,
                                            label: scope.stateParms.publisher_id
                                        });                                        
                                    }
                                    else {
                                        $analytics.eventTrack('Vendor Pixel', {
                                            category: scope.utmid                                        
                                        });
                                    }
                                } 

                                $timeout(function() {
                                    $('.modal-backdrop').remove();
                                    $('.modal.in').find('button.close').click();
                                    $window.location.href = "package/healthians-full-body-checkup-with-thyroid-and-cbc";
                                }, 15000);

                            });   


                        }
                        else {
                            $timeout(function() {
                                $('.modal-backdrop').remove();
                                $('.modal.in').find('button.close').click();
                                $window.location.href = "package/healthians-full-body-checkup-with-thyroid-and-cbc";
                            }, 10000);
                        }
                    } else {
                        //grecaptcha.reset();
                        alert(data.message);
                    }
                });
            }
        }
    }

    scope.showLeadMobileForm = false; 

    scope.tabOnMobileLead = function() {
        scope.showLeadMobileForm = true;
    }

    scope.hideTabOnMobileLead = function() {
        scope.showLeadMobileForm = false;
        scope.customerName = '';
        scope.customerNo = '';

        scope.addLeadFormMobile.name.$dirty = false;
        scope.addLeadFormMobile.customerno.$dirty = false;
    }

    scope.sendLandingMobileDetails = function() {
        //var g_recaptcha_response = grecaptcha.getResponse(widgetId6);
        scope.addLeadFormSubmitted = false;

        if (scope.customerNo === undefined || scope.customerNo === '') {
            scope.addLeadFormMobile.customerno.$dirty = true;
            scope.addLeadFormMobile.customerno.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'Mobile No. not enter' });
            return false;
        } 
        
        if (scope.customerName === undefined || scope.customerName === '') {
            scope.addLeadFormMobile.name.$dirty = true;
            scope.addLeadFormMobile.name.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'Name not enter' });
            return false;
        } 

        if (scope.City === undefined || scope.City === '') {
            scope.addLeadFormMobile.city.$dirty = true;
            scope.addLeadFormMobile.city.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'City not select' });
            return false;
        }

        // if(g_recaptcha_response.length == 0) {
        //     $window.alert("Please check Captcha Checkbox");
        //     return false;
        // }

        if (scope.stateParms) {
            scope.utmid = scope.stateParms.utmid;

            if(scope.utmid === '') {
               scope.utmid = 'web-health-test-campaign'            
            }

            if(scope.utmid !== '') {
                var requestData = {
                    "data":  {
                        "utm_id": scope.utmid,
                        "name":scope.customerName,
                        "mobile":scope.customerNo,
                        "email":scope.custEmail,
                        "city":scope.City,
                        "source": "web"
                    }
                };

                if($state.current.name === "web-campaign-adwords") {
                    requestData['data']['message'] = 'Customer search for : '+ scope.PackageList;
                }

                /* Capture Utm Parameters */
                if(typeof scope.stateParms.utm_source !== 'undefined') {
                    requestData['data']['utm_source'] = scope.stateParms.utm_source;
                }
                if(typeof scope.stateParms.utm_campaign !== 'undefined') {
                    requestData['data']['utm_campaign'] = scope.stateParms.utm_campaign;
                }
                if(typeof scope.stateParms.utm_medium !== 'undefined') {
                    requestData['data']['utm_medium'] = scope.stateParms.utm_medium;
                }
                if(localStorage.getItem("guid")) {
                    requestData['data']['guid'] = localStorage.getItem("guid");
                }

                var url = ConstConfig.couponUrl + "webv1/web_api/saveEmailCompaignData";

                doPostWithOutToken($http, url, requestData, "", function(data) {
                    if (data.status) {
                        var cphone = scope.customerNo;
                        scope.customerName = '';
                        scope.customerNo = '';
                        scope.customerEmail = '';

                        scope.addLeadFormMobile.name.$dirty = false;
                        scope.addLeadFormMobile.customerno.$dirty = false;
                        scope.addLeadFormMobile.email.$dirty = false;

                        scope.compaignmsg = true;
                        scope.showLeadMobileForm = false;

                        /* Pixel Fire in case of new number */
                        if(data.message === 'Lead successfully inserted') {

                            scope.gtag_report_conversion($window.location.href);    
                            
                            /* For Analytics - Payment Mode */
                            $analytics.eventTrack('Lead Captured', {
                                category: scope.ga_category,
                                label: cphone
                            });

                            if(typeof($window.fbq) !== 'undefined') {
                                $window.fbq('track', 'Lead', requestData);
                            }    

                            if(scope.utmid === 'ucb') {
                                if(typeof($window.utq) !== 'undefined') {
                                    $window.utq("trackCustom", "GenerateLead");
                                }
                            }

                            if(scope.utmid === 'quora') {
                                if(typeof($window.qp) !== 'undefined') {
                                    $window.qp('track', 'GenerateLead');
                                }
                            }                     

                            var pixelUrl = ConstConfig.serverUrl + "commonservice/getVendorPixel";

                            var pixelrequest = {
                                "vendor_code": scope.utmid,
                                "page_source":"landing",
                                "lead_id": data.lead_id
                            }                    

                            doPostWithOutToken($http, pixelUrl, pixelrequest,"",function(data){                            
                                
                                if(data.status) {
                                    angular.element("footer").append(data.data);

                                    /* For Analytics - Pixel */
                                    if(typeof scope.stateParms.publisher_id !== 'undefined') {
                                        $analytics.eventTrack('Vendor Publisher Pixel', {
                                            category: scope.utmid,
                                            label: scope.stateParms.publisher_id
                                        });                                        
                                    }
                                    else {
                                        $analytics.eventTrack('Vendor Pixel', {
                                            category: scope.utmid                                        
                                        });
                                    }
                                } 

                                $timeout(function() {
                                    $('.modal-backdrop').remove();
                                    $('.modal.in').find('button.close').click();
                                    //$window.location.href = "package/healthians-full-body-checkup-with-thyroid-and-cbc";
                                }, 15000);

                            });                        
                        }
                        else {
                            $timeout(function() {
                                $('.modal-backdrop').remove();
                                $('.modal.in').find('button.close').click();
                                //$window.location.href = "package/healthians-full-body-checkup-with-thyroid-and-cbc";
                            }, 10000);
                        }
                    } else {
                        //grecaptcha.reset();
                        alert(data.message);
                    }
                });
            }
        }

    }

    var callback = function () {
        if (typeof(url) != 'undefined') {
          $window.location = url;
        }
    };

    scope.gtag_report_conversion = function(url) {
        if(typeof gtag == 'function') {
            gtag('event', 'conversion', {
              'send_to': 'AW-929610874/kgHcCP-t048BEPr4orsD',
              'event_callback': callback
            });
        }
        
        return false;
    }
}
