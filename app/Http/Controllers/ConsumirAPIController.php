<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Card;

class ConsumirAPIController extends Controller
{
    public function index()
	{
		$cards = Http::get('https://api.magicthegathering.io/v1/cards');
		
		$cardArray = $cards->json();
		
		//dd($response);
		
		return view ('cards.Listagem', compact('cardArray'));
	}
}
