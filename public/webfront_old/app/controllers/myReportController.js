App.controller('myReportController', myReportController);
myReportController.$inject = ['$scope', '$rootScope', '$location', '$anchorScroll', 'DashboardService', 'BookOrderService', '$timeout', '$window', 'cartService', 'ConstConfig', '$http'];

function myReportController(scope, $rootScope, $location, $anchorScroll, DashboardService, BookOrderService, $timeout, $window, cartService, ConstConfig, $http) {
   	scope.myReportData = [];
   	scope.myReportCountMember = 5;
    scope.myReportCountUser = 5;

    scope.shareReport = false;

    scope.reportName = '';
    scope.reportpath = '';
    
   	// Listing My Reports using service
    scope.myreport = function() {
        if (localStorage.getItem("isLogin") == 'true') {
            var user_id = JSON.parse(localStorage.getItem("user")).user_id;
            var opts = {
                "user_id": user_id,
                "log_user_id": user_id,
                "user_limit": scope.myReportCountUser,
                "member_limit": scope.myReportCountMember
            };
        } else {
            var opts = {
                "user_id": ""
            };
        }

        DashboardService.myReports(opts, function(data) {
            if (data.status === true) {
                if (data.data !== null) {
                    scope.loaderVar = false;
                    scope.myReportData = data.data;
                    scope.nodata = true;
                } else {
                    scope.nodata = false;
                    scope.loaderVar = false;
                    scope.nodataReport = true;
                }

            }
        });
    };
    scope.myreport();

    // calling more for my report
    scope.reportList = function(val) {
        if (val === 'user') {
            scope.myReportCountUser += 5;
        } else if (val === 'member') {
            scope.myReportCountMember += 5;
        }

        scope.myreport();
    };

        //service for pdf report
    scope.reportPdf = function(report_id, booking_id, customer_id, report_name) {
        var url = ConstConfig.couponUrl + "webv1/web_api/getReportContent";
        $http({
            method: "GET",
            url: url,
            params: {
                "booking_id": booking_id,
                "report_id": report_id,
                "customer_id": customer_id
            },
            responseType: "blob"
        }).success(function(response) {
            if(response.size !== 0) {
                var fileName = report_name;
                var a = document.createElement("a");
                document.body.appendChild(a);
                a.style = "display: none";

                var file = new Blob([response], {type: 'application/pdf'});
                var fileURL = window.URL.createObjectURL(file);
                a.href = fileURL;
                a.download = fileName;
                a.click();
            }
            else {
                $window.alert("No report available.");
            }       

        });
    };

    //open report sare
    scope.reportShare = function(report) {
        scope.shareReport = true;
        scope.report_id = report.report_id;
        scope.report_booking_id = report.booking_id;
        scope.report_customer_id = report.customer_id;

        // scope.reportpath = report_id.share_path;
        // scope.reportName = report_id.report_name;
    };

    //close report sare
    scope.closereportShare = function() {
        scope.shareReport = false;
    };

    //service for report share
    scope.userReportShare = function(mail) {
        var user_id = JSON.parse(localStorage.getItem("user")).user_id;
        var opt = { 
            "email": mail,
            "log_user_id": user_id,
            "booking_id": scope.report_booking_id,
            "report_id": scope.report_id,
            "customer_id": scope.report_customer_id,
            "source": "web"
        };

        DashboardService.shareCustReport(opt, function(data) {
            if(data.status) {
                scope.reportSharemsg = data.message;
                scope.reportSharemsgflag = true;
                $timeout(function() {
                    scope.reportSharemsg = '';
                    scope.shareReport = false;
                    scope.reportSharemsgflag = false;
                }, 5000);
            }
            else {
                $window.alert(data.message);
            }            
        });
    };

}