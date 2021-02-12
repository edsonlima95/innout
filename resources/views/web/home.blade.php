@extends('web.layout_master')
@section('content')
    <div class="row mt-5">
        <div class="col-lg-6 d-flex align-items-center flex-column mt-3 mb-5">
            <p class="font-weight-bold text-3xl">1º Entrada: <span
                    class="text-primary">{{$workingHours->time_1 ?? '---'}}</span></p>
            <p class="font-weight-bold text-3xl">2º Entrada: <span
                    class="text-primary">{{$workingHours->time_3 ?? '---'}}</span></p>
        </div>
        <div class="col-lg-6 d-flex align-items-center flex-column mt-3 mb-5">
            <p class="font-weight-bold text-3xl">1º Saida: <span
                    class="text-danger">{{$workingHours->time_2 ?? '---'}}</span></p>
            <p class="font-weight-bold text-3xl">2º Saida: <span
                    class="text-danger">{{$workingHours->time_4 ?? '---'}}</span></p>
        </div>
        <div class="col-lg-12 d-flex justify-content-center mt-4">
            <a href="{{route('app.lunch')}}" class="btn btn-dark btn-lg col-3 mb-5"><i
                    class="fa fa-check mr-2"></i>Bater ponto</a>
        </div>
    </div>
@endsection
@section('js')
    <script>

        function setClock(hours, minutes, seconds) {
            var date = new Date();
            date.setHours(parseInt(hours))
            date.setMinutes(parseInt(minutes))
            date.setSeconds(parseInt(seconds) + 1)

            var hour = `${date.getHours()}`.padStart(2, 0)
            var minute = `${date.getMinutes()}`.padStart(2, 0)
            var second = `${date.getSeconds()}`.padStart(2, 0)

            return `${hour}:${minute}:${second}`
        }

        function activeClock() {

            var activeClock = document.querySelector('[active-clock]');
            if (!activeClock) return;

            setInterval(function () {
                var arrClock = activeClock.innerHTML.split(":")
                activeClock.innerHTML = setClock(arrClock[0], arrClock[1], arrClock[2])
            }, 1000)
        }

        activeClock();

    </script>
@endsection
