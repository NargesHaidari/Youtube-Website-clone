<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\VideoLike;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VideoLikeController extends Controller
{
    public function toggle(Request $request, Video $video): JsonResponse
    {
        $user = $request->user();

        $like = VideoLike::where('user_id', $user->id)
            ->where('video_id', $video->id)
            ->first();

        if ($like) {
            $like->delete();

            $liked = false;
        } else {
            VideoLike::create([
                'user_id' => $user->id,
                'video_id' => $video->id,
            ]);

            $liked = true;
        }

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $video->likes()->count(),
            'message' => $liked
                ? 'Video liked successfully.'
                : 'Video unliked successfully.',
        ]);
    }
}
