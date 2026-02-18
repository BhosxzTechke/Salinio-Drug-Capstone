<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{





        /// customer admin
    //
            public function sendAdmin(Request $request)
            {
                $senderId = Auth::guard('web')->user()->id; // admin ID

                Chat::create([
                    'sender_id' => $senderId,
                    'receiver_id' => $request->receiver_id, // selected customer
                    'message' => $request->message
                ]);

                return response()->json(['success' => true]);
            }




                        

        /// customer chat
            
                public function sendCustomer(Request $request)
                {
                    $senderId = Auth::guard('customer')->user()->id; // customer ID

                    Chat::create([
                        'sender_id' => $senderId,
                        'receiver_id' => 5,
                        'message' => $request->message
                    ]);

                    return response()->json(['success' => true]);
                }

                        




                //// Getting Admin Messages Automatically without Reloading the page
            public function fetchAdmin($customerId)
            {
                $adminId = Auth::guard('web')->id(); // admin

                $messages = Chat::where(function($q) use ($adminId, $customerId) {
                    $q->where('sender_id', $adminId)
                    ->where('receiver_id', $customerId);
                })->orWhere(function($q) use ($adminId, $customerId) {
                    $q->where('sender_id', $customerId)
                    ->where('receiver_id', $adminId);
                })->orderBy('created_at')->get();

                return response()->json($messages);
            }


                //// Getting Customer Messages Automatically without Reloading the page
                    public function fetchCustomer()
            {
                $customerId = Auth::guard('customer')->id(); // logged-in customer
                $adminId = User::value('id'); // first user in users table (admin)
    
                $messages = Chat::where(function($q) use ($customerId, $adminId) {
                    $q->where('sender_id', $customerId)
                    ->where('receiver_id', $adminId);
                })->orWhere(function($q) use ($customerId, $adminId) {
                    $q->where('sender_id', $adminId)
                    ->where('receiver_id', $customerId);
                })->orderBy('created_at')->get();

                return response()->json($messages);
            }









                                    
                public function adminChats()
                {
                    $adminId = Auth::guard('web')->user()->id; // admin guard

                    // Get all unique customers that admin has chatted with
                    $customerIds = Chat::where('sender_id', $adminId)
                        ->pluck('receiver_id')
                        ->merge(
                            Chat::where('receiver_id', $adminId)->pluck('sender_id')
                        )
                        ->unique();

                    $customers = Customer::whereIn('id', $customerIds)->get();

                    return view('admin.ChatSystem', compact('customers'));
                }

}