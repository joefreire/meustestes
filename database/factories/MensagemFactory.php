<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use App\Models\Mensagem;
use Faker\Generator as Faker;




$factory->define(Mensagem::class, function (Faker $faker) {
    return [
        'destinatario_id' => $faker->numberBetween(1,5),
        'remetente_id' => $faker->numberBetween(1,5),
        'mensagem' => $faker->realText(40),
    ];
});
