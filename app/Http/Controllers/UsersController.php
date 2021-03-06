<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admins\AddAdminRequest;
use App\Http\Requests\Admins\UpdateAdminRequest;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{


    public function create(AddAdminRequest $request)
    {
        // This function will create an admin
        $admin = new User();
        $admin->username = $request->username;
        $admin->password = $request->password;
        $admin->save();

        if($admin)
        {
            return response()->json(['status'=>"success","response" => "User was added successfully !"],200);
        }
    }

    public function index()
    {
        // This function will get us all the admins in the database
       $admins = User::paginate(5);
       if($admins)
       {
        return response()->json(["status"=>"success","response" => $admins],200);
       }else {
        return response()->json(["status"=>"failure","response" =>"Could not get users" ],404);
       }
    }

    public function show($id)
    {
        // This function will get us a user according to his id
        $admin = User::findOrFail($id);
        if($admin)
        {
            return response()->json(["status"=>"success","response" => $admin],200);
        }else {
            return response()->json(["status"=>"failure","response" => "Could not get admin"],404);
        }
    }


    public function edit($id,UpdateAdminRequest $request)
    {
        // This function will let us delete a user according to his id
        DB::update('UPDATE users SET password = ? WHERE users.id = ?', [bcrypt($request->password),$id]);
        return response()->json(["status"=>"success","response" => "User was updated successfully !"],200);
    }

    public function destroy($id)
    {
        // This function will let us delete a user according to his id
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(["status"=>"success","response" => "User was deleted successfully !"],200);
    }

    public function login()
    {
        // This function checks if a user exist so we can login him in with a token
        $credentials = request(['username', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(["status"=>"success","response" =>$this->respondWithToken($token)],200);
    }

    public function logout()
    {
        // This function checks if a user exist so we can log him out and terminate the token
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        // This function will send us the token with a payload
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60,
            'id' => auth()->id()
        ]);
    }

}
