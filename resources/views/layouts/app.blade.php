<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Aplikasi siswa</title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap');
            .lato-bold {
  font-family: "Lato", sans-serif;
  font-weight: 700;
  font-style: normal;
}
            </style>
    </head>
    <body >
        <div id="app" >
            <div class="main-wrapper">
                <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
                    <a class="navbar-brand ps-3" href="/">Aplikasi BK</a>
                </nav>
                <div class="main-content" >@yield('content')</div>
                <div class="container-fluid px-4">
                    <footer class="d-flex flex-wrap justify-content-between align-items- center py-3 my-4 border-top">
                        <p class="col-md-4 mb-0 text-muted">Copyright &copy; RPL 2023</p>
                    </footer>
                </div>
            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</html>
