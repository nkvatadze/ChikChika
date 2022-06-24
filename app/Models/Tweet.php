<?php

namespace App\Models;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tweet extends Model
{
    use HasFactory;

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 5;

    /**
     * @var array <int, string>
     */
    public $fillable = [
        'user_id',
        'content'
    ];

    /**
     * @return Attribute
     * @throws Exception
     */
    public function likedByAuthUser(): Attribute
    {
        $this->relationLoaded('likes') ?? throw new Exception('Eager loading problem can occur, please load likes relationship');

        return new Attribute(
            get: fn($value) => $this->likes->contains('user_id', auth()->id())
        );
    }

    /**
     * @return HasMany
     */
    public function likes(): HasMany
    {
        return $this->hasMany(TweetLike::class);
    }

    /**
     * @return HasMany
     */
    public function replies(): HasMany
    {
        return $this->hasMany(TweetReply::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param int $page
     * @param int|null $userId specify to show only specific user's tweets
     * @return LengthAwarePaginator
     */
    public function tweetsForFeed(int $page, ?int $userId = null): LengthAwarePaginator
    {
        return Tweet::query()->withCount('likes', 'replies')
            ->with([
                'user',
                'likes' => fn($query) => $query->where('user_id', auth()->id())
            ])
            ->when(
                $userId,
                fn(Builder $query) => $query->where('user_id', $userId),
                fn(Builder $query) => $query->where(function (Builder $query) {
                    $query->whereHas('user.followers', fn(Builder $query) => $query->where('follower_id', auth()->id()))
                        ->orWhere('user_id', auth()->id());
                })
            )
            ->orderByDesc('id')
            ->paginate($this->perPage, page: $page);
    }
}
