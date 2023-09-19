<?php

namespace Database\Seeders;

use App\Models\PatchBranch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patchs = [];
        for ($i = 1; $i <= 5; $i++) {
            for ($j = 1; $j <= 24; $j++) {
                $patchs[]['port'] = $i . '/' . $j;
            }
        }

        foreach ($patchs as $patch) {
            PatchBranch::create($patch);
        }
    }
}
