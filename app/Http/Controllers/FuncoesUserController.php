<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Card;
use App\Models\CadastrarDeck;
use App\Models\User;
use App\Models\Card_Deck;
use App\Models\Emprestimo;

class FuncoesUserController extends Controller
{
    public function ListarCards()
    {
        $card = new Card();
		$cards = Card::All();
        return view("cards.ListagemUser", [
			"card" => $card,
			"cards" => $cards
		]);
    }
	public function ListarDecksUser()
    {	
		$deck = new CadastrarDeck();
		$decks = DB::table('cadastrar_deck')->where('user_id', Auth::user()->id)->get();
        return view("decks.ListarUser", [
			"deck" => $deck,
			"decks" => $decks
		]);
    }
	public function ListarTodosDecks()
    {		
		$deck = new CadastrarDeck();
		
		$decks = DB::table('cadastrar_deck')
            ->join('users', 'users.id', '=', 'cadastrar_deck.user_id')
            ->select('cadastrar_deck.*', 'users.name AS usuario')
            ->get();
		
        return view("decks.ListarTodos", [
			"deck" => $deck,
			"decks" => $decks
		]);
    }
	public function UserCadastrarDeck(Request $request)
    {
		
		if ($request->get("id") != "") {
			$deck = CadastrarDeck::Find($request->get("id"));
		} else {
			$deck = new CadastrarDeck();
		}
		$deck->user_id = $request->get("usuario");
		$deck->name = $request->get("name");
		$deck->formato = $request->get("formato");

		$deck->save();
		
		$request->Session()->flash("status", "sucesso");
		$request->Session()->flash("mensagem", "Deck Cadastrado com sucesso!");
			
		return redirect("/UserCadastrarDeck");
    }
	
}
