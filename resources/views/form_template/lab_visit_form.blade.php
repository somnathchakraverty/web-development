
<div class="visit-form">
    <div class="visit-heading">
        <h5>Plan a Visit to Our Lab</h5>
    </div>
    <div class="clearfix"></div>
    <div id="form_message">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="text-align: left;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($form_submit_success)
            <div class="alert alert-success">
                Thank You for sharing your details with us. <br>Our Customer Care Executive will get in contact with you.
            </div>
        @endif

        @if ($form_submit_error)
            <div class="alert alert-danger">
                Something went wrong. Please try again after some time.
            </div>
        @endif
    </div>
    <form action="{{url('saveLabVisit')}}" id="lab_visit_form" name="lab_visit_form" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <input class="form-control" id="name" name="name" placeholder="Name *" type="text" autocomplete="off" maxlength="255" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <input class="form-control" id="email_id" name="email_id" placeholder="Email Address *" type="text" autocomplete="off" value="{{ old('email_id') }}">
        </div>
        <div class="form-group">
            <input class="form-control" id="contact_no" name="contact_no" placeholder="Mobile Number *" type="text" minlength="10" maxlength="10" value="{{ old('contact_no') }}" autocomplete="off">
        </div>
        <div class="text-area">
            <textarea placeholder="Message" rows="4" id="message" name="message" autocomplete="off" value="{{ old('message') }}" ></textarea>
        </div>
        <div class="btn-submitform">
            <button class="btn btn-default" type="submit" onClick="validateLabVisit();">Submit</button>
        </div>
    </form>
</div>