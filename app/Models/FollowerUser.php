<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FollowerUser extends Pivot
{
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'follower_id'
    ];
}
