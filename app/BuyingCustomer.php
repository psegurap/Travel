<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuyingCustomer extends Model
{
    use SoftDeletes;

    protected $table = 'buyingCustomer_details';
    protected $fillable = ['customer_name', 'customer_email', 'customer_adddress', 'customer_city', 'customer_zipCode', 'customer_country', 'customer_cellphone', 'customer_homephone', 'customer_notes', 'language', 'status', 'deleted_at', 'created_at', 'updated_at'];
    protected $dates = ['deleted_at'];
}
