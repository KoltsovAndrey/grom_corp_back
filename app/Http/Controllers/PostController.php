<?php namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {

    const MODEL = "App\Post";

    use RESTActions;

    public function list()
    {
        return Post::get();
    }

    public function for_id(Request $request)
    {
        $user = Auth::user();
        if($user->role_id == 1)
            return Post::where('id', $request->id)->first();
        else
            return ['status' => 'no permittion'];
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        if($user->role_id == 1)
        {
            $post = Post::create([
                'name' => $request->name,
            ]);

            return $post;
        }
        else
            return ['status' => 'no permittion'];
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if($user->role_id == 1)
        {
            $post = Post::where('id', $request->id)->first();

            $post->name = $request->name;

            $post->save();

            return $post;
        }
        else
            return ['status' => 'no permittion'];
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        if($user->role_id == 1)
        {
            $post = Post::where('id', $request->id)->first();

            $post->delete();

            return ['status' => 'success'];
        }
        else
            return ['status' => 'no permittion'];
    }
}
