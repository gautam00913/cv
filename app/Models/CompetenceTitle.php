<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompetenceTitle extends Model
{
    /** @use HasFactory<\Database\Factories\CompetenceTitleFactory> */
    use HasFactory;

    protected $fillable = ['name'];

    public function competences(): HasMany
    {
        return $this->hasMany(Competence::class);
    }
}
