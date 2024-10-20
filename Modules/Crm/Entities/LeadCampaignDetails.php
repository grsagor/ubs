<?php

namespace Modules\Crm\Entities;

use App\User;
use App\Contact;
use App\Business;
use Illuminate\Database\Eloquent\Model;

class LeadCampaignDetails extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lead_campaign_details';

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function crmCampaign()
    {
        return $this->belongsTo(Campaign::class, 'crm_campaign_id');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contacts_id');
    }

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }
}
