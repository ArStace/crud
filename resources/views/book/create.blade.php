@extends('layouts.core')

@section('title')
Books List
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Enter new book</div>

                <div class="card-body">

                    @if(session()->has('message'))

                    <h2>{{session()->get('message')}}</h2>

                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                {{$error}}<br>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{route('book.store')}}" method="post">
                            Title:
                            <br>
                            <input type="text" name="title" >    
                            <br>
                            Pages amount:
                            <br>
                            <input type="text" name="pages" >    
                            <br>
                            ISBN:
                            <br>
                            <input type="text" name="isbn" >    
                            <br>
                            Description(short):
                            <br>
                            <input type="text" name="short_description" >    
                            <br>
                            Author:
                            <br>
                            <select name="author_id">
                                @foreach ($authors as $author)
                                <option value="{{$author->id}}">{{$author->name}} 
                                    <br>
                                    {{$author->surname}}
                                </option>
                                @endforeach
                            </select>
                        <br>
                        <br>
                        <input type="submit" value="Submit">
                        @csrf
                      </form> 
                      <br>
                      <p>Please, enter new book.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

