<?php

namespace App\Repositories;

use App\Models\Vehicle;

interface TransactionRepository {
    /**
     * @param array $data
     * @return \App\Models\Transaction
     */
    public function createTransaction(array $data) : \App\Models\Transaction;

    /**
     * @param array $data
     * @return \App\Models\Vehicle
     */
    public function getVehicle(array $data): \App\Models\Vehicle;

    /**
     *  @param array $data 
     *  @param \App\Models\Vehicle $vehicle
     *  @return \App\Models\Vehicle
    */
    public function reduceStock(array $data, Vehicle $vehicle): \App\Models\Vehicle;
}