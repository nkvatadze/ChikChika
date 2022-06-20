<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Http\Traits\UploadsImage;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use function view;

class UserController extends Controller
{
    use UploadsImage;

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

        if ($request->hasFile('profile_image')) {
            $validated['profile_image_url'] = $this->upload($request->file('profile_image'), 'profile_images/' . auth()->id());
        }

        auth()->user()->update($validated);

        return back();
    }
}
