<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class BookRepository.
 */
class BookRepository
{
    protected $book;

    public function __construct(Book $book)
    {
        $this->book=$book;
    }

    public function getBookById($id){
        return Book::findOrFail($id);
    }

    public function getBookLovesById($id){
        return DB::table('love_book')->where('id_book', $id)->count();
    }

    public function getBookImagesById($id){
        return DB::table('image_book')->select('image_book.url_image')
        ->where('id_book', $id)
        ->get();
    }
}
