<?php

namespace Modules\Crm\Entities;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePropertyWanted extends Model
{
    use HasFactory;
    protected $table = 'service_property_wanted';

    public function user(){
        return $this->belongsTo(User::class);
    }
}
