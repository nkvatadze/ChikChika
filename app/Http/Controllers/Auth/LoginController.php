<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Login\StoreRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if (!auth()->attempt($validated)) {
            return back()->withErrors([
                'Credentials doesn\'t match'
            ]);
        };

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function destroy(): RedirectResponse
    {
        auth()->logout();

        return redirect('/');
    }
}
