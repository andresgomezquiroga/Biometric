<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $roles = Roles::with('permissions')->get();
        return view('home.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $permissions = Permission::all();
        return view('home.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Roles $roles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Roles $roles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Roles $roles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Roles $roles)
    {
        //
    }
}
