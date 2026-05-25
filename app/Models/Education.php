<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Education extends Model
{
    /** @use HasFactory<\Database\Factories\EducationFactory> */
    use HasFactory, HasTranslations;

    protected $fillable = ['grade', 'description', 'year', 'profile_id'];
    public array $translatable = ['grade', 'description'];


    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }
}