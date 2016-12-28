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
        $channels = Channel::all();
        return view('topics.index', compact('topics', 'channels'));
    }

    public function show($slug)
    {
        $topic = Topic::whereSlug($slug)->first();
        return view('topics.show', compact('topic'));
    }

    public function edit($slug)
    {
        $topic = Topic::whereSlug($slug)->first();
        if (Auth::user()->id == $topic->user_id){
            $channels = Channel::all();
            return view('topics.edit', compact('topic', 'channels'));
        } else{
            return redirect()->to("/topics/{$slug}");
        }
    }

    public function update(Request $request, $slug)
    {
        $topic = Topic::whereSlug($slug)->first();
        if (!$topic) {
            return redirect()->to('/topics');
        }
        if ($request->user()->id == $topic->user_id) {
            $this->validate($request, [
                'title' => 'required|max:255|min:3|unique:topics,title,' . $topic->id,
                'body' => 'required',
                'channel' => 'required',
            ]);
            $topic->update([
                'title' => $request->title,
                'slug' => str_slug($request->title),
                'body' => $request->body,
                'channel_id' => $request->channel,
            ]);
            $request->session()->flash('status', 'Topik berhasil diperbarui');
            return redirect()->to("/topics/" . str_slug($topic->title));

        }else{
            $request->session()->flash('status', 'Tidak boleh mengedit ini');
            return redirect()->to('/topics');
        }
    }

    public function channel($slug)
    {
        $channel = Channel::whereSlug($slug)->first;
        
    }
}
