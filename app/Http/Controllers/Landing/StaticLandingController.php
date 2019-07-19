<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class StaticLandingController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }
   
    public function healthTest($link_rewrite, $utm_id = null){
        /**
         * This is to get locality ID and check sub-locality serviceable or not
         * eg : https://www.healthians.com/health-test/thyroid-profile/google
         */
        try {
            $request                  =   $this->request;

            $meta_details             = [
                'meta_title'    => '',
                'meta_keyword'  => '',
                'meta_desc'     => '',
                'canonical_url' => ''
            ];

            if (empty($link_rewrite)) {
                throw new Exception("Link Rewrite is missing");
            }

            $data = [
                'city_detail'           => $this->city_detail,
                'utm_id'                => $utm_id,
                'ga_category'           => 'web-health-test-campaign',
                'ga_mobile_category'    => 'web-health-test-campaign'
            ];

            $data['email_id']       =   $request->query('email');
            $data['name']           =   $request->query('name');
            $data['contact_no']     =   $request->query('mobile');
            $data['comment']        =   $request->query('comment');
            $data['utm_source']     =   $request->query('utm_source');
            $data['utm_campaign']   =   $request->query('utm_campaign');
            $data['utm_medium']     =   $request->query('utm_medium');
            $data['publisher_id']   =   $request->query('publisher_id');
            $data['source']         =   'web';

            if(empty($utm_id)) {
                $data['utm_id']  = 'web-health-test-campaign';         
            }

            if($link_rewrite === "liver-function-test") {
                $data['display_name']           = 'Liver Function Test';
                $data['display_order_price']    = 'Price Starting <span class="rupeesign" >₹</span> 250';
                $data['display_image']          = '/img/campaign/liver-function-test.jpg';

                $data['display_data'] = [  
                    0   => [ 
                        "headline"  => "Measures levels of ",  
                        "data"      => ['Protein', 'Liver enzymes', 'Bilirubin in the blood.']
                    ],
                    1   => [ 
                        "headline"      => "Helps to Diagnose: ",  
                        "data"          => ['Viral Hepatitis(A,B,C)', 'Cirrhosis', 'Alcoholic liver disease', 'Effects of few medicines']
                    ]
                ];

                $meta_details['meta_title']     = "Book liver test at Best Price | Healthians";
                $meta_details['meta_desc']      = "Book liver test from Healthians. 100% Accuracy Guranteed & Free Sample Collection. Book Now!";
                $meta_details['meta_keyword']   = "liver test, healthians";

                $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);
            }
            else if($link_rewrite === "kidney-function-test") {
                $data['display_name']           = 'Kidney Function Test';
                $data['display_order_price']    = 'Price Starting @ <span class="rupeesign" >₹</span> 250';
                $data['display_image']          = '/img/campaign/kidney-test.jpg';

                $data['display_data'] = [  
                    0   => [ 
                        "headline"  => "Tests required in case of :",  
                        "data"      => ['Urinary Tract Infection (UTI)','Diabetes', 'High blood pressure (BP)', 'Kidney Stones', 'Excessive use of pain killers', 'Frequent urination', 'Blood & pain while passing Urine', 'Swelling of hands and feet']
                    ]
                ];

                $meta_details['meta_title']     = "Book kidney function test at Best Price | Healthians";
                $meta_details['meta_desc']   = "Book kidney function test from Healthians. 100% Accuracy Guranteed & Free Sample Collection. Book Now!";
                $meta_details['meta_keyword']      = "kidney function test, healthians";

                $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);
            }
            else if($link_rewrite === "lipid-profile-test") {
                $data['display_name']           = 'Lipid Profile/Cholesterol';
                $data['display_order_price']    = 'Price Starting @ <span class="rupeesign" >₹</span> 300';
                $data['display_image']          = '/img/campaign/lipid-profile.jpg';

                $data['display_data'] = [  
                    0   => [ 
                        "headline"  => "",  
                        "data"      => ['Measures abnormalities in: Cholesterol, Triglycerides', 'Assesses the risk of Heart Diseases', 'Monitors the effectiveness of the treatment']
                    ]
                ];

                $meta_details['meta_title']     = "Book lipid profile test at Best Price | Healthians";
                $meta_details['meta_keyword']   = "lipid profile test, healthians";
                $meta_details['meta_desc']      = "Book lipid profile test from Healthians. 100% Accuracy Guranteed & Free Sample Collection. Book Now!";

                $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);
            }
            else if($link_rewrite === "thyroid-profile") {
                $data['display_name']           = 'Thyroid Function Test';
                $data['display_order_price']    = 'Price Starting @ <span class="rupeesign" >₹</span> 270';
                $data['display_image']          = '/img/campaign/Thyroid-test.jpg';

                $data['display_data'] = [  
                    0   => [ 
                        "headline"  => "Helps to Diagnose:",  
                        "data"      => ['Hyperthyroidism - with symptoms like: Weight Loss, Anxiety, Menstrual problems, Cardiac problems, Tremors', 'Hypothyroidism - with symptoms like: Weight gain, Lack of energy, Depression, Menstrual problems']
                    ]
                ];

                $meta_details['meta_title']     = "Book thyroid test at Best Price | Healthians";
                $meta_details['meta_keyword']   = "thyroid test, healthians";
                $meta_details['meta_desc']      = "Book thyroid test from Healthians. 100% Accuracy Guranteed & Free Sample Collection. Book Now!";

                $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);
            }            
            else if($link_rewrite === "HbA1c") {
                $data['display_name']           = 'HbA1c Test';
                $data['display_order_price']    = 'Price Starting @ <span class="rupeesign" >₹</span> 350';
                $data['display_image']          = '/img/campaign/HbA1c.jpg';

                $data['display_data'] = [  
                    0   => [ 
                        "headline"  => "",  
                        "data"      => ['Best test to detect Diabetes', 'Measures average blood glucose level for 3 months before the test', 'Monitors diabetes management over a period of time']
                    ]
                ];

                $meta_details['meta_title']     = "Book hbA1c test at Best Price | Healthians";
                $meta_details['meta_keyword']   = "hbA1c test, healthians";
                $meta_details['meta_desc']      = "Book hbA1c test from Healthians. 100% Accuracy Guranteed & Free Sample Collection. Book Now!";

                $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);
            }          
            else if($link_rewrite === "vitamin-test") {
                $data['display_name']           = 'Vitamin Test <span class="span_sub_test">(Vitamin D3, Vitamin B12)</span>';
                $data['display_order_price']    = 'Price Starting @ <span class="rupeesign" >₹</span> 999';
                $data['display_image']          = '/img/campaign/Vitamin-B12.jpg';

                $data['display_data'] = [  
                    0   => [ 
                        "headline"  => "Vitamin D test helps to detect :",  
                        "data"      => ['Vitamin D Deficiency', 'Bone Weakness', 'Bone malfunctions']
                    ],
                    1   => [ 
                        "headline"  => "Vitamin B12 test helps to :",  
                        "data"      => ['Monitor the level of Vitamin B12 in the blood', 'Low levels of Vitamin B12 can cause: Nerve damage, Deterioration in brain functions, Decrease in blood cell production causing Anaemia']
                    ]
                ];

                $meta_details['meta_title']     = "Book vitamin test at Best Price | Healthians";
                $meta_details['meta_keyword']   = "vitamin test, healthians";
                $meta_details['meta_desc']      = "Book vitamin test from Healthians. 100% Accuracy Guranteed & Free Sample Collection. Book Now!";

                $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);
            }
            else if($link_rewrite === "senior-citizen-package") {
                $data['display_name']           = 'Senior Citizen Package';
                $data['display_order_price']    = 'Health Check-up starting @ <span class="rupeesign" >₹</span> 1299';
                $data['display_image']          = '/img/campaign/senior-citizen-package.jpg';

                $data['display_data'] = [  
                    0   => [ 
                        "headline"  => "",  
                        "data"      => ['Package especially designed for Senior Citizens.', 'Helps to diagnose common chronic illness like Diabetes, Cholesterol, Thyroid, Kidney & Liver problems.', 'Monitors effectiveness of ongoing treatment.']
                    ]
                ];

                $meta_details['meta_title']     = "Book senior citizen package at Best Price | Healthians";
                $meta_details['meta_keyword']   = "senior citizen package, healthians";
                $meta_details['meta_desc']      = "Book senior citizen package from Healthians. 100% Accuracy Guranteed & Free Sample Collection. Book Now!";

                $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);
            }            
            else if($link_rewrite === "iron-studies") {
                $data['display_name']           = 'Iron Studies';
                $data['display_order_price']    = 'Price starting @ <span class="rupeesign" >₹</span> 390';
                $data['display_image']          = '/img/campaign/iron-studies.jpg';

                $data['display_data'] = [  
                    0   => [ 
                        "headline"  => "",  
                        "data"      => ['Measures Iron level in the body.', 'Deficiency of iron can cause Anaemia.', 'Excess iron can damage Heart, Pancreas, Liver & Skin']
                    ]
                ];

                $meta_details['meta_title']     = "Book iron studies test at Best Price | Healthians";
                $meta_details['meta_keyword']   = "iron studies test, healthians";
                $meta_details['meta_desc']      = "Book iron studies test from Healthians. 100% Accuracy Guranteed & Free Sample Collection. Book Now!";

                $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);
            }            
            else if($link_rewrite === "complete-hemogram") {
                $data['display_name']           = 'Complete Hemogram';
                $data['display_order_price']    = 'Price starting @ <span class="rupeesign" >₹</span> 200';
                $data['display_image']          = '/img/campaign/complete-hemogram.jpg';

                $data['display_data'] = [  
                    0   => [ 
                        "headline"  => "Helps to detect & monitor treatment of :",  
                        "data"      => ['Anaemia', 'Infections','Inflammation','Leukaemia (Blood Cancer)']
                    ]
                ];

                $meta_details['meta_title']     = "Book cbc test at Best Price | Healthians";
                $meta_details['meta_keyword']   = "cbc test, healthians";
                $meta_details['meta_desc']      = "Book cbc test from Healthians. 100% Accuracy Guranteed & Free Sample Collection. Book Now!";

                $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);
            }            
            else if($link_rewrite === "dengue-test") {
                $data['display_name']           = 'Dengue Test';
                $data['display_order_price']    = 'Complete Package @ <span class="rupeesign" >₹</span> 999';
                $data['display_image']          = '/img/campaign/Malaria.jpg';

                $data['display_data'] = [  
                    0   => [ 
                        "headline"  => "Includes 3 tests :",  
                        "data"      => ['Dengue IgG Antibody- for detection of past antibody','Dengue IgM Antibody – for detection of recent infection','Dengue NS1 Antigen - for detection on first day of fever']
                    ]
                ];

                $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);
            }
            else if($link_rewrite === "cancer-test") {
                $data['display_name']           = 'Cancer Test';
                $data['display_order_price']    = 'Complete Package @ <span class="rupeesign" >₹</span> 2899';
                $data['display_image']          = '/img/campaign/Cancer.jpg';

                $data['display_data'] = [  
                    0   => [ 
                        "headline"  => "",  
                        "data"      => ['PSA : To screen prostate cancer in males,<br>to monitor effectiveness of treatment',
                                        'CA-125 : Tumor marker to diagnose Ovarian cancer',
                                        'CA- 19.9 Serum : Tumor marker to diagnose Colon & Pancreatic Cancer',
                                        'CA-15.3 : Tumor marker to diagnose Breast Cancer'
                        ]
                    ]
                ];

                $meta_details['meta_title']     = "Book cancer test at Best Price | Healthians";
                $meta_details['meta_keyword']   = "cancer test, healthians";
                $meta_details['meta_desc']      = "Book cancer test from Healthians. 100% Accuracy Guranteed & Free Sample Collection. Book Now!";

                $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);
            }            
            else if($link_rewrite === "std-package") {
                $data['display_name']           = 'STD Package';
                $data['display_order_price']    = 'Complete Package @ <span class="rupeesign" >₹</span> 899';
                $data['display_image']          = '/img/campaign/STD-Package.jpg';

                $data['display_data'] = [  
                    0   => [ 
                        "headline"  => "Healthians is officially recognized by NACO to conduct HIV test.<br>Includes tests to diagnose STD’s like:",  
                        "data"      => ['Hepatitis B & C', 'Syphilis', 'HIV', '<span class="secret">* Complete secrecy will be maintained</span>']
                    ]
                ];

                $meta_details['meta_title']     = "Book std package at Best Price | Healthians";
                $meta_details['meta_keyword']   = "Book std package from Healthians. 100% Accuracy Guranteed & Free Sample Collection. Book Now!";
                $meta_details['meta_desc']      = "std package, healthians";

                $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);
            }            
            else if($link_rewrite === "pancreas-pancreatitis-package") {
                $data['display_name']           = 'Pancreas | Pancreatitis Package';
                $data['display_order_price']    = 'Complete Package @ <span class="rupeesign" >₹</span> 1399';
                $data['display_image']          = '/img/campaign/kidney-test.jpg';

                $data['display_data'] = [  
                    0   => [ 
                        "headline"  => "Includes tests to determine : ",  
                        "data"      => ['Pancreatic disorders (damage or inflammation)', 'Pancreatitis']
                    ]
                ];

                $meta_details['meta_title']     = "Book pancreas test at Best Price | Healthians";
                $meta_details['meta_keyword']   = "pancreas test, healthians";
                $meta_details['meta_desc']      = "Book pancreas test from Healthians. 100% Accuracy Guranteed & Free Sample Collection. Book Now!";

                $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);
            }
            else if($link_rewrite === "arthritis-test") {
                $data['display_name']           = 'Arthritis Test';
                $data['display_order_price']    = 'Complete Package @ <span class="rupeesign" >₹</span> 999';
                $data['display_image']          = '/img/campaign/Arthritis.jpg';

                $data['display_data'] = [  
                    0   => [ 
                        "headline"  => "Test required to : ",  
                        "data"      => ['Know the root cause behind joint pains & swellings', 'Measure effectiveness of treatment of Rheumatoid Arthritis']
                    ]
                ];

                $meta_details['meta_title']     = "Book arthritis test at Best Price | Healthians";
                $meta_details['meta_keyword']   = "arthritis test, healthians";
                $meta_details['meta_desc']      = "Book arthritis test from Healthians. 100% Accuracy Guranteed & Free Sample Collection. Book Now!";

                $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);
            }
            else if($link_rewrite === "heart-checkup") {
                $data['display_name']           = 'Heart Checkup';
                $data['display_order_price']    = 'Complete Package @ <span class="rupeesign" >₹</span> 899';
                $data['display_image']          = '/img/campaign/heart.jpg';

                $data['display_data'] = [  
                    0   => [ 
                        "headline"  => "To screen the risk of Coronary Artery Diseases & Heart Attack<br>Recommended in cases of : ",  
                        "data"      => ['Obesity', 'Sedentary Lifestyle', 'Alcohol Consumption', 'High Homocysteine levels', 'Family history of heart diseases']
                    ]
                ];

                $meta_details['meta_title']     = "Book heart checkup at Best Price | Healthians";
                $meta_details['meta_keyword']   = "heart checkup, healthians";
                $meta_details['meta_desc']      = "Book heart checkup from Healthians. 100% Accuracy Guranteed & Free Sample Collection. Book Now!";

                $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);
            }
            else if($link_rewrite === "chikungunya-test") {
                $data['display_name']           = 'Chikungunya Test';
                $data['display_order_price']    = 'Price Starting @ <span class="rupeesign">₹</span> 600';
                $data['display_image']          = '/img/campaign/Malaria.jpg';

                $data['display_data'] = [  
                    0   => [ 
                        "headline"  => "",  
                        "data"      => ['Required for detection of Chikungunya infection']
                    ]
                ];

                $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);
            }
            else if($link_rewrite === "typhoid-test") {
                $data['display_name']           = 'Typhoid Test';
                $data['display_order_price']    = 'Price Starting @ <span class="rupeesign">₹</span> 330';
                $data['display_image']          = '/img/campaign/Cancer.jpg';

                $data['display_data'] = [  
                    0   => [ 
                        "headline"  => "Recommended to diagnose typhoid fever<br> Medically advised incase of : ",  
                        "data"      => ['High fever', 'Abdominal pain', 'Headaches', 'Rose spots']
                    ]
                ];

                $meta_details['meta_title']     = "Book typhoid test at Best Price | Healthians";
                $meta_details['meta_keyword']   = "typhoid test, healthians";
                $meta_details['meta_desc']      = "Book typhoid test from Healthians. 100% Accuracy Guranteed & Free Sample Collection. Book Now!";

                $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);
            }
            else if($link_rewrite === "malaria-test") {
                $data['display_name']           = 'Malaria Test';
                $data['display_order_price']    = 'Price Starting @ <span class="rupeesign">₹</span> 350';
                $data['display_image']          = '/img/campaign/Malaria.jpg';

                $data['display_data'] = [  
                    0   => [ 
                        "headline"  => "",  
                        "data"      => ['Malarial Antigen', 'Vivax & Falciparum tests are a group of rapid diagnostic tests for quick diagnosis of malaria']
                    ]
                ];

                $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);
            }            
            else if($link_rewrite === "basic-female-hormones") {
                $data['display_name']           = 'Basic Female Hormones';
                $data['display_order_price']    = 'Price Starting @ <span class="rupeesign">₹</span> 899';
                $data['display_image']          = '/img/campaign/Basic-Female-Hormones.jpg';

                $data['display_data'] = [  
                    0   => [ 
                        "headline"  => "This package monitors the important female hormones, levels of which are responsible for : ",  
                        "data"      => ['Ovulation', 'Menstrual cycles', 'Fertilisation', 'Conception', 'Infertility cases']
                    ]
                ];

                $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);
            }
            else {
                return view('404_error');
            }
            
            $data['message'] = 'Customer search for : '.$data['display_name'];

            return view('landing_pages.health-test', $data);
            
        } catch (Exception $ex) {
            return view('404_error');
        }
    }

    /**
     * https://w1.healthians.co.in/web-campaign-health-checkup/test_pixel
     */
    public function webCampaignHealthCheckup($utm_id) {
        try {
            $request                  =   $this->request;

            $meta_details             = [
                'meta_title'    => '',
                'meta_keyword'  => '',
                'meta_desc'     => '',
                'canonical_url' => ''
            ];

            $data = [
                'city_detail'           => $this->city_detail,
                'utm_id'                => $utm_id,
                'ga_category'           => 'New Landing Yuvraaj',
                'ga_mobile_category'    => 'New Landing Yuvraaj - Mobile'
            ];

            $data['email_id']       =   $request->query('email');
            $data['name']           =   $request->query('name');
            $data['contact_no']     =   $request->query('mobile');
            $data['comment']        =   $request->query('comment');
            $data['utm_source']     =   $request->query('utm_source');
            $data['utm_campaign']   =   $request->query('utm_campaign');
            $data['utm_medium']     =   $request->query('utm_medium');
            $data['publisher_id']   =   $request->query('publisher_id');
            $data['source']         =   'web';

            $data['display_order_price']        = '2700/';
            $data['display_healthians_price']   = '999/-';
            $data['display_saving']             = '63%';
            $data['display_package']            = '(Kidney, Liver, Thyroid, Sugar, Lipid/Cholesterol, Blood, Urine)';
            $data['display_doc']                = 'DOCTOR CONSULTATION';
            $data['display_doc_text']           = 'Professional consultation.';
            $data['display_parameter_count']    = '74';

            if(empty($utm_id)) {
                $data['utm_id']  = 'web-campaign-health-checkup';         
            }

            $meta_details['meta_title']     = "Full Body Checkup @ Rs999 | 74 Health Tests | Healthians";
            $meta_details['meta_keyword']   = "full body checkup, health checkup, blood tests, lab tests";
            $meta_details['meta_desc']      = "Book Full Body Checkup from Healthians @ Rs999 Only. Including 74 Health Tests - LFT, KFT, TFT, Lipid, Sugar, CBC, Blood.";

            $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);

            return view('landing_pages.web-campaign-new', $data);
        }
        catch (Exception $ex) {
            return view('404_error');
        }
    }

    /**
     * https://w1.healthians.co.in/web-campaign-health-checkup-1099/test_pixel
     */
    public function webCampaignHealthCheckup1099($utm_id) {
        try {
            $request                  =   $this->request;

            $meta_details             = [
                'meta_title'    => "Full Body Checkup @ Rs1099 | 74 Health Tests | Healthians",
                'meta_keyword'  => "full body checkup, health checkup, blood tests, lab tests",
                'meta_desc'     => "Book Full Body Checkup from Healthians @ Rs1099 Only. Including 74 Health Tests - LFT, KFT, TFT, Lipid, Sugar, CBC, Blood.",
                'canonical_url' => ''
            ];

            $data = [
                'city_detail'           => $this->city_detail,
                'utm_id'                => $utm_id,
                'ga_category'           => 'Health Checkup - 1099',
                'ga_mobile_category'    => 'Health Checkup - 1099 - Mobile'
            ];

            $data['email_id']       =   $request->query('email');
            $data['name']           =   $request->query('name');
            $data['contact_no']     =   $request->query('mobile');
            $data['comment']        =   $request->query('comment');
            $data['utm_source']     =   $request->query('utm_source');
            $data['utm_campaign']   =   $request->query('utm_campaign');
            $data['utm_medium']     =   $request->query('utm_medium');
            $data['publisher_id']   =   $request->query('publisher_id');
            $data['source']         =   'web';

            $data['display_order_price']        = '2700/';
            $data['display_healthians_price']   = '1099/-';
            $data['display_saving']             = '59%';
            $data['display_package']            = '(Kidney, Liver, Thyroid, Sugar, Lipid/Cholesterol, Blood, Urine)';
            $data['display_doc']                = 'DOCTOR CONSULTATION';
            $data['display_doc_text']           = 'Professional consultation.';
            $data['display_parameter_count']    = '74';

            if(empty($utm_id)) {
                $data['utm_id']  = 'web-campaign-health-checkup';         
            }

            $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);

            return view('landing_pages.web-campaign-new', $data);
        }
        catch (Exception $ex) {
            return view('404_error');
        }
    }

    /**
     * https://w1.healthians.co.in/web-campaign-one-plus-one-full-body-checkup/test_pixel
     */
    public function webCampaignHealthCheckup1399($utm_id) {
        try {
            $request                  =   $this->request;

            $data = [
                'city_detail'           => $this->city_detail,
                'utm_id'                => $utm_id,
                'ga_category'           => 'One Plus One Landing - 1399',
                'ga_mobile_category'    => 'One Plus One Landing - 1399 - Mobile'
            ];

            $meta_details             = [
                'meta_title'    => 'One Plus One Full Body Checkup @1399 | Healthians',
                'meta_keyword'  => 'full body checkup, health checkup, blood tests, lab tests, one plus one health package',
                'meta_desc'     => 'Pay for 1 and book for 2. Book full body checkup for 2 @ Rs 1399 Only.',
                'canonical_url' => ''
            ];

            $data['email_id']       =   $request->query('email');
            $data['name']           =   $request->query('name');
            $data['contact_no']     =   $request->query('mobile');
            $data['comment']        =   $request->query('comment');
            $data['utm_source']     =   $request->query('utm_source');
            $data['utm_campaign']   =   $request->query('utm_campaign');
            $data['utm_medium']     =   $request->query('utm_medium');
            $data['publisher_id']   =   $request->query('publisher_id');
            $data['source']         =   'web';

            $data['display_order_price']        = '2550/';
            $data['display_healthians_price']   = '1399/-';
            $data['display_saving']             = '54%';
            $data['display_package_name']       = 'One Plus One Full Body Checkup';
            $data['display_package']            = '(Kidney, Liver, Thyroid, Lipid/Cholesterol, Complete Hemogram, Glucose)';
            $data['display_doc']                = 'DOCTOR CONSULTATION';
            $data['display_doc_text']           = 'Professional consultation.';
            $data['display_parameter_count']    = '60';

            if(empty($utm_id)) {
                $data['utm_id']  = 'web-campaign-one-plus-one-full-body-checkup';         
            }

            $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);

            return view('landing_pages.web-campaign-new', $data);
        }
        catch (Exception $ex) {
            return view('404_error');
        }
    }

    /**
     * https://w1.healthians.co.in/fullbody-package/test_pixel
     */
    public function fullBodyPackage($utm_id) {
        try {
            $request                  =   $this->request;

            $meta_details             = [
                'meta_title'    => 'Full Body Health Checkup @ Rs999 | 74 Health Tests | Healthians',
                'meta_keyword'  => 'full body checkup, health checkup, blood tests, lab tests',
                'meta_desc'     => 'Book Full Body Health Checkup from Healthians @ Rs999 Only. Including 74 Health Tests - LFT, KFT, TFT, Lipid, Sugar, CBC, Blood.',
                'canonical_url' => ''
            ];

            $data = [
                'city_detail'           => $this->city_detail,
                'utm_id'                => $utm_id,
                'ga_category'           => 'Full Body Checkup @ 999',
                'ga_mobile_category'    => 'Full Body Checkup @ 999- Mobile'
            ];

            $data['email_id']       =   $request->query('email');
            $data['name']           =   $request->query('name');
            $data['contact_no']     =   $request->query('mobile');
            $data['comment']        =   $request->query('comment');
            $data['utm_source']     =   $request->query('utm_source');
            $data['utm_campaign']   =   $request->query('utm_campaign');
            $data['utm_medium']     =   $request->query('utm_medium');
            $data['publisher_id']   =   $request->query('publisher_id');
            $data['source']         =   'web';

            if(empty($utm_id)) {
                return view('404_error');      
            }

            $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);

            return view('landing_pages.trust_landing_page', $data);
        }
        catch (Exception $ex) {
            return view('404_error');
        }
    }

    /**
     * https://w1.healthians.co.in/fullbody-blood-test/test_pixel
     */
    public function fullBodyBloodPackage($utm_id) {
        try {
            $request                  =   $this->request;

            $meta_details             = [
                'meta_title'    => 'Blood Test @Home | Lab Test @Home | Healthians',
                'meta_keyword'  => 'full body checkup, health checkup, blood tests, lab tests',
                'meta_desc'     => 'Path Lab Test @Home. Full Body Checkup Starts at Rs999 Only. Book Now!',
                'canonical_url' => ''
            ];

            $data = [
                'city_detail'           => $this->city_detail,
                'utm_id'                => $utm_id,
                'ga_category'           => 'Full Body Checkup - Blood Test @ 999',
                'ga_mobile_category'    => 'Full Body Checkup - Blood Test @ 999- Mobile'
            ];

            $data['email_id']       =   $request->query('email');
            $data['name']           =   $request->query('name');
            $data['contact_no']     =   $request->query('mobile');
            $data['comment']        =   $request->query('comment');
            $data['utm_source']     =   $request->query('utm_source');
            $data['utm_campaign']   =   $request->query('utm_campaign');
            $data['utm_medium']     =   $request->query('utm_medium');
            $data['publisher_id']   =   $request->query('publisher_id');
            $data['source']         =   'web';

            if(empty($utm_id)) {
                return view('404_error');      
            }

            $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);

            return view('landing_pages.blood_landing_page', $data);
        }
        catch (Exception $ex) {
            return view('404_error');
        }
    }
        
    /**
     * https://w1.healthians.co.in/womenday-special/test_pixel
     */
    public function womendaySpecial($utm_id) {
        try {
            $request                  =   $this->request;

            $data = [
                'city_detail'           =>  $this->city_detail,
                'utm_id'                =>  $utm_id,
                'ga_category'           =>  'Women Day Special @ 1466',
                'ga_mobile_category'    =>  'Women Day Special @ 1466- Mobile'
            ];

            $meta_details             = [
                'meta_title'    => 'Women Day Offer - Health package for women @1466 | Healthians',
                'meta_keyword'  => 'women day offer, women health package, full body checkup',
                'meta_desc'     => 'Book Health package for women @ Rs1466 Only. 65 Test Included. Book now',
                'canonical_url' => ''
            ];

            $data['email_id']       =   $request->query('email');
            $data['name']           =   $request->query('name');
            $data['contact_no']     =   $request->query('mobile');
            $data['comment']        =   $request->query('comment');
            $data['utm_source']     =   $request->query('utm_source');
            $data['utm_campaign']   =   $request->query('utm_campaign');
            $data['utm_medium']     =   $request->query('utm_medium');
            $data['publisher_id']   =   $request->query('publisher_id');
            $data['source']         =   'web';
            
            if(empty($utm_id)) {
                return view('404_error');      
            }

            $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);

            return view('landing_pages.womenday_landing_page', $data);
        }
        catch (Exception $ex) {
            return view('404_error');
        }
    }

    /**
     * https://w1.healthians.co.in/paytm
     */
    public function paytmSpecial() {
        try {
            $request                  =   $this->request;
            
            $route = request()->route()->getName();
            $this->seoDataProcess($route);

            $data = [
                'city_detail'           =>  $this->city_detail,
                'utm_id'                =>  'paytm-diabetes',
                'ga_category'           =>  'Paytm Diabetes',
                'ga_mobile_category'    =>  'Paytm Diabetes - Mobile'
            ];

            $meta_details             = [
                'meta_title'    => '',
                'meta_keyword'  => '',
                'meta_desc'     => '',
                'canonical_url' => ''
            ];

            $data['email_id']       =   $request->query('email');
            $data['name']           =   $request->query('name');
            $data['contact_no']     =   $request->query('mobile');
            $data['comment']        =   $request->query('comment');
            $data['utm_source']     =   $request->query('utm_source');
            $data['utm_campaign']   =   $request->query('utm_campaign');
            $data['utm_medium']     =   $request->query('utm_medium');
            $data['publisher_id']   =   $request->query('publisher_id');
            $data['source']         =   'web';

            $data['message']        = 'Customer search for : Diabetes';

            $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 1, 1);

            return view('landing_pages.paytm', $data);

        }
        catch (Exception $ex) {
            return view('404_error');
        }
    }

    
    /**
     * https://w1.healthians.co.in/campaign-complete-body-screening/test_pixel 
     */
    public function campaignCompleteBodyScreening($utm_id) {
        try {
            $request                  =   $this->request;

            $data = [
                'city_detail'           =>  $this->city_detail,
                'utm_id'                =>  $utm_id,
                'ga_category'           =>  'Campaign Complete Body Screening',
                'ga_mobile_category'    =>  'Campaign Complete Body Screening - Mobile',
                'city_html'             =>  ''
            ];

            $meta_details             = [
                'meta_title'    => '',
                'meta_keyword'  => '',
                'meta_desc'     => '',
                'canonical_url' => ''
            ];

            $data['email_id']       =   $request->query('email');
            $data['name']           =   $request->query('name');
            $data['contact_no']     =   $request->query('mobile');
            $data['comment']        =   $request->query('comment');
            $data['utm_source']     =   $request->query('utm_source');
            $data['utm_campaign']   =   $request->query('utm_campaign');
            $data['utm_medium']     =   $request->query('utm_medium');
            $data['publisher_id']   =   $request->query('publisher_id');
            $data['source']         =   'web';
            
            if(empty($utm_id)) {
                return view('404_error');      
            }

            $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);

            $city_html = '<div style="text-transform: capitalize;">';
            if(!empty($this->city_detail)) {
                $count_temp = 1;
                $city_count = count($this->city_detail);
                foreach($this->city_detail as $key => $ct) {
                    $city_html .= "<span style='padding-left: 5px;'> ".$ct;
                    
                    if($count_temp < $city_count ) {
                        $city_html .= " <span>|</span> ";
                    }
                    $city_html .= "</span>";
                    $count_temp++;
                }
            }
            $city_html .= "</div>";

            $data['city_html']  =   $city_html;

            return view('landing_pages.campaign-complete-body-screening', $data);
        }
        catch (Exception $ex) {
            return view('404_error');
        }
    }

    /**
     * http://newweb.com/health-test-full-body-checkup/test_pixel
     */
    public function trustHealthTestFullBody($utm_id) {
        try {
            $request                  =   $this->request;

            $meta_details             = [
                'meta_title'    => 'Blood Test @Home | Lab Test @Home | Healthians',
                'meta_keyword'  => 'full body checkup, health checkup, blood tests, lab tests',
                'meta_desc'     => 'Path Lab Test @Home. Full Body Checkup Starts at Rs. 999 Only. Book Now!',
                'canonical_url' => ''
            ];

            $data = [
                'city_detail'           => $this->city_detail,
                'utm_id'                => $utm_id,
                'ga_category'           => 'Full Body Check @ 999',
                'ga_mobile_category'    => 'Full Body Check @ 999- Mobile'
            ];

            $data['email_id']       =   $request->query('email');
            $data['name']           =   $request->query('name');
            $data['contact_no']     =   $request->query('mobile');
            $data['comment']        =   $request->query('comment');
            $data['utm_source']     =   $request->query('utm_source');
            $data['utm_campaign']   =   $request->query('utm_campaign');
            $data['utm_medium']     =   $request->query('utm_medium');
            $data['publisher_id']   =   $request->query('publisher_id');
            $data['source']         =   'web';
                        
            if(empty($utm_id)) {
                return view('404_error');      
            }

            $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);

            return view('landing_pages.trust_full_body_999', $data);
        }
        catch (Exception $ex) {
            return view('404_error');
        }
    }

    /* For Bengaluru
     * https://w1.healthians.co.in/lead-campaign-health-checkup/test_pixel 
     */
    public function leadCampaignHealthCheckup($utm_id) {
        try {
            $request                  =   $this->request;

            $data = [
                'city_detail'           =>  $this->city_detail,
                'utm_id'                =>  $utm_id,
                'ga_category'           =>  'Lead Campaign Health Checkup',
                'ga_mobile_category'    =>  'Lead Campaign Health Checkup - Mobile',
                'city_html'             =>  ''
            ];

            $meta_details             = [
                'meta_title'    => '',
                'meta_keyword'  => '',
                'meta_desc'     => '',
                'canonical_url' => ''
            ];

            $data['email_id']       =   $request->query('email');
            $data['name']           =   $request->query('name');
            $data['contact_no']     =   $request->query('mobile');
            $data['comment']        =   $request->query('comment');
            $data['utm_source']     =   $request->query('utm_source');
            $data['utm_campaign']   =   $request->query('utm_campaign');
            $data['utm_medium']     =   $request->query('utm_medium');
            $data['publisher_id']   =   $request->query('publisher_id');
            $data['source']         =   'web';

            if(empty($utm_id)) {
                return view('404_error');      
            }
            $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);

            $city_html = '<div style="text-transform: capitalize;">';
            if(!empty($this->city_detail)) {
                $count_temp = 1;
                $city_count = count($this->city_detail);
                foreach($this->city_detail as $key => $ct) {
                    $city_html .= "<span style='padding-left: 5px;'> ".$ct;
                    
                    if($count_temp < $city_count ) {
                        $city_html .= " <span>|</span> ";
                    }
                    $city_html .= "</span>";
                    $count_temp++;
                }
            }
            $city_html .= "</div>";

            $data['city_html']  =   $city_html;

            return view('landing_pages.lead-campaign-health-checkup', $data);
        }
        catch (Exception $ex) {
            //dd($ex);
            return view('404_error');
        }
    }

    /**
     * https://w1.healthians.co.in/hdfc
     */
    public function hdfcSpecial() {
        try {
            $request                  =   $this->request;
            
            $route = request()->route()->getName();
            $this->seoDataProcess($route);

            $data = [
                'city_detail'           =>  $this->city_detail,
                'utm_id'                =>  'business-development',
                'ga_category'           =>  'HDFC HarDostFit',
                'ga_mobile_category'    =>  'HDFC HarDostFit - Mobile'
            ];

            $meta_details             = [
                'meta_title'    => '',
                'meta_keyword'  => '',
                'meta_desc'     => '',
                'canonical_url' => ''
            ];

            $data['email_id']       =   $request->query('email');
            $data['name']           =   $request->query('name');
            $data['contact_no']     =   $request->query('mobile');
            $data['comment']        =   $request->query('comment');
            $data['utm_source']     =   $request->query('utm_source');
            $data['utm_campaign']   =   $request->query('utm_campaign');
            $data['utm_medium']     =   $request->query('utm_medium');
            $data['publisher_id']   =   $request->query('publisher_id');
            $data['source']         =   'web';
            $data['message']        =   'Customer search for : HarDostFit';

            $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 1, 1);

            return view('landing_pages.hdfc', $data);
        }
        catch (Exception $ex) {
            return view('404_error');
        }
    }


    public function getPopularPackage(Request $request) {
        /**
         * This is for Get Popular Packages
         */
        
        $validator = Validator::make($request->all(), [
            'city_id'   =>  'required|numeric'
        ]);


        /* Get Selected City Name */
        $city_id    = $request->input('city_id');

        if(!empty($this->city_detail)) {
            foreach($this->city_detail as $key => $ct) {              
                if($key == (int)$city_id) {
                    $city_name = $ct;
                }
            }
        }
     
        if(empty($city_name)) {
            $city_name      = 'gurgaon';    
        }
        
        try {       
            $popularPackageQueryParam  =   [
                'city'  => $city_name,
                'resource_type' => 'web'
            ];
            
            $popularPackage_url        = $this->api_url.''.config()->get('constants.popular_package_url');
            $popular_package_details   = handleGuzzleCurlRequest($popularPackage_url, 'GET', null, [], $popularPackageQueryParam);
            
            if(!empty($popular_package_details['data'])) {
                return $popular_package_details;
            }
            else {
                \Log::error(print_r($popular_package_details,true));
                throw new Exception("Something went wrong");
            }
        }
        catch (Exception $ex) {
            return response()->json([
                'status'    =>  false,
                'data'      =>  [],
                'message'   =>  $ex->getMessage()
            ], 500); // Status code here
        }

        return view('product.most_selling', $data);
    }


    /**
     * https://w1.healthians.co.in/envirer
     */
    public function envirerSpecial() {
        try {
            $request                  =   $this->request;
            
            $route = request()->route()->getName();
            $this->seoDataProcess($route);

            $data = [
                'city_detail'           =>  $this->city_detail,
                'utm_id'                =>  'envirer',
                'ga_category'           =>  'Envirer',
                'ga_mobile_category'    =>  'Envirer - Mobile',
                'city_html'             =>  ''
            ];

            $meta_details             = [
                'meta_title'    => '',
                'meta_keyword'  => '',
                'meta_desc'     => '',
                'canonical_url' => ''
            ];

            $data['email_id']       =   $request->query('email');
            $data['name']           =   $request->query('name');
            $data['contact_no']     =   $request->query('mobile');
            $data['comment']        =   $request->query('comment');
            $data['utm_source']     =   $request->query('utm_source');
            $data['utm_campaign']   =   $request->query('utm_campaign');
            $data['utm_medium']     =   $request->query('utm_medium');
            $data['publisher_id']   =   $request->query('publisher_id');
            $data['source']         =   'web';

            $data['message']        = 'Envirer | Customer search for : Personalised Full Body Packages';

            $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 1, 1);

            $city_html = '<div style="text-transform: capitalize;">';
            if(!empty($this->city_detail)) {
                $count_temp = 1;
                $city_count = count($this->city_detail);
                foreach($this->city_detail as $key => $ct) {
                    $city_html .= "<span style='padding-left: 5px;'> ".$ct;
                    
                    if($count_temp < $city_count ) {
                        $city_html .= " <span>|</span> ";
                    }
                    $city_html .= "</span>";
                    $count_temp++;
                }
            }
            $city_html .= "</div>";

            $data['city_html']  =   $city_html;

            return view('landing_pages.envirer', $data);

        }
        catch (Exception $ex) {
            return view('404_error');
        }
    }


    /**
     * https://w1.healthians.co.in/fullbody-package-2/test_pixel
     */
    public function fullBodyPackageStatic($utm_id) {
        try {
            $request                  =   $this->request;

            $meta_details             = [
                'meta_title'    => 'Full Body Health Checkup @ Rs999 | 74 Health Tests | Healthians',
                'meta_keyword'  => 'full body checkup, health checkup, blood tests, lab tests',
                'meta_desc'     => 'Book Full Body Health Checkup from Healthians @ Rs999 Only. Including 74 Health Tests - LFT, KFT, TFT, Lipid, Sugar, CBC, Blood.',
                'canonical_url' => ''
            ];

            $data = [
                'city_detail'           => $this->city_detail,
                'utm_id'                => $utm_id,
                'ga_category'           => 'Full Body Checkup - Static @ 999',
                'ga_mobile_category'    => 'Full Body Checkup - Static @ 999- Mobile'
            ];

            $data['email_id']       =   $request->query('email');
            $data['name']           =   $request->query('name');
            $data['contact_no']     =   $request->query('mobile');
            $data['comment']        =   $request->query('comment');
            $data['utm_source']     =   $request->query('utm_source');
            $data['utm_campaign']   =   $request->query('utm_campaign');
            $data['utm_medium']     =   $request->query('utm_medium');
            $data['publisher_id']   =   $request->query('publisher_id');
            $data['source']         =   'web';

            $data['message']        = 'Customer search for : Full Body Checkup';

            if(empty($utm_id)) {
                return view('404_error');      
            }

            $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);

            return view('landing_pages.full_body_package_static', $data);
        }
        catch (Exception $ex) {
            return view('404_error');
        }
    }

    /**
     * https://w1.healthians.co.in/fullbody-package-booknow/test_pixel
     */
    public function fullBodyPackageBookNow($utm_id) {
        try {
            $request                  =   $this->request;

            if(empty($utm_id)) {
                return view('404_error');      
            }

            $meta_details             = [
                'meta_title'    => 'Full Body Health Checkup @ Rs840 | 60 Health Tests | Healthians',
                'meta_keyword'  => 'full body checkup, health checkup, blood tests, lab tests',
                'meta_desc'     => 'Book Full Body Health Checkup from Healthians @ Rs840 Only. Including 60 Health Tests - LFT, KFT, TFT, Lipid, Sugar, CBC, Blood.',
                'canonical_url' => ''
            ];

            $data = [
                'city_detail'           => $this->city_detail,
                'ga_category'           => 'Full Body Checkup - Book Now @ 840',
                'ga_mobile_category'    => 'Full Body Checkup - Book Now @ 840- Mobile',
                'utm_id'                => $utm_id
            ];

            $data['source']         =   'web';
            $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'], 0, 0);

            $data['email_id']       =   $request->query('email');
            $data['name']           =   $request->query('name');
            $data['contact_no']     =   $request->query('mobile');
            $data['comment']        =   $request->query('comment');
            $data['utm_source']     =   $request->query('utm_source');
            $data['utm_campaign']   =   $request->query('utm_campaign');
            $data['utm_medium']     =   $request->query('utm_medium');
            $data['publisher_id']   =   $request->query('publisher_id');
            $data['source']         =   'web';

            $data['message']        = 'Customer search for : Full Body Checkup';

            return view('landing_pages.full_body_package_book_now', $data);
        }
        catch (Exception $ex) {
            return view('404_error');
        }
    }

}