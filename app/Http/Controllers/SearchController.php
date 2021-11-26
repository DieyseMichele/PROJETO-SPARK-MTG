<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\CadastrarDeck;

class SearchController extends Controller
{
	public function __construct() {
		$this->middleware("auth");
	}
    public function search(Request $request){
		// Get the search value from the request
		$search = $request->input('search');

		// Search in the title and body columns from the posts table
		$posts = Card::query()
			->where('name', 'LIKE', "%{$search}%")
			->orWhere('mana', 'LIKE', '%'.$search.'%')
            ->orWhere('rarity', 'LIKE', '%'.$search.'%')
			->paginate(10);

		// Return the search view with the resluts compacted
		return view('search', compact('posts'));
	}
	
}
