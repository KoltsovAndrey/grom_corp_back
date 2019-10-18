<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model {

    protected $fillable = ["name", "full_name", "email", "phone", "phone_city"];

    protected $dates = [];

    public static $rules = [
        "name" => "requuired",
        "email" => "nullable",
        "phone" => "nullable",
        "phone_city" => "nullable",
    ];

    public function user()
    {
        return $this->hasMany("App\User");
    }


}
