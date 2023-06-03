<?php

namespace App\Services;

use App\Repositories\VehicleRepository;
use App\Http\Requests\VehicleCreateRequest;
use App\Http\Requests\VehicleUpdateRequest;
use App\Models\Vehicle;

class VehicleServiceImpl implements VehicleService
{
    /**
     * @var \App\Repositories\VehicleRepository
     */
    protected $vehicleRepository;

    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }
    /**
     * @param \App\Http\Requests\VehicleCreateRequest $request
     * @return \App\Models\Vehicle $vehicle
     */
    public function create(VehicleCreateRequest $request) : \App\Models\Vehicle
    {
        $input = $request->safe([
            'release_year',
            'color',
            'price',
            'stock',
            'type',
            'engine',
            'suspension_type',
            'transmision_type',
            'passenger_capacity',
            'car_type'
        ]);

        $vehicle = $this->vehicleRepository
            ->create($input);

        $this->vehicleRepository
            ->syncCarOrMotorcyle($vehicle, $input);
        
        return $vehicle;
    }

    /**
     * @param \App\Http\Requests\VehicleUpdateRequest $request
     * @param \App\Models\Vehicle $vehicle
     * @return \App\Models\Vehicle $vehicle
     */
    public function update(VehicleUpdateRequest $request, Vehicle $vehicle) : \App\Models\Vehicle
    {
        $input = $request->safe([
            'release_year',
            'color',
            'price',
            'stock',
            'type',
            'engine',
            'suspension_type',
            'transmision_type',
            'passenger_capacity',
            'car_type'
        ]);
        
        $vehicle = $this->vehicleRepository
            ->update($input, $vehicle);

        return $vehicle;
    }

    /**
     * @param \App\Models\Vehicle $vehicle
     * @return \App\Models\Vehicle $vehicle
     */
    public function delete(Vehicle $vehicle) : \App\Models\Vehicle
    {
        $vehicle = $this->vehicleRepository
            ->delete($vehicle);

        return $vehicle;
    }
}