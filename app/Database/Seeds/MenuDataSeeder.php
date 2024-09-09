<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuDataSeeder extends Seeder
{
    public function run()
    {
        // Insert sample data into the User table for multiple users
        $user_data = [
            [
                'username' => 'User1 Lastname1',
                'role' => 'user1@example.com',
                'password_hash' => '123-456-2232',
                'status' => 'https://user1.com',
            ],
            [
                'username' => 'User1 Lastname1',
                'role' => 'user1@example.com',
                'password_hash' => '123-456-2232',
                'status' => 'https://user1.com',
            ],
            [
                'username' => 'User1 Lastname1',
                'role' => 'user1@example.com',
                'password_hash' => '123-456-2232',
                'status' => 'https://user1.com',
            ],
            // Add more users as needed
        ];

        $userIds = [];

        foreach ($user_data as $user) {
            $this->db->table('User')->insert($user);
            $userIds[] = $this->db->insertID();
        }
        $businesses = [
            [
                'name' => 'Business 1',
                'table' => 5,
            ],
            [
                'name' => 'Business 2',
                'table' => 10,
            ],
            // Add more businesses as needed
        ];

        foreach ($businesses as $key => $business) {
            // Assign a user to the business
            $business['user_id'] = $userIds[$key];

            // Insert business
            $this->db->table('Business')->insert($business);
        }

        $menus = [
            ['business_id' => 1,
                'title' => 'Restoran Mantap']
        ]; 
        foreach ($menus as $menu) {
        // Insert business
        $this->db->table('menu')->insert($menu);
        }
    }
}