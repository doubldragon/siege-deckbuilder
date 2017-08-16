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
       
        // dd(gettype($request->user_id));
        $data = $request->all();
        
        $cards = json_decode($data['userDeck'],true);
        // $oneCard = $selectedCards[75];
        // $oneCard['test'] = true;
        // dd($data);
        $deck = Deck::create([
                'user_id' => $data['user_id'],
                'name' => $data['name'],
                // 'cards' => $data['userDeck'],
                // 'isPrivate' => $data['isPrivate'],
                // 'lead_id' => $data['lead_id'],
                'isMonarch' => $data['isMonarch'],
            ]);
        $entry = Card_deck::create([
            'deck_id' => $deck['id'],
            'card_id' => $data['lead_id'],
            'quantity' => 1
            ]);
        // dd($entry);
        foreach ($cards as $card) {
            if ($card['selected']) {
            // dd($deck);
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
       
        $deck['leader'] = $testLead[0];

        $deck['isEdit'] = true;
        if ($deck['leader']['isMonarch']){
            $deck['faction'] = "Monarch";
        } else {
            $deck['faction'] = "Invader";
        };

        $userDecks = \App\Deck::where('user_id', $user)->orderBy('updated_at','desc')->get();
        foreach ($userDecks as $userDeck) {
            $lead = \App\Card::where('id',$userDeck['lead_id'])->get();
            $userDeck['leader'] = $lead[0];
        };

        
        JavaScript::put([
            'cardlist' => $deck['cards'],
            'editDeck' => $deck,
            'isEdit' => true,
            'decks' => $userDecks
            ]);


        return view('deckbuilder');
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
        // dd($request);
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
        $toDelete->delete();
        return redirect('/home');
    }
}
