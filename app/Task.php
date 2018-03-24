<?php

namespace App;
use App\Task;


class Task extends Model
{
    public function scopeIncomplete($query){
    	return  $query->where('completed',0);
    }
}
