<?php

namespace App\Http\Controllers;

class MainCotroller extends Controller{
    public function index(){
        return view('users.index');
    }
}