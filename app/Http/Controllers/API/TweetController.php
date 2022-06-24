<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Tweets\IndexRequest;
use App\Http\Resources\TweetResource;
use App\Models\Tweet;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TweetController extends Controller
{
    public function index(IndexRequest $request): JsonResource
    {
        $tweets = (new Tweet)->tweetsForFeed($request->page)->items();

        return TweetResource::collection($tweets);
    }
}
