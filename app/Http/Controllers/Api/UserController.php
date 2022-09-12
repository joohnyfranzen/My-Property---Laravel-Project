<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

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

    public function store(UserRequest $request)
    {
        $data = $request->all();

        if(!$request->has('password') || !$request->get('password')){
            $message = new ApiMessages('Password needed to continue...');
            return response()->json([$message->getMessage(), 401]);
        }

        Validator::make($data, [
            'mobile_phone' => 'required',
            'phone' => 'required',
        ]);
        try{

            $data['password'] = bcrypt($data['password']);
            $user = $this->user->create($data);
            $user->profile()->create(
                [
                    'phone' => $data['phone'],
                    'mobile_phone' => $data['mobile_phone']
                ]
            );
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

    public function update(UserRequest $request, $id)
    {
        $data = $request->all();

        if($request->has('password') || $request->get('password')){
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        Validator::make($data, [
            'profile.mobile_phone' => 'required',
            'profile.phone' => 'required',
        ]);

        try{
            $profile = $data['profile'];
            $profile['social_networks'] = serialize($profile['social_networks']);
            $user = $this->user->findOrFail($id);
            $user->update($data);

            $user->profile()->update($profile);

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
        try{

            $user = $this->user->findOrFail($id);
            $user->delete();
            return response()->json([
                'data' => [
                    'msg' => 'User removed !!!'
                ]
            ], 200);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage(), 401]);
        }
    }
}
