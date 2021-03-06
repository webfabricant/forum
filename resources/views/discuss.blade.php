@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">Create a new discussion</div>

                <div class="card-body">

                    <form action="{{ route('discussion.store') }}" method="post">

                        {{ csrf_field() }}

                        <div class="form-group">

                            <label for="channel">Title</label>

                            <input type="text" name="title" value="{{ old('title') }}" class="form-control">

                        </div>

                        <div class="form-group">

                            <label for="channel">Pick a Channel</label>

                            <select class="form-control" name="channel_id" id="channel_id">

                                @foreach ($channels as $channel)
                                    <option value="{{ $channel->id }}">{{ $channel->title }}</option>
                                @endforeach

                            </select>

                        </div>

                        <div class="form-group">

                            <label for="content">Ask a question?</label>

                            <textarea name="content" id="content" cols="30" rows="8" class="form-control">{{ old('content') }}</textarea>

                        </div>

                        <div class="form-group">

                            <button class="btn btn-success" type="submit">Create a discussion</button>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
