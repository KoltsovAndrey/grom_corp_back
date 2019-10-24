<?php namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {

    const MODEL = "App\User";

    use RESTActions;

    public function list()
    {
        return User::get();
    }

    public function for_id(Request $request)
    {
        return User::where('id', $request->id)->first();
    }

    public function detail(Request $request)
    {
        // dd($request->headers->get('token'));
        return Auth::user();
    }

    public function create(Request $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'middle_name' => $request->middle_name,
            'login' => $request->login,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'post_id' => $request->post_id,
            'department_id' => $request->department_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'phone_city' => $request->phone_city,
            'photo' => $request->photo,
        ]);

        return $user;
    }

    public function update(Request $request)
    {
        $user = User::where('id', $request->id)->first();

        $user->first_name = $request->first_name;
        $user->second_name = $request->second_name;
        $user->middle_name = $request->middle_name;
        $user->login = $request->login;
        // $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->post_id = $request->post_id;
        $user->department_id = $request->department_id;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->phone_city = $request->phone_city;
        $user->photo = $request->photo;

        $user->save();

        return $user;
    }

    public function delete(Request $request)
    {
        $user = User::where('id', $request->id)->first();

        $user->delete();

        return ['status' => 'success'];
    }
}