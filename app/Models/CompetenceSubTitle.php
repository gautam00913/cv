<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CompetenceSubTitle extends Model
{
    /** @use HasFactory<\Database\Factories\CompetenceSubTitleFactory> */
    use HasFactory;

    protected $fillable = ['name'];

    public function competences(): HasMany
    {
        return $this->hasMany(Competence::class);
    }
}
