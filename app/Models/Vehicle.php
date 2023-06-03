<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vehicles';

    /**
     * possible vehicle types
     */
    public const MOTORCYCLE_TYPE = 'motorcycle';
    public const CAR_TYPE = 'car';

    protected $fillable = [
        'year',
        'color',
        'price',
        'stock'
    ];

    /**
     * Get the car for the vehicle.
     * @return Jenssegers\Mongodb\Eloquent\HybridRelations
     */
    public function car()
    {
        return $this->hasOne(
            \App\Models\Car::class,
            'vehicle_id',
            'id'
        );
    }

    /**
     * Get the motorcycle for the vehicle.
     * @return Jenssegers\Mongodb\Eloquent\HybridRelations
     */
    public function motorcycle()
    {
        return $this->hasOne(
            \App\Models\Motorcycle::class,
            'vehicle_id',
            'id'
        );
    }
}
