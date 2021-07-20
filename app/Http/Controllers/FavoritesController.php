<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    public function index()
    {
       $favoriteQuestions = Auth()->user()->views()->with('owner')->where('is_favorite', 1)->search()->latest('updated_at')->paginate(10);
       return view('questions.favorites', compact(['favoriteQuestions']));
    }
    public function favorite(Question $question)
    {
        $question->favoritesUserId()->update(['is_favorite' => 1]);
        return redirect()->back();
    }
    public function unfavorite(Question $question)
    {
        $question->favoritesUserId()->update(['is_favorite' => 0]);
        return redirect()->back();
    }
}
