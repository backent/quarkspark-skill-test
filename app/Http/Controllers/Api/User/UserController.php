<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    //
    public function changeStatus(User $user) {
    	if (!$this->canChangeStatus()) {
    		return response()->json(['message' => 'Forbidden!'], 403);
    	}

    	if ($user->status == 'active') {
    		$user->status = 'inactive';
    	} else {
    		$user->status = 'active';
    	}
    	$user->save();
    	
    	return response()->json($user, 200);

    }

    private function canChangeStatus(): bool {
    	if (request()->user()->tokenCan('user-status-modify')) {
    		return true;
    	} else {
    		return false;
    	}
    }
}
