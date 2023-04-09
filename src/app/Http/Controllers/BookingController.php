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
        $room   = Room::orderBy('id', 'asc')->first();
        $result = $this->getRoomCapacitiesForCurrentWeek($room->id);

        return view('booking', ['room' => $room, 'result' => $result]);
    }

    function getRoomCapacitiesForCurrentWeek($roomId)
    {
        // Get the start and end of the current week
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        // Retrieve the room with the specified ID
        $room = Room::findOrFail($roomId);

        // Retrieve the sum of entries for this room in the current week
        $sumOfEntries = Booking::where('room_id', $room->id)
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->sum('block');

        // Calculate the percentage of capacity filled for this room
        $percentageCapacityFilled = ($sumOfEntries / $room->capacity) * 100;

        // Determine if the room is at capacity or not
        $isAtCapacity = $sumOfEntries >= $room->capacity;

        // Create a result set to store the capacity data for this room
        $capacityData = [
            'room_id' => $room->id,
            'room_name' => $room->name,
            'capacity' => $room->capacity,
            'sum_of_entries' => $sumOfEntries,
            'percentage_capacity_filled' => $percentageCapacityFilled,
            'is_at_capacity' => $isAtCapacity
        ];

        // Return the capacity data
        return $capacityData;
    }

    // change to $request
    function saveBookings($roomId, $bookingData)
    {
        // Loop through the booking data and create a new Booking record for each entry
        foreach ($bookingData as $booking) {
            // Split the booking into block and day
            [$block, $day] = explode('.', $booking);

            // Calculate the date for this booking based on the day of the week
            $date = Carbon::now()->startOfWeek()->addDays($day - 1)->toDateString();

            // Create a new Booking record and save it to the database
            Booking::create([
                'user_id' => Session::get('user_id')
                'room_id' => $roomId,
                'date' => $date,
                'block' => $block
            ]);
        }
    }
}
