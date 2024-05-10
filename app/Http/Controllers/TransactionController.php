<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Repository\TransactionRepo;

class TransactionController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:sanctum');
    }

    public function store(StoreTransactionRequest $request)
    {
        $transaction = new TransactionRepo();


        $is_mock = $request->header('x-mock-status');

        if ($is_mock != null && $is_mock == 'true') {
            return response()->json(['message' => 'Transaction created', 'status' => 'Accepted'], 201)->header('Cache-Control', 'no-store');
        }

        if ($is_mock != null && $is_mock == 'false') {
            return response()->json(['message' => 'Transaction failed', 'status' => 'Failed'], 403)->header('Cache-Control', 'no-store');
        }


        $data = $transaction->create($request->validated())->getData();
     
        if ($data->status == 201) {
            return response()->json(['message' => 'Transaction created', 'status' => 'Accepted'], 201)->header('Cache-Control', 'no-store');
        }
        
        return response()->json(['message' => 'Transaction failed', 'status' => 'Failed'], 403)->header('Cache-Control', 'no-store');
        
    }

    public function update(UpdateTransactionRequest $request)
    {
        $transaction = new TransactionRepo();

        $is_mock = $request->header('x-mock-status');

        if ($is_mock != null && $is_mock == 'true') {
            return response()->json(['message' => 'Transaction update', 'status' => 'Accepted'], 201)->header('Cache-Control', 'no-store');
        }

        if ($is_mock != null && $is_mock == 'false') {
            return response()->json(['message' => 'Transaction update failed', 'status' => 'Failed'], 403)->header('Cache-Control', 'no-store');
        }

        $data = $transaction->update($request->validated())->getData();

        if ($data->status == 201) {
            return response()->json(['message' => 'Transaction updated', 'status' => 'Accepted'], 201)->header('Cache-Control', 'no-store');
        }
    

        return response()->json(['message' => 'Transaction update failed', 'status' => 'Failed'], 403)->header('Cache-Control', 'no-store');
    }
}
