@extends('layouts.app')

@section('content')

        <div class="panel panel-default">
            <div class="panel-heading">
                <img width="40" height="40" src="{{$d->user->avatar}}" alt="{{$d->user->name}}">&nbsp;&nbsp;&nbsp;
                <span>{{$d->user->name}},</span><span><b>{{$d->created_at->diffForHumans()}}</b></span>

              @if($d->is_watched_by_auth_user())
                    <a href='{{route('discussion.unwatch',$d->id)}}' class="btn btn-default btn-xs pull-right">Unwatch</a>
              @else
                    <a href='{{route('discussion.watch',$d->id)}}' class="btn btn-default btn-xs pull-right">Watch</a>
               @endif
            </div>

            <div class="panel-body">
                <h3 class="text-center">
                    <b>{{ $d->title}}</b>
                </h3>
                <hr>
                <p class="text-center">{{$d->content}}</p>

            </div>
            <div class="panel-footer">
                <a href="#" style="text-decoration: none">{{$d->replies->count()}} replies</a>
                <a href="{{route('channel',$d->channel->slug)}}" style="text-decoration: none" class="pull-right"><b>{{$d->channel->title}}</b></a>
            </div>
        </div>

    @foreach($d->replies as $r)

        <div class="panel panel-default">
            <div class="panel-heading">
                <img width="40" height="40" src="{{$r->user->avatar}}" alt="{{$r->user->name}}">&nbsp;&nbsp;&nbsp;
                <span>{{$r->user->name}},</span><span><b>{{$r->created_at->diffForHumans()}}</b></span>

            </div>

            <div class="panel-body">

                <p >{{$r->content}}</p>

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

            </div>
        </div>
    @endforeach


        @if(Auth::check())

            <form action="{{route('reply.store',['id' => $d->id])}}" method="post">

                {{csrf_field()}}

                <div class="form-group">
                    <label for="reply">Leace a reply...</label>
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