<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    public function index() {
    	$todos = Todo::getAll();
    	// dd($todos);
    	return view("todos.index",['todos'=> $todos,'name'=>'xuan']);
    }
    public function show($id){
    	$todo = Todo::find($id);
    	return view('todos.show',['todo'=>$todo]);
    }
    public function destroy($id){
    	$todo = Todo::find($id)->delete();
    	return redirect('todos');
    }
    public function create(){
    	return view('todos.create');
    }
    public function store(Request $request){
    	Todo::create(['todo'=>$request->todo]);
    	return redirect('todos');
    }
}

