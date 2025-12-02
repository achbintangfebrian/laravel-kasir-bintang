<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [];
        $customerNames = [
            'John Doe', 'Jane Smith', 'Robert Johnson', 'Emily Davis', 
            'Michael Wilson', 'Sarah Brown', 'David Taylor', 'Lisa Anderson',
            'James Thomas', 'Jennifer Jackson'
        ];
        
        $phoneNumbers = [
            '081234567890', '082345678901', '083456789012', '084567890123',
            '085678901234', '086789012345', '087890123456', '088901234567',
            '089012345678', '080123456789'
        ];
        
        foreach ($customerNames as $index => $name) {
            $customers[] = [
                'name' => $name,
                'phone' => $phoneNumbers[$index] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        DB::table('customers')->insert($customers);
    }
}