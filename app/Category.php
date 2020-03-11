<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';
    protected $fillable = ['category_name_es', 'category_name_en', 'status', 'deleted_at', 'created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    public function trips(){
        return $this->belongsToMany('App\Trip', 'categories_trips', 'category_id', 'trip_id')->withTimestamps();
    }

    public function posts(){
        return $this->belongsToMany('App\Post', 'categories_posts', 'category_id', 'post_id')->withTimestamps();
    }
}
