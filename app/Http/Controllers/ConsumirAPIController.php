<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\CardController;
use mtgsdk\Card;

class ConsumirAPIController extends Controller
{
    public function index()
	{
		$pagina = 2;

		$cards = Card::where(['page' => $pagina, 'pageSize' => 10, 'contains' => 'imageUrl,text,manaCost,colors'])->all();
		
		return view('cards.Listagem', compact('cards'));
		
		
		
	}
}
