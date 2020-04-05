<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorldCountries extends Model
{
    protected $table = 'world_countries';
    protected $fillable = ['country_en', 'country_es', 'status', 'deleted_at', 'created_at', 'updated_at'];
    protected $dates = ['deleted_at'];
}
