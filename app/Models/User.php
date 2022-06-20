<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'is_private',
        'email',
        'password',
        'profile_image_url'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_image_url'
    ];

    /**
     * @return BelongsToMany
     */
    public function followings(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follower_user', 'follower_id', 'user_id')
            ->using(FollowerUser::class)
            ->withPivot('created_at');
    }

    /**
     * @return BelongsToMany
     */
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follower_user', 'user_id', 'follower_id')
            ->using(FollowerUser::class)
            ->withPivot('created_at');
    }

    public function followedByAuth(): BelongsToMany
    {
        return $this->followers()
            ->wherePivot('follower_id', auth()->id());
    }

    /**
     * @return HasMany
     */
    public function tweets(): HasMany
    {
        return $this->hasMany(Tweet::class);
    }

    /**
     * @return HasMany
     */
    public function likedTweets(): HasMany
    {
        return $this->hasMany(TweetLike::class);
    }


    public function profileImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? url('storage/' . $value) : asset('images/default-profile.png')
        );
    }

    public function hasBeenFollowing($user): bool
    {
        return (bool)$this->whereHas(
            'followings',
            fn(Builder $query) => $query->where('user_id', $user->id)
        )->first();
    }

    public function scopeIsAuth(Builder $query): Builder
    {
        return $query->where('id', auth()->id());
    }

    public function scopeNotAuth(Builder $query): Builder
    {
        return $query->whereNot('id', auth()->id());
    }

    public function scopeNotFollowedBy(Builder $query, int $userId): Builder
    {
        return $query->whereDoesntHave('followers', fn($query) => $query->where('follower_id', $userId));
    }
}
