@extends('layouts.core') 
@section('title') Author books
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{$author->name}} books</div>
                    <div class="card-body">
                        @if(session()->has('message'))
                        <h2>{{session()->get('message')}}</h2>
                        @endif
                        <div class="container">
                         
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Auhor</th>
                                    <th>Book</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($books as $book)
                                @if ($author->id == $book->author_id)
                                    <tr>
                                        <td>{{ $book->booksAuthor->name }} {{ $book->booksAuthor->surname }}</td>
                                        <td>{{ $book->title }}</td>
                                    </tr>
                                @endif 
                                @endforeach
                                </tbody>
                        </table>
                        <form action="{{route('author.index')}}" method="GET">
                            <input type="submit" value="back" style="margin-left:15px;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>








@csrf
@endsection