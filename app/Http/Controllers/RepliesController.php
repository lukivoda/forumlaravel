<?php

namespace App\Http\Controllers;

use App\Like;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RepliesController extends Controller
{
    //id-to e id na reply
    public function like($id) {
        

        
        Like::create([
           'user_id' =>Auth::id(),
           'reply_id' => $id

        ]);

        Session::flash('success',"Yo've liked this reply");

        return redirect()->back();
        
    }


    public function unlike($id) {

        //prasuvame dali like-ot ima user_id kako logiraniot korisnik i reply_id kako reply-ot
        // i ako se poklopuva ja briseme taa kolona od likes tabelata
      $like = Like::where('user_id',Auth::id())->where('reply_id',$id)->first();


      $like->delete();

       Session::flash('success',"Yo've unliked this reply");

      return redirect()->back();

    }


    public function best_answer($id) {

       $reply = Reply::find($id);

        $reply->best_answer = 1;
        
        $reply->save();
        
        $reply->user->points += 100;
        
        $reply->user->save();
        
        
        Session::flash('success','You marked this reply as best');
        
        return redirect()->back();

    }

}
