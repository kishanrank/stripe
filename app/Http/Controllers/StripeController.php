<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;

class StripeController extends Controller
{

    public function charge(Request $request)
    {
        try {
            Stripe::setApiKey(config('services.stripe.secret'));
            $customer = Customer::create(array(
                'name' => 'test',
                'description' => 'test description',
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken,
                "address" => ["city" => "Rajkot", "country" => "India", "line1" => "Shree", "line2" => "Recidency", "postal_code" => 360003, "state" => "Gujarat"]
            ));

            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => 199900,
                'currency' => 'inr',
                'description' => 'Software development services',
            ));

            return 'Charge successful, you get the course!';
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
