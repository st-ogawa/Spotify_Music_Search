<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Favorite extends Model
{
    use SoftDeletes;

    protected $favorite = 'favrites';

    protected $guarded = [
        'id'
    ];
    
}
