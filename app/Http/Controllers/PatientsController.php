<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EditPatientRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Patients\RegisterPatientRequest;
use App\Http\Requests\AddLocationRequest;
use App\Patient;
use App\Location;
use Illuminate\Support\Facades\DB;


class PatientsController extends Controller
{



    public function addLocation(AddLocationRequest $request,$id)
    {
        $location = new Location();
        $location->city = $request->city;
        $location->street = $request->street;
        $location->building = $request->building;
        $location->save();

        DB::update('UPDATE patients SET location_id = ? WHERE patients.id = ?', [$location->id,$id]);

        return response()->json(["status" => "success","response" => "Location was added successfully !"]);

    }

    public function editPhone(Request $request,$id)
    {
        // This function lets patient user to edit his or her account
        if(strlen($request->phone_number) != 8)
        {
            return response()->json(["status" => "fail", "response" => "Phone number is invalid"]);
        }
        DB::update('UPDATE patients SET patients.phone_number = ? WHERE patients.id = ?', [$request->phone_number,$id]);
        return response()->json(["status" => "success","response" => "Your number was added successfully"]);
    }

    public function editPassword(EditPatientRequest $request,$id)
    {
        // This function lets patient user to edit his or her account
        DB::update('UPDATE patients SET patients.password = ? WHERE patients.id = ?', [bcrypt($request->password),$id]);
        return response()->json(["status" => "success","response" => "Your password was added successfully"]);
    }

    public function register(RegisterPatientRequest $request)
    {
        $patient = new Patient();
        $patient->first_name = $request->first_name;
        $patient->last_name = $request->last_name;
        $patient->username = $request->username;
        $patient->password = $request->password;
        $patient->phone_number = $request->phone_number;
        $patient->location_id = 0;
        $patient->save();
        $token = Auth::guard('patient')->login($patient);
        return response()->json(["status" => "success","response" => $this->respondWithToken($token)]);
    }

    public function login()
    {
        // This function checks if a user exist so we can login him in with a token
        $credentials = request(['username', 'password']);
        if (!$token = Auth::guard('patient')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(["status" => "success","response" => $this->respondWithToken($token)]);
    }

    public function logout()
    {
        // This function checks if a user exist so we can log him out and terminate the token
        Auth::guard('patient')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        // This function will send us the token with a payload
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => Auth::guard('patient')->factory()->getTTL() * 60,
            'id' => Auth::guard('patient')->id()
        ]);
    }
}
