<?php

use Illuminate\Database\Seeder;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CodeDelivery\Models\User::class, 1)->create([
            'email' => 'employee@gmail.com',
            'password' => bcrypt(123456),
            'name' => 'Sérgio Henrique',
            'role' => 'employee'
        ])->employee()->save( factory( \CodeDelivery\Models\Employee::class)->make(['hotel_id' => 1]) );

        factory(CodeDelivery\Models\User::class, 10)->create()->each(function($u){
            $u->employee()->save( factory( \CodeDelivery\Models\Employee::class)->make() );
        });

    }
}
