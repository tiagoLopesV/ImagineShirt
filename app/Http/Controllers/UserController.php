<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomUsereController extends Controller
{
    public function destroy_foto(User $user): RedirectResponse
    {
        if ($aluno->user->url_foto) {
            Storage::delete('public/fotos/' . $user->photo_url);
            $user->photo_url = null;
            $user->save();
        }
        return redirect()->route('alunos.edit', ['aluno' => $aluno])
            ->with('alert-msg', 'Foto do aluno "' . $aluno->user->name . '" foi removida!')
            ->with('alert-type', 'success');
    }
}