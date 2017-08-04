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
        // dd($request);
        // dd(gettype($request->user_id));
        $data = $request->all();
        $cards= json_decode($request->userDeck);
        $user_id = array($request->user_id);
        $name = array($request->name);
        $deck = Deck::create([
                'user_id' => $data['user_id'],
                'name' => $data['name'],
                'cards' => $data['userDeck'],
            ]);
        
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
