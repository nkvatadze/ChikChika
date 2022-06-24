<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\TweetReplies\StoreRequest;
use App\Http\Resources\TweetReplyResource;
use App\Models\Tweet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class TweetReplyController extends Controller
{
    public function index(Tweet $tweet): JsonResource
    {
        $replies = $tweet->replies()->with('user')->orderByDesc('id')->get();

        return TweetReplyResource::collection($replies);
    }

    public function store(Tweet $tweet, StoreRequest $request): JsonResponse
    {
        $validated = $request->validated() + ['user_id' => auth()->id()];
        $tweet->replies()->create($validated);

        return response()->json(null, Response::HTTP_CREATED);
    }
}
