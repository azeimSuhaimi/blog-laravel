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
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

class userController extends Controller
{
    public function change_password()
    {
        $activity_log = new activity_log;
        $result = $activity_log->record_activity('open change password page');

        return view('user.change_password');
    }//end method

    public function change_password_process(Request $request)
    {
        $validated = $request->validate([
            'password' => 'required',
            'password1' => 'required|min:4',
            'password2' => 'required|min:4|same:password1',
        ]);

        if (! Hash::check($validated['password'], $request->user()->password)) {

            return redirect('/change_password')->with('error','current password not match')->onlyInput('password1','password2');
        }

        $pass = Hash::make($validated['password1']);

        $users = user::find(auth()->user()->username);
        $users->password = $pass;
        $users->save();

        $request->session()->passwordConfirmed();
    
        $activity_log = new activity_log;
        $result = $activity_log->record_activity('change password');

        return redirect()->intended('/change_password')->with('success','current password is update now');

        
    }//end method

    public function profile()
    {
        $activity_log = new activity_log;
        $result = $activity_log->record_activity('view prifile page');

        return view('user.profile');
    }//end method

    public function profile_image(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
         }

         if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time().'.'.$file->getClientOriginalExtension();
    
            $file->move(public_path('assets/profiles/'), $fileName);

            if(auth()->user()->picture != 'empty.png')
            {
                
                $filePath = public_path('assets/profiles/'.auth()->user()->picture);

                if (File::exists($filePath)) {
                    File::delete($filePath);
                }

            }
    
            // you can store fileName to database here

            //Get the authenticated user
             auth()->user()->picture = $fileName;

             //auth()->user()->save();

             $users = user::find(auth()->user()->username);
             $users->picture = $fileName;
             $users->save();

            $activity_log = new activity_log;
            $result = $activity_log->record_activity('edit profile image');

            return redirect('/profile')->with('success',$fileName);
            
        }

        return redirect('/profile')->with('error','fail something wrong with images');
    }//end method

    public function edit_profile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => [
                'required',Rule::unique('user')->ignore(auth()->user()->email,'email')],
            'phone' => 'required|numeric',
        ]);

        $user = user::find(auth()->user()->username);
        $user->email = $validated['email'];
        $user->name = $validated['name'];
        $user->phone = $validated['phone'];
        $user->save();
        //DB::table('user')->where('email',  auth()->user()->username)->update(['name' => $validated['name'],'email' => $validated['email'],'phone' => $validated['phone']]);

        auth()->user()->email = $validated['email'];
        auth()->user()->name = $validated['name'];
        auth()->user()->phone = $validated['phone'];
        auth()->user()->save();

        $activity_log = new activity_log;
        $result = $activity_log->record_activity('edit profile details');

        return redirect('/profile')->with('success','finish edit profile');
    }//end method

    public function activity_log()
    {
        //$logs = auth()->user()->username;

        $logs = DB::table('activity_log')->where('username', auth()->user()->username)->get();

        return view('user.activity_log',['logs' => $logs]);
    }//end method

    public function roles()
    {
        $activity_log = new activity_log;
        $result = $activity_log->record_activity('view users list roles page ');

        $users = DB::table('user')->where('username','!=' , 'abu')->get();
        //$roles = DB::table('permissions')->get();
        return view('user.roles',['users' => $users]);
    }

    public function show_roles(Request $request)
    {
        $users = DB::table('user')->where('username', $request->input('username'))->get()->first();
        $roles = DB::table('permissions')->get();

        $activity_log = new activity_log;
        $result = $activity_log->record_activity('open user edit roles page');

        return view('user.show_roles',['roles' => $roles,'user' => $users]);
    }

    public function edit_roles(Request $request)
    {
        if($request->has('role') == '')
        {
            $roles = '';
            DB::table('user')->where('username', $request->input('username'))->update(['access' => $roles]);
            return redirect(route('user.show.roles') .'?username='.$request->input('username'))->with('error','access is empty now');
        }

        $activity_log = new activity_log;
        $result = $activity_log->record_activity('edit user role '.$request->input('username'));

        $roles = $request->input('role');

        $roles = implode(',', $roles);

        DB::table('user')->where('username', $request->input('username'))->update(['access' => $roles]);

        return redirect(route('user.show.roles') .'?username='.$request->input('username'))->with('success','roles edit success');
    }//end method
}
