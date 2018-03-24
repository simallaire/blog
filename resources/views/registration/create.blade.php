@extends('layouts.master')


@section('content')
@include('layouts.header')

<div class="container">
    <div class="row">
    <div class="col-sm-8">
        <h1>S'inscrire</h1>

        <form method="POST" action="/register">
            {{csrf_field()}}
            <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" required name="name">
                
            </div>
            <div class="form-group">
            <label for="name">Email</label>
            <input type="text" class="form-control" id="email" required name="email">
                
            </div>
            <div class="form-group">
            <label for="name">Password</label>
            <input type="password" class="form-control" required id="password" name="password">
                
            </div>            
            <div class="form-group">
            <label for="name">Password Confirmation</label>
            <input type="password" required class="form-control" id="password_confirmation" name="password_confirmation">
                
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Inscrire">

            </div>
            <div class="form-group">
                @include('layouts.error')
            </div>
        
        </form>
    </div>




@endsection