<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{

    public function login() {
        if(Auth::check()) {
            return redirect('profile');
        }
        return view('authentication.login');
    }

    public function registration() {
        if(Auth::check()) {
            return redirect('profile');
        }
        return view('authentication.registration');
    }

    public function profile() {
        return view('user.profile');
    }

    public function userlist() {
        if (Session::has('isAdmin'))
        {
            return view('user.userlist');
        }
        else
        {
            return redirect('/');
        }
    }

    public function logoutUser(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::flush();
        return redirect('/');
    }

    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4|max:12',
        ]);

        if($request->email == 'admin@localhost.local' && $request->password == 'admin') {
            Session::put('isAdmin', 'yes');
            return redirect('admin');
        }

        if (Auth::attempt($credentials)) {
            return redirect('profile');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);

    }

    public function createUser(Request $request)
    {
        $credentials = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'address' => 'required',
            'phone' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'birthdate' => 'required',
            'password' => 'required|min:4|max:12',
        ]);

        $user = new User;
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->birthdate = $request->birthdate;
        $user->password = Hash::make($request->password);

        $query = $user->save();

        if($query) {
            if (Auth::attempt($credentials)) {
                return redirect('profile');
            }
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
        else {
            return back()->withErrors([
                'registration' => 'User creation failed.',
            ]);
        }

    }

    public function getAllUsers() {
        if (Session::has('isAdmin'))
        {
            $users = User::all();
            return $users;
        }
        return redirect('/');
    }

    public function searchUsers($keyword) {
        if (Session::has('isAdmin'))
        {
            $users = User::where('firstName', 'like', "%{$keyword}%")->orWhere('lastName', 'like', "%{$keyword}%")->get();
            return $users;
        }
        return redirect('/');
    }

    public function verifyEmail($email) {
        $users = User::where('email', 'like', $email)->get();
        if(count($users) > 0)
            return response()->json(['registered' => 'yes']);
        else
            return response()->json(['registered' => 'no']);
    }

}
