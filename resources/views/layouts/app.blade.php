<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script charset="utf-8">
        window.App = {!! json_encode([
            'signedIn' => \Auth::check(),
            'user' => \Auth::user()
        ]) !!};
    </script>

    <style>
        body {
            padding-bottom: 100px;
        }
        .level {
            display: flex;
            align-items: center;
        }
        .flex {
            flex: 1;
        }
        .activity-icon {
            width: 18px;
            display: inline-block;
        }
        [v-cloak] { display: none; }
    </style>
</head>
<body style="padding-bottom: 100px;">
    <div id="app">
        @include( 'layouts.nav' )

        <main class="py-4">
            @yield( 'content' )
        </main>

        <flash message="{{ session('flash') }}"></flash>
    </div>
</body>
</html>
