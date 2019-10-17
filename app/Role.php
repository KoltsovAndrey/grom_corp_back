<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    protected $fillable = ["name"];

    protected $dates = [];

    public static $rules = [
        "name" => "requuired",
    ];

    public function user()
    {
        return $this->hasMany("App\User");
    }


}
