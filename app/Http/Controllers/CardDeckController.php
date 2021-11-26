<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\CadastrarDeck;
use App\Models\User;
use App\Models\Card_Deck;
use DB;

class CardDeckController extends Controller
{
    function __construct()
    {
        // obriga estar logado;
        $this->middleware('auth');
    }
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cardDeck = new Card_Deck();
		$deck = new CadastrarDeck();
		$card = new Card();			
		$cardDecks = Card_Deck::All();
		$decks = CadastrarDeck::All();
		$cards = Card::All();
        return view("decks.AdicionarCard", [
			"cardDeck" => $cardDeck,
			"cardDecks" => $cardDecks,
			"card" => $card,
			"cards" => $cards,
			"deck" => $deck,
			"decks" => $decks,
			
		]);
    }

    public function adicionar(Request $request )
    {
		$validado = $request->validate([
			"deck" => "required",			
		], [
			"required" => 'O campo :attribute é obrigatório.',
		]);
		
		if ($request->get("id") != "") {
			$cardDeck = Card_Deck::Find($request->get("id"));
		} else {
			$cardDeck = new Card_Deck();
		}
		
		$cardDeck->deck = $request->get("deck");
		$cardDeck->card = $request->get("card");
		
	
		$cardDeck->save();

      
		$request->Session()->flash("status", "sucesso");
		$request->Session()->flash("mensagem", "Card adicionado com sucesso!");
		
		return redirect("/indexAddCard");
		
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $card = new Card_Deck();
		
		$cards = DB::table('card__deck')
            ->join('card', 'card.id', '=', 'card__deck.card')
            ->join('card__deck', 'card__deck.deck', '=', $id)
            ->select('card.*')
            ->get();
		
        return view("decks.CardsDeck", [
			"card" => $card,
			"cards" => $cards
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	
	public function remover($id, Request $request)//remover card do deck
    {
		Card_Deck::Destroy($id);
			
		$request->Session()->flash("status", "sucesso");
		$request->Session()->flash("mensagem", "Card removido com sucesso!");
		
		return redirect("/indexAddCard");
        
    }
}
