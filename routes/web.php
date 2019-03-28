<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/discuss', function () {
    return view('discuss');
});

Route::get('/forum',[

    'uses' => 'forumsController@index',
    'as' => 'forum'

]);

Route::get('discussion/{slug}', [

    'uses' => 'DiscussionController@show',
    'as' => 'discussion'

]);

Route::get('channels/{slug}', [

    'uses' => 'ForumsController@channel',
    'as' => 'channel'

]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('{provider}/auth', [

    'uses' => 'SocialsController@auth',
    'as' => 'social.auth'

]);

Route::get('/{provider}/redirect',[

    'uses' => 'SocialsController@auth_callback',
    'as' => 'social.callback'

]);

Route::group(['middleware' => 'auth'], function(){

    Route::resource('channels', 'ChannelsController');

    Route::get('discussion/create/new', [

        'uses' => 'DiscussionController@create',
        'as' => 'discussion.create'

    ]);

    Route::post('discussion/store', [

        'uses' => 'DiscussionController@store',
        'as' => 'discussion.store'

    ]);

    Route::post('/discussion/reply/{id}', [

        'uses' => 'DiscussionController@reply',
        'as' => 'discussion.reply'

    ]);

    Route::get('/reply/like/{id}', [

        'uses' => 'RepliesController@like',
        'as' => 'reply.like'

    ]);

    Route::get('/reply/unlike/{id}', [

        'uses' => 'RepliesController@unlike',
        'as' => 'reply.unlike'

    ]);

    Route::get('/discussion/watch/{id}', [

        'uses' => 'watchersController@watch',
        'as' => 'discussion.watch'

    ]);

    Route::get('/discussion/unwatch/{id}', [

        'uses' => 'watchersController@unwatch',
        'as' => 'discussion.unwatch'

    ]);

    Route::get('/discussion/best/reply/{id}', [

        'uses' => 'RepliesController@best_answer',
        'as' => 'discussion.best.answer'

    ]);

    Route::get('/discussion/edit/{slug}', [

        'uses' => 'DiscussionController@edit',
        'as' => 'discussion.edit'

    ]);

    Route::post('/discussion/update/{id}', [

        'uses' => 'DiscussionController@update',
        'as' => 'discussion.update'

    ]);

    Route::get('/reply/edit/{id}', [

        'uses' => 'RepliesController@edit',
        'as' => 'reply.edit'

    ]);

    Route::post('reply/update/{id}', [

        'uses' => 'RepliesController@update',
        'as' => 'reply.update'

    ]);

});
