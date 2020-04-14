<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostsCommentsReplies extends Model
{
    use SoftDeletes;

    protected $table = 'posts_comments_replies';
    protected $fillable = ['comment', 'user_name', 'user_email', 'language', 'comment_id', 'status', 'deleted_at', 'created_at', 'updated_at'];
    protected $dates = ['deleted_at'];
}
