<?php

namespace Modules\Category\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Transformers\UserResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'category' => $this->category,
            'description' => $this->description,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];

        if ($this->relationLoaded('creator')) {
            $data['created_by'] = $this->getCreatedBy();
        }

        return $data;
    }

    /**
     * Get the associated creator
     *
     * @return array|null
     */
    protected function getCreatedBy()
    {
        if (!$this->creator) return null;

        return (new UserResource($this->creator))
            ->toArray(request());
    }
}
