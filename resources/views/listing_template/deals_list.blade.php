@foreach($deals_list as $prd)
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-extra-xs">
        <div class="offer-main deallisting">
            <div class="offer-content">
                <div class="offer-heading">
                    <h4>
                        <a class="" href="/{{$city_name}}/{{$prd['deal_type']}}/{{$prd['link_rewrite']}}"> {{$prd['name']}} </a>
                    </h4>
                </div>
                <div class="offers-content">
                    @if(!empty($prd['description']))
                        <p>{{ str_limit($prd['description'], 200) }}</p>
                    @endif

                    <div class="pricebar">
                        <div class="slashedprice"><del><span class="rupeesign">₹</span>{{$prd['mrp']}}</del></div>
                        <div class="healthiansprice"> <span class="rupeesign">₹</span>{{$prd['price']}} </div>
                    </div>

                    <div class="buy-book-btn dealtopspace">
                        <a class="btn btn-danger" href="/{{$city_name}}/{{$prd['deal_type']}}/{{$prd['link_rewrite']}}">Know More <img src="/img/left-icon-sml.png" class="/img"></a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endforeach