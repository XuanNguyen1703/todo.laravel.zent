<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
	// protected $table = 'todos';
	// lấy tất cả todos
    protected $fillable = ['todo'];
    public static function getAll(){
    	return Todo::get();
    }
}
