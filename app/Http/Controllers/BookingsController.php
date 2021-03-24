<?php

namespace App\Http\Controllers;

use App\Bookings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Patient;

class BookingsController extends Controller
{
    public function book(Request $request,$ID,$id)
    {
        $book = Patient::find($ID);
        if($book->location_id)
        {

            DB::update('UPDATE tests SET tests.quantity = tests.quantity-1 WHERE tests.id = ?', [$id]);
            $book->test()->attach($id, ['date' => now(),"booked_date" => now(), "checked_out" => "false", "delivery_status" => "none"]);

        }
        else {
            return response()->json(["status" => "redirect","response" => "No location was available for this patient"]);
        }

        return response()->json(["status" => "success","response" => "Your requests were submitted successfully !"]);
    }


    public function deliver($id)
    {
        DB::update('UPDATE patient_test SET patient_test.checked_out = "true" WHERE patient_test.patient_id = ? AND patient_test.checked_out = "false"', [$id]);

        return response()->json(["status" => "success","response" => "Delivery is booked successfully !"]);
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

    public function deleteBook($id,$tId)
    {
        $bookings = Bookings::findOrFail($id);
        DB::update('UPDATE tests set tests.quantity = tests.quantity+1 WHERE tests.id = ?', [$tId]);
        $bookings->delete();
        return response()->json(["status" => "success","response" => "deleted"]);
    }

    public function adminDeliver($id)
    {
        DB::update('UPDATE patient_test SET patient_test.delivery_status = "pending" WHERE patient_test.patient_id = ?', [$id]);
        return response()->json(["status" => "success","response" => "Delivery on the way"]);
    }

    public function decline($id) {

        DB::delete('DELETE FROM patient_test WHERE patient_test.patient_id = ?', [$id]);

        return response()->json(["status" => "success","response" => "Booking deleted !"]);

    }

    public function success($id)
    {
        DB::update('UPDATE patient_test SET patient_test.delivery_status = "delivered" WHERE patient_test.patient_id = ?', [$id]);
        return response()->json(["status" => "success","response" => "Delivery on the way"]);
    }


}
