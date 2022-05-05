<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Los-Santos Customs Games') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <span class="los-santos-customs">
                <img src="{{asset('images/logo.png')}}" alt="">
            </span>
            <a class="navbar-brand" href="/">
                Los-Santos Customs Games
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li>
                        <a href="russian-roulette">Русская рулетка</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4 container-fluid">
        @yield('content')
    </main>
</div>
</body>
<script>
    let select_gamers = document.getElementById('gamers');
    let main_element = document.querySelector('.players')
    var previous_countage = 2;

    select_gamers.addEventListener('change', () => {
        if(select_gamers.value < previous_countage){
            for (let el = previous_countage; el > +select_gamers.value; el--){
                let element = document.getElementById(el)
                element.remove()
            }
            previous_countage = +select_gamers.value
        }
        else {
            console.log(previous_countage, select_gamers.value)
            for (let el = previous_countage + 1; el <= +select_gamers.value; el++){
                main_element.insertAdjacentHTML('beforeend',`
                                    <div class="form-group mt-3" id="${el}">
                                        <label for="player${el}">Игрок ${el}</label>
                                        <input type="text" name="player${el}">
                                    </div>`);
            }
            previous_countage = +select_gamers.value
        }
    })

    document.addEventListener('onload', () => {
        select_gamers.value = 2;
    })
</script>
</html>
