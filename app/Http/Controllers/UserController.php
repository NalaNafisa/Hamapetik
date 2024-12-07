<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Void_;

class UserController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }
}
