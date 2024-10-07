<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function ShowRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        // dd($request->all);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

       try {
         // mã hóa mat khau 
         $user = new User();
         $user->name = $request->name;
         $user->email = $request->email;
         $user->password = Hash::make($request->password);
 
         $user->save();
 
         auth()->login($user);
       
         return redirect('/')->with('success', true);
       } catch (\Throwable $th) {
        return back()->with('success',false)
        ->with('error', ['message'=>'Lỗi hệ thống']);
       }

    }
    public function dashboard() {
        return view('auth.dashboard');
    }
    public function showLogin() {
        return view('auth.login');
    }
    public function login(Request $request) {
        $login = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($login)){
            
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return back()->withErrors([
            'error'=>'Sai email hoặc mật khẩu',
        ])->onlyInput('email');

    }
    public function logout(Request $request) {
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function movies() {
        return view('auth.movies');
    }
    public function admin() {
        return view('auth.admin');
    }public function nhanVien() {
        return view('auth.order');
    }public function profile() {
        return view('auth.profile');
    }
    public function quenMk()  {
        return view('auth.quenmk');
    }
    public function forgot_password(Request $request) {
        $request->validate(['email' => 'required|email']);
        
        $status = Password::sendResetLink($request->only('email'));
    
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }
    
    public function showResetForm($token) {
        return view('auth.reset')->with(['token' => $token]);
    }
    
    public function resetPassword(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'token' => 'required'
        ]);
    
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
                event(new PasswordReset($user));
            }
        );
    
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => __($status)]);
    }
}
