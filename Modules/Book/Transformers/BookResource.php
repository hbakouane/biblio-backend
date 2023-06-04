<?php

namespace Modules\Book\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Profile\Transformers\ProfileResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'excerpt' => $this->excerpt,
            'author' => $this->author,
            'description' => $this->description,
            'category' => $this->category,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        if ($this->relationLoaded('publisher')) {
            $data['publisher'] = $this->getPublisher();
        }

        return $data;
    }

    /**
     * Get the publisher of the book
     *
     * @return ProfileResource|null
     */
    private function getPublisher()
    {
        $publisher = $this->publisher;

        if (! $publisher) return null;

        return new ProfileResource($publisher);
    }
}
