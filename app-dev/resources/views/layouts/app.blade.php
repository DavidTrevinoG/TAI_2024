<html>
    <title>Portal - @yield('title')</title>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
    </head>
    <body>
        <nav>
            <a href="/">Página principal</a>
            <a href="/Alumnos">Alumnos</a>
            <a href="/Maestros">Maestros</a>
        </nav>
        <h1 class="text-3xl font-bold underline">@yield('title')</h1>
        <br>
        <h3>@yield('content')</h3>
    </body>
</html>