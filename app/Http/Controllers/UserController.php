<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
    	$this->middleware("auth");
    }

    public function chat()
    {
    	$users=\App\User::all();
        $count=0;
        $firstUser=null;
        foreach ($users as $user) {
            if (Auth::user()->id!=$user->id) {
                $firstUser=$user;
                break;
            }
        }
    	return view("chat.index",compact('users','firstUser'));
    }
}
