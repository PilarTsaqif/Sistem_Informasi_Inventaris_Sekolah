<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function index()
    {
        if (!Gate::allows('is-toolman')) abort(403);
        
        // Menggunakan withCount untuk efisiensi menghitung user
        $roles = Role::withCount('users')->latest('id')->paginate(10);
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        if (!Gate::allows('is-toolman')) abort(403);
        return view('roles.create');
    }

    public function store(Request $request)
    {
        if (!Gate::allows('is-toolman')) abort(403);

        $request->validate([
            'role_name' => 'required|string|max:100|unique:roles,role_name',
        ], [
            'role_name.unique' => 'Nama role ini sudah ada.'
        ]);

        Role::create($request->all());

        return redirect()->route('roles.index')->with('success', 'Role baru berhasil ditambahkan.');
    }

    public function show(Role $role)
    {
        // Tampilan show tidak diperlukan untuk data sederhana ini
        return redirect()->route('roles.index');
    }

    public function edit(Role $role)
    {
        if (!Gate::allows('is-toolman')) abort(403);
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        if (!Gate::allows('is-toolman')) abort(403);

        $request->validate([
            'role_name' => 'required|string|max:100|unique:roles,role_name,' . $role->id,
        ], [
            'role_name.unique' => 'Nama role ini sudah ada.'
        ]);

        $role->update($request->all());

        return redirect()->route('roles.index')->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy(Role $role)
    {
        if (!Gate::allows('is-toolman')) abort(403);
        
        // Mencegah penghapusan role krusial
        if (in_array(strtoupper($role->role_name), ['TOOLMAN', 'ADMINISTRATOR'])) {
             return redirect()->route('roles.index')->with('error', 'Role sistem tidak dapat dihapus.');
        }

        // Mencegah penghapusan role jika masih digunakan oleh user
        if ($role->users()->exists()) {
            return redirect()->route('roles.index')->with('error', 'Role tidak dapat dihapus karena masih digunakan oleh user.');
        }

        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role berhasil dihapus.');
    }
}