<?php

namespace App\Http\Controllers;
class VerifyTokenController extends Controller
{
    public function users()
    {
        return response()->json(['status' => "success","response" => "verified"]);
    }

    public function patients()
    {
        return response()->json(['status' => "success","response" => "verified"]);
    }
}
