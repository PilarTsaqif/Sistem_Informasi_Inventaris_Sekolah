<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::withCount('users')->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate(['role_name' => 'required|string|unique:roles,role_name|max:100']);
        Role::create($request->all());
        return redirect()->route('admin.roles.index')->with('success', 'Role berhasil ditambahkan.');
    }
    
    public function show(Role $role)
    {
        // Eager load relasi users
        $role->load('users');
        return view('admin.roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate(['role_name' => 'required|string|max:100|unique:roles,role_name,' . $role->id]);
        $role->update($request->all());
        return redirect()->route('admin.roles.index')->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy(Role $role)
    {
        if ($role->users()->count() > 0) {
            return redirect()->route('admin.roles.index')->with('error', 'Role tidak bisa dihapus karena masih digunakan oleh user.');
        }

        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Role berhasil dihapus.');
    }
}