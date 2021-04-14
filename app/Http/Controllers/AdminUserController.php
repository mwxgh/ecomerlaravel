<?php

namespace App\Http\Controllers;

use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminUserController extends Controller
{
    use DeleteModelTrait;
    private $user;
    private $role;
    public function __construct(User $user,Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }
    public function index()
    {
        $users = $this->user->latest()->paginate(10);
        return view('admin.user.index',compact('users'));
    }
    public function create()
    {
        $roles = $this->role->all();
        return view('admin.user.create',compact('roles'));
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = $this->user->create([
                'name' => $request->name,
                'email' =>$request->email,
                'password'=> Hash::make($request->password),
            ]);

            $roleIds = $request->role_id;
            //using roles eloquent relationship from model User
            $user->roles()->attach($roleIds);

            // without eloquent relationship from models
            // foreach ($roleIds as $roleItem) {
            //     DB::table('role_user')->insert([
            //         'role_id'=> $roleItem,
            //         'user_id'=>$user->id
            //     ]);
            // }
            DB::commit();
            return redirect()->route('users.index');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message :' . $e->getMessage() . ' --- line :' .$e->getLine());
        }
    }
    public function edit($id)
    {
        $user = $this->user->find($id);
        $roles= $this->role->all();
        // using roles eloquent relationship from User model
        $roleOfUser = $user->roles;
        return view('admin.user.edit',compact('roles','user','roleOfUser'));
    }
    public function update(Request $request,$id)
    {
        try {
            DB::beginTransaction();
            $this->user->find($id)->update([
                'name' => $request->name,
                'email' =>$request->email,
                'password'=> Hash::make($request->password),
            ]);
            // above query return boolean
            // below query return string user by id
            $user = $this->user->find($id);
            // assign variables
            $roleIds = $request->role_id;
            //using roles eloquent relationship from model User
            $user->roles()->sync($roleIds);
            DB::commit();
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message :' . $e->getMessage() . ' --- line :' .$e->getLine());
        }
    }
    public function delete($id)
    {
        return $this->deleteModelTrait($id,$this->user);
    }
}
