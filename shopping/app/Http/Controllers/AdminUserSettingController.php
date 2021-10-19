<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Log;

class AdminUserSettingController extends Controller
{
    private $user;
    private $role;
    function __construct(User $user,Role $role)
    {
        $this->user=$user;
        $this->role=$role;
    }
    function index() {
        $users = $this->user->latest()->paginate(10);
        return View('admin.user.index',compact('users'));
    }
    function create() {
        $roles =$this->role->all();
        return View('admin.user.add',compact('roles'));
    }
    function store(Request $request) {
        try {
            DB::beginTransaction();
            $user = $this->user->create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$request->password
            ]);
            $user->roles()->attach($request->role_id);
            DB::commit();
            return redirect()->route('users.index');
        }
        catch (\Exception $exception) {
            DB::rollBack();
            Log::error('message'.$exception->getMessage());
        }
    }
    function edit($id) {
        $users = $this->user->find($id);
        $roles = $this->role->all();
        $roleOfUser = $users->roles;
        return View('admin.user.edit',compact('users','roles','roleOfUser'));
    }
    function update($id,Request $request) {
        try {
            DB::beginTransaction();
            $this->user->find($id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$request->password
            ]);
            $user = $this->user->find($id);
            $user->roles()->sync($request->role_id);
            DB::commit();
            return redirect()->route('users.index');
        }
        catch (\Exception $exception) {

            DB::rollBack();
            Log::error('message'.$exception->getMessage());
        }
    }
    function delete($id) {
        try {
            $this->user->find($id)->delete();
            return response()->json([
                'code'=>200,
                'message'=>'success',

            ],200);
        }
        catch (\Exception $ex) {
            Log::error('Message'.$ex->getMessage());
            return response()->json([
                'code'=>500,
                'message'=>'fail',

            ],500);
        }
    }
}
