<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    private $role;
    private $permission;
    function __construct(Role $role,Permission $permission)
    {
        $this->role=$role;
        $this->permission = $permission;
    }
    function index() {
        $roles = $this->role->latest()->paginate(10);
        return View('admin.role.index',compact('roles'));
    }
    function create() {
        $permissionParents = $this->permission->where('parent_id',0)->get();
        return View('admin.role.add',compact('permissionParents'));
    }
    function store(Request $request) {
        $role = $this->role->create([
            'name'=>$request->name,
            'display_name'=>$request->display_name
        ]);
        $role->permissions()->attach($request->permission_id);
        return redirect()->route('roles.index');
    }
    function edit($id) {
        $permissionParents = $this->permission->where('parent_id',0)->get();
        $role =$this->role->find($id);
        $permissionChecked = $role->permissions()->get();
        return View('admin.role.edit',compact('permissionParents','role','permissionChecked'));
    }
    function update($id,Request $request) {
        $this->role->find($id)->update([
            'name'=>$request->name,
            'display_name'=>$request->display_name
        ]);
        $roles=$this->role->find($id);
        $roles->permissions()->sync($request->permission_id);
        return redirect()->route('roles.index');
    }
    function delete($id) {

    }
}
