<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class Favorite extends Model
{
    use SoftDeletes;
    protected $table = 'favorites';
    
}
