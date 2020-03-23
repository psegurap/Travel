<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BroadcastRecord extends Model
{
    protected $table = 'broadcast_record';
    protected $fillable = ['subject', 'language', 'user_id', 'deleted_at', 'created_at', 'updated_at'];
    protected $dates = ['deleted_at'];
}
