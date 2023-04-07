<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Lang;

class TransactionsController extends Controller
{
    public function createBankCode()
    {

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'bearer bc59098e15af6818002d3a6365ff8f80a62a195d8410c2ee2885a8339447052e',
        ])
            ->post('https://api.payping.ir/v2/pay', [
                'amount' => '2000',
                'returnUrl' => url('/') . 'company/profile',
                'payerIdentity' => '09331181877',
                'payerName' => 'mahdi',
                'description' => 'power 1 ',
                'clientRefId' => '2',
            ]);

        dd($response);
    }


    public function update(Request $request, Transaction $transaction)
    {
        $status = $request->status;
        $transaction->update(['status' => $status, 'message' => ($status == -1) ? 'عدم واریزی' : $transaction->message]);

        $model = $transaction->transactionable;
        if ($model instanceof Order) {
            if ($status == 2) {
                $model->update(['status' => 3]); // 3 pay successfully
                $orderDetail = $model->orderDetail;
                foreach($orderDetail as $detail){
                    $product = (new Content)->find((int) $detail->attributes['product_id']);
                    if($product instanceof Content){
                        $attr = $product->attr;
                        $attr['in-stock'] = '0';
                        $product->update(['attr'=>$attr]);
                    }
                }
            }
            if ($status == -1) $model->update(['status' => -1]); //  have a problem
        }
        return redirect()->back()->with('success', Lang::get('messages.updated'));
    }
}
