App.controller('downloadFileController', downloadFileController);
downloadFileController.$inject = ['$scope', 'dataShare','dataShare1', '$localStorage', '$sessionStorage', '$timeout', '$rootScope', '$location','$http', '$q', 'BookOrderService', '$state', '$stateParams', 'ConstConfig' ];
function downloadFileController (scope, dataShare,dataShare1, $localStorage, $sessionStorage, $timeout, $rootScope, $location ,$http ,$q ,BookOrderService ,$state ,$stateParams,ConstConfig) {
 	
    scope.sendOtp = true ;
    scope.sendDetail = false ;
    scope.displayDetail = false ;
    scope.errorMsgFlag = false;
    scope.noreport = false;
    scope.sendOtpNo = "";


    scope.sendOtpFunction = function()
    {
        //console.log("sendOtpNo",scope.sendOtpNo);
        if(scope.sendOtpNo == undefined || scope.sendOtpNo == "")
        {
            scope.sendOtpError = true ;
            return false ;
        }
        else
        {
            scope.sendOtpError = false ;
            // doPost($http,"//crm2.healthians.com/commonservice/send_mobile_otp",{"mobile_number" : scope.sendOtpNo},"",function(data){
            doPost($http,ConstConfig.serverUrl + "commonservice/send_mobile_otp",{"mobile_number" : scope.sendOtpNo},"",function(data){
                if (data.status === false) {
                    scope.errorMsgFlag = true;
                    scope.errorMsg = data.message;
                } else {
                    scope.sendOtp = false ;
                    scope.sendDetail = true ;
                }
            }); 
        }
        if (scope.sendOtpNo !== ""){
            scope.sendDetailNo = scope.sendOtpNo;
        };

        $timeout(function(){
            scope.errorMsgFlag = false;
        },4000);
    }

    scope.sendDetailFunction = function()
    {   
        //console.log("sendDetailNo",scope.sendOtpNo);
        if(scope.sendDetailNo == undefined || scope.sendDetailNo == "")
        {
            scope.sendDetailError = true ;
            return false ;
        }
        else
        {
            doPost($http,ConstConfig.serverUrl + "commonservice/generate_report_from_mobile",{"mobile_number" : scope.sendDetailNo ,"otp" : scope.sendDetailOtp },"",function(data){
                if (data.status === true) {
                    scope.reportData = data.data ;
                    scope.displayDetail = true ;
                    scope.sendDetail = false ;
                } else {
                    if (data.message == 'Invalid OTP'){
                        scope.sendDetailError = true;
                    } else if (data.message == 'Report not found') {
                        scope.sendDetail = false ;
                        scope.displayDetail = true ;
                        scope.noreport = true;
                    }
                }
                
                //console.log("final data",data);
            }); 
        }        
    }

    //service for pdf report
    scope.reportPdf = function(report_id, booking_id, customer_id, report_name) {
        //console.log(report);
        //$window.open(report, '_blank');
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


 }