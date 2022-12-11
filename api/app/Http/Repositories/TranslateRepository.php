<?php

namespace App\Http\Repositories;

use App\Traits\ApiResponseTrait;
use Illuminate\Http\Response;

/**
 * The **Repository Pattern** is an addition to the MVC pattern.
 * It fits right between the Controller and the Model so the controller never interacts directly with the Model.
 *
 * The aim is to:
 * - Lighten controllers by moving the query building and logic into the repositories.
 * - Improve readability and maintainability.
 * - Reduce code redundancy as the super-class `ResourceRepository` contains most frequent queries.
 *
 * @author Aushraful Alam
 */
abstract class TranslateRepository extends BaseRepository
{
    use ApiResponseTrait;

    /**
     * Get all translated items with pagination
     */
    public function getTranslatedPaginated()
    {
        return $this->model->translatedIn($this->locale)->latest()->paginate($this->limit);
    }

    /**
     * Resource relative behavior for saving a translated record.
     *
     * @param  array  $data
     * @return model
     */
    public function saveTranslated(array $data)
    {
        $this->model->create($data);

        return $this->model->translatedIn($this->locale)->latest()->paginate($this->limit);
    }

    /**
     * Get specific item by id or fail
     *
     * @return model
     */
    public function findTranslatedBySlug($slug)
    {
        try {
            return $this->model->whereTranslation('slug', $slug)->firstOrFail();
        } catch (\Throwable $th) {
            return Self::apiResponseError(NULL, 'Not Found!', Response::HTTP_NOT_FOUND);
        }
    }
}
