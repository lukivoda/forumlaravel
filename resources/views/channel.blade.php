@extends('layouts.app')

@section('content')
    @foreach($discussions as $d)
        <div class="panel panel-default">
            <div class="panel-heading">
                <img width="40" height="40" src="{{$d->user->avatar}}" alt="{{$d->user->name}}">&nbsp;&nbsp;&nbsp;
                <span>{{$d->user->name}},</span><span><b>{{$d->created_at->diffForHumans()}}</b></span>
                <a  href="{{route('discussion',['slug' =>$d->slug])}}" class="btn btn-default pull-right">View</a>
            </div>

            <div class="panel-body">
                <h3 class="text-center">
                    {{ $d->title}}
                </h3>
                <p class="text-center">{{str_limit($d->content,80)}}</p>

            </div>
            <div class="panel-footer">
                <p>{{$d->replies->count()}} replies</p>
            </div>
        </div>
    @endforeach

    <div class="text-center">
        {{--pagination(odbrojuvanje na stranite--}}
        {{$discussions->links()}}

    </div>

@endsection
