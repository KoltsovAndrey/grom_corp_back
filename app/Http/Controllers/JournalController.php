<?php namespace App\Http\Controllers;

use App\Journal;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class JournalController extends Controller {

    const MODEL = "App\Journal";

    use RESTActions;

    public function list()
    {
        return Journal::get();
    }

    public function for_id(Request $request)
    {
        return Journal::where('id', $request->id)->first();
    }

    public function for_token()
    {

    }

    public function for_user()
    {

    }

    public function login(Request $request)
    {
        $user = User::where('login', $request->login)->first();

        if(Hash::check($request->password, $user->password)) {
            $token = base64_encode(str_random(64));
            
            $journal = Journal::create([
                'user_id' => $user->id,
                'token' => $token,
                'platform' => $request->platform,
                'time_login' => Carbon::now(),
            ]);

            return response()->json(['status' => 'success', 'token' => $token, 'user' => $user, 'journal' => $journal]);
        }
        else {
            return response()->json(['status' => 'error'], 401);
        }
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        $journal = Journal::where([['token', $request->headers->get('token')],['platform', $request->headers->get('platform')]])->first();

        $journal->token = null;
        $journal->time_logout = Carbon::now();

        $journal->save();

        return ['status' => 'logout success'];
    }
}
