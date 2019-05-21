@extends('layouts.core')


@section('title')
Authors List
@endsection

@section('content')




<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Authors List</div>
                    <div class="card-body">
                        <div class="container">

                            @if(session()->has('message'))
                            <h2>{{session()->get('message')}}</h2>
                            @endif

                            <button onclick="location.href = '{{route('author.create')}}'">New author</button>

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th><a href="{{route('author.show_order', 'name')}}">Name</a></th>
                                        <th><a href="{{route('author.show_order', 'surname')}}">Surname</a></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($authors as $author)
                                            <tr>
                                                <td>{{ $author->name }}</td>   
                                                <td>{{ $author->surname }}</td>   
                                                <td><a href="{{route('author.edit', $author)}}">Edit</a></td> 
                                                 <td><a href="{{route('author.books', $author)}}">Books</a></td>   
                                                
                                                <td>
                                                    <form action="{{route('author.destroy', $author)}}" method="POST">
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
    </div>
</div>




@endsection
                        
                                    