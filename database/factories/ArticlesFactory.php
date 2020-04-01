<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {

    static $imgNumber = 1;

    $faker = \Faker\Factory::create('ru_RU');
    return [
        'title' => $faker->RealText(100),
        'abbrText' => $faker->RealText(300),
        'fullText' => $faker->RealText(2000),
        'photo' => 'articles_img/'.$imgNumber++.'.jpg',
    ];
});
