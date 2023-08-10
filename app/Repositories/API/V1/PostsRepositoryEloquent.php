<?php

namespace App\Repositories\API\V1;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\API\V1\PostsRepository;
use App\Entities\API\V1\Posts;
use App\Validators\API\V1\PostsValidator;

/**
 * Class PostsRepositoryEloquent.
 *
 * @package namespace App\Repositories\API\V1;
 */
class PostsRepositoryEloquent extends BaseRepository implements PostsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Posts::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
