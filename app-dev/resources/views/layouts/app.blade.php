<html>
    <title>Portal - @yield('title')</title>
    <body>
        <nav>
            <a href="/">Página principal</a>
            <a href="/Alumnos">Alumnos</a>
            <a href="/Maestros">Maestros</a>
        </nav>
        <h1>@yield('title')</h1>
        <br>
        <h3>@yield('content')</h3>
    </body>
</html>