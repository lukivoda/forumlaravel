<?php

namespace App\Http\Controllers;
use App\Discussion;
use App\Notifications\NewReplyAdded;
use App\Reply;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
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


        return view('discussions.show')->with('d',Discussion::where('slug',$slug)->first());
    }



    public function reply($id) {

        $r = request();

        $d = Discussion::find($id);

        $this->validate($r,[

            'reply'  =>'required'

        ]);

       $reply = Reply::create([

            'content' => $r->reply,

            'user_id' => Auth::id(),

            'discussion_id'  => $id

        ]);

        //pravime prazna niza koja treba da gi sodrzi korisnicite koi sledat(watch) odredena diskusija
        $users_watching = [];


        foreach($d->watchers as $watcher){
       //ja polnime nizata so korisnici kako objekti koi gi naodjame kako rezultat na relacija
            //gi barame korisnicite koi imaat ist id  so user_id vo watchers tabelata
            $users_watching[] =User::find($watcher->user_id);
        }

      //na site korisnici ke im ja pracame notifikacijata formatirana vo  NewReplyAdded klasata(kako parametar e diskusijata,koja preku NewReplyAdded klasata vo konstruktor metodot kako link ke ja pratime so mail do korisnikot)
        Notification::send($users_watching,new NewReplyAdded($d));




        Session::flash('success',"You successfully replied to discussion");


        return redirect()->back();

    }










}
