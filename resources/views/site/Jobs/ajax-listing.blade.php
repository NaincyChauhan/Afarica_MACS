@foreach ($jobs as $job)
{{-- @for ($i = 0; $i < 9; $i++) --}} 
<div class="col-lg-4 col-md-6 mb-4">
    <div class="blog-post">
        <div class="blog-post-image">
            <img class="img-fluid" src="{{ asset('storage/jobs/'.$job->image) }}" alt="Job Image">
        </div>
        <div class="blog-post-content">
            <div class="blog-post-info">
                <div class="blog-post-author">
                    <a target="_blank" href="{{route('job-detail',['slug' => $job->slug])}}" class="btn btn-light-round btn-round text-primary">{{$job->job_type}}</a>
                </div>
                <div class="blog-post-date">
                    <a target="_blank"  href="{{route('job-detail',['slug' => $job->slug])}}">{{ date("M d, Y", strtotime($job->created_at)) }}</a>
                </div>
            </div>
            <div class="blog-post-details">
                <h5 class="blog-post-title">
                    <a target="_blank"  href="{{route('job-detail',['slug' => $job->slug])}}">{{$job->title}}</a>
                </h5>
            </div>
        </div>
    </div>
</div>
@endforeach

    <div class="row">
        <div class="pagination-outer">
            <div class="pagination-style1" id="ajaxPagination">
                {{$jobs->links()}}
            </div>
        </div>
    </div>
    <script src="{{asset('assets/js/masterX/ajax-pagination.js')}}"></script>