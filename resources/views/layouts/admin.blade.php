<html>
    <head>
        <title>App Name - @yield('title')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}"/>
    </head>
    <body>
        <div class="row">
        @section('sidebar')
        <div class="col-md-3 menu">&nbsp;
            @component('admin/menubar')
            @endcomponent
            
            @yield('sidebarchild')
        </div>
        @show

        <div class="col-md-9">
            @yield('content')
        </div>
        </div>
    </body>
</html>