<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReservationDetail;
class ReservationController extends Controller
{

    public function __construct(){
        return $this->middleware('auth');
    }

    public function all_reservations(){
        $reservations = ReservationDetail::with('customer', 'customer.country', 'trip')->get();
        return view('admin.reservations.all_reservations', compact('reservations'));
    }
}
