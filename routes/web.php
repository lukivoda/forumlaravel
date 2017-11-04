<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/forum', [

    'uses' => 'ForumsController@index',

    'as'   =>'forum'

]);

Route::get('/discuss', function () {
    return view('discuss');
});


Route::get('discussion/{slug}',[

    'uses' => "DiscussionsController@show",

    'as'  => 'discussion'

]);

//route koj ne nosi do provider-ot(primer-github)
Route::get('/{provider}/auth',[

    'uses' => 'SocialsController@auth',

    'as'   => 'social.auth'
]);

//route koj ne nosi nazad 
Route::get('/{provider}/redirect',[

    'uses' => 'SocialsController@authCallback',

    'as'   => 'social.callback'
]);

Auth::routes();




//registrirame routes so resource i gi filtrirame preku auth avtentifikacijata
Route::group(['middleware' =>'auth'],function(){

    Route::resource('channels','ChannelsController');

    Route::get('discussion/create',[

        'uses' => "DiscussionsController@create",

        'as'  => 'discussion.create'

    ]);

    Route::post('discussion/store',[

        'uses' => "DiscussionsController@store",

        'as'  => 'discussion.store'

    ]);


    Route::post('discussion/reply/{id}',[

        'uses' => "DiscussionsController@reply",

        'as'  => 'reply.store'

    ]);
    
    
    Route::get('reply/like/{id}',[
      
        "uses" => "RepliesController@like",
        
        "as"   =>  "reply.like"
        
        
]);

    Route::get('reply/unlike/{id}',[

        "uses" => "RepliesController@unlike",

        "as"   =>  "reply.unlike"


    ]);

});