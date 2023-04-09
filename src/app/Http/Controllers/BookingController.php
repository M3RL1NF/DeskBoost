<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function booking()
    {
        // $room   = Room::orderBy('id', 'asc')->first();
        // $result = $this->getRoomCapacitiesForCurrentWeek($room->id);

        // return view('booking', ['room' => $room, 'result' => $result]);

        return view('booking');
    }

    function getRoomCapacitiesForCurrentWeek($roomId)
    {
        /*
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $room = Room::findOrFail($roomId);

        $sumOfEntries = Booking::where('room_id', $room->id)
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->sum('block');

        $percentageCapacityFilled = ($sumOfEntries / $room->capacity) * 100;

        $isAtCapacity = $sumOfEntries >= $room->capacity;

        $capacityData = [
            'room_id' => $room->id,
            'room_name' => $room->name,
            'capacity' => $room->capacity,
            'sum_of_entries' => $sumOfEntries,
            'percentage_capacity_filled' => $percentageCapacityFilled,
            'is_at_capacity' => $isAtCapacity
        ];

        return $capacityData;
        */
    }

    // change to $request
    function saveBookings($roomId, $bookingData)
    {
        /*
        foreach ($bookingData as $booking) {
            [$block, $day] = explode('.', $booking);

            $date = Carbon::now()->startOfWeek()->addDays($day - 1)->toDateString();

            Booking::create([
                'user_id' => Session::get('user_id')
                'room_id' => $roomId,
                'date' => $date,
                'block' => $block
            ]);
        }
        */
    }
}
