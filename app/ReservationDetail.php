<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservationDetail extends Model
{
    use SoftDeletes;

    protected $table = 'reservations_details';
    protected $fillable = ['adults_amount', 'kids_amount', 'adults_total', 'kids_total', 'total_amount', 'customer_id', 'trip_id', 'reservation_status', 'status', 'deleted_at', 'created_at', 'updated_at'];
    protected $dates = ['deleted_at'];
}
