@extends('layout.master')

@push('header-scripts')

@endpush

@section('page-content')

<!--  start diet planner -->
<div class="diet-recommended-section" style="background-image: url(../../img/diet/{{$food_type_image}});">
	<div class="container">
		
			<!-- recommended-text -->
			<div class="diet-planning-section Recommended">
				<h1>Recommended Meal Plan </h1>
				<div class="border-gray-line">
					<img src="../img/diet/Rectangle-3.png">
				</div>
				<h3>Diet planner creates personalized meal plans based on your food preferences, calorie, disease history. Reach your diet and nutritional goals with our calorie calculator & weekly meal plans.
				</h3>
			</div>
			<!-- end recommended-text -->
		
		<!-- food prefrence-section-start -->
		<div class="food-preference">
			

			<div class="Vegetarian-text">
				<p>Food Preference</p>
				<h3>{{$food_type_val}}</h3>
			</div>
			<div class="kcl-text">
				<p>Calorie Consumption</p>
				<h3><span class="circle"></span>{{$calorie_plans}} Kcal / day</h3>
			</div>
			@if($disease_str)
			<div class="harmonal-text">
				<p>Medical Concerns</p>
				<h3>{{$disease_str}}</h3>
			</div>
			@endif
			 <div class="edit-text">
				<p> <a href="{{route('mydietplan')}}?edit=true"><img src="../img/diet/edit-img.png"> Edit Preferences</a>
				</p> 
			</div>
		</div>
		<!-- food prefrence-section-end -->
		<!-- tab-section-start -->
		<div class="today-tab-section">
			<ul class="nav nav-pills">
				@if(!empty($diet_today))
				<li class="active">
					<a data-toggle="pill" href="#today-date">
						{{$diet_today['display_name']}}<br>
						<h5>({{date_format(date_create($diet_today['date']),"d M Y")}})</h5>
					</a>
				</li>
				@endif
				@if(!empty($diet_tomorrow))
				<li>
					<a data-toggle="pill" href="#tomarrow-date">
						{{$diet_tomorrow['display_name']}}<br>
						<h5>({{date_format(date_create($diet_tomorrow['date']),"d M Y")}})</h5>
					</a>
				</li>
				@endif
			</ul>
			<div class="tab-content">
				@if(!empty($diet_today))
				<div id="today-date" class="tab-pane fade in active">

					<p class="instructiondiv">If you don’t wish to eat anything  from the list, please select <b>alternative diet </b>option</p>

					@foreach($diet_today['schedules'] as $key=>$value)
					@if($value['active'] && $active == 0)
						@php ($id_active = "active")
						@php ($active = 1)
					@else
						@php ($id_active = "")
					@endif
					
					<div id="{{$id_active}}" style="opacity:{{(!$value['active']) ? 0.5 : 1 }};" class="alternative-diet-section" >
						
							
							
							
							<div class="lunch-time-section">

								<div class="lunch-time-text">


							<div class="img-morning">
								<img src="{{$value['image_path']}}">
							</div>

							<div class="titlediet">
									<h3>{{$value['slot_name']}}</h3>							
									<h5><img src="../img/diet/upto-time-img.png"> {{ucfirst($value['remarks'])}}</h5>
								</div>

								@if($value['active'])
									<div style="cursor: pointer" onclick="getAltDiet('{{$value['id']}}', '{{$calorie_plans_id}}', '{{$food_type}}', '{{$value['combo']['combo_id']}}','today')"  class="alternative-diet">
										 <h4> Alternate diet <img src="../img/diet/alternative-img.png"></h4>
										
									</div>
								@endif


									<div id="slot-today-{{$value['id']}}">
									@foreach(explode(',', $value['combo']['optionT']) as $k => $v )
									<h4><img src="../img/diet/check-box.png"> {{$v}}
										@if(isset($value['combo']['food_description']) && $value['combo']['food_description'] && $value['active'])
										<i style="cursor: pointer;" class="fa fa-info-circle" title="{{$value['combo']['food_description']}}"></i>
										@endif
									</h4>
									@endforeach			
									</div>

								</div>
								
							</div>
					</div>

					@endforeach
		@if(!$like_dislike_exist)
	
		<!-- feedback-section -->
		<div class="your-feedback-section">
			<p>Did you find this diet plan suitable for you?</p>

			<button type="button" class="btn btn-info btn-lg btn-love-it" data-toggle="modal" data-target="#myModal"><img src="../img/diet/love-it-img.png"> Loved it?</button>
			<!-- Modal -->
			<div id="myModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="love-it-thumbs">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<img src="../img/diet/love-its-img.png" class="imgmodl">
								<h1>Loved it</h1>
								<div class="border-gray-line">
									<img src="/img/underline.png">
								</div>
								<p>Thankyou for your feedback for this diet. Your feedback is valueable for us. <br>A Good diet leads to a better lifestyle</p>
							
							</div>
							<button id="likeDietPlan" type="button" class="btn btn-default btn-submit-section">Submit</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Trigger the modal with a button -->
			<button id="btn-feedback-open-modal" type="button" class="btn btn-info btn-lg btn-feedback" data-toggle="modal" data-target="#myModals"><img src="../img/diet/feedback-img.png"> Feedback</button>
			<!-- Modal -->
			<div id="myModals" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="love-it-thumbs">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<img id="dislike-icon" src="../img/diet/dislike-img.png" class="imgmodl">
								<div class="col-md-12">
									<div style="display: none" class="alert alert-success">
									  Thank you for providing your valuable feedback. 
									</div>
								</div>
								<h1>Provide Feedback?</h1>
								<p style="margin:0px; padding:0px;">Please suggest what was the reason</p>
								<div class="border-gray-line">
									<img src="/img/underline.png">
								</div>
							</div>
							
							@foreach($reasonData as $rk => $rval)
								<button data-checked="0" data-id="{{$rval['reason_id']}}" onclick="selectReasion(this)" type="button" class="btn btn-default btn-btn-feedback">{{$rval['description']}}</button>
							@endforeach
							<br>
							<button id="dislikeDietPlan" type="button" class="btn btn-default btn-submit-section">Submit</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- end-feedback-section -->
	
	@endif
				</div>
				@endif
				@if(!empty($diet_tomorrow))
				<div id="tomarrow-date" class="tab-pane fade">
					
					@if($diet_tomorrow['after_seven'])
						<p class="instructiondiv">If you don’t wish to eat anything  from the list, please select <b>alternative diet </b>option</p>
						@foreach($diet_tomorrow['schedules'] as $key=>$value)
						<div style="opacity:{{(!$value['active']) ? 0.5 : 1 }};" class="alternative-diet-section">
						
							
							
							
							<div class="lunch-time-section">

								<div class="lunch-time-text">


							<div class="img-morning">
								<img src="{{$value['image_path']}}">
							</div>

							<div class="titlediet">
									<h3>{{$value['slot_name']}}</h3>							
									<h5><img src="../img/diet/upto-time-img.png"> {{ucfirst($value['remarks'])}}</h5>
								</div>

								@if($value['active'])
									<div style="cursor: pointer" onclick="getAltDiet('{{$value['id']}}', '{{$calorie_plans_id}}', '{{$food_type}}', '{{$value['combo']['combo_id']}}', 'tomorrow')"  class="alternative-diet">
										 <h4> Alternate diet <img src="../img/diet/alternative-img.png"></h4>
										
									</div>
								@endif


									<div id="slot-tomorrow-{{$value['id']}}">
									@foreach(explode(',', $value['combo']['optionT']) as $k => $v )
									<h4><img src="../img/diet/check-box.png"> {{$v}}
										@if(isset($value['combo']['food_description']) && $value['combo']['food_description'] && $value['active'])
										<i style="cursor: pointer;" class="fa fa-info-circle" title="{{$value['combo']['food_description']}}"></i>
										@endif
									</h4>
									@endforeach			
									</div>

								</div>
								
							</div>
					</div>


						@endforeach
					@else

					<div class="preparingchart">
									We are preparing your personalized meal, please revisit us after 7 pm.
								</div>
						<!-- <div class="alternative-diet-section">
							<div class="lunch-time-section">
								
							</div>
						</div> -->
					@endif

				</div>
				@endif
			</div>
		</div>
		<!-- tab-section-end-->
	</div>
	<div class="clear"></div>
</div>
<!--  end diet planner -->

@endsection
@push('footer-scripts')
<script type="text/javascript">
	var dietDislikesData =[];
	 $(document).ready(function() 
	 {
	 	$('html, body').animate({
	        scrollTop: $("#active").offset().top
	    }, 2000);

	 	$("#likeDietPlan").click(function()
         {
         	var doctor_diet_detail = "{{json_encode($diet_today['schedules'])}}";
         	//console.log(doctor_diet_detail);
         	var actionUrl = "{{route('like-diet-plan')}}";
            var request_data = {
                doctor_diet_detail:doctor_diet_detail,
                '_token'    : '{{csrf_token()}}'
            };

            
            ajaxCall(actionUrl, "POST", request_data, function(result){
                if(result.status === true)
                {
                    showStrError("success", "Thankyou for your feedback for this diet. Your feedback is valueable for us");
                    
                }
                else
                {
                    showStrError("error", result.message);
                    
                }
                $(".your-feedback-section").hide();
                $('#myModal').modal('hide');
                $("#ajax-loader").hide();
                //$("#btn-feedback-open-modal").hide();
            });
            
         })

	 	$("#dislikeDietPlan").click(function()
        {
        	if(dietDislikesData.length <= 0)
        	{
        		showStrError('error', 'Please select reason.');
        		return;
        	}
         	var doctor_diet_detail = "{{json_encode($diet_today['schedules'])}}";
         	
         	var actionUrl = "{{route('dislike-diet-plan')}}";
            var request_data = {
                doctor_diet_detail:doctor_diet_detail,
                dislike_reason_id:dietDislikesData,
                '_token'    : '{{csrf_token()}}'
            };

            
            ajaxCall(actionUrl, "POST", request_data, function(result){

                if(result.status === true)
                {
                	showStrError("success", $(".alert-success").text());
                    $(".alert-success").show();
                    
                }
                else
                {
                	$(".alert-success").hide();
                    showStrError("error", result.message);
                }
                $(".your-feedback-section").hide();
                 $('#myModals').modal('hide');
                //$("#btn-feedback-open-modal").hide();
                $("#ajax-loader").hide();
            });
            
         })
	 })

	function selectReasion(ele)
    {

        var checked = $(ele).data('checked');
        if(checked == "0")
        {
        	$(ele).addClass('active');
            $(ele).data('checked', "1");
            dietDislikesData.push($(ele).data('id'));
        }
        else
        {
        	$(ele).removeClass('active');
            $(ele).data('checked', "0");
            dietDislikesData = dietDislikesData.filter(el => el !== $(ele).data('id'));
        }

        //alert(checked);
        //console.log(dietDislikesData);
     }

     function getAltDiet(slot_id, calorie_plans, food_type, combo_id, day)
     {
     	
     	var actionUrl = "{{route('get-alt-diet-plan')}}";
     	var request_data = {
     		'slot_id':slot_id,
     		'calorie_plans':calorie_plans,
     		'food_type':food_type,
     		'combo_id':combo_id,
     		'_token'    : '{{csrf_token()}}'
     	}
     	ajaxCall(actionUrl, "POST", request_data, function(result)
     	{
     		
			if(result.status === true)
            {
            	var optionT  = result.data[0].schedules[0].combo.optionT;
            	optionT = optionT.split(",");
            	var html = "";
            	for(var i =0; i < optionT.length; i++)
            	{
            		html += `<h4><img src="../img/diet/check-box.png"> `+optionT[i]+`</h4>`;
            	}
               	
            	$("#slot-"+day+"-"+slot_id).html(html);
            }
            else
            {
                showStrError("error", result.message);
            }
            $("#ajax-loader").hide();
        });
     }

</script>


@endpush