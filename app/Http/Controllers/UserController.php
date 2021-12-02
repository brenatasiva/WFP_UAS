<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('crud-permission');

        $data = User::where('role_id', 2)->get();
        return view('user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('admin-permission');

        if (null !== $request->get('password')) {
            $user->password = bcrypt($request->get('password'));
            $user->save();
            return redirect()->route('user.index')->with('status', 'User password succesfully reset');
        } else {
            $user->status = $request->get('status');
            $user->save();
            return redirect()->route('user.index')->with('status', 'Action succesfully done');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function showResetPasswordModal(Request $request)
    {
        $this->authorize('admin-permission');

        $id = $request->get('pegawaiId');
        $data = User::find($id);
        return response()->json(array(
            'msg' => view('user.modal', compact('data'))->render()
        ), 200);
    }
}
