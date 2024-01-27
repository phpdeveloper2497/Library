<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Auth\Access\Gate;

class CategoryController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth:sanctum');
         $this->authorizeResource(Category::class, 'category');
    }

    public function index()
    {

        return $this->response(CategoryResource::collection(Category::all()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
//        Gate::authorize('category:create');
//        if ($request->user()->hasPermissionTo('category:create'))
//        {
//        dd($request->toArray());
            $category = Category::create($request->toArray());
            return $this->success('Category created', $category);
//        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return true;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->success('Category deleted successfully');
    }
}
