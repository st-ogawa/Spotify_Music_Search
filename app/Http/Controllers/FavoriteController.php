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
       $favorite->save();
       return 'OK';
    }

    public function getMusicData(){
        $favorites = Favorite::all();
        $res = [];
        foreach($favorites as $favorite){
            $res[] = [
                "song" => $favorite->song,
                "album" => $favorite->album,
                "artist" => $favorite->artist,
                "jacket" => $favorite->jacket,
                "spotify_id" => $favorite->spotify_id,
                "spotify_url" => $favorite->spotify_url,
            ];
            return $res;
        }
        
    }
}
