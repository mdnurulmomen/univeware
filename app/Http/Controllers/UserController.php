<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\UserServiceInterface;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
{
    public function __construct(private UserServiceInterface $userServiceInterface)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('users.index')
            ->with('users', $this->userServiceInterface->index());
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
        $userData = [
            'prefixname' => $request->prefixname,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'suffixname' => $request->suffixname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $this->userServiceInterface->hash($request->password),
            'type' => $request->type ?? 'user',
        ];

        try {

            $user = $this->userServiceInterface->store($userData);

            event(new Registered($user));

            Auth::login($user);

            return redirect()->route('users.index')
                ->with('message', 'New user has been created!');

        } catch (\Throwable $th) {

            return redirect()->back()
                ->with('error', $th->getMessage());

        }
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
        $userData = [
            'prefixname' => $request->prefixname,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'suffixname' => $request->suffixname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $this->userServiceInterface->hash($request->password),
            'type' => $request->type ?? 'user',
        ];

        try {

            $this->userServiceInterface->update($userData, $user);

            return redirect()->route('users.index')
            ->with('message', 'User has been updated!');

        } catch (\Throwable $th) {

            return redirect()->back()
                ->with('error', $th->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        try {

            $this->userServiceInterface->destroy($user);

            return redirect()->back()
            ->with('message', 'User has been deleted!');

        } catch (\Throwable $th) {

            return redirect()->back()
                ->with('error', $th->getMessage());

        }


    }

    /**
     * Display a listing of the resource.
     */
    public function trashed(): View
    {
        return view('users.trashed-index')
            ->with('users', $this->userServiceInterface->trashed());
    }

    /**
     * Update the specified resource in storage.
     */
    public function restore(Request $request, User $user): RedirectResponse
    {
        try {

            $this->userServiceInterface->restore($user);

            return redirect()->back()
            ->with('message', 'User has been restored!');

        } catch (\Throwable $th) {

            return redirect()->back()
            ->with('error', $th->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(User $user): RedirectResponse
    {
        try {

            $this->userServiceInterface->delete($user);

            return redirect()->back()
                ->with('message', 'User has been deleted permanently!');

        } catch (\Throwable $th) {

            return redirect()->back()
            ->with('error', $th->getMessage());

        }
    }
}
