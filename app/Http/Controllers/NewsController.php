<?php namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class NewsController extends Controller {

    const MODEL = "App\User";

    use RESTActions;

    public function list()
    {
        // return News::get();

        return DB::table('news')
                ->select('news.id', 'news.title', 'news.text', 'news.photo', 'users.second_name', 'users.first_name', 'users.middle_name', 'news.created_at')
                ->leftJoin('users', 'news.user_id', 'users.id')
                ->get();
    }

    public function for_id(Request $request)
    {
        return News::where('id', $request->id)->first();
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        $file = null;
        $file = $request->file('photo')->isValid();
        return $file;
        // if($user->role_id == 1 || $user->role_id == 2)
        // {
        //     $news = News::create([
        //         'title' => $request->title,
        //         'text' => $request->text,
        //         'photo' => '',
        //         'user_id' => $request->user_id,
                
        //     ]);

        //     return $news;
        // }
        // else
        //     return ['status' => 'no permittion'];
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