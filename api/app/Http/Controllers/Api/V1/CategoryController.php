<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Repositories\CategoryRepository;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponseTrait;

    public $repository;

    /**
     * Create a new CategoryRepository Instance
     *
     * @return CategoryRepository
     */

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->repository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Category::translatedIn('en')->latest()->take(20)->get();

        try {

            return $this->repository->getPaginated();
        } catch (\Exception $e) {

            return self::apiServerError($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryCreateRequest $request)
    {
        try {

            return $this->repository->saveTranslated($request->validated());
        } catch (\Exception $e) {

            return self::apiServerError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            return $this->repository->findTranslatedBySlug($id);
            return $this->repository->findByID($id);
        } catch (\Exception $e) {

            return self::apiServerError($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, CategoryUpdateRequest $request)
    {
        try {
            return $this->repository->update($id, $request->validated());
        } catch (\Exception $e) {

            return self::apiServerError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            return $this->repository->destroy($id);
        } catch (\Exception $e) {

            return self::apiServerError($e->getMessage());
        }
    }
}
