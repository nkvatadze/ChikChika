<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    public function show(): JsonResource
    {
        return new UserResource(
            auth()->user()->loadCount('followers', 'followings')
        );
    }

    public function followings(): JsonResource
    {
        $followings = auth()->user()->followings()->withCount('followers', 'followings')->get();

        return UserResource::collection($followings);
    }

    public function follows(): JsonResource
    {
        $followers = auth()->user()->followers()->withCount('followers', 'followings')->get();

        return UserResource::collection($followers);
    }
}
