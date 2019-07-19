<?php

return [
    'display_page_limit'    =>  12,
    
    // Healthians customer helping Number
    'ht_number'     =>  '999-888-000-5',
    
    'openssl_iv'    =>  '2333DFGG45df%^sf',
    
    //collapse array
    'collapse_array'    =>     [
        'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Seventeen', 'Eighteen', 'Nineteen', 'twenty', 'twenty-one',  'twenty-two', 'twenty-three',  'twenty-four', 'twenty-five', 'twenty-six', 'twenty-seven', 'twenty-eight', 'twenty-nine', 'thirty', 'thirty-one', 'thirty-two', 'thirty-three',   'thirty-four', 'thirty-five', 'thirty-six', 'thirty-seven', 'thirty-eight', 'thirty-nine', 'forty', 'forty-one', 'forty-two', 'forty-three', 'forty-four', 'forty-five', 'forty-six', 'forty-seven', 'forty-eight', 'forty-nine', 'fifty', 'fifty-one', 'fifty-two', 'fifty-three', 'fifty-four', 'fifty-five',    'fifty-six', 'fifty-seven',   'fifty-eight',   'fifty-nine', 'sixty'

    ],
    
    // Csat Reason
    'CSATReasons'       =>  'webv1/web_api/getCSATReasons',
    
    'saveCSAT'          =>  'webv1/web_api/saveCSAT',
    
    'saveNPS'           =>  'webv1/web_api/generalFeedback',
    
    // CRM Absolute Url detail
    'crm_url' => env('CRM_URL'),
    
    // API Absolute Url detail
    'api_url' => env('API_URL'),

    // set default City Name
    'default_city' => 'gurgaon',
      // set default City Id
    'default_city_id' => '23',

    // set default City Name
    'default_country_code' => '91',

    // get package detail by city name
    'getPackageCityWise'    =>  'eagle/v1/eagle/getPackagesCityWise',
    
    // Default SEO meta tags
    'default_meta_title' => 'Blood test in delhi ncr, whole body checkup delhi, medical test in gurgaon, health checkup in Noida, best diagnostic lab in delhi NCR',
    'default_meta_description' => 'Healthians.com offers lowest price medical tests and health checkups with highest quality, free home sample collection, free health counselling. Get discounted Lipid profile, kidney profile, thyroid profile, liver profile, hba1c tests.',
    'default_meta_keyword' => 'Lipid profile test, thyroid test, blood test, kidney function test, liver function test, blood sugar test, hbaic test, diabetes test, full body checkup, master health checkup',
    
    // updateloginfo url detail
    'updateLoginInfo' => 'customer/account/updateLoginInfo_v2',


    // User Profile Detail
    'show_profile' => 'customer/account/profile',

    // Update Profile Detail
    'update_profile' => 'customer/account/update_profile',
    'update_profile_pic' => 'webv1/commonservice/uploadImage',

    // User member API Detail

    'URL_CUSTOMER_LIST' => 'customer/account/family_members',
    'URL_NEW_MEMBER' => 'customer/account/add_family_member',
    'URL_UPDATE_MEMBER' => 'customer/account/update_member',
    'URL_RELATION' => 'customer/account/getrelationship',

    // End User member API detail

    // Autocomplete search
    //url_changes
    //'packageSuggestion' =>  'webv1/web_api/packageSuggestion',
    'packageSuggestion' =>  'eagle/v1/eagle/getProductSuggestion',

    // Get Country Code URL Detail
    'country_code' => 'webv1/web_api/getCountryCode',
    
    // Generate OTP By Mobile no URL Detail
    'generateOTP' => 'webv1/commonservice/generate_otp_for_callback',
    
    // CheckLogin with access token
    'checkLogin' => 'customer/account/checkLogin',
    
    // User Login Info URL Detail
    // 'updateLoginInfo' => 'customer/account/updateLoginInfo',
        
    /*
     * Cart API Detail Start
    */
    // fetch Cart Detail URL
    'fetch_cart_detail'         =>  'customer/account/fetch_cart_v2',
    
    // add item detail Cart Detail URL 
    'add_item_in_cart'          =>  'customer/account/add_item_in_cart',
    
    // delete item from cart URL Detail
    'delete_user_cart'          =>  'customer/account/delete_item_from_cart',

    // Complete delete cart
    'delete_cart'               =>  'customer/account/delete_user_cart',
    
    // Upload Prescription
    'upload_prescription'       =>  'service/LeadActionController/uploadDoctorPrescription',
    'validate_otp'              =>  'webv1/commonservice/validate_otp_for_callback',
    
    /*
     * End Cart API Detail
     */ 

    /*
     * Start Payment API Detail
     */ 
    'getnearestlocality'        =>      'webv1/commonservice/getnearestlocality',
    'getAddress'                =>      'customer/account/user_addresses',
    'add_address'               =>      'customer/account/add_address',
    'delete_address'            =>      'customer/account/delete_address',
    'getAlltimeSlot'            =>      'webv1/timeslot/getAlltimeSlot_v2',
    'freeze_slot'               =>      'customer/account/freeze_slot_v2',
    'update_address'            =>      'customer/account/update_address',
    'getConvenienceFee'         =>      'Common_api/getConvenienceFee',
    'getUserEwallet'            =>      'wallet_api/getUserEwallet',
    'book_order'                =>      'customer/account/book_order_v2',
    'payupayment'               =>      'payupayment',
    'mobikwikpayment'           =>      'mobikwikpayment',
    'paytmpayment'              =>      'paytmpayment',
    'update_payment_type'       =>      'webv1/commonservice/update_payment_type',
    'payment_summary'           =>      'webv1/commonservice/payment_summary_details',
    'hard_copy_price'           =>      'customer/account/get_hard_copy_price',

 //   http://d3web.healthians.co.in/makepayment?mobile=9643055880&booking_id=231569541 // pending To Do
    /*
     * End Payment API Detail
     */ 

    /*
     * Start Coupon API Detail
     */

    'customerActiveCoupon'      =>      'Common_api/listCustomerActiveCoupon',
    'applyCoupon'               =>      'customer/account/apply_coupon',

    /*
     * End Coupon APi Detail
     */
    // update Address Detail URL 
    'update_address' => 'customer/account/update_address',
    
    // Profile/Package/Parameter Relative URL Detail
    'product_url' => 'webv1/web_api/get_deal_details_for_seo',
    
    // Active City list URL Detail
    'city_detail' => 'customer/account/getNcrCityList',
    
    // Get Popular Package URL Detail
    'popular_package_url' => 'eagle/v1/eagle/getPopularPackages',

    // Popular Test URL detail
    //'popular_test_url'  => 'webv1/web_api/getPopulerTests',
    //url_changes
    'popular_test_url'  => 'eagle/v1/eagle/getPopularTests',
    
    // Suggest test by Habit URL Detail
    'habit_parameter_url' => 'customer/RiskHabitManagement/getHabitParameter',
    
    // Suggest test by Risk area URL Detail
    'risk_parameter_url' => 'customer/RiskHabitManagement/getRiskParameter',
    
    // Search URL detail
    'search_page'  => 'webv1/search',

    // Get WEBSITE SEO details    
    'get_seo_content' => 'webv1/static_page_content/get_seo_content',

    // Get Static Page Content
    'get_cms_page_content' => 'webv1/static_page_content/get_page_content',

    // Save Contact Us API
    'saveContactUs' => 'webv1/commonservice/contactUs',
    
    // Click to call URL Detail
    'saveEmailCompaignData' => 'webv1/web_api/saveEmailCompaignData',
    
    // Vendor Pixel fire URL Detail
    'vendorPixel' => 'webv1/commonservice/getVendorPixel',

    // Lab Visit API
    'saveLabVisit' => 'webv1/web_api/saveLabVisitRequestData',

    // Career Save API
    'saveCareer' => 'webv1/commonservice/workWithUs',

    // Feedback Form - Get Issue Type List
    'getIssueTypes' => 'service/ticket_management/getIssueTypes',

    // Feedback Form - Save
    'createTicket' => 'service/ticket_management/createTicket',

    // get Deals list
    'get_website_deal_offers' => 'webv1/static_page_content/get_website_deal_offers',

    // save Email Subscription Form Data
    'saveSubscribeNewsLetter' => 'webv1/commonservice/subscribeNewsLetter',

    // Email Unsubscribe
    'emailUnSubscribe'          =>  'webv1/commonservice/unSubscribe',

    // Habit List
    'gethabitParameter' => 'customer/RiskHabitManagement/gethabitParameter',

    // Risk List
    'getriskParameter' => 'customer/RiskHabitManagement/getriskParameter',

    // Habit Risk - Search - Details
    'getRiskHabitSearch' => 'eagle/v1/eagle/getProductByRiskHabit',

    // Get Subscription Bundle List
    'getSubscriptionBundleList' => 'customer/account/getSubscriptionBundleList',

    // Healthians Blog URL
    'healthians_blog_url' => 'https://blog.healthians.com/',

    // Blog List API
    'getBlogList' => 'customer/account/getHealthiansBlogs',

    // My Bookings
    'getMyBooking' => 'customer/account/my_bookings',

    // My Reports
    'getMyReports' => 'customer/account/my_reports_v3',

    // Download Reports
    'downloadReports' => 'webv1/web_api/getReportContent',

    // Order Details - Order Tracking
    'order_tracking'  => 'webv1/commonservice/order_tracking',

    // Get Donation Info, Online Discount Info, Coupon Notice, Wallet Max Used Point
    'donation_online_discount_coupon_info' =>  'webv1/web_api/getDonationInfo',

    // Technical Video
    'getTechVideo'  => 'webv1/web_api/getTechVideo',
    'trackVideo'    => 'Video_tracking/trackVideoDisplay',

    // Make Payment Url's
    'make_payment_booking_details'              => 'webv1/commonservice/genrate_payment_link',
    'make_payment_crm_booking_payment_details'  => 'webv1/commonservice/generate_crm_payment_link',
    'make_payment_subscription_details'         => 'webv1/subscription_management/get_subscription_detail_for_payment',
    'make_payment_crm_service_details'          => 'service/healthians_service/get_service_detail_for_payment',
    'make_payment_booking_service_details'      => 'webv1/commonservice/get_booking_service_detail_for_payment',
    
    //Phlebo Tracking URL
    'getPhleboInfo'                             =>  'customer/RiskHabitManagement/getPhleboInfo',
    
    // get refer list api

    'getReferList'              =>  'customer/account/getReferList',

    // booking_verification_changes
    'booking_verification'      =>  'webv1/web_api/booking_verification',


    // Customer Health score
    'getCustomersHealthScore'   =>  'customer/account/getCustomersHealthScore',

    'lead_page_management'      => 'webv1/commonservice/lead_page_management',

    // Miss Call Lead 
    'misscall_lead'             => 'webv1/web_api/saveMissedCallCompaignData',
    
    // Health Karma Question
    'health_karma_question'     => 'customer/account/getQuestions',

    // Health Karma Save
    'health_karma_save'         => 'customer/account/getHealthAssessment',

    // maternal form validation request
    'maternalFormValidate'      => 'webv1/web_api/validateMaternalFormRequest',
    'saveMaternalForm'          => 'webv1/web_api/setCustomerPretestInfo',

    //Click To Call API
    'click_to_call'             =>  'customer/account/clickToCallUrl',

    // Save Sample Collection Feedback
    'saveSampleCollection'  =>  'webv1/web_api/phelboFeedback',

    // For smart report parameter data
    'getSmartReportGraphData'   => 'customer/account/parameterDigitalData',

    // Diet Page API
    'getAllDiseaseList'     => 'customer/account/getAllDiseaseList',

    // Get Calorie & Food Type Page API
    'getCalorieAndFoodType' => 'customer/account/getCalorieAndFoodType',

    // Save Diet Plan API
    'saveDietPlan' => 'customer/account/saveCustomerDietPreference',
    
    //Get diet plan API
    'getDietPlans' => 'webv1/commonservice/getDietPlans',

    //like Diet Plan API
    'likeDietPlan'  => "customer/account/saveDietLikeDislikeData",

    //getDietDislikeReasons
    "getDietDislikeReasons" => "customer/account/getDietDislikeReasons",

    //get Saved User Diet preferences
    "getSavedDietPreference" => "customer/account/editDietPreference"
];
