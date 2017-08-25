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

        $allDecks = \App\Deck::where('isPrivate', false)->orderBy('created_at','desc')->take(10)->get();
        // dd($allDecks);
        foreach($allDecks as $deck) {
            $tempUser = \App\User::where('id', $deck['user_id'])->get();
            $deck['username'] = $tempUser[0]['username'];
            $deck = $this->initializeDeck($deck);
        }

        ///////////////////////////////////
        // Get all of user's decks
        ///////////////////////////////////
        $userDecks = \App\Deck::where('user_id', $user)->orderBy('updated_at','desc')->get();
        foreach($userDecks as $deck) {
            $cardList = \App\Card_deck::where('deck_id', $deck['id'])->get();
            $deck = $this->initializeDeck($deck);
        }
        
        JavaScript::put([
            'decks' => $userDecks,
            'allDecks' => $allDecks
            ]);
        return view('home', compact('decks'));
    }

    public function findLeader($cards) {
        $cardList = array();
        foreach ($cards as $card) {
            array_push($cardList, $card->card);
        };
        $leader = array_filter($cardList,function ($card) {
            return ($card['type_id'] == 1);
        }) ;
        return $leader[0];
    }

    public function initializeDeck ($deck) {
        $deck['cards'] = \App\Card_deck::where('deck_id', $deck['id'])->get();
        $deck['leader'] = $this->findLeader($deck['cards']); 
        $deck['faction'] = ($deck['leader']['isMonarch'] ? "Monarch" : "Invader");
        return $deck;
    }

}
