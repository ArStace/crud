
@extends('layouts.core')


@section('title')
Authors List
@endsection

@section('content')


@if(session()->has('message'))

<h2>{{session()->get('message')}}</h2>

@endif


<div class="container">
    <div class="row justify-content-center">

        

        <div class="col-md-8">
            <div class="card">


                <div class="card-header">Enter new author</div>
                
              @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    {{$error}}<br>
                @endforeach
            </div>
        @endif

                <div class="card-body">
                    @yield('actions')
                    <form action="{{route('author.store')}}" method="post">
                        Name:<br>
                        <input type="text" name="name" placeholder="Name" >
                        <br>
                        Surname:<br>
                        <input type="text" name="surname" placeholder="Surname">
                        <br>
                        <br>
                        <input type="submit" value="Submit">
                        @csrf
                      </form> 
                      <br>
                      <p>Please, enter new author.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

