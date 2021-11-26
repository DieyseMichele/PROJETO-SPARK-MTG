<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\UserCollection;
use App\Models\Card;

class CardCadastroController extends Controller
{
    public function __construct() {
		$this->middleware("auth");
	}
	
    public function index()
    {
        $card = new Card();
		$cards = Card::All();
        return view("cards.Cadastro", [
			"card" => $card,
			"cards" => $cards
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
			$card = Card::Find($request->get("id"));
		} else {
			$card = new Card();
		}
		
		$card->id_data = $request->get("id_data");
		$card->oracle_id = $request->get("oracle_id");
		$card->name = $request->get("name");
		$card->released_at = $request->get("released_at");
		$card->image_uris = $request->get("image_uris");
		$card->mana = $request->get("simboloMana");
		$card->type_line = $request->get("type_line");
		$card->oracle_text = $request->get("oracle_text");
		$card->colors = $request->get("identity");
		$card->rarity = $request->get("rarity");
		$card->quantidade = $request->get("quantidade");
		$card->disponivel = $request->get("disponivel");
		
	
	
		$card->save();
		
		$request->Session()->flash("status", "sucesso");
		$request->Session()->flash("mensagem", "Card salvo com sucesso!");
		
		return redirect("/cadastrarCard");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $card = new Card();
		$cards = Card::All();
        return view("cards.Listagem", [
			"card" => $card,
			"cards" => $cards
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
        $card = Card::Find($id);
		$cards = Card::All();
        return view("cards.editarCard", [
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
    public function destroy(Request $request,$id)
    {
        Card::Destroy($id);
		
		$request->Session()->flash("status", "excluido");
		$request->Session()->flash("mensagem", "Card excluído com sucesso!");
		
		return redirect("/cadastrarCard");
    }
}
