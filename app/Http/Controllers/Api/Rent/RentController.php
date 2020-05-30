<?php

namespace App\Http\Controllers\Api\Rent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rent;
use App\Book;

class RentController extends Controller
{
    //

    public function request() {

    	if (!$this->canRequest()) {
    		return response()->json(['message' => 'Forbidden!'], 403);
    	}

    	$data = request()->validate([
    		'book_id' => 'required',
    		'return_datetime' => 'required|date'
    	]);

    	if (!Book::find($data['book_id'])) {
    		return response()->json(['message' => 'Not Found'], 404);
    	}

    	$UID = request()->user()->id;
    	$book_id = $data['book_id'];
    	$return_datetime = request()->input('return_datetime');

    	$Rent = Rent::create([
    		'user_id' => $UID,
    		'book_id' => $book_id,
    		'return_datetime' => $return_datetime
    	]);

    	return response()->json($Rent, 201);
    }

    public function proceed(Rent $rent) {
    	if (!$this->canProceed()) {
    		return response()->json(['message' => 'Forbidden!'], 403);
    	}

    	$data = request()->validate([
    		'status' => 'required'
    	]);

    	$allowedStatus = $this->getAllowedStatus();
    	if (!in_array($data['status'], $allowedStatus)) {
    		return response()->json(['message' => 'Status Not allowed!'], 400);	
    	}

    	$rent->status = $data['status'];
    	$rent->save();

    	return response()->json($rent, 200);
    }

    private function canRequest() {
    	if (request()->user()->tokenCan('book-request')) {
    		return true;
    	} else  {
    		return false;
    	} 
    }

    private function canProceed() {
    	if (request()->user()->tokenCan('book-transact')) {
    		return true;
    	} else  {
    		return false;
    	} 

    }

    private function getAllowedStatus(): array {
    	return ['approve', 'reject'];
    }
}
