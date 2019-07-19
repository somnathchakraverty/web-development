@extends('layout.master')

@section('page-content')
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
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 Referdiv">
                    <div class="Family-headingdiv text-left">
                        <h3>Refer & Earn</h3>
                    </div>
                    <div class="Retake-Healthkarmadiv text-center">
                        <img src="/img/glob-animate.png" alt="" class="imgrefer">
                        <div class="add-box">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                <h2>Refer & Earn</h2>
                                <h3>Give {{$refer_details['refererAmount']}}, Get {{$refer_details['earnAmount']}}</h3>
                                <p>Your Code to Invite</p>
                                <div class="input-group ">
                                <input type="text" class="form-control" id="refercode" placeholder="{{ $refer_details['referCode'] }}" value="{{ $refer_details['referCode'] }}" aria-label="Recipient's username" aria-describedby="basic-addon2" readonly>
                                    <div class="input-group-append">
                                        <a class=" btn btn-danger input-group-text " data-toggle="modal" data-target="#myModal" id="basic-addon2" onclick="copyFunction();">Copy</a>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 refertext">
                                <h4 class="termsrefer"> Terms & Condition </h4>
                                {!! $refer_details['appTerm'] !!}
                            </div>
                            {{-- <div class="col-sm-12 social-iconsdiv">
                                <h4>Share your code via</h4>
                                <ul class="social-network social-circle">
                                <li>
                                    <a href="#" class="icoRss" title="Rss"><i class="fa fa-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-linkedin"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="icoGoogle" title="Google +"><i class="fa fa fa-envelope"></i></a>
                                </li>
                                </ul>
                                <!-- Modal -->
                                <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog" style="width: 50%!important;">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <img class="full" src="/img/thanks.png">
                                            <p>Your Refrence Code has been Shared Successfully</p>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>	
            </div>
        </div>
    </section>
@endsection
<script>
function copyFunction() {
    /* Get the text field */
    var copyText = document.getElementById("refercode");
  
    /* Select the text field */
    copyText.select();
  
    /* Copy the text inside the text field */
    document.execCommand("copy");
  
    /* Alert the copied text */
    showStrError("success", "Copied");
}
</script>

@push('footer-scripts')