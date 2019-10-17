<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model {

    protected $fillable = ["name", "e_-mail", "phone", "phone_city"];

    protected $dates = [];

    public static $rules = [
        "name" => "requuired",
        "e_mail" => "nullable",
        "phone" => "nullable",
        "phone_city" => "nullable",
    ];

    public function user()
    {
        return $this->hasMany("App\User");
    }


}
