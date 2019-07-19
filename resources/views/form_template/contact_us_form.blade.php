<div class="For-anyquerydiv text-center">
    <p>For any query fill the form below.<br>
    For career, related requests use <b><a href="/career">career page</a>.</b></p>
    
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

    <form action="{{url('saveContactUs')}}" id="contact_us" name="contact_us" method="post">
        {{csrf_field()}}
        <div class="form-group row">
            <input class="form-control" id="name" name="name" placeholder="Name *" type="text" autocomplete="off" maxlength="255" value="{{ old('name') }}">
        </div>
        <div class="form-group row">
            <input class="form-control" id="email_id" name="email_id" placeholder="Email Address *" type="email" autocomplete="off" value="{{ old('email_id') }}">
        </div>
        <div class="form-group row">
            <input class="form-control" id="contact_no" name="contact_no" placeholder="Mobile Number *" type="text" minlength="10" maxlength="10" value="{{ old('contact_no') }}" autocomplete="off">
        </div>
        <div class="form-group row">
            <input class="form-control" id="company" name="company" placeholder="Company *" type="text" value="{{ old('company') }}" autocomplete="off">
        </div>
        <div class="text-area row">
            <textarea placeholder="Message" rows="8" id="message" name="message" autocomplete="off" value="{{ old('message') }}" maxlength="512"></textarea>
        </div>
        <div class="btn-submitform">
            <button class="btn btn-default" type="submit" onClick="validateContactUs();">Submit</button>
        </div>
    </form>
</div>