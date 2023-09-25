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
        $switchs = [
            [
                'hostname' => 'ROUTER',
                'ip' => '41.33.176.17',
                'platform' => 'C888-K9',
                'version' => '15.6(2)T1',
                'floor' => 'WeData',
                'location' => 'WeData',
                'password' => 'WeData',
                'password_enable' => 'WeData',
            ],
            [
                'hostname' => 'TEData-Router-Single',
                'ip' => '10.2.2.1',
                'platform' => 'C888-K9',
                'version' => '15.6(2)T1',
                'floor' => 'WeData',
                'location' => 'WeData',
                'password' => 'WeData',
                'password_enable' => 'WeData',
            ],
            [
                'hostname' => 'TEData-EFM-Single',
                'ip' => '10.2.4.1',
                'platform' => 'C888-K9',
                'version' => '15.6(2)T1',
                'floor' => 'WeData',
                'location' => 'WeData',
                'password' => 'WeData',
                'password_enable' => 'WeData',
            ],
            [
                'hostname' => 'Core',
                'ip' => '10.2.100.1',
                'platform' => 'C9407R',
                'version' => '16.9.3',
                'floor' => 'DataCenter',
                'location' => 'DataCenter',
                'password' => 'F!xed@2oo7[C0re]n0En@ble',
                'password_enable' => 'F!xed@2oo7[C0re]n0En@ble',
            ],
            [
                'hostname' => 'F5_R1_SW1',
                'ip' => '10.2.100.51',
                'platform' => 'WS-C2960X-24PD-L',
                'version' => '15.2(4)E8',
                'floor' => '5th',
                'location' => 'Rack1',
                'password' => 'F!xed@2oo7[F5_R1_SW1]',
                'password_enable' => 'F!xed@2oo7[F5_R1_SW1]En@ble',
            ],
            [
                'hostname' => 'F5_R1_SW2',
                'ip' => '10.2.100.52',
                'platform' => 'WS-C2960X-24PD-L',
                'version' => '15.2(4)E8',
                'floor' => '5th',
                'location' => 'Rack1',
                'password' => 'F!xed@2oo7[F5_R1_SW2]',
                'password_enable' => 'F!xed@2oo7[F5_R1_SW2]En@ble',
            ],
            [
                'hostname' => 'F5_R1_SW3',
                'ip' => '10.2.100.53',
                'platform' => 'WS-C2960X-24PD-L',
                'version' => '15.2(4)E8',
                'floor' => '5th',
                'location' => 'Rack1',
                'password' => 'F!xed@2oo7[F5_R1_SW3]',
                'password_enable' => 'F!xed@2oo7[F5_R1_SW3]En@ble',
            ],
            [
                'hostname' => 'F5_R1_SW4',
                'ip' => '10.2.100.54',
                'platform' => 'WS-C2960X-24PD-L',
                'version' => '15.2(4)E8',
                'floor' => '5th',
                'location' => 'Rack1',
                'password' => 'F!xed@2oo7[F5_R1_SW4]',
                'password_enable' => 'F!xed@2oo7[F5_R1_SW4]En@ble',
            ],
            [
                'hostname' => 'F5_R1_SW5',
                'ip' => '10.2.100.55',
                'platform' => 'WS-C2960X-24PD-L',
                'version' => '15.2(4)E8',
                'floor' => '5th',
                'location' => 'Rack1',
                'password' => 'F!xed@2oo7[F5_R1_SW5]',
                'password_enable' => 'F!xed@2oo7[F5_R1_SW5]En@ble',
            ],
            [
                'hostname' => 'F5_R2_SW1',
                'ip' => '10.2.100.56',
                'platform' => 'WS-C2960X-24PD-L',
                'version' => '15.2(4)E8',
                'floor' => '5th',
                'location' => 'Rack2',
                'password' => 'F!xed@2oo7[F5_R2_SW1]',
                'password_enable' => 'F!xed@2oo7[F5_R2_SW1]En@ble',
            ],
            [
                'hostname' => 'F5_R2_SW2',
                'ip' => '10.2.100.57',
                'platform' => 'WS-C2960X-24PD-L',
                'version' => '15.2(4)E8',
                'floor' => '5th',
                'location' => 'Rack2',
                'password' => 'F!xed@2oo7[F5_R2_SW2]',
                'password_enable' => 'F!xed@2oo7[F5_R2_SW2]En@ble',
            ],
            [
                'hostname' => 'F5_R2_SW3',
                'ip' => '10.2.100.58',
                'platform' => 'WS-C2960X-24PD-L',
                'version' => '15.2(4)E8',
                'floor' => '5th',
                'location' => 'Rack2',
                'password' => 'F!xed@2oo7[F5_R2_SW3]',
                'password_enable' => 'F!xed@2oo7[F5_R2_SW3]En@ble',
            ],
            [
                'hostname' => 'F5_R2_SW4',
                'ip' => '10.2.100.59',
                'platform' => 'WS-C2960X-24PD-L',
                'version' => '15.2(4)E8',
                'floor' => '5th',
                'location' => 'Rack2',
                'password' => 'F!xed@2oo7[F5_R2_SW4]',
                'password_enable' => 'F!xed@2oo7[F5_R2_SW4]En@ble',
            ],
            [
                'hostname' => 'F5_R2_SW5',
                'ip' => '10.2.100.60',
                'platform' => 'WS-C2960X-24PD-L',
                'version' => '15.2(4)E8',
                'floor' => '5th',
                'location' => 'Rack2',
                'password' => 'F!xed@2oo7[F5_R2_SW5]',
                'password_enable' => 'F!xed@2oo7[F5_R2_SW5]En@ble',
            ],
            [
                'hostname' => 'F6_R1_SW1',
                'ip' => '10.2.100.61',
                'platform' => 'WS-C2960X-24PD-L',
                'version' => '15.2(4)E8',
                'floor' => '6th',
                'location' => 'Rack1',
                'password' => 'F!xed@2oo7[F6_R1_SW1]',
                'password_enable' => 'F!xed@2oo7[F6_R1_SW1]En@ble',
            ],
            [
                'hostname' => 'F6_R1_SW2',
                'ip' => '10.2.100.62',
                'platform' => 'WS-C2960X-24PD-L',
                'version' => '15.2(4)E8',
                'floor' => '6th',
                'location' => 'Rack1',
                'password' => 'F!xed@2oo7[F6_R1_SW2]',
                'password_enable' => 'F!xed@2oo7[F6_R1_SW2]En@ble',
            ],
            [
                'hostname' => 'F6_R2_SW1',
                'ip' => '10.2.100.64',
                'platform' => 'WS-C2960X-24PD-L',
                'version' => '15.2(4)E8',
                'floor' => '6th',
                'location' => 'Rack2',
                'password' => 'F!xed@2oo7[F6_R2_SW1]',
                'password_enable' => 'F!xed@2oo7[F6_R2_SW1]En@ble',
            ],
            [
                'hostname' => 'F6_R2_SW2',
                'ip' => '10.2.100.65',
                'platform' => 'WS-C2960X-24PD-L',
                'version' => '15.2(4)E8',
                'floor' => '6th',
                'location' => 'Rack2',
                'password' => 'F!xed@2oo7[F6_R2_SW2]',
                'password_enable' => 'F!xed@2oo7[F6_R2_SW2]En@ble',
            ],
        ];

        foreach ($switchs as $switch) {
            SwitchBranch::create($switch);
        }
    }
}
