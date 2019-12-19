<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use App\Models\Mensagem;
use Faker\Generator as Faker;




$factory->define(Mensagem::class, function (Faker $faker) {
    return [
        'destinatario_id' => 1,
        'remetente_id' => $faker->numberBetween(2,5),
        'mensagem' => $faker->realText(40),
    ];
});
