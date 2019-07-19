@if ($errors->any())
    <div class="alert alert-danger">
        <ul style="text-align: left;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div id="form_message">
    @if ($form_submit_success)
        <div class="alert alert-success">
            Thank You for sharing your details with us. <br>Our HR will get in contact with you.
        </div>
    @endif

    @if ($form_submit_error)
        <div class="alert alert-danger">
            Something went wrong. Please try again after some time.
        </div>
    @endif
</div>
<form action="{{url('saveCareer')}}" id="career_form" name="career_form" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="left-form">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Your Full Name *" id="name" name="name" autocomplete="off" maxlength="255" value="{{ old('name') }}" maxlength="255" required>
        </div>
        <div class="form-group">
            <input type="email" id="email_id" name="email_id" class="form-control" autocomplete="off" value="{{ old('email_id') }}" placeholder="Your Email Address *" maxlength="255" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Your Mobile Number *" id="contact_no" name="contact_no" minlength="10" maxlength="10" value="{{ old('contact_no') }}" autocomplete="off" required>
        </div>
        <div class="form-group">
            <select class="form-control" id="post_applied" name="post_applied" value="{{ old('post_applied') }}" required >
                <option value="" selected="selected">Select Job Profile *</option>
                <option value="Executive Customer Service">Executive Customer Service</option>
                <option value="Executive Outbound - Sales">Executive Outbound - Sales</option>
                <option value="Phlebotomist">Phlebotomist</option>
                <option value="Senior Manager Sales">Senior Manager Sales</option>
                <option value="Others">Others</option>
            </select>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="experience" name="experience" value="{{ old('experience') }}" placeholder="Total Experience (in Years) *" maxlength="2" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="current_organization" name="current_organization" value="{{ old('current_organization') }}" maxlength="255" placeholder="Current Organization *" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="current_designation" name="current_designation" value="{{ old('current_designation') }}" maxlength="255" placeholder="Current Designation *">
        </div>
    </div>
    <div class="right-form">
        <div class="form-group">
            <select class="form-control" id="notice_period" name="notice_period" value="{{ old('notice_period') }}" required>
                <option value="" selected="selected">Notice Period *</option>
                <option value="Ready to Join">Ready to Join</option>
                <option value="15 Days">15 Days</option>
                <option value="30 Days">30 Days</option>
                <option value="45 Days">45 Days</option>
                <option value="2 Months">2 Months</option>
                <option value="3 Months">3 Months</option>
            </select>
        </div>
        <div class="form-group">
            <textarea class="form-control" placeholder="Address" id="address" name="address" autocomplete="off" maxlength="512" value="{{ old('address') }}"></textarea>
        </div>
        <div class="clear"></div>
        <div class="form-group">
            <label>Upload CV ( doc, docx and pdf format only )</label>
            <input type="file" name="resume" id="resume">
        </div>
        <div class="clear"></div>
        <div class="form-group">
            <button type="submit" class="btn btn-danger submit-bnt" onClick="validateCareerForm();">Submit</button>
        </div>
    </div>
</form>