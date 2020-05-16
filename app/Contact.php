<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'team_id', 'unsubscribed_status', 'first_name', 'last_name', 'phone',
        'email', 'sticky_phone_number_id', 'twitter_id', 'fb_messenger_id', 'time_zone'
    ];
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['created_at', 'updated_at'];

    /**
     * Get model columns names
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    /**
     * Get de Custom Attributes of the Contact
     */
    public function customAttributes() {
        return $this->hasMany('App\CustomAttribute');
    }
}
