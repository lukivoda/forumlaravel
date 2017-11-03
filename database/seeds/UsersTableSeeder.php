<?php

use App\User;
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
       User::create([
           'name' => "Steffi Ris Zmaj",
           // za da bide vistinskata strana vo linkot vo  .env namesto localhost vo APP_URL ja pisuvame vistiskata strana
           'avatar' => asset('uploads/avatars/1.jpg'),
           'email' => 'steffi@mail.com',
           'password' =>bcrypt('lucija'),
           'admin'    => 1
         
       ]);
    }
}
