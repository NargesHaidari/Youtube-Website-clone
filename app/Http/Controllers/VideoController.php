<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function store(Request $request){

        $request->validate([
            'title' => 'string|required',
            'description' => 'nullable|string',
            'video' => 'required|file|mimes:mp4,mov,avi,mkv,webm|max:307200',
        ]);

        $videoPath = $request->file('video')->store('videos', 'public');

        Video::create([
            'channel_id' => auth()->user()->channel->id,
            'title' => $request->title,
            'description' => $request->description,
            'video_path' => $videoPath,
        ]);

        return redirect()->route('youtube');
    }

    public function index(){
        $videos = Video::with('channel')
            ->latest()
            ->get();

        return view('youtube', compact('videos'));
    }
}