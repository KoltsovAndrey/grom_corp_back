<?php namespace App\Http\Controllers;

use App\News;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller {

    const MODEL = "App\User";

    use RESTActions;

    public function list()
    {
        return News::get();
    }

    public function for_id(Request $request)
    {
        return News::where('id', $request->id)->first();
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        if($user->role_id == 1 || $user->role_id == 2)
        {
            $news = News::create([
                'title' => $request->title,
                'text' => $request->text,
                'photo' => $request->photo,
                'user_id' => $request->user_id,
            ]);

            return $news;
        }
        else
            return ['status' => 'no permittion'];
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if($user->role_id == 1 || $user->role_id == 2)
        {
            $news = News::where('id', $request->id)->first();

            $news->title = $request->title;
            $news->text = $request->text;
            $news->photo = $request->photo;

            $news->save();

            return $news;
        }
        else
            return ['status' => 'no permittion'];
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        if($user->role_id == 1 || $user->role_id == 2)
        { 
            $news = News::where('id', $request->id)->first();

            $news->delete();

            return ['status' => 'success'];
        }
        else
            return ['status' => 'no permittion'];
    }
}