<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function booking() {
        $id = request('id') ?? Room::orderBy('id', 'asc')->first()->id;

        $room = Room::find($id);
        $result = $this->getRoomCapacitiesForCurrentWeek($id);
        $userBookings = $this->getUsersBooking();
    
        return view('booking', ['room' => $room, 'roomId' => $room->id, 'rooms' => Room::all(), 'result' => $result, 'userBookings' => $userBookings]);
    }

    function getRoomCapacitiesForCurrentWeek($roomId) {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek   = Carbon::now()->endOfWeek();

        $room        = Room::findOrFail($roomId);
        $bookings    = Booking::where('room_id', $room->id)->whereBetween('date', [$startOfWeek, $endOfWeek])->get();
        $capacity      = [];

        foreach ($bookings as $booking) {
            $bookingSum = Booking::where('room_id', $room->id)
                ->where('block', $booking->block)
                ->whereBetween('date', [$startOfWeek, $endOfWeek])
                ->count();

            if ($bookingSum >= $room->capacity && !in_array($booking->block, $capacity)) {
                array_push($capacity, $booking->block);
            }
        }

        return $capacity;
    }

    function getUsersBooking() {
        $userBookings = [];
        $startOfWeek  = Carbon::now()->startOfWeek();
        $endOfWeek    = Carbon::now()->endOfWeek();
        $bookings     = Booking::where('user_id', Session::get('user_id'))->whereBetween('date', [$startOfWeek, $endOfWeek])->get();

        foreach ($bookings as $booking) {
            if (!in_array($booking->block, $userBookings)) {
                array_push($userBookings, $booking->block);
            }
        }

        return $userBookings;
    }

    function saveBookings() {
        $roomId = request('roomId');
        $bookingData = request('bookingData');

        $id = $roomId ?? Room::orderBy('id', 'asc')->first()->id;

        foreach ($bookingData as $booking) {
            [$block, $day] = explode('.', $booking);

            $date = Carbon::now()->startOfWeek()->addDays($day - 1)->toDateString();

            Booking::create([
                'user_id' => Session::get('user_id'),
                'room_id' => $id,
                'date' => $date,
                'block' => $booking
            ]);
        }

        return true;
    }

    function overview() {
        $startOfWeek  = Carbon::now()->startOfWeek();
        $endOfWeek    = Carbon::now()->endOfWeek();
        $bookings     = Booking::where('user_id', Session::get('user_id'))->whereBetween('date', [$startOfWeek, $endOfWeek])->get();
        
        $result = $bookings->mapWithKeys(function ($booking) {
            return [$booking->block => Room::where('id', $booking->room_id)->first()->name];
        })->toArray();

        return view('overview', ['result' => $result]);
    }

    function cancel(Request $request) {
        $id = $request->input('id');

        $date = Carbon::now()->startOfWeek()->addDays(($id - 1));

        Booking::where('user_id', Session::get('user_id'))->where('date', $date)->delete();

        return true;
    }
}
