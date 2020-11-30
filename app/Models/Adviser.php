<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Adviser extends Model
{
    protected $fillable = [
        "name",
        "cedula",
        "phone",
        "birthday",
        "gender",
        "client",
        "headquarter",
        "user_id",
        "age",
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
