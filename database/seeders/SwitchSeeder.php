<?php

namespace Database\Seeders;

use App\Models\SwitchBranch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SwitchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $switchs = [];
        for ($i = 1; $i <= 6; $i++) {
            for ($j = 1; $j <= 24; $j++) {
                $switchs[]['port'] = $i . '/' . $j;
            }
        }

        foreach ($switchs as $switch) {
            SwitchBranch::create($switch);
        }
    }
}
