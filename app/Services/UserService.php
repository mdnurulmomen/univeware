<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class UserService implements UserServiceInterface
{
    public function __construct(private User $user)
    {

    }

    public function index()
    {
        return User::orderBy('updated_at', 'DESC')->get();
    }

    public function store(array $data)
    {
        $user = User::create($data);
        return $user;
    }

    public function update(array $data, $user)
    {
        $user->update($data);
    }

    public function destroy($user)
    {
        $user->delete();
    }

    public function trashed()
    {
        return User::onlyTrashed()->orderBy('updated_at', 'DESC')->get();
    }

    public function restore($user)
    {
        $user->restore();
    }

    public function delete($user)
    {
        $user->forceDelete();
    }
}
