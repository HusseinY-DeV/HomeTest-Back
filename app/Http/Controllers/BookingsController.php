<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Test;
use App\Patient;

class BookingsController extends Controller
{
    public function book(Request $request,$id)
    {
        $patient_table = DB::insert('INSERT INTO patient_test (test_id,patient_id,booked_date,date) values (?, ?, ?,?)', [$request->test,$id,now(),$request->date]);

        return response()->json(["status" => "success","response" => "Booking was added"]);
    }

    public function getMyBookings($id)
    {
        $post = Patient::with(['test'])->where("id",$id)->get()->groupBy("booked_date");
        return response()->json(["status" => "success","response" => $post]);
    }

    public function index()
    {
        $post = Patient::with(['test'])->paginate(10);
        return response()->json(["status" => "success","response" => $post]);
    }

}
