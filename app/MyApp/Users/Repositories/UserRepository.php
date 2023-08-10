<?php

namespace App\MyApp\Users\Repositories;

use MyApp\Base\Repository;
use MyApp\Users\Model\User;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }
}
