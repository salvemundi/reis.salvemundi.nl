@extends('layouts.guapp')
@section('content')

@if ($currentEvent != null)
    <div class="max-width mx-auto">
        <div class="mt-2">
            <div class="card mx-2 p-2 px-md-3">
                <div class="row">
                    <div class="col-6">
                        <h4 class="purple">Nu bezig</h4>
                    </div>
                    <div class="col-6">
                        <h4 class="purple float-end">{{ date("H:i", strtotime($currentEvent->beginTime)) }} - {{ date("H:i", strtotime($currentEvent->endTime)) }}</h4>
                    </div>
                </div>
                {{$currentEvent->name}}
            </div>
        </div>
        @if ($nextEvent != null)
            <div class="max-width mx-auto">
                <div class="card mx-2 p-2 px-md-3 muted">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="purple">
                                Volgend event
                                @if (date("l", strtotime($currentEvent->beginTime)) != date("l", strtotime($nextEvent->beginTime)))
                                    (Morgen)
                                @endif
                            </h4>
                        </div>
                        <div class="col-6">
                            <h4 class="purple float-end">{{ date("H:i", strtotime($nextEvent->beginTime)) }} - {{ date("H:i", strtotime($nextEvent->endTime)) }}</h4>
                        </div>
                    </div>
                    {{$nextEvent->name}}
                </div>
            </div>
        @else
            <p class="text-center">
                Er is geen volgende activiteit meer
            </p>
        @endif
    </div>
@else
    <p class="text-center">
        Er is geen activiteit bezig
    </p>
@endif
<div class="text-center">
    <a href="#timetable" class="link-qr">Bekijk volledige planning</a>
</div>

<div class="mx-3 my-2 justify-content-center text-center">
    <div class="max-width mx-auto">
        <h2 class="purple">Problemen of vragen?</h2>
        Er is altijd een BHV'er of crewlid ter beschikking om jouw vraag te beantwoorden! Bel bij nood het onderstaande telefoonnummer, in andere gevallen kan je een appje sturen.
        <br><a class="btn btn-primary" href="tel:+31 6 24827777"><i class="fa fa-phone"></i> +31 6 24827777</a>
    </div>
    <div id="timetable" class="mx-3 my-4 justify-content-center text-center">
        <div class="max-width mx-auto">
            <h2 class="purple">Belangrijke WhatsApp groepen</h2>
            <div class="row">
                <div class="col-6">
                    <div class="card p-2 m-0">
                        <a class="link-qr" href="https://chat.whatsapp.com/LqjT2fcEdy0ECGPQo6owRB" target="_blank">Announcements</a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card p-2 m-0">
                        <a class="link-qr" href="https://chat.whatsapp.com/HTLqjb5SKDC6pQtszDLUZL" target="_blank">Kletsgroep</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="max-width mx-auto my-3">
        <h2 class="purple">Vertrouwenspersonen</h2>
        Wij doen ons uiterste best om de intro zo leuk en veilig mogelijk te maken voor iedere deelnemer. Hier hoort bij dat wij alle deelnemers een mogelijkheid willen geven om in alle vertrouwen contact te kunnen zoeken over iets wat ze dwars zit. Dit kan alles zijn; je klikt niet met de groep, je voelt je onder druk gezet of je bent slachtoffer geworden van ongewenst gedrag. Voor alles wat je dwarszit kan je een van onze contactpersonen benaderen.
        <div class="row justify-content-center mt-4">
            <div class="col-md-6 col-6">
                <img class="imgQR" src="images/vertrouwensPersonen/femke.jpeg">
                <b><p class="vertrouwensPersoonText">Femke</p></b>
                +31 61234567
            </div>
            <div class="col-md-6 col-6">
                <img class="imgQR" src="images/vertrouwensPersonen/jimmy.jpg">
                <b><p class="vertrouwensPersoonText">Jimmy</p></b>
                +31 61234567
            </div>
        </div>
    </div>
</div>

<div class="mx-3 my-2 justify-content-center text-center">
    <div class="max-width mx-auto">
        <h2 class="purple">Infoboekje</h2>
        Hieronder kan je ons infoboekje downloaden waarin alle informatie te vinden is voor de intro:
        <br><a class="btn btn-primary mt-2" href="pdf/Infoboekje2022.pdf" download><i class="fa fa-download"></i> Download</a>
    </div>
</div>

<div class="max-width mx-auto my-3">
    <h2 class="purple text-center">Planning</h2>
    <div class="my-2 max-width mx-auto">
        <div class="">
            <ul class="nav nav-tabs w-100"  style="flex-direction: row; float: left;" id="myTab" role="tab">
                <li class="nav-item" role="presentation">
                <button class="nav-link active" id="maandag-tab" data-bs-toggle="tab" data-bs-target="#maandag" type="button" role="tab" aria-controls="maandag" aria-selected="true">Ma</button>
                </li>
                <li class="nav-item" role="presentation">
                <button class="nav-link" id="dinsdag-tab" data-bs-toggle="tab" data-bs-target="#dinsdag" type="button" role="tab" aria-controls="dinsdag" aria-selected="false">Di</button>
                </li>
                <li class="nav-item" role="presentation">
                <button class="nav-link" id="woensdag-tab" data-bs-toggle="tab" data-bs-target="#woensdag" type="button" role="tab" aria-controls="woensdag" aria-selected="false">Wo</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="donderdag-tab" data-bs-toggle="tab" data-bs-target="#donderdag" type="button" role="tab" aria-controls="donderdag" aria-selected="false">Do</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="vrijdag-tab" data-bs-toggle="tab" data-bs-target="#vrijdag" type="button" role="tab" aria-controls="vrijdag" aria-selected="false">Vr</button>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show w-100 active text-black" id="maandag" role="tabpanel" aria-labelledby="home-tab">
                <table class="table table-events table-striped">
                    <tbody>
                        @foreach ($events as $event)
                            @if (date("l", strtotime($event->beginTime)) == "Monday")
                                @if ($event == $currentEvent)
                                    <tr class="currentEvent">
                                        <th class="mytable" style="width: 35%" scope="row">{{ date("H:i", strtotime($event->beginTime)) }} - {{ date("H:i", strtotime($event->endTime)) }}</th>
                                        <td class="mytable text-left" style="width: 65%">{{$event->name}}</td>
                                    </tr>
                                @else
                                    <tr class="">
                                        <th class="purple mytable" style="width: 35%" scope="row">{{ date("H:i", strtotime($event->beginTime)) }} - {{ date("H:i", strtotime($event->endTime)) }}</th>
                                        <td class="mytable text-left" style="width: 65%">{{$event->name}}</td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane w-100 fade text-black" id="dinsdag" role="tabpanel" aria-labelledby="profile-tab">
                <table class="table table-striped">
                    <tbody>
                        @foreach ($events as $event)
                            @if (date("l", strtotime($event->beginTime)) == "Tuesday")
                                @if ($event == $currentEvent)
                                    <tr class="currentEvent">
                                        <th class="purple mytable" style="width: 35%" scope="row">{{ date("H:i", strtotime($event->beginTime)) }} - {{ date("H:i", strtotime($event->endTime)) }}</th>
                                        <td class="mytable text-left" style="width: 65%">{{$event->name}}</td>
                                    </tr>
                                @else
                                    <tr class="">
                                        <th class="purple mytable" style="width: 35%" scope="row">{{ date("H:i", strtotime($event->beginTime)) }} - {{ date("H:i", strtotime($event->endTime)) }}</th>
                                        <td class="mytable text-left" style="width: 65%">{{$event->name}}</td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane w-100 fade text-black" id="woensdag" role="tabpanel" aria-labelledby="contact-tab">
                <table class="table table-striped">
                    <tbody>
                        @foreach ($events as $event)
                            @if (date("l", strtotime($event->beginTime)) == "Wednesday")
                                @if ($event == $currentEvent)
                                    <tr class="currentEvent">
                                        <th class="purple mytable" style="width: 35%" scope="row">{{ date("H:i", strtotime($event->beginTime)) }} - {{ date("H:i", strtotime($event->endTime)) }}</th>
                                        <td class="mytable text-left" style="width: 65%">{{$event->name}}</td>
                                    </tr>
                                @else
                                    <tr class="">
                                        <th class="purple mytable" style="width: 35%" scope="row">{{ date("H:i", strtotime($event->beginTime)) }} - {{ date("H:i", strtotime($event->endTime)) }}</th>
                                        <td class="mytable text-left" style="width: 65%">{{$event->name}}</td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane w-100 fade text-black" id="donderdag" role="tabpanel" aria-labelledby="contact-tab">
                <table class="table table-striped">
                    <tbody>
                        @foreach ($events as $event)
                            @if (date("l", strtotime($event->beginTime)) == "Thursday")
                                @if ($event == $currentEvent)
                                    <tr class="currentEvent">
                                        <th class="purple mytable" style="width: 35%" scope="row">{{ date("H:i", strtotime($event->beginTime)) }} - {{ date("H:i", strtotime($event->endTime)) }}</th>
                                        <td class="mytable text-left" style="width: 65%">{{$event->name}}</td>
                                    </tr>
                                @else
                                    <tr class="">
                                        <th class="purple mytable" style="width: 35%" scope="row">{{ date("H:i", strtotime($event->beginTime)) }} - {{ date("H:i", strtotime($event->endTime)) }}</th>
                                        <td class="mytable text-left" style="width: 65%">{{$event->name}}</td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane w-100 fade text-black" id="vrijdag" role="tabpanel" aria-labelledby="contact-tab">
                <table class="table table-striped">
                    <tbody>
                        @foreach ($events as $event)
                            @if (date("l", strtotime($event->beginTime)) == "Friday")
                                @if ($event == $currentEvent)
                                    <tr class="currentEvent">
                                        <th class="purple mytable" style="width: 35%" scope="row">{{ date("H:i", strtotime($event->beginTime)) }} - {{ date("H:i", strtotime($event->endTime)) }}</th>
                                        <td class="mytable text-left" style="width: 65%">{{$event->name}}</td>
                                    </tr>
                                @else
                                    <tr class="">
                                        <th class="purple mytable" style="width: 35%" scope="row">{{ date("H:i", strtotime($event->beginTime)) }} - {{ date("H:i", strtotime($event->endTime)) }}</th>
                                        <td class="mytable text-left" style="width: 65%">{{$event->name}}</td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
</div>
<div class="text-center">
    <a href="#video" class="link-qr">Meer informatie vind je onderaan de pagina</a>
</div>


<div class="veryMuchMargin max-width mx-auto">
    <video id="video" class="navImg" autoplay muted loop disablePictureInPicture id="vid">
        <source src="{{asset('/images/rickroll.mp4')}}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>


<!--Bootstrap icons-->
<link rel="stylesheet" href="node_modules/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">

<!--External library-->
<script src="node_modules/move-js/move.min.js"></script>
<!--https://visionmedia.github.io/move.js/-->

<!--Scrollable libs-->
<link href="node_modules/scrollable-tabs-bootstrap-5/dist/scrollable-tabs.css" rel="stylesheet">
<script src="node_modules/scrollable-tabs-bootstrap-5/dist/scrollable-tabs.js"></script>

@endsection
