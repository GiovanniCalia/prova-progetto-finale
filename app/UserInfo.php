<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'phone_number', 'date_of_birth', 'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
