<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Permission;
use Auth;

use App\Role;
use Illuminate\Http\Request;
use \Session;
use Mail;
 
class RoleController extends Controller
{
    /**
     * Variable to model
     *
     * @var role
     */
    protected $model;

    /**
     * Create instance of controller with Model
     *
     * @return void
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $roles = Role::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
        $active = Role::where('active_flag', 1);
        return view('roles.index', compact('roles', 'active'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $permissions = Permission::where('active_flag', 1)->orderBy('name')->pluck('name', 'id');
        return view('roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request, User $user)
    {
        $role = new Role();

        $role->display_name = ucfirst($request->input("display_name"));
        $role->name = str_slug($request->input("name"), "-");
        $role->description = ucfirst($request->input("description"));
        $role->active_flag = 1;
        //$role->author_id = $request->user()->id;

        $this->validate($request, [
                     'name' => 'required|max:255|unique:roles',
                     'display_name' => 'required',
                     'permissions' => 'required'
             ]);

        $role->save();
        $permissions = Permission::whereIn('id', $request->input("permissions"))->get();
        $role->attachPermissions($permissions);

        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', "The Role \"<a href='roles/$role->slug'>" . $role->name . "</a>\" was Created.");

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Role $role)
    {
        //$role = $this->model->findOrFail($id);
        

        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Role $role)
    {
        $role = $this->model->findOrFail($role->id);
        $permissions = Permission::where('active_flag', 1)->orderBy('name')->pluck('name', 'id');
/*      $roles = $role->perms->pluck('id');
        print_r($roles);exit();
*/      return view('roles.edit', compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function update(Request $request, Role $role, User $user)
    {

        $role->display_name = ucfirst($request->input("display_name"));
        $role->name = str_slug($request->input("name"), "-");
        $role->description = ucfirst($request->input("description"));
        $role->active_flag = 1;//change to reflect current status or changed status
        //$role->author_id = $request->user()->id;

        $this->validate($request, [
                     'name' => 'required|max:255|unique:roles,name,' . $role->id,
                     'description' => 'required',
                     'permissions' => 'required'

             ]);

        $role->save();

        $role->perms()->sync($request->input("permissions"));

        Session::flash('message_type', 'warning');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', "The Role \"<a href='roles/$role->slug'>" . $role->name . "</a>\" was Updated.");

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Role $role)
    {
        $role->active_flag = 0;
        $role->save();

        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'hide');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'The Role ' . $role->name . ' was De-Activated.');

        return redirect()->route('roles.index');
    }

    /**
     * Re-Activate the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function reactivate(Role $role)
    {
        $role->active_flag = 1;
        $role->save();

        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'The Role ' . $role->name . ' was Re-Activated.');

        return redirect()->route('roles.index');
    }
}
