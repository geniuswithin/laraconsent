<?php

namespace Ekoukltd\LaraConsent\Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Ekoukltd\LaraConsent\Models\ConsentOption;
use Illuminate\Database\Seeder;

class ConsentOptionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create(
            [
                'name' => 'User Tester',
                'email' => 'testing@ekouk.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password')
            ]
        );
    
        Admin::factory()->create(
            [
                'name' => 'Admin Tester',
                'email' => 'admin@ekouk.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password')
            ]
        );
    }
}
