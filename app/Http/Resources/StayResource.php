<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => ucfirst($this->title),
            'image' => $this->image,
            'description' => $this->description,
            'amenities' => $this->amenities,
            'rooms' => $this->rooms,
            'beds' => $this->beds,
            'type' =>  $this->type,
            'location' => ucfirst($this->location),
            'price' => $this->price,
            'ratings' => $this->ratings->avg('rating'),
            'feedbacks' => $this->feedbacks->count(),
            'feedbacks_mark' => $this->feedbacks->avg('mark')
        ];
    }
}
