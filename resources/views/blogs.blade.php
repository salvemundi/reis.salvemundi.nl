@extends('layouts.guapp')
@section('content')
<div>
    <canvas id="myChart"></canvas>
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
