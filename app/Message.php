<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

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
        return $this->belongsTo(\App\User::class, 'user_id')
            ->select('id', 'user_type', 'surname', 'first_name', 'last_name', 'username', 'email', 'contact_no');
    }
}
