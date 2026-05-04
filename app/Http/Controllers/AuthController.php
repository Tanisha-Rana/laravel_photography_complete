<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Client;

class AuthController extends Controller
{
    // 🔹 Common OTP function
    private function generateOtp($identifier, $type, $isEmail = true)
    {
        $otp = rand(100000, 999999);
        $column = $isEmail ? 'email' : 'phone';

        DB::table('otps')->updateOrInsert(
            [$column => $identifier, 'type' => $type],
            [
                'otp' => $otp,
                'expires_at' => now()->addMinutes(5),
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        return $otp;
    }

    // 🔹 Registration OTP
    public function sendSignupOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required'
        ]);

        $otp = $this->generateOtp($request->phone, 'signup', false);

        return response()->json([
            'message' => 'OTP Sent Successfully',
            'otp' => $otp
        ]);
    }

    // 🔹 Forgot Password
    public function sendForgotOtp(Request $request)
    {
        $client = Client::where('email', $request->email)->first();

        if (!$client) {
            return response()->json(['message' => 'Email not registered']);
        }

        $otp = $this->generateOtp($request->email, 'forgot', true);

        return response()->json([
            'message' => 'OTP Sent Successfully',
            'otp' => $otp
        ]);
    }

    // 🔹 Admin Login
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $email = $request->email;
            $password = $request->password;

            // Simple college-level admin login method
            $adminEmail = 'admin@monali.com';
            $adminPassword = 'admin123';

            if ($email === $adminEmail && $password === $adminPassword) {
                session()->put('admin_logged_in', true);
                session()->put('admin_email', $adminEmail);

                Alert::success('Success', 'Admin login successful');
                return redirect('/dashboard');
            }

            Alert::error('Failed', 'Invalid email or password');
            return back();
        }

        return view('admin.admin_login');
    }

    public function resetPassword(Request $request)
    {
        $record = DB::table('otps')
            ->where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('type', 'forgot')
            ->first();

        if (!$record || now()->gt($record->expires_at)) {
            return response()->json(['message' => 'Invalid or expired OTP']);
        }

        Client::where('email', $request->email)->update([
            'password' => bcrypt($request->password)
        ]);

        return response()->json(['message' => 'Password reset successful']);
    }
}

