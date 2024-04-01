<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchAddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ViewErrorBag;

class SiteController extends Controller
{

    public function home()
    {
        return view('home');
    }

    public function search(SearchAddressRequest $request) 
    {   
        $validated = $request->validated();
        if(!$request->input('cep')) {
            return view('search');
        }
        $address = Address::searchWithCEP($validated['cep']);
        return view('search', ['result' => $address]);
    }
}
