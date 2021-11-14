<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
	public function __construct() {
		$this->middleware("auth");
	}
	
    public function index()
    {
        $usuario = new User();
		$usuarios = User::All();
        return view("administrador.CadastrarUsuario", [
			"usuario" => $usuario,
			"usuarios" => $usuarios
		]);
    }

    public function create()
    {
        //
    }
 
    public function store(Request $request)
    {
        $validado = $request->validate([
			"name" => "required",
			"email" => "required|unique:users|email",
			'email' => Rule::unique('users')->ignore($request->get("id")),
			"foto" => "mimes:jpg,bmp,png,webp",
			"password" => "required",
			'ConfirmarPassword' => 'required|same:password',
			
		], [
			"required" => 'O campo :attribute é obrigatório.',
			"email.unique" => "O e-mail já existe.",
			"email.email" => "O campo deve ser do tipo e-mail.",
			"foto.mimes" => "É necessário importar um arquivo de imagem (jpg, bmp, png, webp).",
			"ConfirmarPassword.same" => "As senhas devem ser iguais."
		]);
		
		if ($request->get("id") != "") {
			$usuario = User::Find($request->get("id"));
		} else {
			$usuario = new User();
		}
		
		$usuario->name = $request->get("name");
		$usuario->email = $request->get("email");
		
		if ($request->hasFile('foto')) 
		{
			$usuario->foto =  $request->file("foto")->store("usuarios");
			
		}else{
			
			
		}

		
		
		
		$usuario->password = Hash::make($request->get("password"));
		
		$usuario->save();
		
		$request->Session()->flash("status", "sucesso");
		$request->Session()->flash("mensagem", "Usuário salvo com sucesso!");
		
		return redirect("/usuario");
    }

   
    public function show()
    {
        $usuario = new User();
		$usuarios = User::All();
        return view("administrador.ListarUsuarios", [
			"usuario" => $usuario,
			"usuarios" => $usuarios
		]);
    }

    public function edit($id)
    {
		$usuario = User::Find($id);
		$usuarios = User::All();
        return view("administrador.EditarUsuario", [
			"usuario" => $usuario,
			"usuarios" => $usuarios
		]);
        
    }

  
    public function update(Request $request)
    {
		$usuario = Auth::user();
		
		$usuario->name = $request->get("name");
		$usuario->email = $request->get("email");
		
		
		if($request->get("AtualPassword")!= "")
		{
			$atualPassword = Hash::make($request->get("AtualPassword"));
	
			if ($atualPassword!=$usuario->password) 
			{
				$request->Session()->flash("status", "erro");
				$request->Session()->flash("mensagem", "Senha incorreta!");
				
			} else {
				$usuario->password = Hash::make($request->get("NewPassword"));
			}	
		}
		
		$usuario->save();
		
		$request->Session()->flash("status", "sucesso");
		$request->Session()->flash("mensagem", "Perfil atualizado com sucesso!");
		
		return redirect("/perfil");
    }

    public function destroy($id, Request $request)
    {
        $usuario = User::Find($id);
		\Storage::delete($usuario->foto);
		$usuario->delete();
		
		$request->Session()->flash("status", "sucesso");
		$request->Session()->flash("mensagem", "Usuário excluído com sucesso!");
		
		return redirect("/usuariosCadastrados");
    }
}
