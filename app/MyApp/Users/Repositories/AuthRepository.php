<?php

namespace App\MyApp\Users\Repositories;

use MyApp\Base\Repository;
use MyApp\Users\Model\User;

class AuthRepository extends Repository
{

    public function register($data)
    {
        $user = User::create($data);
        return $user->createToken('LaravelAuthApp')->accessToken;
    }
}
