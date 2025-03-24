<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Competence extends Model
{
    /** @use HasFactory<\Database\Factories\CompetenceFactory> */
    use HasFactory;

    protected $fillable = ['tag', 'competence_title_id', 'competence_sub_title_id', 'other_competence', 'profile_id'];

    public function competenceTitle(): BelongsTo
    {
        return $this->belongsTo(CompetenceTitle::class);
    }
    
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function competenceSubTitle(): BelongsTo
    {
        return $this->belongsTo(CompetenceSubTitle::class);
    }
}
