<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data\User;

class Hello extends Controller
{
    // test aja
    public function index(Request $request)
    {
        $users = User::all();
        $user = $users->first();
        
        echo $user->name;
        die($request->nama);
    }
}
