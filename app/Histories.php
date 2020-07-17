<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Histories extends Model
{
    //
    protected $table = 'histories';

    protected $fillable = [
        'user_id','items_id','note','rate'
    ];


}   
