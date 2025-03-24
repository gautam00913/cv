<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Portfolio extends Model
{
    /** @use HasFactory<\Database\Factories\PortfolioFactory> */
    use HasFactory;
    protected $fillable = ['title', 'description', 'picture', 'link', 'profile_id'];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }
}
