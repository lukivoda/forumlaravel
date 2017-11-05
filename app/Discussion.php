<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    //diskusijata moze da ima povece watchers
    public function watchers(){

        return $this->hasMany('App\Watcher');
    }

    public function is_watched_by_auth_user() {

        //id na logiraniot user
        $id = Auth::id();


        $watcher_user_ids = [];

        foreach($this->watchers as $watcher) {

            //ja polnime nizata so user_id-s od konkretniot watcher
            $watcher_user_ids[] = $watcher->user_id;

        }

       // go sporeduvame sekoj user_id od watchers so id-to na logiraniot user
        if(in_array($id, $watcher_user_ids)){

            return true;
        }else{

            return false;
        }


    }


}
