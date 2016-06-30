<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(CodeDelivery\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(CodeDelivery\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});

$factory->define(CodeDelivery\Models\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence(),
        'price' => $faker->numberBetween(10, 100)
    ];
});

$factory->define(CodeDelivery\Models\Client::class, function (Faker\Generator $faker) {
    return [
        'phone' => $faker->phoneNumber,
        'address' => $faker->address(),
        'city' => $faker->city(),
        'state' => $faker->state(),
        'zipcode' => $faker->postcode()
    ];
});

$factory->define(CodeDelivery\Models\Order::class, function (Faker\Generator $faker) {
    return [
        'client_id' => rand(1, 10),
        'total' => rand(50, 100),
        'status' => 0
    ];
});

$factory->define(CodeDelivery\Models\OrderItem::class, function (Faker\Generator $faker) {
    return [

    ];
});

$factory->define(CodeDelivery\Models\Cupom::class, function (Faker\Generator $faker) {
    return [
        'code' => rand(100, 1000),
        'value' => rand(50, 100)
    ];
});

$factory->define(CodeDelivery\Models\Hotel::class, function (Faker\Generator $faker) {
    return [
        'city_id'=> 530010,
        'name' => $faker->name,
        'latitude' => rand(-30.33, 30.33),
        'longitude' => rand(-30.33, 30.33)
    ];
});

$factory->define(CodeDelivery\Models\Employee::class, function (Faker\Generator $faker) {
    return [
        'hotel_id' => rand(1, 10)
    ];
});

$factory->define(CodeDelivery\Models\Guest::class, function (Faker\Generator $faker) {
    return [
        'email' => $faker->email,
        'fullname' => $faker->firstName,
        'ocupation'=> $faker->jobTitle,
        'nacionality'=> $faker->country,
        'birthdate'=> $faker->date(),
        'sex'=> $faker->randomElement([ 'M', 'F']),
        'travelDocIssuingCountry'=> 'SSP-DF',
        'travelDocType'=>'RG' ,
        'travelDocNumber'=> $faker->numberBetween(11111111111, 99999999999),
        'CPF'=> $faker->numberBetween(11111111111, 99999999999),
        'phone'=> $faker->phoneNumber,
        'cellphone'=> $faker->phoneNumber,
        'permanentAdress'=> $faker->address,
        'permanentZipcode'=> $faker->postcode,
        'permanentCity'=> $faker->city,
        'state'=> $faker->city,
        'country'=> $faker->country,
        'companyName'=> $faker->company,
        'companyAdress'=> $faker->address,
        'companyZipcode'=> $faker->postcode
    ];
});