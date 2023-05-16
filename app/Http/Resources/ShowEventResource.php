<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowEventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'sport' => $this->sportName,
            'date' => $this->date,
            'time' => $this->time,
            'description' => $this->description,
            'created_by' => $this->user,
            'teams' => TeamResource::collection($this->teams)

        ];
    }
}
