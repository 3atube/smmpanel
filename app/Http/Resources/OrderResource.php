<?php
 
namespace App\Http\Resources;
 
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $arr = [
            'id' => $this->id,
            'service_id' => $this->service_id,
            'service' => $this->service ? $this->service->service_name : null,
            'remains' => $this->order_remains,
            'order_more_quantity' => $this->order_more_quantity,
            'quantity' => $this->order_quantity,
            'note' => $this->order_extras,
            'link' => $this->order_url,
            'refill' => $this->refill,
            'schedule' => $this->schedule,
            'partialed' => $this->partialed,
            'created' => $this->order_create,
            'charge' => $this->order_charge,
            'changed' => $this->order_create > $this->updated_at ? $this->order_create : $this->updated_at,
            'start' => $this->order_start,
            'status' => \App\Libraries\Helpers::getStatusOrder($this->order_status),
        ];
        return $arr;
    }
}