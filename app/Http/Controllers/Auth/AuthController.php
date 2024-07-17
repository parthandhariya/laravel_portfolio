<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
	public function __costruct()
	{
		return $this->middleware('\App\Http\Middleware\PreventBackHistory::class');
	}

	public function index()
	{
		return view('auth.login');
	}

	public function login(Request $request)
	{
		$credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
		
		//$remember = isset($request->remember) ? true : false;

		if(Auth::attempt($request->only('email','password')))
		{
			setcookie("email","");
			setcookie("password","");			
			return redirect()->route('home');
		}

		return back()->withErrors('Invalide login detail');
	}

	public function registerView()
	{
		return view('auth.register');
	}

	public function register(Request $request)
	{
		//dd($request->all());
		$request->validate([

			'name' => 'required',
			'email' => 'required|unique:users|email',
			'password' => 'required|confirmed'

			],

			[
				'name.required' => 'Full name field is required'
			]
		);
		
		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => \Hash::make($request->password)
		]);
		
		if(Auth::attempt($request->only('email','password')))
		{
			Alert::success('You are registered successfully','Thank you');			
			return redirect()->route('profile');
		}

		return redirect('register')->withError('Error');
	}

	public function home()
	{
		return view('home');
	}

	public function profile()
	{
		return view('profile');
	}
	
	public function profileUpdate(Request $request)
	{
		$user = Auth::user();

		if ($request->hasFile('profile_image'))
		{

			$request->validate([
			    'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules
			]);

	        $image = $request->file('profile_image');
	        $imageName = time() . '_' . $image->getClientOriginalName();
	        $destinationPath = 'images';
	        $pathDetail = $image->move(public_path($destinationPath), $imageName);

	        $storePath = asset("/images/".$imageName);
	        	        	       
	        if(!is_null($user->profile_image))
	        {
	        	$temp = $user->profile_image;
	        	$list = explode('/', $temp);
	        	$fileName = last($list);
	        	$path = public_path() . '/images/'.$fileName;
				if(file_exists($path)) {
				    unlink($path);			    
				}
	        }
	        	        
	        $user->profile_image = $storePath;	        
	    }

	    if ($request->hasFile('dashboard_image'))
		{

			$request->validate([
			    'dashboard_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules
			]);

	        $image = $request->file('dashboard_image');
	        $imageName = time() . '_' . $image->getClientOriginalName();
	        $destinationPath = 'images/dashboard_image';
	        $pathDetail = $image->move(public_path($destinationPath), $imageName);

	        $storePath = asset("/images/dashboard_image/".$imageName);
	        	        	       
	        if(!is_null($user->dashboard_image))
	        {
	        	$temp = $user->dashboard_image;
	        	$list = explode('/', $temp);
	        	$fileName = last($list);
	        	$path = public_path() . '/images/dashboard_image/'.$fileName;
				if(file_exists($path)) {
				    unlink($path);			    
				}
	        }
	        	        
	        $user->dashboard_image = $storePath;	        
	    }

	    $user->gender = $request->gender;
	    $user->phone = $request->phone;
	    $user->about_us = $request->about_us;

	    $user->save();

	    Alert::success('Profile updated successfully','Thank you');

	    return back();
	}	

	public function updatePassword(Request $request)
	{

		$request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed'],
        ]);
		
        if (!Hash::check($request->current_password, Auth::user()->password)) {        	

            return back()->withErrors(['current_password' => 'The old password does not match our records.']);
        }

        
        $user = Auth::user();
        
        $user->update([
            'password' => Hash::make($request->password),
        ]);
                
        $message = 'Your password updated successfully Please Login';
        return redirect()->route('logout',$message);
	}

	public function logout($message = NULL)
	{
		\Session::flush();
		\Auth::logout();

		if(!is_null($message))
		{
			return redirect()->route('login')->with('message',$message);
		}

		return redirect()->route('login');
	}
}
