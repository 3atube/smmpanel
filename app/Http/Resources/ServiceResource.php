<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Auth;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $feature = (object) array(
            'quality' => $this->quality,
            'refill' => $this->guarantee,
            'speed' => $this->speed_per_day,
            'start' => $this->start_time,
        );
        $rate = !empty($this->clientprice) ? $this->clientprice : $this->service_price;
        return [
            'id' => $this->id,
            'cat' => $this->category->category_name,
            'catid' => $this->category_id,
            'desc' => $this->service_description,
            'max' => $this->service_max,
            'min' => $this->service_min,
            'name' => $this->service_name,
            'rate' => $rate,
            'type' => \App\Libraries\Helpers::getServicePackage($this->service_package),
            'feature' => $feature
        ];
    }
}
