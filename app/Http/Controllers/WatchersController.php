<?php

namespace App\Http\Controllers;

use App\Watcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WatchersController extends Controller
{
   
    
    public function watch($id) {
        
        Watcher::create([
            
            'user_id' => Auth::id(),
            
            'discussion_id' => $id
            
        ]);
        
        
        Session::flash('success','You are watching this discussion');
        
        return redirect()->back();
        
    }
    
    
    public function unwatch($id) {
       
        $auth_id = Auth::id();
        
        $watcher = Watcher::where('user_id',$auth_id)->where('discussion_id',$id)->first();

        $watcher->delete();

        Session::flash('success','You are no longer watching this discussion');

        return redirect()->back();
        
        
        
        
    }
    
    
}
