<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = new User();
        $status->name = 'Admin';
        $status->email = 'admin@mail.ru';
        $status->password = Hash::make('admin');
        $status->role = '1';
        $status->save();

    }
}
