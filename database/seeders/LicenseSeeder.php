<?php

namespace Database\Seeders;

use App\Models\License;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LicenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $licenses = [
            [
                'name' => 'SSl',
                'start_date' => '2023-01-13',
                'end_date' => '2024-01-13'
            ],
            [
                'name' => 'Forti Emad Eldeen',
                'start_date' => '2023-07-30',
                'end_date' => '2023-10-30'
            ],
            [
                'name' => 'Forti Doki',
                'start_date' => '2023-07-29',
                'end_date' => '2023-10-29'
            ],
            [
                'name' => 'Redhat',
                'start_date' => '2022-07-16',
                'end_date' => '2023-07-16',
            ],
            [
                'name' => 'Redhat (20 machines(Tedata))',
                'start_date' => '2022-11-1',
                'end_date' => '2023-11-1',
            ],
            [
                'name' => 'IBM',
                'start_date' => '2021-09-30',
                'end_date' => '2022-09-30',
            ],
            [
                'name' => 'Zoom',
                'start_date' => '2023-01-05',
                'end_date' => '2024-01-05',
            ],
            [
                'name' => 'Domain (mff.gov.eg)',
                'start_date' => '2023-08-20',
                'end_date' => '2024-08-20',
            ],
            [
                'name' => 'Domain (shmff.gov.eg)',
                'start_date' => '2022-11-27',
                'end_date' => '2023-11-27',
            ],
            [
                'name' => 'Antivirus (Kasper)',
                'start_date' => '2022-10-03',
                'end_date' => '2023-10-03',
            ],
            [
                'name' => 'Cisco (Telephones)',
                'start_date' => '2023-07-22',
                'end_date' => '2024-07-22',
            ],
            [
                'name' => 'Dell (Hyperflex)',
                'start_date' => '2023-07-22',
                'end_date' => '2024-07-22',
            ],
            [
                'name' => 'VmWare & VmCenter',
                'start_date' => '2023-07-22',
                'end_date' => '2024-07-22',
            ],
            [
                'name' => 'Veaam',
                'start_date' => '2023-07-22',
                'end_date' => '2024-07-22',
            ],
        ];

        foreach ($licenses as $license) {
            License::create($license);
        }
    }
}
