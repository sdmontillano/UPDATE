<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use App\Models\User;
use GuzzleHttp\Client;
use App\Exceptions\NoUserInputException;
use App\Exceptions\NoPasswordInputException;
use App\Exceptions\InvalidInputException;

class UserController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $users = User::all(['id', 'username', 'password', 'gender']);
        return response()->json($users);
    }

    public function add(Request $request)
    {
        try {
            $rules = [
                'username' => 'required|max:20',
                'password' => 'required|max:20',
                'gender' => 'required|in:Male,Female,Gay,Other,Secret',
            ];
            
            $this->validate($request, $rules);
            
            // Check if user input is provided
            if (!$request->filled('username') || !$request->filled('password') || !$request->filled('gender')) {
                throw new NoUserInputException('Username, password, and gender are required');
            }

            // Check if password input is provided
            if (!$request->filled('password')) {
                throw new NoPasswordInputException('Password is required');
            }

            // Check if username is not "user"
            if ($request->input('username') === 'user') {
                throw new InvalidInputException('Username "user" is not allowed');
            }

            $user = User::create($request->all());

            return response()->json($user, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to add user: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'username' => 'max:20',
            'password' => 'max:20',
        ];
        $this->validate($request, $rules);
        $user = User::findOrFail($id);

        $user->fill($request->only(['username', 'password']));

        if ($user->isClean()) {
            return response()->json(['error' => 'At least one value must change'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->save();

        return response()->json($user);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json($user);
    }

    public function deleteAllUsers()
    {
        DB::table('users')->delete();
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1');

        return response()->json(['message' => 'All users deleted successfully']);
    }

    //new add update
}
