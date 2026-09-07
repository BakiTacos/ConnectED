<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Hash Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default hash driver that gets used while
    | hashing passwords in your application. By default, the bcrypt algorithm
    | is used; however, you remain free to modify this option if you wish.
    |
    | Supported: "bcrypt", "argon", "argon2id"
    |
    */

    'driver' => (!empty(env('HASH_DRIVER')) ? env('HASH_DRIVER') : 'bcrypt'),

    /*
    |--------------------------------------------------------------------------
    | Bcrypt Options
    |--------------------------------------------------------------------------
    |
    | Here you may specify the configuration options for when passwords are
    | hashed using the Bcrypt algorithm. This will allow you to control the
    | amount of time it takes to hash the given password, etc.
    |
    */

    'bcrypt' => [
        'rounds' => (int) (!empty(env('BCRYPT_ROUNDS')) ? env('BCRYPT_ROUNDS') : 12),
        'verify' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Argon Options
    |--------------------------------------------------------------------------
    |
    | Here you may specify the configuration options for when passwords are
    | hashed using the Argon algorithm. These will allow you to control the
    | amount of time and memory it takes to hash the given password.
    |
    */

    'argon' => [
        'memory' => 65536,
        'threads' => 1,
        'time' => 4,
        'verify' => false,
    ],

];
