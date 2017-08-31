<?php

namespace App\Http\Controllers;

use App\Card;
use App\Deck;
use App\Card_deck;
use Illuminate\Http\Request;
use Auth;
use JavaScript;
use Carbon\Carbon;

class DeckController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }    



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $data = $request->all();
        
        $cards = $this->filterDeck($request->userDeck);
        $deck = Deck::create([
                'user_id' => $data['user_id'],
                'name' => $data['name'],
                'isMonarch' => $data['isMonarch'],
            ]);
        $entry = Card_deck::create([
            'deck_id' => $deck['id'],
            'card_id' => $data['lead_id'],
            'quantity' => 1
            ]);
        
        $this->createCardDecks ($cards,$deck['id']);

        return redirect('/home');
    }

    // Returns a card list of only cards that were selected by user
    public function filterDeck ($cards) {
        return array_filter(json_decode($cards), function ($card)  {
            return ($card->selected == true);
        });
    }

    //Create Card_deck entries for each card
    public function createCardDecks ($cards,$deck_id) {
        foreach ($cards as $card) {
            $entry = Card_deck::create([
                'deck_id' => $deck_id,
                'card_id' => $card->id,
                'quantity' => $card->quantity
            ]);
            
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deck  $deck
     * @return \Illuminate\Http\Response
     */
    public function show(Deck $deck)
    {
        $user = Auth::id();
        $testLead = \App\Card::where('id', $deck['lead_id'] )->get();
       
        $deck['isEdit'] = true;
        $deck = $this->initializeDeck($deck);
        // dd($deck);
        $userDecks = \App\Deck::where('user_id', $user)->orderBy('updated_at','desc')->get();
        foreach ($userDecks as $userDeck) {
            $userDeck = $this->initializeDeck($userDeck);
            // $lead = \App\Card::where('id',$userDeck['lead_id'])->get();
            // $userDeck['leader'] = $lead[0];
        };
        // dd($userDecks);

        
        JavaScript::put([
            'cardlist' => $deck['cards'],
            'editDeck' => $deck,
            'isEdit' => true,
            'decks' => $userDecks
            ]);


        return view('deckbuilder');
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
        $deck['cards'] = \App\Card::where('type_id','!=',1)->where('isMonarch',$deck['isMonarch'])->orderBy('type_id')->get();
        $selectedCards = \App\Card_deck::where('deck_id', $deck['id'])->get();
        foreach ($deck['cards'] as $card) {
            $test = array_filter(json_decode($selectedCards),function ($select) use($card){
                return ($select->card_id == $card['id']);
            });
            if ($test) {
                $match = array_pop($test);
                $card['selected'] = true;
                $card['quantity'] = $match->quantity;
                
            } else{
                $card['selected'] = false;
                $card['quantity'] = 0;
                // $card['display'] = false;
                }
            $card['display'] = true;                ;
        };
        $deck['leader'] = $this->findLeader($selectedCards); 
        $deck['faction'] = ($deck['leader']['isMonarch'] ? "Monarch" : "Invader");

        return $deck;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deck  $deck
     * @return \Illuminate\Http\Response
     */
    public function edit(Deck $deck)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deck  $deck
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deck $deck)
    {
        // Cards contained in the updated deck
        $cards = $this->filterDeck($request->userDeck);
        
        // Deck Entry from the previously saved deck
        $deck = Deck::find($request->deck_id);
        // dd($deck);
        if ($request->name != $deck['name']) {
            $deck['name'] = $request->name;
            $deck->save();
        }

        // Card_deck entries from the previously saved deck
        $oldCards = Card_deck::where('deck_id', $request->deck_id)->get();
        
        // Check if each of the saved cards is in the updated deck
        foreach ($oldCards as $card) {
            $found = false;
            // Iterate through Updated cards to be saved
            foreach($cards as $key => $value) {
                if ($value->id == $card->card_id) {
                    $found = true;
                    $currentEntry = (Card_deck::where('deck_id',$request->deck_id)->where('card_id',$value->id)->get())[0];
                    // Only update the entry if the card quantity has changed
                    if ($currentEntry['quantity'] != $cards[$key]->quantity){
                        $currentEntry['quantity'] = $cards[$key]->quantity;
                    }
                    $currentEntry->save();
                    break;
                }            
            }

            // Remove found card from the array to speed up future iterations
            if ($found) {
                unset($cards[$key]);
            }else {
                
                // If the card is not a leader card, and was not found, delete the Card_deck entry
                if ($card->card->type_id > 1){
                    $toDelete = (Card_deck::where('deck_id',$request->deck_id)->where('card_id',$card->card_id)->get())[0];
                    $toDelete->delete();
                };
            }
        }
        // Create Card_deck entries for cards added to the deck;
        $this->createCardDecks($cards,$deck['id']);
        return redirect('/home');
    

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deck  $deck
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deck $deck)
    {
        $toDelete = Deck::find($deck->id);
        $card_decks = Card_deck::where ('deck_id', $deck->id)->get();
        foreach ($card_decks as $each) {
            $each->delete();
        }
        // $toDelete->card_decks->delete();
        $toDelete->delete();

        return redirect('/home');
    }
}
