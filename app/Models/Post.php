<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=['description','slug','image','user_id'];

    public function owner()
    {
        return $this->belongsTo(User::class, foreignKey:'user_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function likes(){
        return $this->belongsToMany(User::class,'likes');
    }

    //تستفيد من هاذا لتغير حالة الاعجاب بلمنشور
    //ترجع true في حال انهو المستخدم معجب بلمنشور
    
    public function liked(User $user){
        return $this->likes()->where('user_id',$user->id)->exists();
    }
}