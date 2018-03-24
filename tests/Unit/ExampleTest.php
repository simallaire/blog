<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        \App\Comment::Create([
            'body'=> 'body',
            'post_id'=> '2'
        ]);
        $comments =  \App\Comment::get();

        foreach($comments as $comment){
            
            $this->assertNotEmpty($comment->post);
        }
    }
}
