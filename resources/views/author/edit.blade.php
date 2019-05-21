
@extends('layouts.core')


@section('title')
Authors edit
@endsection

@section('content')


@if(session()->has('message'))

<h2>{{session()->get('message')}}</h2>

@endif


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit author</div>

                <div class="card-body">
                    @yield('actions')
                    <form action="{{route('author.update', $author)}}" method="post">
                            Name:<br>
                            <input type="text" name="name" value="{{ $author->name }}">
                            <br>
                            Surname:<br>
                            <input type="text" name="surname" value="{{ $author->surname }}">
                            <br>
                            <br>
                            <input type="submit" value="Submit">
                            @csrf
                    </form> 
                      <br>
                      <p>Please, edit author.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

