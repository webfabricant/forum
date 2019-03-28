<?php

namespace App\Http\Controllers;

use Auth;
use App\Discussion;
use App\Like;
use App\Reply;

use Session;

use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function like($id){

        Like::create([

            'reply_id' => $id,
            'user_id' => Auth::id()

        ]);

        session::flash('success', 'You liked the reply!');

        return redirect()->back();

    }

    public function unlike($id){

        $like = Like::where('reply_id', $id)->where('user_id', Auth::id())->first();

        $like->delete();

        session::flash('success', 'You unliked the post');

        return redirect()->back();

    }

    public function best_answer($id){

        $reply = Reply::find($id);

        $reply->best_answer = 1;

        $reply->save();

        $reply->user->points += 100;

        $reply->user->save();

        session::flash('success', 'Reply has been marked as helpful');

        return redirect()->back();

    }

    public function edit($id){

        return view('replies.edit')->with('reply', Reply::find($id));

    }

    public function update($id){

        $this->validate(request(), [

            'content' => 'required'

        ]);

        $reply = Reply::find($id);

        $reply->content = request()->content;

        $reply->save();

        Session::flash('success', 'Reply updated');

        return redirect()->route('discussions', [$reply->discussion->slug]);

    }

}
