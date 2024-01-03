<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function login(Request $request){
        try{

            $this->validate($request, [
                'email' => 'required|string|email|lowercase',
                'password' => 'required|string|min:8',
            ]);
            
            $user = User::where('email', $request->email)->first();
            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    $token = $user->createToken('authToken')->plainTextToken;

                    return response()->json(['status' => 'success', 'msg' => 'Login Success.', 'token' => $token]);
                } else {
                    return response()->json(['status' => 'failed', 'msg' => 'Invalid Login.']);
                }
            } else {
                return response()->json(['status' => 'failed', 'msg' => 'Invalid Login.']);
            }

        }catch(Exception $e){
            return response()->json(['status' => 'failed', 'msg' => $e->getMessage()]);
        }
    }

    public function register(Request $request) {
        try{

            $validated  = $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Password::defaults()],
            ]);

            User::create($validated);

            return response()->json(['status' => 'success', 'msg' => 'Request Success']);

        }catch(Exception $e){
            return response()->json(['status' => 'failed', 'msg' => $e->getMessage()]);
        }
    }
}
