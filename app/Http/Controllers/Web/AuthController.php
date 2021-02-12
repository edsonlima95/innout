<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function formLogin()
    {
        return view('web.login');
    }

    public function login(Request $request)
    {
        $credencials = $request->validate([
            'email' => 'required|email',
            'password' => 'min:4|max:8'
        ]);

        if(!Auth::attempt($credencials)){
            notify()->error('Os dados não conferem, porfavor verifique o email e a senha e tente novamente','Verifque os dados');
            return redirect()->route('app.login')->withInput();
        }

        return redirect()->route('app.home');
    }

    public function logout()
    {
        Auth::logout();
        notify()->success('Você saiu do sistema com sucesso','Logout');
        return redirect()->route('app.login');
    }

}
