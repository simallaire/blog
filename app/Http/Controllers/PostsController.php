<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Post;
use App\Repositories\Posts;
use Carbon\Carbon;
use Illuminate\Auth\Access\Denies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class PostsController extends Controller
{


	public function __construct(){

		$this->middleware('can:editor')->except(['index','show','edit','patch']);
	}
    //
    public function index(Post $posts){

        $posts = $posts->latest()
                ->filter(request(['month','year']))
                ->get();



        return view('posts.index',compact('posts'));
    }
    public function mesposts(){
        if(Gate::allows('editor')){

            $user = auth()->user();
            $posts = Post::where('user_id','=',$user->id)->get();
            return view('posts.mesposts',compact('posts'));
    }
    }
    public function create(){
        if(Gate::allows('editor')){
        $post = new Post;
    	return view('posts.create',compact('post'));
        }
    }
    public function store(){

        if(Gate::allows('editor'))
        {

            $this->validate(request(),[
                'title'=>'required|min:2|max:100',
                'body'=>'required|min:10|max:1000'
            ]);

        

            Post::Create([
                'title' => request('title'),
                'body' => request('body'),
                'picture_src' => 'null',
                'user_id' => auth()->user()->id
                ]);
        }

        return redirect('/posts');
    }
    public function patch(Post $post){
        if(Gate::allows('update',$post)){
            $this->validate(request(),[
                'title'=>'required|min:2|max:100',
                'body'=>'required|min:10|max:1000'
            ]);
            $post->title = request('title');
            $post->body = request('body');

            $post->save();

            $comments = $post->comments;
            return view('posts.show',compact(['post','comments']));
            }
    }
    public function edit(Post $post){

       $this->authorize('update',$post);
        return view('posts.create',compact('post'));

    }
    public function destroy(Post $post){
        $this->authorize('update',$post);
        $post->delete();
        return redirect()->home();

    }
    public function show(Post $post)
    {
       // auth()->loginUsingId(3); //tmp
       // if(Gate::denies('update-post',$post))
       //     abort(403,'CustomError');

		$comments = $post->comments;
		return view('posts.show',compact(['post','comments']));
	}
}
