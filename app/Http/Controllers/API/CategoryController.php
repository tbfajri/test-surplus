<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\JsonResponse;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $categorys = Category::all();
        return $this->sendResponse(CategoryResource::collection($categorys), 'Products retrieved successfully');
        
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'enable' => 'required|numeric|min:0|max:1'
        ]);

        if ($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $category = Category::create($input);

        return $this->sendResponse(new CategoryResource($category), 'Category created successfully');
    }

    /**
     * Display the specified resource.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id): JsonResponse
    {
        $category = Category::find($id);

        if (is_null($category)){
            return $this->sendError('Category not found');
        }

        return $this->sendResponse(new CategoryResource($category), 'Category retrieved successfully');
    }

    /**
     * Update the specifed resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, Category $category): JsonResponse
    {
        
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'enable' => 'required|numeric|digits_between:0,1'
        ]);

        if ($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $category->name = $input['name'];
        $category->enable = $input['enable'];
        $category->save();

        return $this->sendResponse(new CategoryResource($category), 'Category update successfully.');
    }
    /**
     * Remove the specified resource from storage
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
        return $this->sendResponse([], 'Category deleted successfully');
    }
}
