<?php

namespace App\Http\Controllers;

use App\Book;
use App\Author;
use Validator;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function __construct()
        {
            $this->middleware('auth');
        }

    public function index()
    {
        $all_books = Book::all()->sortBy('title');
        $all_authors = Author::all();
        return view('book.index' , ['books' => $all_books , 'authors' => $all_authors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_author = Author::all()->sortBy('name');
        return view('book.create', ['authors' => $all_author]);
    }

    public function addBookForAuthor(Author $author)
    {
        $all_lectures = Lecture::all();
        return view('book.create', ['lectures'=> $all_lectures, 'author' => $author]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), 
            [
                'title' => ['required','max:30'],
                'pages' => ['required','digits_between:1,10000'],
                'isbn' => ['required','max:64'],
                'short_description' => ['required','max:30'],
            ],
            [
                'title.required' => 'Title is empty!',
                'title.max' => 'Title is to long!',

                'pages.required' => 'Pages amount is empty!',
                'pages.digits_between' => 'Pages  amount must be from 1 to 10 000!!',

                'isbn.required' => 'Isbn is empty!',
                'isbn.max' => 'ISBN is to long!',

                'short_description.required' => 'Description is empty!',
                'short_description.max' => 'Description must be short!!'
            ]
        );
            if ($validator->fails()) {
                $request->flash();
                return redirect()->route('book.create')->withErrors($validator);
            }

            $book = new Book;
            $book->title = $request->title;
            $book->pages = $request->pages;
            $book->isbn = $request->isbn;
            $book->short_description = $request->short_description;
            $book->author_id = $request->author_id;
            $book->save();
            return redirect() -> route('book.index') -> with('massage' , 'Book was created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($order = 'default')
    {
        if($order == 'title') {
            $all_books = Author::all()->sortBy('title');
        }
        
       else if($order == 'pages') {
            $all_books = Author::all()->sortBy('pages');
        }

       else if($order == 'isbn') {
            $all_books = Author::all()->sortBy('isbn');
        }
        else {
            $all_books = Author::all();
        }
      
        return view('book.index', ['books' => $all_books]);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $all_books = Author::all();
        return view('book.edit' , ['book' => $book , 'authors' => $all_books]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
       $validator = Validator::make($request->all(), 
            [
                'title' => ['required','max:30'],
                'pages' => ['required','digits_between:1,10000'],
                'isbn' => ['required','max:64'],
                'short_description' => ['required','max:30'],
            ],
            [
                'title.required' => 'Title is empty!',
                'title.max' => 'Title is to long!',

                'pages.required' => 'Pages amount is empty!',
                'pages.digits_between' => 'Pages amount must be from 1 to 10 000!!',

                'isbn.required' => 'Isbn is empty!',
                'isbn.max' => 'ISBN is to long!',

                'short_description.required' => 'Description is empty!',
                'short_description.max' => 'Description must be short!!'
            ]
        );

            $book->title = $request->title;
            $book->pages = $request->pages;
            $book->isbn = $request->isbn;
            $book->short_description = $request->short_description;
            $book->author_id = $request->author_id;
            $book->save();
            return redirect() -> route('book.index') -> with('massage' , 'Book was edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('book.index')->with('message', 'Book was deleted successfully!');
    }

}
