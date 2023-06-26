<!DOCTYPE html>
<html>
    <head>
        <title>DESKBOOST</title>
        <meta name="csrf-token" content="<?php echo csrf_token(); ?>">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">
        <script>
            $(document).ready(function() {
                $(".delete-button").hover(function() {
                    var columnIndex = $(this).parent().index();
                    $("td:nth-child(" + (columnIndex + 1) + ") button.table-button").not(this).addClass("highlight");
                }, function() {
                    $("button.table-button").removeClass("highlight");
                });
            

                $('.delete-button').click(function() {
                    var id = $(this).attr('id');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: "{{ route('cancel') }}",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            var form = $('<form></form>', {
                                'method': 'POST',
                                'action': '{{ route("overview") }}'
                            });

                            $('<input>').attr({
                                'type': 'hidden',
                                'name': '_token',
                                'value': $('meta[name="csrf-token"]').attr('content')
                            }).appendTo(form);

                            $('body').append(form);
                            form.submit();
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                });
            });
        </script>
        <style>
            .highlight {
                background-color: #eb7171;
            }
        </style>
    </head>
    <body>
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#" style="font-size: 200%;">D E S K <b>BOOST</b></a>
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
            @php
                $today = \Carbon\Carbon::today();
                $week_start = $today->startOfWeek()->format('d.m.Y');
                $week_end = $today->endOfWeek()->format('d.m.Y');
            @endphp
            <div style="text-align:center;" class="mt-3">
                <h3> < Kalenderwoche {{ $today->weekOfYear }} > </h3>
                <h4>{{ $week_start }} - {{ $week_end }}</h4>
            </div>
            <table id="booking-table" class="table table-sm mt-3">
                <thead>
                    <tr class="text-center">
                        <th style="width: 10%;"></th>
                        <th style="width: 15%;">Montag</th>
                        <th style="width: 15%;">Dienstag</th>
                        <th style="width: 15%;">Mittwoch</th>
                        <th style="width: 15%;">Donnerstag</th>
                        <th style="width: 15%;">Freitag</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 6; $i <= 22; $i++) { ?>
                        <tr>
                            <td>
                                <?php 
                                    $start_time = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00';
                                    $end_time = str_pad($i+1, 2, '0', STR_PAD_LEFT) . ':00';
                                ?>
                                <p><?php echo $start_time . ' - ' . $end_time; ?></p>
                            </td>
                            <?php 
                                $button_exists = false;
                                foreach ($result as $key => $value) {
                                    if ($key == $i+0.1) { ?>
                                        <td><button type="button" id="<?php echo $i+0.1; ?>" class="btn btn-success btn-block table-button"><?php echo $value; ?></button></td>
                                        <?php $button_exists = true;
                                    }
                                }
                                if(!$button_exists){
                            ?>
                                <td><button type="button" id="<?php echo $i+0.1; ?>" class="btn btn-dark btn-block table-button">&nbsp;</button></td>
                            <?php } ?>

                            <?php 
                                $button_exists = false;
                                foreach ($result as $key => $value) {
                                    if ($key == $i+0.2) { ?>
                                        <td><button type="button" id="<?php echo $i+0.2; ?>" class="btn btn-success btn-block table-button"><?php echo $value; ?></button></td>
                                        <?php $button_exists = true;
                                    }
                                }
                                if(!$button_exists){ 
                            ?>
                                <td><button type="button" id="<?php echo $i+0.2; ?>" class="btn btn-dark btn-block table-button">&nbsp;</button></td>
                            <?php } ?>

                            <?php 
                                $button_exists = false; 
                                foreach ($result as $key => $value) {
                                    if ($key == $i+0.3) { ?>
                                        <td><button type="button" id="<?php echo $i+0.3; ?>" class="btn btn-success btn-block table-button"><?php echo $value; ?></button></td>
                                        <?php $button_exists = true; 
                                    }
                                }
                                if(!$button_exists){ 
                            ?>
                                <td><button type="button" id="<?php echo $i+0.3; ?>" class="btn btn-dark btn-block table-button">&nbsp;</button></td>
                            <?php } ?>

                            <?php 
                                $button_exists = false; 
                                foreach ($result as $key => $value) {
                                    if ($key == $i+0.4) { ?>
                                        <td><button type="button" id="<?php echo $i+0.4; ?>" class="btn btn-success btn-block table-button"><?php echo $value; ?></button></td>
                                        <?php $button_exists = true; 
                                    }
                                }
                                if(!$button_exists){ 
                            ?>
                                <td><button type="button" id="<?php echo $i+0.4; ?>" class="btn btn-dark btn-block table-button">&nbsp;</button></td>
                            <?php } ?>

                            <?php 
                                $button_exists = false; 
                                foreach ($result as $key => $value) {
                                    if ($key == $i+0.5) { ?>
                                        <td><button type="button" id="<?php echo $i+0.5; ?>" class="btn btn-success btn-block table-button"><?php echo $value; ?></button></td>
                                        <?php $button_exists = true;
                                    }
                                }
                                if(!$button_exists){ 
                            ?>
                                <td><button type="button" id="<?php echo $i+0.5; ?>" class="btn btn-dark btn-block table-button">&nbsp;</button></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td></td>
                        <td><button type="button" id="1" class="btn btn-danger btn-block table-button delete-button">Stornieren</button></td>
                        <td><button type="button" id="2" class="btn btn-danger btn-block table-button delete-button">Stornieren</button></td>
                        <td><button type="button" id="3" class="btn btn-danger btn-block table-button delete-button">Stornieren</button></td>
                        <td><button type="button" id="4" class="btn btn-danger btn-block table-button delete-button">Stornieren</button></td>
                        <td><button type="button" id="5" class="btn btn-danger btn-block table-button delete-button">Stornieren</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>