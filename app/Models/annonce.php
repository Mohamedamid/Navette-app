<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class annonce extends Model
{
    /** @use HasFactory<\Database\Factories\AnnonceFactory> */
    use HasFactory;
    protected $fillable = [
        'company_id',
        'departure_city',
        'arrival_city',
        'departure_time',
        'arrival_time',
        'bus_description',
        'status',
    ];
}
