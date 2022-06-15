<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{

    public function getRouteKeyName()
    {
        return 'slug';
    }


    public $timestamps = false;
    protected $fillable = [
        'title',
        'slug',
        'creator',
        'description',
        'image',
        'date_creation',
        'user_id',
        'category_id'
    ];

    static public function generateSlug($ogStr){
        $baseSlug = Str::of($ogStr)->slug('-') . ''; //oppure->__toString()
        $slug = $baseSlug;
        $_i = 1;
        while(Post::where('slug', $slug)->first()){
            $slug =  "$baseSlug-$_i";
            $_i++;
        }
        return $slug;
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function category(){
        return $this->belongsTo(('App\Category'));
    }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
}
