<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Mime\Message;

class CustomerRegisteredController extends Controller
{
    //


        /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function create(): View
    {
        return view('Ecommerce.auth.CustomerRegister');
    }
                


        public function customerRegister(Request $request): RedirectResponse
        {
            try {

                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:customers,email'],
                    'tel' => ['required', 'regex:/^\+639\d{9}$/'],
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ], [
                    'password.confirmed' => 'The password confirmation does not match.',
                    'tel.regex' => 'Phone number must be valid (ex: +639123456789).',
                ]);



                DB::beginTransaction();

                $customer = Customer::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->tel,
                    'password' => Hash::make($request->password),
                    'added_by_staff' => 0,
                ]);

                event(new Registered($customer));

                Auth::guard('customer')->login($customer);

                DB::commit();

                return redirect(RouteServiceProvider::CUSTOMER_HOME)
                    ->with('toast_success', 'Registration successful! Welcome 🎉');

            } catch (\Exception $e) {

                DB::rollBack();

                dd($e);

                Log::error('Customer Registration Error: ' . $e->getMessage());

                return back()
                    ->withInput()
                    ->with('toast_error', 'Something went wrong. Please try again.');
            }
        }

    
















}


