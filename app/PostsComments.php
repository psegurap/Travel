<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostsComments extends Model
{
    use SoftDeletes;

    protected $table = 'posts_comments';
    protected $fillable = ['comment', 'user_name', 'user_email', 'language', 'post_id', 'status', 'deleted_at', 'created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    public function replies(){
        return $this->hasMany('App\PostsCommentsReplies', 'comment_id', 'id');
    }
}
