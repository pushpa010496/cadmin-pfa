<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Permission;
use Illuminate\Http\Request;
use \Session;

class PermissionController extends Controller
{
    /**
     * Variable to model
     *
     * @var permission
     */
    protected $model;

    /**
     * Create instance of controller with Model
     *
     * @return void
     */
    public function __construct(Permission $model)
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
        $permissions = Permission::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
        $active = Permission::where('active_flag', 1);
        return view('permissions.index', compact('permissions', 'active'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request, User $user)
    {
        $permission = new Permission();

        $permission->name = str_slug($request->input("name"), "_");
        $permission->display_name = ucfirst($request->input("display_name"));
        $permission->description = ucfirst($request->input("description"));
        $permission->active_flag = 1;
        //$permission->author_id = $request->user()->id;

        $this->validate($request, [
                     'name' => 'required|max:255|unique:permissions',
                     'display_name' => 'required|max:255',
                     'description' => 'required'
             ]);

        $permission->save();

        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', "The Permission \"<a href='permissions/$permission->slug'>" . $permission->name . "</a>\" was Created.");

        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Permission $permission)
    {
        //$permission = $this->model->findOrFail($id);

        return view('permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Permission $permission)
    {
        //$permission = $this->model->findOrFail($id);

        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function update(Request $request, Permission $permission, User $user)
    {
        $permission->name = str_slug($request->input("name"), "_");
        $permission->display_name = ucfirst($request->input("display_name"));
        $permission->description = ucfirst($request->input("description"));

        $permission->active_flag = 1;//change to reflect current status or changed status
        
        $this->validate($request, [
                     'name' => 'required|max:255|unique:permissions,name,' . $permission->id,
                     'description' => 'required'
             ]);

        $permission->save();

        Session::flash('message_type', 'warning');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', "The Permission \"<a href='permissions/$permission->slug'>" . $permission->name . "</a>\" was Updated.");

        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Permission $permission)
    {
        $permission->active_flag = 0;
        $permission->save();

        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'hide');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'The Permission ' . $permission->name . ' was De-Activated.');

        return redirect()->route('permissions.index');
    }

    /**
     * Re-Activate the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function reactivate(Permission $permission)
    {
        $permission->active_flag = 1;
        $permission->save();

        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'The Permission ' . $permission->name . ' was Re-Activated.');

        return redirect()->route('permissions.index');
    }
}
