<?php

namespace App;

use Dotenv\Result\Result;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use Illuminatea   \Validation\ValidationException;

use Illuminate\Database\Eloquent\SoftDeletes;

class Items extends Model
{
    //

    use SoftDeletes;

    protected $table = 'items';

    protected $fillable = [
        'name','brewerys_and_stores_id','alc','price','release'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at','updated_at'
    ];  


}
