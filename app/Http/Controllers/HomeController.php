<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
    return view('welcome');
    }
     public function Product(){
    return view('users.allproduct');
    }

}