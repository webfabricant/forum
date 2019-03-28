@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">Update a discussion</div>

                <div class="card-body">

                    <form action="{{ route('discussion.update', ['id' => $discussion->id]) }}" method="post">

                        {{ csrf_field() }}

                        <div class="form-group">

                            <label for="content">Ask a question?</label>

                            <textarea name="content" id="content" cols="30" rows="8" class="form-control">{{ $discussion->content }}</textarea>

                        </div>

                        <div class="form-group">

                            <button class="btn btn-success" type="submit">Update discussion</button>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
