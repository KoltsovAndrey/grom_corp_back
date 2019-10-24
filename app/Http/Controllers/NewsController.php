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
        $news = News::create([
            'title' => $request->title,
            'text' => $request->text,
            'photo' => $request->photo,
            'user_id' => $request->user_id,
        ]);

        return $news;
    }

    public function update(Request $request)
    {
        $news = News::where('id', $request->id)->first();

        $news->title = $request->title;
        $news->text = $request->text;
        $news->photo = $request->photo;

        $news->save();

        return $news;
    }

    public function delete(Request $request)
    {
        $news = News::where('id', $request->id)->first();

        $news->delete();

        return ['status' => 'success'];
    }
}