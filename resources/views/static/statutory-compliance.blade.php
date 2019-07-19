@extends('layout.master')

@section('page-content')

{{-- {!! $content !!} --}}


<section class="meet-us career-page">
    <div class="container">
        <h2>Statutory Compliance</h2>
        <img class="center-block" src="/img/underline.png" alt="Icon">
       

<div class="col-sm-12 col-xs-12 statutory">
	<div class="col-sm-7 col-xs-12">



<div class="complianceleft">
 
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Notice to General Meeting
        </a>
      </h4>
      </div>
      <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">
          
          <div class="col-sm-8 col-xs-12 nopadd">
          	<h5 class="notice">Notice to General Meeting</h5>
          </div>
          <div class="col-sm-4 col-xs-12">
          	<p class="downloadsc"><a class="btn btn-primary btndown" href="/img/notice-general-meeting.pdf" target="_blank">View Details</a></p>
          </div>
          
        </div>
      </div>
    </div>
    
   
  </div>
</div>





	</div>







	<div class="col-sm-5 col-xs-12">

		<div class="corpaddress">
			<p class="infocorp"><strong style="line-height:23px;">Expedient Healthcare Marketing Private Limited</strong></p>

			<p class="corpadd">
				<span>Registered Office</span>
				A-26, 1st Floor, Omega Centre, Infocity, Sector 34, Gurugram-122001, Haryana, India
			</p>


			<p class="corpadd">
				<span>Call Us</span>
				999-888-000-5
			</p>

			<p class="corpadd">
				<span>Email ID</span>
				<a href="mailto:cs@healthians.com">cs@healthians.com</a>
			</p>

			<p class="corpaddlast">
				<span>CIN Number</span>
				U93000HR2013PTC051132
			</p>
			


	</div>

</div>


        </div>
    </section>


<script>
	$(document).ready(function() {

  $(".toggle-accordion").on("click", function() {
    var accordionId = $(this).attr("accordion-id"),
      numPanelOpen = $(accordionId + ' .collapse.in').length;
    
    $(this).toggleClass("active");

    if (numPanelOpen == 0) {
      openAllPanels(accordionId);
    } else {
      closeAllPanels(accordionId);
    }
  })

  openAllPanels = function(aId) {
    console.log("setAllPanelOpen");
    $(aId + ' .panel-collapse:not(".in")').collapse('show');
  }
  closeAllPanels = function(aId) {
    console.log("setAllPanelclose");
    $(aId + ' .panel-collapse.in').collapse('hide');
  }
     
});
	</script>

@endsection

@push('footer-scripts')
@endpush