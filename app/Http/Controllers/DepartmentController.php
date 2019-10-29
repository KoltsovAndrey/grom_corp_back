<?php namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller {

    const MODEL = "App\Department";

    use RESTActions;

    public function list()
    {
        return Department::get();
    }

    public function for_id(Request $request)
    {
        $user = Auth::user();
        if($user->role_id == 1)
            return Department::where('id', $request->id)->first();
        else
            return ['status' => 'no permittion'];
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        if($user->role_id == 1)
        {
            $dep = Department::create([
                'name' => $request->name,
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'phone_city' => $request->phone_city,
            ]);

            return $dep;
        }
        else
            return ['status' => 'no permittion'];
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if($user->role_id == 1)
        {
            $dep = Department::where('id', $request->id)->first();

            $dep->name = $request->name;
            $dep->full_name = $request->full_name;
            $dep->email = $request->email;
            $dep->phone = $request->phone;
            $dep->phone_city = $request->phone_city;

            $dep->save();

            return $dep;
        }
        else
            return ['status' => 'no permittion'];
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        if($user->role_id == 1)
        {
            $dep = Department::where('id', $request->id)->first();

            $dep->delete();

            return ['status' => 'success'];
        }
        else
            return ['status' => 'no permittion'];
    }
}
