<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

	protected $fillable = ['name', 'email', 'password', 'phone', 'city', 'zone', 'area', 'country', 'zip', 'avatar'];


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
        'password' => 'hashed',
    ];

	public function orders()
    {
        return $this->hasMany(Order::class);
    }

	public function reviews()
	{
		return $this->hasMany(Review::class);
	}

	public function getReviewsCountAttribute()
	{
		return $this->reviews()->count(); // Count the number of reviews for this user
	}

	public function getOrdersCountAttribute()
	{
		return $this->orders()->whereIn('status', [1, 2, 3])->count();
	}

	public function getAvatarPathAttribute()
	{
		return $this->avatar ? asset('storage/avatars/' . $this->avatar) : asset('storage/avatars/default-avatar.jpeg');
	}

}
