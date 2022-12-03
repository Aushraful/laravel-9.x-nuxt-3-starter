<?php

namespace App\Http\Repositories;

use App\Http\Repositories\BaseRepository;
use App\Models\Language;

class LanguageRepository extends BaseRepository
{
    /**
     * Create a new repository instance.
     *
     * @param  \App\Models\Language  $model
     * @return void
     */
    public function __construct(Language $model)
    {
        $this->model = $model;
    }
}
