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
    <div class="alert alert-success" id="success_message">
        Thank You for your feedback. <br>Our Customer Care Executive will get in contact with you.
    </div>
@endif

@if ($form_submit_error)
    <div class="alert alert-danger">
        Something went wrong. Please try again after sometime.
    </div>
@endif

<form action="{{url('saveFeedback')}}" id="feedback_form" name="feedback_form" method="post">
    {{csrf_field()}}
    <div class="row">
        <div class="form-group col-md-6">
            <label class="label_name">Full Name*</label>
            <input class="form-control" type="text" id="name" name="name" placeholder="Enter Full Name" maxlength="255"
                   value="{{ old('name') }}" autocomplete="off">
        </div>

        <div class="form-group col-md-6">
            <label class="label_name">Email ID*</label>
            <input class="form-control" type="email" id="email_id" name="email_id" placeholder="Enter Email"
                   maxlength="255" value="{{ old('email_id') }}" autocomplete="off">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label class="label_name">Mobile No.*</label>
            <input class="form-control" type="text" id="contact_no" name="contact_no" placeholder="Enter Mobile No."
                   minlength="10" maxlength="10" value="{{ old('contact_no') }}">
        </div>
        <div class="form-group col-md-6">
            <label class="label_name">Query Type*</label>
            <select class="form-control" id="issue_type" name="issue_type" onchange="selectQuery();" required>
                <option value="" selected="selected">Select Issue *</option>
                @foreach ($query_type as $key=>$value)
                    <option value="{{$value['id']}}_{{$value['dept_id']}}">{{$value['name']}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6" id="booking_div" style="display:none;">
            <label class="label_name">Booking ID *</label>
            <input class="form-control" type="text" id="booking_id" name="booking_id" placeholder="Enter Booking ID *"
                   maxlength="15" value="{{ old('booking_id') }}" autocomplete="off">
        </div>
    </div>
    <div class="row">
        <div class="text-area col-md-12">
            <label class="label_name">Message</label>
            <textarea placeholder="Enter Message" rows="5" id="message" name="message" autocomplete="off"
                      value="{{ old('message') }}" maxlength="512"></textarea>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="cpcha-btn">
        <div class="btn-submitform">
            <button class="btn btn-danger btn_cmncolor" type="submit" onClick="validateFeedback();">Send Feedback
            </button>
        </div>
    </div>
</form>
<style>.feedback-div .text-area label{ width: 11%; }</style>