<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\CustomerRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{

    public function index(Request $request): View
    {
        $filterByNome = $request->nome ?? '';
        $customerQuery = Customer::query();   
        if ($filterByNome !== '') {
            $userIds = User::where('name', 'like', "%$filterByNome%")->pluck('id');
            $customerQuery->whereIntegerInRaw('user_id', $userIds);
        }
        
        $customers = $customerQuery->with('user')->paginate(10);
        return view('customers.index', compact('customers', 'filterByNome'));
    }

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
            $newCustomer->id = $newUser->id;
            $newCustomer->save();
            if ($request->hasFile('photo_file')) {
                $path = $request->photo_file->store('public/photos');
                $newUser->photo_url = basename($path);
                $newUser->save();
            }
            return $newCustomer;
        });
        $url = route('customers.show', ['customer' => $customer]);
        $htmlMessage = "Cliente <a href='$url'>#{$customer->id}</a>
                        <strong>\"{$customer->user->name}\"</strong> foi criado com sucesso!";
        return redirect()->route('home')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    public function show(Customer $customer): View
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer): View
    {
        return view('customers.edit', compact('customer'));
    }

    public function destroy(Customer $customer): RedirectResponse
    {
        try {
            DB::transaction(function () use ($customer) {
                $customer->user->delete();
                if ($customer->user->photo_url) {
                    Storage::delete('public/photos/' . $customer->user->photo_url);
                }
                $customer->delete();
            });
            $htmlMessage = "Cliente #{$customer->user->id}
                    <strong>\"{$customer->user->name}\"</strong> foi apagado com sucesso!";
            return redirect()->route('customers.index')
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', 'success');
            
        } catch (\Exception $error) {
            $url = route('customers.show', ['customer' => $customer]);
            $htmlMessage = "Não foi possível apagar o cliente <a href='$url'>#{$customer->user->id}</a>
                        <strong>\"{$customer->user->name}\"</strong> porque ocorreu um erro!". $error->getMessage();
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }
    

    public function destroy_photo(Customer $customer): RedirectResponse
    {
        if ($customer->user->photo_url) {
            Storage::delete('public/photos/' . $customer->user->photo_url);
            $customer->user->photo_url = null;
            $customer->user->save();
        }
        return redirect()->route('users.edit', ['user' => $user])
            ->with('alert-msg', 'Foto do utilizador "' . $user->name . '" foi removida!')
            ->with('alert-type', 'success');
    }

    public function update(CustomerRequest $request, Customer $customer): RedirectResponse
    {
        $formData = $request->validated();
        $customer = DB::transaction(function () use ($formData, $customer, $request) {
            $customer->nif = $formData['nif'];
            $customer->address = $formData['address'];
            $customer->default_payment_type = $formData['payType'];
            $customer->default_payment_ref = $formData['payRef'];
            $customer->save();
            $user = $customer->user;
            $user->user_type = 'C';
            $user->name = $formData['name'];
            $user->email = $formData['email'];
            $user->blocked = $formData['blocked'];
            $user->save();
            if ($request->hasFile('photo_file')) {
                if ($user->photo_url) {
                    Storage::delete('public/photos/' . $user->photo_url);
                }
                $path = $request->photo_file->store('public/photos');
                $user->photo_url = basename($path);
                $user->save();
            }
            return $customer;
        });
        $url = route('customers.show', ['customer' => $customer]);
        $htmlMessage = "Perfil <a href='$url'>#{$customer->id}</a>
                        <strong>\"{$customer->user->name}\"</strong> foi alterado com sucesso!";
        return redirect()->route('customers.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }
}
