<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('users.index')
            ->with('users', User::orderBy('updated_at', 'DESC')->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        $user = User::create([
            'prefixname' => $request->prefixname,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'suffixname' => $request->suffixname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->back()
            ->with('message', 'New user has been created!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        return view('users.edit')
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $user->update([
            'prefixname' => $request->prefixname,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'suffixname' => $request->suffixname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
        ]);

        return redirect()->route('users.index')
            ->with('message', 'User has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->back()
            ->with('message', 'User has been deleted!');
    }

    /**
     * Display a listing of the resource.
     */
    public function trashed(): View
    {
        return view('users.trashed-index')
            ->with('users', User::onlyTrashed()->orderBy('updated_at', 'DESC')->get());
    }

    /**
     * Update the specified resource in storage.
     */
    public function restore(Request $request, User $user): RedirectResponse
    {
        // If the user is not soft-deleted, return a 404 response.
        if (! $user->trashed()) {
            return redirect()->back()
            ->with('error', 'User not found!');
        }

        $user->restore();

        return redirect()->back()
            ->with('message', 'User has been restored!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(User $user): RedirectResponse
    {
        // If the user is not soft-deleted, return a 404 response.
        if (! $user->trashed()) {
            return redirect()->back()
            ->with('error', 'User not trashed!');
        }

        $user->forceDelete();

        return redirect()->back()
            ->with('message', 'User has been deleted permanently!');
    }
}
