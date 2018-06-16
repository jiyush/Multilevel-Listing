<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [

    	'id',
    	'category',
    	'parentId',
    	'level'

    ];

    public function Childs(){

    	return $this->hasMany('App\Category','parentId');
    }
}
