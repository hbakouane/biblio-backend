<?php

namespace Modules\Order\Transformers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Book\Transformers\BookResource;
use Modules\Profile\Transformers\ProfileResource;

class OrderResource extends JsonResource
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
            'status' => $this->status,
            'total' => $this->total,
            'note' => $this->note,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];

        if ($this->relationLoaded('items')) {
            $data['items'] = $this->getItems();
        }

        if ($this->relationLoaded('customer')) {
            $data['customer'] = $this->getCustomer();
        }

        return $data;
    }

    /**
     * Get the associated items
     *
     * @return AnonymousResourceCollection|null
     */
    private function getItems()
    {
        /*
         * For now, we have just books, therefor we won't add a new resource
         * called ItemResource, we will use just the BookResource class
         * TODO: Change to item resource when we have not only books
         */
        $items = $this->items;

        foreach ($items as $key => $item) {
            $items[$key] = $item->item;
        }

        if (!$items) return null;

        return BookResource::collection($items);
    }

    /**
     * Get the associated customer
     *
     * @return ProfileResource|null
     */
    private function getCustomer()
    {
        $customer = $this->customer;

        if (! $customer) return null;

        return new ProfileResource($customer);
    }
}
