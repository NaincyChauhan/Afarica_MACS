<table id="shivadatatable" load-url="{{route('load-course-table',['type'=>$type])}}" class="table table-bordered">
    <thead>
        <tr>
            <th class="ml-5">#</th>
            <th>Title</th>
            <th>Thumbnail</th>
            <th>Status</th>
            <th>Keyword</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($courses as $course)
        <tr id="row{{ $course->id }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{$course->title}} </td>
            <td>
                @if (isset($course->thumbnail))
                <img class="rounded" src="{{ asset('storage/courses/'.$course->thumbnail) }}"
                    alt="{{ $course->title }} " style="width: 50px">
                @endif
            </td>
            <td>
                <label class="switch">
                    <input type="checkbox" onchange="changeStatus($(this))" href="{{ route('change-course-status', $course->id) }}" {{ $course->status == 1 ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </td>  
            <td>{{$course->keyword}} </td>
            @if(!empty($course->sell_price))
                <td><span class="font-weight-bold">${{$course->sell_price}} </span>  <span class="font-italic line-through ">${{$course->regular_price}} </span></td>
            @else
                <td>{{$course->regular_price}}</td>
            @endif
            
            <td>
                <div class="d-flex align-items-center">
                    <a href="{{route('course.edit',$course->id )}}" style="color: white;">
                        <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                            Edit<i class="typcn typcn-edit btn-icon-append ml-1"></i>
                        </button>
                    </a>
                    <a  class="btn btn-info btn-sm btn-icon-text mr-3"
                        href="{{ route('coursecontent.show', $course->id) }}">
                        Videos
                        <i class="mdi mdi-video-plus btn-icon-append"></i>
                    </a>
                    <a class="btn btn-danger btn-sm btn-icon-text"
                        onclick="event.preventDefault(); callDelete($(this))"
                        href="{{ route('course.destroy', $course->id) }}">
                        Delete
                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>