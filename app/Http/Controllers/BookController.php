<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = [];
        if($request->start_date && $request->end_date){
            $books = Book::whereBetween('date_published', [$request->start_date, $request->end_date])
                ->orderBy('created_at', 'DESC')
                ->get();
        }elseif($request->search){
            $search = strtolower($request->search);
            $books = Book::where('name', 'like', "%$search%")
                ->orwhere('description', 'like', "%$search%")
                ->orwhere('author', 'like', "%$search%")
                ->orderBy('created_at', 'DESC')
                ->get();
        }else{
            $books = Book::orderBy('created_at', 'DESC')->get();
        }

        return response()->json($books);
    }


    public function show(Book $book)
    {
        return response()->json($book);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'author' => 'required',
            'date_published' => 'required|date',
        ]);

        return Book::create([
            'name' => $request->name,
            'description' => $request->description,
            'author' => $request->author,
            'date_published' => $request->date_published,
            'image' => $request->image
        ]);
    }

    public function destroy(Book $book)
    {
        return $book->delete();
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'author' => 'required',
            'date_published' => 'required|date',
        ]);

        return Book::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'author' => $request->author,
            'date_published' => $request->date_published,
        ]);
    }

}
