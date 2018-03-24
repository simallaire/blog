<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Mail\CommentNotification;
use App\Events\CommentonPost;

class Post extends Model
{
    use SoftDeletes;
        protected $fillable = [
        'body','title','picture_src','user_id'
    ];
    protected $dates = ['deleted_at'];

    //
    public function comments(){
    	return $this->hasMany(Comment::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function addComment($body,$user){
        $comment = new Comment;
        $comment->body = $body;
        $comment->created_at =  date('Y-m-d H:i:s');
        $comment->post_id = $this->id;
        $comment->user_id = $user->id;
        $comment->save();
        $editor = $this->user;
        if($editor->emailnotif == 1){
            event(new CommentonPost($this));
        }
        //return redirect("/posts/$comment->post_id");
        
    }
    public function scopeFilter($query, $filters){

        if(isset($filters['month'])){
            $query->whereMonth('created_at',Carbon::parse($filters['month'])->month);
        }
        if(isset($filters['year'])){
            $query->whereYear('created_at',$filters['year']);
        }
        
    }
    public static function archives(){
        return static::selectRaw('year(created_at) year, monthname(created_at) month, count(id) published')
        ->groupBy('month', 'year')
        ->orderByRaw('min(created_at) desc')
        ->get();

    }
    public function owns($comment){
        return $comment->post_id == $this->id;
    }
}
