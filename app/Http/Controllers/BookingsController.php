<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Test;
use App\Patient;

class BookingsController extends Controller
{
    public function book(Request $request,$ID,$id)
    {
        $book = Patient::find($ID);
        if($book->location_id)
        {

            DB::update('UPDATE tests set tests.quantity = tests.quantity-1 WHERE tests.id = ?', [$id]);
            $book->test()->attach($id, ['date' => now(),"booked_date" => now()]);

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
