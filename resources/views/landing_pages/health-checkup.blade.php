@extends('layout.landing_master')

@section('page-content')
    
<style>
/*CRUD Promotional Package*/
.crudpromoarea{ width:100%;}
.crudpromoarea .promo_landing_header{ box-shadow:0px 2px 4px #CCC; width: 100%; min-height:85px; background:#fff;}
.crudpromoarea .promo_landing_header .logohead{ width:auto; margin:10px 0px 15px 0px;}
.crudpromoarea .promo_landing_header .taglinehead{color: #00a0a8;font-family: 'Open Sans', sans-serif; font-size:22px; text-align:right; margin:24px 0px;}

.crudpromoarea .offerbannerblock{background-image: linear-gradient(90deg, #1c97b2, #1c6a92);height: auto;font-family: 'Open Sans', sans-serif; min-height:452px; position:relative;}
.crudpromoarea .offerbannerblock .offertitle{color: #fff; font-size:52px; font-weight:300; line-height: 1.3; margin:40px 0px 30px 0px;}
.crudpromoarea .offerbannerblock .offerparameter{ font-size:30px; color:#fff; font-weight:600;}
.crudpromoarea .offerbannerblock .testbrief{ font-size:21px; color:#fff; font-weight:300;}
.crudpromoarea .offerbannerblock .container{ padding:0px;}
.crudpromoarea .offerbannerblock .col-lg-12{ padding:0px;  margin:0;}
.crudpromoarea .offerbannerblock .col-lg-6{padding:0px; margin:0;}

.crudpromoarea .offerbannerblock .offer-freecall{ margin:50px 0px 0px 0px;}
.crudpromoarea .offerbannerblock .offerbook{ display:inline-block;}
.crudpromoarea .offerbannerblock .offerbook a{font-size:20px; background: #fff; border-radius:25px; font-weight: bold; color: #2b2b2b; box-shadow: 0px 4px 0px rgba(0,0,0,0.25); padding:12px 34px;}
.crudpromoarea .offerbannerblock .offerbook a:hover{ background:#f0fbff;}

.crudpromoarea .offerbannerblock .offerfreecall{display:inline-block; margin-left:24px;}
.crudpromoarea .offerbannerblock .offerfreecall a{font-size:20px;background:#fff;border-radius:25px;font-weight:bold;color:#2b2b2b;box-shadow:0px 4px 0px rgba(0,0,0,0.25);padding:12px 34px;}
.crudpromoarea .offerbannerblock .offerfreecall a:hover{ background:#f0fbff;}
.rightimgblock{min-height:359px; margin-top:51px;}


.crudpromoarea .statisticalblock{ background:#f6f6f6; width: 100%; margin: 0; padding:5px 0 5px 0;}
.crudpromoarea .statisticalblock ul{margin:0;  padding:15px 0px; list-style: none;}
.crudpromoarea .statisticalblock ul li{list-style:none; border-right:2px solid #1c8baa; display: inline-block; margin-right:8px; border-right: 2px solid #007f85; padding-right:8px; max-width:365px;}
.crudpromoarea .statisticalblock ul li span { float: left; font-size:42px; font-weight:300; color: #007f85;}
.crudpromoarea .statisticalblock ul li p{float: left; font-size:21px; font-weight:600; font-family: 'Open Sans',sans-serif; line-height: 20px; padding-left: 9px; color: #3c3c3c; letter-spacing: -0.4px;  margin: 6px 0 0; max-width: 139px;}
.crudpromoarea .statisticalblock ul li:nth-child(4){ border-right:none;}
.crudpromoarea .statisticalblock .separateline{ }

.crudpromoarea .labtrustbar{width: 100%; margin:0; padding:50px 0px 50px 0px;}
.crudpromoarea .labtrustbar .qualitylabservice{margin-top:80px; margin-left:60px;}
.crudpromoarea .labtrustbar .qualitylabservice h2{color: #404040; font-size: 36px; font-family: 'Open Sans',sans-serif; font-weight:600;}
.crudpromoarea .labtrustbar .qualitylabservice h4{color: #006b70; font-weight:600; font-size: 18px; line-height: 25px; padding: 14px 0;}
.crudpromoarea .labtrustbar .qualitylabservice p{font-size: 14px; line-height: 25px; font-family: 'Open Sans',sans-serif; margin: 15px 0;}

.crudwhyhealthians{width: 100%; margin:0; padding:50px 0px 50px 0px; position:relative;}
.crudwhyhealthians .gredientshade{background-image: linear-gradient(90deg, #1c97b2, #1c6a92); width:60%; padding:0; min-height:132px;  border-radius: 5px 0px 0px 5px; position:absolute; right:0px;} 
.crudwhyhealthians .btmhealthians{ margin:0px; }
.crudwhyhealthians .btmhealthians h3{font-size: 34px; font-weight:600; margin-bottom:19px; font-weight: normal; font-family: 'Open Sans', sans-serif;}
.crudwhyhealthians .btmhealthians  p{font-size:16px; font-family: 'Open Sans',sans-serif; margin-right:55px; font-weight:300; line-height: 1.5; color: #2b2b2b;}

.our_usps{}

.hltnewsmedia{width: 100%; margin:0; padding:50px 0px 50px 0px; position:relative;}
.hltnewsmedia .gredientleftshade{background-image: linear-gradient(90deg, #1c6a92, #1c97b2); width:55% !important; padding:0; height:222px;  border-radius:0px 5px 5px 0px; position:absolute !important; left:0px;}
.hltnewsmedia .textcaption{ border-right:1px solid #fff; float:left; max-width:185px; margin:40px 0px; color:#fff; display: inline-block;}
.hltnewsmedia .textcaption h2{font-size:28px;font-family: 'Open Sans',sans-serif;}
.hltnewsmedia .medialogobar{ float:left; max-width:250px; margin:30px 0px 0px 25px; color:#fff; display: inline-block;}
.hltnewsmedia .employerlogobar{ float:left; max-width:250px; margin:15px 0px 0px 25px; color:#fff; display: inline-block;}
.textemployer{ color:#000;font-family: 'Open Sans',sans-serif; margin-left:30px;}
.textemployer h2{ margin-top:25px;}

.crud_footermain{ background: #fff; padding: 0px 0;  margin: 0px 0 0;}
.crud_footermain .btm-link{ float:right; margin-top:18px; }
.crud_footermain ul.btm-link li{display: inline-block; font-family: 'Open Sans', sans-serif;   color: #3c3c3c;  border-right: 1px solid #49484a;  margin: 0; padding: 0 11px;  }
.crud_footermain ul.btm-link li a{ text-decoration:none;font-size:15px; font-weight:600; }
.crud_footermain .btm-txt{ margin-top:20px;font-family: 'Open Sans', sans-serif; border-top:4px solid #eaeaea; padding-top:22px;}
.crud_footermain .btm-txt p{font-family: 'Open Sans', sans-serif; font-size:12px; line-height:16px;  }
.crud_footermain .copy{font-family: 'Open Sans', sans-serif;font-size:12px; line-height:16px;}
.icon-one{ background-color: #fff; border-radius: 6px; box-shadow: 0px 5px 30px rgba(0,0,0,0.2); margin-top:40px;}
.icon-one p{font-size: 17px; line-height: 1.2; color: #2b2b2b;}


.offerbannerblock .horizontalform{ margin:0px 0px;}
.offerbannerblock .horizontalform .formwhitearea{ height:56px;   }	
.offerbannerblock .horizontalform .formwhitearea ul{margin:0px; border-radius:8px; overflow:hidden; height:45px; padding:0px; list-style:none;}
.offerbannerblock .horizontalform .formwhitearea ul li{ display:inline-block; width:233px; float:left;}
.offerbannerblock .horizontalform .formwhitearea ul li input{height: 45px; font-size: 16px!important; padding: 10px 12px 10px 35px; line-height: 1.42857143; color: #555; border:none;   font-family: 'Open Sans', sans-serif; }
.offerbannerblock  .ctabutton_final{font-family: 'Open Sans', sans-serif;    white-space: nowrap; border-right:none !important; box-shadow: -2px 3px 4px -1px rgba(0,0,0,.18);
    display: inline-block; background: #ff9000; background-image: -ms-linear-gradient(top, #ff9000 0%, #e67200 100%);
    background-image: -moz-linear-gradient(top, #ff9000 0%, #e67200 100%);
    background-image: -o-linear-gradient(top, #ff9000 0%, #e67200 100%);
    background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #e67200), color-stop(100, #e67200));
    background-image: -webkit-linear-gradient(top, #ff9000 0%, #e67200 100%);
    background-image: linear-gradient(to bottom, #ff9000 0%, #e67200 100%);
    color: #fff !important; font-size:26px !important;text-transform: capitalize; border-radius: 0px 8px 8px 0px; letter-spacing: 0.4px; 
	padding:12px 67px !important;}
.offerbannerblock .horizontalform .formwhitearea ul li input:focus{ outline:none; border:none; border-bottom:none;}
.offerbannerblock .horizontalform .formwhitearea ol{margin:0px; text-align:left; height:45px; padding:0px; list-style:none;}
.offerbannerblock .horizontalform .formwhitearea ol li{ display:inline-block; width:234px; border-right:none;}
.offerbannerblock .form-field-city .form-select-opt{font-family: 'Open Sans', sans-serif; padding:11px 12px 9px 7px; border:none; outline:none; }

.offerbannerblock .campaign-up-arrow{display:block;position: relative;background: #4c6c67;color: #FFF;text-decoration: none;padding: 0px;}

.offerbannerblock .campaign-up-arrow:after{content: '';display: block;  position: absolute;left:11%; margin-left: auto; margin-right: auto;bottom:100%;width:0;height: 0;
border-bottom: 13px solid #4c6c67;border-top: 13px solid transparent;border-left: 13px solid transparent;border-right: 13px solid transparent;}
a:hover.up-arrow:after{border-bottom-color: brown;}
.offerbannerblock .form-field-city .form-select-opt{ background:#fff; border-radius:0px;}
.crud_footermain .btm-txt{ border-top:none;}
.crud_footermain .btm-txt{ margin-top:0px;}
.hltnewsmedia .employerlogobar{ max-width:100%;}
.hltnewsmedia .employerlogobar img{ max-width:100%;}

/*CRUD Promotional Package Ends*/
.span_sub_test {font-size:50% !important; line-height:40px; display: inline-block !important;}
.rs_class {font-weight:normal; padding:0px; padding-right:2px;}

@media all and (min-width: 20px) and (max-width: 768px) {
    /*CRUD Promotional Package*/
.promo_landing_header .col-md-12{ margin:0px; padding:0px 10px;}
.promo_landing_header .col-md-6{ margin:0px; padding:0px;}
.crudpromoarea .promo_landing_header .taglinehead{ margin:20px 0px; font-size:15px;}
.crudpromoarea .offerbannerblock .offertitle{ font-size:2.6em;}
.crudpromoarea .offerbannerblock .col-md-12{ margin:0px; padding:0px 5px;}
.crudpromoarea .offerbannerblock .col-md-6{ margin:0px; padding:0px 5px;}
.crudpromoarea .offerbannerblock .offerbook a{ padding:9px 25px; font-size:15px;}
.crudpromoarea .offerbannerblock .offerbook{}
.crudpromoarea .offerbannerblock .offerfreecall{ margin:auto;}
.crudpromoarea .offerbannerblock .offerfreecall a{ padding:9px 25px; font-size:15px;}
.crudpromoarea .offerbannerblock .offer-freecall{ margin-top:25px; margin-bottom:35px;}
.rightimgblock{ min-height:auto; margin-top:0px;}
.crudpromoarea .statisticalblock .container{margin:0px; padding:0px;}
.crudpromoarea .statisticalblock .container,.col-xs-12{margin:0px;}
.crudpromoarea .statisticalblock ul li{vertical-align: top; text-align: center; margin-bottom: 20px; width: 49%; margin-right: 0; padding-left:4%; padding-right:0;}
.crudpromoarea .statisticalblock ul li span{ font-size: 2em; display: block;}
.crudpromoarea .statisticalblock ul li p{margin: 0; font-size: 15px; max-width: 100%;text-align: left; padding-left: 0; line-height: 16px;display: block; float: none; clear:both;}
.crudpromoarea .statisticalblock ul li:nth-child(2){border-right: 0;}
.crudpromoarea .statisticalblock ul li:nth-child(4){border-right: 0;}
.crudpromoarea .labtrustbar{ padding:40px 0px;}
.crudpromoarea .labtrustbar .col-md-12,col-md-6{ margin:0px; padding:0px 5px;}
.crudpromoarea .labtrustbar .labtrusted img{ max-width:100%;}
.crudpromoarea .labtrustbar .qualitylabservice{ margin-left:0px;}
.offerbannerblock .horizontalform{ display:none;}
.offerbannerblock .col-xs-12{ margin:0;}

.crudwhyhealthians .gredientshade{ width: 95%; padding: 0; min-height: 242px;}
.hltnewsmedia .gredientleftshade{width: 95% !important; padding: 0; min-height: 275px;}
.crudwhyhealthians{ padding:10px 0px;}
.hltnewsmedia .medialogobar{ max-width:100%; display:block; margin:10px 0px 0px 0px;}
.textemployer{ margin-top:95px; margin-left:0px;}
.brdtop{ padding-top:0px;}


.crud_footermain ul.btm-link li{ padding:0 3px;}
.textemployer h2{font-size:24px; text-align:center;}
.hltnewsmedia .medialogobar img{ max-width:100%;}
.hltnewsmedia .textcaption h2{ font-size:24px; text-align:center;}
.crudwhyhealthians .btmhealthians h3{ color:#fff; font-size:24px;}
.crudwhyhealthians .btmhealthians p{ color:#fff; width:100%;}
.hltnewsmedia .textcaption{ max-width:100%; border-right:none; float:none; margin:10px 0px;}
.our_usps{ margin:0px; padding:0px;}
.our_usps .col-xs-12{ margin:0px; padding:0px;}
.icon-one p {padding-bottom: 30px;}
/*CRUD Promotional Package Ends*/
}
</style>

<div class="main_health_checkup_div"> {!! $html !!}
</div>

<div class="sticky-bottom cms-campaign">
    @include('landing_pages.callback_form_mobile')
    <input type="hidden" name="ga_mobile_category" id="ga_mobile_category" value="{{$ga_mobile_category}}">
</div>
@endsection

@push('footer-scripts')
    <script type="text/javascript" src="/js/bootstrap.min.js"></script> 
    <script type="text/javascript">
        $(document).ready(function(){
            $("#addLeadForm").submit(function () { 
                if($("#addLeadForm").valid()) {
                    ajaxCallPromise(saves_api_url, "POST", $('#addLeadForm').serialize()).then(saveLeadSuccessHandler, saveLeadErrorHandler);
                }
                return false;            
            });
        });

        $('#basicModal').on('show.bs.modal', function (event) {
            $("#txtSearch").blur();
            var button = $(event.relatedTarget);
            var recipient = button.data('whatever');
            $('#addLeadForm')[0].reset();
            var validator = $("#addLeadForm").validate();
            validator.resetForm();

            setTimeout(function(){
                $('#name').focus();
                $(this).find('input:first').focus();
                $(this).find('[autofocus]').focus();
            }, 100);
        });

        $('#basicModal').on('hide.bs.modal', function (e) {
            $('#basicModal').removeClass('fade');
        });
    </script>
    <script src="/js/landing_page.js"></script>
    <footer></footer>
@endpush