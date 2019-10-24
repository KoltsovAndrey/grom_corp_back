<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model {

    protected $fillable = ["title", "text", "photo", "user_id"];

    protected $dates = [];

    public static $rules = [
        "title" => "required",
        "text" => "required",
        "photo" => "required",
        "user_id" => "required",
        "user_id" => "required|numeric",
    ];

    public function user()
    {
        return $this->belongsTo("App\User");
    }


}
