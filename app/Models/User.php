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
        'bio',
        'private_account',
        'username',
        'email',
        'image',
        'password',
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

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function suggested_users()
    {
        return User::whereNot('id', auth()->id())->get()->shuffle()->take(5);
        //whereNot يجلب جميع النتائج التي لا تحقق الشرط المحدد
        //'id', auth()->id() الشرط من اجل ان لا يجلب المستخدم نفسه
        //get() جلب المطلوب
        //->shuffle()->take(5)  جاب 5 مستخدمين بشكل عشوائي
    }
    public function likes(){
        return $this->belongsToMany(Post::class,'likes');
    }
}