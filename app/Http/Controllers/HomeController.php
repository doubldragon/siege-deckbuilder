<?php

namespace App\Http\Controllers;

use App\Card;
use App\Card_deck;
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
        ///////////////////////////////////
        // Get ten most recent decks
        ///////////////////////////////////

        $allDecks = \App\Deck::orderBy('created_at','desc')->take(10)->get();
        foreach($allDecks as $deck) {
            $tempUser = \App\User::where('id', $deck['user_id'])->get();
            $username = $tempUser[0]['username'];
            $deck['username'] = $username;
            $cardList = \App\Card_deck::where('deck_id', $deck['id'])->get();
            $deck['cards'] = $cardList;
            // dd($cardList[0]);
            $testLead = $this->findLeader($deck['cards']); //\App\Card::where('id', $deck['lead_id'] )->get();
            // dd($testLead);
            $deck['leader'] = $testLead;
            // dd($deck);
            // dd($deck['leader']['isMonarch']);
            if ($deck['leader']['isMonarch']){
                $deck['faction'] = "Monarch";
            } else {
                $deck['faction'] = "Invader";
            }
        }
        
        ///////////////////////////////////
        // Get all of user's decks
        ///////////////////////////////////
        $decks = \App\Deck::where('user_id', $user)->orderBy('updated_at','desc')->get();
        // foreach($decks as $deck) {
        //     $testLead = \App\Card::where('id', $deck['lead_id'] )->get();
        //     $deck['leader'] = $testLead[0];
        //     // dd($deck['leader']['isMonarch']);
        //     if ($deck['leader']['isMonarch']){
        //         $deck['faction'] = "Monarch";
        //     } else {
        //         $deck['faction'] = "Invader";
        //     }
        // }
        
        JavaScript::put([
            'decks' => $decks,
            'allDecks' => $allDecks
            ]);
        return view('home', compact('decks'));
    }

    public function findLeader($cards) {
        foreach ($cards as $card) {
            // dd($card['card_id']);
            $test = \App\Card::find($card['card_id']);
            if ($test['type_id'] == 1) {
                return $test;
            };
        };
    }
}
