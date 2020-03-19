<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscriber extends Model
{
    use SoftDeletes;

    protected $table = 'subscribers';
    protected $fillable = ['email_address', 'status', 'deleted_at', 'created_at', 'updated_at'];
    protected $dates = ['deleted_at'];


}
