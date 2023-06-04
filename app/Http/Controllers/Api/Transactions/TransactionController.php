<?php

namespace App\Http\Controllers\Api\Transactions;

use App\Contracts\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionCreateRequest;
use App\Http\Resources\TransactionResource;
use App\Services\TransactionService;

class TransactionController extends Controller
{
    /**
     * @var \App\Services\TransactionService $transactionService;
     */
    protected $transactionService;
    
    /**
     * @param \App\Services\TransactionService $transactionService;
     * @return void 
     */
    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

     /** Handle the incoming request.
     *
     * @param  \App\Http\Requests\TransactionCreateRequest  $request
     * @return \App\Contracts\Response
     */
    public function __invoke(TransactionCreateRequest $request)
    {
        $newTransaction = $this->transactionService
            ->create($request);
        $newTransaction->load(['vehicle']);
        
        return Response::json(
            new TransactionResource($newTransaction),
            Response::MESSAGE_CREATED,
            Response::STATUS_CREATED
        );
    }
}
