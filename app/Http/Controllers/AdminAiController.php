<?php

namespace App\Http\Controllers;

use App\Services\AdminAIAssistantService;
use Illuminate\Http\Request;

class AdminAiController extends Controller
{
    //

    public function AiChatShow(){


    return view('AiChat.AiChatDisplay');
    }


        public function ask(Request $request, AdminAIAssistantService $ai)
        {
            $context = $this->buildContext();

            $reply = $ai->ask($request->message, $context);

            return response()->json(['reply' => $reply]);
        }


        private function buildContext()
        {
            // Example only – replace with real queries
            return "
        SYSTEM TEST DATA:
            Low stock items:
            - Paracetamol: 5 left
            - Vitamin C: 3 left

            Near expiry:
            - Amoxicillin: expires in 12 days

            Sales:
            - Today sales: ₱2,500
            ";
        }


}
