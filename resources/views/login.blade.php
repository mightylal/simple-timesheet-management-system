<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>
@include('message')
<div class="container top-buffer">
    <div class="row">
        <div class="col-md-4 col-xs-12"></div>
        <div class="col-md-4 col-xs-12 col-border" style="background-color: #FAFAFA;">
            <div class="logo">
                <img class="img-responsive" src="{{ asset('images/logo_login.png') }}" alt="logo">
            </div>
            <form action="{{ route('login') }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="username" class="col-xs-3 control-label">Username</label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-xs-3 control-label">Password</label>
                    <div class="col-xs-9">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="text-center div-buffer">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
        <div class="col-md-4 col-xs-12"></div>
    </div> <!-- End of Row -->
</div> <!-- End of Container Fluid -->
</body>
</html>