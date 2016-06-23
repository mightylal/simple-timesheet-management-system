<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Timesheet</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    @yield('styles')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>

<div id="logo-container">

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <div id="logo"><img class="img-responsive" src="{{ asset('images/logo_main.png') }}" alt="logo"></div>

            </div>

        </div>

    </div>

</div> <!-- Logo Container -->

<div id="menu-container">

    <div class="container">

        <nav class="navbar navbar-default">
            <ul class="nav navbar-nav">
                @if (Auth::user()->admin)
                    <li><a href="{{ route('dashboard') }}">Timesheet</a></li>
                    <li><a href="{{ route('admin') }}">Admin</a></li>
                    <li><a href="{{ route('admin.reports') }}">Reports</a></li>
                    <li><a href="{{ route('admin.overview') }}">Time Overview</a></li>
                @endif
                <li><a href="{{ route('logout') }}">Logout</a></li>
            </ul>
            <p class="navbar-text pull-right"><strong>Signed in as {{ Auth::user()->username }} </strong></p>
        </nav>

    </div>

</div>

@include('message')

@yield('content')

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
@yield('scripts')
<script src="{{ asset('js/enter-time.js') }}"></script>
<script src="{{ asset('js/tooltip-ini.js') }}"></script>
<script src="{{ asset('js/delete-entry.js') }}"></script>
</body>
</html>