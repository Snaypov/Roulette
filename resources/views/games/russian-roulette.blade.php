@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Русская рулетка</div>

                    <div class="card-body">
                        @if(isset($shoot_value) && $dead === 0)
                            <form action="{{ route('check.shoot') }}" id="form" onsubmit="return false" method="POST">
                                @csrf
                                <div class="from-group d-flex justify-content-center game_roulette flex-row">
                                    {{$shoot_value}}
                                    {{--                                    <img src="{{asset('images/fake_shot.gif')}}" alt="">--}}
                                    <label style="margin-top: 90px" class="player" for="shoot"><h1>
                                            Игрок: {{$players[$player_id]}}</h1>
                                    </label>
                                    <input type="hidden" name="player_id" value="{{$player_id}}">
                                    <input type="hidden" name="shoot" value="{{$shoot+1}}">
                                </div>
                                <div class="from-group d-flex justify-content-center flex-row">
                                </div>
                                <div class="form-group mt-4 d-flex justify-content-center">
                                    <button id="dead_button">Выстрел</button>
                                </div>
                            </form>
                        @elseif (isset($dead))
                            @if($dead === 1)
                                <form action="{{route('new.game')}}" id="form" class="dead_show">
                                    <div class="form-group" id="dead"
                                         style="display: flex; justify-content: center; flex-direction: row">
                                        <label style="margin-top: 90px" for="shoot"><h1>
                                                Игрок: {{$players[$player_id]}}</h1>
                                        </label>
                                        <input type="hidden" name="player" value="{{$players[$player_id]}}">
                                    </div>
                                    <div class="form-group dead1 mt-4 d-flex justify-content-center dead_button">
                                        <button id="dead_button">Выстрел</button>
                                    </div>
                                </form>
                            @endif
                        @else
                            @include('games.create-roulette')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let form = document.querySelector('#form')
        let button = document.getElementById('dead_button')

        button.addEventListener('click', (event) => {
            let div_insert = document.getElementById('dead');
            if (div_insert !== null) {
                event.preventDefault()
                let form_insert = document.querySelector('.dead_show');
                let dead_button = document.querySelector('.dead_button');
                div_insert.insertAdjacentHTML('afterbegin', `
                                    <img src="{{asset('images/shot.gif')}}" id="dead_gif" alt="">
                    `);

                setTimeout(() => {
                    let edit_img = document.querySelector('#dead_gif')
                    edit_img.remove()
                    dead_button.remove()
                    div_insert.insertAdjacentHTML('afterbegin', `
                                    <img src="{{asset('images/dead.gif')}}" id="dead_gif" alt="">
                    `);
                    form_insert.insertAdjacentHTML('beforeend', `
                                    <div class="form-group dead1 mt-4 d-flex justify-content-center dead_button">
                                        <button type="submit">Создать новую игру</button>
                                    </div>
                    `);
                }, 2440);
                setTimeout(() => {
                    form.submit();
                }, 7500)
            } else {
                let game = document.querySelector('.game_roulette')
                game.insertAdjacentHTML('afterbegin', `
                                        <img src="{{asset('images/fake_shot.gif')}}" id="dead_gif" alt="">
                `)
                setTimeout(() => {
                    form.submit()
                }, 2000)
            }
        })
    </script>
@endsection
