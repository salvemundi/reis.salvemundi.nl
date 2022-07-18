@extends('layouts.guapp')
@section('content')

<div class="row m-0 m-md-5">
    <div class="col-sm-10">
        @foreach ($posts as $post)
            @if($post['show'] == true)
                <div class="accordion mb-2" id="accordionExample{{ $post['id'] }}">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne{{ $post['id'] }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $post['id'] }}" aria-expanded="true" aria-controls="collapseOne{{ $post['id'] }}">
                            <h1 class="col-9">{{ $post['name'] }}</h1>
                            <p class="col-2 my-auto m-0 m-ml-5">{{date('d-m-Y', strtotime($post['created_at']))}}</p>
                        </button>
                        </h2>
                        @if($post->id == $lastBlog->id)
                            <div id="collapseOne{{ $post['id'] }}" class="accordion-collapse collapse show ownShow" aria-labelledby="headingOne{{ $post['id'] }}" data-bs-parent="#accordionExample{{ $post['id'] }}">
                        @else
                            <div id="collapseOne{{ $post['id'] }}" class="accordion-collapse collapse ownShow" aria-labelledby="headingOne{{ $post['id'] }}" data-bs-parent="#accordionExample{{ $post['id'] }}">
                        @endif
                            <div class="accordion-body">
                                <p class="card-text wrap">
                                    {{ $post['content']}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div class="col-sm-2">
        <div class="stick">
            <h2>Aantal plekken voor de intro</h2>
            <canvas id="myChart"></canvas>
            <h2>Aantal dagen tot de intro</h2>
            <b><p class="big">{{ $date }}</p></b>
        </div>
    </div>
</div>

<script>
    let occupied = {{ $occupied->occupied ?? 0}};
    let open = 100 - occupied
    const data = {
        labels: [
            'Bezet',
            'Nog vrij',
        ],
        datasets: [{
            label: 'Aantal plekken vrij!',
            data: [occupied, open],
            backgroundColor: [
                '#BA5EB8',
                '#663366',
            ],
            hoverOffset: 4,
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let label = context.label;
                        let value = context.formattedValue;

                        if (!label)
                            label = 'Unknown'

                        let sum = 0;
                        let dataArr = context.chart.data.datasets[0].data;
                        dataArr.map(data => {
                            sum += Number(data);
                        });

                        let percentage = (value * 100 / sum).toFixed(2) + '%';
                        return label + ": " + percentage;
                    }
                }
            }
        }]
    };
    const config = {
        type: 'doughnut',
        data: data
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>

@endsection
