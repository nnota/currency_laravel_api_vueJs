<?php
   
namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PersonalAccessTokens;

use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends BaseController
{   protected $success;
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user();
            $success["token"] =  $user->createToken('MyApp')->plainTextToken; 
            $success['name'] =  $user->name;

            
            
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }
    public function logout(Request $request){
        // $user= Auth::user();
        // $user = Auth::user(); 
    //    print $request;
	// Get access token from database
	    //  $token = PersonalAccessToken::findToken($request->token.split("|")[0])->delete();
        auth()->user()->tokens()->delete();
        // print_r($request);
	// Get user data
	    // $userData = $token->tokenable;
        // $accessToken = $user->tokens()->where('id', "9")->delete();
        // $result = Hash::check("14|JF06qM7itoPvjUiV7fcTysloYNickQzMGqCIYms1"->bearerToken(),"26b7fc275fd1320bc62bb988ceeaa5c6d3dbc3a2f828afccae4c1104f7478036");

        // $user =  PersonalAccessTokens::findOrFail($id_token);
        // $user = DB::table('personal_access_tokens')->where('token', 'eUWdKr4W3RpV31YBw9mwBfLeQ1uLZDqacoLaTUIc')->delete();;
        return [
            'message' => 'logout success'
        ];
    }
}
