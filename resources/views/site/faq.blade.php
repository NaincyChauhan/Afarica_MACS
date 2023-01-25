@extends('layouts.site')
@section('meta')
    <title>{{ config('app.name') }}</title>

    <meta name="title" content="{{ config('app.name') }}" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="robots" content="all"/>

	<meta property="og:site_name" content="{{ config('app.name') }}"/>
	<meta property="og:image" content="{{ asset('storage/products/fabricator.jpeg') }}"/>
	<meta property="og:image:width" content="180"/>
	<meta property="og:image:height" content="50"/>

	<meta property="og:type" content=website/>
	<meta property="og:title" content="{{ config('app.name') }}"/>
	<meta property="og:description" content=""/>
	<meta property="og:url" content="https://www.idigitalgroups.com"/>

	<meta name="twitter:card" content="summary_large_image"/>
	<meta name="twitter:site" content="idigitalgroups.com" />
	<meta name="twitter:title" content="{{ config('app.name') }}"/>
	<meta name="twitter:description" content=""/>
	<meta name="twitter:image" content="{{ asset('storage/products/fabricator.jpeg') }}"/>
    
    
@endsection
@section('content')
@include('layouts.headers.static')
<main>
    <div class="container margin_60_35">
        <div class="row" style="margin-top: 50px;">
            <aside class="col-lg-3" id="faq_cat">
                    <div class="box_style_cat" id="faq_box">
                        <ul id="cat_nav">
                            @foreach ($categories as $category)                                
                                <li><a href="#{{$category->slug}}"><i class="icon_document_alt"></i>{{$category->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <!--/sticky -->
            </aside>
            <!--/aside -->
            
            <div class="col-lg-9" id="faq">
                @foreach ($categories as $category)                    
                    <h4 class="nomargin_top">{{$category->title}}</h4>
                    <div role="tablist" class="add_bottom_45 accordion_2" id="{{$category->slug}}">
                        @foreach ($category->faq as $faq)                            
                            <!-- /card -->
                            <div class="card">
                                <div class="card-header" role="tab">
                                    <h5 class="mb-0">
                                        <a class="collapsed" data-bs-toggle="collapse" href="#collapse{{$loop->iteration}}_{{$category->slug}}" aria-expanded="false">
                                            <i class="indicator ti-plus"></i>{{$faq->que}}
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapse{{$loop->iteration}}_{{$category->slug}}" class="collapse" role="tabpanel" data-bs-parent="#{{$category->slug}}">
                                    <div class="card-body">
                                        <p>{{$faq->ans}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- /accordion Category -->
                @endforeach
            </div>
            <!-- /col -->
        </div>
        <!-- /row -->
    </div>
    <!--/container-->
</main>
@endsection