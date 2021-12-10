<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\CadastroCards;
use mtgsdk\Card;
use App\Models\CadastrarDeck;
use App\Models\User;
use App\Models\CardDeck;
use App\Models\Emprestimo;

class FuncoesUserController extends Controller
{
	public function index(Request $request)
	{
		
		$cardDeck = new CardDeck();
		$cardDeck->deck = $request->get("deck");
		$cardDecks = CardDeck::Where("deck", $request->get("deck"))->get();
		$card = new CadastroCards();
		$cards = CadastroCards::All();
		$cds = DB::table('card_deck')
            ->join('cadastro_card', 'cadastro_card.id', '=', 'card_deck.card')
            ->join('cadastrar_deck', 'cadastrar_deck.id', '=', 'card_deck.deck')
            ->select('cadastro_card.*', 'cadastrar_deck.id AS deck_id')
            ->get();
		return view("decks.CardsDeck", [
			"cardDeck" => $cardDeck,
			"cardDecks" => $cardDecks,
			"card" => $card,
			"cards" => $cards,
			"cds" => $cds,
		]);
	}
	public function HomeUser(Request $request)
	{
		$pagina = ($request->get('pagina')) ? $request->get('pagina') : 1;
        $tipo = ($request->get('tipo')) ? $request->get('tipo') : 'lista';
        $pageSize = 12;

		$params = [
            'page' => $pagina,
            'pageSize' => $pageSize
        ];
        $query = http_build_query($params);
        $client = new \GuzzleHttp\Client();
        $request = new \GuzzleHttp\Psr7\Request(
            'GET',
            "https://api.magicthegathering.io/v1/cards?{$query}",
        );
        $promise = $client->sendAsync($request)->then(function ($response) use ($pagina, $pageSize, $tipo) {
            $body = json_decode($response->getBody()->getContents(), false);
            $headers = $response->getHeaders();
            $totalCount = $headers['total-count'][0];
            $totalPages = ceil($totalCount / $pageSize);
            $cards = $body->cards;
            $cardsGroup = array_chunk($cards, 4, true);
			$cardsUnimagi = CadastroCards::All();
			
            echo view('cards.HomeUser', compact('cards', 'cardsGroup', 'totalPages', 'pagina', 'pageSize', 'tipo','cardsUnimagi'));
        });
        $promise->wait();
	}
    public function ListarCards()
    {
		$card = new CadastroCards();
		$cards = CadastroCards::All();
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
	
	public function searchCard(Request $request){
		// Get the search value from the request
		$search = $request->input('search');

		// Search in the title and body columns from the posts table
		$posts = CadastroCards::query()
			->where('name', 'LIKE', "%{$search}%")
			->orWhere('manaCost', 'LIKE', '%'.$search.'%')
            ->orWhere('rarity', 'LIKE', '%'.$search.'%')
			->paginate(10);
			
			

		// Return the search view with the resluts compacted
		return view('searchCardUser', compact('posts'));
	}
}
