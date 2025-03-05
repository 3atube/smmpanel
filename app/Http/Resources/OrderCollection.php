<?php
 
namespace App\Http\Resources;
 
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $recordsFiltered = $request->recordsFiltered ? $request->recordsFiltered : $this->collection->count();
        return [
            'data' => OrderResource::collection($this->collection),
            'recordsFiltered' => $recordsFiltered,
        ];
    }
}