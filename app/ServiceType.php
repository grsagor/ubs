<?php

namespace App;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceType extends Model
{
    use HasFactory, CreatedUpdatedBy;

    protected $table = 'service_types';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'note',
        'status'
    ];
}
