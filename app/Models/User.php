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
        //استثناء المستخدمين الذي يتابعهم المستخدم الحالي
       $following=auth()->user()->following()->wherePivot('confirmed',true)->get();
       // استرجاع 5 مستخدمين مع استثناء الذي يتابعهم + صاحب الحساب
       return User::all()->diff($following)->except(auth()->id())->shuffle()->take(5);
    }
    //توابع خاصه ب الاعجاب
    public function likes(){
        return $this->belongsToMany(Post::class,'likes');
    }
    //توابع خاصه ب المتابعه

    //يعيد المتابعين الذي يتابعهم صاحب الحساب الحالي
    public function following(){
        return $this->belongsToMany(User::class,'follows','user_id','following_user_id')->withTimestamps()->withPivot('confirmed');
    }

    //يعيد مجموعة المتابعين الذين يتابعو صاحب الحساب الحالي
    public function followers(){
        return $this->belongsToMany(User::class,'follows','following_user_id','user_id')->withTimestamps()->withPivot('confirmed');
    }
    //متابعة مستخدم
public function follow(User $user){
    if($user->private_account){
        return $this->following()->attach($user);

    }
    else{
        return $this->following()->attach($user,['confirmed'=>true]);
    }

}
    // ازالة المتابعة
    public function unfollow(User $user)
    {
        return $this->following()->detach($user);
    }

    //طلب المتابعه المعلق
    public function is_pending(User $user){
        return $this->following()->where('following_user_id',$user->id)->where('confirmed',false)->exists();
    }
    //المتابعين
    public function is_follower(User $user){
        return $this->followers()->where('user_id',$user->id)->where('confirmed',true)->exists();
    }
    public function is_following(User $user){
        return $this->following()->where('following_user_id',$user->id)->where('confirmed',true)->exists();

    }
}