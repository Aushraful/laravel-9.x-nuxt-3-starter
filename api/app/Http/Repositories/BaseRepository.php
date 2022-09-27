<?php

namespace App\Http\Repositories;

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
abstract class BaseRepository
{
    //
}
