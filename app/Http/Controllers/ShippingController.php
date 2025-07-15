<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipping;

class ShippingController extends Controller
{
    public function index()
    {
        return view('shipping.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'region' => 'required',
            'city' => 'required',
            'address' => 'required',
        ]);

        Shipping::create($request->all());

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }
}
