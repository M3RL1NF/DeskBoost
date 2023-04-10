<!DOCTYPE html>
<html>
    <head>
        <title>DESKBOOST</title>
        <meta name="csrf-token" content="<?php echo csrf_token(); ?>">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-sm-6">
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/desk-boost.jpg') }}" alt="Desk-Boost" class="img-fluid">
                    </div>
                    <form method="POST" action="{{ route('handle') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" placeholder="E-Mail Adresse">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Passwort">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-dark btn-block">Anmelden</button>
                        </div>
                        <div class="text-center">
                            <small>Sie melden sich bei der <i>Ostfriesischen Energie AG</i> an. Sollten Sie sich das erste mal anmelden, wird für Sie ein neuer Benutzer erstellt.</small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
