<?php namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Intervention\Image\Facades\Image;

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
            // Storage::disk('public')->setVisibility('img/'.$news->photo, 'public');
            // $path = './../storage/app/public/img/'.$news->photo;
            // $news->photo = Image::make($path)->response();
            // $news->photo = (string)(Storage::disk('public')->getVisibility('img/'.$news->photo));
            $news->photo = url('/news/get_image/'.$news->id);
        }

        return $news_ar;
    }

    public function get_image(Request $request)
    {
        $path = './../storage/app/public/img/'.News::find($request->news_id)->photo;
        // dd($path);
        return Image::make($path)->response();
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
                'photo' => $request->file('photo')->move('./../storage/app/public/img', $user->id.'_'.str_random(5).'.'.$request->file('photo')->getClientOriginalExtension()),
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