<?php

namespace App\Http\Resources\Dashboard\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\Section\ShowCategorySectionResource;

class ShowCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $titles = getTranslationAndLocale($this?->translations, 'title');
        return [
            'id' => $this->id ?? 0,
            'titles' => $titles ?? [],
            'id_category' => $this->id_category ?? "",
            'image' => $this->imageLink ?? "",
            'section_count'=>count($this->sections),
            'sections' => ShowCategorySectionResource::collection($this->sections ?? []) ?? []
        ];
    }
}
