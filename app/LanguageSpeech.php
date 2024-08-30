<?php

namespace App;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LanguageSpeech extends Model
{
    use HasFactory, CreatedUpdatedBy;

    protected $table = 'languageSpeech';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'slug',
        'business_id',
        'code',
        'description',
        'status',
    ];

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }
}
