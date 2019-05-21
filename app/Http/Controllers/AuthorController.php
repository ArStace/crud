<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use Illuminate\Http\Request;
use Validator;

class AuthorController extends Controller
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
        $all_authors = Author::all();
        return view('author.index' , ['authors' => $all_authors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
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
            'name' => ['required' , 'alpha ','max:30'],
            'surname' => ['required' ,'alpha ' ,'max:30'],
        ],
        [
            'name.required' => 'Name not entered',
            'name.max' => 'Too long',
            'name.alpha' => 'Only letters allowed',
            'surname.required' => 'Surname not entered',
            'surname.max' => 'Surname Too long',
            'surname.alpha' => 'Only letters allowed'
        ]
            );
            if ($validator->fails()) {
                $request->flash();
                return redirect()->route('author.create')->withErrors($validator);
            }

        $author = new author;
        $author->name = $request->name;
        $author->surname = $request->surname;
        $author->save();
        return redirect()->route('author.index')->with('message', 'Author was created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show($order = 'default')
    {
        if($order == 'name') {
            $all_authors = Author::all()->sortBy('name');
        }
        
       else if($order == 'surname') {
            $all_authors = Author::all()->sortBy('surname');
        }
        else {
            $all_authors = Author::all();
        }
      
        return view('author.index', ['authors' => $all_authors]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
         return view('author.edit' , ['author' => $author]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $validator = Validator::make($request->all(), 
            [
                'name' => ['required','max:30'],
                'surname' => ['required','max:30'],
            ],
            [
                'name.required' => 'Name not entered',
                'name.max' => 'Too long',
                'surname.required' => 'Surname not entered',
                'surname.max' => 'Surname Too long'
            ]
        );
            if ($validator->fails()) {
                $request->flash();
                return redirect()->route('author.adit' , [$author])->withErrors($validator);
            }

            $author->name = $request->name;
            $author->surname = $request->surname;
            $author->save();
            return redirect()->route('author.index')->with('message', 'Author was edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        if($author->authorBooks->count() == 0){ //is modelio authorsGrades
            $author->delete();
            return redirect()->route('author.index')->with('message', 'Author was deleted successfully!');
        }
        else {
            return redirect()->route('author.index')->with('message', 'Author can not be deleted.');
        }
    }

    public function books(Author $author)
    {
        $all_books = Book::all();
        return view('author.books' , ['author' => $author , 'books' => $all_books]);
    }

}
