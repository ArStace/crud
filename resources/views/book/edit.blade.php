@extends('layouts.core') 
@section('title') Book edit
@endsection
 
@section('content') @if(session()->has('message'))

<h2>{{session()->get('message')}}</h2>

@endif


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit book</div>

                <div class="card-body">
                    <form id="bookCreate" action="{{route('book.update', $book)}}" method="post">
                         Title:
                         <br>
                            <input type="text" value="{{ $book->title }}" name="title">    
                            <br>
                            Pages amount:
                            <br>
                            <input type="text" value="{{ $book->pages }}" name="pages" >    
                            <br>
                            ISBN:
                            <br>
                            <input type="text" value="{{ $book->isbn }}" name="isbn" >    
                            <br>
                            Description(short):
                            <br>
                            <textarea name="short_description" form="bookCreate" style="resize: none; width:300px; height:100px"> {{ $book->short_description }}
                            </textarea>
                            <br>
                            Author:
                            <br>
                            <select name="author_id">
                                @foreach ($authors as $author)
                                <option value="{{$author->id}}" @if ($author->id == $book->author_id) selected @endif> {{$author->name}} {{$author->surname}}</option>
                                @endforeach
                            </select>
                        <br>
                        <br>
                        <input type="submit" value="Submit">
                        @csrf
                    </form>
                    <br>
                    <p>Please, edit book.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection