<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visit extends Model
{
    /** @use HasFactory<\Database\Factories\VisiteFactory> */
    use HasFactory;

    protected $fillable = ['ip_address', 'country_code', 'uag', 'date'];

    public $timestamps = false;

    protected $casts = [
        'date' => 'datetime',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_code', 'code');
    }
}
