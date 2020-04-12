<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {
    return [
          'title'=>$faker->randomElement([


            'دوربین',
          'پاوربانک','شارژر','مودم','اسپیکر',
          ]),

          'description'=>'محصولات حوزه ی فناوری و آی تی موبایل ',

          'image'=> 'https://place-hold.it/300',

          'price'=>$faker->randomElement([
15000,56000,450000,89000,465000

          ]),
          'stock'=>$faker->randomDigitNotNull
    ];
});
