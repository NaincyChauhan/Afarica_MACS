@if (count($courses) <= 0)
    <div class="text-center">
        <img src="{{asset('assets/images/no-items-found.png')}}" width="35%" alt="No Items Find" srcset="">
    </div>
@endif                        
@foreach ($courses as $course)
<div class="col-lg-4 col-md-6 mb-4">
    <div class="blog-post">
        <div class="blog-post-image">
            <img style="max-height: 540px" class="img-fluid" src="{{ asset('storage/courses/'.$course->thumbnail) }}" alt="Course Thumbnail">
            @if (!empty($course->sell_price))                
                @php
                    $discount = 0 ;
                    $discount = (($course->regular_price - $course->sell_price) * 100) / $course->regular_price;
                @endphp									
                <span class="discount-info">{{number_format((float)$discount, 2, '.', '')}}%</span>
            @endif
        </div>
        <div class="blog-post-content">
            <div class="blog-post-info mb-0">
                <div>
                    @if (!empty($course->sell_price))                        
                        <a target="_blank"  href="{{route('course-detail',['slug'=>$course->slug])}}" class="text-primary"><span class="font-weight-bold font-17">${{$course->sell_price}}</span> <span class="text-muted font-italic line-through regular-price">${{$course->regular_price}}</span></a>
                    @else
                        <a target="_blank"  href="{{route('course-detail',['slug'=>$course->slug])}}" class="text-primary"><span class="font-weight-bold font-17">${{$course->regular_price}}</span> </a>
                    @endif
                </div>
                <div class="blog-post-date course-created-date">
                    <a target="_blank"  href="{{route('course-detail',['slug'=>$course->slug])}}">{{ date("M d, Y", strtotime($course->created_at)) }}</a>
                </div>
            </div>
            <div class="blog-post-details">
                @if (count($course->coursereview) > 0) 
                    <div class="ratting-section">
                        <span class="ratting-average font-17">{{number_format((float)$course->ratting, 1, '.', '')}}</span>
                        @for ($i = 0; $i < number_format((float)$course->ratting, 0, '.', ''); $i++)
                        <span> <i class="fas fa-star ratting-star"></i> </span>
                        @endfor
                        <span class="total-ratting">({{$course->coursereview->count()}})</span>
                    </div>
                @endif                            
                <h5 class="blog-post-title mb-0">
                    <a target="_blank" class="course-title giveMeEllipsis"  href="{{route('course-detail',['slug'=>$course->slug])}}">
                        {{-- {!! Str::limit($course->title, 55, ' ...') !!} --}}
                        {{$course->title}}
                    </a>
                </h5>
                <p class="giveMeEllipsis">
                    {{$course->description}}
                </p>
            </div>
        </div>
    </div>
</div>
@endforeach                       

<div class="row">
    <div class="pagination-outer">
        <div class="pagination-style1" id="ajaxPagination">
            {{$courses->links()}}
        </div>
    </div>
</div>
<script src="{{asset('assets/js/masterX/ajax-pagination.js')}}"></script>