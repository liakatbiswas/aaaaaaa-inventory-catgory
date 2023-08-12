<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Mail\OTPMail;
use App\Helper\JWTToken;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function registration(Request $request)
    {
        try {
            User::create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => $request->input('password'),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'User Registration Successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
                // TODO
            ], 200);
        }
    } // end registration

    public function login(Request $request)
    {
        $user =   User::where('email', '=', $request->input('email'))
            ->where('password', '=', $request->input('password'))
            // ->count();
            ->select('id')->first();


        if ($user !== null) {
            $token = JWTToken::CreateToken($request->input('email'), $user->id);
            return response()->json([
                'status' => 'success',
                'message' => 'User Login Successfully',
                // 'token' => $token
            ], 200)->cookie('token', $token, 60 * 60 * 8);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'unauthorized'
            ], 200);
        }
    } // end login

    public function sendOtp(Request $request)
    {

        $email = $request->input('email');
        $user = User::where('email', '=', $email)->count();
        $otp = rand(1000, 9999);

        if ($user == 1) {
            Mail::to($email)->send(new OTPMail($otp));
            User::where('email', '=', $email)->update(['otp' => $otp]);

            return response()->json([
                'status' => 'success',
                'message' => 'OTP Send to Email'
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'unauthorized'
            ], 200);
        }
    } // end sendOtp

    public function verifyOtp(Request $request)
    {
        $email = $request->input('email');
        $otp = $request->input('otp');

        $user = User::where('email', '=', $email)
            ->where('otp', '=', $otp)->count();


        if ($user == 1) {
            User::where('email', '=', $email)->update(['otp' => "0"]);

            $token = JWTToken::CreateTokenForSetPassword($request->input('email'));
            return response()->json([
                'status' => 'success',
                'message' => 'OTP Verification Successful',
                // 'token' => $token
            ], 200)->cookie('token', $token, 60 * 24 * 30);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'unauthorized'
            ], 200);
        }
    } // end verifyOtp

    public function resetPassword(Request $request)
    {
        try {
            $email = $request->header('email');
            $password = $request->input('password');

            User::where('email', '=', $email)->update(['password' => $password]);

            return response()->json([
                'status' => 'success',
                'message' => 'Request Successful',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something Went Wrong',
            ], 401);
        }
    } // end resetPassword


    public function logout()
    {
        return redirect('/login')->cookie('token', '', -1);
    }

    public function userProfile(Request $request)
    {
        $email = $request->header('email');
        $user = User::where('email', '=', $email)->first();
        return response()->json([
            'status' => 'success',
            'message' => 'Request Successful',
            'data' => $user
        ], 200);
    }
    public function updateUserProfile(Request $request)
    {
        try {
            $email = $request->header('email');
            $firstName = $request->input('firstName');
            $lastName = $request->input('lastName');
            $phone = $request->input('phone');
            $password = $request->input('password');

            User::where('email', '=', $email)->update([
                'firstName' =>  $firstName,
                'lastName' => $lastName,
                'phone' => $phone,
                'password' =>   $password
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'User Registration Successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'unauthorized'
            ], 200);
        }
    }


    function LoginPage(): View
    {
        return view('pages.auth.login-page');
    }

    function RegistrationPage(): View
    {
        return view('pages.auth.registration-page');
    }
    function SendOtpPage(): View
    {
        return view('pages.auth.send-otp-page');
    }
    function VerifyOTPPage(): View
    {
        return view('pages.auth.verify-otp-page');
    }

    function ResetPasswordPage(): View
    {
        return view('pages.auth.reset-pass-page');
    }

    function ProfilePage(): View
    {
        return view('pages.dashboard.profile');
    }


}
