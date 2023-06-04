<?php

namespace App\Services;

use App\Repositories\TransactionRepository;
use App\Http\Requests\TransactionCreateRequest;
use Illuminate\Validation\ValidationException;

class TransactionServiceImpl implements TransactionService 
{
    /**
     * @var \App\Repositories\TransactionRepository $transactionRepository
     */
    protected $transactionRepository;

    /**
     * @param \App\Repositories\TransactionRepository $transactionRepostitory
     */
    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * @param \App\Http\Requests\TransactionCreateRequest $request
     * @return \App\Models\Transaction $transaction
     */
    public function create(TransactionCreateRequest $request) : \App\Models\Transaction
    {
        $input = $request->safe([
            'vehicle_id',
            'customer',
            'quantity'
        ]);

        $vehicle = $this->transactionRepository
            ->getVehicle($input);
        
        if ( $input['quantity'] > $vehicle->stock) 
            throw ValidationException::withMessages(['out of stock']);

        $transaction = $this->transactionRepository
            ->createTransaction($input);

        return $transaction;
    }
}