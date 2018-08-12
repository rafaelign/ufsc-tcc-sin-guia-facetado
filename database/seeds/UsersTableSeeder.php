<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create([
            'name'      => 'Administrator',
            'email'     => 'admin@mailinator.com',
            'password'  => bcrypt('123123'),
        ]);
    }

    private function create(array $user)
    {
        DB::table('users')->insert($user);

        $this->command->info("User {$user['email']} created");
    }
}
