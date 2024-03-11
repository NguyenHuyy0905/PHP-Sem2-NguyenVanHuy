<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    // Hiển thị danh sách các quyền
    public function index()
    {
        $permissions = Permission::all();
        return response()->json(['permissions' => $permissions]);
    }

    // Tạo mới một quyền
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        $permission = Permission::create([
            'name' => $request->input('name'),
        ]);

        return response()->json(['message' => 'Permission created successfully', 'permission' => $permission]);
    }

    // Cập nhật thông tin của một quyền
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update([
            'name' => $request->input('name'),
        ]);

        return response()->json(['message' => 'Permission updated successfully', 'permission' => $permission]);
    }

    // Xoá một quyền
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return response()->json(['message' => 'Permission deleted successfully']);
    }
}
