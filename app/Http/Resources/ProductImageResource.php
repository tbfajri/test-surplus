<?php

namespace App\Http\Resources;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $product = $this->getProduct($this->product_id);
        $image = $this->getImage($this->image_id);
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'product_name' => $product->name,
            'image_id' => $this->image_id,
            'image_name' => $image->name,
            'image_file' => $image->file,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }

    private function getProduct($id){
        return Product::find($id);
    }

    private function getImage($id){
        return Image::find($id);
    }
}
