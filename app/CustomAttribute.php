<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomAttribute extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key', 'value'
    ];

    /**
     * Get Contact that belongs to the Custom Attribute
     */
    public function contact() {
        return $this->belongsTo('App\Contact');
    }
}
