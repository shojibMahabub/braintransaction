<?php

namespace App\Repository;

use App\Models\Transactions;
use App\Models\User;
class TransactionRepo
{
    public function create($data)
    {
        $user = User::find($data['user_id']);

        if ($user) {
            $transaction = new Transactions();
            $transaction->amount = $data['amount'];
            $transaction->description = 'brain station 23 fund transfer';
            $transaction->user_id = $data['user_id'];
            $transaction->type = 'fund transfer';
            $transaction->status = 'success';
            $transaction->transaction_id = 'TRX'.rand(1000, 9999);
            $transaction->save();

            return response()->json(['message' => 'Transaction created', 'status' => 201], 201);
        }
        else {
           return response()->json(['message' => 'Transaction failed', 'status' => 403], 403);

        }
    }

    public function update($data) {
        $transaction = Transactions::where('transaction_id', $data['transaction_id'])->first();


        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found', 'status' => 403], 403);
        }

        $transaction->status = $data['status'];
        $transaction->update();

        return response()->json(['message' => 'Transaction updated', 'status' => 201], 201);
    }

}

?>