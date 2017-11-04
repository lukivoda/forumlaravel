<?php

namespace App\Http\Controllers;
use SocialAuth;
use Illuminate\Http\Request;

class SocialsController extends Controller
{


    public function auth($provider) {
        //koga ke dtigneme do provider-ot(github) barame avtentifikacija
        return SocialAuth::authorize($provider);

    }


    //koga ke se vratime nasad sobirame informacii za user-ot od github pri sto korisnikot avtomatski go logirame
    public function authCallback($provider) {


        SocialAuth::login($provider,function($user,$details){

            //vo details se site informacii od korisnikot
            //dd($details);

           // User {#310 ▼
                #access_token: "8a1a95f6112c3b70547abf660c12872e8e91725c"
                #id: 16989106
                #nickname: "lukivoda"
                #full_name: "Stevan Ristov"
                #avatar: "https://avatars1.githubusercontent.com/u/16989106?v=4"
                #email: "stevanris@gmail.com"
                #raw: array:30 [▶]
            //}

            //inforaciite koi ni trbaat za korisnikot gi zacuvuvame vo users tabelata
            $user->avatar = $details->avatar;
            $user->name  = $details->full_name;
            $user->email = $details->email;

            $user->save();


        });
      
        return redirect('/forum');

    }
}
