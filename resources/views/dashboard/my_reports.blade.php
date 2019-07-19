@extends('layout.master')

@section('page-content')

<!-- My Reports start here -->
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
                    <h3>My Reports</h3>
                </div>
                <div class="Retake-Healthkarmadiv f-div padding-div">
                    
                    <!-- Profile Slider -->
                    <div id="profile-slider" class="owl-carousel">
                        <div>
                            <a href="<?php echo route("myReports", [   
                                                                    'cust_id'          =>  $userDetail['user_id']
                                                                ]
                                            ) ?>" class="active-report" style="text-decoration:none;">
                                @if($userDetail['user_id'] == $cust_id)
                                    <div class="namerdiv report_active"> 
                                @else
                                    <div class="namerdiv"> 
                                @endif
                                    {{ nameInitials($userDetail['name']) }}
                                </div>
                            </a>
                        </div>

                        @foreach ($family_list as $item)
                            @if($item['customer_id'] !== $userDetail['user_id'])
                                <div>
                                    <a href="<?php echo route("myReports", [   
                                                                    'cust_id'          =>  $item['customer_id']
                                                                ]
                                            ) ?>" class="active-report" style="text-decoration:none;">
                                        @if($item['customer_id'] == $cust_id)
                                            <div class="namerdiv report_active"> 
                                        @else
                                            <div class="namerdiv"> 
                                        @endif
                                            {{nameInitials($item['customer_name'])}}
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Heading -->
                    <h3 class="mar-bot usernamereport"> {{ucwords($userName)}}'s Reports</h3>
                    <!-- informatio Box start -->
                    @if(!empty($report_list[0]))
                        @foreach ($report_list[0]['orders_new'] as $report_item)
                            <div class="add-box">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="bod" colspan="2">
                                                            {{$report_list[0]['customer_name']}} 
                                                            @if(!empty($report_item['report']['relationship_status']))
                                                                ({{$report_item['report']['relationship_status']}})
                                                            @endif
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2">
                                                            <div class="reporttitle">
                                                            @if(!empty($report_item['order_detail']['package_name']))
                                                                {{$report_item['order_detail']['package_name']}}
                                                            @else
                                                                {{$report_item['report']['display_name']}}
                                                            @endif
                                                        </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Report Recieved Date : </td>
                                                        <td>{{ convertUserVisibleDateTimeFormat($report_item['report']['verified_at']) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Booking ID : </td>
                                                        <td>{{$report_item['report']['booking_id']}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                   

                                    <div class="smart-section-opt">
                                        <a href="javascript:void(0);" onclick="downloadReport('{{$report_item['report']['report_id']}}','{{$report_item['report']['booking_id']}}','{{$report_item['report']['customer_id']}}');">
                                            <div class="orderdtl">
                                                <h3> Download Report </h3>
                                                Click Here                                             
                                            </div>
                                        </a>
                                        @if($report_item['report']['isdigitalstatus'])
                                            <a href="/smart-report/{{$report_item['report']['booking_id']}}/{{$report_item['report']['customer_id']}}">
                                                <div class="smartrpt">
                                                    <h3> View Smart Report &nbsp;<img src="/img/newfeat.png" width="29"></h3>
                                                 
                                                    Click here                                                                                              
                                                </div>
                                            </a> 
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-md-12">
                            <h4>
                                <label class="alert alert-info">No reports Found..!!</label>
                            </h4>
                        </div>
                    @endif

                </div>
            </div>	
        </div>
    </div>
</section>

@endsection

@push('footer-scripts')
<script type="text/javascript">
    /* To download Report */
    function downloadReport(report_id, booking_id, customer_id) {
        $.ajax({
            url     : "{{$downloadReportAPI}}",
            type    : "GET",
            data    : {
                "booking_id"    : booking_id,
                "report_id"     : report_id,
                "customer_id"   : customer_id
            },
            xhrFields : {
                'responseType' : 'blob'
            },
            dataType  : 'binary',
            beforeSend: function() {
                $("#ajax-loader").show();
            },
            success   : function (response) {
                if(response.size !== 0) {
                    var a = document.createElement("a");
                    document.body.appendChild(a);
                    a.style = "display: none";

                    var file = new Blob([response], {type: 'application/pdf'});
                    var fileURL = window.URL.createObjectURL(file);
                    a.href = fileURL;
                    a.download = report_id+'_'+customer_id;
                    a.click();
                }
                else {
                    showStrError("error", "No report available.");
                }
                $("#ajax-loader").hide();
            }
        });
    }
</script>

@endpush