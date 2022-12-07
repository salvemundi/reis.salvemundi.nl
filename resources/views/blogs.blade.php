@extends('layouts.guapp')
@section('content')

<div class="row m-0 m-md-5">
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="card-text wrap">
                                            {{ $blog['description']}}
                                        </p>
                                    </div>

                                    <div class="col-md-6">
                                        <img class="img-responsive" style="width: 50%;" src="{{ asset('storage/blogImages/'.$blog->id.'.'.$blog->imageExtension)}}" alt="">
                                    </div>
                                </div>
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
