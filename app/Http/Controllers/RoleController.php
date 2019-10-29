<?php namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller {

    const MODEL = "App\Role";

    use RESTActions;

    public function list()
    {
        // $user = Auth::user();
        // if($user->role_id == 1)
            return Role::get();
        // else 
        //     return ['status' => 'no permittion'];
    }

    public function for_id(Request $request)
    {
        $user = Auth::user();
        if($user->role_id == 1) //admin
            return Role::where('id', $request->id)->first();
        else
            return ['status' => 'no permittion'];
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        if($user->role_id == 1) //admin
        {
            $role = Role::create([
                'name' => $request->name,
            ]);

            return $role;
        }
        else
            return ['status' => 'no permittion'];
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if($user->role_id == 1) //admin
        {
            $role = Role::where('id', $request->id)->first();

            $role->name = $request->name;

            $role->save();

            return $role;
        }
        else
            return ['status' => 'no permittion'];
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        if($user->role_id == 1) //admin
        {
            $role = Role::where('id', $request->id)->first();

            $role->delete();

            return ['status' => 'success'];
        }
        else
            return ['status' => 'no permittion'];
    }
}
