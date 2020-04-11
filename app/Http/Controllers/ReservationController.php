<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReservationDetail;
use App\WorldCountries;
class ReservationController extends Controller
{

    public function __construct(){
        return $this->middleware('auth');
    }

    public function all_reservations(){
        $reservations = ReservationDetail::with('customer', 'customer.country', 'trip')->get();
        return view('admin.reservations.all_reservations', compact('reservations'));
    }

    public function update_reservations($id, $status){
        ReservationDetail::find($id)->update(['reservation_status' => $status]);

        $reservation_details = ReservationDetail::with('customer', 'trip')->find($id);
        $trip = $reservation_details['trip'];
        $customer = $reservation_details['customer'];
        $country = WorldCountries::find($customer['customer_country']);

        if($status == 2){
            MailController::PaymentMade($reservation_details, $trip, $customer, $country);
        }

        $reservations = ReservationDetail::with('customer', 'customer.country', 'trip')->get();
        return response()->json($reservations, 200);
    }
    
}
