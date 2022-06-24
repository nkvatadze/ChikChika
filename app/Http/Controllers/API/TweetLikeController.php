<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TweetLikeController extends Controller
{
    public function like(Tweet $tweet): JsonResponse
    {
        if (!auth()->user()->hasLikedTweet($tweet->id))
            auth()->user()->likeTweet($tweet->id);

        return response()->json(null, Response::HTTP_CREATED);
    }

    public function unlike(Tweet $tweet): JsonResponse
    {
        auth()->user()->unlikeTweet($tweet->id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
