@extends('layout.master')

@section('page-content')
<style>.datepicker { color: #080808 !important;z-index: 999999;}</style>

<section class="faimly-friendwraper edit-profile">

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
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 shubham edit-input">
                <div class="Family-headingdiv text-left">
                    <h3>Edit Profile</h3>	
                </div>
                <div class="Retake-Healthkarmadiv">
                
                    <div class="add-box">
                        <div class="profile-details">
                            <div id="user_image_name_div">
                                @if(empty($userDetail['image_path']))
                                    <div class="user-name-div">
                                        {{ strtoupper($userDetail['name'][0]) }}

                                        <a href="javascript:void(0)" class="btn btn-info penciledit" onclick="document.getElementById('my_pics').click();"> <i class="fa fa-camera" aria-hidden="true"></i> </a>

                                    </div>
                                @else 
                                    <div class="user-img" style="border-radius: 0%;">
                                        <img class="center-block" src="{{ $userDetail['image_path'] }}" id="user_profile_pic">

                                        <a href="javascript:void(0)" class="btn btn-info penciledit" onclick="document.getElementById('my_pics').click();"> <i class="fa fa-camera" aria-hidden="true"></i> </a>
                                    </div>
                                @endif
                            </div>                               
                           
                            <div class="user-profile-details">
                                <h3>Hi, <span id="display_profile_head_name">{{ ucfirst($userDetail['name']) }}</span></h3>
                                <p>{{ $userDetail['email'] }}</p>
                                <a href="javascript:void(0);" class="btn btn-danger" onclick="displayEditProfile();" id="edit_profile_link">Edit Profile</a>
                            </div>
                        </div>
                        <br>	
                        

                        <form  id="update_pic_form" name="update_pic_form" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="file" name="my_pics" id="my_pics">
                        </form>

                        <div class="user-form" id="profile_display_info">
                            <div class="alert alert-success" id="profile_success_div" style="display:none;"></div>    
                            <div class="lft-f-details">
                                <div>
                                    <h6>Name</h6>
                                    <p id="display_profile_name">{{ $userDetail['name'] }}</p>
                                </div>
                                <div>
                                    <h6>Email Id</h6>
                                    <p>{{ $userDetail['email'] }}</p>
                                </div>
                                <div>
                                    <h6>Age</h6>
                                    <p  id="display_profile_age">{{ $userDetail['age'] }}</p>
                                </div>
                            </div>

                            <div class="rgt-f-details">
                                <div>
                                    <h6>Mobile Number</h6>
                                    <p>{{ $userDetail['mobile'] }}</p>
                                </div>
                                <div>
                                    <h6>Gender</h6>
                                    <p  id="display_profile_gender">
                                        @if(strtolower($userDetail['gender']) == 'm')
                                            <span><img src="/img/male.png" alt="Image"> Male</span>
                                        @else
                                            <span><img src="/img/female.png" alt="Image"> Female</span>
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <h6>Date of Birth</h6>
                                    <p>
                                        <span  id="display_profile_dob">
                                            @if(!empty($userDetail['display_dob']))
                                                {{ $userDetail['display_dob'] }}                                        
                                            @else
                                                N/A
                                            @endif
                                        </span>
                                        <img class="pull-right" src="/img/calender-icon.png" alt="images">
                                    </p>
                                </div>
                                
                            </div>
                        </div>

                        <div class="user-form" id="edit_profile_div" style="display:none;">
                            <form  id="edit_profile_form" name="edit_profile_form" method="post">
                                {{csrf_field()}}
                                
                                <div class="alert alert-danger" id="profile_error_div" style="display:none;"></div>

                                <div class="lft-f-details">
                                    <div>
                                        <h6>Name</h6>
                                        <input type="text" placeholder="Enter Name" name="name" id="name" value="{{ $userDetail['name'] }}" tabindex="1" maxlength="512" required autocomplete="off">
                                    </div>
                                    <div>
                                        <h6>Email Id</h6>
                                        <input type="email" value="{{ $userDetail['email'] }}" disabled="disabled">
                                    </div>
                                    <div>
                                        <h6>Age</h6>
                                        <input type="text" placeholder="Enter Age" id="age" name="age"  tabindex="4" value="{{ $userDetail['age'] }}" maxlength="3" required autocomplete="off">
                                    </div>								
                                </div>

                                <div class="rgt-f-details">
                                    <div>
                                        <h6>Mobile Number</h6>
                                        <input type="text" value="{{ $userDetail['mobile'] }}" disabled="disabled">
                                    </div>


                                    <div>
                                        <h6>Gender</h6>

                                          <div class="genderblock">
                                                    <div class="gend_left">

                                                <ul>
                                                    <li>
                                                    @if(strtolower($userDetail['gender']) == 'm')
                                                        <input id="checkbox6" name="gender" type="radio" checked="checked" value="M" tabindex="2">
                                                    @else
                                                        <input id="checkbox6" name="gender" type="radio" value="M" tabindex="2">
                                                    @endif
                                                    <label for="checkbox6">Male  </label>
                                                </li>


                                                <li>
                                                    @if(strtolower($userDetail['gender']) == 'f')
                                                        <input id="checkbox7" name="gender" type="radio" checked="checked" value="F" tabindex="3">
                                                    @else
                                                        <input id="checkbox7" name="gender" type="radio" value="F" tabindex="3">
                                                    @endif

                                                <label for="checkbox7">Female  </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>



                                    </div>

                                    <div class="clearfix"></div>



                                    <div class="dobmyprofile">
                                        <h6>Date Of Birth</h6>								
                                        <input value="{{ $userDetail['display_dob'] }}" id="dob" name="dob"  tabindex="5" placeholder="Date Of Birth *" readonly required>
                                    </div>
                                </div>
                                
                                <div class="center-bnt">
                                    <a href="javascript:void(0);" class="btn btn-default btn_whtcolor" onclick="displayProfileInfo();">Cancel</a>
                                    <button type="submit" class="btn btn-danger btn_cmncolor">Update Profile</button>
                                </div>
                            </form>

                        </div>

                        
                        
                    </div>

                    {{-- <div class="add-box bottom-details-profile">
                        <h4>Body Mass Index</h4>

                        <div class="lft-f-details">
                            <div>
                                <h6>Weight</h6>
                                <p>
                                    @if(!empty($userDetail['weight']))
                                        {{ $userDetail['weight'] }}                                        
                                    @else
                                        N/A
                                    @endif 

                                </p>
                            </div>
                        </div>

                        <div class="rgt-f-details">
                            <div>
                                <h6>Height</h6>
                                <p>
                                    @if(!empty($userDetail['height']))
                                        {{ $userDetail['height'] }}                                        
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="last-weight">
                            <h6>28.5</h6>
                            <p>Over Weight</p>
                        </div>
                    </div> --}}

                    {{-- <div class="center-bnt">
                        <a href="#" class="view-details">Update Profile</a>

                        <a href="#" class="view-details">Connect With Google Fit</a>
                    </div> --}}

                </div>	
            </div>	
        </div>
    </div>
</section>
@endsection
@push('footer-scripts')

<link href="/css/t2/bootstrap-datepicker.min.css" rel="stylesheet">
<script src="/js/moment.min.js" defer></script>
<script src="/js/bootstrap-datepicker.min.js" defer></script>

<script>
    /* URL for API's */
    var editProfile_api_url         = "{{url('editProfile')}}";
    var updateProfilePic_api_url    = "{{url('updateProfilePic')}}";
    var today = new Date();

    today.setFullYear(today.getFullYear() - 5);

    var datepicker_option = {
        format          : "dd-mm-yyyy",
        endDate         : today,
        autoclose       : true,
        clearBtn        : true,
        todayHighlight  : true
    };

    function displayEditProfile() {
        $("#edit_profile_div").show();
        $("#profile_display_info").hide();
        $("#edit_profile_link").hide();
    }

    function displayProfileInfo() {
        $("#edit_profile_div").hide();
        $("#profile_display_info").show();
        $("#edit_profile_link").show();
    }

    function updateProfilePicSuccessHandler(response) {
        $("#ajax-loader").hide();
        if(response.status) {
            var img_html = '<div class="user-img" style="border-radius: 0%;">\
                <img class="center-block" src="'+response.data['image']+'">\
                <a href="javascript:void(0)" class="btn btn-info penciledit" onclick="document.getElementById(\'my_pics\').click();"> <i class="fa fa-camera" aria-hidden="true"></i> </a>\
            </div>';

            $("#user_image_name_div").html(img_html);
        }
        else {
            showStrError("error", response.message);
        }
    }

    function updateProfilePicErrorHandler(response) {
        $("#ajax-loader").hide();
        var errorData = response.responseJSON;
        showStrError("error", errorData.message);
    }

    $(document).ready(function(){
        $.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z\s]+$/i.test(value);
        });
        $.validator.addMethod("dob", function(value, element) {
            return this.optional(element) || moment(value,"dd-mm-yyyy").isValid();
        }, "Please enter a valid date in the format DD-MM-YYYY");

        
        $('#dob').datepicker(datepicker_option)
            .on('changeDate', ageCalculator);
        

        $("#age").bind("change blur focusout", function() {
            var age = $("#age").val();
            console.log("age", age);
            if(age !== '') {
                if(age >= 5 && age <= 120) {
                    getDOB(age);
                }
                else {
                    $("#age").val("");
                    $("#profile_error_div").show();
                    $("#profile_error_div").html("Enter age between 5 to 120");

                    setTimeout(function() {
                        $("#profile_error_div").hide();
                        $("#profile_error_div").html("");
                    }, 6000);                        
                }
            }
        });

        $('input[name=my_pics]').change(function(ev) {
            var formData = new FormData( $('#update_pic_form')[0]);
            $.ajax({
                type: "POST",
                url: updateProfilePic_api_url,
                data: formData,
                beforeSend  : function() {
                    $("#ajax-loader").show();
                },
                processData: false,
                contentType: false,
                success:updateProfilePicSuccessHandler,
                error: updateProfilePicErrorHandler
            });
        });
    });

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

        if (currentmonth >= mm) {
            if(age >= 5 && age <= 120) {
                $("input[name='age']").val(age);
            }               
        } else {
            if((age-1) >= 5 && (age-1) <= 120) {
                $("input[name='age']").val(age-1);
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

    function editProfileSuccessHandler(response) {
        $("#ajax-loader").hide();

        if(response) {
            if(response.status) {
                $("#display_profile_head_name").text(response.data.name);
                $("#display_profile_name").text(response.data.name);
                $("#display_profile_age").text(response.data.age);
                var display_dob = moment(response.data.dob).format("DD-MM-YYYY");
                $("#display_profile_dob").text(display_dob);

                $("#name").val(response.data.name);
                $("#age").text(response.data.age);
                
                if(typeof response.data.image_path !== 'undefined') {
                    if(response.data.image_path !== '') {
                        $("#user_profile_pic").attr('src', response.data.image_path);
                    }
                }

                if(response.data.gender.toLowerCase() == 'm') {
                    $("#display_profile_gender").html('<span><img src="/img/male.png" alt="Image"> Male</span>');
                    $("#checkbox6").prop("checked", "checked");
                }
                else {
                    $("#display_profile_gender").html('<span class="span-margin-l"><img src="/img/female.png" alt="Image"> Female</span>');
                    $("#checkbox7").prop("checked", "checked");
                }

                $("#profile_success_div").show();
                $("#profile_success_div").html(response.message);
                displayProfileInfo();

                setTimeout(function() {
                    $("#profile_success_div").hide();
                    $("#profile_success_div").html("");
                }, 10000);
            }
            else {
                $("#profile_error_div").show();
                $("#profile_error_div").html(response.message);
                setTimeout(function() {
                    $("#profile_error_div").hide();
                    $("#profile_error_div").html("");
                }, 8000);
            }
        }  
    }
    
    function editProfileErrorHandler(response) {
        $("#ajax-loader").hide();
        var errorData = response.responseJSON;

        $("#profile_error_div").show();
        $("#profile_error_div").html(errorData.message);

        setTimeout(function() {
            $("#profile_error_div").hide();
            $("#profile_error_div").html("");
        }, 8000);
    }

    // To add/edit address form submittion
    $('#edit_profile_form').validate({
        rules: {
            name: {
                required: true,
                lettersonly: true,
                maxlength: 512
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
            }
        },
        messages: {
            name: {
                required : "Please specify name",
                lettersonly: "Please enter characters only"
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
                lettersonly: "Please enter characters only"
            }
        },
        submitHandler: function (form) {
            var age = $("#age").val();
            
            if(age < 5 && age > 120) {
                $("#profile_edit_error_div").show();
                $("#profile_edit_error_div").html("Enter age between 5 to 120");

                setTimeout(function() {
                    $("#profile_edit_error_div").hide();
                    $("#profile_edit_error_div").html("");
                }, 6000);
            }
            else {
                ajaxCallPromise(editProfile_api_url, "POST", $('#edit_profile_form').serialize()).then(editProfileSuccessHandler, editProfileErrorHandler);
            }
        }
    });

</script>
@endpush