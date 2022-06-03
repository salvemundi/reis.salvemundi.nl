@extends('layouts.guapp')
@section('content')

<div class="row">
    <div class="col-sm-6 mt-2">
        <div class="card mx-2 p-2 px-md-3">
            <div class="row">
                <div class="col-6">
                    <h4 class="purple">Nu bezig</h4>
                </div>
                <div class="col-6">
                    <h4 class="purple float-end">{{$beginTime}} - {{$endTime}}</h4>
                </div>
            </div>
            {{$name}}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card mx-2 p-2 px-md-3">
            <div class="row">
                <div class="col-6">
                    <h4 class="purple">Volgend event</h4>
                </div>
                <div class="col-6">
                    <h4 class="purple float-end">{{$beginTime}} - {{$endTime}}</h4>
                </div>
            </div>
            {{$name}}
        </div>
    </div>
</div>
<div class="text-center">
    <a href="#timetable" class="link-qr">Bekijk volledige planning</a>
</div>

<div class="mx-3 my-2 justify-content-center text-center">
    <div class="max-width mx-auto">
        <h2 class="purple">Problemen of vragen?</h2>
        Er is altijd een BHV'er of crewlid ter beschikking om jouw vraag te beantwoorden! Bel via het telefoonnummer hieronder:
        <br><a class="btn btn-primary" href="tel:+31 6 24827777"><i class="fa fa-phone"></i> +31 6 24827777</a>
    </div>
</div>

<div class="mx-3 my-4 justify-content-center text-center">
    <div class="max-width mx-auto">
        <h2 class="purple">Belangrijke WhatsApp groepen</h2>
        <div class="row">
            <div class="col-6">
                <div class="card p-2 m-0">
                    Announcements
                </div>
            </div>
            <div class="col-6">
                <div class="card p-2 m-0">
                    kletsgroep
                </div>
            </div>
        </div>
    </div>
</div>



<div>
    <div class="center">
        <ul class="nav nav-tabs"  style="flex-direction: row; float: left;" id="myTab" role="tab">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="maandag-tab" data-bs-toggle="tab" data-bs-target="#maandag" type="button" role="tab" aria-controls="maandag" aria-selected="true">Maandag</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="dinsdag-tab" data-bs-toggle="tab" data-bs-target="#dinsdag" type="button" role="tab" aria-controls="dinsdag" aria-selected="false">Dinsdag</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="woensdag-tab" data-bs-toggle="tab" data-bs-target="#woensdag" type="button" role="tab" aria-controls="woensdag" aria-selected="false">Woensdag</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="donderdag-tab" data-bs-toggle="tab" data-bs-target="#donderdag" type="button" role="tab" aria-controls="donderdag" aria-selected="false">Donderdag</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="vrijdag-tab" data-bs-toggle="tab" data-bs-target="#vrijdag" type="button" role="tab" aria-controls="vrijdag" aria-selected="false">Vrijdag</button>
            </li>
        </ul>
    </div>
    <div class="tab-content center" id="myTabContent">
        <div class="tab-pane fade show active text-black" id="maandag" role="tabpanel" aria-labelledby="home-tab">
            maandag Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis eum enim dolores eveniet, sint officiis accusamus iste ipsam accusantium magnam delectus. Repudiandae neque aperiam, ea obcaecati minus incidunt sunt tempora.
        </div>
        <div class="tab-pane fade text-black" id="dinsdag" role="tabpanel" aria-labelledby="profile-tab">
            dinsdag Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis eum enim dolores eveniet, sint officiis accusamus iste ipsam accusantium magnam delectus. Repudiandae neque aperiam, ea obcaecati minus incidunt sunt tempora.
        </div>
        <div class="tab-pane fade text-black" id="woensdag" role="tabpanel" aria-labelledby="contact-tab">
            woensdag Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis eum enim dolores eveniet, sint officiis accusamus iste ipsam accusantium magnam delectus. Repudiandae neque aperiam, ea obcaecati minus incidunt sunt tempora.
        </div>
        <div class="tab-pane fade text-black" id="donderdag" role="tabpanel" aria-labelledby="contact-tab">
            donderdag Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis eum enim dolores eveniet, sint officiis accusamus iste ipsam accusantium magnam delectus. Repudiandae neque aperiam, ea obcaecati minus incidunt sunt tempora.
        </div>
        <div class="tab-pane fade text-black" id="vrijdag" role="tabpanel" aria-labelledby="contact-tab">
            vrijdag Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis eum enim dolores eveniet, sint officiis accusamus iste ipsam accusantium magnam delectus. Repudiandae neque aperiam, ea obcaecati minus incidunt sunt tempora.
        </div>
    </div>

</div>

<div>
    <video class="navImg" autoplay muted loop disablePictureInPicture id="vid">
        <source src="{{asset('/images/rickroll.mp4')}}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>

@endsection
