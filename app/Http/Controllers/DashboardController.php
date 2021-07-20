<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if(auth()->check()) {
            $your_questions = auth()->user()->questions()->with('owner')->get();
            return view('index', compact(['your_questions']));
        }
        return view('index');
    }
}
