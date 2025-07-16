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



    public function updateStatusAjax(Request $request)
{
    $shipping = \App\Models\Shipping::findOrFail($request->id);
    $shipping->status = $request->status;
    $shipping->save();
    return response()->json(['success' => true]);
}

   public function adminIndex() {
    $shippings = \App\Models\Shipping::all(); // Atau bisa paginate
    return view('shipping.admin', compact('shippings'));
}

public function updateStatus($id) {
    $shipping = \App\Models\Shipping::findOrFail($id);
    $shipping->status = ($shipping->status == 'Dikirim') ? 'Selesai' : 'Dikirim';
    $shipping->save();
    return redirect()->route('shipping.admin');
}

public function show($id) {
    $shipping = \App\Models\Shipping::findOrFail($id);
    return view('shipping.show', compact('shipping'));
}



}
