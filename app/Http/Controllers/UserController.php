<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\InfoWebsites;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Exceptions\Exception;

class UserController extends Controller
{
    protected
        $info_web;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('role:admin');
        $this->info_web = InfoWebsites::first();
    }
    public function phanquyen($id)
    {
        $user = User::find($id);
        $permission = Permission::orderBy('id', 'DESC')->get();
        $role = Role::orderBy('id', 'DESC')->get();
        $all_column_roles = $user->roles->first();
        $get_permission_via_role = $user->getPermissionsViaRoles();
        $get_permissions = $user->permissions->first();
        return view('admincp.users.phanquyen', compact('user', 'role', 'all_column_roles', 'permission', 'get_permission_via_role', 'get_permissions'))
            ->with('info_websites', $this->info_web);
    }
    public function vaitro($id)
    {
        $role = Role::orderBy('id', 'DESC')->get();
        $user = User::find($id);
        $all_column_roles = $user->roles->first();
        $permission = Permission::orderBy('id', 'DESC')->get();
        return view('admincp.users.vaitro', compact('user', 'permission', 'role', 'all_column_roles'))
            ->with('info_websites', $this->info_web);
    }
    public function insert_roles(Request $request, $id)
    {
        try {
            $data = $request->all();
            $user = User::find($id);
            $user->syncRoles($data['role']);
            $role_id = $user->roles->first()->id;
            return redirect()
                ->back()
                ->with('status', 'Phân vai trò cho user thành công');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Phân vai trò thất bại');
        }
    }
    public function insert_permission(Request $request, $id)
    {
        try {
            $data = $request->all();
            $user = User::find($id);
            $role_id = $user->roles->first()->id;
            $role = Role::find($role_id);
            $role->syncPermissions($data['permission']);
            return redirect()
                ->back()
                ->with('status', 'Phân quyền cho user thành công');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Bạn chưa cấp vai trò cho người dùng');
        }
    }
    public function index()
    {
        // auth()
        //     ->user()
        //     ->assignRole('admin');
        // $user = User::find(1);
        // dd(
        //     auth()
        //         ->user()
        //         ->hasRole('admin'),
        // );
        // if (auth()->user()->assignRole(['admin'])) {
        //     dd("admin");
        // }
        $list_user = User::all();
        // auth()
        //     ->user()
        //     ->givePermissionTo('user');
        // Role::create(['name' => 'user']);
        // Permission::create(['name' => 'public']);
        // $role = Role::create(['name' => 'writer']);
        // $permission = Permission::create(['name' => 'show roles']);
        // $permission->syncRoles($roles);
        // $role = Role::find(1);
        // $permission = Permission::find(8);
        // $role->givePermissionTo($permission);
        // $role->revokePermissionTo($permission);
        // dd(auth()->user());
        // $user =  User::find($id);
        // auth()
        //     ->user()
        //     ->syncRoles(['admin', 'user']);
        return view('admincp.users.index')
            ->with('info_websites', $this->info_web)
            ->with(compact('list_user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admincp.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            $data = $request->all();
            $user = new User();
            $user->password = Hash::make($data['password']);
            $user->email = $data['email'];
            $user->name = $data['name'];
            $user->save();
            return redirect()
                ->back()
                ->with('status', 'Thêm người dùng thành công');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Thêm người thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function insert_add_roles(Request $request)
    {
        try {
            $data = $request->all();
            Role::create(['name' => $data['name_role']]);
            return redirect()
                ->back()
                ->with('status', 'Thêm loại người dùng thành công');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Thêm loại người dùng thất bại');
        }
    }

    public function insert_per_permission(Request $request)
    {
        try {
            $data = $request->all();
            Permission::create(['name' => $data['name_permission']]);
            return redirect()
                ->back()
                ->with('status', 'Thêm quyền thành công');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Thêm quyền thất bại');
        }
    }
}
