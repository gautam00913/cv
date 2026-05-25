<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Portfolio extends Model
{
    /** @use HasFactory<\Database\Factories\PortfolioFactory> */
    use HasFactory, HasTranslations;
    protected $fillable = ['title', 'description', 'picture', 'link', 'profile_id'];
    public array $translatable = ['title', 'description'];


    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }
}