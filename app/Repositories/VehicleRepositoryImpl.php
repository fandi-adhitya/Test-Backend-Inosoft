<?php

namespace App\Repositories;

use App\Models\Car;
use App\Models\Motorcycle;
use App\Models\Vehicle;

class VehicleRepositoryImpl implements VehicleRepository {
    /**
     * @var \App\Models\Vehicle $vehicleModel
     */
    protected $vehicleModel;

    /**
     * @var \App\Models\Motorcycle $motorcycleModel
     */
    protected $motorcycleModel;

    /**
     * @var \App\Models\Car $carModel
     */
    protected $carModel;

    /**
     * @param \App\Models\Vehicle     $vehicleModel
     * @param \App\Models\Motorcycle  $motorcycleModel
     * @param \App\Models\Car         $carModel
     * @return void
     */
    public function __construct(
      Vehicle $vehicleModel,
      Motorcycle $motorcycleModel,
      Car $carModel
    )
    {
        $this->vehicleModel     = $vehicleModel;
        $this->motorcycleModel  = $motorcycleModel;
        $this->carModel         = $carModel;
    }

    /** 
     * @param array $data
     * @return \App\Models\Vehicle $vehicle
     */
    public function create(array $data) : \App\Models\Vehicle 
    {
        $vehicle = $this->vehicleModel->create([
            'year'    => $data['release_year'],
            'color'   => $data['color'],
            'price'   => $data['price'],
            'stock'   => $data['stock']
        ]);

        return $vehicle;
    }

    /**
     * @param array $data
     * @param \App\Models\Vehicle $vehicle
     * @return \App\Models\Vehicle
     */
    public function update(array $data, Vehicle $vehicle) : \App\Models\Vehicle
    {
        $vehicle->update([
            'year'    => $data['release_year'] ?? $vehicle->year,
            'color'   => $data['color'] ?? $vehicle->color,
            'price'   => $data['price'] ?? $vehicle->price,
            'stock'   => $data['stock'] ?? $vehicle->stock
        ]);

        return $vehicle;
    }

    /**
     * @param \App\Models\Vehicle $vehicle
     * @return \App\Models\Vehicle
     */
    public function delete(Vehicle $vehicle) : \App\Models\Vehicle
    {
        $vehicle->delete();

        return $vehicle;
    }

    /**
     * @param \App\Models\Vehicle $vehicle
     * @param array $data
     * @return void
     */
    public function syncCarOrMotorcyle(Vehicle $vehicle, array $data): void
    {
        if ($data['type'] === Vehicle::CAR_TYPE)
            $this->carModel->create([
                'vehicle_id'          => $vehicle->id,
                'engine'              => $data['engine'],
                'passenger_capacity'  => $data['passenger_capacity'],
                'type'                => $data['car_type']
            ]);

        if ($data['type'] === Vehicle::MOTORCYCLE_TYPE)
            $this->motorcycleModel->create([
                'vehicle_id'          => $vehicle->id,
                'engine'              => $data['engine'],
                'suspension_type'     => $data['suspension_type'],
                'transmision_type'    => $data['transmision_type']
            ]);
    }
}