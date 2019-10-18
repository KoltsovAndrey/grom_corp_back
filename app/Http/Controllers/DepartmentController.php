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
        return Department::where('id', $request->id)->first();
    }

    public function create(Request $request)
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

    public function update(Request $request)
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

    public function delete(Request $request)
    {
        $dep = Department::where('id', $request->id)->first();

        $dep->delete();

        return ['status' => 'success'];
    }
}
