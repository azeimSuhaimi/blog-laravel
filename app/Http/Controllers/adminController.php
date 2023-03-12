<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\activity_log;
use App\Models\contact_messege;
use App\Models\subscribe;
use App\Mail\subscriber;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    //
    public function show()
    {
        $activity_log = new activity_log;
        $result = $activity_log->record_activity('view menage posts list');

        
        return view('posts.lists',['posts'=> posts::all()]);
    }

    public function postsPicker()
    {
        $activity_log = new activity_log;
        $result = $activity_log->record_activity('view list picker posts');
        return view('indexs.postsPicker',['posts'=> posts::all()]);
    }//end method

    public function postsPicker_edit(Request $request)
    {
        $activity_log = new activity_log;
        $result = $activity_log->record_activity('change picker post id '.$request->input('id'));
        
        if($request->input('id') == '')
        {
            return redirect(route('postsPicker'))->with('error','error edit picker posts');
        }
       // DB::table('posts')->where('pick','', true)->update(['pick' => false]);

        $posts = posts::find($request->input('id'));
        $posts->pick = $request->input('c')== true? true:false;
        $posts->save();
        return redirect(route('postsPicker'))->with('success','success edit picker posts');
    }//end method

    public function list_messege()
    {
        $activity_log = new activity_log;
        $result = $activity_log->record_activity('view list messege posts');

        return view('contact.list_messege',['messege'=> contact_messege::all()]);
    }

    public function view_messege(Request $request)
    {
        $id =$request->input('id');
        if($request->has('id'))
        {
            //return back();
        }
        $activity_log = new activity_log;
        $result = $activity_log->record_activity('view messege posts');

        $messege = contact_messege::find($id);
        $messege->open = true;
        $messege->save();
        return view('contact.view_messege',['messege'=> $messege ]);
    }

    public function msgsub()
    {
        $activity_log = new activity_log;
        $result = $activity_log->record_activity('view messege form');

        return view('admin.messege_form');
    }

    public function msgsub_send(Request $request)
    {
        $validated = $request->validate([
            'messege' => 'required',
        ]);

        $domain = url('/');

        $emails = subscribe::all();

        foreach($emails as $email)
        {

            Mail::to($email->email)->send(new subscriber($email->email,auth()->user()->email,$domain,$validated['messege']));
        }

        return back()->with('success', 'success send notification');
    }
}
