<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BookRepository;
use \stdClass;

class BookController extends Controller
{
    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository=$bookRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = $this->bookRepository->getAll($request);
        //Add new item (image cover of the book) to object json (book)
        $books = json_decode($books, TRUE);
        for ($i=0; $i < count($books) ; $i++) {
            $books[$i]["cover_url"] = $this->bookRepository->getBookCover($books[$i]["id"]);
            $books[$i]["loves"] = $this->bookRepository->getBookLovesById($books[$i]["id"]);
        }
        // $books = json_encode($books);
        return $books;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getBook($id){
        return $this->bookRepository->getBookById($id);
    }

    //get number of loves
    public function getBookLoves($id){
        return $this->bookRepository->getBookLovesById($id);
    }

    public function sortBooksByloves(Request $request){
        $books = json_encode($this->index($request));
        $books = json_decode($books, TRUE);
        usort($books, function ($a, $b) {
            if($a['loves']==$b['loves']) return 0;
            return $a['loves'] < $b['loves']?1:-1;
        });
        return $books;
    }

    public function getBookImages($id){
        return $this->bookRepository->getBookImagesById($id);
    }

    public function getBookKeywords($id){
        return $this->bookRepository->getBookKeywordsById($id);
    }

    public function getBooksByKeywords(Request $request){
        return $this->bookRepository->getBooksByKeywords($request);
    }

    public function addBookProposal(Request $request){
        return $this->bookRepository->storeProposal($request);
    }
}
