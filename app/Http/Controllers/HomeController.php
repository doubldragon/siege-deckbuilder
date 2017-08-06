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
            // 'cardlist' => $cards,
            'decks' => $decks,
            // 'isEdit' => false
            ]);
        //dd($decks);
        return view('home', compact('decks'));
    }
}
