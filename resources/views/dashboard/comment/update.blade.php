@extends('templates.default')
@section('title')
Store house | Dashboard update comment
@stop
@section('content')

    <h2>Update comment:</h2> <br>
    <form role="form" action="{{route('dashboard.comment.update', ['commentid'=>$comment->id])}}" method="post">
    <div class="form-group {{$errors->first('comm_body') ? ' has-error' : ''}}">
        <textarea id="comm_body" name="comm_body" class="form-control" rows="2" placeholder="Reply to this discussion">{{ Request::old('comm_body') ? Request::old('comm_body') : $comment->comm_body }}</textarea>
    		@if($errors->first('comm_body'))
            <span class="label label-danger">
            	{{$errors->first('comm_body')}}
        	</span>
        @endif
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox" name="active" {{ $comment->active ? 'checked' : ''}}> Publish this comment ( This item is currently {{ $comment->active ? 'Published' : 'Not published'}})
        </label>
    </div>
    <input type="submit" value="Update" class="btn btn-default">
    <input type="hidden" name="_token" value="{{Session::token()}}">
    <input type="hidden" name="id" value="{{$comment->id}}">
    </form>

@stop