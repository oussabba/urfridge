<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \stdClass;

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

    public function getAll(Request $request){
        $limit = $request->l;
        return Book::orderBy('id','DESC')
        ->limit($limit)
        ->get();
    }

    public function getBookById($id){
        return Book::findOrFail($id);
    }

    public function getBookCover($id){
        return DB::table('image_book')
        ->where('id_book', $id)
        ->where('is_cover', 1)
        ->pluck('url_image');
    }

    public function getBookLovesById($id){
        return DB::table('love_book')->where('id_book', $id)->count();
    }

    public function getBookImagesById($id){
        return DB::table('image_book')->select('image_book.url_image')
        ->where('id_book', $id)
        ->get();
    }

    public function getBookKeywordsById($id){
        return DB::table('keywords')
            ->join('book_keywords', 'book_keywords.id_keyword', '=', 'keywords.id_keyword')
            ->select('keywords.*')
            ->where('book_keywords.id_book','=',$id)
            ->get();
    }

    public function getBooksByKeywords(Request $request){
        $keywords=$request->k;
        $books=array();
        $book = new stdClass();
        foreach ($keywords as $key => $value) {
            $book=DB::table('books')
            ->join('book_keywords', 'book_keywords.id_book', '=', 'books.id')
            ->select('books.id','books.title')
            ->where('book_keywords.id_keyword','=',$value)
            ->get();
            $books=$book;
            // if ($counter==1) {
            //     array_push($books,$book);
            // }
            // for ($i=0; $i < count($books); $i++) { 
            //     if ($book->id == $books[$i]->id) {
            //         $bookExisted=true;
            //     }
            // }
            // if (!$bookExisted) {
            //     $books=$book;
            // }
        }
        return $books;
    }
}
