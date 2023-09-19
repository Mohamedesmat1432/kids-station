<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $compianes = [
            [
                'name' => 'Over IP',
                'email' => '',
                'address' => '9 شارع حازم صلاح - مصطفى النحاس - مدينة نصر - القاهرة',
                'contacts' => '01283466337,01064649704',
                'specialization' => ''
            ],
            [
                'name' => 'Summit Technology solution',
                'email' => '',
                'address' => 'نهاية طريق مدينة نصر - منطقة إستثمار نفق القطامية - قطعة 74/48 ميدان محمد',
                'contacts' => '02-27597000',
                'specialization' => ''
            ],
            [
                'name' => 'Spark Tech',
                'email' => '',
                'address' => '3 شارع مصدق - الدقى - الجيزة',
                'contacts' => '02-27366625',
                'specialization' => ''
            ],
            [
                'name' => 'EMAC',
                'email' => '',
                'address' => 'مدينة العبور - المنطقة الصناعية الاولى - مجمع الخرافى - بلوك 14006',
                'contacts' => '01113444840,2225408339',
                'specialization' => ''
            ],
            [
                'name' => 'IT - VALLEY',
                'email' => '',
                'address' => ' شارع الثورة - الدقى - الجيزة',
                'contacts' => '02-33378557,02-37486693',
                'specialization' => ''
            ],
            [
                'name' => 'Beta Technology',
                'email' => '',
                'address' => '42 شارع عبدالحميد لطفى - الدقى - الجيزة',
                'contacts' => '02-33377038',
                'specialization' => ''
            ],
            [
                'name' => 'Intercom',
                'email' => '',
                'address' => '68 شارع الطيران - منطقة السينما - مدينة نصر',
                'contacts' => '02-24001800',
                'specialization' => ''
            ],
            [
                'name' => 'Click ITS',
                'email' => '',
                'address' => ' شارع دكتور عزت سلامه من شارع عباس العقاد- مدينة نصر - القاهرة',
                'contacts' => '01017797677',
                'specialization' => ''
            ],
            [
                'name' => 'SEE',
                'email' => '',
                'address' => '45 شارع حسن أفلاطون - مساكن المهندسين - قسم مصرالجديدة',
                'contacts' => '01002961827,01147027778',
                'specialization' => ''
            ],
            [
                'name' => 'BARQ System',
                'email' => '',
                'address' => 'مبنى ام بى 4 - حديقة التكنولوجيا - المعادى - القاهرة',
                'contacts' => '01097888690,01050334497,01019911840',
                'specialization' => ''
            ],
        ];

        foreach ($compianes as $company) {
            Company::create($company);
        }
    }
}
