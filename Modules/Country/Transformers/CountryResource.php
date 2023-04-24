<?php

namespace Modules\Country\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'short_name' => $this->short_name,
            'full_name' => $this->full_name,
            'calling_code' => $this->calling_code,
            'capital' => $this->capital,
            'currency' => $this->currency,
            'citizenship' => $this->citizenship,
            'flag' => $this->getFlagUrl()
        ];
    }

    /**
     * Get the flag url using a flags API
     *
     * @return string
     */
    private function getFlagUrl()
    {
        return config('app.flag_url') . strtoupper($this->flag) . '.png';
    }
}
