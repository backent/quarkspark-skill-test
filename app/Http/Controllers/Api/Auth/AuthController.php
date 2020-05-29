<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthController extends Controller
{
    /*
		Required: 
			- email
			- name
			- password
    */

    public function register() {
    	$data = request()->validate([
    		'email' => 'required|email',
    		'name' => 'required',
    		'password' => 'required|min:7',
    	]);

    	$User = User::where('email', $data['email'])->first();
    	if (isset($User)) {
    		return response()->json(['message' => "Email Already Exist!"], 409);
    	}

    	$User = new User();
    	$User->email = $data['email'];
    	$User->name = $data['name'];
    	$User->status = 'active';
    	$User->password = Hash::make($data['password']);
    	$User->role = 'user';
    	$User->save();

    	return $User->createToken('user', ['book-get', 'book-request'])->accessToken;
    }

    /*
		Required:
		 - email
		 - password
		 - role
    */

    public function login() {
    	$data = request()->validate([
    		'email' => 'required|email',
    		'password' => 'required',
    		'role' => 'required'
    	]);

    	$User = User::where([
    		['email', $data['email']],
    		['role', $data['role']],
    	])->first();
    	if (!isset($User)) {
    		return response()->json(['message' => "Data Not Found!"], 404);
    	}

    	if (Hash::check($data['password'], $User->password)) {
    		if ($data['role'] == 'user') {
    			return $User->createToken('user', ['book-get', 'book-request'])->accessToken;
    		} elseif ($data['role'] == 'admin') {
    			return $User->createToken('admin', ['book-modify', 'book-transact', 'book-get', 'user-status-modify'])->accessToken;
    		} else {
    			return response()->json(['message' => "Role bad request!"], 400);
    		}
    	} else {
    		return response()->json(['message' => "Wrong Password!"], 422);
    	}
    }
}
