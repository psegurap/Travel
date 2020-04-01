<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TripsComments extends Model
{
    use SoftDeletes;

    protected $table = 'trips_comments';
    protected $fillable = ['comment', 'user_name', 'user_email', 'language', 'trip_id', 'status', 'deleted_at', 'created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    public function replies(){
        return $this->hasMany('App\TripsCommentsReplies', 'comment_id', 'id');
    }
}
