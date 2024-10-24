<?php

namespace Modules\Crm\Entities;

use App\BusinessLocation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'crm_campaigns';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'contact_ids' => 'array',
        'additional_info' => 'array'
    ];

    /**
     * user who created a campaign.
     */
    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public static function getTags()
    {
        return ['{contact_name}', '{campaign_name}', '{business_name}'];
    }

    public function businessLocation()
    {
        return $this->belongsTo(BusinessLocation::class, 'business_location_id')
            ->select('id', 'name', 'slug', 'logo', 'landmark', 'country', 'city', 'state', 'zip_code');
    }

    public function leadCampaignDetails()
    {
        return $this->hasMany(LeadCampaignDetails::class, 'crm_campaign_id');
    }
}
