@extends('layouts.guapp')
@section('content')

<div class="m-5 row">
    <div class="col-10">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed row justify-content-center" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    <h1 class="col-9">Intro planning</h1>
                    <p class="text-muted col-2 my-auto ms-5">18-04-2022</p>
                </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse ownShow" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <p class="card-text wrap">
                        Beste (aankomende) student(e),

                        De inschrijvingen sluiten 17 augustus 23:59 dus je hebt nog maar een paar dagen om je in te schrijven!
                        Hierna sluiten de inschrijvingen en kan je dus niet mee met het leuke gedeelte van de intro.
                        Dus ben er snel bij!

                        Via deze link kun je je inschrijving afronden: https://salvemundi.nl/introconfirm

                        Onderaan deze mail kan je de nodige informatie vinden van de intro

                        We hopen jullie allemaal 24 augustus te zien!

                        Met vriendelijke groet,
                        Salve Mundi
                        +31 6 24827777 (alleen whatsapp)
                        Intro@salvemundi.nl

                        De planning

                        Maandag
                        De maandag zal helaas komen te vervallen…

                        Dinsdag
                        Dinsdag word je tussen 08:30 en 09:30 verwacht op de evenementenlocatie. Hier hebben we een dag voor jullie gepland met spellen, een pub quiz en een biercantus (18+) waarbij je de mogelijkheid krijgt om eventueel levend stratego te doen in plaats van de cantus. De lunch en het avondeten wordt door ons geregeld. ’s Avonds zal er nog een afterparty gegeven worden. 

                        Woensdag
                        Woensdag is de Fontys dag. Je wordt om 10:00 verwacht op de Fontys Rachelsmolen. Vanuit Fontys krijg je hier nog meer info over. ’s Middags hebben we een middagprogramma voor jullie op de evenementenlocatie met daarin de crazy88. De lunch en het avondeten wordt weer door ons geregeld. ’s Avonds zal er een vet feest gegeven worden voor jullie. 

                        Donderdag
                        Omdat Purple helaas niet door gaat hebben we een alternatief programma voor jullie. Je wordt tussen 10:30 en 11:30 verwacht op de evenementenlocatie. Dan hebben we weer een middagprogramma voor jullie met daarin zeepvoetbal en het moordspel. In de namiddag is er een beerpong toernooi voor jullie. Een snack en het avondeten wordt door ons geregeld. ’s Avonds hebben we weer een vet feest voor jullie gepland. 

                        Vrijdag
                        Helaas is de week alweer afgelopen. Mocht je spullen bij ons hebben afgegeven donderdag kun je deze vandaag ophalen bij de Fontys Rachelsmolen.

                        Overnachten
                        Om toch een beetje dicht bij de evenementenlocatie te blijven slapen is er een camping redelijk dichtbij. De camping is op 25 minuten fietsen afstand van de evenementenlocatie. De kosten worden berekend per tent. Het gaat hier dan wel om kleinere pop-up tentjes. Wij hebben met ze afgesproken dat jullie zelfstandig kunnen reserveren voor 15 euro per nacht per tent. Het reserveren moet telefonisch! Salve Mundi staat verder compleet los van deze overnachting. Er is geen begeleiding noch verzorging vanuit Salve Mundi. Dit is puur en alleen om in de buurt te zijn van het evenement.  

                        Wanneer kan ik nu blijven slapen?
                        Je mag er vanaf maandag al liggen als je zou willen. Dinsdag tot en met vrijdag is het handig om op de camping te blijven slapen. Omdat Purple helaas niet door gaat geven wij een feest op de evenementenlocatie waardoor het handig is om ook de nacht van donderdag op vrijdag te boeken. 

                        Info over de camping
                        http://somerensevennen.nl
                        Philipsbosweg 7, 5715RE Lierop
                        0492 331 216

                        Financiën
                        De introductieweek gaat 40 euro kosten. Dit is 50 euro minder dan normaal. Dit moet de kosten van de camping of het vervoer vanaf Eindhoven centraal goed compenseren. Jullie zullen zo snel mogelijk een mail met een betaalverzoek krijgen. Mocht je niet meer mee willen vanwege het veranderde programma dan hoef je het betaalverzoek niet te betalen. Je kan afrekenen via https://salvemundi.nl/introconfirm 

                        Vervoer
                        Wij regelen touringcars voor 100 personen van en naar Eindhoven centraal, 's avonds rijden deze om 23:00u aan. Het is verder mogelijk om gebruik te maken van de nabijgelegen bushalte, de fiets of afgezet te worden met de auto. Het is niet mogelijk om zelfstandig met de auto komen omdat hier niet genoeg parkeerplekken voor zijn. Parkeren op de rachelsmolen campus om vervolgens met de touringcar naar de evenement locatie te komen is natuurlijk wel een optie. De meeste zullen gebruik maken van de camping i.v.m. reistijd. Vanaf de camping kun je alleen met de fiets afgezet worden. De locatie van het evenemententerrein wordt alleen bekendgemaakt aan betalende deelnemers vanwege de veiligheid. 
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-2" style="position: sticky; top: 5em;">
        <div>
            <h2>Aantal plekken voor de intro</h2>
            <canvas id="myChart"></canvas>
            <h2>Aantal dagen tot de intro</h2>
            <b><p class="big">126</p></b>
        </div>
    </div>
</div>

<script>
    let occupied = 96;
    let open = 250
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
