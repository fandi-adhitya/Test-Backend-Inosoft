<?php

namespace App\Http\Controllers\Api\Vehicle;

use App\Contracts\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleCreateRequest;
use App\Http\Requests\VehicleUpdateRequest;
use App\Http\Resources\VehicleCollection;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use App\Services\VehicleService;
use Illuminate\Http\Request;

class VehicleController extends Controller
{ 
    /**
     * @var \App\Services\VehicleService $vehicleService
     */
    protected $vehicleService;

    /**
     * @var \App\Models\Vehicle $vehicleModel
     */
    protected $vehicleModel;

    /**
     * @param \App\Services\VehicleService $vehicleService
     * @param \App\Models\Vehicle          $vehicleModel
     * @return void
     */
    public function __construct(
      VehicleService $vehicleService,
      Vehicle $vehicleModel
    )
    {
        $this->vehicleService = $vehicleService;
        $this->vehicleModel   = $vehicleModel;
    }
    /**
     * Display a listing of the resource.
     * @param Illuminate\Http\Request $request;
     * @return \App\Contracts\Response;
     */
    public function index(Request $request)
    {
        $vehicles = $this->vehicleModel
            ->query()
            ->with(['car', 'motorcycle'])
            ->paginate($request->query('limit'));
        
        return Response::json(
            new VehicleCollection($vehicles)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\VehicleCreateRequest  $request
     * @return \App\Contracts\Response
     */
    public function store(VehicleCreateRequest $request)
    {
        $newVehicle = $this->vehicleService
            ->create($request);
        $newVehicle->load(['car', 'motorcycle']);

        return Response::json(
            new VehicleResource($newVehicle),
            Response::MESSAGE_CREATED,
            Response::STATUS_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle $vehicle
     * @return \App\Contracts\Response
     */
    public function show(Vehicle $vehicle)
    {
        $vehicle->load(['car', 'motorcycle']);

        return Response::json(
            new VehicleResource($vehicle)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\VehicleUpdateRequest $request
     * @param  \App\Models\Vehicle                    $vehicle
     * @return \App\Contracts\Response 
     */
    public function update(VehicleUpdateRequest $request, Vehicle $vehicle)
    {
        $updateVehicle = $this->vehicleService
            ->update($request, $vehicle);
        $updateVehicle->load(['car', 'motorcycle']);

        return Response::json(
            new VehicleResource($updateVehicle)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle $vehicle
     * @return \App\Contracts\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $this->vehicleService
            ->delete($vehicle);

        return Response::noContent();
    }
}
