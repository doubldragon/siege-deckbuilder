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
        $allDecks = \App\Deck::orderBy('created_at','desc')->take(10)->get();
        foreach($allDecks as $deck) {
            $tempUser = \App\User::where('id', $deck['user_id'])->get();
            $username = $tempUser[0]['username'];
            $deck['username'] = $username;
            $testLead = \App\Card::where('id', $deck['lead_id'] )->get();
            $deck['leader'] = $testLead[0];
            // dd($deck['leader']['isMonarch']);
            if ($deck['leader']['isMonarch']){
                $deck['faction'] = "Monarch";
            } else {
                $deck['faction'] = "Invader";
            }
        }
        $decks = \App\Deck::where('user_id', $user)->orderBy('updated_at','desc')->get();
        foreach($decks as $deck) {
            $testLead = \App\Card::where('id', $deck['lead_id'] )->get();
            $deck['leader'] = $testLead[0];
            // dd($deck['leader']['isMonarch']);
            if ($deck['leader']['isMonarch']){
                $deck['faction'] = "Monarch";
            } else {
                $deck['faction'] = "Invader";
            }
        }
        
        JavaScript::put([
            'decks' => $decks,
            'allDecks' => $allDecks
            ]);
        return view('home', compact('decks'));
    }
}
