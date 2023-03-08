<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\ProductImageResource;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Validator;

class ProductImageController extends BaseController
{
      /**
     * Display a listing of the resource
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $productImages = ProductImage::all();
        return $this->sendResponse(ProductImageResource::collection($productImages), 'Products Image retrieved successfully');
        
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
            'image_id' => 'required|numeric'
        ]);

        if ($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $product_id = Product::find($input['product_id']);
        $image_id = Image::find($input['image_id']);

        // dd($image_id);
        if(!$product_id || !$image_id){
            return $this->sendError('Product Or Image Not Found.', []);
        }

        $categoryProduct = ProductImage::create($input);

        return $this->sendResponse(new ProductImageResource($categoryProduct), 'ProductImage created successfully');
    }

    /**
     * Display the specified resource.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id): JsonResponse
    {
        $categoryProduct = ProductImage::find($id);

        if (is_null($categoryProduct)){
            return $this->sendError('Image Product not found');
        }

        return $this->sendResponse(new ProductImageResource($categoryProduct), 'Product Image retrieved successfully');
    }

    /**
     * Update the specifed resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, ProductImage $productImage): JsonResponse
    {
        
        $input = $request->all();
        $validator = Validator::make($input, [
            'product_id' => 'required|numeric',
            'image_id' => 'required|numeric'
        ]);

        if ($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $product_id = Product::find($input['product_id']);
        $image_id = Image::find($input['image_id']);

        if(!$product_id || !$image_id){
            return $this->sendError('Product Or Image Not Found.', []);
        }
        
        $productImage->product_id = $input['product_id'];
        $productImage->image_id = $input['image_id'];
        $productImage->save();

        return $this->sendResponse(new ProductImageResource($productImage), 'Product Image update successfully.');
    }
    /**
     * Remove the specified resource from storage
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */

     public function destroy(ProductImage $productImage): JsonResponse
     {
        $productImage->delete();
        return $this->sendResponse([], 'Product Image deleted successfully');
     }
}
