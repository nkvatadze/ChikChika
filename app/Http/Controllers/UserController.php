<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use function view;

class UserController extends Controller
{
    /**
     * @return View
     */
    public function edit(): View
    {
        return view('users.edit');
    }
}
