<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RedirectController extends Controller
{
    public function redirectTo(): string
    {
        return "Reirect To";
    }

    public function redirectFrom(): RedirectResponse
    {
        return redirect('/redirect/to');
    }

    public function rederectName(): RedirectResponse
    {
        return redirect()->route('redirect-hello', ['name' => 'Tegar']);
    }
    public function redirectAction(): RedirectResponse
    {
        return redirect()->action([RedirectController::class, 'redirecthello'], ['name' => 'Tegar']);
    }
    public function redirectHello(string $name): string
    {
        return "Hello $name";
    }

    public function redirectAway(): RedirectResponse
    {
        return redirect()->away('https://www.programmerzamannow.com/');
    }
}
