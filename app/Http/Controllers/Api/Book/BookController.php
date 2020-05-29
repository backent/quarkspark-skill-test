<?php

namespace App\Http\Controllers\Api\Book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    //

    public function all() {
    	if (!$this->canGetBook()) {
    		return response()->json(['message' => 'Forbidden!'], 403);
    	}

    	return Book::all();
    }

    public function get(Book $book) {
		if (!$this->canGetBook()) {
    		return response()->json(['message' => 'Forbidden!'], 403);
    	}    	
    	
    	return $book;
    }

    public function store() {
    	if (!$this->canModifyBook()) {
    		return response()->json(['message' => 'Forbidden!'], 403);
    	}

    	$data = request()->validate([
    		'name' => 'required',
    		'author' => 'required',
    	]);	

    	$Book = Book::create($data);

    	return response()->json($Book, 201);

    }

    public function update(Book $book) {
    	if (!$this->canModifyBook()) {
    		return response()->json(['message' => 'Forbidden!'], 403);
    	}
    	
    	$data = request()->validate([
    		'name' => 'required',
    		'author' => 'required'
    	]);

    	$Book = $book->update($data);

    	return response('OK', 200);
    }

    public function delete(Book $book) {
    	if (!$this->canModifyBook()) {
    		return response()->json(['message' => 'Forbidden!'], 403);
    	}
    	

    	$book->delete();

    	return response('OK', 200);

    }

    private function canModifyBook(): bool {
    	if (request()->user()->tokenCan('book-modify')) {
    		return true;
    	} else {
    		return false;
    	}
    }

    private function canGetBook(): bool {
    	if (request()->user()->tokenCan('book-get')) {
    		return true;
    	} else {
    		return false;
    	}
    }
}
