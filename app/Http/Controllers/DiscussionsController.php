<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DiscussionsController extends Controller
{
    public function create(){
        
        
        return view('discuss');
    }


    public function store(){

        $r = request();

     $this->validate($r,[

         'title' =>'required',

         'channel_id' => 'required',

         'content'  =>'required'
         
     ]);

       $discussion =Discussion::create([

           'title' => $r->title,

           'channel_id' => $r->channel_id,

           'content'   => $r->content,

           //go dobivame id-to na logiraniot korisnik
           'user_id'  =>Auth::id(),
           //formirame slug od title
           'slug'     => str_slug($r->title)

       ]);

        Session::flash('success',"Discussion created successfully");

         //na krajot se vracame do route-ot discussion so prametarot slug,koj pak ne nosi do show metodata dolu koja go vraca view-to discussion.show zaedno so diskusijata kako objekt koja ima slug ist kako preprateniot od route-ot

        return redirect()->route('discussion',$discussion->slug);

       
    }


    public function show($slug) {


        return view('discussions.show')->with('discussion',Discussion::where('slug',$slug)->first());
    }










}
