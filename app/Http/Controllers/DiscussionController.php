<?php

namespace App\Http\Controllers;

use Session;

use App\User;

use App\Discussion;

use App\Reply;

use Notification;

use Auth;

use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function create(){

        return view('discuss');

    }

    public function store(Request $request){

        $this->validate($request, [

            'channel_id' => 'required',
            'content' => 'required',
            'title' => 'required'

        ]);


        $discussion = Discussion::create([

            'title' => $request->title,
            'channel_id' => $request->channel_id,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'slug' => str_slug($request->title)

        ]);

        session::flash('success', 'Discussion created successfully.');

        $discussion->save();

        return redirect()->route('discussion', ['slug' => $discussion->slug]);

    }



    public function show($slug){

        // dd($slug);
        // dd(Discussion::where('slug', $slug)->first());
        $discussion = Discussion::where('slug', $slug)->first();
        $best_answer = $discussion->replies()->where('best_answer', 1)->first();
        return view('discussion.show')->with('discussion', $discussion)->with('best_answer', $best_answer);

    }

    public function reply($id){

        $discussion = Discussion::find($id);

        $reply = Reply::create([

            'user_id' => Auth::id(),
            'discussion_id' => $id,
            'content' => request()->reply

        ]);

        $reply->user->points += 25;

        $reply->user->save();

        $watchers = array();

        foreach($discussion->watchers as $watcher):

            array_push($watchers, User::find($watcher->user_id));

        endforeach;

        Notification::send($watchers, new \App\Notifications\NewReplyAdded($discussion));

        // dd($watchers);

        $reply->save();

        session::flash('success', 'Replied to discussion');

        return redirect()->back();

    }

    public function edit($slug){

        return view('discussion.edit')->with('discussion', Discussion::where('slug', $slug)->first());

    }

    public function update($id){

        $this->validate(request(), [

            'content' => 'required'

        ]);

        $discussion = Discussion::find($id);

        $discussion->content = request()->content;

        $discussion->save();

        session::flash('success', 'Discussion Updated');

        return redirect()->route('discussion', [$discussion->slug]);

    }

}
