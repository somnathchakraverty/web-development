@extends('layout.master')

@section('page-content')
    <section class="faimly-friendwraper">

        <div class="fixed-bar">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 slidingDiv">
                    <div class="asidenavdiv text-left">
                        @include('section.left-dashboard', ['userDetail' => $userDetail])
                    </div>	
                </div>

                <!------aside-end -->
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="Family-headingdiv text-left">
                        <h3>H Cash</h3>
                    </div>
                    <div class="Retake-Healthkarmadiv f-div">
                        
                    </div>
                </div>	
            </div>
        </div>
    </section>
@endsection
@push('footer-scripts')