<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;

use Midtrans\Snap;
use Midtrans\Config;

use Exception;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // menyimpan data user
        $user = Auth::user();
        $user->update($request->except('total_price'));

        // proses checkout
        $code = 'STORE-' . mt_rand(000000, 999999);
        $carts = Cart::with(['product', 'user'])->where('user_id', Auth::user()->id)->get();

        // menambah transaksi
        $transaction = Transaction::create([
            'user_id' => Auth::user()->id,
            'code' => $code,
            'inscurence_price' => 0,
            'shipping_price' => 0,
            'total_price' => (int) $request->total_price,
            'transaction_status' => 'PENDING',

        ]);

        foreach ($carts as $cart) {
            $trx = 'TRX-' . mt_rand(000000, 999999);

            TransactionDetail::create([
                'code' => $trx,
                'transaction_id' => $transaction->id,
                'product_id' => $cart->product->id,
                'price' =>  $cart->product->price,
                'shipping_status' => 'PENDING',
                'resi' => '',

            ]);
        }

        // delete cart

        Cart::where('user_id', Auth::user()->id)->delete();

        // Konfigurasi midtrans

        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$clientKey = config('services.midtrans.clientKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // buat data yg akan di kirimkan ke midtrans
        $midtrans = [
            'transaction_details' => [
                'order_id' => $code,
                'gross_amount' => (int) $request->total_price
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'enabled_payments' => [
                'gopay', 'permata_va', 'bank_transfer'
            ],
            'vtweb' => [],
        ];

        try {
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            return redirect($paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function callback(Request $request)
    {
    }
}
