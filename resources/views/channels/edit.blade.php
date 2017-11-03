@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Edit channel: {{$channel->title}}</div>

                    <div class="panel-body">
                        <form action="{{route('channels.update',['channel'=>$channel->id])}}" method="post">

                            {{csrf_field()}}
                        {{--koga koristime resource mora da koristime za metod put ili patch    --}}
                            {{method_field("PUT")}}

                            <div class="form-group">
                                <input type="text" name="title" value="{{$channel->title}}" class="form-control">
                            </div>

                            <div class="form-group">

                                <button class="btn btn-success text-center " type="submit">
                                    Update channel
                                </button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection