<?php
 
namespace App\Http\Resources;
 
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $rate = !empty($this->clientprice) ? $this->clientprice : $this->service_price;
        return [
            'service' => $this->id,
            'category' => $this->category->category_name,
            'max' => $this->service_max,
            'min' => $this->service_min,
            'name' => $this->service_name,
            'rate' => $rate,
            'type' => \App\Libraries\Helpers::getServicePackage($this->service_package),
        ];
    }
}