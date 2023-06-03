<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
//CustomerRequest
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class CustomerController extends Controller
{
    public function create(): View
    {
        $customer = new Customer();
        $user = new User();
        // Garante que atribute user existe (mas não grava nada na BD)
        // É necessário, para reaproveitar os forms,
        // porque o form para edit pressupoe que user existe
        $customer->user = $user;
        return view('customers.create', compact('customer'));
    }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    public function store(CustomerRequest $request): RedirectResponse
    {
        $formData = $request->validated();
        $customer = DB::transaction(function () use ($formData, $request) {
            $newUser = new User();
            $newUser->user_type = 'C';
            $newUser->name = $formData['name'];
            $newUser->email = $formData['email'];
            $newUser->blocked = 0;
            $newUser->password = Hash::make($formData['password_inicial']);
            $newUser->save();
            $newCustomer = new Customer();
            $newCustomer->user_id = $newUser->id;
            $newCustomer->save();
            if ($request->hasFile('file_foto')) {
                $path = $request->file_foto->store('public/fotos');
                $newUser->url_foto = basename($path);
                $newUser->save();
            }
            return $newCustomer;
        });
        $url = route('home.show', ['customer' => $customer]);
        $htmlMessage = "Cliente <a href='$url'>#{$customer->id}</a>
                        <strong>\"{$customer->user->name}\"</strong> foi criado com sucesso!";
        return redirect()->route('home')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }
}
