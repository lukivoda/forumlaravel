<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class ForumsController extends Controller
{

    public function index() {





        switch(request('filter')) {

            case 'me':
            $results = Discussion::where('user_id',Auth::id())->paginate(3)->appends('filter',request('filter')) ;
              break;

            case 'answered':
                $answered = [];
;
                foreach(Discussion::all()  as $d){
                    if($d->hasBestAnswer()){

                        $answered[] = $d;

                    }

                }

                // Get current page form url e.x. &page=1
                $currentPage = LengthAwarePaginator::resolveCurrentPage();

                // Create a new Laravel collection from the array data
                $itemCollection = collect($answered);

                // Define how many items we want to be visible in each page
                $perPage = 3;

                // Slice the collection to get the items to display in current page
                $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

                // Create our paginator and pass it to the view
                $results= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);

                // set url path for generted links
                $results->setPath(request()->url());


                break;


            case 'unanswered':

                $unanswered = [];



                foreach(Discussion::all() as $d) {

                    if(!$d->hasBestAnswer()){

                        $unanswered[] = $d;
                    }
                }

                // Get current page form url e.x. &page=1
                $currentPage = LengthAwarePaginator::resolveCurrentPage();

                // Create a new Laravel collection from the array data
                $itemCollection = collect($unanswered);

                // Define how many items we want to be visible in each page
                $perPage = 3;

                // Slice the collection to get the items to display in current page
                $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

                // Create our paginator and pass it to the view
                $results= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);

                // set url path for generted links
                $results->setPath(request()->url());


                break;


            default:
                $results = Discussion::orderBy('created_at','desc')->paginate(3) ;
            break;


        }

        return view('forum',['discussions' => $results]);
        
    }
}
