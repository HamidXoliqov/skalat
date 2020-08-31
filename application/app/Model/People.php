<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $table = 'tbl_people';

    protected $fillable = [
        'firstname',
        'mi',
        'lastname',
        'age',
        'gender',
        'emailaddress',
        'civilstatus',
        'height',
        'weight',
        'mobileno',
        'birthday',
        'nationalid',
        'birthplace',
        'homeaddress',
        'employmentstatus',
        'employmenttype',
        'avatar',
        'start_date',
        'end_date',
        'price',
    ];
}
