<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Card;

class CardController extends Controller
{
    
    public function bulkdata(Request $request)
    {
		
		
        $json = $request->file("baseDados")->get();
		$data = json_decode($json,true);
		
		
		foreach($data['baseDados'] as $valor =>$v)
		{
			$v->id_data = $data->get("id");
			$v->oracle_id = $data->get("oracle_id");
			$v->name = $data->get("name");
			$v->image_uris = $data->get("image_uris");
			$v->mana = $data->get("mana");
			$v->type_line = $data->get("type_line");
			$v->oracle_text = $data->get("oracle_text");
			$v->colors = $data->get("colors");
			$v->rarity = $data->get("rarity");
			$v->quantidade = $data->get("quantidade");
			$v->disponivel = $data->get("disponivel");
			
		}
		
		$valor->save();
		
		return redirect("/cadastro");
	}


    
    public function destroy($id)
    {
        //
    }
}
