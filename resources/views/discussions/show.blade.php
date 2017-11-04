@extends('layouts.app')

@section('content')

        <div class="panel panel-default">
            <div class="panel-heading">
                <img width="40" height="40" src="{{$d->user->avatar}}" alt="{{$d->user->name}}">&nbsp;&nbsp;&nbsp;
                <span>{{$d->user->name}},</span><span><b>{{$d->created_at->diffForHumans()}}</b></span>

            </div>

            <div class="panel-body">
                <h3 class="text-center">
                    <b>{{ $d->title}}</b>
                </h3>
                <hr>
                <p class="text-center">{{$d->content}}</p>

            </div>
            <div class="panel-footer">
                <p>{{$d->replies->count()}} replies</p>
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
                  LIKE
            </div>
        </div>
    @endforeach




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



@endsection