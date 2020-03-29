<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuickFeedback extends Model
{
    use SoftDeletes;

    protected $table = 'quick_feedback';
    protected $fillable = ['visitor_name', 'visitor_feedback', 'img_thumbnail', 'language', 'status', 'deleted_at', 'created_at', 'updated_at'];
    protected $dates = ['deleted_at'];
}
