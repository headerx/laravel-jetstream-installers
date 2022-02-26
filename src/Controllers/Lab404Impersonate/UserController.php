<?php

namespace HeaderX\JetstreamInstallers\Controllers\Lab404Impersonate;

use App\Models\User;

class UserController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jetstream-installers::lab404-impersonate.users.index', [
            'users' => User::orderBy('name')->paginate(10)
        ]);
    }

}