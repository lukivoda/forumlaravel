@extends('layouts.app')

@section('content')
             @foreach($discussions as $d)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <img width="40" height="40" src="{{$d->user->avatar}}" alt="{{$d->user->name}}">&nbsp;&nbsp;&nbsp;
                    <span>{{$d->user->name}},</span><span><b>{{$d->created_at->diffForHumans()}}</b></span>
                    <a  href="{{route('discussion',['slug' =>$d->slug])}}" class="btn btn-default pull-right">View</a>

                    {{--prasuvame dali diskusijata ima reply koj ima best_answer=1(logikata e vo modelot)--}}
                    @if($d->hasBestAnswer())
                        {{--ako ima reply so best answer diskusijata e zatvorena--}}
                        <span style="margin-right: 10px"  class="btn btn-success  pull-right">closed</span>
                    @else
                        {{--ako ima reply so best answer diskusijata e otvorena--}}
                        <span style="margin-right: 10px"  class="btn btn-danger  pull-right"> open</span>
                    @endif

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


             {{--@if(isset($_GET['filter']) && $_GET['filter'] =='me'))--}}

                  {{--{{ $discussions->appends(['filter' => 'me'])->links() }}--}}




             {{--@elseif(isset($_GET['filter']) && $_GET['filter'] =='answered'))--}}

             {{--{{ $discussions->appends(['filter' => 'answered'])->links()->render() }}--}}


             {{--@elseif(isset($_GET['filter']) && $_GET['filter'] =='unanswered'))--}}

             {{--{{ $discussions->appends(['filter' => 'unanswered'])->links() }}--}}

                 {{--@else {{$discussions->links()}}--}}

             {{--@endif--}}


             @if(isset($_GET['filter']) && $_GET['filter'] =='unanswered'))
             {{$discussions->appends(['filter' => 'unanswered'])->links()}}

             @elseif(isset($_GET['filter']) && $_GET['filter'] =='answered'))
             {{$discussions->appends(['filter' => 'answered'])->links()}}
             @else
                 {{$discussions->links()}}

             @endif












         </div>

@endsection
