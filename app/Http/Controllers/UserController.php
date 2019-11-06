<?php namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller {

    const MODEL = "App\User";

    use RESTActions;

    public function list()
    {
        // return User::with('role', 'post', 'department')->get();

        // $users = User::get();
        // foreach ($users as $user) {
        //     $user->role_id = $user->role->name;
        //     $user->post_id = $user->post->name;
        //     $user->department_id = $user->department->name;
        // }
        // return $users;

        return DB::table('users')
                    ->select('users.id', 'users.first_name', 'users.second_name', 'users.middle_name', 'users.login', 'departments.name as department', 'posts.name as post', 'roles.name as role', 'users.email', 'users.phone', 'users.phone_city', 'users.photo')
                    ->leftJoin('departments', 'users.department_id', 'departments.id')
                    ->leftJoin('posts', 'users.post_id', 'posts.id')
                    ->leftJoin('roles', 'users.role_id', 'roles.id')
                    ->get();
    }

    public function for_id(Request $request)
    {
        $user = Auth::user();
        if($user->role_id == 1)
            return User::where('id', $request->id)->first();
        else
            return ['status' => 'no permittion'];
    }

    public function detail(Request $request)
    {
        return Auth::user();
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        if($user->role_id == 1)
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
        else
            return ['status' => 'no permittion'];
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if($user->role_id == 1)
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
        else
            return ['status' => 'no permittion'];
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        if($user->role_id == 1)
        {
            $user = User::where('id', $request->id)->first();

            $user->delete();

            return ['status' => 'success'];
        }
        else
            return ['status' => 'no permittion'];
    }

    public function name_list(Request $request)
    {
        $users_raw = DB::table('users')
                ->select('first_name', 'second_name', 'middle_name')
                ->get();

        $users = [];

        foreach ($users_raw as $user) {
            $users += ['name' => $user->second_name.' '.mb_strtoupper(substr($user->first_name, 0, 2)).'.'.mb_strtoupper(substr($user->middle_name, 0, 2)).'.'];
        }

        return $users;
    }
}