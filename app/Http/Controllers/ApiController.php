<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Facades\JWTAuth;
use Laravel\Passport\HasApiTokens;




class ApiController extends Controller
{
    ////JWT Registeration Method
    public function register(Request $req){
        //validate data
        
        $data = $req->only('name','email','password');
        $validator = validator::make($data,[
            'name' => 'required|String',
            'email'=>'required|email|unique:lg_login',
            'password'=>'required|String|min:6',

        ]);
        if($validator->fails()){
            return response()->json([
                'error'=>$validator->errors()
                ],200);
        }

      $user = User::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'password'=>bcrypt($req->password)
        ]);
       
        //User Created return success response
        if($user)
        {
        
        return response()->json([
            'success'=>true,
            'code'=>1,
            'message'=>'User Created Successfully',
        
            ],Response::HTTP_OK);   
        
        }
    }


    public function login(Request $req){
        //validate data
        $credentials = $req->only('email','password');
        
        //valid credential
        $validator = validator::make($credentials,[
            'email'=>'required|email ',
            'password'=>'required|String|min:6|max:50',

        ]);

        if($validator->fails()){
            return response()->json([
                'error'=>$validator->errors()
                ],200);
        }

        //IF request is valid created token
        try 
        {
            if (! $token = JWTAuth::attempt($credentials))
            {
                return response()->json([
                'success'=>false,
                'message'=>'Login credentials are invalid',
            ],400);
        }
        }
        catch(JWTException $e)
        {
            return $credentials;
            return response()->json([
             'success'=>false,
             'message'=>'Could not create token',
            ],500);
        }

          return response()->json([
           'success'=> true,
           'code'=>1,
           'message'=>'User login successfully',
           'token'=> $token,
           'user_details' => $credentials,
           
          ]);
        
        

      
    }


}
