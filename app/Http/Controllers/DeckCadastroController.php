<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Order;
use App\Models\Card;
use App\Models\CadastrarDeck;
use App\Models\User;
use App\Models\Emprestimo;

class DeckCadastroController extends Controller
{
    public function __construct() {
		$this->middleware("auth");
	}
	
    public function index(Request $request)
    {
        $deck = new CadastrarDeck();
		$deck->user_id = $request->get("usuario");
		$decks = CadastrarDeck::All();
        return view("decks.CadastrarDeck", [
			"deck" => $deck,
			"decks" => $decks
		]);
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
			
		return redirect("/indexAddCard");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $deck = new CadastrarDeck();
		
		$decks = DB::table('cadastrar_deck')
            ->join('users', 'users.id', '=', 'cadastrar_deck.user_id')
            ->select('cadastrar_deck.*', 'users.name AS usuario')
            ->get();
		
        return view("decks.DecksCadastrados", [
			"deck" => $deck,
			"decks" => $decks
		]);
    } 
	

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function destroy(Request $request,$id)
    {
			
		if (Emprestimo::where('deck_id', '=', $id)->exists()) {
			$request->Session()->flash("status", "erro");
			$request->Session()->flash("mensagem", "Não é possivel excluir esse deck, pois está emprestado!");
		
			return redirect("/decksCadastrados");
		}	
		else{
			
			CadastrarDeck::Destroy($id);
			
			$request->Session()->flash("status", "sucesso");
			$request->Session()->flash("mensagem", "Deck excluído com sucesso!");
		
			return redirect("/decksCadastrados");
		}
		
    }
	
	public function searchDeck(Request $request){
		// Get the search value from the request
		$search = $request->input('search');

		// Search in the title and body columns from the posts table
		$decks = CadastrarDeck::query()
			->where('name', 'LIKE', "%{$search}%")
			->orWhere('formato', 'LIKE', '%'.$search.'%')
            ->orWhere('user_id', 'LIKE', '%'.$search.'%')
			->paginate(10);

		// Return the search view with the resluts compacted
		return view('decks/DecksCadastrados', compact('decks'));
	}
}
