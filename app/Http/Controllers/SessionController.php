<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function createSession(Request $request): string
    {
        $request->session()->put("UserId", "Febri");
        $request->session()->put("IsMember", true);
        return "OK";
    }

    public function getSession(Request $request): string
    {
        $userId = $request->session()->get("UserId", "guest");
        $isMember = $request->session()->get("IsMember", "false");

        return "User ID : ${userId}, Is Member : ${isMember}";
    }
}
