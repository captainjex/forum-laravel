<?php

namespace App\Http\Controllers;

use Auth;
use App\Channel;
use App\Topic;
use App\Http\Requests\TopicRequest;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function create(){
        $channels = Channel::all();
        return view('topics.create', compact('channels'));
    }

    public function store(TopicRequest $request){

        Auth::user()->topics()->create([
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'channel_id' => $request->channel,
            'body' => $request->body,
        ]);

        $request->session()->flash('status', 'Telah berhasil di post');
        return back();
    }

    public function index(){
        $topics = Topic::latest()->get();
        return view('topics.index', compact('topics'));
    }

    public function show($slug)
    {
        $topic = Topic::whereSlug($slug)->first();
        return view('topics.show', compact('topic'));
    }

    public function edit($slug)
    {
        $topic = Topic::whereSlug($slug)->first();
        $channels = Channel::all();
        return view('topics.edit', compact('topic', 'channels'));
    }

    public function update(Request $request)
    {
        dd($request->title);
    }
}
