<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transactions';
    
    protected $fillable = [
        'vehicle_id',
        'customer',
        'quantity',
        'price_per_unit',
        'price_total'
    ];

    /**
     * Get the car for the vehicle.
     * @return Jenssegers\Mongodb\Eloquent\HybridRelations
     */
    public function vehicle()
    {
        return $this->hasOne(
            \App\Models\Vehicle::class,
            '_id',
            'vehicle_id'
        );
    }
}
