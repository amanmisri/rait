<?php

namespace Modules\Currency\Http\Controllers;

use Illuminate\Routing\Controller;

class CurrentCurrencyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param string $currency
     * @return \Illuminate\Http\Response
     */
    public function store($currency)
    {
        $cookie = cookie()->forever('currency', $currency);

        return back()->withCookie($cookie);
    }
}
