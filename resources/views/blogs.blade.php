@extends('layouts.guapp')
@section('content')

<div class="m-5 row">
    <div class="col-2">
        <div class="sidemenu">
            <b>planning introductie</b>
            <p class="muted">
                16-04-2022
            </p>
        </div>
        <div class="sidemenu">
            <b>planning introductie</b>
            <p class="muted">
                16-04-2022
            </p>
        </div>
        <div class="sidemenu">
            <b>planning introductie</b>
            <p class="muted">
                16-04-2022
            </p>
        </div>
    </div>
    <div class="col-8">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse ea necessitatibus ut ad ullam quo, architecto minima, reiciendis sunt non nam totam? Odio aliquid, exercitationem voluptate veritatis vitae repudiandae fuga! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Odit distinctio exercitationem amet iste molestiae cumque tempora minus voluptates id dolorem blanditiis, soluta obcaecati nesciunt numquam debitis. Libero facilis debitis laudantium. Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati non, magni fugit at ea ad aut voluptatum tempora asperiores sunt. Dignissimos iusto odit mollitia ad illo. Ut reprehenderit laboriosam dignissimos. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolor quos, debitis vel, incidunt minus voluptatum praesentium atque culpa vitae quam, tempora autem repudiandae. Aliquam commodi facilis illum, quae rerum dolorem. Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia iste omnis incidunt assumenda, expedita sapiente delectus ab nesciunt consectetur architecto maxime quasi similique laudantium quis alias iusto? Voluptates, minus nobis.
    </div>
    <div class="col-2">
        <div>
            <canvas id="myChart"></canvas>
        </div>
    </div>
</div>
@foreach($posts as $post)
    <p>
        {{ $post->name }}
    </p>
@endforeach

<script>
    const data = {
        labels: [
            'Bezet',
            'Nog vrij',
        ],
        datasets: [{
            label: 'Aantal plekken vrij!',
            data: [300, 159],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
            ],
            hoverOffset: 4
        }]

    };
    const config = {
        type: 'doughnut',
        data: data,
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>

@endsection
