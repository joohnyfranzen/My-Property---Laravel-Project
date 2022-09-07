<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function index()
    {
        $users = $this->user->paginate('10');

        return response()->json($users, 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        try{

            $user = $this->user->create($data);
            return response()->json([
                'data' => [
                    'msg' => 'User registered !!!'
                ]
            ], 200);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage(), 401]);
        }
    }

    public function show($id)
    {
        try{

            $user = $this->user->findOrFail($id);

            return response()->json([
                'data' => [
                    'msg' => $user
                ]
            ], 200);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage(), 401]);
        }

    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        try{

            $user = $this->user->findOrFail($id);
            $user->update($data);
            return response()->json([
                'data' => [
                    'msg' => 'User atualized !!!'
                ]
            ], 200);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage(), 401]);
        }
    }

    public function destroy($id)
    {
        //
    }
}
