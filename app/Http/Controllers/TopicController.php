<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Channel;
use Auth;

class TopicController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){
        $channels = Channel::all();
        return view('topics.create', compact('channels'));
    }

    public function store(Request $request){
        Auth::user()->topics()->create([
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'channel_id' => $request->channel,
            'body' => $request->body,
        ]);
    }
}
