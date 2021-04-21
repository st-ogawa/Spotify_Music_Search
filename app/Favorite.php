<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class Favorite extends Model
{
    use SoftDeletes;
    protected $guarded = [
        'id'
    ];
    
    public function index(){
     
        $checkFavorite = new Favorite();
 
        $favorite_already_exist = $checkFavorite->where('spotify_id', request()->input('spotify_id'))
                                                ->whereNull('deleted_at')->first();
 
        $favorite_already_deleted = Favorite::onlyTrashed()->where('spotify_id', request()->input('spotify_id'))->first();
       
        if($favorite_already_exist){
            abort(403, 'すでに登録済みです');
            
        }
        else if($favorite_already_deleted){
        
            Favorite::onlyTrashed()->where('spotify_id', request()->input('spotify_id'))->restore();
        }
        else{
            $favorite = new Favorite();
            $favorite->song = request()->input('song');
            $favorite->album = request()->input('album');
            $favorite->artist = request()->input('artist');
            $favorite->jacket = request()->input('jacket');
            $favorite->spotify_id = request()->input('spotify_id');
            $favorite->spotify_url = request()->input('spotify_url');

            $favorite->save();
            return $favorite;
        }
    }
    public function delete($id){
        $deleteMusicData = Favorite::findOrFail($id);
        $deleteMusicData->delete();
    }
 
   
 

}