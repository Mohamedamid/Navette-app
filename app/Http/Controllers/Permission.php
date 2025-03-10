<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission as Permissions;
class Permission extends Controller
{
    public function index()
    {
        $permissions = Permissions::all();
        return view('permission', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $permission = new Permissions();
        $permission->name = $request->name;
        $permission->description = $request->description;
        $permission->save();

        return redirect()->route('indexPermission');
    }

    public function destroy($id)
    {
        $permission = Permissions::findOrFail($id);
        $permission->delete();

        return redirect()->route('indexPermission');
    }

    public function edit($id)
    {
        $permissions = Permissions::findOrFail($id);
        return view('editPermission', compact('permissions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $permission = Permissions::findOrFail($id);
        $permission->name = $request->name;
        $permission->description = $request->description;
        $permission->save();

        return redirect()->route('indexPermission');
    }

}
