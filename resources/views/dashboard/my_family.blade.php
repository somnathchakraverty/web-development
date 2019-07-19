@extends('layout.master')

@section('page-content')
<style>
.datepicker { color: #080808 !important;z-index: 999999 !important;}
select.error{color:#666 !important;}
</style>
    <section class="faimly-friendwraper">

        <div class="fixed-bar">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="asidenavdiv text-left">
                        @include('section.left-dashboard', ['userDetail' => $userDetail])
                    </div>	
                </div>

                <!------aside-end -->
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="Family-headingdiv text-left">
                       <h3>My Family & Friends</h3>

                    <span class="addmemberright">
                        <a class="btn btn-danger btn_cmncolor_right" data-toggle="modal" data-target="#family_edit" onclick="addFamily();">Add New Member</a>
                    </span>

                    </div>
                    
                    <div class="Retake-Healthkarmadiv f-div">
                       

                        <div class="alert alert-danger" id="family_list_error_div" style="display:none;">
                        </div>

                        <div id="myfamily_list_div">
                        </div>         
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Add Family Member Modal -->
<div class="modal fade addfamilymember" id="family_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeFamilyModal();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="clearfix"></div>
                <form class="" id="add_family_form" name="add_family_form" method="post">
                    <div class="modal-body">
                        
                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 mar-top select-member-option">

                            <div class="col-sm-12 text-center modaltitle">
                                <h2 id="add_edit_title"> Add Family Member </h2>
                                <img class="lazy-loaded" data-src="/img/underline.png" alt="underline" src="/img/underline.png">
                            </div>

                            {{csrf_field()}}
   
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 editmembermidhgt">
                                <div class="field_myfamilyblade">
                                    <input name="username" id="username" type="text" class="ic_user" placeholder="Name *" tabindex="1" maxlength="512" required autocomplete="off">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 editmembermidhgt">
                                <div class="field_myfamilyblade">
                                    <select class="ic_family relationwith"  name="relation" id="relation" tabindex="2" required>
                                        <option value="" selected>Select Relation</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 editmembermidhgt">
                                <div class="field_myfamilyblade">
                                    <input name="mobile" id="mobile" type="tel" class="ic_phone" placeholder="Mobile No."  tabindex="3"  maxlength="10" minlength="10" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 editmembermidhgt">
                                <div class="field_myfamilyblade">
                                    <input type="text" class="ic_age userage" id="age" name="age"  tabindex="4" placeholder="Age *" maxlength="3" required autocomplete="off">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 editmembermidhgt" id="dob_date_picker" onClick="dob_click();">
                                <div class="field_myfamilyblade">
                                    <input type="text" class="dateofbirth ic_date" id="dob" name="dob"  tabindex="5" placeholder="Date Of Birth *" required autocomplete="off" readonly>
                                </div>
                            </div>


                                                      
                            
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 editmembermidhgt">
                                <div class="field_myfamilyblade">
                                    <input name="email" id="email" type="email" class="ic_email" placeholder="Email ID"  maxlength="512" tabindex="6" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 editmembermidhgt">
                                <div class="gendermyfamily">
                                    <div class="genderOptions">
                                        <div class="genderopt radio_genoption">
                                            <ul>
                                                <li>
                                                    
                                                        <input name="gender" value="M" type="radio" id="checkbox6" tabindex="7" required>
                                                        <label for="checkbox6">Male</label>   
                                                    
                                                </li>

                                                <li>
                                                    <input name="gender" value="F" type="radio" id="checkbox7" tabindex="8" required>
                                                    <label for="checkbox7">Female</label>
                                                </li> 
                                            </ul>
                                        </div>
                                    </div> 
                                </div>
                            </div>

                            <input id="customer_id" name="customer_id" type="hidden" value="">
                            <input id="device_source" name="device_source" type="hidden" value="">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="modal-footer-popup">
                        <button type="submit" tabindex="9" class="btn btn-danger btn_cmncolor">Save changes
                        </button>
                        <br>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Add Family Member Modal Ends -->

@endsection
@push('footer-scripts')
    <link href="/css/t2/bootstrap-datepicker.min.css" rel="stylesheet">
    <script src="/js/moment.min.js" defer></script>
    <script src="/js/bootstrap-datepicker.min.js" defer></script>

    <script>
        var datepicker_option = {
            format          : "dd-mm-yyyy",
            endDate         : '-60m',
            autoclose       : true,
            clearBtn        : true
        };

        $(document).ready(function(){
            $.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            });
            $.validator.addMethod("dob", function(value, element) {
                return this.optional(element) || moment(value,"dd-mm-yyyy").isValid();
            }, "Please enter a valid date in the format DD-MM-YYYY");

            $('#family_edit').on('shown.bs.modal', function() {
                $('#dob_date_picker .ic_date').datepicker(datepicker_option)
                .on('changeDate', ageCalculator);
            });

            $("#age").bind("change blur focusout", function() {
                var age = $("#age").val();
                if(age !== '') {
                    if(age >= 5 && age <= 120) {
                        getDOB(age);
                    }
                    else {
                        $("#age").val("");
                        showStrError("error", "Enter age between 5 to 120");                      
                    }
                }
            });
        });

        function dob_click() {
            $("#dob").focus();
        }

        /* Age Calculator*/
        function ageCalculator(ev) {
            $('.datepicker').hide();
            var selected = new Date(ev.date);

            var mm = moment(selected, 'DD/MM/YYYY').format('M');
            var dd = moment(selected, 'DD/MM/YYYY').format('D');
            var yy = moment(selected, 'DD/MM/YYYY').format('Y');
            var currentmonth = moment().month() + 1;
            var today = new Date();
            var birthDate = new Date(selected);
            var age = today.getFullYear() - yy;

            if (currentmonth >= parseInt(mm)) {
                if(age >= 5 && age <= 120) {
                    $("input[name='age']").val(age);
                }
                else {
                    showStrError("error", "Incorrect DOB. Enter age between 5 to 120");          
                }               
            } else {
                if((age-1) >= 5 && (age-1) <= 120) {
                    $("input[name='age']").val(age-1);
                }
                else {
                    showStrError("error", "Incorrect DOB. Enter age between 5 to 120");
                }
            }
        }

        /* DOB Calculator from Age */
        function getDOB(yrs) {
            yrs = parseInt(yrs);
            if(yrs === undefined) {
                yrs = 0;
            }
            var dob = moment().subtract(yrs, 'years').format('DD/MM/YYYY');
            
            $('#dob_date_picker .ic_date')
                .datepicker(datepicker_option)
                .datepicker('update', dob)
                .on('changeDate', ageCalculator);
        }
        
        /* URL for API's */
        var getFamily_api_url       = "{{url('getFamilyList')}}";
        var getRelationship_api_url = "{{url('getRelationship')}}";
        var addFamily_api_url       = "{{url('addFamilyMember')}}";
        var updateFamily_api_url    = "{{url('editFamilyMember')}}";

        /* Family List Code - Start */
        function processFamilyListHandler(response) {
            $("#myfamily_list_div").html("");
            var family_list_html = '';
            
            if(response) {
                if(Array.isArray(response)) {
                    if(response.length > 0) {
                        response.forEach(function(item){

                            family_list_html += '<div class="add-box">';
                                if(item.relation.toLowerCase() !== 'self') {
                                    family_list_html +='<a class="edit" data-toggle="modal" data-target="#family_edit" onclick="editFamily(\''+item.customer_id+'\');">\
                                            <img src="/img/edit-icon.png">\
                                        </a>';
                                }  
                                
                                family_list_html +='<div class="row">\
                                    <div class="col-sm-5">\
                                        <div class="table-responsive">\
                                            <table class="table">\
                                                <thead>\
                                                    <tr>\
                                                        <th colspan="2">'+item.customer_name;

                                    family_list_html +='</th>\
                                                    </tr>\
                                                </thead>\
                                                <tbody>\
                                                    <tr>\
                                                        <td class="db_titlecaption">Age : </td>\
                                                        <td class="db_titleinfo">';
                                                        if(item.customer_age !== '') {
                                                            family_list_html += item.customer_age + ' Years';
                                                        }
                                                        else {
                                                            family_list_html += 'N/A';
                                                        }
                                                        
                                    family_list_html += '</td>\
                                                    </tr>\
                                                    <tr>\
                                                        <td class="db_titlecaption">Relation : </td>\
                                                        <td class="db_titleinfo">';
                                                        if(item.relation !== '') {
                                                            family_list_html += item.relation;
                                                        }
                                                        else {
                                                            family_list_html += 'N/A';
                                                        }
                                
                                    family_list_html += '</td></tr>\
                                                    <tr>\
                                                        <td class="db_titlecaption">Gender : </td>\
                                                        <td class="db_titleinfo">';
                                                            if(item.customer_gender !== '') {
                                                                if(item.customer_gender.toLowerCase() == 'm') {
                                                                    family_list_html += 'Male';
                                                                }
                                                                else {
                                                                    family_list_html += 'Female';
                                                                }                                                                
                                                            }
                                                            else {
                                                                family_list_html += 'N/A';
                                                            }
                                                            
                                    family_list_html += '</td>\
                                                    </tr>';
                                                    if(item.contact_number !== '') {  
                                                        if(item.contact_number !== null) {
                                                            family_list_html += '<tr>\
                                                                <td class="db_titlecaption">Mobile Number : </td>\
                                                                <td class="db_titleinfo">'+item.contact_number +'</td>\
                                                            </tr>';
                                                        }
                                                    }

                                    family_list_html += '</tbody>\
                                            </table>\
                                        </div>\
                                    </div>\
                                    <div class="col-sm-3 text-center">\
                                        <div class="hb-circle"><p>'+item.lifeStyleScore+'</p>\
                                        </div>\
                                    </div>\
                                    <div class="col-sm-4 text-center btnrdiv">\
                                        <a href="/healthkarma?user_id='+item.customer_id+'" class="btn btn-danger btn_cmncolor">';
                                    if(parseInt(item.lifeStyleScore) > 0) {
                                        family_list_html += 'Retake Healthkarma';
                                    }
                                    else {
                                        family_list_html += 'Healthkarma';
                                    }
                                    family_list_html += '</a>\
                                    </div>\
                                </div>\
                            </div>';
                                                        
                        });

                        $("#myfamily_list_div").html(family_list_html);
                    }
                    else {
                        $("#myfamily_list_div").html("<h1>No family member found</h1>");
                    }
                }
                $("#ajax-loader").hide();
            }
            else {
                $("#ajax-loader").hide();
                //here write no address found code
            } 
        }

        function errorFamilyListHandler(response) {          
            $("#ajax-loader").hide();
            var errorData = response.responseJSON;
            
            showStrError("error", errorData.message);
        }

        // get address list
        function getFamilyList() {
            ajaxCallPromise(getFamily_api_url, "GET", null).then(processFamilyListHandler, errorFamilyListHandler);
        }
        
        getFamilyList();

        /* Family List Code - END */
        
        
        /* Get Relationship Code - Start */
        function processRelationshipHandler(response) {
            var relation_list_html = '<option value="" selected="selected">Select Relation</option>';
            
            if(response) {
                if(Array.isArray(response)) {
                    if(response.length > 0) {
                        response.forEach(function(item){
                            relation_list_html += '<option value="'+item.value+'">'+item.value+'</option>';
                        });
                        $("#relation").html("");
                        $("#relation").html(relation_list_html);
                    }
                }
                $("#ajax-loader").hide();
            }
            else {
                $("#ajax-loader").hide();
            }
        }

        function errorRelationshipHandler(response) {
            $("#ajax-loader").hide();
            var errorData = response.responseJSON;
            showStrError("error", errorData.message);
        }

        function getRelationshipList() {           
            ajaxCallPromise(getRelationship_api_url, "GET", null).then(processRelationshipHandler, errorRelationshipHandler);
        }

        getRelationshipList();
        /* Get Relationship Code - End */

        // close address modal
        function closeFamilyModal() {
            $('#family_edit').modal('hide');
            $("#customer_id").val("");
        }

        // click on add address button
        function addFamily() {
            $("#customer_id").val("");
            $("#add_edit_title").text("Add Family Member");
            $('#add_family_form')[0].reset();
            var validator = $( "#add_family_form" ).validate();
            validator.resetForm();
            //$("#checkbox6").prop("checked", "checked");
        }

        /* Add Family Code - Start */
        function addFamilySuccessHandler(response) {
            $("#ajax-loader").hide();
            if(response) {
                if(response.status) {                    
                    getFamilyList();
                    $('#add_family_form')[0].reset();
                    var validator = $( "#add_family_form" ).validate();
                    validator.resetForm();
                    $("#checkbox6").prop("checked", "checked");

                    showStrError("success", response.message);
                    closeFamilyModal();
                }
                else {
                    showStrError("error", response.message);
                }
            }  
            return false;
        }

        function addFamilyErrorHandler(response) {
            $("#ajax-loader").hide();
            var errorData = response.responseJSON;

            showStrError("error", errorData.message);
            return false;
        }
        /* Add Family Code - End */

        /* Edit Family Code - Start */
        function editFamilySuccessHandler(response) {
            $("#ajax-loader").hide();
            if(response) {
                if(response.status) {
                    closeFamilyModal();
                    getFamilyList();

                    showStrError("success", response.message);
                }
                else {
                    showStrError("error", response.message);
                }
            }  
            return false;
        }
        
        function editFamilyErrorHandler(response) {
            $("#ajax-loader").hide();
            var errorData = response.responseJSON;
            
            showStrError("error", errorData.message);
            return false;
        }
        
        
        function autoPopulateEditFamily(response) {
            $("#ajax-loader").hide();

            if(response) {
                var customer_id = $("#customer_id").val();

                if(Array.isArray(response)) {
                    if(response.length > 0) {
                        response.forEach(function(item){
                            if(item.customer_id == customer_id) {

                                $("#customer_id").val(customer_id);                                                            
                                $("#username").val(item.customer_name);
                                $("#age").val(item.customer_age);
                                $("#mobile").val(item.contact_number);
                                $("#email").val(item.email);
                                $("#relation").val(item.relation);

                                if(item.customer_gender.toLowerCase() == 'm') {
                                    $("#checkbox6").prop("checked", "checked");
                                }
                                else {
                                    $("#checkbox7").prop("checked", "checked");
                                }

                                if(item.dob !== '') {
                                    if(item.dob !== null) {
                                        var edit_dob = moment(item.dob).format("DD/MM/YYYY");

                                        setTimeout(function() {
                                            $('#dob_date_picker .ic_date')
                                            .datepicker(datepicker_option)
                                            .datepicker('update', edit_dob)
                                            .on('changeDate', ageCalculator);
                                        }, 1000);
                                        
                                    }
                                }
                                else {
                                    $('#dob_date_picker .ic_date')
                                        .datepicker(datepicker_option)
                                        .datepicker('update')
                                        .on('changeDate', ageCalculator);
                                }
                            }                                
                        });
                    }
                }
            }
            else {
                $('#family_edit').modal('hide');
            }
        }
        
        // click on edit address button
        function editFamily(customer_id) {
            $("#add_edit_title").text("Edit Family Member");
            $('#add_family_form')[0].reset();
            var validator = $( "#add_family_form" ).validate();
            validator.resetForm();
            
            $("#customer_id").val("");
            $("#customer_id").val(customer_id);

            ajaxCallPromise(getFamily_api_url, "GET", null).then(autoPopulateEditFamily, addFamilyErrorHandler);            
        }

        /* Edit Family Code - END */

        // To check device source
        if (isMobile.any()) {
            $("#device_source").val('mobile');
        }
        else {
            $("#device_source").val('web');
        }

        // To add/edit address form submittion
        $('#add_family_form').validate({
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
                username: {
                    required: true,
                    lettersonly: true,
                    maxlength: 512
                },
                relation: {
                    required: true,
                    lettersonly: true                    
                },
                age: {
                    required: true,
                    digits: true,
                    maxlength: 3
                },
                dob: {
                    required: true,
                    dob: true
                },
                gender: {
                    required: true,
                    lettersonly: true
                },
                mobile: {
                    digits: true,
                    minlength: 10,
					maxlength: 10
                },
                email : {
                    email: true,
                    maxlength: 512	
                }
            },
            messages: {
                username: {
                    required : "Please specify name",
					lettersonly: "Please enter characters only"
                },
                relation: {
                    required: "Please select relation using dropdown"
                },
                age: {
                    required: "Please enter age",
                    digits  : "Enter valid age",
                    maxlength : "Please enter valid 3 digit no.",
                },
                dob: {
                    required: "Please select date of birth using calender"
                },
                gender: {
                    required: "Please select gender",
                },
                email: {
					email: "Email address must be in the format of test@domain.com"
				},
				mobile: {
					digits: "Not a valid 10-digit mobile no.",
					minlength : "Please enter valid 10 digit no.",
					minlength : "Please enter valid 10 digit no."
				}
            },
            submitHandler: function (form) {
                var age = $("#age").val();
              
                if(age < 5 && age > 120) {
                    showStrError("error", "Enter age between 5 to 120");
                }
                else {
                    var customer_id = $("#customer_id").val();

                    if(customer_id == '') {
                        ajaxCallPromise(addFamily_api_url, "POST", $('#add_family_form').serialize()).then(addFamilySuccessHandler, addFamilyErrorHandler);
                    }
                    else {
                        ajaxCallPromise(updateFamily_api_url, "POST", $('#add_family_form').serialize()).then(editFamilySuccessHandler, editFamilyErrorHandler);
                    }
                    return false;
                }
            }
        });
    </script>
@endpush