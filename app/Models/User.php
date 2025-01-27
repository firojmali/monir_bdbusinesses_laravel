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
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', 'email', 'remember_token', 'created_at', 'updated_at', 'email_verified_at', 'uid', 'username'
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
    public function roles()
    {
        return $this->hasManyThrough(
            Role::class,
            UserRole::class,
            'user_uid', // Foreign key [WR Main] on the UserRole table...
            'uid', // Local key on the Role table...
            'uid', // Local key on the Main table...
            'role_uid' // Foreign key [wr Role] on the UserRole table...
        );
    }
    public function hasAccess(){
        return $this->hasMany(userArea::class, 'user_uid', 'uid');
    }
    public function area(){
        return $this->hasOne(UserArea::class, 'user_uid', 'uid');
    }
    public function divisions(){
        return $this->hasManyThrough(
        Division::class,
        UserArea::class,
        'user_uid', // F_2 [M]
        'code', // L_1
        'uid', // L_M
        'division_code' // F_2 [1]
        );
    }
    public function districts(){
        return $this->hasManyThrough(
        District::class,
        UserArea::class,
        'user_uid', // Foreign key on the roless table...
        'division_code', // Foreign key on the userroles table...
        'uid', // Local key on the users table...
        'division_code' // Local key on the roless table...
        );
    }
    public function upazilas(){
        return $this->hasManyThrough(
        Upazila::class,
        UserArea::class,
        'user_uid', // Foreign key on the roless table...
        'district_code', // Foreign key on the userroles table...
        'uid', // Local key on the users table...
        'district_code' // Local key on the roless table...
        );
    }
    public function unions(){
        return $this->hasManyThrough(
        Union::class,
        UserArea::class,
        'user_uid', // Foreign key on the roless table...
        'upazila_code_id', // Foreign key on the userroles table...
        'uid', // Local key on the users table...
        'upazila_code' // Local key on the roless table...
        );
    }
}
