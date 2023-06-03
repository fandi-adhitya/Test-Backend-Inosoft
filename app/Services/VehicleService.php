<?php

namespace App\Services;

use App\Http\Requests\VehicleCreateRequest;
use App\Http\Requests\VehicleUpdateRequest;
use App\Models\Vehicle;

interface VehicleService {
    /**
     * @param \App\Http\Requests\VehicleCreateRequest $request
     * @return \App\Models\Vehicle $vehicle
     */
    public function create(VehicleCreateRequest $request) : \App\Models\Vehicle;

    /**
     * @param \App\Http\Requests\VehicleUpdateRequest $request
     * @param \App\Models\Vehicle $vehicle
     * @return \App\Models\Vehicle $vehicle
     */
    public function update(VehicleUpdateRequest $request, Vehicle $vehicle) : \App\Models\Vehicle;

    /**
     * @param \App\Models\Vehicle $vehicle
     * @return \App\Models\Vehicle $vehicle
     */
    public function delete(Vehicle $vehicle) : \App\Models\Vehicle;
}