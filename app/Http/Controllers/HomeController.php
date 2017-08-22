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
            $deck['username'] = $tempUser[0]['username'];
            $deck['cards'] = \App\Card_deck::where('deck_id', $deck['id'])->get();
            $deck['leader'] = $this->findLeader($deck['cards']); 
            if ($deck['leader']['isMonarch']){
                $deck['faction'] = "Monarch";
            } else {
                $deck['faction'] = "Invader";
            }
        }
        
        ///////////////////////////////////
        // Get all of user's decks
        ///////////////////////////////////
        $userDecks = \App\Deck::where('user_id', $user)->orderBy('updated_at','desc')->get();
        foreach($userDecks as $deck) {
            // $testLead = \App\Card::where('id', $deck['lead_id'] )->get();
            $cardList = \App\Card_deck::where('deck_id', $deck['id'])->get();
            $deck['cards'] = \App\Card_deck::where('deck_id', $deck['id'])->get();
            $deck['leader'] = $this->findLeader($deck['cards']);
            if ($deck['leader']['isMonarch']){
                $deck['faction'] = "Monarch";
            } else {
                $deck['faction'] = "Invader";
            }
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

    public function leader ($card){
        return ($card['type_id'] == 1);
    }
}
