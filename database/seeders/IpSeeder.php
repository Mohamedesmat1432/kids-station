<?php

namespace Database\Seeders;

use App\Models\Ip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ips = [];
        for ($i = 1; $i <= 255; $i++) {
            $ips[]['number'] = '10.0.0.' . $i;
        }

        foreach ($ips as $ip) {
            Ip::create($ip);
        }
    }
}
