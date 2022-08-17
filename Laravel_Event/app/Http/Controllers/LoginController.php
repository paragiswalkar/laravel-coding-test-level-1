<?php

namespace App\Http\Controllers;

use Validator;
use Session;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    
    public function getLogin()
    {
        return view('login');
    }

    /**
     * Show the application loginprocess.
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $credentials = $request->only('username', 'password');
        
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        try {
            
            if (auth()->guard('web')->attempt(['username' => $request->input('username'), 'password' => $request->input('password')]))
            {
                $user = auth()->guard('web')->user();
                $token = JWTAuth::attempt($credentials);

                \Session::put('token',$token);
                return redirect()->route('dashboard')->header('Authorization','Bearer'.$token);
                
            } else {
                return back()->with('error','your username and password are wrong.');
            }
        } catch (Expetion $e) {
            print_r($e);
        }

    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        dd($request);exit;
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
