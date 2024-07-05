<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail; 
use Hash;
use DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\SendMail;

class ForgotPasswordController extends Controller
{
    public function forgotPasswordView()
	{
		return view('auth.forgot_password');
	}

	public function submitForgetPasswordForm(Request $request)
	{      	
	      $request->validate([
	          'email' => 'required|email|exists:users',
	      ]);

	      $token = Str::random(64);

	      DB::table('password_resets')->insert([
	          'email' => $request->email, 
	          'token' => $token, 
	          'created_at' => Carbon::now()
	        ]);

	      Mail::send('email.forgot_password', ['token' => $token], function($message) use($request){
	          $message->to($request->email);	          
	          $message->subject('Reset Password');
	      });

	      /*$details = [
            'title' => 'Mail from Laravel 9',
            'body' => 'This is for testing email using SMTP.',
            'view' => 'email.forgot_password',
            'token' => $token,
        ];

	      Mail::to($request->email)->send(new \App\Mail\SendMail($details));*/

	      return back()->with('message', 'We have e-mailed your password reset link!');
	}

	public function resetPasswordFormView($token)
	{
		return view('auth.reset_password_form_view', ['token' => $token]);
	}

	public function submitResetPasswordForm(Request $request)
	{
	     	$request->validate([
	          'email' => 'required|email|exists:users',
	          'password' => 'required|string|min:6|confirmed',
	          'password_confirmation' => 'required'
	      ]);

	      $updatePassword = DB::table('password_resets')
	                          ->where([
	                            'email' => $request->email, 
	                            'token' => $request->token
	                          ])
	                          ->first();

	      if(!$updatePassword){
	          return back()->withInput()->with('error', 'Invalid token!');
	      }

	      $user = User::where('email', $request->email)
	                  ->update(['password' => Hash::make($request->password)]);

	      DB::table('password_resets')->where(['email'=> $request->email])->delete();

	      return redirect()->route('login')->with('message', 'Your password has been changed!');
	}
}
