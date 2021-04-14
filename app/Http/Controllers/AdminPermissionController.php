<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;

class AdminPermissionController extends Controller
{
    public function create()
    {
        return view('admin.permission.create');
    }
    public function store(Request $request)
    {
        // without construct
        $permission = Permission::create([
            'name'=>$request->module_parent,
            'display_name'=>$request->module_parent,
            'parent_id'=>0
        ]);
        foreach ($request->module_child as $value) {
            Permission::create([
                'name' => $value,
                'display_name' => 'able to' . ' ' . $value . ' ' . $request->module_parent,
                'parent_id' => $permission->id,
                'key_code' => $request->module_parent . '_' . $value
            ]);
        }
    }
}
