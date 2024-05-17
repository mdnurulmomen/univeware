<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

interface UserServiceInterface
{
    function index();
    function store(array $data);
    function update(array $data, $id);
    function destroy($user);
    function trashed();
    function restore($user);
    function delete($user);
}
