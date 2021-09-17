<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\TransactionDetail;

class DashboardTransactionController extends Controller
{
    public function index()
    {
        $sellTransactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->whereHas('product', function ($product) {
                $product->where('user_id', auth()->user()->id);
            })->get();

        $buyTransactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->whereHas('transaction', function ($transaction) {
                $transaction->where('user_id', auth()->user()->id);
            })->get();

        return view('pages.dashboard-transactions', [
            'sellTransactions' => $sellTransactions,
            'buyTransactions' => $buyTransactions,
        ]);
    }

    public function details(Request $request, $id)
    {
        $transaction = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->findOrFail($id);
        return view('pages.dashboard-transactions-details', [
            'transaction' => $transaction,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = TransactionDetail::findOrFail($id);

        $item->update($data);

        return redirect()->route('dashboard-transaction-detail', $id);
    }
}
