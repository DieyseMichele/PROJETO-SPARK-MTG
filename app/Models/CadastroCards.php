<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CadastroCards extends Model
{
    use HasFactory;
	protected $table = "cadastro_card";
	
	protected $casts = [
		'colors' => 'array'
	];
}
