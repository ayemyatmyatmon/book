<?php

namespace App\Http\Controllers;

use App\Book;
use App\Writer;
use App\BookType;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $book_types = BookType::all();
        $writers = Writer::all();

        return view('book.index', compact('book_types', 'writers'));
    }

    public function ssd(Request $request)
    {
        if ($request->ajax()) {
            $books = Book::query();

            if($request->book_type_id){
                $books = $books->where('book_type_id', $request->book_type_id);
            }

            if($request->writer_id){
                $books = $books->where('writer_id', $request->writer_id);
            }

            return DataTables::of($books)
                ->editColumn('created_at', function ($book) {
                    return Carbon::parse($book->created_at)->format('Y-m-d H:i:s');
                })
                ->editColumn('updated_at', function ($book) {
                    return Carbon::parse($book->updated_at)->format('Y-m-d H:i:s');
                })
                ->addColumn('book_type_name', function ($book) {
                    return optional($book->book_type)->name;
                })
                ->addColumn('writer_name', function ($book) {
                    return optional($book->writer)->name;
                })
                ->editColumn('pdf', function ($book) {
                    return '<a class="btn btn-sm btn-dark" href="/storage/pdf/' . $book->pdf . '">View Book</a>';
                })
                ->addColumn('action', function ($book) {
                    $edit_icon = "<a title='Edit' href='/book/" . $book->id . "/edit' class='btn btn-sm btn-warning mr-1 mb-1'><i class='far fa-edit'></i> Edit</a>";
                    $delete_icon = "<a title='Delete' href='#' class='btn btn-sm btn-danger delete' data-id='" . $book->id . "'><i class='far fa-trash-alt'></i> Delete</a>";

                    return "<div class='action'>
                        " . $edit_icon . "
                        " . $delete_icon . "
                    </div>";
                })
                ->addColumn('plus-icon', function () {
                    return false;
                })
                ->rawColumns(['plus-icon', 'title', 'description', 'pdf', 'action'])
                ->make(true);
        }
    }

    public function create()
    {
        $book_types = BookType::all();
        $writers = Writer::all();

        return view('book.create', compact('book_types', 'writers'));
    }

    public function store(Request $request)
    {
        $pdf_name = null;
        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');
            $pdf_name = uniqid() . '_' . date('Y-m-d-H-i-s') . '.' . $pdf->getClientOriginalExtension();
            Storage::disk('public')->put(
                'pdf/' . $pdf_name,
                file_get_contents($pdf->getRealPath())
            );
        }

        Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'writer_id' => $request->writer_id,
            'book_type_id' => $request->book_type_id,
            'pdf' => $pdf_name,
        ]);

        return redirect('/book')->with('success', 'Successfully Uploaded.');
    }

    public function edit(Book $book)
    {
        $book_types = BookType::all();
        $writers = Writer::all();

        return view('book.edit', compact('book', 'book_types', 'writers'));
    }

    public function update(Request $request, Book $book)
    {
        $pdf_name = $book->pdf;
        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');
            $pdf_name = uniqid() . '_' . date('Y-m-d-H-i-s') . '.' . $pdf->getClientOriginalExtension();
            Storage::disk('public')->put(
                'pdf/' . $pdf_name,
                file_get_contents($pdf->getRealPath())
            );
        }

        $book->update([
            'title' => $request->title,
            'description' => $request->description,
            'writer_id' => $request->writer_id,
            'book_type_id' => $request->book_type_id,
            'pdf' => $pdf_name,
        ]);

        return redirect('/book')->with('update', 'Successfully Updated.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return 'success';
    }
}
