<?php

namespace App\Http\Repositories;

use App\Http\Repositories\TranslateRepository;
use App\Models\Category;

class CategoryRepository extends TranslateRepository
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
