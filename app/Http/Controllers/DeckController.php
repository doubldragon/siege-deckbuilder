<?php

namespace App\Http\Controllers;

use App\Card;
use App\Deck;
use App\Card_deck;
use Illuminate\Http\Request;
use Auth;
use JavaScript;

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
        
        $cards = json_decode($data['userDeck'],true);
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
        foreach ($cards as $card) {
            if ($card['selected']) {
            $entry = Card_deck::create([
                'deck_id' => $deck['id'],
                'card_id' => $card['id'],
                'quantity' => $card['quantity']
                ]);
        }
        };
        
        // JavaScript::put([
        //     'cardlist' => $deck['cards']
            
        //     ]);

        return redirect('/home');
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
        $deck = Deck::find($request->deck_id);
        $deck['user_id'] = $request->user_id;
        $deck['name'] = $request->name;
        $deck['cards'] = $request->userDeck;
        $deck['isMonarch'] = $request->isMonarch;
        $deck['lead_id'] = $request->lead_id;
        $deck['id'] = $request->deck_id;
        $deck->save();
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
        $toDelete->card_decks->delete();
        $toDelete->delete();

        return redirect('/home');
    }
}
