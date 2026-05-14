<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    public function getTNameAttribute(): string
    {
        return app()->getLocale() == 'fr' ? $this->fr_Name : $this->Name;
    }

    public function visits() : HasMany
    {
        return $this->hasMany(Visit::class, 'country_code', 'code');
    }
}