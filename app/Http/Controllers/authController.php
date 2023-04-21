<?php

namespace App\Http\Controllers;

use App\Models\user;
use App\Models\activity_log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;

use App\Mail\forgot_password;
use App\Mail\varify_user;
use Illuminate\Support\Facades\Mail;

class authController extends Controller
{
    public function index()
    {
        DB::table('password_reset_tokens')->where('token_expired','<' , time())->delete();

        return view('auth.index');
    }// end method

    public function login(Request $request)
    {
        $remember = $request->input('remember_token ');

        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
   
        ]);

        $users = user::find($validated['username']);
        
        if (Auth::attempt($validated, $remember)) {
            if($users->is_active == false)
            {
                return redirect('/auth')->with('error','active account first in email')->onlyInput('email');
            }
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return redirect('/auth')->with('error','accout or password wrong')->onlyInput('email');
    }//end method

    public function logout(Request $request)
    {
        $activity_log = new activity_log;
        $result = $activity_log->record_activity('logout account');

        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     

        return redirect('/auth')->with('success','logout');
    }// end method

    public function forgot_password()
    {
        return view('auth.forgot_password');
    }//end method

    public function forgot_password_email(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:password_reset_tokens,email',
        ],[
            'email.unique' => 'This email address has already been registered.',
        ]);

        $token_data = Str::random(32);
        $token = Hash::make($token_data);
        $domain = url('/');

        DB::table('password_reset_tokens')->insert([
            'email' => $validated['email'],
            'token' => $token,
            'token_expired' => time() + 60 *2, //2 minute will be delete back
        ]);

        Mail::to($validated['email'])->send(new forgot_password($validated['email'],$token_data,$domain));

        return redirect('/forgot_password')->with('success','check email for reset password');

    }//end method

    public function reset(Request $request)
    {   
        if (!$request->has('token') && !$request->has('email')) {
            return redirect('/auth');
        }

        $token = $request->input('token');
        $email = $request->input('email');

        $users = DB::table('password_reset_tokens')->where('email', $email)->get()->first();

        if($users)
        {
            if(Hash::check($token, $users->token) && $users->token_expired >= time())
            {
                return view('auth.reset_forgot_password', ['email' => $email]);
            }
            return redirect('/auth')->with('error','token is expired try again later');
        }

        return redirect('/auth');


    }//end method

    public function reset_password(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password1' => 'required|min:8',
            'password2' => 'required|min:8|same:password1',
        ]);

        $pass = Hash::make($validated['password1']);
        DB::table('user')->where('email',  $validated['email'])->update(['password' => $pass]);

        DB::table('password_reset_tokens')->where('email', $validated['email'])->delete();

        return redirect('/auth')->with('success','password change');
    }//end method

    public function register()
    {
        //
        return view('auth.register');
    }

    public function register_user(Request $request)
    {
        //
                $validated = $request->validate([
                    'email' => 'required|email|unique:user,email',
                    'phone' => 'required|numeric',
                    'name' => 'required|string',
                    'username' => 'required||unique:user,username',
                    'password1' => 'required|min:8|',
                    'password2' => 'required|min:8|same:password1',
                ]);

                DB::table('user')->insert([
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'name' => $validated['name'],
                    'username' => $validated['username'],
                    'password' => Hash::make($validated['password1']),
                    'picture' => 'empty.png',
                    'access' => '',
                    'role' => 2
                ]);

                $domain = url('/');
                
                
                Mail::to($validated['email'])->send(new varify_user($validated['username'],$domain));

                return redirect('/register')->with('success','success register');
    }//end method

    public function varify_user(Request $request)
    {
        if ( !$request->has('username')) {
            return redirect('/auth');
        }

        $username = $request->input('username');
        $users = user::find($username);
        //dd($users);
        $users->is_active = true;
        $users->save();

        return redirect(route('auth'))->with('success','your account is active now');
    }//end method




}//end class
