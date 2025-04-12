<?php

namespace App\Http\Resources\Dashboard\Category;

use App\Http\Resources\Dashboard\Section\CategorySectionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $title = getTranslation('title', $request->header('Accept-Language'), $this);
        return [
            'id' => $this->id ?? 0,
            'title' => $title ?? "",
            'id_category' => $this->id_category ?? "",
            'image' => $this->imageLink ?? "",
            'section_count'=>count($this->sections),
            'sections' => CategorySectionResource::collection($this->sections ?? []) ?? []
        ];
    }
}
