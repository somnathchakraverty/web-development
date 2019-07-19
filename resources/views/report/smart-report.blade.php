@extends('layout.master')

@section('page-content')

<style>
    .container-graph { display: none;}
    .test_value_positive { color: #8de33e !important; }
    .test_value_negative { color:#f15a41 !important; }
    .positive_dot { width:12px; height:12px; background-color: #8de33e !important; }
    .negative_dot { width:12px; height:12px; background-color:#f15a41 !important; }
</style>


<!-- Smart Report Section -->
<div class="srweb_container">

    <!-- Top Title Description starts -->
    <div class="container">
        <div class="col-sm-12 text-center marbottom">
            <h1>Smart Report</h1>
            <img class="lazy-loaded" data-src="/img/underline.png" alt="" src="/img/underline.png">
            <p>Smart report enables users to avoid health related risks and displays all the information intuitively for a customer to become healthier!</p>
        </div>
    </div>
    <!-- Top Title Description starts -->
    <div class="clear"></div>

    <!-- User Information -->
    <div class="container">
        <div class="smart-search-report">            
            <div class="">
                <div class="col-sm-4 col-md-4 col-xs-12 timer-section">
                    <!-- Animated Score -->
                    <div class="loader">
                        <div class="loader-bg">
                            <div class="text"></div>
                        </div>
                        <div class="spiner-holder-one animate-0-25-a">
                            <div class="spiner-holder-two animate-0-25-b">
                                <div class="loader-spiner" style="border:4px solid #c7c7c7"></div>
                            </div>
                        </div>
                        <div class="spiner-holder-one animate-25-50-a">
                            <div class="spiner-holder-two animate-25-50-b">
                                <div class="loader-spiner" style="border:4px solid #f27d27"></div>
                            </div>
                        </div>
                        <div class="spiner-holder-one animate-50-75-a">
                            <div class="spiner-holder-two animate-50-75-b">
                                <div class="loader-spiner" style="border:4px solid #1c9ca6"></div>
                            </div>
                        </div>
                        <div class="spiner-holder-one animate-75-100-a">
                            <div class="spiner-holder-two animate-75-100-b">
                                <div class="loader-spiner" style="border:4px solid #a1fd52"></div>
                            </div>
                        </div>
                        
                    </div>
                    <h1 class="out-of-100">Out of 100</h1>
                    <!-- Animated Score -->
                </div>

                <!-- report-status-section -->
                <div class="col-sm-8 col-md-8 col-xs-12">
                    <div class="report-status-section">
                        <h2>{{$name}}</h2>
                        <p>{{ ($gender == 'M') ? "Male" : "Female" }}, {{$age}} Years</p>
                        {{-- <button type="button" class="btn btn-warning-section">Share your health score <img src="/image/share_report.png" class="img-btn"></button> --}}
                        <h5>{{$healthMessage}}</h5>
                    </div>
                </div>
                <!-- report-status-section -->
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!-- User Information Ends -->

    <!-- Tabular Report -->
    <div class="container">
        <div class="full-report-section">
            <ul class="nav nav-tabs">
                <li class="active"><a class="" data-toggle="tab" href="#menu1">Critical Report</a></li>
                <li><a data-toggle="tab" href="#menu2">Full Report</a></li>
                @if(!empty($recommanedTest))
                    <li><a data-toggle="tab" href="#menu3">Recommendation</a></li>
                @endif
            </ul>

            <div class="tab-content">
                <!-- Menu 1 - Critical -->
                <div id="menu1" class="tab-pane fade in active">
                    <!-- Critical - Package -->
                    @if(!empty($package))
                        @foreach($package as $pkg)
                            @if(!empty($pkg['profile']))
                                @foreach($pkg['profile'] as $prf)
                                    @if(!empty($prf['parameterDetails']))
                                        @if(check_critical_param($prf['parameterDetails']))
                                            <div class="topinfoparameters">
                                                <h2>{{ $prf['profileName'] }}</h2>
                                                <p>{{ $prf['profileDescription'] }}</p>
                                            </div>
                                        @endif

                                        @foreach($prf['parameterDetails'] as $key1 => $prmt)
                                            @if($prmt['isCriticalParam'] && !empty($prmt['value']))
                                                <!-- Parameter 1 -->
                                                @if($key1%2 == 0) 
                                                    <div class="bilirubin-total-section">
                                                @else 
                                                    <div class="bilirubin-total-section whitecnt">  
                                                @endif
                                                    <h3 class="list-style-type"> 
                                                        <span class="negative_dot"></span>
                                                        {{ $prmt['parameterName'] }}

                                                        @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                                            <span class="btn-results">
                                                                {!! getSmartReportGraphMessage((float)$prmt['value'], (float)$prmt['start_range'], (float)$prmt['end_range'], $prmt['isCriticalParam']) !!}
                                                            </span>
                                                        @endif
                                                    </h3>
                                                    <div class="report-number">
                                                        <div class="report-text">
                                                            <span class="about-report test_value_negative">
    
                                                            @if((float)$prmt['value'] > 0)
                                                                @if(!empty($prmt['end_range']))        
                                                                    @if((float)$prmt['value'] > (float)$prmt['end_range'])
                                                                        <img src="/img/upper-red-btn.png">
                                                                    @endif
                                                                    @if((float)$prmt['value'] < (float)$prmt['start_range'])
                                                                        <img src="/img/down-red-btn.png">
                                                                    @endif

                                                                    @if(((float)$prmt['value'] >= (float)$prmt['start_range']) && ((float)$prmt['value'] <= (float)$prmt['end_range']))
                                                                        <img src="/img/checked_arrow.png">
                                                                    @endif

                                                                @endif
                                                            @endif
                                                                {{ $prmt['value'] }} 
                                                                <span class="u-i-section"> {{ $prmt['unit'] }} </span>
                                                            </span>
                                                            
                                                        </div>

                                                        @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                                            @if(!empty($prmt['end_range']))
                                                                {!! getLineGraph((float)$prmt['value'], (float)$prmt['start_range'], (float)$prmt['end_range']) !!}
                                                            @endif
                                                        @endif
                                                            
                                                    </div>
                                                    <div class="about-indication">
                                                        @if(!empty($prmt['indication']))
                                                            <h5><span>Indication:</span> {{ $prmt['indication'] }}</h5>
                                                        @endif

                                                        @if(!empty($prmt['recommendation']))
                                                            <h5><span>Recommendation:</span> {{ $prmt['recommendation'] }}</h5>
                                                        @endif
                                                    </div>
                                                    
                                                    @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                                        @if(!empty($prmt['end_range']))
                                                            <div class="dropdown dropdown-section">
                                                                <button class="btn btn-primary btn-history-graph dropdown-toggle" type="button" data-toggle="dropdown" onclick="openGraph('crit_pkg_profile','{{ $prmt['parameterId'] }}', '{{$prmt['value']}}', '{{$prmt['parameterName']}}', '{{$prmt['unit']}}');">
                                                                    <i class="fa fa-bar-chart" aria-hidden="true"></i> 
                                                                    &nbsp; Parameter History Graph
                                                                </button>                            
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                                <!-- Parameter 1  -->
                                                @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                                    @if(!empty($prmt['end_range']))
                                                        <!--Graph Area -->
                                                        <div class="container-graph" id="crit_pkg_profile_{{ $prmt['parameterId'] }}">
                                                            <div class="graphshaddow">
                                                                <div id="crit_pkg_profile_graph_{{ $prmt['parameterId'] }}" style="min-width:280px; height:380px; margin:0px auto;"></div>
                                                            </div>
                                                        </div>
                                                        <!--Graph Area Ends -->
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif

                            @if(!empty($pkg['parameter']))
                                @if(check_critical_param($pkg['parameter']))
                                    <div class="topinfoparameters">
                                        <h2> Other Included Parameters </h2>
                                    </div>
                                @endif

                                @foreach($pkg['parameter'] as $key2 => $prt)
                                    @if($prt['isCriticalParam'] && !empty($prt['value']))
                                        <!-- Parameter 1 -->
                                        @if($key2%2 == 0) 
                                            <div class="bilirubin-total-section">
                                        @else 
                                            <div class="bilirubin-total-section whitecnt">  
                                        @endif
                                                <div class="list-style-type">
                                                    <h3><span class="negative_dot"></span>
                                                    {{ $prt['parameterName'] }}</h3>

                                                    @if((float)$prt['value'] > 0 && (strpos($prt['value'], '-') === false))
                                                        <span class="btn-results">
                                                            {!! getSmartReportGraphMessage((float)$prt['value'], (float)$prt['start_range'], (float)$prt['end_range'], $prt['isCriticalParam']) !!}
                                                        </span>
                                                    @endif

                                                </div>
                                                <div class="report-number">
                                                    <div class="report-text">
                                                        <span class="about-report test_value_negative">

                                                        @if((float)$prt['value'] > 0 && (strpos($prt['value'], '-') === false))
                                                            @if(!empty($prt['end_range']))
                                                                @if((float)$prt['value'] > (float)$prt['end_range'])
                                                                    <img src="/img/upper-red-btn.png">
                                                                @endif
                                                                @if((float)$prt['value'] < (float)$prt['start_range'])
                                                                    <img src="/img/down-red-btn.png">
                                                                @endif
                                                                @if(((float)$prt['value'] >= (float)$prt['start_range']) && ((float)$prt['value'] <= (float)$prt['end_range']))
                                                                    <img src="/img/checked_arrow.png">
                                                                @endif
                                                            @endif
                                                        @endif
                                                            {{ $prt['value'] }} 
                                                            <span class="u-i-section"> {{ $prt['unit'] }} </span>
                                                        </span>
                                                    </div>
                                                    @if((float)$prt['value'] > 0 && (strpos($prt['value'], '-') === false))
                                                        @if(!empty($prt['end_range']))
                                                            {!! getLineGraph((float)$prt['value'], (float)$prt['start_range'], (float)$prt['end_range']) !!}
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="about-indication">
                                                    @if(!empty($prt['indication']))
                                                        <h5><span>Indication:</span> {{ $prt['indication'] }}</h5>
                                                    @endif

                                                    @if(!empty($prt['recommendation']))
                                                        <h5><span>Recommendation:</span> {{ $prt['recommendation'] }}</h5>
                                                    @endif
                                                </div>

                                                @if((float)$prt['value'] > 0 && (strpos($prt['value'], '-') === false))
                                                    @if(!empty($prt['end_range']))
                                                        <div class="dropdown dropdown-section">
                                                            <button class="btn btn-primary btn-history-graph dropdown-toggle" type="button" data-toggle="dropdown" onclick="openGraph('crit_pkg_profile_prt','{{ $prt['parameterId'] }}', '{{$prt['value']}}', '{{$prt['parameterName']}}', '{{$prt['unit']}}');">
                                                                <i class="fa fa-bar-chart" aria-hidden="true"></i> 
                                                                &nbsp; Parameter History Graph
                                                            </button>                            
                                                        </div>
                                                    @endif
                                                @endif
                                                
                                            </div>
                                
                                            @if((float)$prt['value'] > 0 && (strpos($prt['value'], '-') === false))
                                                @if(!empty($prt['end_range']))
                                                    <!--Graph Area -->
                                                    <div class="container-graph" id="crit_pkg_profile_prt_{{ $prt['parameterId'] }}">
                                                        <div class="graphshaddow">
                                                            <div id="crit_pkg_profile_prt_graph_{{ $prt['parameterId'] }}" style="min-width:280px; height:380px; margin:0px auto;"></div>
                                                        </div>
                                                    </div>
                                                    <!--Graph Area Ends -->
                                                @endif
                                            @endif
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    @endif

                    @if(!empty($profile))
                        @foreach($profile as $prf)
                            @if(!empty($prf['parameterDetails']))                            
                                @if(check_critical_param($prf['parameterDetails']))
                                    <div class="topinfoparameters">
                                        <h2>{{ $prf['profileName'] }}</h2>
                                        <p>{{ $prf['profileDescription'] }}</p>
                                    </div>
                                @endif
                                @foreach($prf['parameterDetails'] as $key1 => $prmt)
                                    @if($prmt['isCriticalParam'] && !empty($prmt['value']))
                                        <!-- Parameter 1 -->
                                        @if($key1%2 == 0) 
                                            <div class="bilirubin-total-section">
                                        @else 
                                            <div class="bilirubin-total-section whitecnt">  
                                        @endif
                                            <h3 class="list-style-type"> 
                                                <span class="negative_dot"></span>
                                                {{ $prmt['parameterName'] }}

                                                @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                                    <span class="btn-results">
                                                        {!! getSmartReportGraphMessage((float)$prmt['value'], (float)$prmt['start_range'], (float)$prmt['end_range'], $prmt['isCriticalParam']) !!}
                                                    </span>
                                                @endif
                                            </h3>
                                            <div class="report-number">
                                                <div class="report-text">
                                                    <span class="about-report test_value_negative">

                                                    @if((float)$prmt['value'] > 0)
                                                        @if(!empty($prmt['end_range']))        
                                                            @if((float)$prmt['value'] > (float)$prmt['end_range'])
                                                                <img src="/img/upper-red-btn.png">
                                                            @endif
                                                            @if((float)$prmt['value'] < (float)$prmt['start_range'])
                                                                <img src="/img/down-red-btn.png">
                                                            @endif

                                                            @if(((float)$prmt['value'] >= (float)$prmt['start_range']) && ((float)$prmt['value'] <= (float)$prmt['end_range']))
                                                                <img src="/img/checked_arrow.png">
                                                            @endif
                                                        @endif
                                                    @endif
                                                        {{ $prmt['value'] }} 
                                                        <span class="u-i-section"> {{ $prmt['unit'] }} </span>
                                                    </span>                                                    
                                                </div>

                                                @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                                    @if(!empty($prmt['end_range']))
                                                        {!! getLineGraph((float)$prmt['value'], (float)$prmt['start_range'], (float)$prmt['end_range']) !!}
                                                    @endif
                                                @endif                                                    
                                            </div>
                                            <div class="about-indication">
                                                @if(!empty($prmt['indication']))
                                                    <h5><span>Indication:</span> {{ $prmt['indication'] }}</h5>
                                                @endif

                                                @if(!empty($prmt['recommendation']))
                                                    <h5><span>Recommendation:</span> {{ $prmt['recommendation'] }}</h5>
                                                @endif
                                            </div>
                                            
                                            @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                                @if(!empty($prmt['end_range']))
                                                    <div class="dropdown dropdown-section">
                                                        <button class="btn btn-primary btn-history-graph dropdown-toggle" type="button" data-toggle="dropdown" onclick="openGraph('crit_profile','{{ $prmt['parameterId'] }}', '{{$prmt['value']}}', '{{$prmt['parameterName']}}', '{{$prmt['unit']}}');">
                                                            <i class="fa fa-bar-chart" aria-hidden="true"></i> 
                                                            &nbsp; Parameter History Graph
                                                        </button>                            
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                        <!-- Parameter 1  -->
                                        @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                            @if(!empty($prmt['end_range']))
                                                <!--Graph Area -->
                                                <div class="container-graph" id="crit_profile_{{ $prmt['parameterId'] }}">
                                                    <div class="graphshaddow">
                                                        <div id="crit_profile_graph_{{ $prmt['parameterId'] }}" style="min-width:280px; height:380px; margin:0px auto;"></div>
                                                    </div>
                                                </div>
                                                <!--Graph Area Ends -->
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    @endif


                    <!-- Critical - Parameter -->
                    @if(!empty($parameter))
                        @if(check_critical_param($parameter))
                            <div class="topinfoparameters">
                                <h2>Other Parameters </h2>
                            </div>
                        @endif

                        @foreach($parameter as $key3 => $prmt)
                            @if($prmt['isCriticalParam'] && !empty($prmt['value']))
                                @if($key3%2 == 0) 
                                    <div class="bilirubin-total-section">
                                @else 
                                    <div class="bilirubin-total-section whitecnt">  
                                @endif
                                        <h3 class="list-style-type"> 
                                            <span class="negative_dot"></span>
                                            {{ $prmt['parameterName'] }}

                                            @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                                <span class="btn-results">
                                                    {!! getSmartReportGraphMessage((float)$prmt['value'], (float)$prmt['start_range'], (float)$prmt['end_range'], $prmt['isCriticalParam']) !!}
                                                </span>
                                            @endif

                                        </h3>
                                        <div class="report-number">
                                            <div class="report-text">
                                                <span class="about-report test_value_negative">
                                
                                                @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                                    @if(!empty($prmt['end_range']))
                                                        @if((float)$prmt['value'] > (float)$prmt['end_range'])
                                                            <img src="/img/upper-red-btn.png">
                                                        @endif
                                                        @if((float)$prmt['value'] < (float)$prmt['start_range'])
                                                            <img src="/img/down-red-btn.png">
                                                        @endif
                                                        @if(((float)$prmt['value'] >= (float)$prmt['start_range']) && ((float)$prmt['value'] <= (float)$prmt['end_range']))
                                                            <img src="/img/checked_arrow.png">
                                                        @endif
                                                    @endif
                                                @endif
                                                    {{ $prmt['value'] }} 
                                                    <span class="u-i-section"> {{ $prmt['unit'] }} </span>
                                                </span>
                                            </div>
                                            @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                                @if(!empty($prmt['end_range']))
                                                    {!! getLineGraph((float)$prmt['value'], (float)$prmt['start_range'], (float)$prmt['end_range']) !!}
                                                @endif
                                            @endif
                                        </div>
                                        <div class="about-indication">
                                            @if(!empty($prmt['indication']))
                                                <h5><span>Indication:</span> {{ $prmt['indication'] }}</h5>
                                            @endif

                                            @if(!empty($prmt['recommendation']))
                                                <h5><span>Recommendation:</span> {{ $prmt['recommendation'] }}</h5>
                                            @endif
                                        </div>

                                        @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                            @if(!empty($prmt['end_range']))
                                                <div class="dropdown dropdown-section">
                                                    <button class="btn btn-primary btn-history-graph dropdown-toggle" type="button" data-toggle="dropdown" onclick="openGraph('crit_parameter_prt','{{ $prmt['parameterId'] }}', '{{$prmt['value']}}', '{{$prmt['parameterName']}}', '{{$prmt['unit']}}');">
                                                        <i class="fa fa-bar-chart" aria-hidden="true"></i> 
                                                        &nbsp; Parameter History Graph
                                                    </button>                            
                                                </div>
                                            @endif
                                        @endif                                    
                                    </div>                    
                                @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                    @if(!empty($prmt['end_range']))
                                        <!--Graph Area -->
                                        <div class="container-graph" id="crit_parameter_prt_{{ $prmt['parameterId'] }}">
                                            <div class="graphshaddow">
                                                <div id="crit_parameter_prt_graph_{{ $prmt['parameterId'] }}" style="min-width:280px; height:380px; margin:0px auto;"></div>
                                            </div>
                                        </div>
                                        <!--Graph Area Ends -->
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    @endif

                </div>
                <!-- Menu 1 - Critical -->

                <!-- Menu 2 - Full Report -->
                <div id="menu2" class="tab-pane fade">

                    <!-- Full Report - Package -->
                    @if(!empty($package))
                        @foreach($package as $pkg)
                            @if(!empty($pkg['profile']))
                                @foreach($pkg['profile'] as $prf)
                                    <div class="topinfoparameters">
                                        <h2>{{ $prf['profileName'] }}</h2>
                                        <p>{{ $prf['profileDescription'] }}</p>
                                    </div>
                                    @if(!empty($prf['parameterDetails']))
                                        @foreach($prf['parameterDetails'] as $key1 => $prmt)
                                            @if(!empty($prmt['value']))
                                                @if($key1%2 == 0) 
                                                    <div class="bilirubin-total-section">
                                                @else 
                                                    <div class="bilirubin-total-section whitecnt">  
                                                @endif
                                                    <h3 class="list-style-type"> 
                                                        @if($prmt['isCriticalParam'])
                                                            <span class="negative_dot"></span>
                                                        @else
                                                            <span class="positive_dot"></span>  
                                                        @endif                                                        
                                                        
                                                        {{ $prmt['parameterName'] }}

                                                        @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                                            <span class="btn-results">
                                                                {!! getSmartReportGraphMessage((float)$prmt['value'], (float)$prmt['start_range'], (float)$prmt['end_range'], $prmt['isCriticalParam']) !!}
                                                            </span>
                                                        @endif
                                                    </h3>
                                                    <div class="report-number">
                                                        <div class="report-text">
                                                            @if($prmt['isCriticalParam'])
                                                                <span class="about-report test_value_negative">
                                                            @else
                                                                <span class="about-report test_value_positive">
                                                            @endif
                                                            
                                                            @if((float)$prmt['value'] > 0)
                                                                @if(!empty($prmt['end_range']))        
                                                                    @if((float)$prmt['value'] > (float)$prmt['end_range'])
                                                                        <img src="/img/upper-red-btn.png">
                                                                    @endif
                                                                    @if((float)$prmt['value'] < (float)$prmt['start_range'])
                                                                        <img src="/img/down-red-btn.png">
                                                                    @endif

                                                                    @if(((float)$prmt['value'] >= (float)$prmt['start_range']) && ((float)$prmt['value'] <= (float)$prmt['end_range']))
                                                                        <img src="/img/checked_arrow.png">
                                                                    @endif

                                                                @endif
                                                            @endif
                                                                {{ $prmt['value'] }} 
                                                                <span class="u-i-section"> {{ $prmt['unit'] }} </span>
                                                            </span>
                                                            
                                                        </div>

                                                        @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                                            @if(!empty($prmt['end_range']))
                                                                {!! getLineGraph((float)$prmt['value'], (float)$prmt['start_range'], (float)$prmt['end_range']) !!}
                                                            @endif
                                                        @endif
                                                            
                                                    </div>
                                                    <div class="about-indication">
                                                        @if(!empty($prmt['indication']))
                                                            <h5><span>Indication:</span> {{ $prmt['indication'] }}</h5>
                                                        @endif

                                                        @if(!empty($prmt['recommendation']))
                                                            <h5><span>Recommendation:</span> {{ $prmt['recommendation'] }}</h5>
                                                        @endif
                                                    </div>
                                                    
                                                    @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                                        @if(!empty($prmt['end_range']))
                                                            <div class="dropdown dropdown-section">
                                                                <button class="btn btn-primary btn-history-graph dropdown-toggle" type="button" data-toggle="dropdown" onclick="openGraph('pkg_profile','{{ $prmt['parameterId'] }}', '{{$prmt['value']}}', '{{$prmt['parameterName']}}', '{{$prmt['unit']}}');">
                                                                    <i class="fa fa-bar-chart" aria-hidden="true"></i> 
                                                                    &nbsp; Parameter History Graph
                                                                </button>                            
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                                @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                                    @if(!empty($prmt['end_range']))
                                                        <!--Graph Area -->
                                                        <div class="container-graph" id="pkg_profile_{{ $prmt['parameterId'] }}">
                                                            <div class="graphshaddow">
                                                                <div id="pkg_profile_graph_{{ $prmt['parameterId'] }}" style="min-width:280px; height:380px; margin:0px auto;"></div>
                                                            </div>
                                                        </div>
                                                        <!--Graph Area Ends -->
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                            
                            <!-- Full Report - Package-Paramter -->
                            @if(!empty($pkg['parameter']))
                                <div class="topinfoparameters">
                                    <h2> Other Included Parameters</h2>
                                </div>
                                @foreach($pkg['parameter'] as $key2 => $prt)
                                    <!-- Parameter 1 -->
                                    @if(!empty($prt['value']))
                                        @if($key2%2 == 0) 
                                            <div class="bilirubin-total-section">
                                        @else 
                                            <div class="bilirubin-total-section whitecnt">  
                                        @endif
                                            <h3 class="list-style-type"> 
                                                @if($prt['isCriticalParam'])
                                                    <span class="negative_dot"></span>
                                                @else
                                                    <span class="positive_dot"></span>  
                                                @endif 
                                                {{ $prt['parameterName'] }}

                                                @if((float)$prt['value'] > 0 && (strpos($prt['value'], '-') === false))
                                                    <span class="btn-results">
                                                        {!! getSmartReportGraphMessage((float)$prt['value'], (float)$prt['start_range'], (float)$prt['end_range'], $prt['isCriticalParam']) !!}
                                                    </span>
                                                @endif
                                            </h3>
                                            <div class="report-number">
                                                <div class="report-text">
                                                    @if($prt['isCriticalParam'])
                                                        <span class="about-report test_value_negative">
                                                    @else
                                                        <span class="about-report test_value_positive">
                                                    @endif
                                    
                                                    @if((float)$prt['value'] > 0 && (strpos($prt['value'], '-') === false))
                                                        @if(!empty($prt['end_range']))
                                                            @if((float)$prt['value'] > (float)$prt['end_range'])
                                                                <img src="/img/upper-red-btn.png">
                                                            @endif
                                                            @if((float)$prt['value'] < (float)$prt['start_range'])
                                                                <img src="/img/down-red-btn.png">
                                                            @endif
                                                            @if(((float)$prt['value'] >= (float)$prt['start_range']) && ((float)$prt['value'] <= (float)$prt['end_range']))
                                                                <img src="/img/checked_arrow.png">
                                                            @endif
                                                        @endif
                                                    @endif
                                                        {{ $prt['value'] }} 
                                                        <span class="u-i-section"> {{ $prt['unit'] }} </span>
                                                    </span>
                                                </div>
                                                @if((float)$prt['value'] > 0 && (strpos($prt['value'], '-') === false))
                                                    @if(!empty($prt['end_range']))
                                                        {!! getLineGraph((float)$prt['value'], (float)$prt['start_range'], (float)$prt['end_range']) !!}
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="about-indication">
                                                @if(!empty($prt['indication']))
                                                    <h5><span>Indication:</span> {{ $prt['indication'] }}</h5>
                                                @endif

                                                @if(!empty($prt['recommendation']))
                                                    <h5><span>Recommendation:</span> {{ $prt['recommendation'] }}</h5>
                                                @endif
                                            </div>

                                            @if((float)$prt['value'] > 0 && (strpos($prt['value'], '-') === false))
                                                @if(!empty($prt['end_range']))
                                                    <div class="dropdown dropdown-section">
                                                        <button class="btn btn-primary btn-history-graph dropdown-toggle" type="button" data-toggle="dropdown" onclick="openGraph('pkg_profile_prt','{{ $prt['parameterId'] }}', '{{$prt['value']}}', '{{$prt['parameterName']}}', '{{$prt['unit']}}');">
                                                            <i class="fa fa-bar-chart" aria-hidden="true"></i> 
                                                            &nbsp; Parameter History Graph
                                                        </button>                            
                                                    </div>
                                                @endif
                                            @endif
                                            
                                        </div>
                            
                                        @if((float)$prt['value'] > 0 && (strpos($prt['value'], '-') === false))
                                            @if(!empty($prt['end_range']))
                                                <!--Graph Area -->
                                                <div class="container-graph" id="pkg_profile_prt_{{ $prt['parameterId'] }}">
                                                    <div class="graphshaddow">
                                                        <div id="pkg_profile_prt_graph_{{ $prt['parameterId'] }}" style="min-width:280px; height:380px; margin:0px auto;"></div>
                                                    </div>
                                                </div>
                                                <!--Graph Area Ends -->
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    @endif


                    @if(!empty($profile))
                        @foreach($profile as $prf)
                            <div class="topinfoparameters">
                                <h2>{{ $prf['profileName'] }}</h2>
                                <p>{{ $prf['profileDescription'] }}</p>
                            </div>
                            @if(!empty($prf['parameterDetails']))
                                @foreach($prf['parameterDetails'] as $key1 => $prmt)
                                    @if(!empty($prmt['value']))
                                        @if($key1%2 == 0) 
                                            <div class="bilirubin-total-section">
                                        @else 
                                            <div class="bilirubin-total-section whitecnt">  
                                        @endif
                                            <h3 class="list-style-type"> 
                                                @if($prmt['isCriticalParam'])
                                                    <span class="negative_dot"></span>
                                                @else
                                                    <span class="positive_dot"></span>  
                                                @endif                                                        
                                                
                                                {{ $prmt['parameterName'] }}

                                                @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                                    <span class="btn-results">
                                                        {!! getSmartReportGraphMessage((float)$prmt['value'], (float)$prmt['start_range'], (float)$prmt['end_range'], $prmt['isCriticalParam']) !!}
                                                    </span>
                                                @endif
                                            </h3>
                                            <div class="report-number">
                                                <div class="report-text">
                                                    @if($prmt['isCriticalParam'])
                                                        <span class="about-report test_value_negative">
                                                    @else
                                                        <span class="about-report test_value_positive">
                                                    @endif
                                                    
                                                    @if((float)$prmt['value'] > 0)
                                                        @if(!empty($prmt['end_range']))        
                                                            @if((float)$prmt['value'] > (float)$prmt['end_range'])
                                                                <img src="/img/upper-red-btn.png">
                                                            @endif
                                                            @if((float)$prmt['value'] < (float)$prmt['start_range'])
                                                                <img src="/img/down-red-btn.png">
                                                            @endif

                                                            @if(((float)$prmt['value'] >= (float)$prmt['start_range']) && ((float)$prmt['value'] <= (float)$prmt['end_range']))
                                                                <img src="/img/checked_arrow.png">
                                                            @endif

                                                        @endif
                                                    @endif
                                                        {{ $prmt['value'] }} 
                                                        <span class="u-i-section"> {{ $prmt['unit'] }} </span>
                                                    </span>
                                                    
                                                </div>

                                                @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                                    @if(!empty($prmt['end_range']))
                                                        {!! getLineGraph((float)$prmt['value'], (float)$prmt['start_range'], (float)$prmt['end_range']) !!}
                                                    @endif
                                                @endif
                                                    
                                            </div>
                                            <div class="about-indication">
                                                @if(!empty($prmt['indication']))
                                                    <h5><span>Indication:</span> {{ $prmt['indication'] }}</h5>
                                                @endif

                                                @if(!empty($prmt['recommendation']))
                                                    <h5><span>Recommendation:</span> {{ $prmt['recommendation'] }}</h5>
                                                @endif
                                            </div>
                                            
                                            @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                                @if(!empty($prmt['end_range']))
                                                    <div class="dropdown dropdown-section">
                                                        <button class="btn btn-primary btn-history-graph dropdown-toggle" type="button" data-toggle="dropdown" onclick="openGraph('profile','{{ $prmt['parameterId'] }}', '{{$prmt['value']}}', '{{$prmt['parameterName']}}', '{{$prmt['unit']}}');">
                                                            <i class="fa fa-bar-chart" aria-hidden="true"></i> 
                                                            &nbsp; Parameter History Graph
                                                        </button>                            
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                        @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                            @if(!empty($prmt['end_range']))
                                                <!--Graph Area -->
                                                <div class="container-graph" id="profile_{{ $prmt['parameterId'] }}">
                                                    <div class="graphshaddow">
                                                        <div id="profile_graph_{{ $prmt['parameterId'] }}" style="min-width:280px; height:380px; margin:0px auto;"></div>
                                                    </div>
                                                </div>
                                                <!--Graph Area Ends -->
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    @endif

                    <!-- Full Report - Parameter -->
                    @if(!empty($parameter))
                        <div class="topinfoparameters">
                            <h2>Other Parameters </h2>
                        </div>
                        @foreach($parameter as $key3 => $prmt)
                            <!-- Parameter 1 -->
                            @if(!empty($prmt['value']))
                                @if($key3 % 2 == 0) 
                                    <div class="bilirubin-total-section">
                                @else 
                                    <div class="bilirubin-total-section whitecnt">  
                                @endif
                                    <h3 class="list-style-type"> 
                                        @if($prmt['isCriticalParam'])
                                            <span class="negative_dot"></span>
                                        @else
                                            <span class="positive_dot"></span>  
                                        @endif 
                                        {{ $prmt['parameterName'] }}

                                        @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                            <span class="btn-results">
                                                {!! getSmartReportGraphMessage((float)$prmt['value'], (float)$prmt['start_range'], (float)$prmt['end_range'], $prmt['isCriticalParam']) !!}
                                            </span>
                                        @endif
                                    </h3>
                                    <div class="report-number">
                                        <div class="report-text">
                                            @if($prmt['isCriticalParam'])
                                                <span class="about-report test_value_negative">
                                            @else
                                                <span class="about-report test_value_positive">
                                            @endif
                            
                                            @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                                @if(!empty($prmt['end_range']))
                                                    @if((float)$prmt['value'] > (float)$prmt['end_range'])
                                                        <img src="/img/upper-red-btn.png">
                                                    @endif
                                                    @if((float)$prmt['value'] < (float)$prmt['start_range'])
                                                        <img src="/img/down-red-btn.png">
                                                    @endif
                                                    @if(((float)$prmt['value'] >= (float)$prmt['start_range']) && ((float)$prmt['value'] <= (float)$prmt['end_range']))
                                                        <img src="/img/checked_arrow.png">
                                                    @endif
                                                @endif
                                            @endif
                                                {{ $prmt['value'] }} 
                                                <span class="u-i-section"> {{ $prmt['unit'] }} </span>
                                            </span>
                                        </div>
                                        @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                            @if(!empty($prmt['end_range']))
                                                {!! getLineGraph((float)$prmt['value'], (float)$prmt['start_range'], (float)$prmt['end_range']) !!}
                                            @endif
                                        @endif
                                    </div>
                                    <div class="about-indication">
                                        @if(!empty($prmt['indication']))
                                            <h5><span>Indication:</span> {{ $prmt['indication'] }}</h5>
                                        @endif

                                        @if(!empty($prmt['recommendation']))
                                            <h5><span>Recommendation:</span> {{ $prmt['recommendation'] }}</h5>
                                        @endif
                                    </div>

                                    @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                        @if(!empty($prmt['end_range']))
                                            <div class="dropdown dropdown-section">
                                                <button class="btn btn-primary btn-history-graph dropdown-toggle" type="button" data-toggle="dropdown" onclick="openGraph('parameter_prt','{{ $prmt['parameterId'] }}', '{{$prmt['value']}}', '{{$prmt['parameterName']}}', '{{$prmt['unit']}}');">
                                                    <i class="fa fa-bar-chart" aria-hidden="true"></i> 
                                                    &nbsp; Parameter History Graph
                                                </button>                            
                                            </div>
                                        @endif
                                    @endif
                                    
                                </div>
                    
                                @if((float)$prmt['value'] > 0 && (strpos($prmt['value'], '-') === false))
                                    @if(!empty($prmt['end_range']))
                                        <!--Graph Area -->
                                        <div class="container-graph" id="parameter_prt_{{ $prmt['parameterId'] }}">
                                            <div class="graphshaddow">
                                                <div id="parameter_prt_graph_{{ $prmt['parameterId'] }}" style="min-width:280px; height:380px; margin:0px auto;"></div>
                                            </div>
                                        </div>
                                        <!--Graph Area Ends -->
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    @endif
                </div>
                <!-- Menu 2 - Full Report -->

                <!-- Menu 3 - Recommend -->
                @if(!empty($recommanedTest))
                
                    <div id="menu3" class="tab-pane fade">
                        {{-- <div class="topinfoparameters">
                            <p>Liver Function test is required to screen the health of liver in Viral Hepatitis(A, B, C), Cirrhosis, Alcoholic Liver Disease or to monitor the effect of certain medicines.</p>
                        </div> --}}

                        <div class="about-recommendation-section">
                            @foreach($recommanedTest as $recm)
                                <div class="about-vitamin-section">
                                    <label class="container-multi-select">
                                         <input name="recommd_check" id="rec_{{ $recm['id'] }}" value="{{ $recm['id'] }}" type="checkbox" checked>
                                        <span class="checkmark-mark checkmark-section"></span>
                                        <div class="about-text-vitamin">
                                            <h2>{{ $recm['product_name'] }}</h2>
                                        </div>
                                        <div class="about-money">
                                            <del class="del-money">₹ {{ $recm['mrp'] }}</del>
                                            <span class="offer-money">₹ {{ $recm['price'] }}</span>
                                        </div>
                                        <div class="about-btn-section">
                                            <div class="off-btn-section">
                                                {{ calPer($recm['price'], $recm['mrp']) }}% off
                                            </div>
                                        </div>
                                       
                                    </label>
                                </div>
                            @endforeach

                            <center>
                                <div class="col-sm-12 text-center">
                                    <a href="javascript:void(0);" onClick="recommend_search();" class="btn btn-danger danger-section" link-title="Book Now"> 
                                        Book Now <img class="lazy-loaded" src="/img/left-icon-sml.png">
                                    </a> 
                                </div>
                            </center>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Tabular Report Ends -->

</div>
<!-- Smart Report Section Ends -->

<!-- Smart Report Section ends here -->
@endsection

@push('footer-scripts')
    <!-- HIGH CHARTS JS -->
    <script src="/js/highcharts/highcharts.js"></script>
    <script src="/js/highcharts/series-label.js"></script>
    <script src="/js/highcharts/exporting.js"></script>
    <script src="/js/highcharts/export-data.js"></script>
    <!-- HIGH CHARTS JS -->

    <!-- SMART SCORE CIRCLE -->
    <script type="text/javascript">
        var healthScore     =   "{{$healthScore}}";
        var graph_api_url   =   "{{url('getGraphData')}}";
        var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "July", "Aug", "Sept", "Oct", "Nov", "Dec"];
        var karma_recommend_data = <?php if(!empty($recommanedTest)) { echo json_encode($recommanedTest); } else { echo json_encode([]); } ?>;
        var chart;

        function renderProgress(progress) {
            progress = Math.floor(progress);
            
            if(progress<25){
                var angle = -90 + (progress/100)*360;
                $(".animate-0-25-b").css("transform","rotate("+angle+"deg)");
            }
            else if(progress>=25 && progress<50){
                var angle = -90 + ((progress-25)/100)*360;
                $(".animate-0-25-b").css("transform","rotate(0deg)");
                $(".animate-25-50-b").css("transform","rotate("+angle+"deg)");
            }
            else if(progress>=50 && progress<75){
                var angle = -90 + ((progress-50)/100)*360;
                $(".animate-25-50-b, .animate-0-25-b").css("transform","rotate(0deg)");
                $(".animate-50-75-b").css("transform","rotate("+angle+"deg)");
            }
            else if(progress>=75 && progress<=100){
                var angle = -90 + ((progress-75)/100)*360;
                $(".animate-50-75-b, .animate-25-50-b, .animate-0-25-b").css("transform","rotate(0deg)");
                $(".animate-75-100-b").css("transform","rotate("+angle+"deg)");
            }
            if(progress==100){
            }
            $(".text").html(progress+"");
        }
            
        function clearProgress() {
            $(".animate-75-100-b, .animate-50-75-b, .animate-25-50-b, .animate-0-25-b").css("transform","rotate(90deg)");
        }
            
        var i          =    0;
        var times      =    0;        
        var interval   =    setInterval(function (){
            i++;
            times += 1;
            if( times >=healthScore) {
                width = '4px';
                clearInterval(interval);
                $('.text').animate({opacity : 0.5}, 'slow');
                $('.loader-spiner').animate({
                    borderLeftWidth     : width,
                    borderTopWidth      : width,
                    borderRightWidth    : width,
                    borderBottomWidth   : width
                }, 100 );
            }
            renderProgress(i);
        },60);

        function openGraph(type, id, current_test_value, param_name, param_unit) {
            console.log("current_test_value", current_test_value);
            var graph_id            = type+'_graph_'+id;
            var current_test_value  = parseFloat(current_test_value);
            var param_name          = param_name;
            var param_unit          = param_unit;
            
            if($("#"+graph_id).is(":visible")) {
                $("#"+type+'_'+id).slideToggle("slow");
                $("#"+graph_id).html(" ");
                $("#"+graph_id).removeAttr("data-highcharts-chart");
                return false;
            }

            
            var requestData = {
                "parameterId" : id,
                "customerId"  : '{{$customer_id}}',
                '_token'      : '{{csrf_token()}}'
            };
            
            $.ajax({
                url: graph_api_url,
                type: 'post',
                data: requestData ,
                dataType: "json",
                beforeSend: function() {
                    $("#ajax-loader").show();
                },
                success: function (response) {
                    $("#ajax-loader").hide();
                    if(response) {
                        if(response.status) {
                            $("#"+type+'_'+id).slideToggle("slow");

                            if(response.data) {
                                var min_range = parseFloat(response.data.series[0].TestMinRangeValue);
                                var max_range = parseFloat(response.data.series[0].TestMaxRangeValue);

                                var maximumYaxis;
                                
                                //report value is low
                                if(min_range > current_test_value){  
                                    maximumYaxis    =   max_range + (max_range * 0.2);
                                }
                                //report value is High
                                else if (max_range < current_test_value){ 
                                    maximumYaxis    =   current_test_value + (current_test_value * 0.2);
                                }
                                //report value is Normal
                                else if ((min_range <= current_test_value) && (max_range >= current_test_value)) {
                                    maximumYaxis    =   max_range + (max_range * 0.2);
                                }

                                var plotBands   = [];
                                var zone        = [];
                                var min_y       = 0;

                                if(min_range > 0) {
                                    plotBands = [{
                                        from    : 0,
                                        to      : min_range,
                                        color   : 'rgba(253, 243, 231, 1)',
                                        label   : {
                                            text    : '',
                                            style   : {
                                                color: '#606060'
                                            }
                                        }
                                    },{ 
                                        from: min_range,
                                        to: max_range,
                                        color: 'rgba(231, 255, 225, 1)',
                                        label: {
                                            text: '',
                                            style: {
                                                color: '#606060'
                                            }
                                        }
                                    },
                                    { 
                                        from: max_range,
                                        to: maximumYaxis,
                                        color: 'rgba(253, 243, 231, 1)',
                                        label: {
                                            text: '',
                                            style: {
                                                color: '#606060'
                                            }
                                        }
                                    }];

                                    zone = [{
                                        value: min_range,
                                        className: 'zone-1'
                                    }, {
                                        value: max_range,
                                        className: 'zone-2'
                                    }, {
                                        value: maximumYaxis,
                                        className: 'zone-1'
                                    }];
                                }      
                                else {
                                    min_y = min_range;
                                    plotBands = [{ 
                                        from: min_range,
                                        to: max_range,
                                        color: 'rgba(231, 255, 225, 1)',
                                        label: {
                                            text: '',
                                            style: {
                                                color: '#606060'
                                            }
                                        }
                                    },
                                    { 
                                        from: max_range,
                                        to: maximumYaxis,
                                        color: 'rgba(253, 243, 231, 1)',
                                        label: {
                                            text: '',
                                            style: {
                                                color: '#606060'
                                            }
                                        }
                                    }];

                                    zone = [{
                                        value: max_range,
                                        className: 'zone-2'
                                    }, {
                                        value: maximumYaxis,
                                        className: 'zone-1'
                                    }];
                                }
                                
                                var x_categories    = [];
                                var dataSeries      = []
                                var index_temp      = 0;
                                response.data.series.forEach(function(element, index) {
                                    if(element.value !== '') {
                                        if(element.date !== '' && element.date != '0000-00-00') {
                                            var d = new Date(element.date);
                                            var t = months[d.getMonth()]+' '+d.getFullYear();
                                            x_categories.push(t);
                                            var dot_color = 'red';
                                            if ((parseFloat(element.TestMinRangeValue) <= parseFloat(element.value)) && (parseFloat(element.TestMaxRangeValue) >= parseFloat(element.value))) {
                                                dot_color = 'green';
                                            }
                                            dataSeries.push({x: index_temp, y: parseFloat(element.value), color: dot_color });
                                        }
                                        else {
                                            x_categories.push('N/A');
                                            var dot_color = 'red';
                                            if ((parseFloat(element.TestMinRangeValue) <= parseFloat(element.value)) && (parseFloat(element.TestMaxRangeValue) >= parseFloat(element.value))) {
                                                dot_color = 'green';
                                            }
                                            dataSeries.push({x: index_temp, y: parseFloat(element.value), color: dot_color });
                                        }
                                        index_temp++;
                                    }
                                });
                                createGraph(graph_id, plotBands, zone, x_categories, dataSeries, param_name, param_unit, min_y);                       
                            }                           
                        }
                        else {
                            showStrError("error", response.message);
                        }
                    }
                },
                error: function (response) {
                    $("#ajax-loader").hide();
                    var errorData = response.responseJSON;

                    showStrError("error", errorData.message);
                }
            });
        }

        function createGraph(graph_id, plotBands, zone, x_categories, dataSeries, param_name, param_unit, min_y) {
            var option_graph = {
                chart: {
                    type    : 'spline',
                },
                credits     : {
                    enabled : false
                },
                exporting   : false,
                title       : {
                    text    : null
                },
                subtitle    : {                    
                },
                xAxis       : {
                    type    : 'datetime',
                    labels  : {
                        overflow    : 'justify'
                    }
                },
                yAxis: {
                    title       : {
                        text    : ''
                    },
                    min:min_y,
                    lineColor           : '#474747',
                    lineWidth           : 1,
                    minorGridLineWidth  : 0,
                    gridLineWidth       : 0,
                    alternateGridColor  : null,                  
                    plotBands           : plotBands
                },
                tooltip : {
                    enabled : true
                },
                plotOptions : {
                    spline  : {
                        lineWidth   : 2,
                        color       : '#000',
                        states      : {
                            hover   : {
                                lineWidth: 2
                            }
                        },
                        marker      : {
                            enabled : true,
                            symbol: 'circle',
                            radius: 6
                        },
                        pointInterval   : 3600000, // one hour
                        pointStart      : Date.UTC(2018, 1, 13, 0, 0, 0),
                        dataLabels: {
                            enabled: true,
                            y: -8
                        }
                    },                    
                    column: {
                        pointPadding: 1,
                        borderWidth: 1,
                    },
                    series: {
                        zones       : zone,
                        threshold   : -10,
                        events: {
                            legendItemClick: function (e) {
                                e.preventDefault();
                            }
                        },
                        label : {
                            enabled : false
                        }
                    },
                    allowPointSelect: false,
                },
                series: [{
                    name: param_name,
                    data: dataSeries

                }],
                xAxis: {
                    categories: x_categories,
                    labels: {
                        style: {
                            color: '#333'
                        }
                    }
                },
                navigation: {
                    menuItemStyle: {
                        fontSize: '9px'
                    }
                },
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            subtitle: {
                                text: null
                            },
                            credits: {
                                enabled: false
                            },
                            chart: {
                                height: 300
                            },
                            navigator: {
                                enabled: false
                            }
                        }
                    }]
                }
            };

            Highcharts.chart(graph_id, option_graph,function (chart) {
                var series = chart.series;
                $(series).each(function (i, serie) {
                    if (serie.legendSymbol) serie.legendSymbol.destroy();
                    if (serie.legendLine) serie.legendLine.destroy();
                });
            });
        }

        /* Recommend - Start */
        function recommend_search() {
            var final_search = [];
            var favorite = {};

            $.each($("input[name='recommd_check']:checked"), function(){  
                var selected_id = $(this).val();
                if(selected_id) {
                    karma_recommend_data.forEach(function(items, key) {  
                        if(items.id == selected_id) {
                            var tt = {
                                "id": items.type+'_'+items.id,
                                "text": items.product_name
                            }
                            final_search.push(tt);
                            favorite[items.type+'_'+items.id] = items.product_name;
                        }
                    });
                }        
            });

            if (final_search.length !== 0) {     
                
                pushGaEvent('Smart Report', 'Search From Smart Report', final_search);

                var selected_city = getCookie("sLocation");

                if(selected_city === '' || selected_city == null) {
                    selected_city = 'gurgaon';
                }

                var search_query = Object.keys(favorite)
                    .map(function(k) {
                        return 'f[' + escape(k) + ']' + '=' + escape(favorite[k]);
                    }).join('&');

                setTimeout(function() {
                    window.location = document.location.origin + '/' + selected_city.toLowerCase() + '/orderbook' + '?' + search_query;
                } , 500);
            }
            else {
                showStrError("error", "Please select atleast one checkbox");
            }
        }
        /* Recommend - End */
    </script>
   

@endpush