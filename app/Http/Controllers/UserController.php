<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $filterByNome = $request->nome ?? '';
        $userQuery = User::query()->where("user_type", '!=', 'C');
        if ($filterByNome !== '') {
            $userQuery->where('name', 'like', "%$filterByNome%");
        }
        
        $users = $userQuery->paginate(10);
        return view('users.index', compact('users', 'filterByNome'));
    }

    public function destroy_foto(User $user): RedirectResponse
    {
        if ($aluno->user->url_foto) {
            Storage::delete('public/fotos/' . $user->photo_url);
            $user->photo_url = null;
            $user->save();
        }
        return redirect()->route('customers.edit', ['customer' => $user>customer])
            ->with('alert-msg', 'Foto do utilizador "' . $user->name . '" foi removida!')
            ->with('alert-type', 'success');
    }
}