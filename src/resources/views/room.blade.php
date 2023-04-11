<!DOCTYPE html>
<html>
    <head>
        <title>DESKBOOST</title>
        <meta name="csrf-token" content="<?php echo csrf_token(); ?>">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">
    </head>
    <body>
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#" style="font-size: 150%;">D E S K <b>BOOST</b></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="ml-auto" style="width: 500px;">
                    <div class="d-flex">
                        <form method="GET" action="{{ route('booking') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-light navbar-button {{ Request::is('booking') ? 'active' : '' }}" style="width: 150px; margin-right: 10px;">Buchen</button>
                        </form>
                        <form method="POST" action="{{ route('overview') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-light navbar-button {{ Request::is('overview') ? 'active' : '' }}" style="width: 150px; margin-right: 10px;">Meine Buchungen</button>
                        </form>
                        <form method="POST" action="{{ route('room') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-light navbar-button {{ Request::is('room') ? 'active' : '' }}" style="width: 150px; margin-right: 10px;">Raumübersicht</button>
                        </form>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-dark">
                                <i class="bi bi-box-arrow-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container mt-3">
            <h4>Raumübersicht:</h4>
            <div class="row mt-3">
                <div class="col-md-4 text-center">
                    <img src="{{ asset('images/floor-1.png') }}" alt="Floor-1" class="img-fluid">
                </div>
                <div class="col-md-4 text-center">
                    <img src="{{ asset('images/floor-2.png') }}" alt="Floor-2" class="img-fluid">
                </div>
                <div class="col-md-4 text-center">
                    <img src="{{ asset('images/floor-3.png') }}" alt="Floor-3" class="img-fluid">
                </div>
            </div>
        </div>
    </body>
</html>
