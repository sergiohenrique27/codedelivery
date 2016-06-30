<?php

use Illuminate\Database\Seeder;

class GuestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CodeDelivery\Models\User::class, 1)->create([
            'email' => 'guest@gmail.com',
            'password' => bcrypt(123456),
            'name' => 'Sérgio Henrique',
            'role' => 'guest'
        ])->guest()->save( factory( \CodeDelivery\Models\Guest::class)->make() );
    }
}
