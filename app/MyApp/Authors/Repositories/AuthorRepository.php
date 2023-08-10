<?php

namespace App\MyApp\Authors\Repositories;

use App\MyApp\Authors\Model\Author;
use Prettus\Repository\Eloquent\BaseRepository;

class AuthorRepository extends BaseRepository
{

    public function model()
    {
        return Author::class;
    }
}
