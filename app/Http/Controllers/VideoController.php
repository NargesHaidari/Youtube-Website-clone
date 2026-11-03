<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;

class VideoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video' => 'required|file|mimes:mp4,mov,avi,mkv,webm|max:307200',
        ]);

        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $channel = $user->channel;

        if (!$channel) {
            return back()
                ->withInput()
                ->withErrors([
                    'video' => 'You must create a channel first.',
                ]);
        }

        $videoPath = $request->file('video')
            ->store('videos', 'public');

        if (!$videoPath) {
            return back()
                ->withInput()
                ->withErrors([
                    'video' => 'Failed to upload the video file.',
                ]);
        }

        try {
            $video = Video::create([
                'channel_id' => $channel->id,
                'title' => $request->title,
                'description' => $request->description,
                'video_path' => $videoPath,
                'thumbnail' => null,
            ]);
        } catch (\Throwable $e) {
            Storage::disk('public')->delete($videoPath);

            report($e);

            return back()
                ->withInput()
                ->withErrors([
                    'video' => 'Failed to save video information. Please check the laravel.log file.',
                ]);
        }

        try {
            $disk = Storage::disk('public');

            $disk->makeDirectory('thumbnails');

            $ffmpeg = FFMpeg::create([
                'ffmpeg.binaries' => 'C:/ffmpeg/bin/ffmpeg.exe',
                'ffprobe.binaries' => 'C:/ffmpeg/bin/ffprobe.exe',
                'timeout' => 3600,
                'ffmpeg.threads' => 2,
            ]);

            $fullVideoPath = $disk->path($videoPath);

            $thumbnailPath = 'thumbnails/' . Str::uuid() . '.jpg';
            $thumbnailFullPath = $disk->path($thumbnailPath);

            $openedVideo = $ffmpeg->open($fullVideoPath);

            $openedVideo
                ->frame(TimeCode::fromSeconds(1))
                ->save($thumbnailFullPath);

            $video->update([
                'thumbnail' => $thumbnailPath,
            ]);

        } catch (\Throwable $e) {
            report($e);
        }

        return redirect()
            ->route('youtube')
            ->with('success', 'Video uploaded successfully.');
    }

    public function home()
    {
        $videos = Video::with('channel')
            ->latest()
            ->get();

        return view('youtube', compact('videos'));
    }

    public function index($id)
    {
        $video = Video::with('channel')->findOrFail($id);

        $video->increment('views');
        $video->refresh();

        $relatedVideos = Video::with('channel')
            ->where('id', '!=', $video->id)
            ->latest()
            ->take(3)
            ->get();

        return view('showVideo', compact('video', 'relatedVideos'));
    }
}
