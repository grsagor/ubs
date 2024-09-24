<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $table = 'messages';

    /**
     * Get sender.
     */
    public function sender()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
}
