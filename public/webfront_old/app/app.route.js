App.config(['$stateProvider', '$urlRouterProvider', '$locationProvider', 'FacebookProvider', 'GooglePlusProvider','$compileProvider',
    function($stateProvider, $urlRouterProvider, $locationProvider, FacebookProvider, GooglePlusProvider, $compileProvider) {
        $compileProvider.debugInfoEnabled(false);
        //$compileProvider.commentDirectivesEnabled(false);
        //$compileProvider.cssClassDirectivesEnabled(false);
        // $urlRouterProvider.otherwise(function($injector){
        //     var state = $injector.get('$state');
        //     var storage = $injector.get('$localStorage');

        //     if(storage.token == '' || storage.token == undefined)
        //         state.go('login');
        //     else
        //         state.go('dashboard.verified');
        // });

        var fbAppId = '872395496224431';
        
        FacebookProvider.init(fbAppId);
        // AccountKit_OnInteractive = function() {
        //     AccountKit.init({
        //         appId: fbAppId,
        //         debug: true,
        //         state: Math.random().toString(36).substr(2, 10),
        //         version: "v1.0",
        //         fbAppEventsEnabled: true
        //     });
        // };
        //accountKitProvider.configure(fbAppId, "v1.1", Math.random().toString(36).substr(2, 10), '/');

        GooglePlusProvider.init({
            clientId: '880130635777-fltq833404jubjmt62lr09qou2h3hjpe.apps.googleusercontent.com'
        });

        $urlRouterProvider.otherwise('/');

        $stateProvider

        .state('home', {
            url: '/',
            views: {
                '': {
                    templateUrl: 'app/views/home.html?v=23.0',
                    controller: 'homeController'
                },
                'footer@home': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('404-error', {
            url: '/404-error',
            views: {
                '': {
                    templateUrl: 'app/views/404-error.html',

                },
                'header@404-error': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                }
            }
        })
        .state('403-error', {
            url: '/403-error',
            views: {
                '': {
                    templateUrl: 'app/views/403-error.html',

                },
                'header@403-error': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                }
            }

        })
        .state('about-us', {
            url: '/about-us',
            views: {
                '': {
                    templateUrl: 'app/views/about.html?v=5.0'
                },

                'header@about-us': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },

                'footer@about-us': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('payment-summary', {
            url: '/payment-summary?merTxnId&booking_id&cardType&cardClassificationType&mobile&user_id&amt&source&payment_status',
            views: {
                '': {
                    templateUrl: 'app/views/payment-summary.html?v=6.0',
                    controller: 'paymentSummaryController'
                },

                'header@payment-summary': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },

                'footer@payment-summary': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('career', {
            url: '/career',
            views: {
                '': {
                    templateUrl: 'app/views/career.html?v=4.0',
                    controller: 'careerController'
                },

                'header@career': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },

                'collapse@career': {
                    templateUrl: 'app/views/bootstrap-collapse.html',
                },

                'footer@career': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('contact-us', {
            url: '/contact-us',
            views: {
                '': {
                    templateUrl: 'app/views/contact.html?v=4.0',
                    controller: 'contactUsController'
                },

                'header@contact-us': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },

                'footer@contact-us': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('healthians-investors', {
            url: '/healthians-investors',
            views: {
                '': {
                    templateUrl: 'app/views/healthians-investors.html?v=1.0'
                },

                'header@healthians-investors': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },

                'footer@healthians-investors': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('healthians-media', {
            url: '/healthians-media',
            views: {
                '': {
                    templateUrl: 'app/views/healthians-media.html?v=1.0'
                },

                'header@healthians-media': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },

                'footer@healthians-media': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('orderbook', {
            url: '/orderbook',
            cache: false,
            views: {
                '': {
                    templateUrl: 'app/views/orderBook.html?v=14.0',
                    controller: 'bookOrderController'

                },

                'header@orderbook': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },

                'footer@orderbook': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            }
        })
        .state('dashboard', {
            url: '/dashboard',
            views: {
                '': {
                    templateUrl: 'app/views/dashboard.html',
                    controller: 'dashboardController'

                },
                'header@dashboard': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@dashboard': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('payment-fail', {
            url: '/payment-fail',
            views: {
                '': {
                    templateUrl: 'app/views/oops-failed.html',
                    controller: 'paymentFailController'
                },
                'header@payment-fail': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@payment-fail': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('makepayment', {
            url: '/makepayment?mobile&booking_id&source&pid&subscription_id&payment_type_source&service_booking_id',
            views: {
                '': {
                    templateUrl: 'app/views/makepayment/make-payment.html?v=9.0',
                    controller: 'makeOrderPaymentController'
                },
                'header@makepayment': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@makepayment': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('reset_password', {
            url: '/reset_password/:id',
            views: {
                '': {
                    templateUrl: 'app/views/reset-password.html',
                    controller: 'resetPasswordController'
                },

                'header@reset_password': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },

                'footer@reset_password': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            }
        })
        .state('account_verify', {
            url: '/account_verify/:id/:key',
            views: {
                '': {
                    templateUrl: 'app/views/account-activation.html',
                    controller: 'accountActivationController'
                },
                'header@account_verify': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@account_verify': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            }
        })
        .state('package', {
            url: '/package/:link_rewrite?email&name&mobile&comment&utm_source&utm_campaign&utm_medium&publisher_id',
            views: {
                '': {
                    templateUrl: 'app/views/ProductDetail.html?v=30.0',
                    controller: 'packageController'
                },
                'header@package': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                }
            },
            cache: false
        })
         .state('profile', {
                url: '/profile/:link_rewrite?email&name&mobile&comment&utm_source&utm_campaign&utm_medium&publisher_id',
                views: {
                    '': {
                        templateUrl: 'app/views/ProductDetail.html?v=30.0',
                        controller: 'packageController'
                    },
                    'header@profile': {
                        templateUrl: 'app/views/header.html?v=14.0',
                        controller: 'headerController'
                    }
                },
                cache: false
            })
         .state('parameter', {
                url: '/parameter/:link_rewrite?email&name&mobile&comment&utm_source&utm_campaign&utm_medium&publisher_id',
                views: {
                    '': {
                        templateUrl: 'app/views/ProductDetail.html?v=30.0',
                        controller: 'packageController'
                    },
                    'header@parameter': {
                        templateUrl: 'app/views/header.html?v=14.0',
                        controller: 'headerController'
                    }
                },
                cache: false
            })
            .state('addtocart', {
                url: '/addtocart',
                views: {
                    '': {
                        templateUrl: 'template/instantAddToCart.html',
                        controller: 'instantbookingController'
                    },
                },
                cache: false
            })

        .state('packagebook', {
            url: '/book/:package_book',
            views: {
                '': {
                    templateUrl: 'app/views/staticBooking.html',
                    controller: 'instantbookingController'
                },
            },
            cache: false
        })
        .state('order', {
            url: '/order/:booking_id',
            views: {
                '': {
                    templateUrl: 'app/views/order-tracking.html?v=5.0',
                    controller: 'orderTrackingController'
                },
                'header@order': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@order': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('final_checkout', {
            url: '/final_checkout',
            views: {
                '': {
                    templateUrl: 'app/views/final_checkout.html?v=11.0',
                    controller: 'finalCheckoutController'
                },
                'header@final_checkout': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@final_checkout': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('user_selection_cart', {
            url: '/user_selection_cart',
            views: {
                '': {
                    templateUrl: 'app/views/user_selection_cart.html?v=2.0',
                    controller: 'userSelectionToCartController'
                },
                'header@user_selection_cart': {
                    templateUrl: 'app/views/header.html?v=4.0',
                    controller: 'headerController'
                },
                'footer@user_selection_cart': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('cart', {
            url: '/cart',
            views: {
                '': {
                    templateUrl: 'app/views/cart.html?v=6.0',
                    controller: 'cartController'
                },
                'header@cart': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@cart': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
		.state('referral', {
            url: '/referral/:user_id',
            views: {
                '': {
                    templateUrl: 'app/views/referral.html?v=1.0',
                    controller: 'referralController'
                },
                'header@referral': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@referral': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            }
        })
        .state('web-campaign', {
            url: '/web-campaign/:utmid?email&name&mobile&comment&utm_source&utm_campaign&utm_medium&publisher_id',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/web-compaign.html?v=3.0',
                    controller: 'compaignController'
                }
            },
            cache: false
        })	
        .state('most-selling', {
            url: '/most-selling',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/most-selling.html?v=2.0',
                    controller: 'mostSellingController'
                },
                'header@most-selling': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@most-selling': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
		.state('deals', {
            url: '/deals',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/deals.html?v=15.0',
                    controller: 'footerController'
                },
                'header@deals': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@deals': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
		.state('labs', {
            url: '/labs',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/labs.html?v=8.0',
                    controller: 'uploadPrescriptionController'
                },
                'header@labs': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@labs': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('missed-call', {
            url: '/lead/missed-call/:phone_number',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/missed-call.html?v=2.0',
                    controller: 'missedcallController'
                },
                'header@missed-call': {
                    templateUrl: 'app/views/header_only_logo.html?v=15.0',
                    controller: 'headerController'
                }
            }
        })
        .state('subscription-payment-summary', {
            url: '/subscription-payment-summary?merTxnId&subscription_id&cardType&cardClassificationType&mobile&user_id&amt&source',
            views: {
                '': {
                    templateUrl: 'app/views/subscription-payment-summary.html',
                    controller: 'subscriptionPaymentSummaryController'
                },
                'header@subscription-payment-summary': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@subscription-payment-summary': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            }
        })
        .state('subscribe-payment-fail', {
            url: '/subscribe-payment-fail',
            views: {
                '': {
                    templateUrl: 'app/views/subscribe-oops-failed.html',
                    controller: 'subscriptionPaymentFailController'
                },
                'header@subscribe-payment-fail': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@subscribe-payment-fail': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            }
        })
        .state('refund-policy', {
            url: '/refund-policy',
            views: {
                '': {
                    templateUrl: 'app/views/refund-policy.html'
                },
                'header@refund-policy': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@refund-policy': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
		.state('upload-prescription', {
            url: '/upload-prescription',
            views: {
                '': {
                    templateUrl: 'app/views/upload-prescription.html?v=1.0',
                    controller: 'uploadPrescriptionController'
                },
                'header@upload-prescription': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@upload-prescription': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('lab-visit', {
            url: '/lab-visit',
            views: {
                '': {
                    templateUrl: 'app/views/lab-visit.html?v=2.0',
                    controller: 'uploadPrescriptionController'
                },
                'header@lab-visit': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@lab-visit': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('feedback', {
            url: '/feedback',
            views: {
                '': {
                    templateUrl: 'app/views/feedback.html?v=4.0',
                    controller: 'uploadPrescriptionController'
                },
                'header@feedback': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@feedback': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('mybooking', {
            url: '/mybooking',
            views: {
                '': {
                    templateUrl: 'app/views/mybooking.html?v=1.0',
                    controller: 'myBookingController'
                },
                'header@mybooking': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@mybooking': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('myreport', {
            url: '/myreport',
            views: {
                '': {
                    templateUrl: 'app/views/myreport.html',
                    controller: 'myReportController'
                },
                'header@myreport': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@myreport': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        // .state('trf', {
        //     url: '/trf?booking_id&mobile',
        //     views: {
        //         '': {
        //             templateUrl: 'app/views/trf.html',
        //             controller: 'trfController'
        //         },
        //         'header@trf': {
        //             templateUrl: 'app/views/header.html?v=14.0',
        //             controller: 'headerController'
        //         },
        //         'footer@myreport': {
        //             templateUrl: 'app/views/footer.html?v=4.0',
        //             controller: 'footerController'
        //         }
        //     },
        //     cache: false
        // })
        .state('dengue', {
            url: '/dengue/:utmid?email&name&mobile&comment&utm_source&utm_campaign&utm_medium',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/dengue.html?v=2.0',
                    controller: 'compaignController'
                }
            },
            cache: false
        })
        .state('technical_video', {
            url: '/technical_video?booking_id&mobile',
            views: {
                '': {
                    templateUrl: 'app/views/technical_video.html',
                    controller: 'technicalVideoController'
                },
                'header@technical_video': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@technical_video': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
		.state('maternal-serum', {
            url: '/maternal-serum?booking_id&customer_id',
            views: {
                '': {
                    templateUrl: 'app/views/maternal-serum.html?v=3.0',
                    controller : 'maternalSerumController'
                },
                'header@maternal-serum': {
                    templateUrl: 'app/views/header_only_logo.html?v=15.0',
                    controller: 'headerController'
                }
            },
            cache: false
        })
        .state('sample-collection-feedback', {
            url: '/sample-collection-feedback?booking_id&mobile&click_source',
            views: {
                '': {
                    templateUrl: 'app/views/sample_collection_feedback.html',
                    controller: 'phelboFeedbackController'
                },
                'header@sample-collection-feedback': {
                    templateUrl: 'app/views/header_only_logo.html?v=1.0',
                    controller: 'headerController'
                }
            },
            cache: false
        })		
		.state('nps', {
            url: '/nps?booking_id&mobile&click_source',
            views: {
                '': {
                    templateUrl: 'app/views/net-promoter-score.html?v=1.0',
                    controller: 'generalFeedbackController'
                },
                'header@nps': {
                    templateUrl: 'app/views/header_only_logo.html?v=1.0',
                    controller: 'headerController'
                }
            },
            cache: false
        }).
        state('myaddress', {
            url: '/myaddress',
            views: {
                '': {
                    templateUrl: 'app/views/myaddress.html?v=2.0',
                    controller: 'myAddressController'
                },
                'header@myaddress': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@myaddress': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
		.state('web-campaign-health-checkup', {
            url: '/web-campaign-health-checkup/:utmid?email&name&mobile&comment&utm_source&utm_campaign&utm_medium&publisher_id',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/web-campaign-new.html?v=9.0',
                    controller: 'compaignController'
                },

                'header@web-campaign-health-checkup': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },

                'footer@web-campaign-health-checkup': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('web-campaign-health-checkup-1099', {
            url: '/web-campaign-health-checkup-1099/:utmid?email&name&mobile&comment&utm_source&utm_campaign&utm_medium&publisher_id',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/web-campaign-1099.html?v=6.0',
                    controller: 'compaignController'
                },

                'header@web-campaign-health-checkup-1099': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },

                'footer@web-campaign-health-checkup-1099': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('web-campaign-health-checkup-999', {
            url: '/web-campaign-health-checkup-999/:utmid?email&name&mobile&comment&utm_source&utm_campaign&utm_medium&publisher_id',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/web-campaign-999.html?v=5.0',
                    controller: 'compaignController'
                },

                'header@web-campaign-health-checkup-999': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },

                'footer@web-campaign-health-checkup-999': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('web-campaign-health-checkup-book-now', {
            url: '/web-campaign-health-checkup-book-now/:utmid?email&name&mobile&comment&utm_source&utm_campaign&utm_medium&publisher_id',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/web-campaign-new-book-now.html?v=5.0',
                    controller: 'compaignController'
                },

                'header@web-campaign-health-checkup-book-now': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },

                'footer@web-campaign-health-checkup-book-now': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('web-campaign-health-checkup-free-call', {
            url: '/web-campaign-health-checkup-free-call/:utmid?email&name&mobile&comment&utm_source&utm_campaign&utm_medium&publisher_id',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/web-campaign-new-free-call.html?v=5.0',
                    controller: 'compaignController'
                },

                'header@web-campaign-health-checkup-free-call': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },

                'footer@web-campaign-health-checkup-free-call': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('web-campaign-health-checkup-599', {
            url: '/web-campaign-health-checkup-599/:utmid?email&name&mobile&comment&utm_source&utm_campaign&utm_medium&publisher_id',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/web-campaign-new.html?v=9.0',
                    controller: 'compaignController'
                },

                'header@web-campaign-health-checkup-599': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },

                'footer@web-campaign-health-checkup-599': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
		.state('web-campaign-facebook-leads', {
            url: '/web-campaign-facebook-leads/:utmid?email&name&mobile&comment&utm_source&utm_campaign&utm_medium&publisher_id',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/facebook-leads.html?v=7.0',
                    controller: 'compaignController'
                },

                'header@web-campaign-facebook-leads': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },

                'footer@web-campaign-facebook-leads': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
		.state('web-campaign-family', {
            url: '/web-campaign-family/:utmid?email&name&mobile&comment&utm_source&utm_campaign&utm_medium&publisher_id',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/web-campaign-new-p.html?v=7.0',
                    controller: 'compaignController'
                },

                'header@web-campaign-family': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },

                'footer@web-campaign-family': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
		.state('health-test', {
            url: '/health-test/:link_rewrite/:utmid?email&name&mobile&comment&utm_source&utm_campaign&utm_medium&publisher_id',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/health_test.html?v=7.0',
                    controller: 'healthtestController'
                }
            },
            cache: false
        })
        .state('package-campaign', {
            url: '/package-campaign/:utmid?email&name&mobile&comment&utm_source&utm_campaign&utm_medium&publisher_id',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/package-campaign.html?v=4.0',
                    controller: 'compaignController'
                }
            },
            cache: false
        })
        .state('healthkarma', {
            url: '/healthkarma?user_id&mobile&lead_id',
            views: {
                '': {
                    templateUrl: 'app/views/healthkarmaquestion.html?v=4.0',
                    controller: 'healthKarmaController'
                },
                'header@healthkarma': {
                    templateUrl: 'app/views/header_only_logo.html?v=15.0',
                    controller: 'headerController'
                }
            },
            cache: false
        })
        .state('service-payment-summary', {
            url: '/service-payment-summary?merTxnId&service_booking_id&cardType&cardClassificationType&mobile&user_id&amt&source',
            views: {
                '': {
                    templateUrl: 'app/views/service-payment-summary.html',
                    controller: 'servicePaymentSummaryController'
                },
                'header@service-payment-summary': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@service-payment-summary': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('service-payment-fail', {
            url: '/service-payment-fail',
            views: {
                '': {
                    templateUrl: 'app/views/service-oops-failed.html',
                    controller: 'servicePaymentFailController'
                },
                'header@service-payment-fail': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@service-payment-fail': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
		.state('wellness-program', {
            url: '/wellness-program',
            views: {
                '': {
                    templateUrl: 'app/views/wellness-program.html?v=1.0'
                },
				'footer@wellness-program': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
		.state('virtual-tour', {
            url: '/virtual-tour',
            views: {
                '': {
                    templateUrl: 'app/views/virtual-tour.html'
                },
				'header@virtual-tour': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@virtual-tour': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('risk', {
            url: '/risk/:search_name',
            views: {
                '': {
                    templateUrl: 'app/views/habitRiskDetails.html?v=8.0',
                    controller: 'habitRiskDetailsController'
                },
                'header@risk': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@risk': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('habit', {
            url: '/habit/:search_name',
            views: {
                '': {
                    templateUrl: 'app/views/habitRiskDetails.html?v=8.0',
                    controller: 'habitRiskDetailsController'
                },
                'header@habit': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@habit': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('web-campaign-one-plus-one-full-body-checkup', {
            url: '/web-campaign-one-plus-one-full-body-checkup/:utmid?email&name&mobile&comment&utm_source&utm_campaign&utm_medium&publisher_id',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/web-campaign-new.html?v=9.0',
                    controller: 'compaignController'
                },

                'header@web-campaign-one-plus-one-full-body-checkup': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },

                'footer@web-campaign-one-plus-one-full-body-checkup': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('web-campaign-healthians-summer-special-package', {
            url: '/web-campaign-healthians-summer-special-package/:utmid?email&name&mobile&comment&utm_source&utm_campaign&utm_medium&publisher_id',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/web-campaign-new.html?v=9.1',
                    controller: 'compaignController'
                },

                'header@web-campaign-healthians-summer-special-package': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },

                'footer@web-campaign-healthians-summer-special-package': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('makebookingservicepayment', {
            url: '/makebookingservicepayment?mobile&booking_id&source&pid&payment_type_source&service_booking_id',
            views: {
                '': {
                    templateUrl: 'app/views/makepayment/make-booking-service-payment.html',
                    controller: 'makeOrderServicePaymentController'
                },
                'header@makebookingservicepayment': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@makebookingservicepayment': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
		.state('web-campaign-adwords', {
            url: '/web-campaign-adwords/:utmid?email&name&mobile&comment&utm_source&utm_campaign&utm_medium&publisher_id',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/web-campaign-adwords.html?v=5.1',
                    controller: 'compaignController'
                },

                'header@web-campaign-adwords': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },

                'footer@web-campaign-adwords': {
                    templateUrl: 'app/views/footer.html?v=1.1',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('booking-service-payment-summary', {
            url: '/booking-service-payment-summary?merTxnId&booking_id&service_booking_id&cardType&cardClassificationType&mobile&user_id&amt&source',
            views: {
                '': {
                    templateUrl: 'app/views/booking-service-payment-summary.html',
                    controller: 'orderServicePaymentSummaryController'
                },
                'header@booking-service-payment-summary': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@booking-service-payment-summary': {
                     templateUrl: 'app/views/footer.html?v=1.1',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('health-checkup', {
            url: '/health-checkup/:link_rewrite/:utmid?email&name&mobile&comment&utm_source&utm_campaign&utm_medium&publisher_id',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/health_checkup.html?v=4.0',
                    controller: 'healthcheckupController'
                }
            },
            cache: false
        })
        .state('booking_verification', {
            url: '/booking_verification?booking_id&mobile',
            views: {
                '': {
                    templateUrl: 'app/views/booking_verification.html?v=1.0',
                    controller: 'bookingVerificationController'
                },
                'header@booking_verification': {
                    templateUrl: 'app/views/header_only_logo.html?v=15.0',
                    controller: 'headerController'
                }                
            },
            cache: false
        })
        .state('booking-service-payment-fail', {
            url: '/booking-service-payment-fail',
            views: {
                '': {
                    templateUrl: 'app/views/booking-service-oops-failed.html',
                    controller: 'bookingServicePaymentFailController'
                },
                'header@booking-service-payment-fail': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@booking-service-payment-fail': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('unsubscribe', {
            url: '/unsubscribe/:email?type',
            views: {
                '': {
                    templateUrl: 'app/views/unsubscribe.html',
                    controller: 'unsubscribeController'
                },
                'footer@unsubscribe': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
		.state('bengaluru-health-karma', {
            url: '/bengaluru-health-karma/',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/bengaluru-health-karma.html',
                    controller: 'promoteHealthKarmaController'
                },
                'footer@bengaluru-health-karma': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },            
        })			
		.state('healthkarma-v2', {
            url: '/healthkarma-v2?user_id&mobile&lead_id',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/healthkarma-v2.html?v=2.0',
                    controller: 'healthKarmaController'
                },
                'header@healthkarma-v2': {
                    templateUrl: 'app/views/header_only_logo.html?v=2.0',
                    controller: 'headerController'
                }
            },
            cache: false
        })
		.state('campaign-complete-body-screening', {
            url: '/campaign-complete-body-screening/:utmid?email&name&mobile&comment&utm_source&utm_campaign&utm_medium&publisher_id',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/complete-body-screening.html?v=4.0',
                    controller: 'compaignController'
                },

                'header@campaign-complete-body-screening': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },

                'footer@campaign-complete-body-screening': {
                    templateUrl: 'app/views/footer.html?v=1.1',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('csat', {
            url: '/csat/:csid',
            views: {
                '': {
                    templateUrl: 'app/views/csat.html',
                    controller: 'csatFeedbackController'
                },
                'header@csat': {
                    templateUrl: 'app/views/header_only_logo.html?v=15.0',
                    controller: 'headerController'
                }                
            }
        })
        .state('phlebo-route', {
            url: '/phlebo-route?user_id&booking_id',
            views: {
                '': {
                    templateUrl: 'app/views/phlebo-route-new.html?v=11.0',
                    controller: 'phleboRouteController'
                },
                'header@phlebo-route': {
                    templateUrl: 'app/views/header_only_logo.html?v=15.0',
                    controller: 'headerController'
                }
            },
            cache: false
        }).state('lead-campaign-health-checkup', {
            url: '/lead-campaign-health-checkup/:utmid?email&name&mobile&comment&utm_source&utm_campaign&utm_medium&publisher_id',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/web-campaign-lead-bengaluru.html?v=10.1',
                    controller: 'compaignController'
                },

                'header@lead-campaign-health-checkup': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },

                'footer@lead-campaign-health-checkup': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('phlebo-route-old', {
            url: '/phlebo-route-old?user_id&booking_id',
            views: {
                '': {
                    templateUrl: 'app/views/phlebo-route.html?v=1.0',
                    controller: 'phleboRouteController'
                },
                'header@phlebo-route-old': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@phlebo-route-old': {
                    templateUrl: 'app/views/footer.html?v=1.1',
                    controller: 'footerController'
                }
            },
            cache: false
        })
		.state('paytm', {
            url: '/paytm',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/paytm_special.html?v=2.0',
                    controller: 'paytmPromoteController'
                },
                'footer@paytm': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },            
        })

        .state('hdfc', {
            url: '/hdfc',
            views: {
                '': {
                    templateUrl: 'app/views/compaign/hdfc_special.html?v=2.0',
                    controller: 'paytmPromoteController'
                },
                'footer@hdfc': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },            
        })
        .state('terms-condition', {
            url: '/terms-condition',
            views: {
                '': {
                    templateUrl: 'app/views/terms-conditions.html?v=11.0'
                },
                'header@terms-condition': {
                    templateUrl: 'app/views/header.html?v=14.0',
                    controller: 'headerController'
                },
                'footer@terms-condition': {
                    templateUrl: 'app/views/footer.html?v=4.0',
                    controller: 'footerController'
                }
            },
            cache: false
        })
        .state('offer-terms-conditions', {
            url: '/offer-terms-conditions',
            views: {
                '': {
                    templateUrl: 'app/views/terms-health25.html?v=2.0'
                },
                'header@offer-terms-conditions': {
                    templateUrl: 'app/views/header_only_logo.html?v=15.0',
                    controller: 'headerController'
                }
            },
            cache: false
        });
		
        $locationProvider.html5Mode({
            enabled: true,
            requireBase: false
        });
    }
]);


App.run(['$location', '$window', '$rootScope', '$anchorScroll', '$state', 'fbService', 'companyinfo', '$templateCache', '$localStorage', '$document', '$timeout', function($location, $window, $rootScope, $anchorScroll, $state, fbService, companyinfo, $templateCache, $localStorage, $document, $timeout) {

    $rootScope.loggedin = false;
    $rootScope.user = "";
    $rootScope.totalCartTest = 0;
    $rootScope.meta_robots = "index,follow";

    $rootScope.gCatchaKey = '6LcqInUUAAAAAJYyfRX0gLFeuzieL4Sq7Q8rKGJy';

    function S4() {
        return (((1+Math.random())*0x10000)|0).toString(16).substring(1); 
    }

    if (typeof localStorage === 'object') {
        try {
            localStorage.setItem('localStorage', 1);
            localStorage.removeItem('localStorage');

            if(localStorage.getItem("guid")) {

            }
            else {
                var guid = (S4() + S4() + "-" + S4() + "-4" + S4().substr(0,3) + "-" + S4() + "-" + S4() + S4() + S4()).toLowerCase();
                localStorage.setItem("guid", guid);
            }
        } catch (e) {
            $window.alert('Your web browser does not support storing settings locally. In Safari, the most common cause of this is using "Private Browsing Mode". Some settings may not save or some features may not work properly for you. Request you to kindly visit the website in Public Mode.');
        }
    }

    companyinfo.getCompanyInfo(function(data) {
        if(data.status) {
            if(data.data) {
                $rootScope.companyphone = data.data.contact_no;
                $rootScope.companyemail = data.data.email;
                $rootScope.companyaddress = data.data.address;
            }
        }
    });

    function IdleByTimer() {
        if (document.cookie && document.cookie.indexOf('IdleLeadCookie=1') != -1) {
            /* Cookie present - nothing to do */
        }
        else {
            var now = new Date();
            var exp = new Date(now.getTime() + (1 * 24 * 60 * 60 * 1000));
            document.cookie = 'IdleLeadCookie=1; expires=' + exp.toUTCString();
            companyinfo.sendIdleLeadInfo(function(data) {                
                document.cookie = 'IdleLeadCookie=1; expires=' + exp.toUTCString();
            });
        }        
        
        ///////////////////////////////////////////////////
        /// redirect to another page(eg. Login.html) here
        ///////////////////////////////////////////////////
    }


    function startCheckIDle() {
        // Timeout timer value
        var TimeOutTimerValue = 480000;

        // Start a timeout
        var TimeOut_Thread = $timeout(function(){ IdleByTimer() } , TimeOutTimerValue);
        var bodyElement = angular.element($document);

        /// Keyboard Events
        bodyElement.bind('keydown', function (e) { TimeOut_Resetter(e) });  
        bodyElement.bind('keyup', function (e) { TimeOut_Resetter(e) });    
        bodyElement.bind('keypress', function (e) { TimeOut_Resetter(e) }); 

        /// Mouse Events    
        bodyElement.bind('click', function (e) { TimeOut_Resetter(e) });
        bodyElement.bind('dblclick', function (e) { TimeOut_Resetter(e) });
        bodyElement.bind('mousemove', function (e) { TimeOut_Resetter(e) });    
        bodyElement.bind('DOMMouseScroll', function (e) { TimeOut_Resetter(e) });
        bodyElement.bind('mousewheel', function (e) { TimeOut_Resetter(e) });   
        bodyElement.bind('mousedown', function (e) { TimeOut_Resetter(e) });        
            
        /// Touch Events
        bodyElement.bind('touchstart', function (e) { TimeOut_Resetter(e) });       
        bodyElement.bind('touchmove', function (e) { TimeOut_Resetter(e) });        
        
        /// Common Events
        bodyElement.bind('scroll', function (e) { TimeOut_Resetter(e) });       
        bodyElement.bind('focus', function (e) { TimeOut_Resetter(e) });    

        

        function TimeOut_Resetter(e) {          
            /// Stop the pending timeout
            $timeout.cancel(TimeOut_Thread);
            
            /// Reset the timeout
            TimeOut_Thread = $timeout(function(){ IdleByTimer() } , TimeOutTimerValue);
        }
    }

    // $rootScope.$on('$viewContentLoaded', function() {
    //   $templateCache.removeAll();
    //   $templateCache.destroy();
    // });

    $rootScope.$on('userLoggedInSuccess', function(event, data) {
        if(fbService.checkLoggedIn()) {
            startCheckIDle();
        }
    });

    $rootScope.$on('$stateChangeSuccess', function(event) {

        if(typeof($window.clevertap) !== 'undefined') {
            var restrictCleverTap = ['lead-campaign-health-checkup', 'campaign-complete-body-screening', 
            'health-checkup', 'web-campaign-adwords', 'web-campaign-healthians-summer-special-package', 
            'web-campaign-one-plus-one-full-body-checkup', 'health-test', 'web-campaign-family', 
            'web-campaign-facebook-leads', 'web-campaign-health-checkup-599', 'web-campaign-health-checkup-free-call', 
            'web-campaign-health-checkup-book-now','web-campaign-health-checkup-1099', 'web-campaign-health-checkup-999', 
            'web-campaign-health-checkup', 'dengue', 'web-campaign', 'phlebo-route'];

            //console.log("state name", $state.current.name);
            
            if (!_.contains(restrictCleverTap, $state.current.name)) {
                $window.clevertap.notifications.push({
                    "titleText":'Would you like to receive Push Notifications?',
                    "bodyText":'We promise to only send you relevant content and give you updates on your transactions',
                    "okButtonText":'Sign me up!',
                    "rejectButtonText":'No thanks',
                    "okButtonColor":'#00a0a8'
                });
            }       
        }
        
        // $templateCache.removeAll();
        // $templateCache.destroy();
        //$rootScope.meta_canonical = $location.absUrl();
        $rootScope.meta_canonical = "https://www.healthians.com"+$location.$$url;
        if ($state.current.name == 'home') {
            localStorage.setItem("titleurl", "home");
            $rootScope.title = "India’s largest Blood Test & Health Test @ Home Service | Healthians";
            $rootScope.description = "Largest blood test & health test online service in India. Free sample collection. Best quality and prices for CBC, Blood Sugar, HbA1c, LFT, KFT, Thyroid, Dengue, Chikungunya and other tests.";
            $rootScope.keyword = "online blood test, online health test, blood test online, health check-up online, whole body checkup, complete body checkup, blood test home service, free sample collection, free health counselling, blood collection at home, Lipid profile test, thyroid test, kidney function test, liver function test, blood sugar, hba1c, diabetes test";
            $rootScope.og_image = "https://cdn1.healthians.com/assets/images/logo.png";
            $rootScope.og_url = "https://www.healthians.com";
            
        } else if ($state.current.name == 'package' || $state.current.name == 'parameter' || $state.current.name == 'profile') {
            localStorage.setItem("titleurl", $state.current.name);
            $rootScope.og_image = "https://cdn1.healthians.com/assets/images/logo.png";
            $rootScope.og_url = "https://www.healthians.com";
        } 
        else if ($state.current.name == 'lifestyle') {
            localStorage.setItem("titleurl", $state.current.name);
            $rootScope.title = "Health Karma | Predective Health Risk Assessment | Get the impact of your lifestyle | Get Recommendations";
            $rootScope.description = "This is my lifestyle score. Wanna check yours! Download Healthians app and get your lifestyle score now.";
            $rootScope.keyword = "Lipid profile test, thyroid test, blood test, kidney function test, liver function test, blood sugar test, hbaic test, diabetes test, full body checkup, master health checkup";
        }
        else if ($state.current.name == 'health-se-milegi-wealth-ki-chaabi-lucky-draw') {
            localStorage.setItem("titleurl", $state.current.name);
            $rootScope.title = "Full Body Checkup @ Rs 1999 - Buy One Get One Free | Healthians Diwali Offer";
            $rootScope.description = "Diwali Bumper Offer - Book full body checkup package at Rs 1999 and get another free for your family member. Also get a chance to win Renault kwid";
            $rootScope.keyword = "Diwali offer, book health check, full body checkup, Renault kwid offer, win Renault kwid, buy 1 get 1 offer, healthians offer";
        }
        else if ($state.current.name == 'web-campaign' || $state.current.name == 'package-campaign') {
            var link = document.createElement('link');
            link.setAttribute('rel', 'stylesheet');
            link.setAttribute('title', 'campaign1');
            link.setAttribute('type', 'text/css');
            link.setAttribute('href', 'assets/style/css/campaign/campaign-style.css');
            document.getElementsByTagName('head')[0].appendChild(link);

            if($state.current.name == 'web-campaign') {
                $rootScope.title = "Routine Full Body Checkup @ Rs799 | Healthians";
                $rootScope.description = "Avail 74% off on full body checkup. Includes CBC, LFT, KFT, Thyroid, Lipid & Glucose. Free Home Sample Collection & free Health Counselling";
                $rootScope.keyword = "Lipid profile test, thyroid test, blood test, kidney function test, liver function test, blood sugar test, hbaic test, diabetes test, full body checkup, master health checkup";
                $rootScope.og_image = "https://www.healthians.com/assets/images/campaign/main-banner-landing.jpg";
                $rootScope.og_url = "https://www.healthians.com";
            }

            if($state.current.name == 'package-campaign') {
                $rootScope.title = "Blood Test  To Detect Causes of  chronic low energy level";
                $rootScope.description = "Is Your Energy Level Too Low?  At Healthian find  Comprehensive blood test help that  evaluate kidney , Liver function , Sugar and Thyroid  Level.";
                $rootScope.keyword = "blood tests for low energy, fatigue blood test";
            }
        }
        else if ($state.current.name == 'dengue') {
            var link = document.createElement('link');
            link.setAttribute('rel', 'stylesheet');
            link.setAttribute('title', 'campaign1');
            link.setAttribute('type', 'text/css');
            link.setAttribute('href', 'assets/style/css/campaign/campaign-style.css');
            document.getElementsByTagName('head')[0].appendChild(link);

            $rootScope.title = "Dengue Fever Checkup @ Rs999 | Healthians";
            $rootScope.description = "Avail 57% off on full body checkup. Feeling feverish? Check for dengue and diagnose it at the right time. Free Home Sample Collection & & free Health Counselling";
            $rootScope.keyword = "Dengue Fever Checkup, Lipid profile test, thyroid test, blood test, kidney function test, liver function test, blood sugar test, hbaic test, diabetes test, full body checkup, master health checkup";
            $rootScope.og_image = "https://www.healthians.com/assets/images/campaignmain-banner_dengue.jpg";
            $rootScope.og_url = "https://www.healthians.com";
        }
        else if ($state.current.name == 'about-us') {
            localStorage.setItem("titleurl", $state.current.name);
            $rootScope.title = "About US - Meet Healthians - Our Core Team Members | Healthians";
            $rootScope.description = "Healthians is India’s largest health test at home service provider. Know more about healthians and our core team members.";
            $rootScope.keyword = "About Healthians, healthians team, healthians director, largest health test at home service provider";
        }
        else if ($state.current.name == 'healthians-media') {
            localStorage.setItem("titleurl", $state.current.name);
            $rootScope.title = "Healthians Media, Healthians News, Healthians Press Releases | Healthians";
            $rootScope.description = "Look who is talking about Healthians. Our stories in top media sites and news publishers. Read more about healthians news and press releases.";
            $rootScope.keyword = "healthians media, healthians news, healthians press releases, healthians mentions, talk about healthians";
        }
        else if ($state.current.name == 'career') {
            localStorage.setItem("titleurl", $state.current.name);
            $rootScope.title = "Career – Life and Opportunities @ Healthians, Job Openings | Healthians";
            $rootScope.description = "Healthians is a great place to work for. Life at Healthians is really interesting. Check Opportunities, talent acquisition and job openings at healthians.";
            $rootScope.keyword = "life at healthians, career at healthians, job opportunities in healthians, job openings in healthians, talent acquisition @ healthians";
        }
        else if ($state.current.name == 'healthians-investors') {
            localStorage.setItem("titleurl", $state.current.name);
            $rootScope.title = "Healthians Investors – Know about Healthians Investors and Fundings";
            $rootScope.description = "Healthians have raised funds through various rounds of fundings. Know about healthians investors and funds in detail";
            $rootScope.keyword = "healthians investors, healthians funding, investment at healthians";    
        }
        else if ($state.current.name == 'labs') {
            localStorage.setItem("titleurl", $state.current.name);
            $rootScope.title = "Healthians Labs – NABL Accredited Labs | Healthians";
            $rootScope.description = "Healthians Labs are spread across Delhi Ncr, Kanpur & Lucknow. Our labs are NABL accredited and guaranteed of 100% accuracy";
            $rootScope.keyword = "Healthians Labs, Healthians NABL Accredited Labs";    
        }
        else if ($state.current.name == 'contact-us') {
            localStorage.setItem("titleurl", $state.current.name);
            $rootScope.title = "Contact Us – Head Office Address, Customer Service No – Healthians";
            $rootScope.description = "Healthians head office address and customer service contact details. You can reach us at 999-888-000-5. Submit form for your health related query";
            $rootScope.keyword = "contact us, healthians office address, healthians customer service no, healthians customer care, healthians query form";    
        }
        else if ($state.current.name == 'refund-policy') {
            localStorage.setItem("titleurl", $state.current.name);
            $rootScope.title = "Refund Policy – T&Cs of Healthians Money Refund Policy | Healthians";
            $rootScope.description = "Read about the Terms and Conditions of Healthians money refund policy. Please go through before claiming a refund";
            $rootScope.keyword = "healthians refund policy, healthians money back policy, terms and conditions of healthians refund policy";    
        }
        else if ($state.current.name == 'feedback') {
            localStorage.setItem("titleurl", $state.current.name);
            $rootScope.title = "Feedback – Send us a Feedback and share your experience | Healthians";
            $rootScope.description = "Send us your feedback and share your experience with us. It will help us to improve further and serve you better";
            $rootScope.keyword = "Healthians feedback form, share your experience with healthians";    
        }
        else if ($state.current.name == 'terms-condition') {
            localStorage.setItem("titleurl", $state.current.name);
            $rootScope.title = "Terms and conditions, Privacy Policy | Healthians";
            $rootScope.description = "Read about the terms and conditions of healthians website uses. Also know about the privacy policy at healthians";
            $rootScope.keyword = "Terms and condtions at healthians, privacy policy at healthians";    
        }
        else if ($state.current.name == 'lab-visit') {
            localStorage.setItem("titleurl", $state.current.name);
            $rootScope.title = "Lab Visit - Schedule Your Visit To Healthian Labs";
            $rootScope.description = "Healthians allow customers to visit theri labs personally. Just fill in the required details and schedule you your visit to healthians labs.";
            $rootScope.keyword = "healthians lab visit, healthian labs, schedule visit to healthians labs";    
        }
        else if ($state.current.name == 'upload-prescription') {
            localStorage.setItem("titleurl", $state.current.name);
            $rootScope.title = "Book Test From Prescription - Upload Prescription and Book Test @ Healthians";
            $rootScope.description = "You can book blood test at Healthians by sharing your prescription. Just upload your prescription and book test now. Free Sample collection and money back guarantee";
            $rootScope.keyword = "upload prescription, book test from prescription, attach prescription, health test at home, blood test at home, healthians health test booking";    
        }
        else if ($state.current.name == 'deals') {
            localStorage.setItem("titleurl", $state.current.name);
            $rootScope.title = "Health Offers - Check Special Deals and Discounts @ Healthians";
            $rootScope.description = "Healthians offers special deals and discounts to their customers. Use coupon code listed here and get your health package at discounted price. Book now";
            $rootScope.keyword = "health offer, discount on health packages, deals on health packages, healthians deals and discounts, health test booking deals";    
        }
        else if ($state.current.name == 'healthkarma') {
            localStorage.setItem("titleurl", $state.current.name);
            $rootScope.title = "Health Karma | Predictive Health Risk Assessment | Get the impact of your lifestyle | Get Recommendations";
            $rootScope.description = "This is my lifestyle score. Wanna check yours! Download Healthians app and get your lifestyle score now.";
            $rootScope.keyword = "Lipid profile test, thyroid test, blood test, kidney function test, liver function test, blood sugar test, hbaic test, diabetes test, full body checkup, master health checkup";    
        }
        else {
            localStorage.setItem("titleurl", $state.current.name);
            $rootScope.title = "Blood test in delhi ncr, whole body checkup delhi, medical test in gurgaon, health checkup in Noida, best diagnostic lab in delhi NCR";
            $rootScope.description = "Healthians.com offers lowest price medical tests and health checkups with highest quality, free home sample collection, free health counselling. Get discounted Lipid profile, kidney profile, thyroid profile, liver profile, hba1c tests.";
            $rootScope.keyword = "Lipid profile test, thyroid test, blood test, kidney function test, liver function test, blood sugar test, hbaic test, diabetes test, full body checkup, master health checkup";
            $rootScope.og_image = "https://cdn1.healthians.com/assets/images/logo.png";
            $rootScope.og_url = "https://www.healthians.com";
        }

        if ($state.current.name !== 'package' && $state.current.name !== 'parameter' && $state.current.name !== 'profile') {
            $rootScope.meta_canonical = "https://www.healthians.com"+$location.$$url;
        }

        var authorizedPages = ["final_checkout", "order", "dashboard", "user_selection_cart", "cart", "myaddress", "myreport", "mybooking", "referral"];

        if (authorizedPages.indexOf($state.current.name) >= 0) {
            if(!fbService.checkLoggedIn()) {
                $state.go('orderbook');
            }
        }

        if(fbService.checkLoggedIn()) {
            startCheckIDle();
        }

        $window.scrollTo(0, 0);

        $window.prerenderReady = true;

        // if($window.webengage) {
        //     $window.webengage.onReady(function () {
        //         $window.webengage.reload();
        //     });
        // }

    });
    
}]);
