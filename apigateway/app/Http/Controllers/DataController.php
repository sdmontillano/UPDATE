<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function getData()
    {
        try {
            // Establish connections to both databases
            $db1 = DB::connection('db1');
            $db2 = DB::connection('db2');

            // Query from the first database
            $data1 = $db1->table('tbluser')->get();

            // Query from the second database
            $data2 = $db2->table('tbluser')->get();

            // Combine data from both databases
            $combinedData = [
                'data1' => $data1,
                'data2' => $data2,
            ];

            return response()->json($combinedData);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }

    public function addData(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'username' => 'required|max:20',
                'password' => 'required|max:20',
                'gender' => 'required|in:Male,Female,Gay,Other,Secret',
            ]);

            // Add data to the first database
            $db1 = DB::connection('db1');
            $db1->table('tbluser')->insert([
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'gender' => $request->input('gender'),
            ]);

            // Add data to the second database
            $db2 = DB::connection('db2');
            $db2->table('tbluser')->insert([
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'gender' => $request->input('gender'),
            ]);

            return response()->json(['message' => 'Data added successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }
}
