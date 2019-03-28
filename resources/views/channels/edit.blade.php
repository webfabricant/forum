@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Update Channel</div>
                <div class="card-body">

                    <form action="{{ route('channels.update', ['channel' => $channel->id]) }}" method="post">

                        {{ csrf_field() }}

                        {{ method_field('PUT') }}

                        <div class="form-group">

                            <input type="text" name="channel" class="form-control" value="{{ $channel->title }}">

                        </div>

                        <div class="form-group">

                                <button class="btn btn-success" type="submit">
                                    Save Channel
                                </button>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
