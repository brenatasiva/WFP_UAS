<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class Policy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function checklogin(User $user)
    {
        return ($user->role->name == 'Pegawai' || $user->role->name == 'Admin' || $user->role->name == 'Member'
            ? Response::allow()
            : Response::deny('Anda harus daftar sebagai member dulu'));
    }

    public function checkmember(User $user)
    {
        return ($user->role->name == 'Member'
            ? Response::allow()
            : Response::deny('Anda harus daftar sebagai member dulu'));
    }

    public function crud(User $user)
    {
        return ($user->role->name == 'Admin' || $user->role->name == 'Pegawai' ? Response::allow() : Response::deny('You must be an Admin.'));
    }

    public function admin(User $user)
    {
        return ($user->role->name == 'Admin' ? Response::allow() : Response::deny('You must be an Admin.'));
    }
}
