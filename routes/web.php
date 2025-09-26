<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::view('/payment', 'send_to_bank');

Route::post('/before-send-bank', function (Request $request) {
    $amount = str_replace(',', '', $request->input('amount'));
    $response = Http::withoutVerifying()->post('http://localhost:7000/request.php', [
        'payer_id' => rand(100, 999),
        'callback_url' => route('payment.confirm'),
        'amount' => (int) $amount
    ]);

    $data = $response->json();
    if (isset($data['success']) && $data['success']) {
        return redirect()->away('http://localhost:7000/index.php?reference_id=' . $data['reference_id']);
    }

    dd('Failed to connect bank');
})->name('send.bank');

Route::get('/payment/confirm', function (Request $request) {

    $status = $request->input('status');
    $reference_id = $request->input('reference_id');
    if ($status) {
        $response = Http::withoutVerifying()->post('http://localhost:7000/verify.php', [
            'reference_id' => $reference_id
        ]);

        if ($response->ok()) {
            return view('welcome');
        }
        dd($response->body() , $response->getStatusCode());
    }

})->name('payment.confirm');
