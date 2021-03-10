<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Tests\AddTestRequest;
use App\Http\Requests\Tests\EditTestRequest;
use App\Test;

class TestsController extends Controller
{

    public function index()
    {
        // This function returns all the tests in the tests table
        $tests = Test::all();
        if($tests)
        {
            return response()->json(["status" => "success","response" => $tests]);
        }
    }

    public function create(AddTestRequest $request)
    {
        // This function will create us a new test
        $test = new Test();
        $test->name = $request->name;
        $test->price = $request->price;
        $test->quantity = $request->quantity;
        $test->save();

        return response()->json(["status" => "success","response" => "Test was added successfully !"]);
    }


    public function edit(EditTestRequest $request,$id)
    {
        // This function will edit an already available test
        $test = Test::findOrFail($id);
        $test->update(["name" => $request->name]);
        $test->update(["price" => $request->price]);
        $test->update(["quantity" => $request->quantity]);

        return response()->json(["status" => "success","response" => "Test was edited successfully"]);
    }

    public function destroy($id)
    {
        // This function will delete a test according to it's id
        $test = Test::findOrFail($id);
        $test->delete();

        return response()->json(["status" => "success","response" => "Test was deleted successfully"]);
    }

}
