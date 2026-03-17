<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Laravel\Socialite\Socialite;
use Laravel\Socialite\Facades\Socialite;

class CustomersGoogleController extends Controller
{
    public function redirect()
        {
            // return Socialite::driver('google')->redirect();

            // Etong code na to is ifoforce niya na mag seselect ka ng email instead automatic
                $url = Socialite::driver('google')->redirect()->getTargetUrl();
                $url .= '&prompt=select_account';

                return redirect($url);
        }

        public function callback()
        {
            $googleUser = Socialite::driver('google')->user();

            $customer = Customer::updateOrCreate(
                ['email' => $googleUser->email],
                [
                    'name' => $googleUser->name,
                    'google_id' => $googleUser->id,
                    'phone' => '+639',
                    'password' => bcrypt(str()->random(16)),
                    'email_verified_at' => now(),
                ]
            );

            Auth::guard('customer')->login($customer);

            return redirect()->route('customer.dashboard');


            
            
        }
}
