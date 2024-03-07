<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaginateResource extends JsonResource
{
    public function __construct($resource, protected $resourceCollection)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "current_page"  => $this->currentPage(),
            "last_page"     => $this->lastPage(),
            "per_page"      => $this->perPage(),
            "total"         => $this->total(),
            "data"          => $this->resourceCollection::collection($this->items()),
        ];
    }
}
