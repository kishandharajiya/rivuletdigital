<!doctype html>
<html>

<head>
    @include('includes.head')
</head>

<body>

    <div id="app">
        <header class="row">
            @include('includes.header')
        </header>
        <div class="container">
            <div class="row justify-content-center">
                <div class="card">
                    @yield('content')
                </div>
            </div>
        </div>
        <footer class="row">
            @include('includes.footer')
        </footer>
    </div>
</body>
    @include('includes.script')
</html>
