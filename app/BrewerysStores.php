<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrewerysStores extends Model
{
    //
    
    protected $table = 'brewerys_and_stores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

}
