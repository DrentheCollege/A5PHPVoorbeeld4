<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Contact extends Model
{
     protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'city',
        'country',
        'job_title',
        'company_id'
    ];

    public function company(){
      return $this->belongsTo(Company::class, 'company_id');
    }

    public static function contactSearch($name) {
      return Contact::where('first_name', 'LIKE', "%$name%")->orWhere('last_name', 'LIKE', "%$name%")->get();
    }
}
