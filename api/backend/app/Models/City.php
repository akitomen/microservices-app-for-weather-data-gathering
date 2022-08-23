<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class City extends Model
{
    use HasFactory;

    protected $fillable = [ 'name' ];

    protected $hidden = ['updated_at', 'created_at'];

    /**
     * Get all the weather
     * @return HasMany
     */
    public function weather(): HasMany
    {
        return $this->hasMany(Weather::class)->latest();
    }

    /**
     * Get the latest weather
     * @return HasOne
     */
    public function lastWeather(): HasOne
    {
        return $this->hasOne(Weather::class)->latest();
    }
}
