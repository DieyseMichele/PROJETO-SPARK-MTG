<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\CardController;
use App\Models\Card;

class ConsumirAPIController extends Controller
{
    public function index()
	{

		$card = Http::get('https://api.magicthegathering.io/v1/cards', [
		'multiverseid' => '409741',
		'page' => 1,
		]);
		
		
		
		return dd($card);
	}
}
