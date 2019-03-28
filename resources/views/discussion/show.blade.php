@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
                <div class="card" style="margin-bottom: 20px;">

                        <div class="card-header">
                            <img src="{{ $discussion->user->avatar }}" width="50" height="50">
                            <span style="margin-left: 10px;">{{ $discussion->user->name }} <b>( {{ $discussion->user->points }} Points )</b></span>

                            @if($discussion->is_being_watched_by_auth_user())

                            <a class="btn btn-danger btn-sm float-right" style="margin-left: 10px;" href="{{ route('discussion.unwatch', ['id' => $discussion->id]) }}">unwatch</a>

                            @else

                            <a class="btn btn-dark btn-sm float-right" style="margin-left: 10px;" href="{{ route('discussion.watch', ['id' => $discussion->id]) }}">Watch</a>

                            @endif

                            @if(!$discussion->hasBestAnswer())
                            @if(Auth::id() == $discussion->user->id)
                            <a href="{{ route('discussion.edit', ['slug' => $discussion->slug]) }}" class="btn btn-success btn-sm float-right" style="margin-left: 10px;" >Edit</a>
                            @endif
                            @endif

                            @if($discussion->hasBestAnswer())

                            <a href="" class="btn btn-success btn-sm float-right">Closed</a>

                            @else

                            <a href="" class="btn btn-danger btn-sm float-right">Open</a>

                            @endif

                        </div>

                        <div class="card-body">

                            <h3 class="text-center">{{ $discussion->title }}</h3>

                            <hr/>

                            {!! Markdown::convertToHtml($discussion->content) !!}

                            <hr/>

                            @if($best_answer)

                            <div class="text-center" style="padding: 40px;">
                                <h3>Best Answer</h3>
                                <div class="card card-success">
                                    <div class="card-header text-white bg-success">
                                        <img src="{{ $best_answer->user->avatar }}" width="50" height="50">
                                        <span style="margin-left: 10px;">{{ $best_answer->user->name }}<b>( {{ $best_answer->user->points }} Points )</b></span>
                                    </div>
                                    <div class="card-body">
                                        {!! Markdown::convertToHtml($best_answer->content) !!}
                                    </div>
                                </div>
                            </div>

                            @endif

                        </div>

                        <div class="card-footer">

                                <span>{{ $discussion->replies->count() }} Replies</span>
                                <a href="{{ route('channel', ['slug' => $discussion->channel->slug]) }}" class="btn btn-secondary float-right btn-sm">{{ $discussion->channel->title }}</a>

                        </div>

                </div>
        </div>
    </div>
</div>

@foreach ($discussion->replies as $reply)

<div class="card" style="margin-bottom: 20px;">

        <div class="card-header">
            <img src="{{ $reply->user->avatar }}" width="50" height="50">
            <span style="margin-left: 10px;">{{ $reply->user->name }} <b>( {{ $reply->user->points }} Points )</b></span>
            @if(!$best_answer)

                @if(Auth::id() == $discussion->user->id)
                    <a href="{{ route('discussion.best.answer', ['id' => $reply->id]) }}" class="btn btn-sm btn-info float-right">Mark as Helpful</a>
                @endif

            @endif

            @if(Auth::id() == $reply->user->id)

                    @if(!$reply->best_answer)
                    <a href="{{ route('reply.edit', ['id' => $reply->id]) }}" style="margin-right: 9px;" class="btn btn-sm btn-danger float-right">Edit</a>
                    @endif

            @endif
        </div>

            <div class="card-body">


                {!! Markdown::convertToHtml($reply->content) !!}

        </div>

        <div class="card-footer">

            @if ($reply->is_liked_by_auth_user())

            <a href="{{ route('reply.unlike', ['id' => $reply->id]) }}" class="btn btn-danger btn-sm">Unlike <span class="badge badge-light">{{ $reply->likes->count() }}</span></a>

            @else

            <a href="{{ route('reply.like', ['id' => $reply->id]) }}" class="btn btn-success btn-sm">Like <span class="badge badge-light">{{ $reply->likes->count() }}</span></a>

            @endif

        </div>

</div>

@endforeach

<div class="card card-default">

    <div class="card-body">

        @if(Auth::check())

        <form action="{{ route('discussion.reply', ['id' => $discussion->id]) }}" method="post">

                {{ csrf_field() }}

                <div class="form-group">

                    <label for="label">Leave a replt...</label>

                    <textarea name="reply" id="reply" cols="30" rows="8" class="form-control"></textarea>

                </div>

                <div class="form-group">

                        <button class="btn btn-primary float-right" type="submit">Leave a reply</button>

                </div>

        </form>

        @else

        <div class="text-center">

            <h2>Sign in to leave a reply</h2>

        </div>

        @endif

    </div>

</div>

@endsection
