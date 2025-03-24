<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Education extends Model
{
    /** @use HasFactory<\Database\Factories\EducationFactory> */
    use HasFactory;

    protected $fillable = ['grade', 'description', 'year', 'profile_id'];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }
}
