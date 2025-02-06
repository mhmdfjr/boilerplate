<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class MailtrapController extends Controller
{
    public function fetchEmails()
    {
        $host = env('MAILTRAP_HOST');
        $apiKey = env('MAILTRAP_API_KEY');
        $inboxId = env('MAILTRAP_INBOX_ID');

        $url = "$host/api/inboxes/$inboxId/messages";

        $response = Http::withHeaders([
            'Authorization' => "Bearer $apiKey",
            'Accept' => 'application/json',
        ])->get($url);

        if ($response->successful()) {
            return response()->json($response->json()); 
        } else {
            return response()->json(['error' => 'Failed to fetch emails'], $response->status());
        }
    }
}
