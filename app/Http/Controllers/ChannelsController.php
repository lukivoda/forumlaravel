<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChannelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('channels.index')->with('channels',Channel::all());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('channels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required'

        ]);

        Channel::create([
           'title' => $request->title,

            'slug' => str_slug($request->title)

        ]);


        Session::flash('success',"Channel added");

        return redirect()->route('channels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        
        return view('channels.edit')->with('channel',Channel::find($id));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required'

        ]);

        $channel = Channel::find($id);

        $channel->title =$request->title;

        $channel->slug = str_slug($request->slug);


        $channel->save();


        Session::flash('success',"Channel is updated");

        return redirect()->route('channels.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Channel::destroy($id);

       

        Session::flash('success',"Channel is deleted");

        return redirect()->route('channels.index');
    }
    
    
    public function channel($slug) {
        
        $channel =  Channel::where('slug',$slug)->first();
        
        $discussions = $channel->discussions()->paginate(3);
        
        return view('channel')->with('discussions',$discussions);
        
        
    }
}
