@extends('layouts.app')
@section('content')

<script>
    setActive("qrcode");
</script>
<div class="row">
    <div>
        <main class="wrapper">

            <section class="center" style="display: flex; margin-top: 2em; text-align: center" id="demo-content">
                <div>
                    <h1 class="title">Scan QR Code om in / uit the checken!</h1>
                    <div class="btn-group mb-2">
                        <input type="radio" class="btn-check" name="options" id="checkIn" autocomplete="off" checked />
                        <label class="btn btn-primary" for="checkIn">Inchecken</label>

                        <input type="radio" class="btn-check" name="options" id="checkOut" autocomplete="off" />
                        <label class="btn btn-primary" for="checkOut">Uitchecken</label>
                    </div>
                    <div class="mb-2">
                        <a class="btn btn-primary" id="startButton">Start</a>
                        <a class="btn btn-primary" id="resetButton">Reset</a>
                    </div>

                    <div id="sourceSelectPanel" style="display:none" class="center">
                        <select id="sourceSelect" class="form-select form-select-sm" style="max-width:400px">

                        </select>
                    </div>
                    <div>
                        <video id="video" width="300" height="200" style="border: 1px solid gray"></video>
                    </div>

                </div>
{{--                <svg id="greencheck" class="responses" style="display: none" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">--}}
{{--                    <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>--}}
{{--                    <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>--}}
{{--                </svg>--}}

{{--                <svg id="redcheck" style="display:none;" class="responses" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">--}}
{{--                    <circle class="path circle" fill="none" stroke="#D06079" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>--}}
{{--                    <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3"/>--}}
{{--                    <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2"/>--}}
{{--                </svg>--}}
            </section>
        </main>
    </div>
    <div>
        <div class="card-body underEightTeen" id="particpant-card">
            <p id="allowed">Toegestaan: </p>
            <p id="name">Naam: </p>
            <p id="age">Leeftijd: </p>

        </div>
    </div>
</div>
<script type="text/javascript">
    function decodeOnce(codeReader, selectedDeviceId) {
        codeReader.decodeFromInputVideoDevice(selectedDeviceId, 'video').then((result) => {
            console.log(result)
            document.getElementById('result').textContent = result.text
        }).catch((err) => {
            console.error(err)
            document.getElementById('result').textContent = err
        })
    }
    function setInformation(user, allowed) {
        let nameElement = document.getElementById('name');
        let ageElement = document.getElementById('age');
        let allowElement = document.getElementById('allowed')
        if(user.insertion) {
            nameElement.textContent = "Naam " + user.firstName + " " +user.insertion + " " + user.lastName
        } else  {
            nameElement.textContent = "Naam: " + user.firstName + " " + user.lastName
        }
        allowElement.textContent = "Toegestaan: " + allowed;
        ageElement.textContent = "Leeftijd: " + user.age;
    }
    function delay(time) {
        return new Promise(resolve => setTimeout(resolve, time));
    }

    async function flashBackgroundRed() {
        document.body.style.backgroundColor = "red";
        await delay(500);
        document.body.style.backgroundColor = "white";
    }

    async function flashBackgroundGreen() {
        document.body.style.backgroundColor = "green";
        await delay(250);
        document.body.style.backgroundColor = "white";
    }

    function decodeContinuously(codeReader, selectedDeviceId) {
        codeReader.decodeFromInputVideoDeviceContinuously(selectedDeviceId, 'video', (result, err) => {
            if (result) {
                // properly decoded qr code
                let check = document.getElementById('checkIn')
                console.log('Found QR code!', result)
                if(check.checked) {
                    $.ajax({
                        url: '/participants/' + result.text + "/get",
                        type: 'GET',
                        success: function(response) {
                            obj = JSON.parse(response);

                            if(obj.removedFromIntro){
                                flashBackgroundRed();
                                setInformation(obj, "nee, permanent verwijderd");
                                document.getElementById('particpant-card').classList.remove('aboveEightTeen');
                                document.getElementById('particpant-card').classList.add('underEightTeen');
                                return;
                            }
                            if(!obj.haspaid) {
                                flashBackgroundRed();
                                setInformation(obj, "nee, niet betaald");
                                document.getElementById('particpant-card').classList.remove('aboveEightTeen');
                                document.getElementById('particpant-card').classList.add('underEightTeen');
                                return;
                            }
                            setInformation(obj, "ja");
                            if(obj.above18){
                                document.getElementById('particpant-card').classList.remove('underEightTeen');
                                document.getElementById('particpant-card').classList.add('aboveEightTeen');
                            } else {
                                document.getElementById('particpant-card').classList.remove('aboveEightTeen');
                                document.getElementById('particpant-card').classList.add('underEightTeen');
                            }
                            $.ajax({
                                url: '/participants/' + result.text + "/checkIn",
                                type: 'POST',
                                success: function(response) {
                                    flashBackgroundGreen();
                                },
                                beforeSend: function (request) {
                                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                                }
                            });
                        },
                        beforeSend: function (request) {
                            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                        }
                    });
                } else {
                    $.ajax({
                        url: '/participants/' + result.text + "/checkOut",
                        type: 'POST',
                        success: function(response) {
                            $.ajax({
                                url: '/participants/' + result.text + "/get",
                                type: 'GET',
                                success: function(response) {
                                    obj = JSON.parse(response)
                                    setInformation(obj,"N/A");
                                },
                                beforeSend: function (request) {
                                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                                }
                            });
                        },
                        beforeSend: function (request) {
                            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                        }
                    });
                }



            }

            if (err) {
                // As long as this error belongs into one of the following categories
                // the code reader is going to continue as excepted. Any other error
                // will stop the decoding loop.
                //
                // Excepted Exceptions:
                //
                //  - NotFoundException
                //  - ChecksumException
                //  - FormatException

                if (err instanceof ZXing.NotFoundException) {
                    console.log('No QR code found.')
                }

                if (err instanceof ZXing.ChecksumException) {
                    console.log('A code was found, but it\'s read value was not valid.')

                }

                if (err instanceof ZXing.FormatException) {
                    console.log('A code was found, but it was in a invalid format.')

                }
            }
        })
    }

    window.addEventListener('load', function () {
        let selectedDeviceId;
        const codeReader = new ZXing.BrowserQRCodeReader()
        console.log('ZXing code reader initialized')

        codeReader.getVideoInputDevices()
            .then((videoInputDevices) => {
                const sourceSelect = document.getElementById('sourceSelect')
                selectedDeviceId = videoInputDevices[0].deviceId
                if (videoInputDevices.length >= 1) {
                    videoInputDevices.forEach((element) => {
                        const sourceOption = document.createElement('option')
                        sourceOption.text = element.label
                        sourceOption.value = element.deviceId
                        sourceSelect.appendChild(sourceOption)
                    })

                    sourceSelect.onchange = () => {
                        selectedDeviceId = sourceSelect.value;
                    };

                    const sourceSelectPanel = document.getElementById('sourceSelectPanel')
                    sourceSelectPanel.style.display = 'block'
                }

                document.getElementById('startButton').addEventListener('click', () => {

                    decodeContinuously(codeReader, selectedDeviceId);

                    console.log(`Started decode from camera with id ${selectedDeviceId}`)
                })

                document.getElementById('resetButton').addEventListener('click', () => {
                    codeReader.reset()
                    document.getElementById('result').textContent = '';
                    console.log('Reset.')
                })

            })
            .catch((err) => {
                console.error(err)
            })
    })
</script>
{{--    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG('4', 'PDF417') }}" alt="barcode"   />--}}
@endsection
