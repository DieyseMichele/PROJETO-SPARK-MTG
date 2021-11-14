<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ConsumirAPIController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resources([
	"usuario" => UsuarioController::class,
	
]);
Route::get('/', function () {
    return view('templates.templateLogin');
});
Route::get('/login', function () {
    return view('templates.templateLogin');
})->name("login");

Route::get('/home', function () {
    return view('templates.templateAdmin');
});

Route::get('/perfil', function () {
    return view('usuario.Perfil');
});

Route::get("/consumirApi", [ ConsumirAPIController::class, "index" ]);
Route::get("/usuariosCadastrados", [ UsuarioController::class, "show" ]);
Route::post("/updatePerfil", [ UsuarioController::class, "update" ]);

Route::post("/bulkdata", [ CardController::class, "bulkdata" ]);

Route::post("/login", [ LoginController::class, "login" ]);
Route::get("/logoff", [ LoginController::class, "logoff" ]);

Route::get('/listagem', function () {
    return view('cards/Listagem');
});
Route::get('/cadastro', function () {
    return view('cards/Cadastro');
});
Route::get('/emprestimo', function () {
    return view('cards/Emprestimo');
});


Route::get('/forgot-password', function () {
    return view('templates.templateForgotPassword');
})->middleware('guest')->name('password.request');


Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('templates.templateResetPassword', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');