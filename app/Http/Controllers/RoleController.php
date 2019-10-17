<?php namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller {

    const MODEL = "App\Role";

    use RESTActions;

    public function list()
    {
        return Role::get();
    }

    public function for_id(Request $request)
    {
        return Role::where('id', $request->id)->first();
    }

    public function create(Request $request)
    {
        $role = Role::create([
            'name' => $request->name,
        ]);

        return $role;
    }

    public function update(Request $request)
    {
        $role = Role::where('id', $request->id)->first();

        $role->name = $request->name;

        $role>save();

        return $role;
    }

    public function delete(Request $request)
    {
        $role = Role::where('id', $request->id)->first();

        $role->delete();

        return ['status' => 'success'];
    }
}
