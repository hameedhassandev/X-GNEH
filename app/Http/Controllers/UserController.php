<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
   public function index()
   {
       if (Auth::user()->hasRole('user')){
           return view('userDashboard');
       }elseif (Auth::user()->hasRole('seller')){
           return view('sellerDashboard');
       }elseif (Auth::user()->hasRole('admin')){
           return view('dashboard');
       }
   }

   public function myProfile(){
       return view('profile');
   }
}
