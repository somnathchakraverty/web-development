<!-- Add New Family Member Modal Starts -->
<div id="addFamilyM" class="modal fade addnewfamilymember_popup" role="dialog">
  <div class="modal-dialog getcallback_popup">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="closeMemberModal()" >&times;</button>

        <div class="col-sm-12 text-center modaltitle">
            <h2> Add New Family Member </h2>
            <img class="lazy-loaded" data-src="/img/underline.png" alt="underline" src="/img/underline.png">
        </div>
      </div>
      <div class="modal-body text-center">
        <div class="text-center">
            <div class="col-md-12 mar-top select-member-option">
                <form id='add_family_form' name='add_family_form' method='post'>
                    <div class="alert alert-danger" id="family_error_div" style="display:none;"></div>
                    <div class="alert alert-success" id="family_success_div" style="display:none;"></div>
                    {{csrf_field()}}
                     <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 normal-input">
                         <span class="labelname">Name</span>
                         <input name="username" id="username" type="text" placeholder="Full Name *" tabindex="1" maxlength="512" required autocomplete="off"> 
                     </div>
                     <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 normal-input">
                        <span class="labelname">Relation</span>
                         <select   name="relation" class="relationwith" id="relation" tabindex="2" required>
                            <option value="" selected>Select Relation</option>
                        </select>
                     </div>
                     <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 normal-input">
                         <span class="labelname">Mobile No.</span>
                         <input name="mobile" id="mobile" type="tel" placeholder="Mobile No."  tabindex="3"  maxlength="10" minlength="10" autocomplete="off">
                     </div>
                     <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 normal-input">
                         <span class="labelname">Age</span>
                         <input type="text" id="age" name="age"  tabindex="4" placeholder="Age *" maxlength="3" required autocomplete="off">
                     </div>
                     <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 normal-input" id="dob_date_picker" onClick="dob_click();">
                         <span class="labelname">Date Of Birth</span>
                         <div class="input-group date dategroup">
                             <div class="field_myfamilyblade">
                                <input type="text" class="ic_date" id="dob" name="dob" readonly tabindex="5" placeholder="Date Of Birth *" required autocomplete="off">
                             </div>
                         </div>
                     </div>
                     <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                         <span class="labelnameGender">Gender</span>
                         <div class="genderOptions">
                             <div class="genderopt">

                                <ul>
                                   <li>
                                    <div class="radio_genoption">
                                        <input name="gender" value="M" type="radio" tabindex="6" id="f-option" name="selector">
                                     <label for="f-option">Male</label>   
                                 </div>
                                   </li>

                                   <li><input name="gender" value="F" type="radio" tabindex="6" id="s-option" name="selector">
                                     <label for="s-option">Female</label>
                                 </li> 
                                </ul>
                            </div>
                         </div>
                     </div>
                    <input id="device_source" name="device_source" type="hidden" value="">
                    <span class="clearfix"></span>
                     <div class="col-md-12 text-center mar-bot">
                         <div class="loginbtndiv">
                             <button type="submit" class="btn btn-danger btn_cmncolor">Save</button>
                             <button class="btn btn-default btn_whtcolor" href="#" data-dismiss="modal">Cancel</button>
                         </div>
                     </div>
                 </form>
             </div> 
        </div> 
      </div> 
      <div class="clearfix"></div>    
    </div>

  </div>
  <div class="clearfix"></div>
</div>
  
<!-- Add New Family Member Modal Ends-->

@push('footer-scripts')
    <link href="/css/t2/bootstrap-datepicker.min.css" rel="stylesheet">
    <script src="/js/moment.min.js" defer></script>
    <script src="/js/bootstrap-datepicker.min.js" defer></script>    
    <script src="/js/jquery.validate.min.js" async></script>
    
    <script type="text/javascript">
        var customer_count = <?php echo $customer_count ?>;
        
        var test_id         =   "{{$test_id}}";
        var gender_type     =   "{{$gender_type}}";
        var map_array       =   <?php echo json_encode($map_array) ?>;
        var start_date      =   new Date();
        start_date.setFullYear(start_date.getFullYear() - 127);
        
        var end_date     =   new Date();
        end_date.setFullYear(end_date.getFullYear() - 5);
            
        var datepicker_option = {
            format          :   "dd-mm-yyyy",
            startDate       :   start_date, 
            endDate         :   end_date,
            autoclose       :   true,
            clearBtn        :   true,
            todayHighlight  :   true
        };
        
        // To check device source
        if (isMobile.any()) {
            $("#device_source").val('mobile');
        }
        else {
            $("#device_source").val('web');
        }
        
        $(document).ready(function(){
            
            $('input[name="mobile"], input[name="age"]').on("cut copy paste",function(e) {
                e.preventDefault();
            });

            $('input[name="mobile"], input[name="age"]').keypress(function(e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && (e.which != 13)) {
                    return false;
                }
            });
        
            $.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            });
            $.validator.addMethod("dob", function(value, element) {
                return this.optional(element) || moment(value,"dd-mm-yyyy").isValid();
            }, "Please enter a valid date in the format DD-MM-YYYY");

            $('#addFamilyM').on('hidden.bs.modal', function() {
                var validator = $( "#add_family_form" ).validate();
                validator.resetForm();
                $('#add_family_form').trigger("reset");
            });
            
            $('#addFamilyM').on('shown.bs.modal', function() {
                $('#dob').datepicker(datepicker_option)
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
            
            $('#dob')
                .datepicker(datepicker_option)
                .datepicker('update', dob)
                .on('changeDate', ageCalculator);
        }
        
        
        /* URL for API's */
        var addFamily_api_url       =   "{{url('addFamilyMember')}}";
        var getRelationship_api_url =   "{{url('getRelationship')}}";
        var getFamily_api_url       =   "{{url('getFamilyList')}}";
        
        /* Family List Code - Start */
        function processFamilyListHandler(response) {
            $("#existing_member_list").html("");
            var family_list_html = '';

            if(response) {
                if(Array.isArray(response)) {
                    if(response.length > 0) {
                        response.forEach(function(item){
                            var selected_package   =   test_id +'_'+ item.customer_id;
                            console.log(selected_package);
                            family_list_html    +=    '<div class="cart-block col-lg-4 col-md-4 col-sm-4 cart-box">';
                            family_list_html    +=    '<strong>'+ item.customer_name +',</strong> <span>'+ item.relation +'</span>';
                            if(item.customer_gender == 'M')
                                family_list_html    +=    '<p>Male: '+ item.customer_age +'</p>';
                            else if(item.customer_gender == 'F')
                                family_list_html    +=    '<p>Female: '+ item.customer_age +'</p>';
                            family_list_html    +=    '<div class="checkbox checkbox-info checkbox-circle">';
                            if(($.inArray(selected_package, map_array) > -1) || ( gender_type != 'B' && gender_type != item.customer_gender))
                                family_list_html    +=    '<input name="cus_ids" id="'+ item.customer_id +'" value="'+ item.customer_id +'" type="checkbox" disabled>';
                            else
                                family_list_html    +=    '<input name="cus_ids" id="'+ item.customer_id +'" value="'+ item.customer_id +'" type="checkbox">';
                            family_list_html    +=    '<label for="'+ item.customer_id +'"> </label>';
                            family_list_html    +=    '</div></div>';
                        });

                        $("#existing_member_list").html(family_list_html);
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

            $("#family_list_error_div").show();
            $("#family_list_error_div").html(errorData.message);

            setTimeout(function() {
                $("#family_list_error_div").hide();
                $("#family_list_error_div").html("");
            }, 8000);
        }

        // get address list
        function getFamilyList() {
            ajaxCallPromise(getFamily_api_url, "GET", null).then(processFamilyListHandler, errorFamilyListHandler);
        }
        
        function errorRelationshipHandler(response) {
            $("#ajax-loader").hide();
            var errorData = response.responseJSON;

            $("#family_error_div").show();
            $("#family_error_div").html(errorData.message);

            setTimeout(function() {
                $("#family_error_div").hide();
                $("#family_error_div").html("");
            }, 8000);
        }
        
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
        
        function getRelationshipList() {           
            ajaxCallPromise(getRelationship_api_url, "GET", null).then(processRelationshipHandler, errorRelationshipHandler);
        }

        getRelationshipList();
        
        // close address modal
        function closeMemberModal() {
            $('#addFamilyM').modal('hide');
            $('#add_family_form')[0].reset();
        }
        
        /* Add Family Code - Start */
        function addFamilySuccessHandler(response) {
            $("#ajax-loader").hide();
            if(response) {
                if(response.status) {
                    $("#customer_count").text( customer_count + 1);
                    getFamilyList();
                    $('#add_family_form')[0].reset();
                    $("#family_success_div").show();
                    $("#family_success_div").html(response.message);
                    setTimeout(function() {
                        $("#family_success_div").hide();
                        $("#family_success_div").html("");                        
                        closeFamilyModal();
                    }, 6000);
                }
                else {
                    $("#family_error_div").show();
                    $("#family_error_div").html(response.message);
                    setTimeout(function() {
                        $("#family_error_div").hide();
                        $("#family_error_div").html("");
                    }, 8000);
                }
            }  
        }

        // close address modal
        function closeFamilyModal() {
            $('#addFamilyM').modal('hide');
            $("#customer_id").val("");
        }
        
        function addFamilyErrorHandler(response) {
            $("#ajax-loader").hide();
            var errorData = response.responseJSON;

            $("#family_error_div").show();
            $("#family_error_div").html(errorData.message);

            setTimeout(function() {
                $("#family_error_div").hide();
                $("#family_error_div").html("");
            }, 8000);
        }
        /* Add Family Code - End */
        
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
                    required: true,
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
                    required    :   "Please specify name",
                    lettersonly :   "Please enter characters only"
                },
                relation: {
                    required    :   "Please select relation using dropdown"
                },
                age: {
                    required    :   "Please enter age",
                    digits      :   "Enter valid age",
                    maxlength   :   "Please enter valid 3 digit no.",
                },
                dob: {
                    required    :   "Please select date of birth using calender"
                },
                gender: {
                    required    :   "Please select gender",
                },
                email: {
                    email       :   "Email address must be in the format of test@domain.com"
                },
                mobile: {
                    required    :   "Please enter a valid 10 digit mobile number",
                    digits      :   "Not a valid 10-digit mobile no.",
                    minlength   :   "Please enter valid 10 digit no.",
                    minlength   :   "Please enter valid 10 digit no."
                }
            },
            submitHandler: function (form) {
                var age = $("#age").val();
              
                if(age < 5 && age > 120) {
                    $("#family_error_div").show();
                    $("#family_error_div").html("Enter age between 5 to 120");

                    setTimeout(function() {
                        $("#family_error_div").hide();
                        $("#family_error_div").html("");
                    }, 6000);
                }
                else {
                    ajaxCallPromise(addFamily_api_url, "POST", $('#add_family_form').serialize()).then(addFamilySuccessHandler, addFamilyErrorHandler);
                }
            }
        });
    </script>
@endpush