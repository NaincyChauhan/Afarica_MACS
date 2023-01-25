<table id="shivadatatable" load-url="{{route('load-listing-table')}}" class="table table-bordered">
    <thead>
        <tr>
            <th class="ml-5">#</th>
            <th>Title</th>
            <th>Image</th>
            <th>Status</th>
            <th>Address</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($listings as $listing)
        <tr id="row{{ $listing->id }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{$listing->title}} </td>
            <td>
                @foreach ($listing->image as $image)                                            
                    <img class="rounded" src="{{ asset('storage/listings/'.$image) }}"
                    alt="Images" style="width: 50px">
                @endforeach
            </td>
            <td>
                <label class="switch">
                    <input type="checkbox" onchange="changeStatus($(this))" href="{{ route('change-listing-status', $listing->id) }}" {{ $listing->status == 1 ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </td>  
            <td>{{$listing->address}} </td>
            @if(!empty($listing->sell_price))
                <td><span class="font-weight-bold">${{$listing->sell_price}} </span>  <span class="font-italic line-through ">${{$listing->regular_price}} </span></td>
            @else
                <td>{{$listing->regular_price}}</td>
            @endif
            
            <td>
                <div class="d-flex align-items-center">
                    <a href="{{route('listing.edit',$listing->id )}}" style="color: white;">
                        <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                            Edit<i class="typcn typcn-edit btn-icon-append ml-1"></i>
                        </button>
                    </a>
                    <a class="btn btn-danger btn-sm btn-icon-text"
                        onclick="event.preventDefault(); callDelete($(this))"
                        href="{{ route('listing.destroy', $listing->id) }}">
                        Delete
                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>