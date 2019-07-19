@extends('layout.master')

@section('page-content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">


<style>
.booking-id-area .form select, .booking-id-area form input {background-color: #fff; }
.dropdown-menu { min-width: 0px; }
.overall-feedback h2{text-align: center;}
.overrall-feed-area{text-align: center;}
.overrall-feed-area p{color: #1a2332; font-size: 25px;}
.overrall-feed-area ul{text-align: center;}
.overrall-feed-area ul li{float: none; display: inline-block; vertical-align: top; font-size: 50px;color: #e0e0e0;margin-right: 27px;}

/*select-member-option*/
.match-input-box select{ padding: 0px 0px 10px 0px; border: none; border-bottom: 1px solid #cfcfcf; border-radius: 0px; font-size: 14px; color: #aeaeae; margin-top: 10px; margin-bottom: 20px;
    position: relative; height: auto; }
.mar-top.select-member-option {margin-top: 50px;}
.select-member-option .normal-input label::before, .select-member-option label.normal-input::before {display: none;}
.select-member-option label{text-align: left; font-size:14px; color: #333;font-weight: 400; margin-bottom:9px;}
.select-member-option input{font-size: 14px;margin: 0;width: 90%;padding: 20px 10px;display: block;border: none; border-top-color: currentcolor; border-right-color: currentcolor;    border-bottom-color: currentcolor;border-bottom-style: none; border-bottom-width: medium;border-left-color: currentcolor;border-top-color: currentcolor;border-right-color: currentcolor;border-bottom-color: currentcolor;border-bottom-style: none;border-bottom-width: medium;border-left-color: currentcolor;
border-bottom: 1px solid #717171;border-bottom-color: rgb(113, 113, 113);border-bottom-color: rgb(113, 113, 113);height: 52px;border-radius: 0;line-height: 22px; box-shadow: none !important; margin-bottom: 30px;}
.select-member-option .reminds .checkbox-circle {float: left;width: 100px;margin-top: 30px !important;}
.select-member-option .reminds .checkbox-circle label{color: #555459;font-weight: 400;padding-left:0px;}
.select-member-option .loginbtndiv a{margin: 0px 30px;}
.select-member-option .loginbtndiv a:first-child{margin: 0px 30px 0px 0px;}
.select-member-option .loginbtndiv a:last-child{margin: 0px 0px 0px 0px;}
.option-member .t-member {margin-top: 20px; margin-bottom: 20px;}

/*matemal secum*/
.booking-id-area ul{background-color: #fff;padding:10px 15px 20px 15px;text-align: center;}
.booking-id-area ul li{padding: 0px 90px;display: inline-block;vertical-align: top;background-image: url(../images/matemal-bg.png);background-repeat: no-repeat;background-size: contain;background-position: right center;}
.booking-id-area ul li:last-child{background-image: none;padding-right: 90px;margin-right: 0;}
.booking-id-area ul li p{padding: 0px; margin: 0px;}
.booking-id-area ul li p b{display: block; padding-top:7px;}
.booking-id-area h2{background-color: #fafafa;font-weight: 700; margin-bottom:25px; font-size: 25px; 
    color: #00a0a8; padding-top:20px;   padding-bottom:20px;margin-top: 0px;}
.booking-id-area h2 strong{display: block; color: #1a2332; font-size: 14px; font-weight: 400; padding-top: 10px; line-height: 15px;}
.booking-id-area .form{padding-top:20px;}
.booking-id-area .form select option{ padding-left:10px; }
.booking-id-area .form select, .booking-id-area form input{padding: 0px 0px 10px 0px;width:100%;border: none;border-bottom: 1px solid #cfcfcf;border-radius: 0px;font-size: 14px;color: #000;margin-top: 10px; margin-bottom: 20px; position: relative; height: auto;}
.booking-id-area .form select{background-image: url(../img/select-a.png); background-repeat: no-repeat; background-size: 9px; background-position: right center;}
.checkboxx label{font-size: 14px; color: #aeaeae; font-weight: 400;}
.checkboxx input{padding: 0px !important; margin: -15px 0px 0px -42px !important;}
.checkboxx{margin-top: 15px !important;}
.checkboxx .reminds .checkbox-circle {width: 110px !important;margin-left: 11px;}
.upload-note{font-size: 12px;color: brown;}
.privious-heading{padding-top:10px;margin-top: 40px;}
.privious-heading h2{padding-top: 0px;}
.booking-id-form .btn-danger{min-width: 140px;height: 45px;line-height: 45px;padding: 0px 50px;color: #fff;background-color: #f37d26;border-color: #f37d26;transition: 0.3s ease-in-out; cursor: pointer; margin-bottom: 50px; margin-top: 30px;}
.booking-id-form .btn-danger:hover, .booking-id-form .btn-danger:focus{background-color: #1a9ca6;border-color: #1a9ca6;}
.input-file-container{position: relative;}
#ultrasounds{opacity: 0;}
.input-file-trigger{padding: 0px 0px 10px 0px;border: none;border-bottom: 1px solid #cfcfcf;border-radius: 0px;font-size: 14px !important;color: #aeaeae !important;margin-top: 10px; margin-bottom: 20px; position: relative; height: auto; position: absolute; top: 0; left: 0; width: 100%; font-weight: 400 !important; background-image: url(../img/upload-icon.png); background-repeat: no-repeat; background-position: right center; padding-right: 10px; background-size:20px; margin-top: 0px;}
.match-input { height: 116px; }
.pip { padding: 0px !important;}
#showFiles {background-color: none;  display: flex; padding: 0px !important;}
.show-div {  text-align: left; height: auto; border: none; }
.show-div ul li { margin-right: 21px;}
.show-div img {height:103px; position: relative;}
.close_remove {background: url(/img/remove-attachment.png) no-repeat left center;width: 19px;height: 19px;position: absolute; cursor: pointer;}
.checkbox-info input[type="checkbox"]:indeterminate + label::before, .checkbox-info input[type="radio"]:indeterminate + label::before {background-color: #fff; border-color: #959595;}
.checkbox input[type="checkbox"]:indeterminate + label::after, .checkbox input[type="radio"]:indeterminate + label::after {margin-left: -21.5px;}
.privious-heading h2 {padding-top: 45px;padding-bottom: 36px;}
input[type="file"]:focus, input[type="radio"]:focus, input[type="checkbox"]:focus {outline:none!important;}
.col-lg-4.col-md-4.col-sm-4.col-xs-12.match-input.match-input-box {height: 90px;}
img#call-btn {position: relative; left: 12px;top: -2px;}
.maternaltab label{padding-left:10px;}
.maternaltab input[type="radio"]:checked + label, [type="radio"]:not(:checked) + label{ padding-left:0px; }
.marpadd10{ margin:0px 10px; padding:0px; }
#edd_type{padding-bottom: 17px;font-size: 11px;}
.datepicker-dropdown.datepicker-orient-left:before{top: 100%;}
.datepicker { z-index: 999999 !important;}
</style>

<div class="inner-pages cart-pge add-address overall-feedback">
    <section class="cart-section padding-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xs-12 add-btn">
                    <div class="new-member-form col-md-12 col-xs-12 col-sm-12 col-lg-12 mar-top select-member-option make-payment matemal">
                        <div class="add-address-box">
                            <h2>Maternal Serum Screen Requisition</h2>
                        </div>
                        <div class="address-cont matemal-serum-page">
                            <div class="booking-id-area">
                                <ul>
                                    <li>
                                        <p>Name of the Patient <b>{{ $user_data['name'] }}</b></p>
                                    </li>
                                    <li>
                                        <p>Booking ID <b>{{ $booking_id }}</b></p>
                                    </li>
                                    <li>
                                        <p>Age / Gender <b>{{ $user_data['age'] }} years, {{ $user_data['gender'] }}</b></p>
                                    </li>
                                </ul>
                                <h2>Clinical Information <strong>(Refer your latest Ultrasound Report)</strong></h2>
                                <form name="maternal_form" id="maternal_form" novalidate>
                                    
             
                                    <div class="booking-id-form">


                                        <div class="booking-id-area">
                                            
                                        </div>

                                        <div class="clearfix"></div>

                                        
                                        <div class="form">


                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 match-input match-input-box">
                                            <label>Type Of Screening (TOS)</label>
                                            <select name="tos" id="tos" onChange="changeTOS();" required>
                                                <option value="">-Select TOS-</option>
                                                <option value="dual">Dual</option>
                                                <option value="triple">Triple</option>
                                                <option value="quadruple">Quadruple</option>
                                            </select>
                                        </div>




                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 match-input date-ultrasound">
                                                <label>Date of Ultrasound (USG)</label>
                                                <input placeholder="Ultrasound Date" onclick="ultrasound_click();" data-date-format="dd-mm-yyyy" type="text" name="ultrasound_date" id="ultrasound_date" required readonly>
                                            </div>



                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 match-input">
                                                <label>Gestational age by Ultrasound(USG)</label>
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <select name="usg_by_week" id="usg_by_week" required onclick="usg_week_change();">
                                                            <option value="" selected>Select week</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <select name="usg_by_day" id="usg_by_day" required>
                                                            <option value="0" selected>0 Day</option>
                                                            <option value="1">1 Day</option>
                                                            <option value="2">2 Days</option>
                                                            <option value="3">3 Days</option>
                                                            <option value="4">4 Days</option>
                                                            <option value="5">5 Days</option>
                                                            <option value="6">5 Days</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 match-input last-period-date">
                                                    <label>Last Menstrual Period Date (LMP)</label>
                                                    <input placeholder="Last Menstural Period Date" data-date-format="dd-mm-yyyy" type="text" name="lmp" id="lmp" readonly required onclick="lmp_click();">
                                                </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 match-input">
                                                <label>Expected date of delivery (EDD)</label>
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <input placeholder="Delivery Date" type="text" name="edd" id="edd" onclick="edd_click();" readonly required>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <select id="edd_type" name="edd_type">
                                                            <option value="lmp" selected>Last Menstrual Period Date</option>
                                                            <option value="ucg">Ultrasound</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 match-input ">
                                                <label>IVF Pregnancy</label>
                                                <div class="checkboxx">
                                                    <div class="reminds">
                                                        <div class="checkbox checkbox-info checkbox-circle maternaltab">
                                                            <input id="ivf_pregnancy1" name="ivf_pregnancy" type="radio" value="1" required>
                                                            <label for="ivf_pregnancy1">Yes</label>
                                                        </div>
                                                    </div>
                                                    <div class="reminds">
                                                        <div class="checkbox checkbox-info checkbox-circle">
                                                            <input id="ivf_pregnancy2" name="ivf_pregnancy" type="radio" value="0" required>
                                                            <label for="ivf_pregnancy2">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 match-input m-b">
                                                <label>Pregnancy (No. of Fetus)</label>
                                                <select name="pregnancy_type" id="pregnancy_type">
                                                    <option value="single" selected>Single</option>
                                                    <option value="double">Double</option>
                                                    <option value="more than 2">More than 2</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 match-input">
                                                <label>Racial origin</label>
                                                <input type="text" name="racial_origin" id="racial_origin" placeholder="Ex: Asian" required>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 match-input">
                                                <label>Weight (in kg)</label>
                                                <input type="text" name="weight" id="weight" maxlength="3" placeholder="Weight" required>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 match-input">
                                                <label>Height (ft./in.)</label>                                             
                                                    
                                                <select id="height" name="height" required>
                                                    <option value="">Select Height</option>
                                                    <option value="147.32">4'10</option>
                                                    <option value="149.86">4'11</option>
                                                    <option value="152.40">5'0</option>
                                                    <option value="155.4">5'1</option>
                                                    <option value="157.48">5'2</option>
                                                    <option value="160.02">5'3</option>
                                                    <option value="162.56">5'4</option>
                                                    <option value="165.10">5'5</option>
                                                    <option value="167.64">5'6</option>
                                                    <option value="170.18">5'7</option>
                                                    <option value="172.72">5'8</option>
                                                    <option value="175.26">5'9</option>
                                                    <option value="177.80">5'10</option>
                                                    <option value="180.34">5'11</option>
                                                    <option value="182.88">6'0</option>
                                                    <option value="185.42">6'1</option>
                                                    <option value="187.96">6'2</option>
                                                    <option value="190.50">6'3</option>
                                                    <option value="193.04">6'4</option>
                                                    <option value="195.58">6'5</option>
                                                    <option value="198.12">6'6</option>
                                                    <option value="200.66">6'7</option>
                                                    <option value="203.20">6'8</option>
                                                    <option value="205.74">6'9</option>
                                                    <option value="208.28">6'10</option>
                                                    <option value="210.82">6'11</option>
                                                    <option value="213.36">7'0</option>
                                                </select>
                                                
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 match-input">
                                                <label>Date of Birth</label>
                                                <input placeholder="Date of Birth" type="text" name="dob" id="dob" onclick="dob_click();" data-date-format="dd-mm-yyyy" readonly required>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 match-input">
                                                <label>Diabetic</label>
                                                <div class="checkboxx">
                                                    <div class="reminds">
                                                        <div class="checkbox checkbox-info checkbox-circle">
                                                            <input id="diabetic1" name="diabetic" type="radio" value="1" required>
                                                            <label for="diabetic1">Yes </label>
                                                        </div>
                                                    </div>
                                                    <div class="reminds">
                                                        <div class="checkbox checkbox-info checkbox-circle">
                                                            <input id="diabetic2" name="diabetic" type="radio" value="0" required>
                                                            <label for="diabetic2">No </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 match-input">
                                                <label>Smoking</label>
                                                <div class="checkboxx">
                                                    <div class="reminds">
                                                        <div class="checkbox checkbox-info checkbox-circle">
                                                            <input id="smoking1" name="smoking" type="radio" value="1" required>
                                                            <label for="smoking1">Smoker  </label>
                                                        </div>
                                                    </div>
                                                    <div class="reminds">
                                                        <div class="checkbox checkbox-info checkbox-circle">
                                                            <input id="smoking2" name="smoking" type="radio" value="0" required>
                                                            <label for="smoking2">Non-Smoker  </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 match-input">
                                                <label>Upload latest copy of your Ultrasound *</label>
                                                <!-- upload area end -->
                                                <div class="input-file-container">
                                                    <input class="input-file" id="ultrasounds" name="ultrasounds[]" type="file" accept="image/*" multiple="multiple">
                                                    <label tabindex="0" for="my-file" class="input-file-trigger">Select a file...</label>
                                                </div>
                                                
                                                <!-- upload area end -->
                                            </div>


                                            <!-- ultrasound report -->
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 match-input">
                                                <div class="">
                                                    <label class="attached">Attached Ultrasound</label>
                                                    <div class="show-div">
                                                        <img id="blah" src="/img/file-img.jpg" alt="" />
                                                        <ul id="showFiles"></ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ultrasound report ends -->



                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="privious-heading">
                                            <h2>Previous history of Fetal Abnormality</h2>
                                        </div>
                                        <div class="form">
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 match-input">
                                                <label>Neural tube defects (NTD)</label>
                                                <div class="checkboxx">
                                                    <div class="reminds">
                                                        <div class="checkbox checkbox-info checkbox-circle">
                                                            <input id="ntd1" name="ntd" type="radio"  value="1" required>
                                                            <label for="ntd1">Yes </label>
                                                        </div>
                                                    </div>
                                                    <div class="reminds">
                                                        <div class="checkbox checkbox-info checkbox-circle">
                                                            <input id="ntd2" name="ntd" type="radio"  value="0" required>
                                                            <label for="ntd2">No  </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 match-input">
                                                <label>Down's Syndrome</label>
                                                <div class="checkboxx">
                                                    <div class="reminds">
                                                        <div class="checkbox checkbox-info checkbox-circle">
                                                            <input id="ds1" name="ds" type="radio" value="1" required>
                                                            <label for="ds1">Yes  </label>
                                                        </div>
                                                    </div>
                                                    <div class="reminds">
                                                        <div class="checkbox checkbox-info checkbox-circle">
                                                            <input id="ds2" name="ds" type="radio" value="0" required>
                                                            <label for="ds2">No  </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                        <!--   <input class="btn btn-danger" type="submit" onClick="validateMaternal();" value="Get Free Call Now" id="maternal_submit"> -->
                                            <button type="submit" class="btn btn-danger btn-call" onClick="validateMaternal();" id="maternal_submit">Get Free Call Now <img src="/img/left-icon.png" width="20px;" id="call-btn"> </a>
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@push('footer-scripts')

<link href="/css/t2/bootstrap-datepicker.min.css" rel="stylesheet">
<script src="/js/moment.min.js" defer></script>
<script src="/js/bootstrap-datepicker.min.js" defer></script>


<script type="text/javascript">

    var saveHealthKarma_api_url  = "{{url('saveHealthKarma')}}";

    var form_data   =   new FormData();

    function lmp_click() {
        $("#lmp").focus();
    }

    function dob_click() {
        $("#dob").focus();
    }
    
    function ultrasound_click() {
        $("#ultrasound_date").focus();
    }

    function edd_click() {
        $("#edd").focus();
    }

    function usg_week_change() {
        var tos = $("#tos").val();
        if(tos == '') {
            if($("#usg_by_week").val() == '') {
                showStrError("error", "Please first select Type Of Screening (TOS).");
            }
        }   
    }
    
    function readURL(input) {
        if (input.files) {
            var files = input.files,  filesLength = files.length;
            $("#showFiles").innerHTML = '';
            
            if(filesLength > 3) {
                filesLength = 3;
            }
            
            var ultrasounds   =   form_data.getAll("ultrasounds[]");
            var b = [];
            $.each(ultrasounds, function( index, value ) {  
                b.push(value.name);                        
            });

            var ultrasounds_len   =   form_data.getAll("ultrasounds[]").length;

            for (var i = 0; i < filesLength; i++) {
                if(!b.includes(files[i].name)) {
                    var f = files[i];
                    var reader = new FileReader();   
                    reader.fileName = files[i].name; 
                    reader.fileSize = files[i].size;  

                    if(files[i].size > 0 && files[i].size <= 2048000)  {
                        if(ultrasounds_len == 0) {
                            var j   =   ultrasounds_len;
                        }
                        else {
                            var j   = ultrasounds_len + 1;
                        }

                        reader.onload = function (e) {
                            var file    =   e.target;
                            
                            var name_code = convertText(e.target.fileName);
                            var html    =   "<li class='pip' id='pip"+name_code+"' data-id='"+j+"'><img class='imageThumb' width='101px' height='103px' src='" + e.target.result + "' title='" + f.name + "'/>" +
                                "<span class='close_remove' onclick='removeImage(\""+name_code+"\")'></span>" + "</li>";
                            $("#showFiles").append(html);
                            j++;
                        }
                        form_data.append("ultrasounds[]", f);
                        reader.readAsDataURL(f);
                    }
                    else {
                        showStrError("error", "File should be less than or equal to 2MB.");
                    }                    
                }                
            }

            $("#ultrasounds").val("");
        }
    }
    
    $(document).ready(function(){
        $.validator.addMethod("lettersonly", function(value, element) {
			return this.optional(element) || /^[a-z\s]+$/i.test(value);
        });

         
        
        $("#ultrasounds").on("change",function(){
            var new_upload = this.files.length;
            var already_uploaded = form_data.getAll("ultrasounds[]").length;
            if ((new_upload+already_uploaded) < 4) {
                $("#blah").hide();
                readURL(this);
            }               
            else {
                showStrError("error", "Maximum 3 ultrasound pic can be uploaded.");
            }   
        });

        $('#lmp').datepicker({
            endDate     : '-1d',
            startDate   : '-6m',
            dateFormat  : 'dd-mm-yyyy',
            autoclose   : true,
        });
        $('#dob').datepicker({
            endDate     : '-228m -1d',
            dateFormat  : 'dd-mm-yyyy',
            autoclose   : true,
        });
        $("#ultrasound_date").datepicker({
            endDate     : '+0d',
            startDate   : '-2m',
            dateFormat  : 'dd-mm-yyyy',
            autoclose   : true,
        });
        $("#edd").datepicker({
            startDate   : '+1d',
            endDate     : '+8m',
            dateFormat  : 'dd-mm-yyyy',
            autoclose   : true,
        });
    });

    function convertText(input) {
        var output = '';

        for (var i = 0, len = input.length; i < len; i++) {
            output += input[i].charCodeAt(0)
        }

        return output;
    }

    function removeImage(id) {
        var files   =   form_data.getAll("ultrasounds[]");
        form_data.delete("ultrasounds[]");

        $.each(files, function( index, value ) {  
            var namecode = convertText(value.name);
            if(id   !=  namecode) {
                form_data.append("ultrasounds[]", value);
            }                                
        });

        $("#pip"+id).remove();
    }

    function ageCalculator(ev) {
        $('.datepicker').hide();
        var selected = new Date(ev);

        var mm = moment(selected, 'DD/MM/YYYY').format('M');
        var dd = moment(selected, 'DD/MM/YYYY').format('D');
        var yy = moment(selected, 'DD/MM/YYYY').format('Y');
        var currentmonth = moment().month() + 1;
        var today = new Date();
        var birthDate = new Date(selected);
        var age = today.getFullYear() - yy;

        if (currentmonth >= mm) {
            return age;              
        } else {
            return age-1;
        }
    }

    function changeTOS() {
        var tos = $("#tos").val();
        if(tos !== '') {
            if(tos == 'dual') {                
                var options = '<option value="" selected>Select weeks</option>';
                options += '<option value="9">9 weeks</option>';
                options += '<option value="10">10 weeks</option>';
                options += '<option value="11">11 weeks </option>';
                options += '<option value="12">12 weeks</option>';
                options += '<option value="13">13 weeks</option>';
                $("#usg_by_week").html("");
                $("#usg_by_week").html(options);
            }
            if(tos == 'triple' || tos == 'quadruple') {
                var options = '<option value="" selected>Select weeks</option>';
                options += '<option value="14">14 weeks</option>';
                options += '<option value="15">15 weeks</option>';
                options += '<option value="16">16 weeks</option>';
                options += '<option value="17">17 weeks</option>';
                options += '<option value="18">18 weeks</option>';
                options += '<option value="19">19 weeks</option>';
                options += '<option value="20">20 weeks</option>';
                options += '<option value="21">21 weeks</option>';
                options += '<option value="22">22 weeks</option>';

                $("#usg_by_week").html("");
                $("#usg_by_week").html(options);
            }
            
        }
        
    }

    /* Form And Question - Start */
    function maternalFormSuccessHandler(response) {
        $("#ajax-loader").hide();

        if(response) {
            if(response.status) {
                var validator = $("#maternal_form").validate();
                validator.resetForm();
                $('#maternal_form').trigger("reset");
                form_data   =   new FormData();
                $("#showFiles").html("");
                $("#blah").show();
                showStrError("success", response.message);
            }
            else {
                showStrError("error", response.message);
            }
        }
        return false;
    }

    function maternalFormErrorHandler(response) {
        $("#ajax-loader").hide();
        var errorData = response.responseJSON;
        showStrError("error", errorData.message);
        return false;
    }

    function validateMaternal() {

        $('#maternal_form').validate({
            errorElement: 'span',
            errorPlacement: function(error, element) {                   
                if (element.attr("type") == 'radio') {
                    var insertList  =   element.parent().parent().parent();
                    error.appendTo(insertList);
                }
                else {
                    error.insertAfter(element);
                }
            },
            rules: {
                tos : {
                    required: true,
                },
                ultrasound_date: {
                    required: true,
                },
                usg_by_week: {
                    required: true,
                    digits: true,
                },
                usg_by_day: {
                    required: true,
                    digits: true,
                },
                edd: {
                    required: true,
                },
                lmp: {
                    required: true,
                },
                ivf_pregnancy: {
                    required: true,
                },
                racial_origin: {
                    required: true,
                    lettersonly : true
                },
                weight: {
                    required: true,
                    digits: true,
                },
                height : {
                    required: true
                },
                dob: {
                    required: true,
                },
                diabetic: {
                    required: true,
                },
                smoking: {
                    required: true,
                },
                ntd: {
                    required: true,
                },
                ds: {
                    required: true,
                }
            },
            messages: {
                ultrasound_date: {
                    required: "Please enter Date of Ultrasound",
                },
                usg_by_week: {
                    required: "Please enter USG Week",
                    digits: "Please enter USG Week in numeric",
                },
                usg_by_day: {
                    required: "Please enter USG Day",
                    digits: "Please enter USG Day in numeric",
                },
                edd: {
                    required: "Please select Expected Date of delivery",
                },
                lmp: {
                    required: "Please enter Last Menstrual Period Date",
                },
                ivf_pregnancy: {
                    required: "Please select IVF Pregnancy",
                },
                racial_origin: {
                    required: "Please select Racial Origin",
                    lettersonly : "Only alphabets are allowed."
                },
                weight: {
                    required: "Please enter weight",
                    digits: "Please enter weight in numeric",
                },
                height: {
                    required: "Please select height",
                },
                dob: {
                    required: "Please select Date of Birth",
                },
                diabetic: {
                    required: "Please specify Diabetic",
                },
                smoking: {
                    required: "Please specify smoking",
                },
                ntd: {
                    required: "Please specify Neural tube defect",
                },
                ds: {
                    required: "Please specify Down’s syndrome",
                }
            },
            submitHandler: function () {
                var age = parseInt(ageCalculator($("#dob").val()));

                if(age <= 17) {
                    showStrError("error", "Please change date of birth. It should be greater than 18 year old.");
                    return false;
                }

                var ultrasounds_len   =   form_data.getAll("ultrasounds[]").length;
                if(ultrasounds_len == 0) {
                    showStrError("error", "Please upload ultrasound copy.");
                    return false;
                }

                var now = moment(new Date(), 'DD-MM-YYYY'); //todays date
                var end = moment($("#ultrasound_date").val(), 'DD-MM-YYYY'); // another date
                var duration = moment.duration(now.diff(end));
                var days = parseInt(duration.asDays());

                var usg_days = parseInt($("#usg_by_week").val())*7 +  parseInt($("#usg_by_day").val());
                var total_days = usg_days + days;
                var scga_by_week = parseInt(total_days/7);
                var scga_by_day = parseInt(total_days%7);

                form_data.append('scga_by_week', scga_by_week);
                form_data.append('scga_by_day', scga_by_day);
                
                form_data.append('tos', $("#tos").val());
                form_data.append('ultrasound_date', $("#ultrasound_date").val());
                form_data.append('usg_by_week', parseInt($("#usg_by_week").val()));
                form_data.append('usg_by_day', parseInt($("#usg_by_day").val()));
                form_data.append('edd', $("#edd").val());
                form_data.append('edd_type', $("#edd_type").val());                
                form_data.append('lmp', $("#lmp").val());
                form_data.append('ivf_pregnancy', $("input[name='ivf_pregnancy']:checked").val());
                form_data.append('pregnancy_type', $("#pregnancy_type").val());              
                form_data.append('racial_origin', $("#racial_origin").val());
                form_data.append('weight', $("#weight").val());
                form_data.append('height', $("#height").val());
                form_data.append('dob', $("#dob").val());
                form_data.append('diabetic', $("input[name='diabetic']:checked").val());
                form_data.append('smoking', $("input[name='smoking']:checked").val());
                form_data.append('ntd', $("input[name='ntd']:checked").val());
                form_data.append('ds', $("input[name='ds']:checked").val());
                form_data.append('_token', '{{csrf_token()}}');

                form_data.append('booking_id', '{{$booking_id}}');
                form_data.append('cust_id', '{{$customer_id}}');

                $.ajax({
                    url: "{{route('saveMaternalData')}}",
                    type: "post",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    beforeSend: function() {
                        $("#ajax-loader").show();
                    },
                    success: maternalFormSuccessHandler,
                    error: maternalFormErrorHandler
                });

                return false;
            }
        });
    }

    var fileInput   = document.querySelector("#ultrasounds"),  
    button          = document.querySelector(".input-file-trigger"),
    the_return      = document.querySelector(".file-return");
      
    button.addEventListener("keydown", function(event) {  
        if (event.keyCode == 13 || event.keyCode == 32) {  
            fileInput.click();  
        }  
    });

    button.addEventListener("click", function(event) {
        fileInput.click();
        return false;
    });
    
</script>

@endpush