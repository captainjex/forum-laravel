@extends('layouts.app')

@section('content')
    <div class="page-header text-center ">
        <h3>Buat Topik Baru</h3>
    </div>

    <form class="" action="" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="channel">Channel</label>
            <select name="channel" id="channel" class="form-control">
                @foreach ($channels as $channel)
                    <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea rows="15" name="body" id="body" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="name" value="enter" class="btn btn-default">
        </div>
    </form>
@endsection
