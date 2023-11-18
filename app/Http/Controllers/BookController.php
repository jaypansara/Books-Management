<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::orderBy('id','desc')->paginate(5);
        return view('books.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $book = Book::first();
         return view('books.create',compact('book'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            if ($file = $request->file('file')) {

                $fileName = $this->uploadFile($file);

                $gallery = $this->storeImage($fileName);
            }


                Book::create([
                     'gallery_id'=>$gallery->id,
                     'name'=>$request->name,
                     'author_name'=>$request->author_name,
                     'book_details'=>$request->book_details
             ]);

            DB::commit();

            $request->session()->flash('alert-success', 'Books Details Created Successfully');

            return to_route('books.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            return back()->withErrors($ex->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::find($id);
        return view('books.edit',compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        if ($file = $request->file('file')) {
            $imageName = null;
            if ($book->gallery) {

                $imageName = $book->gallery->image;
                $imagePath = public_path('storage/books/');

                if (file_exists($imagePath . $imageName)) {
                    unlink($imagePath . $imageName);
                }
            }



            $fileName = $this->uploadFile($file);

            $book->gallery->update([
                'image' => $fileName
            ]);
        }

        $book->update([
            'name'=>$request->name,
            'author_name'=>$request->author_name,
            'book_details'=>$request->book_details
        ]);


        $request->session()->flash('alert-info', 'Books Details Updated Successfully');
        return to_route('books.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);
        if (!$book) {
            abort(404, 'Books Details Not Found');
        }

        $book->delete();

        request()->session()->flash('alert-warning', 'Books Details Deleted Successfully');
        return to_route('books.index');
    }
    private function uploadFile($file)
    {
        $fileName = rand(100, 1000) . time() . $file->getClientOriginalName();

        $filePath = public_path('/storage/books/');

        $file->move($filePath, $fileName);

        return $fileName;
    }
    private function storeImage($fileName)
    {
        $gallery = Gallery::create([
            'image' => $fileName,
            'type' => Gallery::type
        ]);
        return $gallery;
    }

}
