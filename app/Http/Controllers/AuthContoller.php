<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthContoller extends Controller
{
    public function loginSubscriber(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
        ]);
        $subscriber = Subscriber::where('username',$request->username)->first();

        if (isset($subscriber) && Hash::check($request->password, $subscriber->password)) {
            $subscriber->status = 'logged_in';
            $subscriber->save();
            $token = $subscriber->createToken('authToken')->plainTextToken;
            return response()->json(['token' => $token]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
    public function loginAdmin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $admin = Admin::where('username',$request->username)->first();
        if (isset($admin) && Hash::check($request->password, $admin->password)) {
            $token = $admin->createToken('authToken')->plainTextToken;
            return response()->json(['token' => $token]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}
