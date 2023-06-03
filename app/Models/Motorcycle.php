<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Motorcycle extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'motorcycles';

    protected $fillable = [
        'vehicle_id',
        'engine',
        'suspension_type',
        'transmision_type'
    ];
}
