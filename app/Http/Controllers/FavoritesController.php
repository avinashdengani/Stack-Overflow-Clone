<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
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
