<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'product_id' => 'required | int | exists:products,id',
            'amount' => 'required | int | min:1',
        ]);

        $transaction = Transaction::create($attributes);
        $product_price = Product::find(id());
        return Response::json($transaction->load('product:title,id'))->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction, $id)
    {
        $user = User::fineOrFail($id);
        $price = $user->getPrice();

        $transaction = [
            'product_id' => Transaction::product()->first()->id,
            'user_id' => Transaction::user()->first()->id,
            'amount' => amount,
            'price' => amount * $price
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $attributes = request()->validate([
            'amount' => 'required | int | min:1',
        ]);

        $transaction = Transaction::update($attributes);
        return Response::json($transaction)->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
