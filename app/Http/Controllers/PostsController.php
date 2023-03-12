<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\activity_log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $activity_log = new activity_log;
        $result = $activity_log->record_activity(' open create post page');
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required',
            'title' => 'required|unique:posts,title',
            'category' => 'required',
            'file' => 'required|image|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
   
        ]);



         if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time().'.'.$file->getClientOriginalExtension();
    
            $file->move(public_path('assets/posts_images/'), $fileName);

            // you can store fileName to database here

            $posts = new posts;

            $posts->title = $validated['title'];
            $posts->category = $validated['category'];
            $posts->content = $validated['content'];
            $posts->image = $fileName;
            $posts->editor = auth()->user()->username;
            $posts->save();

            $activity_log = new activity_log;
            $result = $activity_log->record_activity('create new post'.$validated['title']);

            return redirect(route('createPost'))->with('success',$validated['title']);
            
        }

        return redirect('/profile')->with('error','fail something wrong with this posts');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $activity_log = new activity_log;
        $result = $activity_log->record_activity('view post list');

        //next edit only post by user id only
        return view('posts.lists',['posts'=> posts::where('editor', Auth()->user()->username)->get()]);
    }

    public function active(Request $request)
    {
        $id =$request->has('id');
        if($id == '')
        {
           
            return redirect(route('showPost'))->with('error','post id is empty now');
        }

        $posts =posts::find($id);
        $posts->active = true;
        $posts->save();

        $activity_log = new activity_log;
        $result = $activity_log->record_activity('active the post ');

        return redirect(route('showPost'))->with('success','post is active now');
    }

    public function deactive(Request $request)
    {
        $id =$request->has('id');
        if($id == '')
        {
           
            return redirect(route('showPost'))->with('error','post id is empty now');
        }

        $posts =posts::find($id);
        $posts->active = false;
        $posts->save();

        $activity_log = new activity_log;
        $result = $activity_log->record_activity('deactive the post');

        return redirect(route('showPost'))->with('success','post is active now');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id =$request->input('id');

        $post = posts::find($id);

        $activity_log = new activity_log;
        $result = $activity_log->record_activity('view edit post');

        return view('posts.edit',['post'=> $post]);
    }

    public function update_image(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id' => 'required',
         ]);

         $id = $request->input('id');

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
         }
         $post = posts::find($id);

         if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time().'.'.$file->getClientOriginalExtension();
    
            $file->move(public_path('assets/posts_images/'), $fileName);

           
                
                $filePath = public_path('assets/posts_images/'.$post->image);

                if (File::exists($filePath)) {
                    File::delete($filePath);
                }

             $post = posts::find($id);
             $post->image = $fileName;
             $post->save();

            $activity_log = new activity_log;
            $result = $activity_log->record_activity('edit post image');

            return redirect(route('editPost').'?id='.$id)->with('success',$fileName);
            
        }

        return redirect(route('editPost').'?id='.$id)->with('error','fail something wrong with images');
    }//end method

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
            $title = $request->input('title_unique');

                $validated = $request->validate([
            'content' => 'required',
            'id' => 'required',
            'title' => [
                'required',Rule::unique('posts')->ignore( $title,'title')],
            'category' => 'required',
        ],[
            'title.unique' => 'This title address has already been used.',
        ]);

        $posts = posts::find($validated['id']);
        $posts->category = $validated['category'];
        $posts->title = $validated['title'];
        $posts->content = $validated['content'];
        $posts->save();

        $activity_log = new activity_log;
        $result = $activity_log->record_activity('update post content');

        return redirect(route('editPost').'?id='.$validated['id'])->with('success','edit post success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MyModel $myModel)
    {
        //
    }

    public function viewPost(Request $request)
    {
        $id =$request->input('id');

        $post = posts::find($id);
        if($post->id == '')
        {
            return back()->with('error', 'something wrong with view posts');
        }

        $activity_log = new activity_log;
        $result = $activity_log->record_activity('view post');

        return view('posts.view',['post'=> $post]);
    }//end method
}
