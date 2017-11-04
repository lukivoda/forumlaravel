<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = [

        'title',
        'content',
        'user_id',
        'channel_id',
        'slug'
    ];


    //diskusijata pripadja na samo eden kanal
    public function channel(){

        return $this->belongsTo('App\Channel');
    }

    //diskusijata pripadja na samo eden korisnik
    public function user(){

        return $this->belongsTo('App\User');
    }

    //diskusijata moze da ima povece replies
    public function replies(){

        return $this->hasMany('App\Reply');
    }
}
