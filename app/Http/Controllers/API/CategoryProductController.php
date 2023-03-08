<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use App\Models\Category;
use App\Models\Product;
use Validator;
use App\Http\Resources\CategoryProduct as CategoryProductResource;
use Illuminate\Http\JsonResponse;

class CategoryProductController extends BaseController
{
     /**
     * Display a listing of the resource
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $categoryProducts = CategoryProduct::all();
        return $this->sendResponse(CategoryProductResource::collection($categoryProducts), 'Products retrieved successfully');
        
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
            'product_id' => 'required|numeric',
            'category_id' => 'required|numeric'
        ]);

        if ($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $product_id = Product::find($input['product_id']);
        $category_id = Category::find($input['category_id']);
        if(!$product_id || !$category_id){
            return $this->sendError('Product Or Category Not Found.', []);
        }

        $categoryProduct = CategoryProduct::create($input);

        return $this->sendResponse(new CategoryProductResource($categoryProduct), 'CategoryProduct created successfully');
    }

    /**
     * Display the specified resource.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id): JsonResponse
    {
        $categoryProduct = CategoryProduct::find($id);

        if (is_null($categoryProduct)){
            return $this->sendError('Category Product not found');
        }

        return $this->sendResponse(new CategoryProductResource($categoryProduct), 'CategoryProduct retrieved successfully');
    }

    /**
     * Update the specifed resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, CategoryProduct $categoryProduct): JsonResponse
    {
        
        $input = $request->all();
        $validator = Validator::make($input, [
            'product_id' => 'required|numeric',
            'category_id' => 'required|numeric'
        ]);

        if ($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $product_id = Product::find($input['product_id']);
        $category_id = Category::find($input['category_id']);
        if(!$product_id || !$category_id){
            return $this->sendError('Product Or Category Not Found.', []);
        }
        
        $categoryProduct->product_id = $input['product_id'];
        $categoryProduct->category_id = $input['category_id'];
        $categoryProduct->save();

        return $this->sendResponse(new CategoryProductResource($categoryProduct), 'CategoryProduct update successfully.');
    }
    /**
     * Remove the specified resource from storage
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */

     public function destroy(CategoryProduct $categoryProduct): JsonResponse
     {
        $categoryProduct->delete();
        return $this->sendResponse([], 'CategoryProduct deleted successfully');
     }
}
