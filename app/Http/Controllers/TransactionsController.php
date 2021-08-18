<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class TransactionsController extends Controller
{
    public function createBankCode(){

        $response = Http::withHeaders([
            'Content-Type'=>'application/json',
            'Accept'=>'application/json',
            'Authorization'=>'bearer bc59098e15af6818002d3a6365ff8f80a62a195d8410c2ee2885a8339447052e',
        ])
        ->post('https://api.payping.ir/v2/pay', [
            'amount' => '2000',
            'returnUrl' => url('/').'company/profile',
            'payerIdentity'=>'09331181877',
            'payerName'=>'mahdi',
            'description'=>'power 1 ',
            'clientRefId'=>'2',
        ]);

        dd($response);

    }
}
