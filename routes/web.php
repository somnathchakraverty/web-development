<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix'    => '/', 'middleware' => ['minify']], function () {
    Route::get('/','IndexController@homePage')->name('home');
});


Route::group(['prefix'    => '/'], function () {
    Route::get('getBlogSlider', 'IndexController@getBlogSlider')->name('blog-slider');
    Route::get('404-error', 'IndexController@display_404')->name('404-error');
    Route::get('app-download', 'AppNavigationController@appDownload')->name('app-download');
    Route::get('getLocalityID', 'CommonController@getLocalityID')->name('get-city-details');
    Route::get('app-download', 'AppNavigationController@appDownload')->name('app-download');
    Route::get('app-downloadv1', 'AppNavigationController@appDownloadv1')->name('app-downloadv1');
    Route::get('about-us', 'StaticController@aboutUsPage')->name('about-us');
    Route::get('healthians-media', 'StaticController@mediaPage')->name('healthians-media');
    Route::get('career', 'StaticController@careerPage')->name('career');

    Route::get('terms-condition', 'StaticController@termsConditionPage')->name('terms-condition');
    Route::get('refund-policy', 'StaticController@refundPolicyPage')->name('refund-policy');
    Route::get('labs', 'StaticController@labsPage')->name('labs');
    Route::get('lab-visit', function () { return redirect()->route('labs', [], 301); });
    Route::get('statutory-compliance', 'StaticController@statutoryCompliancePage')->name('statutory-compliance');

    Route::get('healthians-investors', 'StaticController@healthiansInvestorsPage')->name('healthians-investors');
    Route::get('contact-us', 'StaticController@contactUsPage')->name('contact-us');
    Route::get('deals', 'StaticController@dealsPage')->name('deals');
    Route::get('feedback', 'StaticController@feedbackPage')->name('feedback');
    Route::get('offer-terms-conditions', 'StaticController@offerTermsConditionPage')->name('offer-terms-conditions');
    Route::get('wellness-program', 'StaticController@wellnessProgramPage')->name('wellness-program');
    Route::get('health-karma-promotion', 'StaticController@healthKarmaPromotionPage')->name('health-karma-promotion');
    Route::get('bengaluru-health-karma', function () { return redirect()->route('health-karma-promotion', [], 301); });

    // Upload Prescription Route detail
     Route::get('upload-prescription', 'UploadPrescriptionController@prescription')->name('prescription');
     Route::post('get-otp', 'UploadPrescriptionController@getOTPDetail')->name('prescription-getOtp');
     Route::post('upload-prescription', 'UploadPrescriptionController@uploadPrescription')->name('upload-prescription');
     Route::get('thank-you','UploadPrescriptionController@thankyouPage')->name('prescription-thanku');
    // booking vendor pixel fire
    Route::post('pixel-fire', 'FormSubmitController@savePixelFire');


    // Form Submit Resource
    Route::post('saveContactUs', 'FormSubmitController@saveContactUs');
    Route::post('saveLabVisit', 'FormSubmitController@saveLabVisit');
    Route::post('saveCareer', 'FormSubmitController@saveCareer');
    Route::post('saveFeedback', 'FormSubmitController@saveFeedback');


    Route::group([ 'namespace'=> 'Auth'],function () {
        Route::get('login', ['uses' => 'AuthController@loginDetail'])->name("login");
        Route::post('login', 'AuthController@submitLoginDetail');
        Route::get('otp', 'AuthController@otpDetail')->name("otp");
        Route::post('otp', 'AuthController@submitOtpDetail');
        Route::get('profile-info', 'AuthController@loginInfo')->name('profile-info');
        Route::post('profile-info', 'AuthController@updateLoginInfo')->name('update-profile');
        Route::get('logout', 'AuthController@logout')->name('logout');
    });

    Route::group(['namespace'=> 'CustomerInfo','as' => 'user.'],function () {
        // Controllers Within The "App\Http\Controllers\Admin" Namespace
        Route::get('dashboard','DashboardController@index')->name('dashboard');

        Route::get('cart', function () {
            return redirect()->route('user.cart');
        });
        
        Route::get('mycart','CartDetailController@index')->name('cart');

        Route::post('cart','CartDetailController@add')->name('add-cart');

        Route::delete('cart','CartDetailController@delete')->name('delete-cart');
        
        Route::post('deleteCompleteCart','CartDetailController@deleteCompleteCart')->name('delete-complete-cart');

        Route::get('user_selection_cart','CartDetailController@selectMember')->name('user_selection_cart');

        Route::get('slot-picker','CartDetailController@getSlotByDate');

        Route::get('select-slot','CartDetailController@selectSlot')->name('select-slot');

        Route::post('before-checkout','PaymentController@beforePayment');
        Route::get('before-checkout','PaymentController@beforePaymentGet');

        Route::get('checkout','PaymentController@curPaymentDetail')->name('payment');

        Route::post('payment','PaymentController@paymentValidation');

        Route::get('check-coupon', 'PaymentController@userCouponValidation');

        Route::get('payment-fail', 'PaymentController@paymentFailure');

        Route::get('payment-summary', 'PaymentController@paymentSummary')->name('paymentsummary');

        Route::get('getConvenienceFee', 'PaymentController@getConvenienceFee')->name('getConvenienceFee');
    });

    Route::group(['namespace'=> 'Dashboard'],function () {
        Route::get('myBooking', function () {
            return redirect('/mybookings', 301);
        });
        Route::get('mybookings', 'MyBookingController@index')->name('myBooking');

        Route::get('myAddress', function () {
            return redirect('/myaddress', 301);
        });
        Route::get('myaddress', 'MyAddressController@index')->name('myAddress');
        
        Route::get('deleteAddress/{address_id}', 'MyAddressController@deleteAddress')->name('delete-address');
        Route::get('getAddressList', 'MyAddressController@getAddressList')->name('get-address-list');
        Route::post('getLocalityID', 'MyAddressController@getLocalityID')->name('get-locality-details');
        Route::post('saveNewAddress', 'MyAddressController@saveNewAddress')->name('save-new-address-details');
        Route::post('updateAddress', 'MyAddressController@updateAddress')->name('update-address-details');

        Route::get('mySubscription', function () {
            return redirect('/mysubscription', 301);
        });
        Route::get('mysubscription', 'MySubscriptionController@index')->name('mySubscription');
        
        Route::get('myReminders', function () {
            return redirect('/myreminders', 301);
        });
        Route::get('myreminders', 'MyRemindersController@index')->name('myReminders');

        Route::get('myProfile', function () {
            return redirect('/myprofile', 301);
        });
        Route::get('myprofile', 'MyProfileController@index')->name('myProfile');
        Route::post('editProfile', 'MyProfileController@editProfile')->name('edit-profile');
        Route::post('updateProfilePic', 'MyProfileController@updateProfilePic')->name('update-profile-pic');

        Route::get('myFamily', function () {
            return redirect('/myfamily', 301);
        });
        Route::get('myfamily', 'MyFamilyController@index')->name('myFamily');
        Route::get('hCash', 'HCashController@index')->name('hCash');
        Route::get('referral', 'ReferEarnController@index')->name('referral');
        Route::post('addFamilyMember', 'MyFamilyController@addFamilyMember')->name('add-family-member');
        Route::post('editFamilyMember', 'MyFamilyController@editFamilyMember')->name('edit-family-member');
        Route::get('getFamilyList', 'MyFamilyController@getFamilyList')->name('getFamilyList');
        Route::get('getRelationship', 'MyFamilyController@getRelationship')->name('get-family-relationship');

        Route::get('orderDetails/{order_id}', 'OrderTrackingController@index')->name('orderDetails');
        
        Route::get('myReports', function () {
            return redirect()->route('myReports');
        });
        Route::get('myreports/{cust_id?}', 'MyReportsController@index')->name('myReports');
        Route::get('referral/{user_id}', 'ReferEarnController@referAndEarn')->name('refer-earn');
    });

    Route::get('healthkarma','HealthKarmaController@healthkarma_new')->name('healthkarma-new');
    Route::get('healthkarma/india','HealthKarmaController@healthkarma_new')->name('healthkarma-india');

    Route::get('getHealthKarmaQuestion','HealthKarmaController@getHealthKarmaQuestion')->name('getHealthKarmaQuestion');
    Route::post('saveHealthKarma', 'HealthKarmaController@saveHealthKarma')->name('saveHealthKarma');
    Route::post('clickToCall', 'HealthKarmaController@clickToCall')->name('clickToCall');


    Route::post('callBackLead', 'FormSubmitController@saveLead');

    Route::post('saveEmailSubscription', 'FormSubmitController@saveEmailSubscription');

    Route::get('unsubscribe/{email}', 'FormSubmitController@emailUnSubscription');


    Route::group(['namespace'=> 'HabitRisk'],function () {
        // Controllers Within The "App\Http\Controllers\HabitRisk" Namespace
        Route::get('habits-list','HabitRiskController@habitList')->name('habits-list');
        Route::get('risk-area-list','HabitRiskController@riskList')->name('risk-area-list');
        Route::get('habit/{link_rewrite}','HabitRiskController@habitDetail')->name('habit-detail');
        Route::get('risk/{link_rewrite}','HabitRiskController@riskDetail')->name('risk-detail');
        Route::get('getRiskSlider','HabitRiskController@getRiskSlider')->name('risk-list-slider');
        Route::get('getHabitSlider','HabitRiskController@getHabitSlider')->name('habit-list-slider');
    });

    Route::get('getSubscriptionSlider', 'SubscriptionController@getSubscriptionSlider')->name('subscription-slider');
    Route::get('subscriptionList', 'SubscriptionController@subscriptionList')->name('subscription-list');
    Route::get('subscriptionDetail/{id}', 'SubscriptionController@subscriptionDetail')->name('subscription-detail');

    Route::get('most-selling','IndexController@getPopularPackagePage')->name('most-selling');

    Route::get('technical_video','TechnicalVideoController@index')->name('technical_video');
    Route::post('track_video', 'TechnicalVideoController@trackVideoInfo')->name('track_video');

    //make payment urls
    Route::group(['namespace'=> 'MakePayment'],function () {
        Route::get('makepayment','MakePaymentController@index')->name('makepayment');
        Route::get('makebookingservicepayment','MakePaymentController@bookingServicePayment')->name('makebookingservicepayment');
        Route::get('service-payment-summary', 'MakePaymentController@servicePaymentSummary')->name('service-payment-summary');
        Route::get('subscription-payment-summary', 'MakePaymentController@subscriptionPaymentSummary')->name('subscription-payment-summary');
        Route::get('booking-service-payment-summary', 'MakePaymentController@bookingServicePaymentSummary')->name('booking-service-payment-summary');

        Route::get('subscribe-payment-fail', 'MakePaymentController@subscriptionPaymentFail')->name('subscribe-payment-fail');
        Route::get('booking-service-payment-fail', 'MakePaymentController@bookingServicePaymentFail')->name('booking-service-payment-fail');
        Route::get('service-payment-fail', 'MakePaymentController@servicePaymentFail')->name('service-payment-fail');
    });


    // Product API Detail
    Route::group(['namespace'=> 'Product','as' => 'product.'],function () {
        // Get Package detail by selected city id
        Route::get('{city}/package', function ($city_name) {
            $default_city   =   config()->get('constants.default_city');
            return redirect()->route('product.city-package-list',[$city_name], 301);
        });

        Route::get('package/{city}','ProductListingController@cityPackageDetail')->name('city-package-list');

        // Controllers Within The "App\Http\Controllers\Admin" Namespace
        Route::get('{city}/package/{link_rewrite}', function ($city_name, $link_rewrite) {
            return redirect()->route('product.package-detail',[$city_name,$link_rewrite], 301);
        });
        Route::get('{city}/profile/{link_rewrite}', function ($city_name, $link_rewrite) {
            return redirect()->route('product.profile-detail',[$city_name,$link_rewrite], 301);
        });
        Route::get('{city}/parameter/{link_rewrite}', function ($city_name, $link_rewrite) {
            return redirect()->route('product.parameter-detail',[$city_name,$link_rewrite], 301);
        });
        
        Route::get('package/{city}/{link_rewrite}','ProductController@packageDetail')->name('package-detail');
        Route::get('profile/{city}/{link_rewrite}','ProductController@profileDetail')->name('profile-detail');
        Route::get('parameter/{city}/{link_rewrite}','ProductController@parameterDetail')->name('parameter-detail');

        Route::get('{city}/orderbook','ProductListingController@productListDetail')->name('listing');
        Route::post('{city}/ajaxorderbook','ProductListingController@ajaxProductListDetail')->name('ajax-listing');

        Route::post('setsession','ProductListingController@setSelectedSessionDetail')->name('setsession');

        Route::get('package/{link_rewrite}', function ($seo_url) {
            $default_city   =   config()->get('constants.default_city');
            return redirect()->route('product.package-detail',[$default_city,$seo_url], 301);
        });

        Route::get('profile/{link_rewrite}', function ($seo_url) {
            $default_city   =   config()->get('constants.default_city');
            return redirect()->route('product.profile-detail',[$default_city,$seo_url], 301);
        });

        Route::get('parameter/{link_rewrite}', function ($seo_url) {
            $default_city   =   config()->get('constants.default_city');
            return redirect()->route('product.parameter-detail',[$default_city,$seo_url], 301);
        });



        Route::get('ajaxorderbook', function () {
            $default_city   =   config()->get('constants.default_city');
            return redirect($default_city.'/ajaxorderbook');
        });
        Route::get('orderbook', function () {
            $default_city   =   config()->get('constants.default_city');
            return redirect($default_city.'/orderbook');
        });
    });

    Route::get('home', function () { return redirect('/'); });

    Route::get('booking_verification','InternalWorkController@booking_verification')->name('booking_verification');
    Route::get('csat/{csat_id}','FeedbackController@csat')->name('csat');
    Route::post('saveCSAT/{csat_id}', 'FeedbackController@saveCsat')->name('save-csat');
    Route::get('lead/missed-call/{phone_number}','InternalWorkController@misscall_lead')->name('misscall_lead');

    Route::get('nps','FeedbackController@nps')->name('nps');
    Route::post('nps', 'FeedbackController@saveNPS')->name('save-nps');

    Route::get('sample-collection-feedback','FeedbackController@sampleCollectionFeedback')->name('sample-collection-feedback');
    Route::post('saveSampleCollectionFeedback', 'FeedbackController@saveSampleCollectionFeedback')->name('save-sample-collection-feedback');

    Route::group(['namespace'=> 'Landing'],function () {
        Route::get('landing/{link_rewrite}/{utm_id?}','LandingController@getLandingPageDetail')->name('dynamic-landing');
        Route::get('health-test/{link_rewrite}/{utmid?}','StaticLandingController@healthTest')->name('health-test');
        Route::get('web-campaign-health-checkup/{utmid}','StaticLandingController@webCampaignHealthCheckup')->name('web-campaign-health-checkup');
        Route::get('web-campaign-health-checkup-1099/{utmid}','StaticLandingController@webCampaignHealthCheckup1099')->name('web-campaign-health-checkup-1099');
        Route::get('web-campaign-one-plus-one-full-body-checkup/{utmid}','StaticLandingController@webCampaignHealthCheckup1399')->name('web-campaign-health-checkup-1399');
        Route::get('health-checkup/{link_rewrite}/{utmid?}','CrudLandingController@healthCheckup')->name('health-checkup');
        Route::get('fullbody-package/{utmid}/','StaticLandingController@fullBodyPackage')->name('fullbody-package');

        Route::get('womenday-special/{utmid}/','StaticLandingController@womendaySpecial')->name('fullbody-package');
        Route::get('fullbody-blood-test/{utmid}/','StaticLandingController@fullBodyBloodPackage')->name('fullbody-blood-test');
        Route::get('paytm','StaticLandingController@paytmSpecial')->name('paytm');
        Route::get('health-test-full-body-checkup/{utmid}','StaticLandingController@trustHealthTestFullBody')->name('health-test-full-body');
        Route::get('hdfc','StaticLandingController@hdfcSpecial')->name('hdfc');
        Route::get('campaign-complete-body-screening/{utmid}/','StaticLandingController@campaignCompleteBodyScreening')->name('campaign-complete-body-screening');
        Route::get('lead-campaign-health-checkup/{utmid}/','StaticLandingController@leadCampaignHealthCheckup')->name('lead-campaign-health-checkup');
        Route::get('getPopularPackage','StaticLandingController@getPopularPackage')->name('getPopularPackage');
        Route::get('envirer','StaticLandingController@envirerSpecial')->name('envirer');
        Route::get('fullbody-package-2/{utmid}/','StaticLandingController@fullBodyPackageStatic')->name('fullbody-package-2');
        Route::get('fullbody-package-booknow/{utmid}','StaticLandingController@fullBodyPackageBookNow')->name('fullbody-package-booknow');
    });

    Route::group(['namespace'=> 'Sitemap'],function () {
        Route::get('sitemap.xml', 'SitemapController@index')->name('sitemap');

        Route::get('health-packages-sitemap.xml', 'SitemapController@healthPackages')->name('sitemap-package');

        Route::get('health-parameters-sitemap.xml', 'SitemapController@healthParameters')->name('sitemap-parameter');

        Route::get('health-profiles-sitemap.xml', 'SitemapController@healthProfiles')->name('sitemap-profile');

        Route::get('health-habit-risks-sitemap.xml', 'SitemapController@healthHabitRisk')->name('sitemap-habitrisk');

        Route::get('sitemap-generator/{token}', 'SitemapController@generateSitemap')->name('sitemap-generator');

        // Route::get('sitemap-profile', 'SitemapController@profile')->name('sitemap-profile');

        // Route::get('sitemap-package', 'SitemapController@package')->name('sitemap-package');

        // Route::get('sitemap-parameter', 'SitemapController@parameter')->name('sitemap-parameter');

        // Route::get('sitemap-habit-risk', 'SitemapController@habirRiskSitemap')->name('sitemap-habit-risk');

    });

Route::get('smart-report/{booking_id}/{customer_id}', 'SmartReportController@index')->name('smart-report');
Route::post('getGraphData', 'SmartReportController@getGraphData')->name('get-smart-report-graph-data');


Route::post('saveLandingPageLead', 'FormSubmitController@saveLandingPageLead');
  
    Route::group(['namespace'=> 'Phlebo'],function () {
        Route::get('phlebo-route', 'PhleboRouteController@index')->name('phlebo-route');
        Route::get('phlebo-route-new', 'PhleboRouteController@index')->name('phlebo-route-new');
    });

    Route::post('saveLandingPageLead', 'FormSubmitController@saveLandingPageLead');

    Route::group(['prefix'    => '/server', 'namespace' => 'Server'], function () {
        Route::get('/','DetailsController@index')->name('server-detail');
    });

    Route::get('maternal-serum','MaternalSerumController@maternal_serum')->name('maternal-serum');
    Route::post('saveMaternalData', 'MaternalSerumController@saveMaternalData')->name('saveMaternalData');
    
    Route::get('smart-report/{booking_id}/{customer_id}','SmartReportController@index')->name('smart-report');
});

Route::group(['namespace'=> 'Diet'],function () {    
    
    Route::get('mydietplan','DietPlanController@displayDiet')->name('mydietplan');
    Route::post('diet/save-diet-plan','DietPlanController@saveDietPlan')->name('save-diet-plan');
    Route::post('diet/likeDietPlan','DietPlanController@likeDietPlan')->name('like-diet-plan');
    Route::post('diet/dislikeDietPlan','DietPlanController@dislikeDietPlan')->name('dislike-diet-plan');
    Route::any('diet/recommended','DietPlanController@recommended')->name('recommended');

    Route::post('diet/getAlterDietPlan','DietPlanController@getAlterDietPlan')->name('get-alt-diet-plan');
    
});


