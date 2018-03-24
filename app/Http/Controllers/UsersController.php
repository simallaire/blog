<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Comment;
class UsersController extends Controller
{

    public function show(User $USER){
        $posts = Post::where('user_id',$USER->id)->get();

        $own = \Auth::user()->id == $USER->id;

        $result = Comment::join('posts', 'comments.post_id', '=', 'posts.id')
        ->where('posts.user_id',$USER->id)
        ->selectRaw('comments.*')
        ->orderByRaw('posts.title, comments.created_at DESC')
        ->get();
        return view('users.profile',compact(['USER','posts','own','result']));
    }
    public function index(){
        $USER = User::all();
        return $USER;
        //return view('welcome',[
        //'nom1'=>'David'
        //]);
    }
    public function last(){
        $USER = User::get()->last();
        return $USER;
    }

     public function create(){
        return view("users.create");
    }
    public function profile(){

    }
    public function patch(Request $request)
    {
//        dd($request->file('image'));
        if ($request->file('image') != null) {

            $imageName = sha1(time()) . '.' .
                $request->file('image')->getClientOriginalExtension();

            $request->file('image')->move(
                base_path() . '/public/img', $imageName
            );
        }
            $this->validate(request(),[
                'picture_src'=>'max:200',
                'description'=>'max:250'
            ]);
            $USER = User::find(request('userid'));
            $USER->description = request('description');

            if ($request->file('image') != null) $USER->picture_src = $imageName;
            $USER->emailnotif = request('emailnotif');
            $USER->save();

            return back();

    }
}
