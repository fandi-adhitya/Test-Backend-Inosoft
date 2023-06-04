<?php

namespace App\Http\Controllers\Api\Transactions;

use App\Contracts\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;

class TransactionReportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \App\Models\Vehicle $vehicle
     * @return \App\Contracts\Response
     */
    public function __invoke(Vehicle $vehicle)
    {
        $vehicle->load(['transactions', 'car', 'motorcycle']);
        return Response::json(
            new VehicleResource($vehicle),
        );
    }
}
