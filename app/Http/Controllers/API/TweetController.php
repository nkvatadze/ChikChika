<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Tweets\{IndexRequest, StoreRequest};
use App\Http\Resources\TweetResource;
use App\Models\Tweet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class TweetController extends Controller
{
    public function index(IndexRequest $request): JsonResource
    {
        $tweets = (new Tweet)->tweetsForFeed($request->page)->items();

        return TweetResource::collection($tweets);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        auth()->user()->tweets()->create($request->validated());

        return response()->json(null, Response::HTTP_CREATED);
    }

    public function show(Tweet $tweet): JsonResource
    {
        $tweet->loadCount('likes', 'replies')
            ->load([
                'user',
                'likes' => fn($query) => $query->where('user_id', auth()->id())
            ]);

        return new TweetResource($tweet);
    }
}
