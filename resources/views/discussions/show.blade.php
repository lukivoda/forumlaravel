@extends('layouts.app')

@section('content')

        <div class="panel panel-default">
            <div class="panel-heading">
                <img width="40" height="40" src="{{$d->user->avatar}}" alt="{{$d->user->name}}">&nbsp;&nbsp;&nbsp;
                <span>{{$d->user->name}},</span><span>(<b>{{$d->user->points}}</b>) </span>

                {{--prasuvame dali diskusijata ima reply koj ima best_answer=1(logikata e vo modelot)--}}
                @if($d->hasBestAnswer())
                    {{--ako ima reply so best answer diskusijata e zatvorena--}}
                    <span style="margin-left: 10px" class="btn btn-success btn-xs pull-right">closed</span>
                @else
                    {{--ako ima reply so best answer diskusijata e otvorena--}}
                    <span  style="margin-left: 10px" class="btn btn-danger btn-xs pull-right"> open</span>
                @endif


                @if($d->is_watched_by_auth_user())
                    <a href='{{route('discussion.unwatch',$d->id)}}' class="btn btn-default btn-xs pull-right">Unwatch</a>
              @else
                    <a href='{{route('discussion.watch',$d->id)}}' class="btn btn-default btn-xs pull-right">Watch</a>
               @endif


                {{--proveruvame dali id-to na logiraniot korisnik e isto so user_id na discussion--}}
                @if(Auth::id() == $d->user->id)

                    {{--proveruvame i dali imame object reply kako best answer($best_answer)--}}
                    @if(!$best_answer)

                        {{--ako se ispolneti i dvata uslova samo togas linkot za updatiranje na diskusijata se pojavuva--}}
                <a class="btn btn-info btn-xs pull-right" style="margin-right: 10px;" href="{{route('discussion.edit',$d->slug)}}">Update the discussion</a>

                     @endif
                @endif

            </div>

            <div class="panel-body">
                <h3 class="text-center">
                    <b>{{ $d->title}}</b>
                </h3>
                <hr>
                <p class="text-center">{!! Markdown::convertToHtml($d->content) !!}</p>
                <hr>
                <span class="pull-right"><b>{{$d->created_at->diffForHumans()}}</b></span>
            </div>





            @if($best_answer)

                <div class="panel panel-success" style="padding:50px;">
                    <h2 class="text-center">Best Answer</h2>
                    <div class="panel-heading text-center">
                        <img width="40" height="40" src="{{$best_answer->user->avatar}}" alt="{{$best_answer->user->name}}">&nbsp;&nbsp;&nbsp;
                        <span >{{$best_answer->user->name}}</span>(<b>{{$best_answer->user->points}}</b>)

                    </div>
                    {{--<span class="pull-right">{{'Marked as best answer'}}</span>--}}
                    <div class="panel-body">
                        <p>
                            <b>{{ $best_answer->content}}</b>
                        </p>

                    </div>
                    <div class="panel-footer "  style="margin-top: 20px;">replied: <b>{{$best_answer->created_at->diffForHumans()}}</b></div>
                </div>
            @endif



            <div class="panel-footer">
                <a href="#" style="text-decoration: none">{{$d->replies->count()}} replies</a>
                <a href="{{route('channel',$d->channel->slug)}}" style="text-decoration: none" class="pull-right"><b>{{$d->channel->title}}</b></a>
            </div>
            <hr>

        </div>




    @foreach($d->replies as $r)

        <div class="panel panel-default">
            <div class="panel-heading">

                <img width="40" height="40" src="{{$r->user->avatar}}" alt="{{$r->user->name}}">&nbsp;&nbsp;&nbsp;
                <span>{{$r->user->name}},</span>(<b>{{$r->user->points}}</b>)

               {{--prasuvame dali siskusijata ima najdobar odogovor(logikata e vo DiscussionsController-ot)--}}
              @if(!$best_answer)

               {{--prasuvame dali id-to na logiraniot korisnik e isto so user_id na korisnikot koj ja zapocnal(ja kreiral diskusijata)   --}}
                 {{--i samo vo toj slucaj go pokazuvame button-ot--}}
               @if(Auth::id() == $d->user->id)
                <a href="{{route('best.answer',$r->id)}}" class="btn btn-info btn-xs pull-right"> Mark as best answer</a>
               @endif

                @endif

                @if(!$best_answer && Auth::id() == $r->user_id)
                <a style="margin-right: 10px;" href="{{route('reply.edit',$r->id)}}" class="btn btn-primary btn-xs pull-right"> Edit</a>
                @endif

            </div>

            <div class="panel-body">

                <p >{!! Markdown::convertToHtml($r->content) !!}</p>

            </div>
            <div class="panel-footer">
                @if(Auth::check())

                {{--prasuvame dali momentalniot reply e like-nat od user-ot koj momentalno e logiran(logikata e vo Reply modelot)--}}
                  @if($r->is_liked_by_auth_user())
                    <a href="{{route('reply.unlike',$r->id)}}" class="btn btn-info btn-xs">Unlike</a>
                  @else

                    <a href="{{route('reply.like',$r->id)}}" class="btn btn-danger btn-xs">Like</a>

                @endif
               {{--brojot na likes na odredeniot reply--}}
                @endif
                <span  class="badge badge-info pull-right">{{$r->likes->count()}} like(s) </span>
                   <div style="margin-top: 40px;">replied: <b>{{$r->created_at->diffForHumans()}}</b></div>
            </div>

        </div>
    @endforeach


        @if(Auth::check())

            <form action="{{route('reply.store',['id' => $d->id])}}" method="post">

                {{csrf_field()}}

                <div class="form-group">
                    <label for="reply">Leave a reply...</label>
                    <textarea name="reply" id="reply" cols="30" rows="10" class="form-control"></textarea>
                </div>




                <div class="form-group">
                    <button class="btn btn-primary form-control" type="submit">Reply</button>
                </div>
            </form>


        @else

            <h3 class="text-center">Sign in to leave a reply</h3>


         @endif






@endsection