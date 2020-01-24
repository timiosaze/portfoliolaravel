<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    //
    //
    protected $fillable = [
        'user_id',
        'meeting',
        'meeting_date'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
