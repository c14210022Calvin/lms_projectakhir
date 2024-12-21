<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            ['name' => 'John Doe', 
            'email' => 'john.doe@example.com', 
            'phone' => '1234567890'],

            ['name' => 'Jane Smith', 
            'email' => 'jane.smith@example.com', 
            'phone' => '9876543210'],

            ['name' => 'Alice Johnson', 
            'email' => 'alice.johnson@example.com', 
            'phone' => '4567891230'],

            ['name' => 'Bob Brown', 
            'email' => 'bob.brown@example.com', 
            'phone' => '6543219870'],

            ['name' => 'Charlie White', 
            'email' => 'charlie.white@example.com', 
            'phone' => '7891234560'],
        ];

        foreach ($members as $member) {
            Member::create($member);
        }
    }
}
