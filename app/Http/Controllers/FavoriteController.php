<?php

namespace App\Http\Controllers;

use App\Favorite;
use Illuminate\Http\Request;



class FavoriteController extends Controller
{
    public function index(){
       
       
        $checkFavorite = new Favorite();
        
        $favorite_already_exist = $checkFavorite->where('spotify_id', request()->input('spotify_id'))
                                                ->whereNull('deleted_at')->first();

        $user_id_exist = $checkFavorite->where('spotify_id', request()->input('spotify_id'))
                                      ->where('user_id',request()->input('user_id'))->first();

        $favorite_already_deleted = Favorite::onlyTrashed()->where('spotify_id', request()->input('spotify_id'))->first();
         
        if( $user_id_exist && $favorite_already_exist){
            abort(403, 'すでに登録済みです');
            
        }
        else if($favorite_already_deleted){
            
            Favorite::onlyTrashed()->where('spotify_id', request()->input('spotify_id'))->restore();
            
            $favorites = Favorite::where('user_id',request()->input('user_id'))
                                    ->where('spotify_id', request()->input('spotify_id'))->get();
            foreach($favorites as $favorite){
                return response()->json($favorite);
            }
            
        }
        else{
            
            $favorite = new Favorite();
            $favorite->song = request()->input('song');
            $favorite->album = request()->input('album');
            $favorite->artist = request()->input('artist');
            $favorite->jacket = request()->input('jacket');
            $favorite->spotify_id = request()->input('spotify_id');
            $favorite->spotify_url = request()->input('spotify_url');
            $favorite->user_id = request()->input('user_id');
            $favorite->save();
            return $favorite;
        }
    }

    public function get_favorite_music($user_id){
        $favorite = Favorite::where('user_id',$user_id)->get();
        return $favorite;
    }

    public function delete_favorite($id){
        $deleteMusicData = Favorite::findOrFail($id);
        $deleteMusicData->delete();
    }

    //-----public-----

    public function public_index(){
    
        $checkFavorite = new Favorite();

        $favorite_already_exist = $checkFavorite->where('spotify_id', request()->input('spotify_id'))
                                                ->whereNull('deleted_at')->first();

        $userid_exist = $checkFavorite->where('spotify_id', request()->input('spotify_id'))
                                      ->whereNull('user_id')->first();

        $favorite_already_deleted = Favorite::onlyTrashed()->where('spotify_id', request()->input('spotify_id'))->first();
   
        if( $userid_exist && $favorite_already_exist){
            abort(403, 'すでに登録済みです');
            
        }
        else if($favorite_already_deleted){
            
            Favorite::onlyTrashed()->where('spotify_id', request()->input('spotify_id'))->restore();
            $favorites = Favorite::where('spotify_id', request()->input('spotify_id'))->where('user_id',null)->get();
            
            foreach($favorites as $favorite){
                return response()->json($favorite);
            }
        }
        else{
            $favorite = new Favorite();
            $favorite->song = request()->input('song');
            $favorite->album = request()->input('album');
            $favorite->artist = request()->input('artist');
            $favorite->jacket = request()->input('jacket');
            $favorite->spotify_id = request()->input('spotify_id');
            $favorite->spotify_url = request()->input('spotify_url');
            $favorite->user_id = null;
            $favorite->save();
            return $favorite;
        }
        
    }
    public function get_public_music(){
        $favorite = Favorite::where('user_id',null)->get();
        return $favorite;
    }
    public function delete_public_music($id){
        $deleteMusicData = Favorite::findOrFail($id);
        $deleteMusicData->delete();
    } 

  
}
