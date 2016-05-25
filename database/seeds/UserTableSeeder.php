<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CodeDelivery\Models\User::class)->create([
            'email' => 'sergio27@gmail.com',
            'password' => bcrypt(123456),
            'name' => 'Sérgio Henrique',
            'role' => 'admin'
        ]);

        factory(CodeDelivery\Models\User::class, 10)->create()->each(function($u){
            $u->client()->save( factory( \CodeDelivery\Models\Client::class)->make() );
        });

        factory(CodeDelivery\Models\User::class, 3)->create([
           'role' => 'deliveryman'
        ]);
    }
}
