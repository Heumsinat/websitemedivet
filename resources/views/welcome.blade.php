<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MEDIVETGROUP</title>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRaaz_WjzqmpaZzFfnWOxflxbdbGVTMbA" type="text/javascript"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm fixed-top">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#company">SUBSIDIARY</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#map">CONTACT US</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#image">PORTFOLIO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#news">NEWS</a>
                            </li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        
                    </div>
                </div>
            </nav>
            <vcarousel-component></vcarousel-component>
            <section id="company">
                <subsidiary-component></subsidiary-component>
            </section>
            <section id="map">
                <map-component></map-component>
            </section>
            <section id="image">
                <portfolio-component></portfolio-component>
            </section>
            <section id="news">
                <news-component></news-component>
            </section>
            <section id="footer">
                <footer-component></footer-component> 
            </section>
            
            
            
                    
        </div>
    </body>
</html>
