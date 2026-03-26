<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $gameId)
    {
        $request->validate([
            'content' => 'required|max:500',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'game_id' => $gameId,
            'content' => $request->content,
        ]);

        return back()->with('success', 'Comment posted!');
    }
}
