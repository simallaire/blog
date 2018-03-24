<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','emailnotif','description','picture_src'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function role(){
        return $this->belongsToMany(Role::class);
    }
    public function ownsComment($comment){
        return $this->id == $comment->user_id;
    }
    public function ownsPost($post){
        return $this->id == $post->user_id;
    }
    public function isAdmin(){
        foreach($this->role as $role){
            if($role->id == 1)
                return true;
        }
        return false;
    }
    public function isEditor(){
        foreach($this->role as $role){
            if($role->id == 2)
                return true;
        }
        return false;
    }
    public function isRegistered(){
        foreach($this->role as $role){
            if($role->id == 3)
                return true;
        }
        return false;
    }
    public function isGuest(){
        foreach($this->role as $role){
            if($role->id == 4)
                return true;
        }
        return false;
    }
    public function routeNotificationForSlack()
    {
        return "https://hooks.slack.com/services/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";
    }

}
