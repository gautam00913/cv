<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource
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
            'title' => $this->getTranslations('title'),
            'description' => $this->getTranslations('description'),
            'image' => $this->picture ? asset('storage/'. $this->picture) : asset('images/portfolio.jpg'),
            'githubUrl' => $this->github_link,
            'liveUrl' => $this->link,
            'featured' => $this->featured,
            'technologies' => $this->technologies ? explode(',', $this->technologies) : [],
        ];
    }
}