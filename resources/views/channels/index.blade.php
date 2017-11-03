@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Channels</div>

                    <div class="panel-body">

                        @if(Session::has('success'))
                            <div class=" alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        <table class="table table-striped table-hover ">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Edit</th>
                              <th>Delete</th>

                            </tr>
                          </thead>
                          <tbody>
                          @foreach($channels as $channel)
                            <tr>
                             <td>{{$channel->title}}</td>
                              <td><a class="btn btn-xs btn-info" href="{{route('channels.edit',['channel' => $channel->id])}}">edit</a></td>
                              <td>

          <form action="{{route('channels.destroy',['channel' => $channel->id])}}" method="post">
                       {{csrf_field()}}
                      {{method_field('DELETE')}}
              <button class="btn btn-xs btn-danger" type="submit">
                 destroy
              </button>

                                  </form>
                            </tr>
                              @endforeach
                          </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
