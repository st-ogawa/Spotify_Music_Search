<?php

namespace App\Http\Controllers;
use App\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(){
     
       $favorite = new Favorite();
       $favorite->song = request()->input('song');
       $favorite->album = request()->input('album');
       $favorite->artist = request()->input('artist');
       $favorite->jacket = request()->input('jacket');
       $favorite->spotify_id = request()->input('spotify_id');
       $favorite->spotify_url = request()->input('spotify_url');
       
        if($favorite->where('spotify_url',$favorite->spotify_url)->exists()){
            abort(403, 'すでに登録済みです');
            
        }
        else{
            if(Favorite::onlyTrashed()->whereNotNull('id')->get()){
                Favorite::onlyTrashed()->whereNotNull('id')->restore();
            }
            $favorite->save();
        }
    }

    public function getMusicData(){
        $favorite = Favorite::all();
        return $favorite;    
    }

    public function deleteMusicData($id){
        $deleteMusicData = Favorite::findOrFail($id);
        $deleteMusicData->delete();
    }

  
}
