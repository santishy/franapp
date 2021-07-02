<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpersonationController extends Controller
{
    public function store()
    {
        Auth::loginUsingId(request('user_id'));
        session('user_id',request('user_id'));
        return redirect()->back();
    }
}
