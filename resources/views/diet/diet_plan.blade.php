@extends('layout.master')

@push('header-scripts')

@endpush

@section('page-content')
<div class="diet-planner-section" style="background-image: url({{URL::asset('img/diet/diet.png')}});">
    <div class="container">
       <center>
          <!-- diet-planner-text -->
          <div class="diet-planning-section">
             <h1>Diet Planner</h1>
             <div class="border-gray-line">
                <img src="img/diet/Rectangle-3.png">
             </div>
             <h2>Get your FREE online meal planning solution</h2>
             <h3>Diet planner creates personalized meal plans based on your food preferences, calorie, disease history. Reach your diet and nutritional goals with our calorie calculator & weekly meal plans.
             </h3>
          </div>
          <!-- end-planner-text -->
          <button type="button" class="btn btn-primary meal-plan button-section"><a href="#centerfocus">Create your meal plan in seconds</a></button>
       </center>
    </div>
    <!-- about-section-start -->

    <div class="diet-mid-section" style="background-image: url({{URL::asset('img/diet/food.png')}});">
    <div class="diet-planning-sections">
        <div class="about-yourself-habits">
            <div class="welcome-section">
                <div class="apple-img">
                    <img src="img/diet/apple.png" alt="apple-img">
                </div>
                <div class="about-dietary-habits">
                    <h2 id="centerfocus">Welcome {{ucwords($name)}},</h2>
                    <p>Tell us about your dietary habits</p>
                </div>
            </div>
            <!-- food section start -->
            <form id="save-diet-plan" action="{{route('recommended')}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="about-food-section">
                <div class="Prefered-food">
                    <h3>Prefered food type?</h3>
                    @foreach($diet_plans as $key => $value)
                        <button data-value="{{$value['food_type']}}" data-id="{{$value['id']}}" type="button" class="btn btn-default food-btn  menulink {{((isset($savedDietPreference['food_type_id'])) && $savedDietPreference['food_type_id'] == $value['id']) ? 'active-btn-section' : ''}}">{{$value['food_type']}}</button>
                    @endforeach
                    <input id="food_type" type="hidden" value="{{(isset($savedDietPreference['food_type_id'])) ? $savedDietPreference['food_type_id'] : ''}}" name="food_type">
                    <input id="food_type_val" type="hidden" value="{{(isset($savedDietPreference['food_type_value'])) ? $savedDietPreference['food_type_value'] : ''}}" name="food_type_val">
                </div>
                <div class="calorie-section">
                    <h3>Calorie consumption per day?</h3>
                    <div class="kcal-section">
                        <form>
                            <div class="input-group">
                                <input readonly="readonly" id="input-select-calorie" type="text" data-id="{{(isset($savedDietPreference['calorie_plan_id'])) ? $savedDietPreference['calorie_plan_id'] : 2}}" name="calorie_val" value="{{(isset($savedDietPreference['calorie_plan_value'])) ? $savedDietPreference['calorie_plan_value'] : 1500}}" class="form-control">
                                <div class="input-group-btn">
                                    <div class="kcal-btn">
                                        <button type="button" class="btn btn-default kcal-btn" data-toggle="modal" data-target="#myModal">kcal</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="calorie-calculated-text">
                        <p class="" data-toggle="modal" data-target="#myModal">How calorie is calculated?</p>
                        
                    </div>
                    <!-- medical-history-text -->
                    <div class="medical-history">
                        <h3>Please let us know about your medical history?</h3>
                        <p>You can select multiple disease from the list</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="search-sections">
                                
                                    <div class="form-group">
                                        <!-- <input type="password" class="" form-control data-toggle="modal" data-target="#myModals" id="email" placeholder="Select medical concerns"> -->
                                        <h1 class="" form-control data-toggle="modal" data-target="#myModals">Select medical concerns</h1>
                                    </div>
                          
                                
                                <ul class="search-medical-concern selectListValueShow">
                                    
                                </ul>

                                <div id="form_html">
                                </div>
                                <div class="subscribe-diet-section">
                                    <label class="subscribe-diet">
                                        <p>Subscribe for daily diet updates</p>
                                        <input  type="checkbox" id="subscribe_id">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="plan-diet-btn">
                                    <!-- Trigger the modal with a button -->
                                    <button type="button" id="plan_diet_now"  class="btn btn-danger" title="My diet plan">Plan Diet Now <img class="lazy-loaded" data-src="/img/diet/left-icon-sml.png" src="img/diet/left-icon-sml.png"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>




    <!-- Modal -->
    <div id="myModal" class="modal fade caloriechart_dialog" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="calorie-modal-text">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <center>
                        <div class="modal-body">
                            <div class="diet-calorie-section">
                                <h1>Calorie Calculation</h1>
                                <div class="border-gray-line">
                                    <img src=" img/underline.png">
                                </div>
                                <p>Below stats shows a number of daily calorie estimate guidelines, how many calories to consume each day to maintain, lose or gain weight. <br><br>
                                Gender, Age, Height, Weight & Daily activity level are responsible to calculate Calorie consumption.</p>
                               
                                <h3>Recommended Calories consumption for you</h3>
                                <h5>Based on your Health Karma result</h5>
                                <div class="border-gray-line">
                                    <img src=" img/underline.png">
                                </div>
                            </div>
                        </div>
                    </center>
                    <div class="about-weight text-center">
                        @foreach($calories as $key => $value)
                        
                            <div class="about-weight-text">
                                @if($value['calorie'] == 1200)         
                                    <h4>Weight Loss</h4>       
                                @elseif($value['calorie'] == 1500)
                                    <h4>Maintain Weight</h4>
                                @else
                                    <h4>Weight Gain</h4>
                                @endif
                                
                                <h2>{{$value['calorie']}}</h2>
                                <div class="kcal-btn weight">
                                    <button type="button" class="btn btn-default kcal-btn kcal-weight">kcal</button>
                                </div>
                                <input type="hidden" id="calorie-{{$value['id']}}" name="calorie" data-id="{{$value['id']}}" value="{{$value['calorie']}}" />
                            </div>
                        @endforeach
                      <input type="hidden" data-id="2" value="1500" id="calorie-section-value">
                    </div>
                    <div class="Choose-btn text-center">
                        <button id="choose-calory-btn" class="btn btn-danger" data-dismiss="modal" >Choose calories <img class="lazy-loaded" data-src="/img/diet/left-icon-sml.png" src=""></button>
                    </div>                                   
                </div>
            </div>
            
        </div>
    </div>
    




    <!-- Modal -->
    <div id="myModals" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="calorie-modal-text">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <!-- serch-medical-secton-start -->
                     <h2>Search Medical Concerns</h2>
                        <div class="Search-medical-section">
                               <div class="searh-type-boxed">
                                
                                <input type="text" id="myInput" autofocus onkeyup="myFunction()" placeholder="Type disease name.." title="Type in a name">
                            </div>
                            <ul id="myUL">
                                @foreach($diseases_list as $key=> $value)
                                <li>
                                    <a href="javascript:void(0);">
                                        <label class="search-medical-concerns">{{$value['name']}}
                                        <input  id="checked-{{$value['id']}}" onclick="selectListValue(this)" value="{{$value['id']}}" data-name="{{$value['name']}}" type="checkbox">
                                        <span class="checkmark checkedbxstatus"></span>
                                        </label>
                                    </a>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                        <!-- btn -->
                        <div class="Choose-calories-btn text-center">
                            <a data-dismiss="modal" href="/most-selling" class="btn btn-danger selectSubmit" title="My diet plan">Selected (0) <img class="lazy-loaded" data-src="/img/diet/left-icon-sml.png" src=""></a>
                        </div>
                        <!-- end-btn -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="clear"></div>



@endsection
@push('footer-scripts')
      <script type="text/javascript">
        var data = [];
        var dataCount = 0;
        var selectSubmit = $(".selectSubmit");
        var selectListValueShow = $(".selectListValueShow");
        $(document).ready(function() {
            $('#myUL li input[type=checkbox]').prop('checked',false);
            @if($savedDietDisease)
                @foreach ($savedDietDisease as $key => $value)
                    var eleDiesease = $("#checked-{{$value['id']}}");
                    eleDiesease.prop('checked', true);
                    var value = eleDiesease.val();
                    var name = eleDiesease.data('name');
                    data.push({key:value, value:name}); 
                    var html = `<li  id="select-val-`+value+`" class="medical-selection  btn btn-default">
                            `+name+` 
                            <img onclick="removeSelectVal('`+value+`')" src="img/diet/x.png">
                        </li>`;
                    selectListValueShow.append(html);

                @endforeach
            @endif

            //console.log(data);
            if(data.length > 0)
            {
                dataCount = data.length;
            }
            var selectSubmitText = "Selected ("+dataCount+")";
            selectSubmit.text(selectSubmitText);
    
            @if(isset($savedDietPreference['daily_diet_plan']) && $savedDietPreference['daily_diet_plan'] == 1)
                $("#subscribe_id").prop('checked', true);
            @else
                $("#subscribe_id").prop('checked', false);
            @endif

            $("#input-select-calorie").click(function(){
                $("#myModal").modal();
            })

            $('#myModals').on('shown.bs.modal', function (e) {
                $('#myInput').focus();
            });
            
            $(".food-btn").click(function() {
                var food_type = $(this).data('id');
                var food_type_val = $(this).data('value');
                $("#food_type").val(food_type);
                $("#food_type_val").val(food_type_val);
                $(".food-btn").removeClass("active-btn-section");
                $(this).addClass("active-btn-section");
            });

            $(".about-weight-text").click(function() {
                var calorie_ele = $(this).find("input");
                var calorie_val = calorie_ele.val();
                var calorie_id = calorie_ele.data('id');
                $("#calorie-section-value").val(calorie_val);
                $("#calorie-section-value").data('id',calorie_id);                
                $(".about-weight-text").removeClass("active-weight");
                $(this).addClass("active-weight");
             });

            $("#choose-calory-btn").click(function(){
               var calorie_val = $("#calorie-section-value").val();
               var calorie_id = $("#calorie-section-value").data('id');
               $("#input-select-calorie").val(calorie_val);
               $("#input-select-calorie").data('id',calorie_id);

            })
        });

        function myFunction() {
             var input, filter, ul, li, a, i, txtValue;
             input = document.getElementById("myInput");
             filter = input.value.toUpperCase();
             ul = document.getElementById("myUL");
             li = ul.getElementsByTagName("li");
             for (i = 0; i < li.length; i++) {
                 a = li[i].getElementsByTagName("a")[0];
                 txtValue = a.textContent || a.innerText;
                 if (txtValue.toUpperCase().indexOf(filter) > -1) {
                     li[i].style.display = "";
                 } else {
                     li[i].style.display = "none";
                 }
             }
         }
        
        
            
        function selectListValue(element)
        {
            var value = element.value;
            var name = $(element).data('name');
            var html = `<li  id="select-val-`+value+`" class="medical-selection  btn btn-default">
                            `+name+` 
                            <img onclick="removeSelectVal('`+value+`')" src="img/diet/x.png">
                        </li>`;
            if(element.checked == false)
            {
                data = data.filter(el => el.key !== value);
                $("#select-val-"+value).remove();
            }
            else
            {
                
                selectListValueShow.append(html);
                data.push({key:value, value:name});  
            }
            //console.log(data);
            if(data.length > 0)
            {
                dataCount = data.length;
            }
            var selectSubmitText = "Selected ("+dataCount+")";
            selectSubmit.text(selectSubmitText);
         }

         function removeSelectVal(elementId)
         {
            data = data.filter(el => el.key !== elementId);
            $("#checked-"+elementId).prop("checked", false);
            $("#select-val-"+elementId).remove();
            var selectSubmitText = "Selected ("+data.length+")";
            selectSubmit.text(selectSubmitText);
            //console.log(data);
         }
        
         $("#subscribe_id").click(function()
         {
            var notification_status =  $("#subscribe_id").is(':checked');

            if(notification_status == true)
            {
                   if(typeof(clevertap) !== 'undefined') 
                   {
                    clevertap.notifications.push({
                        "titleText"             :'Would you like to receive Push Notifications?',
                        "bodyText"              :'We promise to only send you relevant content and give you updates on your transactions',
                        "okButtonText"          :'Sign me up!',
                        "rejectButtonText"      :'No thanks',
                        "okButtonColor"         :'#00a0a8',
                        "askAgainTimeInSeconds" : 1,
                    });
                }
            }
            else
            {

                if(typeof(clevertap) !== 'undefined') 
                {
                    $("#wzrk-cancel").trigger("click");
                }
            }

         });

         var form_html = "";
         var form_html_elem = $("#form_html");
         $("#plan_diet_now").click(function()
         {
            form_html_elem.empty();

            var food_type = $("#food_type").val();
            var calorie = $("#input-select-calorie").data('id');
            var notification_status =  $("#subscribe_id").is(':checked');
            if(notification_status == true)
            {
                notification_status = 1;
            }
            else
            {
                 notification_status = 0;
            }
            //alert(notification_status);
          
            form_html = `<input type="hidden" name="calorie_id" value='`+calorie+`' >`;
            
            var disease = [];
            if(data.length > 0)
            {
                for(var i =0; i < data.length; i++)
                {
                    disease[i] = {id:data[i].key};
                    form_html += `<input type="hidden" name="disease_all[`+i+`][id]" value="`+data[i].key+`" >`;
                    form_html += `<input type="hidden" name="disease_all[`+i+`][name]" value="disease `+data[i].key+`" >`; 
                    form_html += `<input type="hidden" name="disease_all[`+i+`][disease_name]" value="`+data[i].value+`" >`;  
                }
            }

            form_html += `</div>`;
            if(food_type == "")
            {
                showStrError("error", "Please select food type");
                return;
            }

            if(calorie == "")
            {
                showStrError("error", "Please select calorie");
                return;
            }
            
            // if(disease.length == 0)
            // {
            //     showStrError("error", "Please select medical concerns");
            //     return;
            // }

            form_html_elem.html(form_html);

            var actionUrl = "{{route('save-diet-plan')}}";
            var request_data = {
                food_type:food_type,
                calorie:calorie,
                disease:disease,
                notification_status:notification_status,
                '_token'    : '{{csrf_token()}}'
            };

            
            ajaxCall(actionUrl, "POST", request_data, function(result){

                if(result.status === true)
                {
                    $("#save-diet-plan").submit();
                }
                else
                {
                    showStrError("error", result.message);
                }
                
            });
            
         })

      </script>

<!-- SCROLL DIV SECTION  -->
    <script type="text/javascript">
          $('a[href^="#"]').on('click', function(event) {

    var target = $(this.getAttribute('href'));

    if( target.length ) {
        event.preventDefault();
        $('html, body').stop().animate({
            scrollTop: target.offset().top
        }, 1000);
    }

});
   </script>
   <!-- SCROLL DIV SECTION  -->
<style type="text/css">
    .wzrk-overlay{
    background-color: transparent !important;
    position: inherit !important;
    z-index: 0 !important;

    }
</style>
@endpush