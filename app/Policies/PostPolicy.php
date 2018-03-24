<?php

namespace App\Policies;

use App\Post;
use App\User;

class PostPolicy
{
    public function update(User $user,Post $post){

        foreach($user->role as $role){
            if($role->id == 1) return true;
            if($post->user_id == $user->id && $role->id == 2) return true;
        }
    }
    public function destroy(Post $post,User $user){
        foreach($user->role as $role){
            if($role->id == 1) return true;
            if($post->user_id == $user->id && $role->id == 2) return true;
        }
    return false;
    }
    public function restore(User $user){

        foreach($user->role as $role){
            if($role->id == 1) return true;
        }
        return false;

    }
    

}

