<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class BinScreenController extends Controller
{
    public function show(string $bin): View
    {
        return view('bin.screen', [
            'binId' => $bin,
        ]);
    }
}

