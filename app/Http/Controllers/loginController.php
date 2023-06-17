<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignUpRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use mysql_xdevapi\Session;

class loginController extends Controller
{

    public function login()
    {
        return view('login');
    }

    public function signup()
    {
        return view('signup');
    }

    function loginPost(LoginRequest $request)
    {
        //Confrontando i dati inseriti con quelli del database, logga l'utente
        $request->authenticate();


        //Serve per la sicurezza del login
        //Rigenera l'ID della sessione
        $request->session()->regenerate();

        //Prendo il ruolo dell'utente autenticato e lo indirizzo in una determinata pagina a seconda della classe di utenza
        $role = auth()->user()->role;
        switch ($role) {
            case 'admin': return redirect()->route('home');
                break;
            case 'user': return redirect()->route('home');
                break;
            case 'staff':return redirect()->route('home');
           // default: return redirect('catalogo');
        }
    }



    function signupPost(SignUpRequest $request)
    {

        $data['nome'] = $request->nome;
        $data['email']=$request->email;
        $data['password'] = Hash::make($request->password);
        $data['username'] = $request->username;
        $data['cognome'] = $request->cognome;
        $data['telefono'] = $request->telefono;
        $data['datadinascita'] = $request->datadinascita;
        $data['genere'] = $request->genere;
        $user = User::create($data);

        Auth::login($user);

        return redirect(route('home'));
    }

    function logout(Request $request):RedirectResponse
    {
        Auth::logout();
        //Elimina il vecchio ID della sessione e ne crea uno nuovo
        $request->session()->invalidate();
        //Rigenera il valore del CSRF token
        $request->session()->regenerateToken();

        return redirect(route('home'));
    }

}
