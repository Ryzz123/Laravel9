<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirectTo(): string
    {
        return  "Readirect To";
    }

    public function redirectFrom(): RedirectResponse
    {
        return redirect("/redirect/to");
    }

    public function redirectHello(string $name): string
    {
        return "Hello $name";
    }

    public function redirectName(): RedirectResponse
    {
        return redirect()->route("redirect-hello",[
            "name" => "Febri"
        ]);
    }

    public function redirectAction(): RedirectResponse
    {
        return redirect()->action([RedirectController::class, 'redirectHello'], [
            "name" => "Febri"
        ]);
    }

    public function redirectAway(): RedirectResponse
    {
        return redirect()->away("https://akuryzz.site");
    }
}
