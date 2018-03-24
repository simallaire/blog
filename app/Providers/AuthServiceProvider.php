<?php

namespace App\Providers;
use App\Post;
use App\Model;
use App\Policies\PostPolicy;
use App\Policies\ModelPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Model::class => ModelPolicy::class,
        Post::class => PostPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('ownPost',function($user,$post){
            return $user->id == $post->user_id;

        });
        Gate::define('admin',function($user){
            $roles = $user->role;
            foreach($roles as $role)
            {
                if($role->id==1)
                    return true;
            }
            return false;
           
        }); 
        Gate::define('editor',function($user){
            $roles = $user->role;
            foreach($roles as $role)
            {
                if($role->id==2)
                    return true;
            }
            return false;
           
        });
        Gate::define('registered',function($user){
            $roles = $user->role;
            foreach($roles as $role)
            {
                if($role->id==3)
                    return true;
            }
            return false;
           
        });

        Gate::define('guest',function($user){ 
            if(count($user->role)==0){
                //  Gate guest inclut les utilisateurs n'ayant aucun rôle.
                return true;
            }
            $roles = $user->role;
            foreach($roles as $role)
            {
                if($role->id==4)
                    return true;
            }
            return false;
           
        });



        //
    }
}
