<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

 
class OwnAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        // Perform action
        $token = $request->header('token');
        $tokenid = $request->header('tokenid');
        $ath = User::where('remember_token',$token)->where('updated_at',$tokenid)->first();
        if(!$ath){
            return response()->json([
                'code'=>50008,
                'message'=>'Unauthorized'
                ]);
        }
        //$request -> attributes('user',$ath);
        return $next($request);
    }
}