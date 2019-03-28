@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            {{--  {{ dd($discussions) }}  --}}

            @foreach ($discussions as $discussion)

            <div class="card" style="margin-bottom: 20px;">
                <div class="card-header">
                    <img src="{{ $discussion->user->avatar }}" width="50" height="50">
                    <span style="margin-left: 10px;">{{ $discussion->user->name }} <b>{{ $discussion->created_at->diffForHumans() }}</b></span>
                    <a class="btn btn-dark float-right btn-sm" style="margin-left: 10px;" href="{{ route('discussion', ['slug' => $discussion->slug]) }}">View</a>
                    @if($discussion->hasBestAnswer())

                    <a href="" class="btn btn-success btn-sm float-right">Closed</a>

                    @else

                    <a href="" class="btn btn-danger btn-sm float-right">Open</a>

                    @endif
                </div>

                <div class="card-body text-center">

                    <h3>{{ $discussion->title }}</h3>

                    {{ str_limit($discussion->content, 50) }}

                </div>

                <div class="card-footer">

                        <span>{{ $discussion->replies->count() }} Replies</span>
                        <a href="{{ route('channel', ['slug' => $discussion->channel->slug]) }}" class="btn btn-secondary float-right btn-sm">{{ $discussion->channel->title }}</a>

                </div>

            </div>

            @endforeach

        </div>

        <br/>

        <div class="text-center">

                {{ $discussions->links() }}

        </div>

    </div>
</div>
@endsection
