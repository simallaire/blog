<?php

namespace App\Mail;
use App\Post;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $post;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Post $post,User $user)
    {
        $this->post = $post;
        $this->user = $user;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.CommentNotification');
    }
}
