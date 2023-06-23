<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
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
                $path = $request->file_photo->store('public/fotos');
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

    public function show(Customer $customer): View
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer): View
    {
        return view('customers.edit', compact('customer'));
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
                    Storage::delete('public/fotos/' . $user->photo_url);
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
