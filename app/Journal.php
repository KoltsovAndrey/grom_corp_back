<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model {

    protected $fillable = ["user_id", "token", "platform", "time_login", "time_logout"];

    protected $dates = ['time_login', 'time_logout'];

    public static $rules = [
        "user_id" => "required",
        "token" => "required",
        "platform" => "required",
        "time_login" => "required",
        "time_logout" => "nullable",
    ];

    public function user()
    {
        return $this->belongsTo("App\User");
    }


}
