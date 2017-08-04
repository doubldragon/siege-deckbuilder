<?php

namespace App\Http\Controllers;

use App\Deck;
use Illuminate\Http\Request;
use JavaScript;

class DeckController extends Controller
{
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
        // dd($request->cards);
        // dd(json_encode($request->cards));
        // $cards= $request->cards;
        // $cards =  json_decode($cards);
        // return $cards[0];
        // return $cards->toJson();
        $deck = new Deck;
        $deck['cards'] = $request->cards;
        $deck['user_id'] = $request->user_id;
        $deck['name'] = $request->name;
        $deck->save();
        // $request->cards= json_encode($request->cards);
        // $deck->fill($request->all())->save();
        // dd($cards[0]);
        JavaScript::put([
            'cardlist' => $deck['cards']
            ]);

        return view('deckbuilder');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deck  $deck
     * @return \Illuminate\Http\Response
     */
    public function show(Deck $deck)
    {
        $decks = Deck::find(31);
        dd(gettype($decks['cards']));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deck  $deck
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deck $deck)
    {
        //
    }
}
