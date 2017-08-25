<?php

namespace App\Http\Controllers;

use App\Card;
use App\Deck;
use App\User;
use Auth;
use Illuminate\Http\Request;
use JavaScript;

class CardController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::id();
        $cards = \App\Card::orderBy('type_id')->orderBy('name')->get();
        foreach($cards as $card){
            $card['quantity'] = 0;
            $card['selected'] = false;
            if ($card['type_id'] > 2){
                $card['display'] = true;
            } else {
                $card['display'] = false;
            };
        }
        // $decks = \App\Deck::where('user_id', $user)->orderBy('updated_at','desc')->get();
        // foreach ($decks as $deck) {
        //     $lead = \App\Card::where('id',$deck['lead_id'])->get();
        //     $deck['leader'] = $lead[0];
        // };
        
        JavaScript::put([
            'cardlist' => $cards,
            // 'decks' => $decks,
            // 'isEdit' => false
            ]);

        return view('deckbuilder', compact('cards'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        //
    }
}
