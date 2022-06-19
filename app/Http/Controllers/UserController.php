<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use function view;

class UserController extends Controller
{
    /**
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        $isRestricted = false;

        if (request()->user()->cannot('view', $user)) {
            $user->load('tweets', 'followers', 'followings');
            $isRestricted = true;
        }

        $user->loadCount('followings', 'followers');

        $users = User::notAuth()->notFollowedBy(auth()->id())->paginate(15);

        return view('users.show', compact('user', 'users', 'isRestricted'));
    }

    /**
     * @return View
     */
    public function edit(): View
    {
        return view('users.edit');
    }

    /**
     * @param UpdateRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['is_private'] = isset($validated['is_private']);

        auth()->user()->update($validated);

        return back();
    }
}
