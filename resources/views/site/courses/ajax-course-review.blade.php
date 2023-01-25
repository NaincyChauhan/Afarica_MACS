@foreach ($coursereviews as $review)                            
<div class="d-flex mb-4">
    <div class="avatar avatar-md">
        <img src="{{isset($review->user->image) ?  asset('storage/users/'.$review->user->image) : asset('assets/images/user_logo.jpg')}}" class="img-fluid rounded-circle" alt="...">
    </div>
    <div class="ms-3 border p-3 p-sm-4">
        <div class="d-flex">
        <h6 class="mt-0">{{$review->user->name}}</h6>
        <a class="ms-auto" href="#">
            @for ($i = 0; $i < $review->ratting; $i++)                                            
                <i class="fas fa-star pe-1 text-ratting"></i>
            @endfor
        </a>
        </div>
        <p>{{$review->description}}</p>
    </div>
</div>
@endforeach                            
<div class="row">
    <div class="pagination-outer">
        <div class="pagination-style1" id="ajaxPagination">
            {{$coursereviews->links()}}
        </div>
    </div>
</div>                                                            
<script src="{{asset('assets/js/masterX/ajax-pagination.js')}}"></script>