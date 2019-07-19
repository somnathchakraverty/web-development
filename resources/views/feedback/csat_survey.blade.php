@extends('layout.master')

@section('page-content')

    <section class="cart-section padding-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-lg-offset-0 col-md-offset-0 col-sm-offset-0 col-xs-offset-0">
                    <div class="mainsurveycont">
                    <div class="survey-area">
                        <div class="survey-left">
                            <img src="/img/survey-img.jpg" alt="Image Survey">
                        </div>
                        <div class="survey-right">
                            <div id="success_message" class="hidden"></div>
                            <div id="error_message" class="hidden"></div>
                            <form class="rating-stars" name="save_csat" id="csat_validation_form" action="{{url('saveCSAT')}}">
                                {{csrf_field()}}
                                <h2>Customer Satisfaction Survey </h2>
                                <p>Rate our Customer care executive ?</p>
                                <ul id='stars'>
                                    <li class='star' title='Poor' data-value='1'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='Fair' data-value='2'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='Good' data-value='3'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='Excellent' data-value='4'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='WOW!!!' data-value='5'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                </ul>
                                <input type="hidden" name="rating_val" id="rating_val">
                                <p>How was the experience ?</p>
                                <select name="csat_reasons" id="csat_reasons">

                                    <option value="required">Select</option>
                                    @foreach($csat_reasons as $csat_reason)
                                        <option value="{{ $csat_reason['id'] }}">{{ $csat_reason['value'] }}</option>
                                    @endforeach
                                </select>
                                <div class="clearify"></div>
                                <p>Additional Remarks</p>
                                <input type="hidden" name="source" id="device_source">
                                <textarea rows="4" placeholder="Remark" name="description"></textarea>
                                <button class="btn btn-danger" type="submit"  onClick="validateCsatForm();">Submit</button>
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
    <script>
        var csat_id    =   "{{ $csat_id }}";
        $(document).ready(function(){           
            $.validator.setDefaults({ 
                ignore: []
            });
            /* 1. Visualizing things on Hover - See next part for action on click */
            $('#stars li').on('mouseover', function(){
                var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

                // Now highlight all the stars that's not after the current hovered star
                $(this).parent().children('li.star').each(function(e){
                    if (e < onStar) {
                        $(this).addClass('hover');
                    }
                    else {
                        $(this).removeClass('hover');
                    }
                });
            }).on('mouseout', function(){
                $(this).parent().children('li.star').each(function(e){
                    $(this).removeClass('hover');
                });
            });


            /* 2. Action to perform on click */
            $('#stars li').on('click', function(){
                var onStar = parseInt($(this).data('value'), 10); // The star currently selected
                var stars = $(this).parent().children('li.star');

                for (i = 0; i < stars.length; i++) {
                  $(stars[i]).removeClass('selected');
                }

                for (i = 0; i < onStar; i++) {
                  $(stars[i]).addClass('selected');
                }

                // JUST RESPONSE (Not needed)
                var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
                $("input[name='rating_val']").val(ratingValue);
            });
        });

        function validateCsatForm() {
            // To check device source
            if (isMobile.any()) 
                $("#device_source").val('mobile');
            else 
                $("#device_source").val('web');            
        
            $('#csat_validation_form').validate({
                rules: {
                    rating_val  :   {
                        required    : true
                    },
                    csat_reasons:   {
                        required    : true				
                    }
                },
                messages: {
                    rating_val  :   {
                        required: "Please give us rating",
                    },
                    csat_reasons:   {
                        required: "Please select the reason",
                    }
                },
                //submit handler
                submitHandler: function(form)
                {
                    var url = $("#csat_validation_form").attr('action')+"/"+csat_id;                   

                    /* Get from elements values */
                    var values = $('#csat_validation_form').serialize();

                    $.ajax({
                        url: url,
                        type: "post",
                        data: values ,
                        beforeSend: function() {
                            $("#ajax-loader").show();
                        },
                        success: function (response) {
                            if(response.status){                                
                                $("#error_message").addClass("hidden");
                                $("#error_message").text("");
                                $("#success_message").removeClass("hidden");
                                $("#success_message").text(response.message);
                                    
                                $('#csat_validation_form').trigger("reset");
                                $("#stars li").removeClass("selected");
                                $("input[name='rating_val']").val('');
                            }else{
                                $("#error_message").addClass("hidden");
                                $("#error_message").text(response.message);
                                $("#success_message").removeClass("hidden");
                                $("#success_message").text("");
                            }
                            $("#ajax-loader").hide();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            var jsonResponseText = $.parseJSON(jqXHR.responseText);
                            $("#success_message").addClass("hidden");
                            $("#success_message").text("");
                            $("#error_message").removeClass("hidden");
                            $("#error_message").text(jsonResponseText.message);
                                
                            $("#ajax-loader").hide();
                        }
                    });
                    console.log(url);
                    return false;
                }
            });
        }
    </script>        
@endpush

