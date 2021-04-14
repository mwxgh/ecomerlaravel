<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\DeleteModelTrait;

class AdminRoleController extends Controller
{
    use DeleteModelTrait;
    private $role;
    private $permission;
    public function __construct(Role $role, Permission $permission)
    {
        $this->permission = $permission;
        $this->role = $role;
    }
    public function index()
    {
        $roles= $this->role->latest()->paginate(10);
        return view('admin.role.index',compact('roles'));
    }
    public function create()
    {
        $permissionsParent =$this->permission->where('parent_id',0)->get();
        return view('admin.role.create',compact('permissionsParent'));
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $roleCreate =$this->role->create([
                'name'=>$request->name,
                'display_name'=>$request->display_name
            ]);
            // using permissions eloquent relationship from Role model
            $roleCreate->permissions()->attach($request->permission_id);
            DB::commit();
            return redirect()->route('roles.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message :' . $e->getMessage() . ' --- line :' .$e->getLine());
        }
    }
    public function edit($id)
    {
        $permissionsParent =$this->permission->where('parent_id',0)->get();
        $role = $this->role->find($id);
        $permissionsChecked = $role->permissions;
        return view('admin.role.edit',compact('permissionsParent','role','permissionsChecked'));
    }
    public function update(Request $request, $id)
    {
        $role =$this->role->find($id);
        $role->update([
            'name'=>$request->name,
            'display_name'=>$request->display_name
        ]);

        // using permissions eloquent relationship from Role model
        $role->permissions()->sync($request->permission_id);
        return redirect()->route('roles.index');
    }
    public function delete($id)
    {
        return $this->deleteModelTrait($id,$this->role);
    }
}
