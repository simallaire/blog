<?php

namespace App\Listeners;

use App\Events\CommentonPost;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\CommentNotification;
class EmailPoster
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CommentonPost  $event
     * @return void
     */
    public function handle(CommentonPost $event)
    {
        //
        $post = $event->post;
        $user = $post->user;
        \Mail::to($user)->send(new CommentNotification($post,$user));
        
        return "Editor Notifié";
    }
}
