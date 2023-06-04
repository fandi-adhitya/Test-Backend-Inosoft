<?php

namespace App\Services;

use App\Http\Requests\TransactionCreateRequest;
use App\Models\Vehicle;
use Exception;
use Illuminate\Validation\ValidationException;

interface TransactionService {
    /**
     * @param \App\Http\Requests\TransactionCreateRequest $request
     * @return \App\Models\Transaction $transaction
     */
    public function create(TransactionCreateRequest $request) : \App\Models\Transaction;
}