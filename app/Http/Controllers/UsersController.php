<?php namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller {

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
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
        ]);

        return $user;
    }

    public function update(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        $user->name = $request->name;

        $user->save();

        return $user;
    }

    public function delete(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        $user->delete();

        return ['status' => 'success'];
    }

    public function login(Request $request)
    {
        // $this->validate($request, [
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);

        $user = User::where('email', $request->email)->first();

        if(Hash::check($request->password, $user->password)) {
            $token = base64_encode(str_random(64));
            User::where('email', $request->email)->update(['token' => $token]);
            return response()->json(['status' => 'success', 'token' => $token]);
        }
        else {
            return response()->json(['status' => 'error'], 401);
        }
    }

    public function logout()
    {
        $user = Auth::user();

        $user->update(['token' => null]);

        return ['status' => 'logout success'];
    }
}