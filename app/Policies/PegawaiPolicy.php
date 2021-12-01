<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PegawaiPolicy
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

    public function checkpegawai(User $user)
    {
        return ($user->role->name == 'Pegawai' || $user->role->name == 'Admin'
            ? Response::allow()
            : Response::deny('Anda harus daftar sebagai Pegawai dulu'));
    }
}
