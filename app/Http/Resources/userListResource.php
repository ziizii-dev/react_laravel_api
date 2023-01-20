<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class userListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return[
            "id"=>$this->id,
            "todo"=>$this->todo,
            "user_id"=>$this->user_id
        ];
    }
}
