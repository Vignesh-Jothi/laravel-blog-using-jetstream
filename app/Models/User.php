<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;


use Filament\Models\Contracts\FilamentUser;
use Filament\Tables\Columns\Layout\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasFactory;

    /**
     * Used to create the roles
     */

     const ROLE_ADMIN = "ADMIN";
     const ROLE_EDITOR = "EDIT";
     const ROLE_USER = "USER";

     const Role = [
        self::ROLE_ADMIN => 'Admin',
        self::ROLE_EDITOR => 'Edit',
        self::ROLE_USER => 'User'
     ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return $this->isAdmin() || $this->isEditor();
    }

    public function isAdmin(){
        return $this->role === self::ROLE_ADMIN;
    }

    public function isEditor(){
        return $this->role === self::ROLE_EDITOR;
    }

    public function likes(){
        return $this->belongsToMany(Post::class,'post_like')->withTimestamps();
    }

    public function comments(){
        return $this->hasMany(comments::class);
    }
    
    public function hasLiked(Post $post){
        return $this->likes()->where('post_id',$post->id)->exists();
    }
}
