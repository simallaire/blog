<?php

namespace App\Http\Controllers;
use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    
    public function store(Post $post){
        $this->validate(request(),[
            'body'=>'required|min:5|max:1000'
        ]);
      
        $post->addComment(request('body'),auth()->user());
        return back();
    }
    public function delete(Comment $comment){
    	$comment->forceDelete();
    	return redirect()->back();

    }
    public function read(Comment $comment){
        if($comment->read){
            $comment->read = false;
        }else{
              $comment->read = true;
        }
      
        $comment->save();
        return back();

    }
}
