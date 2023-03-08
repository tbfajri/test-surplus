<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryProduct extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $product = $this->getProduct($this->product_id);
        $category = $this->getCategory($this->category_id);
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'product_name' => $product->name,
            'category_id' => $this->category_id,
            'category_name' => $category->name,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }

    private function getProduct($id){
        return Product::find($id);
    }

    private function getCategory($id){
        return Category::find($id);
    }
}
