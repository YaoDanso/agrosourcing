<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->except(['logout','userLogout']);
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'  => 'required|email',
            'password' => 'required|min:6'
        ]);
        $user = User::where('email',$request->email)->first();
        if ($user){
            if ($user->status == 0){
                return redirect()->back()
                    ->withInput($request->only('email','remember'))
                    ->with('error','Your account has been suspended');
            }else{
                if ($user->email_verified == 0){
                    return redirect()->back()
                        ->withInput($request->only('email','remember'))
                        ->with('error','Please visit your email '.$request->email.' to activate your account');
                }
            }
        }else{
            return redirect()->back()
                ->withInput($request->only('email','remember'))
                ->with('error','Sorry, you do not have an account with us.');
        }

        if($this->attemptLogin($request)){
            if ($request->redirect_url){
                return redirect()->to(urldecode($request->redirect_url));
            }else{
                return redirect()->intended(route('user.welcome'));
            }
        }else{
            return redirect()->back()
                ->withInput($request->only('email','remember'))
                ->with('error','Sorry, you entered a wrong password!');
        }
    }

    public function userLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
