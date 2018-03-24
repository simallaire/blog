<?php

namespace App\Listeners;
use Illuminate\Support\Facades\Notification;
use App\Events\CommentonPost;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyPoster
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
     * @param  =CommentonPost  $event
     * @return void
     */
    public function handle(CommentonPost $event)
    {
        $post = $event->post;
        $user = $post->user;
        Notification::send($user, new \App\Notifications\CommentOnPost($post));
    }
}
