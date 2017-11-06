@extends('layouts.app')

@section('content')

    <div class="panel panel-info">
        <div class="panel-heading text-center">Update the reply content</div>

        <div class="panel-body">

            <form action="{{route('reply.update',$r->id)}}" method="post">
                {{csrf_field()}}


                <div class="form-group">

                    <label for="content">Ask question</label>

                             <textarea name="content" id="content" cols="30" rows="10" class="form-control">
                                {{($r->content)}}
                             </textarea>

                </div>

                <div class="form-group">
                    <button class="btn btn-success" type="submit">Update reply changes</button>

                </div>


            </form>


        </div>
    </div>

@endsection
