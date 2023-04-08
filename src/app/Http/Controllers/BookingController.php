<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class BookingController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function booking()
    {
        return view('booking');
    }
}
