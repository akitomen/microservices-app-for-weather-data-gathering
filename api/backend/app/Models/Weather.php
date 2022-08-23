<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    protected $fillable = [ 'city_id', 'temperature', 'wind_speed' ];

    protected $hidden = ['updated_at', 'created_at', 'city_id', 'id'];
}
