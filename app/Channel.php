<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{

    //za da mozeme da pravime mass assignment
    protected $fillable = ['title'];

    //eden kanal moze da ima povece diskusii
    public function discussions() {

        return $this->hasMany('App\Discussion');
    }

}
