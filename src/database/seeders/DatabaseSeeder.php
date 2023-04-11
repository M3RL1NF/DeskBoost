<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // seed rooms
        $rooms = [
            ['name' => 'KR 1',  'alias' => '110', 'floor' => 'EG', 'capacity' => 6],
            ['name' => 'KR 2',  'alias' => '101', 'floor' => 'EG', 'capacity' => 8],
            ['name' => 'MPB 1', 'alias' => '109', 'floor' => 'EG', 'capacity' => 4],
            ['name' => 'MPB 2', 'alias' => '106', 'floor' => 'EG', 'capacity' => 3],
            ['name' => 'MPB 3', 'alias' => '105', 'floor' => 'EG', 'capacity' => 4],
            ['name' => 'EB 1',  'alias' => '107', 'floor' => 'EG', 'capacity' => 1],
            ['name' => 'EB 2',  'alias' => '108', 'floor' => 'EG', 'capacity' => 1],

            ['name' => 'KR 3',  'alias' => '211', 'floor' => '1. OG', 'capacity' => 6],
            ['name' => 'KR 4',  'alias' => '202', 'floor' => '1. OG', 'capacity' => 8],
            ['name' => 'KR 5',  'alias' => '201', 'floor' => '1. OG', 'capacity' => 4],
            ['name' => 'MPB 4', 'alias' => '206', 'floor' => '1. OG', 'capacity' => 4],
            ['name' => 'MPB 5', 'alias' => '207', 'floor' => '1. OG', 'capacity' => 3],
            ['name' => 'MPB 6', 'alias' => '210', 'floor' => '1. OG', 'capacity' => 4],
            ['name' => 'EB 3',  'alias' => '203', 'floor' => '1. OG', 'capacity' => 1],
            ['name' => 'EB 4',  'alias' => '204', 'floor' => '1. OG', 'capacity' => 1],
            ['name' => 'EB 5',  'alias' => '205', 'floor' => '1. OG', 'capacity' => 1],
            ['name' => 'EB 6',  'alias' => '208', 'floor' => '1. OG', 'capacity' => 1],
            ['name' => 'EB 7',  'alias' => '209', 'floor' => '1. OG', 'capacity' => 1],

            ['name' => 'KR 6',  'alias' => '301', 'floor' => '2. OG', 'capacity' => 4],
            ['name' => 'KR 7',  'alias' => '302', 'floor' => '2. OG', 'capacity' => 8],
            ['name' => 'KR 8',  'alias' => '311', 'floor' => '2. OG', 'capacity' => 6],
            ['name' => 'MPB 7', 'alias' => '306', 'floor' => '2. OG', 'capacity' => 4],
            ['name' => 'MPB 8', 'alias' => '307', 'floor' => '2. OG', 'capacity' => 3],
            ['name' => 'MPB 9', 'alias' => '310', 'floor' => '2. OG', 'capacity' => 4],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
