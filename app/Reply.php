<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Reply extends Model
{
   protected $fillable  = [
     'content',
      'user_id',
      'discussion_id'
   ];
    
    public function user() {
        
        return $this->belongsTo('App\User');
    }

    public function discussion() {

        return $this->belongsTo('App\Discussion');
    }


    public function likes() {

        return $this->hasMany('App\Like');
    }


public function is_liked_by_auth_user(){

    //prvin go dobivame id-to na logiraniot korisnik
    $id = Auth::id();

    //pravime prazna niza za site id na korisnici koi go like-nale odredeniot reply
    $likers_ids = array();

    //minuvame niz site like-ovi na odreden-iot reply
    foreach($this->likes as $like){

        //ja polnime prazbnata niza so id na site  korisnici koi go like-nale odredeniot reply
        $likers_ids[] =$like->user->id;
    }

    //prasuvame dali vo nizata so korisnici koi go like-nale odredeniot reply go ima id-to na logiraniot korisnik
    if(in_array($id,$likers_ids)){
        return true;
    }else {

        return false;
    }




}
}
