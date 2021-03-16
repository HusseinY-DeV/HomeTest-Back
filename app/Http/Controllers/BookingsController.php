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
        $book = Patient::find($id);

        if($book->location_id)
        {
            foreach ($request->tests as  $test) {
                $book->test()->attach($test, ['date' => $request->date,"booked_date" => now()]);
            }
        }else {
            return response()->json(["status" => "redirect","response" => "No location was available for this patient"]);
        }
        return response()->json(["status" => "success","response" => "Your requests were submitted successfully !"]);
    }

    public function getMyBookings($id)
    {
        $post = Patient::with(['test'])->where("id",$id)->get()->groupBy("booked_date");
        return response()->json(["status" => "success","response" => $post]);
    }

    public function index()
    {
        $post = Patient::with(['test','location'])->paginate(10);
        return response()->json(["status" => "success","response" => $post]);
    }

    public function show($id)
    {
        $post = Patient::with(['test','location'])->where("id",$id)->get();
        return response()->json(["status" => "success","response" => $post]);
    }

}
