@extends('layout.master')

@section('page-content')


<!-- Prescription thankyou -->

<section class="cart-section">
   <div class="container">
      <div class="row">
         <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="cart-block cart-width cart-cont add-btn payment-box">
                 
                                     
                 <div class="prescription-thankyou"><br>
                     <img src="/img/report_icon.png">
                     <!-- <h2>Book Test via Prescription</h2>  -->
                     <h2>Thank You !!!</h2>
                     <p>Your prescription has been uploaded successfully</p>
                     <p>Our health advisor will get back to you between 10:00 am to 7:00 pm.</p><br>
                     <a class="btn btn-danger pay-btn" href="{{route('prescription')}}">Upload New Prescription</a>    <br>            
                 <br>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>


@endsection

@push('footer-scripts')
    <script type="text/javascript">
        
    </script>    
@endpush