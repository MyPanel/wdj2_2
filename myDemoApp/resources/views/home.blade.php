<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Welcome !</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/tooplate-style.css')}}">
    @yield('style')
  </head>
  <body>

    <!-- MENU -->
    <nav class="navbar navbar-expand-sm navbar-light">
        <div class="container">
            <a class="navbar-brand" href="/"><i class='uil uil-user'></i> WDJ2</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a href="/members" class="nav-link"><span data-hover="Member">Member</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="#project" class="nav-link"><span data-hover="Info">Info</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="/questions" class="nav-link"><span data-hover="Q&A">Q&A</span></a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a href="/login" class="nav-link"><span data-hover="Log In">Log In</span></a>
                        </li>
                    @endguest
                    @auth
                        <li class="nav-item">
                            <a href="/logout" class="nav-link"><span data-hover="Log Out">Log Out</span></a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <div class="main_content">
        @yield('content')
    </div>
  </body>
</html>