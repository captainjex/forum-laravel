@extends('layouts.app')

@section('content')
    <div class="page-header text-center ">
        <h3>Buat Topik Baru</h3>
    </div>

    <form class="" action="" method="post">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control">
            @if ($errors->has('title'))
                <span class="help-block">{{ $errors->first('title') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('channel') ? ' has-error' : '' }}">
            <label for="channel">Channel</label>
            <select name="channel" id="channel" class="form-control">
                <option value="">Pilih channel</option>
                @foreach ($channels as $channel)
                    <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('channel'))
                <span class="help-block">{{ $errors->first('channel') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
            <label for="body">Body</label>
            <textarea rows="15" name="body" id="body" class="form-control"></textarea>
            @if ($errors->has('body'))
                <span class="help-block">{{ $errors->first('body') }}</span>
            @endif
        </div>
        <div class="form-group">
            <input type="submit" name="name" value="enter" class="btn btn-default">
        </div>
    </form>
@endsection
