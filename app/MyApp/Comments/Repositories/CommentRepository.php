<?php

namespace App\MyApp\Comments\Repositories;

use App\MyApp\Comments\Model\Comment;
use Prettus\Repository\Eloquent\BaseRepository;

class CommentRepository extends BaseRepository
{

    public function model()
    {
        return Comment::class;
    }
}
