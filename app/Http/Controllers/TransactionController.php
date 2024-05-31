<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::now();

        $transactions = Transaction::where('created_at', '<=', $today)
            ->orderBy('created_at', 'desc')
            ->with('product')
            ->get();

        return Response::json($transactions)->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required | int | exists:products,id',
            'user_id' => 'required | int | exists:users,id',
            'amount' => 'required | int | min:1',
        ]);
        $product = Product::findOrFail($request->product_id);
        $amount = $request->amount;
        $price = $product->price * $amount;

        $transaction = Transaction::create([
            'user_id' => $request->user_id,
            'product_id' => $product->id,
            'amount' => $amount,
            'price' => $price,
        ]);

        return Response::json($transaction->load('product'))->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return Response::json($transaction->load('product'))->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required | int | min:1',
        ]);

        $transaction = Transaction::findOrFail($id);
        $product = $transaction->product;
        $amount = $request->amount;
        $price = $product->price * $amount;


        $transaction->update([
            'amount' => $amount,
            'price' => $price,
        ]);


        return Response::json($transaction)->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return Response::json($transaction)->setStatusCode(204);
    }
}
