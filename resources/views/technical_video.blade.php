@extends('layout.master')

@section('page-content')

    <section class="tecnical-video">
        <div class="container">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="{{$video_url}}"></iframe>
            </div>
        </div>
    </section>

@endsection

@push('footer-scripts')

<script>
    var saveVideoTrack_api_url  = "{{url('track_video')}}";
    var urlParams               = new URLSearchParams(window.location.search);

    var source = 'web';

    if (isMobile.any()) {
        source = 'mobile';
    }

    function videoSuccessHandler(response) {
        var errorData = response.responseJSON;
        /* Nothing to do */
    }

    function videoErrorHandler(response) {        
        var errorData = response.responseJSON;
        /* Nothing to do */
    }
    $(document).ready(function(){
        if(urlParams.has('booking_id')) {
            if(urlParams.has('mobile')) {
                var booking_id      = urlParams.get('booking_id');
                var mobile          = urlParams.get('mobile');
                
                var request_data    = {
                    booking_id    : booking_id,
                    mobile        : mobile,
                    source        : source,
                }
                $.ajaxSetup({
                    headers : {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    }
                });

                ajaxCallPromise(saveVideoTrack_api_url, "POST", request_data).then(videoSuccessHandler, videoErrorHandler);
            }
        }
    });

</script>

@endpush