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
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
        'view_password',
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
        'password' => 'hashed',
    ];

    public function userData()
    {
        return $this->hasOne(userData::class);
    }

    public function userAmount()
    {
        return $this->hasMany(amount::class);
    }

    public function userMember()
    {
        return $this->hasMany(Network::class, 'mother', 'id');
    }

    public function KYCData()
    {
        return $this->hasOne(kyc::class);
    }

    public function userInvestment()
    {
        return $this->hasMany(investment::class);
    }

    public function userReferals()
    {
        return $this->hasOne(User::class, 'referals', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        // Delete associated userData when user is deleted
        static::deleting(function ($user) {
            $user->userData()->delete();
        });

        static::created(function ($user) {
            if ($user->userData()->count() === 0) {
                $user->userData()->create([
                    'referals' => session('reff') ?? null,
                    'profile_image' => null,
                    'username' => null,
                    'address' => null,
                    'country' => null,
                    'phone_number' => null,
                    'bitcoin_address' => null,
                    'bank_number' => null,
                    'type_currency'=>null,
                    'bank_name'=>null,
                    'members'=>null,
                ]);
            }
        });
    }
}
