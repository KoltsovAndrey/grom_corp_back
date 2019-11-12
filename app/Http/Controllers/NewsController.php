<?php namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class NewsController extends Controller {

    const MODEL = "App\User";

    use RESTActions;

    public function list()
    {
        // return News::get();

        $news_ar = DB::table('news')
                ->select('news.id', 'news.title', 'news.text', 'news.photo', 'users.second_name', 'users.first_name', 'users.middle_name', 'news.created_at')
                ->leftJoin('users', 'news.user_id', 'users.id')
                ->get();

        foreach ($news_ar as $news) {
            // dd(Carbon::parse($news->created_at)->toArray());
            $news->created_at = Carbon::parse($news->created_at)->format('d.m.Y'); //H:i:s
            // $news->photo = response()->download($news->photo);
        }

        return $news_ar;
    }

    public function for_id(Request $request)
    {
        $news = News::where('id', $request->id)->first();

        // $news->photo = response()->download($news->photo);
        
        return $news;
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        if($user->role_id == 1 || $user->role_id == 2)
        {
            $news = News::create([
                'title' => $request->title,
                'text' => $request->text,
                'photo' => $request->file('photo')->move('./../storage/app/img', $user->id.'_'.str_random(5).'.'.$request->file('photo')->getClientOriginalExtension()),
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