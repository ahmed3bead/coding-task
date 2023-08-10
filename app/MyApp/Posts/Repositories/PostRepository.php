<?php

namespace App\MyApp\Posts\Repositories;

use MyApp\Posts\Model\Post;
use Prettus\Repository\Eloquent\BaseRepository;

class PostRepository extends BaseRepository
{

    public function model()
    {
        return Post::class;
    }
}
