@extends('layouts.master')


@section('content')
@include('layouts.header')

<div class="container">
    <div class="row">
    <div class="col-sm-8">
        <h1>Login</h1>

        <form method="POST" action="/login">
            {{csrf_field()}}

            <div class="form-group">
                <label for="name">Email</label>
                <input type="text" class="form-control" id="email" required name="email">
                    
            </div>
            
            <div class="form-group">
                <label for="name">Password</label>
                <input type="password" class="form-control" required id="password" name="password">
                    
            </div>            
 
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Connexion">

            </div>
            <div class="form-group">
                @include('layouts.error')
            </div>
        
        </form>
    </div>




@endsection