<?php

namespace App\Models;

use Exception;
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
}
