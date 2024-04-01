<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchAddressRequest;
use App\Models\Address;
use App\Models\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var $user User */
        $user = auth()->user();
        $addresses = $user->addresses()->paginate(5);
        return view('addresses-list', ['addresses' => $addresses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($cep)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!$request->filled('cep')) {
            return redirect()->back()->withErrors(['not_found' => 'O CEP informado não tem o formato válido']);
        }

        $cep = $request->input('cep');
        $cep = str_replace('-','',$cep);
        $user = auth()->user();
    
        if(!Address::isCEP($cep)) {
            return redirect()->back()->withErrors(['not_found' => 'O CEP informado não tem o formato válido']);
        }
        $address = Address::searchWithCEP($cep);
        if(!$address) {
            return redirect()->back()->withErrors(['not_found' => 'O CEP informado não foi encontrado']);
        }
        
        if(!Address::where('cep','=',$cep)->exists()) {
            $address->save();
        }
           $address = Address::where('cep','=',$cep)->first();
        
            if(!$user->addresses()->where('address_id', $address->id)->exists()) {
                $user->addresses()->attach($address);
            }

        return redirect()->route('addresses.list')->with(['success' => 'Endereço salvo com sucesso!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!is_numeric($id)) {
        return redirect()->back()->withErrors(['not_found' => 'Endereço não encontrado']);
        }
        /** @var $user User */
       $user = auth()->user();
       $address = Address::find($id); 
       if(!$address) {
        return redirect()->back()->withErrors(['not_found' => 'Endereço não encontrado']);
       }

       if($user->addresses()->where('address_id','=',$address->id)->exists()) {
        $user->addresses()->detach($address->id);
       }
       if($address->users()->get()->isEmpty()) {
        $address->delete();
       }

       return redirect()->route('addresses.list')->with(['success' => 'Endereço removido com sucesso!']);
    }
}
