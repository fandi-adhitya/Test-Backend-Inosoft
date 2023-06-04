<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Models\Vehicle;

class TransactionRepositoryImpl implements TransactionRepository
{
    /**
     * @var \App\Models\Transaction $transactionModel
     */
    protected $transactionModel;

    /**
     * @var \App\Models\Vehicle $vehicleModel
     */
    protected $vehicleModel;

    /**
     * @param \App\Models\Transaction $transactionModel
     * @param \App\Models\Vehicle     $vehicleModel
     * @return void
     */
    public function __construct(Transaction $transactionModel, Vehicle $vehicleModel)
    {
        $this->transactionModel = $transactionModel;
        $this->vehicleModel     = $vehicleModel;
    }

    /**
     * @param array $data
     * @return \App\Models\Transaction $transaction
     */
    public function createTransaction(array $data): \App\Models\Transaction
    { 
        $vehicle = $this->getVehicle($data);
        $transaction = $this->transactionModel
            ->create([
                'vehicle_id'      => $data['vehicle_id'],
                'quantity'        => $data['quantity'],
                'customer'        => $data['customer'],
                'price_per_unit'  => $vehicle->price,
                'price_total'     => $data['quantity'] * $vehicle->price
            ]);
        $this->reduceStock($data, $vehicle);

        return $transaction;
    }

    /**
     * @param array $data
     * @return \App\Models\Vehicle
     */
    public function getVehicle(array $data): \App\Models\Vehicle
    {
        $vehicle = $this->vehicleModel
            ->where('_id', '=', $data['vehicle_id'])
            ->first();
        
        return $vehicle;
    }

    /**
     *  @param array $data 
     *  @param \App\Models\Vehicle $vehicle
     *  @return \App\Models\Vehicle $vehicle
    */
    public function reduceStock(array $data, Vehicle $vehicle): \App\Models\Vehicle
    {
        $vehicle->update([
            'stock' => $vehicle->stock - $data['quantity']
        ]);

        return $vehicle;
    }


}