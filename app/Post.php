<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    protected $fillable = ["name"];

    protected $hidden = ["created_at", "updated_at"];

    protected $dates = [];

    public static $rules = [
        "name" => "required",
    ];

    public function user()
    {
        return $this->hasMany("App\User");
    }


}
