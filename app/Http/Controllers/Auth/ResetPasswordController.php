<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPassword\StoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Support\Facades\Password;
use Tests\Feature\Auth\PasswordResetTest;


class ResetPasswordController extends Controller
{
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $status = Password::reset($validated, function ($user) use ($validated) {
            $user->update([
                'password' => Hash::make($validated['password']),
                'remember_token' => Str::random(60),
            ]);

            event(new PasswordResetTest($user));
        }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }
}
