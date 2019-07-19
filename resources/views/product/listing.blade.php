@extends('layout.master')
@push('header-scripts')

<style>
/*#search-result-page .search-detail{ display:none;}*/
</style>
@endpush
@section('page-content')

<!--Filter Menu-->
<!-- 
<script>
$(document).ready(function(){
    $('#show').click(function() {
      $('.menu').toggle("slide");
    });
});
</script> -->
<!--Filter Menu-->

<div class="search-results">
<!-- Tag section area -->
<div class="tag-section" style="display:none;">
	<div class="container">
            <div class="row tags" id="searched_parameter">

            </div>
	</div>
</div>

<!-- search section start here -->
<div class="search-section">
    <div class="container">
        <div class="row filters">
            <div class="col-lg-7 col-sm-12 text-center">
                <div class="input-group">
                    <select class="js-select2" name="search_value" multiple="multiple" id="selectTest2">

                    </select>
                    <span class="input-group-btn">
                        <button class="btn btn-theme mob submit_search_query query" type="submit"><i class="fa fa-search"></i> <span>Search</span> </button>
                    </span>
                </div>
                @if(isset($propular_test_detail) && isset($propular_package_detail))
                    <div id="popular_package" class="listingpackage" style="display: none">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 pp_package">
                                <div class="testtitle">Popular Test</div>
                                <div class="tests_listing">
                                    <ul class="tests pkgdropdown">
                                        @foreach($propular_test_detail as $test)
                                            <li class="test t_option_{{ $test['product_id'] }}" data-id="{{ $test['product_id'] }}"  data-value="{{ $test['product_name'] }}"> {{ $test['product_name'] }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 pp_package">
                                <div class="testtitle">Popular Packages</div>
                                <div class="tests_listing">
                                    <ul class="tests pkgdropdown">
                                        @foreach($propular_package_detail as $test)
                                            <li class="test t_option_{{ $test['product_id'] }}" data-id="{{ $test['product_id'] }}"  data-value="{{ $test['product_name'] }}"> {{ $test['product_name'] }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Filter Menu -->
            <div class="col-lg-5 col-sm-12 text-center filter-tab">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="drop-filter risk-tab show_hide_filter"><img src="/img/common-risk-icon.png"> By Common Risk Area <b class="caret"></b></a>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="drop-filter1 risk-tab show_hide_riskarea"><img src="/img/habit-risk.png">
                            By Habits <b class="caret"></b>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Filter Menu Ends -->


            <div class="col-lg-12 col-sm-12 text-center slidingDiv" style="display: none;">

		<!-- filter box start -->
                <!-- checkboxes main div start -->

                    @php($j = 0)
                    @php($i = 0)
                    @foreach($testByRisks as $testByRisk)
                        @php( $accordian_array = \Config('constants.collapse_array'))
                        @if($j == 0)
                            <div class="relative-div">
                        @endif
                                <div class="filter-box">
                                    <div class="heading-h4 col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <h4><img src="{{$testByRisk['image'] }}">{{ $testByRisk['Name']}}</h4>
                                    </div>
                                    <div class="check-boxes">
                                        @foreach($testByRisk['tests'] as $tests)
                                            <div class="submenu_filterparameter">
                                                <div class="checkbox">
                                                    <input name="applyfilter" data-action="Added Filter on Risk Area" id="risk-{{$tests['test_id']}}-{{$i}}" data-id="{{$tests['test_id']}}" data-value="{{ $tests['test_name'] }}" class="filter-checkbox risk styled" type="checkbox">
                                                    <label class="check-size" for="risk-{{$tests['test_id']}}-{{$i}}">{{ $tests['test_name'] }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                        @php($j++)
                        @if($j == 4)
                            </div>
                            @php($j = 0)
                        @endif
                        @php($i++)
                    @endforeach
		<!-- Action Buttons --><div class="clearfix"></div>
            		<div class="col-md-12 margin-top">
                        <a class="apply submit_search_query risk" href="javascript:void(0);" >Apply </a>
                        <a class="view-details reset_filter" href="javascript:void(0);">Reset </a>
                    </div>
		      <div class="close-filter"><i class="fa fa-times" aria-hidden="true"></i></div>
              <div class="clearfix"></div>
                </div>

            <!-- Habbit-Risk-Area-Tab -->




            <div class="col-lg-12 col-sm-12 text-center slidingDivRiskAreas" style="display: none;">

		<!-- filter box start -->
                @php($j = 0)
                @php($i = 0)
                @foreach($testByHabits as $testByHabit)
                    @php( $accordian_array = \Config('constants.collapse_array'))
                    @if($j == 0)
                        <div class="relative-div">
                    @endif
                            <div class="filter-box">
                                <div class="heading-h4 col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <h4><img src="{{ $testByHabit['image']}}">{{ $testByHabit['Name']}}</h4>
                                </div>
                                <div class="check-boxes">
                                    @foreach($testByHabit['tests'] as $tests)
                                        <div class="checkbox">
                                            <input name="applyfilter" data-action="Added Filter on Habit" id="habit-{{$tests['test_id']}}-{{$i}}" data-id="{{$tests['test_id']}}" data-value="{{ $tests['test_name'] }}" class="filter-checkbox habit styled" type="checkbox">
                                            <label class="check-size" for="habit-{{$tests['test_id']}}-{{$i}}">{{ $tests['test_name'] }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                    @php($j++)
                    @if($j == 4)
                        </div>
                        @php($j = 0)
                    @endif
                    @php($i++)
                @endforeach

		<!-- Action Buttons -->

		<div class="col-md-12 margin-top">
                <a class="apply submit_search_query habit" href="javascript:void(0);">Apply </a>
                <a class="view-details reset_filter" href="javascript:void(0);">Reset </a></div>
                <div class="close-filter"><i class="fa fa-times" aria-hidden="true"></i></div>

            </div>
        </div>
    </div>
</div>

<!-- why choose us -->
<div class="choose-us">
    <div class="container testsearch_resultpage" id='search-result-page'>

        @if(isset($search_lists['pathology']['healthian_package']))
            @php($healthian_packages = $search_lists['pathology']['healthian_package'])
        @else
            @php($healthian_packages = [])
        @endif
        <div class="row">
            <div class="col-sm-12">
                @if(count($healthian_packages) > 0)
                    <h2> Your Search Results </h2>
                @else
                    <h2> Result Not Found </h2>
                @endif
            </div>
        </div>

        @foreach($healthian_packages as $skey => $search_list)
            <div class="row search-detail" style="display:none;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 result-box">
                    @php($percentage    =   calPer($search_list['healthian_price'], $search_list['actual_price']))
                    @if($percentage > 0)
                        <div class="offers">
                            <h3>{{ $percentage }}% Off</h3>
                        </div>
                    @endif
                    <div class="offer-content">
                        <div class="offer-heading">
                            <h4>
                                @if(isset($search_list['ptype']) &&  ($search_list['display_name'] != 'Your Customized Package') && isset($search_list['link_rewrite']))
                                    <a class="orderheading"  href="<?php echo route("product.{$search_list['ptype']}-detail", [   
                                                                    'city'          =>  $city_name,
                                                                    'link_rewrite'  =>  $search_list['link_rewrite'] 
                                                                ]
                                            ) ?>">{{ $search_list['display_name'] }}</a>
                                @else
                                    {{ $search_list['display_name'] }}
                                @endif
                            </h4>
                        </div>

                        <!--Left Section -->
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 content_leftsearch">
                            <div class="offers-content">
                                @if(isset($search_list['include_tests']) && count($search_list['include_tests']) > 0)
                                    <h5>Includes</h5>
                                    <p class="parameternames">
                                    @php($i = 0)
                                    @foreach($search_list['include_tests'] as $test)
                                        @if(isset($test['tcategory_name']))
                                            @if($i != 0)
                                                , <b>{{ $test['tcategory_name'] }}</b>
                                            @else
                                                <b>{{ $test['tcategory_name'] }}</b>
                                            @endif
                                        @endif
                                        @php($i++)
                                    @endforeach
                                    
                                    @if(isset($search_list['also_include_tests']) && count($search_list['also_include_tests']) > 0)
                                        @foreach($search_list['also_include_tests'] as $test)
                                            @if(isset($test['tcategory_name']))
                                                , {{ $test['tcategory_name'] }}
                                            @endif
                                        @endforeach
                                    @endif
                                    </p>
                                @endif
                                <div class="informations">
                                    <span><p>
                                        <img src="/img/fasting-icon.png"/> Fasting : 
                                        <b> 
                                            @if ($search_list['fasting'] == 1)
                                                {{ 'Required' }}
                                            @else {{ 'Not required' }}
                                            @endif 
                                        </b>
                                    </p></span>
                                    <span><p>
                                    <img src="/img/report-time.png"/> Report available in : <b>{{ $search_list['time_of_report'] }} Hours </b></p></span>
                                </div>

                                <div class="pricebarorderbook">
                                    <div class="col">
                                        <h4 class="totaltest">Total Tests</h4>
                                        {{ $search_list['test_count'] }}
                                    </div>

                                    <div class="col">
                                        <h4>Healthians Price</h4>
                                        <div class="slashedprice">
                                            <del><span class="rupeesign">₹</span>{{ $search_list['actual_price'] }}</del>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h4>Limited Time Offer</h4>
                                        <div class="healthiansprice">
                                            <span class="rupeesign">₹</span>{{ $search_list['healthian_price'] }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--Left Section Ends-->

                    <!--Right Section -->
                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 right-side">
                        <div class="certified"> HIGH QUALITY CERTIFIED LABS ONLY</div>
                        <div class="searchresultrgt">
                            @if($search_list['healthian_price'] > 0)
                                <a class="btn btn-danger sr_booknow booknow-package" onclick="pushGaEvent('Search', 'Clicked on Select Product')" data-testid="{{ $search_list['testId'] }}" data-sid="{{$skey}}"  href="javascript:void(0);">Book Now <img src="/img/left-icon-sml.png" class="images"></a>
                            @endif
                            <a class="btn btn-default sr_callback" data-toggle="modal" data-target="#getACallBackModal" onclick="pushGaEvent('Call To Book Pop up', 'Click on Get A Call Back Now')">Get a Call Back</a>
                            <!-- <a class="btn btn-danger addtocartbtn" href="javascript:void(0);">Add to Cart <img src="/img/cart-img.png" alt="images"></a> -->
                        </div>
                    </div>
                    <!--Right Section Ends -->
                </div>
            </div>
        @endforeach
        @if(count($healthian_packages) > 3)
        <div class="col-lg-12 col-md-12 col-sm-12 text-center col-xs-12">
            <div  id="loadData" style="">
                <a class="view-details" href="javascript:void(0);">View All</a>
            </div>
        </div>
        @endif
    </div>
</div>
</div>
    @include('section.getACallBack', $logged_user)
@endsection

@push('footer-scripts')
    <script type="text/javascript">
        var favorite                =   {};
        var templist                =   {};
        var search_val_id           =   [];
        var suggested_text_id       =   [];
        var preSelectedValue        =   {};
        var tempRemovefilterlist    =   [];
        var selectedProductDetail   =   <?php echo json_encode($healthian_packages); ?>;
        
        var city_detail =   "{{$city}}";
        city_detail     =   city_detail.replace(/ /g,"_");
        
        <?php if(!empty($search_values) && is_array($search_values)) {
            foreach($search_values as $key => $value){ ?>
                var key = "{{$key}}";
                var value = "{{$value}}";
                $("input[data-id='"+key+"']").prop("checked", true);
                favorite[key]           =   value;
                templist[key]           =   value;
                preSelectedValue[key]   =   value;
//                var newOption = $("<option selected='selected' data-id='"+key+"' onclick='pushGaEvent(\"Search\", \"Selected One of Popular Tests\", \""+value+"\")' data-value='"+value+"'></option>").val(key).text(value)
//
//                $("#selectTest2").append(newOption).trigger('change');
                
        <?php } } ?>
        if(!jQuery.isEmptyObject(preSelectedValue)){
            var searched_parameter = '';
            $.each( preSelectedValue, function( key, value ) {
                searched_parameter += '<a class="tag" href="javascript:void(0);" data-value='+key+'>'+value+'</a>';
            });
            $("#searched_parameter").html(searched_parameter);
            $("#searched_parameter").parent().parent().css("display", "block");
            search_val_id.push(key);
        }
        /*
        $(".js-select2").select2({
            closeOnSelect : false,
            placeholder : "Search your package/test",
            allowHtml: true,
            allowClear: true,
            tags: true
        });
        */
        var select2 = $(".js-select2").select2({
            allowClear: false,
            enable: true,
            ajax: {
              url: "{{$packageSuggestionURL}}",
              dataType: 'json',
              delay: 250,
              data: function (params) {
                return {
                  keyword: params.term, // search term
                  page: params.page,
                  resource_type:'web'
                };
              },
              processResults: function (data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;

                var  select2Data =  $.map(data.data, function (obj) 
                {   
                    obj.text = obj.text || obj.product_name;
                    obj.id = obj.id || obj.product_id;
                    return obj;
                });
                return {
                  results: select2Data
                  
                };
              },
              cache: true
            },
            placeholder: 'Find your Package/Test',
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: formatRepo,
            templateSelection: formatRepoSelection
        });
   
        function formatRepo (repo) {
            if (repo.loading) {
              return 'Searching..';
            }

            if( typeof repo.product_id != 'undefined' && typeof repo.actual_price != 'undefined' )
            {
                var markup = "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__meta'>" ;
                markup  +=   "<span data-id="+repo.product_id+" value="+repo.product_id+" onclick='pushGaEvent(\"Search\", \"Selected One of Popular Tests\", \""+repo.product_name+"\")' data-value='"+repo.product_name+"'><span style='float:left;'> "+repo.product_name+ "</span><span style='float:right;'><span class='rupeesign' style='padding-right:2px;'>₹</span><strike style='margin-right: 15px;'>"+repo.actual_price+ "</strike><span class='rupeesign' style='padding-right:2px;'>₹</span>"+repo.healthian_price+ "</span></span>";


                markup +=   "</div></div>";
                return markup;
            }

            return '';
        }

        function formatRepoSelection (repo) {
          return repo.full_name || repo.text;
        }

        function getSearchResultDetail( type ){
            favorite = {};
            var suggested_test  =   [];
            var search_val      =   [];
            var searched_parameter = '';
            var type = (typeof type == 'undefined') ? '' : type;
            var content_ids   = [];
            var content_name  = [];

            if( type == 'risk' || type == 'habit' )
            {
                var count = $(".filter-checkbox."+type+":checked").length;

                if( count == 0 )
                {
                    showStrError('error',"Select at least one "+type.toUpperCase()+" Filter");
                    if(type == 'risk')
                        $(".show_hide_filter").trigger("click");
                    else(type == 'habit')
                        $(".show_hide_riskarea").trigger("click");
                    return false;
                }
            }

            $.each($("input[name='applyfilter']:checked"), function(){

                content_ids.push($(this).data('id'));
                content_name.push($(this).data('value'));

                suggested_test.push({
                    'id'    :   $(this).data('id'),
                    'text'  :   $(this).data('value')
                });
                if($.inArray( $(this).data('id'), search_val_id ) == -1)
                    suggested_text_id.push($(this).data('id'));
                templist[$(this).data('id')]    =   $(this).data('value');
                favorite[$(this).data('id')]    =   $(this).data('value');
                pushGaEvent('Search', $(this).data('action'), $(this).data('value'));
            });
            
            $.each( $('.js-select2').select2('data'), function( key, value ) {
                favorite[value.id]  =   value.text;
                templist[value.id]  =   value.text;
                search_val.push({
                    'id'    :   value.id,
                    'text'  :   value.text
                });
                if($.inArray( value.id, suggested_text_id ) == -1)
                    search_val_id.push(value.id);
            });
            /*
            $("select[name='search_value']").find("option:selected").each(function(){
                content_ids.push($(this).data('id'));
                content_name.push($(this).data('value'));

                favorite[$(this).val()] = $(this).data('value');
                search_val.push({
                    'id'    :   $(this).val(),
                    'text'  :   $(this).data('value')
                });
            });
            */
           
            $.each(tempRemovefilterlist, function(key, value) {
                delete templist[value];
            });
            
            
            $.each( templist, function( key, value ) {
                search_val.push({
                    'id'    :   key,
                    'text'  :   value
                });
                searched_parameter += '<a class="tag" href="javascript:void(0);" data-value='+key+'>'+value+'</a>';
            });
            if(searched_parameter == '')
                $("#searched_parameter").parent().parent().css("display", "none");
            else
                $("#searched_parameter").parent().parent().css("display", "block");
            $("#searched_parameter").html(searched_parameter);

            var parameter = [];
            var values = [];
            $("#searched_parameter").find("a").each(function() {
                parameter.push({
                    'id': $(this).data('value'),
                    'text' : $(this).text()
                });
            });

            if (typeof(fbq) !== 'undefined') {
                var fbData       = [];
                var searchLength = content_ids.length;
                var content_type = 'product';

                fbData['content_ids']   = content_ids;
                fbData['content_type']  = content_type;
                fbData['content_name']  = content_name;
                fbData['content_category'] = 'Orderbook > Search';
                fbq('track', 'Search', fbData);
            }
            tempRemovefilterlist = [];
            
            var search_val_result = [];
            $.each(search_val, function (i, e) {
                var matchingItems = $.grep(search_val_result, function (item) {
                   return item.id === e.id && item.text === e.text;
                });
                if (matchingItems.length === 0 && ($.inArray( e.id, suggested_text_id ) == -1)){
                    search_val_result.push(e);
                }
            });
            
            var suggested_test_result = [];
            $.each(suggested_test, function (i, e) {
                var matchingItems = $.grep(suggested_test_result, function (item) {
                   return item.id === e.id && item.text === e.text;
                });
                if (matchingItems.length === 0 && ($.inArray( e.id, search_val_id ) == -1)){
                    suggested_test_result.push(e);
                }
            });
            values = { 'search_val' : search_val_result, 'suggested_test' : suggested_test_result, '_token' : '{{csrf_token()}}' };
            $.ajax({
                url: '/'+city_detail+'/ajaxorderbook',
                type: "post",
                data: values ,
                beforeSend: function() {
                    $("#ajax-loader").show();
                },
                success: function (response) {
                    if(response.status){
                        if(response.search_lists.length > 0)
                            var html = '<div class="row"><div class="col-sm-12"><h2> Your Search Results </h2></div></div>';
                        else
                            var html = '<div class="row"><div class="col-sm-12"><h2> No Result Found </h2></div></div>';
                        selectedProductDetail = response.search_lists;
                        $.each( response.search_lists, function( skey, value ) {
                            html += '<div class="row search-detail" style="display:none;"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 result-box">';
                            var percentage  =   ((value.actual_price - value.healthian_price) / value.actual_price * 100).toFixed(0);
                            if(percentage > 0 )
                                html += '<div class="offers"><h3>'+ ((value.actual_price - value.healthian_price) / value.actual_price * 100).toFixed(0)+'% Off</h3></div>';

                            html += '<div class="offer-content"><div class="offer-heading"><h4>';
                            if(value.ptype == null || value.ptype == '' || (value.display_name == 'Your Customized Package')  || value.link_rewrite == null || value.link_rewrite == '')
                                html += value.display_name;
                            else
                                html += '<a href="/'+value.ptype+'/'+city_detail+'/'+value.link_rewrite+'">'+value.display_name+'</a>';
                            html += '</h4></div>';
                            html += '<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 content_leftsearch"><div class="offers-content">';
                            if(value.include_tests.length > 0){
                                html += '<h5>Includes</h5><p class="parameternames">';
                                var i = 0;
                                $.each( value.include_tests, function( t_key, t_value ) {
                                    if(t_value.hasOwnProperty('tcategory_name')){
                                        if(i != 0)
                                            html += ', <b>'+ t_value.tcategory_name +'</b>';
                                        else
                                            html += '<b>' + t_value.tcategory_name +'</b>';
                                        i = i + 1;
                                    }
                                });
                                if(value.also_include_tests.length > 0){
                                    $.each( value.also_include_tests, function( t_key, t_value ) {
                                        if(t_value.hasOwnProperty('tcategory_name'))
                                            html += ', '+ t_value.tcategory_name;                                        
                                    });
                                }
                                html += '</p>';
                            }
                            html += '<div class="informations"> <span><p><img src="/img/fasting-icon.png"/> Fasting :<b> ';
                            if (value.fasting == 1)
                                html += 'Required';
                            else
                                html += 'Not required';

                            html += '</b></p></span><span><p><img src="/img/report-time.png"/> Report available in : <b>'+ value.time_of_report +'</b> Hours</p></span></div>';

                            html += '<div class="pricebarorderbook"><div class="col"><h4 class="totaltest">Total Tests</h4>' + value.test_count +'</div><div class="col"><h4>Healthians Price</h4><div class="slashedprice"><del><span class="rupeesign">₹</span>'+ value.actual_price +'/-</del></div></div>';


                            html += '<div class="col"><h4>Limited Time Offer</h4><div class="healthiansprice"><span class="rupeesign">₹</span>'+value.healthian_price+'</div></div></div></div>';

                            html += '</div><div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 right-side"><div class="certified"> HIGH QUALITY CERTIFIED LABS ONLY</div>';


                            html += '<div class="searchresultrgt">';
                            if(value.healthian_price > 0){
                                html += '<a class="btn btn-danger sr_booknow booknow-package" data-testid="'+value.testId+'" href="javascript:void(0);">Book Now <img src="/img/left-icon-sml.png" class=""></a>';
                            }
                            html += '<a class="btn btn-default sr_callback" data-toggle="modal" data-target="#getACallBackModal">Get a Call Back</a></div>';

                            

                            html += '</div></div></div></div></div>';
                        });
                        var size_li = response.search_lists.length;
                        if(size_li > 3)
                            html += '<div class="col-lg-12 col-md-12 col-sm-12 text-center col-xs-12"><div id="loadData" style=""><a class="view-details" href="javascript:void(0);">View All</a></div></div>';

                        $("#search-result-page").html(html);
                        var x=3;
                        $('#search-result-page .search-detail:lt('+x+')').show();
                        $('#loadData').click(function () {
                            pushGaEvent('Search', 'Clicked View More Search Results.', null);
                            x= (x+5 <= size_li) ? x+5 : size_li;
                            $('#search-result-page .search-detail:lt('+x+')').show();

                            if(x == size_li){
                                $('#loadData').hide();
                            }
                        });
                        $("#selectTest2").val('').trigger('change');
                    }
                    $("#ajax-loader").hide();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    var jsonResponseText = $.parseJSON(jqXHR.responseText);
                    $("#ajax-loader").hide();
                    return false;
                }
            });
        }

        $(document).ready(function () {
            $("select[name='search_value']").find("option:selected").each(function(){
                favorite[$(this).val()] = $(this).data('value');
            });
            $('body').on('click', '.booknow-package', function() {
                var testId = $(this).data('testid');
                var selectProduct = selectedProductDetail.filter(function (sproduct) { return sproduct.testId == testId });
                if(selectProduct != undefined && selectProduct[0].hasOwnProperty('testId')){
                    getBookingDetail(selectProduct[0]);
                }
            });

            $('body').on('click', '#searched_parameter a', function() {
                var parameter = $(this).data('value');
                $("input[data-id='"+parameter+"']").prop("checked", false);
                var wanted_option = $('#selectTest2 option[value="'+ parameter +'"]');
                wanted_option.prop('selected', false);
                $('#selectTest2').trigger('change.select2');
                delete templist[parameter];
                search_val_id.splice($.inArray(parameter, search_val_id),1);
                suggested_text_id.splice($.inArray(parameter, suggested_text_id),1);
                getSearchResultDetail();
            });

            $("input[name='applyfilter']").change(function() {
                if($(this).is(':checked')){
                    $("input[data-id='"+$(this).data('id')+"']").prop('checked', true);
//                    var wanted_option = $('#selectTest2 option[value="'+ $(this).data('id') +'"]');
//                    wanted_option.prop('selected', true);
                    $('#selectTest2').trigger('change.select2');
                    tempRemovefilterlist.splice($.inArray($(this).data('id'), tempRemovefilterlist),1);
                    
//                    templist[$(this).data('id')]    =   $(this).data('value');
                }else{
                    $("input[data-id='"+$(this).data('id')+"']").prop('checked', false);
//                    var wanted_option = $('#selectTest2 option[value="'+ $(this).data('id') +'"]');
//                    wanted_option.prop('selected', false);
                    $('#selectTest2').trigger('change.select2');
                    tempRemovefilterlist.push($(this).data('id'));
                    suggested_text_id.splice($.inArray($(this).data('id'), suggested_text_id),1);
//                    delete templist[$(this).data('id')];
                }
            });

            $('.reset_filter').click(function () {
                $.each($(this).parent().parent().find("input[name='applyfilter']"), function(){
                    $("input[data-id='"+$(this).data('id')+"']").prop('checked', false);
                    delete templist[$(this).data('id')];
//                    var wanted_option = $('#selectTest2 option[value="'+ $(this).data('id') +'"]');
//                    wanted_option.prop('selected', false);
                    $('#selectTest2').trigger('change.select2');
                });
                getSearchResultDetail();
//                $(".drop-filter-show").hide();
//                $(".drop-filter-show1").hide();
//                $(".slidingDiv").hide();
            });

            size_li = $("#search-result-page .search-detail").length;
            x=3;
            $('#search-result-page .search-detail:lt('+x+')').show();
            $('#loadData').click(function () {
                pushGaEvent('Search', 'Clicked View More Search Results.');
                x= (x+5 <= size_li) ? x+5 : size_li;
                $('#search-result-page .search-detail:lt('+x+')').show();

                if(x == size_li){
                    $('#loadData').hide();
                }
            });

            $('.submit_search_query').click(function(){
                var btn = $(this);

                if( btn.hasClass('risk') )
                {
                    type = 'risk';
                }
                else if(btn.hasClass('habit'))
                {
                    type = 'habit';
                }
                else
                {
                    type = 'query';
                }

                getSearchResultDetail(type);
            });

            $(".close-filter").click(function(){
                resetFormCheckbox();
            });

            function resetFormCheckbox()
            {
                console.log(templist);
                $(".drop-filter-show").hide();
                $(".drop-filter-show1").hide();
                $.each($("input[name='applyfilter']"), function(){

                    var profile_id = $(this).data('id');
                    if(templist.hasOwnProperty(profile_id)){
                        $(this).prop('checked', true);
//                        var wanted_option = $('#selectTest2 option[value="'+ profile_id +'"]');
//                        wanted_option.prop('selected', true);
//                        $('#selectTest2').trigger('change.select2');
                    }else{
                        $(this).prop('checked', false);
//                        var wanted_option = $('#selectTest2 option[value="'+ profile_id +'"]');
//                        wanted_option.prop('selected', false);
//                        $('#selectTest2').trigger('change.select2');
                    }

                });
            }

            $(".slidingDiv").hide();
            $(".slidingDivRiskAreas").hide();

            // $(".show_hide_filter").addClass("arrow")
            // $(".show_hide_filter").removeClass("arrow")

            $(".close-filter").click(function(){
                $(".slidingDiv").hide();
                $(".slidingDivRiskAreas").hide();
            });
            $(".submit_search_query").click(function(){
                $(".slidingDiv").hide();
                $(".slidingDivRiskAreas").hide();
            });

            $('.show_hide_filter').click(function(){
                $(".slidingDivRiskAreas").slideUp("slow");
                $(".slidingDiv").slideToggle();
                $(".slidingDivRiskAreas").addClass("arrow")
                $(".slidingDivRiskAreas").removeClass("arrow");
                resetFormCheckbox();
            });

            $('.show_hide_riskarea').click(function(){
                $(".slidingDiv").slideUp("slow");
                $(".slidingDivRiskAreas").slideToggle();
                resetFormCheckbox();
            });

            $(".tests .test").click(function(){
                var id = $(this).attr('data-id');
                var text = $(this).attr('data-value');

                if( $(this).hasClass('active') )
                {
                    var wanted_option = $('#selectTest2 option[value="'+ $(this).data('id') +'"]');
                    wanted_option.prop('selected', false);

                    $('#selectTest2').trigger('change.select2');
                }
                else
                {
                    var option = new Option(text, id, true, true);
                    select2.append(option).trigger('change');
                }

                $(this).toggleClass('active');
            });

            select2.on('select2:unselecting', function (e) {
                var removed_option = e.params.args.data.id;
                var test_class = '.t_option_'+removed_option;

                $(test_class).removeClass('active');
            });

            select2.on('select2:select', function (e) {
                console.log(e);
                var removed_option = e.params.data.id;
                var test_class = '.t_option_'+removed_option;

                $(test_class).addClass('active');
            });

            $(document).on('focus','.select2-search__field',function(){
                $("#popular_package").clearQueue();
                $("#popular_package").slideDown();
            });

            $(document).on('click','body',function(e){
                var has_focus = $(".select2-search__field").is(":focus");
                if(!has_focus && !$(e.target).closest('#popular_package').length && !$(e.target).closest('.select2-search__field').length) {
                    $("#popular_package").clearQueue().stop( true, true );
                    $("#popular_package").slideUp();
                }
            });
        });
    </script>

    <!--Demo Filter Menu-->
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js" type="text/javascript"></script> -->
    <script type="text/javascript">
        //By Risk Areas//

    //By Risk Areas//

    //By Habits//
    /*$(document).ready(function(){
        $('.show_hide_filter').click(function(){
            $(".slidingDivRiskAreas").hide();
            $(".slidingDiv").show();
        });
        $('.show_hide_riskarea').click(function(){
            $(".slidingDivRiskAreas").show();
            $(".slidingDiv").hide();
        });

    });*/
    //By Habits//


    </script>
<!--Demo Filter Menu-->

@endpush