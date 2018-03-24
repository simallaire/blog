<?php

use App\User;
use App\Post;
use App\Task;

// Route::resource('posts','PostsController');
//Route::get('/', 'HomeController@home');
Route::get('user', 'UsersController@index');
Route::get('user/create', 'UsersController@create');
Route::get('lastUser', 'UsersController@last');
Route::get('user/{USER}', 'UsersController@show');
Route::post('user/{request}/profile', 'UsersController@patch');


Route::get('/tasks/create','TasksController@create');
Route::get('/tasks/{task}', 'TasksController@show');

Route::post('/tasks','TasksController@store');
Route::get('/incomplete/tasks','TasksController@incomplete');

Route::get('/','PostsController@index')->name('home');
Route::get('/home','PostsController@index'); // blocked page default redirect

Route::get('posts/{post}/edit','PostsController@edit');
Route::get('/posts','PostsController@index');
Route::get('post/create','PostsController@create');
Route::post('/posts', 'PostsController@store');
Route::post('posts/{post}/comments','CommentsController@store');
Route::delete('posts/{post}','AdminController@destroy');
Route::delete('post/{post}','PostsController@destroy');
Route::patch('posts/{post}/restore','AdminController@restore');
Route::patch('posts/{post}','PostsController@patch');
Route::get('posts/{post}','PostsController@show');

Route::get('post/mesposts','PostsController@mesposts');

Route::post('comments/{comment}/delete','CommentsController@delete');
Route::patch('comments/{comment}','CommentsController@read');

Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');
Route::get('/login','SessionsController@create')->name('login');
Route::post('/login','SessionsController@store');
Route::get('/logout','SessionsController@destroy');

Route::get('/admin', 'AdminController@index');
Route::get('/admin/posts', 'AdminController@posts');
Route::get('/admin/deletedposts', 'AdminController@deleted_posts')->name('deletedposts');
Route::get('/about', 'HomeController@about');

Route::get('/php', function(){
   return view('posts.test');
});