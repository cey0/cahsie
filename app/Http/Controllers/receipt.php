<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class receipt extends Controller
{
    public function receipt(Request $request)
{
    return view('transaksi.pdf', [
        'total' => $request->input('total'),
        'discount' => $request->input('discount'),
        'moneyGiven' => $request->input('moneyGiven'),
        'change' => $request->input('change'),
    ]);
}

}
