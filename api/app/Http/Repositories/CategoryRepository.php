<?php

namespace App\Http\Repositories;

use App\Http\Repositories\BaseRepository;
use App\Models\Category;

class CategoryRepository extends BaseRepository
{
    /**
     * Create a new repository instance.
     *
     * @param  \App\Models\Category  $model
     * @return void
     */
    public function __construct(Category $model)
    {
        $this->model = $model;
    }
}
