@if (count($listings) <= 0)
    <div class="text-center">
        <img src="{{asset('assets/images/no-items-found.png')}}" width="35%" alt="No Items Find" srcset="">
    </div>
@endif                        
@foreach ($listings as $listing)
<div class="col-lg-4 col-md-6 mb-4">
    <div class="blog-post">
        <div class="blog-post-image">
            <img style="max-height: 540px" class="img-fluid" src="{{ asset('storage/listings/'.$listing->image[0]) }}" alt="Course Image">
            @if (!empty($listing->sell_price))                
                @php
                    $discount = 0 ;
                    $discount = (($listing->regular_price - $listing->sell_price) * 100) / $listing->regular_price;
                @endphp									
                <span class="discount-info">{{number_format((float)$discount, 2, '.', '')}}%</span>
            @endif
        </div>
        <div class="blog-post-content">
            <div class="blog-post-info mb-0">
                <div>
                    @if (!empty($listing->sell_price))                        
                        <a target="_blank"  href="{{route('listing-detail',['slug'=>$listing->slug])}}" class="text-primary"><span class="font-weight-bold font-17">${{$listing->sell_price}}</span> <span class="text-muted font-italic line-through regular-price">${{$listing->regular_price}}</span></a>
                    @else
                        <a target="_blank"  href="{{route('listing-detail',['slug'=>$listing->slug])}}" class="text-primary"><span class="font-weight-bold font-17">${{$listing->regular_price}}</span> </a>
                    @endif
                </div>
                <div class="blog-post-date course-created-date">
                    <a target="_blank"  href="{{route('listing-detail',['slug'=>$listing->slug])}}">{{ date("M d, Y", strtotime($listing->created_at)) }}</a>
                </div>
            </div>
            <div class="blog-post-details">                                        
                <h5 class="blog-post-title mb-0">
                    <a target="_blank" class="course-title giveMeEllipsis"  href="{{route('listing-detail',['slug'=>$listing->slug])}}">
                        {{$listing->title}}
                    </a>
                </h5>
                <p class="giveMeEllipsis">
                    {{$listing->description}}
                </p>
            </div>
        </div>
    </div>
</div>
@endforeach                        

<div class="row">
    <div class="pagination-outer">
        <div class="pagination-style1" id="ajaxPagination">
            {{$listings->links()}}
        </div>
    </div>
</div>
<script src="{{asset('assets/js/masterX/ajax-pagination.js')}}"></script>    