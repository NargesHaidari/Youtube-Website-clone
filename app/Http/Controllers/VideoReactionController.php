<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\VideoReaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VideoReactionController extends Controller
{
    public function toggle(Request $request, Video $video): JsonResponse
    {
        $validated = $request->validate([
            'type' => ['required', Rule::in(['like', 'dislike'])],
        ]);

        $user = $request->user();

        $reaction = VideoReaction::where('user_id', $user->id)
            ->where('video_id', $video->id)
            ->first();

        if ($reaction && $reaction->type === $validated['type']) {
            $reaction->delete();
            $userReaction = null;
        } else {
            $reaction = VideoReaction::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'video_id' => $video->id,
                ],
                [
                    'type' => $validated['type'],
                ]
            );

            $userReaction = $reaction->type;
        }

        return response()->json([
            'success' => true,
            'user_reaction' => $userReaction,
            'likes_count' => $video->reactions()
                ->where('type', 'like')->count(),
            'dislikes_count' => $video->reactions()
                ->where('type', 'dislike')->count(),
        ]);
    }
}
