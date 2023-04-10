<!DOCTYPE html>
<html>
    <head>
        <title>DESKBOOST</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">
        <script>
            $(document).ready(function() {
                $(".navbar-button").click(function() {
                    $(".btn").removeClass("active");
                    $(this).addClass("active");
                });
            });

            $(document).ready(function() {
                var clickedIds = [];
                $('.table-button').click(function() {
                    var buttonId = $(this).attr('id');
                    $(this).toggleClass('btn-success btn-dark');
                    if ($.inArray(buttonId, clickedIds) !== -1) {
                        clickedIds.splice($.inArray(buttonId, clickedIds), 1);
                    } else {
                        clickedIds.push(buttonId);
                    }
                    console.log(clickedIds);
                });
            });

            $(function() {
                // Get the selected room ID from the URL
                var roomId = new URLSearchParams(window.location.search).get('id');
                // If the room ID is defined, set the selected option in the dropdown
                if (roomId) {
                    $('#room-select').val(roomId);
                }

                $('#room-select').on('change', function() {
                    var roomId = $(this).val();
                    var url = "{{ route('booking') }}?id=" + roomId;
                    $('#booking-form').attr('action', url);
                    $('#booking-form').submit();
                });
            });
        </script>
    </head>
    <body>
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#" style="font-size: 150%;">D E S K <b>BOOST</b></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="ml-auto" style="width: 350px;">
                    <div class="d-flex">
                        <form method="POST" action="{{ route('booking') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-light active navbar-button" style="width: 150px; margin-right: 10px;">Buchen</button>
                        </form>
                        <form method="POST" action="{{ route('booking-overview') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-light navbar-button" style="width: 150px; margin-right: 10px;">Meine Buchungen</button>
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
        {{ $result['sum_of_entries'] }}
        <div class="container">
            @php
                $today = \Carbon\Carbon::today();
                $week_start = $today->startOfWeek()->format('d.m.Y');
                $week_end = $today->endOfWeek()->format('d.m.Y');
            @endphp
            <div style="text-align:center;" class="mt-3">
                <h3>Kalenderwoche {{ $today->weekOfYear }}</h3>
                <h4>{{ $week_start }} - {{ $week_end }}</h4>
            </div>
            <form method="GET" action="{{ route('booking', ['id' => $roomId ?? $rooms->first()->id]) }}" id="booking-form">
                @csrf
                <div class="form-group row mt-3">
                    <label for="room-select" class="col-md-1 col-form-label"><b>Raum:</b></label>
                    <div class="col-sm-11">
                        <select class="form-control" id="room-select" name="id">
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}" {{ $room->id == $roomId ? 'selected' : '' }}>Etage {{ $room->floor }} - {{ $room->name }} ({{ $room->alias }}) | Kapazität {{ $room->capacity }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
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
                            <td><button type="button" id="<?php echo $i+0.1; ?>" class="btn btn-dark btn-block table-button">&nbsp;</button></td>
                            <td><button type="button" id="<?php echo $i+0.2; ?>" class="btn btn-dark btn-block table-button">&nbsp;</button></td>
                            <td><button type="button" id="<?php echo $i+0.3; ?>" class="btn btn-dark btn-block table-button">&nbsp;</button></td>
                            <td><button type="button" id="<?php echo $i+0.4; ?>" class="btn btn-dark btn-block table-button">&nbsp;</button></td>
                            <td><button type="button" id="<?php echo $i+0.5; ?>" class="btn btn-dark btn-block table-button">&nbsp;</button></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="container mt-3 mb-3 text-right">
            <button type="button" class="btn btn-dark btn-block col-md-3 ml-auto">Speichern</button>
        </div>
    </body>
</html>
