<?php

namespace App\Http\Controllers;

use App\Card;
use App\Deck;
use App\User;
use Auth;
use Illuminate\Http\Request;
use JavaScript;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::id();
        $decks = \App\Deck::where('user_id', $user)->get();
        JavaScript::put([
            // 'cardlist' => $cards,
            'decks' => $decks
            ]);
        return view('home', compact('decks'));
    }
}
