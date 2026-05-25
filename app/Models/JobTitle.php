<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class JobTitle extends Model
{
    /** @use HasFactory<\Database\Factories\JobTitleFactory> */
    use HasFactory, HasTranslations;

    protected $fillable = ['name'];
    public array $translatable = ['name'];


    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class);
    }
}