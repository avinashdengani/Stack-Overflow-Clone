<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function favorite(Question $question)
    {
        $question->views()->update(['is_favorite' => 1]);
        return redirect()->back();
    }
    public function unfavorite(Question $question)
    {
        $question->FavoritesUserId()->update(['is_favorite' => 0]);
        return redirect()->back();
    }
}
