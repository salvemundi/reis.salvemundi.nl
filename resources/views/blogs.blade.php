@extends('layouts.guapp')
@section('content')

<div class="row m-0 m-md-5 marginBlog">
    <div class="col-sm-12">
        @foreach ($blogs as $blog)
            @if($blog['show'] == true)
                <div class="accordion mb-2" id="accordionExample{{ $blog['id'] }}">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne{{ $blog['id'] }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $blog['id'] }}" aria-expanded="true" aria-controls="collapseOne{{ $blog['id'] }}">
                            <h1 class="col-9">{{ $blog['name'] }}</h1>
                            <p class="col-2 my-auto m-0 m-ml-5">{{date('d-m-Y', strtotime($blog['created_at']))}}</p>
                        </button>
                        </h2>
                        @if($blog->id == $lastBlog->id)
                            <div id="collapseOne{{ $blog['id'] }}" class="accordion-collapse collapse show ownShow" aria-labelledby="headingOne{{ $blog['id'] }}" data-bs-parent="#accordionExample{{ $blog['id'] }}">
                        @else
                            <div id="collapseOne{{ $blog['id'] }}" class="accordion-collapse collapse ownShow" aria-labelledby="headingOne{{ $blog['id'] }}" data-bs-parent="#accordionExample{{ $blog['id'] }}">
                        @endif
                            <div class="accordion-body">
                                <div class="row d-flex justify-content-center">
                                    @if($blog->imageExtension)
                                        <div class="col-md-6">
                                    @else
                                        <div class="col-md-6">
                                    @endif
                                            <p class="card-text wrap">
                                                {{ $blog['description']}}
                                            </p>
                                        </div>
                                @if($blog->imageExtension)
                                    <div class="col-md-6">
                                        <img class="imageBlog" src="{{ asset('storage/blogImages/'.$blog->id.'.'.$blog->imageExtension)}}" alt="">
                                    </div>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
@endsection
