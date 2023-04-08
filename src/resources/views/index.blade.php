<!DOCTYPE html>
<html>
    <head>
        <title>DESKBOOST</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function() {
                $(".navbar-button").click(function() {
                    $(".btn").removeClass("active");
                    $(this).addClass("active");
                });
            });

            $(document).ready(function() {
                $('.table-button').click(function() {
                    var buttonId = $(this).attr('id');
                    myFunction(buttonId);
                });
            });

            function myFunction(buttonId) {
                console.log('Button clicked: ' + buttonId);
            }
        </script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#" style="font-size: 200%;">D E S K <b>BOOST</b></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                    </ul>
                </div>
                <div class="ml-auto">
                    <button type="button" class="btn btn-dark active navbar-button">Meine Buchungen</button>
                    <button type="button" class="btn btn-dark navbar-button">Buchen</button>
                </div>
            </div>
        </nav>
        <div class="container">
            <table id="booking-table" class="table table-bordered; border: 0; table-layout: fixed;">
                <thead>
                    <tr class="text-center">
                        <th style="width: 10%;"></th>
                        <th style="width: 15%;">Monday</th>
                        <th style="width: 15%;">Tuesday</th>
                        <th style="width: 15%;">Wednesday</th>
                        <th style="width: 15%;">Thursday</th>
                        <th style="width: 15%;">Friday</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 6; $i <= 23; $i++) { ?>
                        <tr>
                            <td><p><?php echo $i; ?>:00 Uhr</p></td>
                            <td><button type="button" id="<?php echo $i; ?>" class="btn btn-dark btn-block table-button">&nbsp;</button></td>
                            <td><button type="button" id="<?php echo $i+0.1; ?>" class="btn btn-dark btn-block table-button">&nbsp;</button></td>
                            <td><button type="button" id="<?php echo $i+0.2; ?>" class="btn btn-dark btn-block table-button">&nbsp;</button></td>
                            <td><button type="button" id="<?php echo $i+0.3; ?>" class="btn btn-dark btn-block table-button">&nbsp;</button></td>
                            <td><button type="button" id="<?php echo $i+0.4; ?>" class="btn btn-dark btn-block table-button">&nbsp;</button></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
