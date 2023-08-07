<?php

namespace App\Traits;

use App\User;
use Illuminate\Database\Eloquent\Model;

trait CreatedUpdatedBy
{
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'id', 'created_by');
    }

    public function createdUser()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function updatedUser()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::creating(function (Model $model) {
            $model->setAttribute('created_by', auth()->id());
        });
        static::updating(function (Model $model) {
            $model->setAttribute('updated_by', auth()->id());
        });
    }
}
