<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Portfolio extends Model
{
    /** @use HasFactory<\Database\Factories\PortfolioFactory> */
    use HasFactory, HasTranslations;
    protected $fillable = ['title', 'description', 'picture', 'link', 'status', 'done_at',
     'github_link', 'featured', 'technologies', 'sort', 'profile_id'];
    public array $translatable = ['title', 'description'];

    protected $casts = [
        'done_at' => 'date',
        'featured' => 'boolean'
    ];

    public function scopeOnline(Builder $query)
    {
        return $query->where('status', 1);
    }


    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }
}