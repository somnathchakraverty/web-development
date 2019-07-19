@extends('layout.master')

@section('page-content')

<!-- ---welcome to healtains div start here-------- -->
<section class="Wlcm-Healthians">
    <div class="container">
        <div class="row">
          <div class="col-sm-12 text-center">
           <h2>Let us know you better</h2>
           <p>Fill in the details below so that we can serve you better</p>
           <img src="/img/underline.png" class="underline" alt="" >
           </div>
      </div>
    <!-- box section start here -->
    <div class="row">
      <div class="login-outer">
        <div class="col-sm-12 login-wraper">
            <!-- ---left box div start here-- -->
            <div class="left-boxdiv text-center">
                <div id="owl-demo1">

                <div class="item"><img src="/img/boxicon.png" alt="">
                 <div><strong>Customized</strong>
                <p>Real Time Packages</p></div>
                </div>

                <div class="item"><img src="/img/cost-effective.png" alt="">
                   <div> <strong>Cost Effective</strong>
                    <p>Honest Price Guaranteed</p></div>
                </div>
                  <div class="item"><img src="/img/Convenient.png" alt="">
                <div> <strong> Convenient</strong>
                    <p>Free Home Sample Collection</p></div>
                </div>

                  <div class="item"><img src="/img/timer.png" alt="Owl Image">
                        <div><strong>Carefree</strong>
                      <p>Accurate Results on Time</p></div>
                    </div>

                    <div class="item"><img src="/img/complete.png" alt="Owl Image">
                    <div><strong>Complete</strong>
                      <p>Pro-active Wellness Support</p></div>
                    </div>
                 </div>
            </div>
          <!-- ---right box div start here-- -->
          <div class="right-boxdiv">
              <h3>Enter your Details</h3>
              <div class="underlineblue"></div>

              <!-- ---location btn-div start here-- -->
              <form action="{{url('profile-info')}}" id="profileinfo_form" name="profileinfo_form" method="post">
                  {{ csrf_field() }}
                  <!--Name-->
                  <div class="enternameinput col-md-12 col-xs-12">
                      <label>Name</label>
                      @php($name_value = empty(old('name')) ? $name : old('name') )
                      <input type="text" name="name" id="name" value="{{ $name_value }}" placeholder="Enter full name">
                      <small class="text-danger">{{ $errors->first('name') }}</small>
                  </div>

                  <!--Email-->
                  <div class="enternameinput  col-md-12 col-xs-12">
                      <label>Email</label>
                      @php($email_value = empty(old('email')) ? $email : old('email') )
                      <input type="email" name="email" id="email" value="{{ $email_value }}" placeholder="Enter email name">
                      <small class="text-danger">{{ $errors->first('email') }}</small>
                  </div>

                  <!--Age-->
                  <div class="nomarginpadding col-md-12 col-xs-12">
                    <div class="col-md-5 col-xs-12 nomarginpadding">
                  <div class="enternameinput">
                      <label>Age(yrs.)</label>
                      @php($age_value = empty(old('age')) ? $age : old('age') )
                      <input type="text" name="age" id="age" value="{{ $age_value }}" placeholder="Enter your age">
                      <small class="text-danger">{{ $errors->first('age') }}</small>
                  </div>
                </div>



                <div class="col-md-7 col-xs-12 nomarginpadding">
                  <!--Gender -->
                  <div class="">
                    <div class="col-md-12 col-xs-12 genderupdateinfo">
                      @php($gender_value = empty(old('gender')) ? $gender : old('gender') )

                        <div class="genderInfo">
                         <div class="block_left">

                            <ul>
                               <li>
                                <div class="radio_genoption">
                                  @if($gender_value == 'M')
                                    <input name="gender" id="male_checkbox_7" type="radio" value="M" checked>
                                @else
                                    <input name="gender" id="male_checkbox_7" type="radio" value="M">
                                @endif
                                 <label for="male_checkbox_7">Male</label>   
                             </div>
                               </li>

                               <li>
                                @if($gender_value == 'F')
                                    <input name="gender" id="female_checkbox_8" type="radio" value="F" checked>
                                @else
                                    <input name="gender" id="female_checkbox_8" type="radio" value="F">
                                @endif
                                 <label for="female_checkbox_8">Female</label>
                             </li> 
                            </ul>
                        </div>
                     </div>
                     <small class="text-danger">{{ $errors->first('gender') }}</small>                           
                      </div>
                  </div>
                </div>                      
                </div>
                  <!--Age-->
                  @if($signUp)
                    <div class="enternameinput col-xs-12 col-md-12">
                        <label>Promo</label>
                        @php($refercode_value = empty(old('referCode')) ? '' : old('referCode') )
                        <input type="text" value="{{ $refercode_value }}" name="referCode" placeholder="Enter promo code">
                        <small class="text-danger">{{ $errors->first('referCode') }}</small>
                    </div>
                  @endif
                  <div class="loginbtndiv">
                      <button type="submit"  onClick="validateLoginInfoDetail();" id="update_detail" class="btn btn-danger"> Update Details <img src="/img/left-icon.png" width="20px;"> </button>
                  </div>
                  <input type="hidden" name="source" />
              </form>
          </div>
      </div>
  </div>
</div>
</div>
</div> 
</section>
@endsection
@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            var gender_value    =   $("input[name='gender']:checked").val();
            if(gender_value == undefined || gender_value == '')
//                $("input[name=gender][value='M']").prop("checked",true);
            $.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            });            
	});
        
        // To check device source
        if (isMobile.any()) 
            $("input[name='source']").val('mobile');
        else
            $("input[name='source']").val('web');
        
        function validateLoginInfoDetail() {
            $('#profileinfo_form').validate({
                rules: {
                    name: {
                        required    :   true,
                        lettersonly :   true
                    },
                    email: {
                        required    :   true,
                        email       :   true
                    },
                    age: {
                        required    :   true,
                        range       :   [5, 120]				
                    },
                    gender: {
                        required    :   true					
                    }
                },
                invalidHandler: function(form, validator) {
                    for (var i=0;i<validator.errorList.length;i++){
                        pushGaEvent('Update User Popup', 'Showed Error for Validation Failure', 'Customer '+validator.errorList[i].element.name);
                    }    
                },
                errorPlacement: function(error, element) {
                    
                    if (element.attr("type") == 'radio') {
                        var insertList  =   element.parent().parent().parent().append('<li></li>');
                        error.appendTo(insertList);
                    }
                    else {
                        error.insertAfter(element);
                    }
                },
                messages: {
                    name: {
                        required    :   "Name is required",
                        lettersonly :   "Please enter characters only"
                    },
                    email: {
                        required    :   "Email is required"
                    },
                    age: {
                        required    :   "Age is required",
                        digits      :   "Not a valid 2-digit age",
                        minlength   :   "Please enter valid 3 digit no.",
                        minlength   :   "Please enter valid 1 digit no."
                    },
                    gender: {
                        required    :   "Gender is required"
                    }
                },
                submitHandler: function(form)
                {
                    values = $('#profileinfo_form').serialize();
                    
                    form.submit();
                    return false;
                }
            });
        }
    </script>
@endpush