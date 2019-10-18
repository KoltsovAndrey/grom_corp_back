<?php namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller {

    const MODEL = "App\Post";

    use RESTActions;

    public function list()
    {
        return Post::get();
    }

    public function for_id(Request $request)
    {
        return Post::where('id', $request->id)->first();
    }

    public function create(Request $request)
    {
        $post = Post::create([
            'name' => $request->name,
        ]);

        return $post;
    }

    public function update(Request $request)
    {
        $post = Post::where('id', $request->id)->first();

        $post->name = $request->name;

        $post->save();

        return $post;
    }

    public function delete(Request $request)
    {
        $post = Post::where('id', $request->id)->first();

        $post->delete();

        return ['status' => 'success'];
    }
}
