<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    /** @use HasFactory<\Database\Factories\VisiteFactory> */
    use HasFactory;
    protected $fillable = ['ip_address', 'country_code', 'uag', 'date'];
    public $timestamps = false;
}
