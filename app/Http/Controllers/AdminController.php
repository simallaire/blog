<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Denies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminController extends Controller
{
    public function __construct(){

        $this->middleWare('can:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
        //
    }
    public function posts(){
        $posts = Post::get();
        $deleted = false;

        return view('admin.posts',compact(['posts','deleted']));
    }
    public function deleted_posts(){
        $posts = Post::onlyTrashed()->get();
        $deleted = true;
        return view('admin.posts',compact(['posts','deleted']));
    }
    public function restore($post){
        Post::withTrashed()->find($post)->restore();
//        $post->restore();
        return back();
    }
    public function destroy(Post $post){
        $this->authorize('update',$post);
            $post->delete();
            return redirect()->home();

    }


}
