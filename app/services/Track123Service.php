<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Track123Service
{
    protected $apiToken;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiToken = config('services.track123.api_token');
        $this->baseUrl = config('services.track123.base_url');
    }

    public function getTrackingStatus($courierCode, $trackingNumber)
    {

        // For testing without real API call:
    return [
        'data' => [
            'tracking' => [
                'tag' => 'in_transit',
                'last_update' => '2026-01-21T10:00:00+08:00',
                'checkpoints' => [
                    [
                        'location' => 'Warehouse',
                        'message' => 'Package received',
                        'time' => '2026-01-20T09:00:00+08:00',
                    ],
                    [
                        'location' => 'City Hub',
                        'message' => 'Out for delivery',
                        'time' => '2026-01-21T08:00:00+08:00',
                    ],
                ],
            ],
        ],
    ];


        // $url = $this->baseUrl . '/trackings/get'; // Confirm endpoint from Track123 docs

        // $response = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . $this->apiToken,
        //     'Content-Type' => 'application/json',
        // ])->post($url, [
        //     'tracking_number' => $trackingNumber,
        //     'courier_code' => $courierCode,
        // ]);

        // if ($response->successful()) {
        //     return $response->json();
        // }

        // return null;
    }
}
