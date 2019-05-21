@extends('layouts.core') 
@section('title') Books List
@endsection
 
@section('content')






<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Books List</div>
                <div class="card-body">

                    @if(session()->has('message'))
                    <h2>{{session()->get('message')}}</h2>
                    @endif

                    <button onclick="location.href = '{{route('book.create')}}'">New book</button>

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Pages</th>
                                        <th>ISBN</th>
                                        <th>Description</th>
                                        <th>Author</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($books as $book)
                                            <tr>
                                                <td>{{ $book->title }}</td>   
                                                <td>{{ $book->pages }}</td>   
                                                <td>{{ $book->isbn }}</td>   
                                                <td>{{ $book->short_description }}</td>   
                                                <td>{{ $book->booksAuthor->name }} {{ $book->booksAuthor->surname }}</td>   
                                                <td><a href="{{route('book.edit', $book)}}">Edit</a></td>   
                                                <td>
                                                    <form action="{{route('book.destroy', $book)}}" method="POST">
                                                    <input type="submit" value="Delete" style="margin-left:15px;">
                                                    @csrf
                                                    </form>
                                                </td>  
                                            </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection


                            