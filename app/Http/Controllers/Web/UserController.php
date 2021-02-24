<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User as UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = (Auth::user()->is_admin ? User::all() : User::find(Auth::id()));

        return view('web.user.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('web.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $createUser = User::create($request->all());

        if ($request->file('cover')) {
            $createUser->cover = $request->file('cover')->store('user');
            $createUser->save();
        }

        if ($createUser) {
            notify()->success('O usuário foi cadastrado com sucesso', 'Sucesso');
            return redirect()->route('app.users.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        if (!$user) {
            notify()->error('O usuário não foi encontrado verifique os dados e tente novamente', 'Usuario não existe');
            return redirect()->route('app.users.index');
        }

        return view('web.user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);

        if (!empty($request->file('cover'))) {
            Storage::delete($user->cover);
        }

        $user->fill($request->all());

        if (!empty($request->file('cover'))) {
            $user->cover = $request->file('cover')->store('user');
        }

        if($user->save()){
            notify()->success('Usuário atualizado com sucesso','Sucesso');
            return redirect()->route('app.users.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if(!$user){
            notify()->info('Usuário não existe','Usuário não cadastrado');
            return redirect()->route('app.users.index');
        }

        if($user->is_admin && $user->id !== Auth::id()){
            notify()->warning('Você não pode excluir um admin, entre em contato com o suporte','Alerta');
            return redirect()->route('app.users.index');
        }

        if($user->id === Auth::id()){
            notify()->warning('Você não pode excluir seu próprio perfil, entre em contato com o suporte','Alerta');
            return redirect()->route('app.users.index');
        }

        if($user->delete()){
            notify()->success('Usuário deletado com sucesso','Sucesso');
            return redirect()->route('app.users.index');
        }
    }
}
