<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'=>$this->product_name,
            'description'=>$this->details,
            'price'=>$this->price,
            'totalPrice'=>round( (1- ($this->discount/100))*$this->price, 2),
            'stock'=>$this->stock == 0? "Out of Stock": $this->stock,
            'discount'=>$this->discount,
            'status'=>($this->status == 1)?'Active':'Inactive',
            'rating'=> $this->reviews->count() >0 ? round($this->reviews->sum('star')/$this->reviews->count(), 2):"No Rating Yet",
            'href'=>[
                'reviews'=>route('reviews.index', $this->id),
            ]
        ];
    }
}
