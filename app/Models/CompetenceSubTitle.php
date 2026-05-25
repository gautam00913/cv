<?php

namespace App\Models;

use App\Models\Competence;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class CompetenceSubTitle extends Model
{
    /** @use HasFactory<\Database\Factories\CompetenceSubTitleFactory> */
    use HasFactory, HasTranslations;

    protected $fillable = ['name'];
    public array $translatable = ['name'];

    public function competences(): HasMany
    {
        return $this->hasMany(Competence::class);
    }
}