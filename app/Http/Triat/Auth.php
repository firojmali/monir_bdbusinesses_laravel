<?php

namespace App\Http\Triat;

use App\Models\User;



class Auth
{
    /**
     * Display a listing of the resource.
     */
    public function me()
    {
        $token = $request->header('token');
        $tokenid = $request->header('tokenid');
        $ath = User::where('remember_token',$token)->where('updated_at',$tokenid)->first();
        if(!$ath)return ['user'=>$ath,];
        else return['user'=>null];
    }

}
