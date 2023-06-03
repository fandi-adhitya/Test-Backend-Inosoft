<?php

namespace App\Repositories;

use App\Models\Vehicle;

interface VehicleRepository {
    /** 
     * @param array $data
     * @return \App\Models\Vehicle $vehicle
     */
    public function create(array $data) : \App\Models\Vehicle;

    /**
     * @param array $data
     * @param \App\Models\Vehicle $vehicle
     * @return \App\Models\Vehicle
     */
    public function update(array $data, Vehicle $vehicle) : \App\Models\Vehicle;

    /**
     * @param \App\Models\Vehicle $vehicle
     * @return \App\Models\Vehicle
     */
    public function delete(Vehicle $vehicle) : \App\Models\Vehicle;

    /**
     * @param \App\Models\Vehicle $vehicle
     * @param array $data
     * @return void
     */
    public function syncCarOrMotorcyle(Vehicle $vehicle, array $data) : void;
}