<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Validator;


class ImageController extends BaseController
{
    /**
     * Display a listing of the resource
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $categorys = Image::all();
        return $this->sendResponse(ImageResource::collection($categorys), 'Products retrieved successfully');
        
    }

     /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'file' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
            'name' => 'required'
        ]);

        if ($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $imageName = $input['name'].'.'.$request->file->extension();  
        
        $request->file->move('images', $imageName);

        $data = [
            'name' => $input['name'],
            'enable' => $input['enable'],
            'file' => asset('images') .'/'.$imageName
        ];
        $image = Image::create($data);
         return $this->sendResponse(new ImageResource($image), 'Image upload successfully');
    }

    public function show($id): JsonResponse
    {
        $image = Image::find($id);

        if (is_null($image)){
            return $this->sendError('Image not found');
        }

        return $this->sendResponse(new ImageResource($image), 'Image retrieved successfully');
    }

    /**
     * Update the specifed resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Image $image)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required'
        ]);

        if ($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $image->name = $input['name'];
        $image->save();

         return $this->sendResponse(new ImageResource($image), 'Image upload successfully');
    }
    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Image $image): JsonResponse
    {
        $image->delete();
        return $this->sendResponse([], 'Image deleted successfully');
    }
}
