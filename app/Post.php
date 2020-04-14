<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Category;

class Post extends Model
{
    use SoftDeletes;

    protected $table = 'posts';
    protected $fillable = ['title_es', 'title_en', 'content_es', 'content_en', 'img_thumbnail', 'picture_path', 'user_id', 'short_description_es', 'short_description_en', 'status', 'deleted_at', 'created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    public function categories(){
        return $this->belongsToMany('App\Category', 'categories_posts', 'post_id', 'category_id')->withTimestamps();
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function comments(){
        return $this->hasMany('App\PostsComments', 'post_id', 'id');
    }

}
